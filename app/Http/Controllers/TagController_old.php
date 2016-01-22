<?php

namespace App\Http\Controllers;

use DebugBar\DebugBar;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class TagController_old extends Controller
{
    protected $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    private function newBatch($dbId, $userId) {
        $expiresAt = Carbon::now()->subMinutes(5);
//        \DebugBar::warning('New Batch');
        $ownBatch = \App\Batch::where('user_id',$userId)->where('remain_count','>',0)->first();
        if( $ownBatch != null ) {
//            \DebugBar::warning('You own a batch');
            return $ownBatch; // if a batch is still owns by a user, give it to our user.
        }
        $expireBatch = \App\Batch::where('updated_at', '<=', $expiresAt)->first();
        $db = \App\Dataset::find($dbId);
        if($expireBatch == null) {
//            \DebugBar::warning('if($expireBatch == null)');
            $current_standard_id = $db->current_standard_id;
            if($current_standard_id == 0) {
                // no standard id
//                \DebugBar::warning('if($current_standard_id == 0)');
                return null;
            }
            $current_standard = \App\StandardItem::find($current_standard_id);
            $batches = \App\Batch::where('user_id', $userId)->orderBy('standard_item_id', 'desc')->first();
            if( $current_standard->batch_count == 3 ) { // all dispatched
//                \DebugBar::warning('if( $current_standard->batch_count == 3 )');
                $current_standard = \App\StandardItem::where('id','>',$current_standard_id)->first();
                if( $current_standard == null ){
                    return null;
                }
                $current_standard_id = $current_standard->id;
                $db->current_standard_id = $current_standard_id;
                $db->save();
            }
            if( $batches ) {
                $max_standard_id = max($batches->standard_item_id+1, $current_standard_id);
            } else {
                $max_standard_id = $current_standard_id;
            }
            $current_standard = \App\StandardItem::where("id",">=",$max_standard_id)->first();
//            \DebugBar::warning('$current_standard:'.$current_standard);
            if($current_standard == null) {
                return null;
            }
            $newBatch = new \App\Batch();
            $newBatch->fill([
                'standard_item_id'=>$current_standard->id,
                'user_id'=>$userId,
                'remain_count'=>count($current_standard->Items)
            ]);
            $newBatch->save();
            $current_standard->batch_count ++;
            $current_standard->save();
//            \DebugBar::warning('$newBatch:'.$newBatch);
            return $newBatch;
        } else {
            $expiredUserId = $expireBatch->user_id;
            $expiredUser = \App\User::where("user_id", $expiredUserId);
            $expiredUser->batch_id = -1;
            $expiredUser->save();
            $expireBatch->user_id = $userId;
            $expireBatch->save();
            return $expireBatch;
        }
    }

    public function getNext($id) {
        // TODO: Delete unused 'count'
        $userid = $this->auth->user()->id;
        $batchId = $this->auth->user()->batch_id;
        $batch = \App\Batch::find($batchId);
        if ( $batch == null ) {
//            \DebugBar::warning('$batch==null:');
            $batch = $this->newBatch($id, $userid);
            $this->auth->user()->batch_id = $batch->id;
            $this->auth->user()->save();
        } elseif ( $batch->remain_count == 0 ){
//            \DebugBar::warning('$batch->remain_count == 0');
            $standard = \App\StandardItem::find($batch->standard_item_id);
            // if user owns no valid batch or he/she has already done a batch
            $batch = $this->newBatch($id, $userid);
            if ($batch == null) {
                return view('tag.no_more', [
                    'user' => $this->auth->user(),
                    'dataset' => \App\Dataset::find($id),
                ]);
            }
            $this->auth->user()->batch_id = $batch->id;
            $this->auth->user()->save();
            return view('tag.done', [
                'user' => $this->auth->user(),
                'dataset' => \App\Dataset::find($id),
                'standard' => $standard,
            ]);
        }
        $standard = \App\StandardItem::find($batch->standard_item_id);
        $items = $standard->Items;
        $item = $items[$batch->remain_count-1];
        return view('tag.tag', [
            'user'=>$this->auth->user(),
            'dataset'=>\App\Dataset::find($id),
            'standard'=>$standard,
            'batch'=>$batch,
            'item'=>$item
        ]);
    }

    public function postLabel($id, Request $req) {
        $userid = $this->auth->user()->id;
        $this->auth->user()->points += 1; // TODO: decide the point, now is 1
        $label = $req->get('label');
        $itemId = $req->get('item');
        $batchId = $req->get('batch');
//        \Log::info($label." ".$itemId." ".$batchId);
//        $batchId = $this->auth->user()->batch_id;
        $batch = \App\Batch::find($batchId);
        $batch->remain_count--;
        $batch->save();
        $user_item = new \App\ItemUserRelation();
        $user_item->fill(['batch_id'=>$batchId,
            'item_id'=>$itemId,
            'user_id'=>$userid]);
        $user_item->label = ($label == 'True');
        $user_item->save();
        $item = \App\Item::find($itemId);
        $item->count += 1;
        $this->auth->user()->save();
        $item->save();
        return redirect('/tag/'.$id);
    }
}
