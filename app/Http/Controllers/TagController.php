<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DebugBar\DebugBar;
use Illuminate\Contracts\Auth\Guard;
use Carbon\Carbon;

class TagController extends Controller
{
    protected $auth;

    public function __construct(Guard $auth) {
        $this->auth = $auth;
    }

    private function query($query) {
        // SELECT * FROM `batches` WHERE ID IN (SELECT standard_item_id FROM `batches` WHERE 1)
        $query->select(DB::raw(1))
            ->from('batches')
            ->whereRaw('A.id = B.id');
    }

    /*
     * allocate a new batch to user
     */
    private function newBatch($dbId, $userId) {
        // Condition I: user still owns an unfinished batch [seems won't happen]
        // TODO: won't happen
//        $ownBatch = \App\Batch::where('user_id', $userId)
//            ->where('remain_count','>',0)
//            ->first();
//
//        if( $ownBatch != null ) {
//            return $ownBatch;
//        }

        // Condition II: an unfinished batch is expired
        $expiresAt = Carbon::now()->subMinutes(60); // TODO: test, expire in 60 minutes
        $expireBatch = \App\Batch::where('updated_at', '<=', $expiresAt)
        ->where('remain_count','>',0)
        ->whereRaw(
            'standard_item_id NOT IN (SELECT standard_item_id FROM `batches` WHERE `user_id` = '.$userId.')'
        )
        ->first();
        if($expireBatch != null) {
            // set the new user id
            $expireBatch->user_id = $userId;
            $expireBatch->save();

            return $expireBatch;
        }

        // Condition III: no batch expired, find a new batch
        $newBatch = \App\Batch::where('user_id', 0)
        ->where('remain_count','>',0) // not done
        ->whereRaw(
            'standard_item_id NOT IN (SELECT standard_item_id FROM `batches` WHERE `user_id` = '.$userId.')'
        ) // standard was not tagged by this user
        ->first();

        return $newBatch;
    }

    /*
     * handle 'next item' request, give next leagl item to user
     */
    public function getNext($id) {
        $user = $this->auth->user();
        $userId = $user->id;

        $batch = \App\Batch::where('user_id', $userId)
            ->where('remain_count','>',-1) // not done
            ->first(); // find if the user is tagging some batch

        // condition I: the user is not working on any batch
        if ( $batch == null  ) {
            // allocate a new batch
            $batch = $this->newBatch($id, $userId);

            // system can't allocate any batch, all job has been done
            // this is a special condition
            if ($batch == null) {
                return view('tag.no_more', [
                    'user'    => $user,
                    'dataset' => \App\Dataset::find($id),
                ]);
            }

            // update the batch, assign userId to this batch
            $batch->user_id = $userId;
            $batch->save();
        }

        // the standard of this batch
        $standard = \App\StandardItem::find($batch->standard_item_id);

        // condition II: the batch working on has been done
        if ( $batch->remain_count == 0 ) {
            // -- set batch.user_id to zero, means that the batch belongs to no one.
            $batch->remain_count = -1;
            $batch->save();

            // return a 'done' view
            return view('tag.done', [
                'user'      => $this->auth->user(),
                'dataset'   => \App\Dataset::find($id),
                'standard'  => $standard,
            ]);
        }

        $items = $standard->Items;
        $item = $items[$batch->remain_count-1];

        return view('tag.tag', [
            'user'      =>$user,
            'dataset'   =>\App\Dataset::find($id),
            'standard'  =>$standard,
            'batch'     =>$batch,
            'item'      =>$item,
        ]);
    }

    /*
     * handle 'tag' operation, save the user tag to TABLE
     * each tag operation gain 1 point
     * penalty will be done offline
     */
    public function postLabel($id, Request $req) {
        $userId = $this->auth->user()->id;

        // Arguments
        $label = $req->get('label'); // BOOL
        $itemId = $req->get('item');
        $batchId = $req->get('batch');

        // update the batch
        $batch = \App\Batch::find($batchId);
        $batch->remain_count--;
        $batch->save();

        // save the tag result
        $user_item = new \App\ItemUserRelation();
        $user_item->fill([
            'batch_id'=>$batchId,
            'item_id'=>$itemId,
            'user_id'=>$userId
        ]);
        $user_item->label = ($label == 'True');
        $user_item->save();

        // update the item
        $item = \App\Item::find($itemId);
        $item->count += 1;
        $item->save();

        // TODO: decide the point, now is 1
        $this->auth->user()->points += 1;
        $this->auth->user()->save();

        return redirect('/tag/'.$id);
    }
}
