<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use \App\Dataset;
use \App\StandardItem;
use \App\Item;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DatasetController extends Controller
{

    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required|max:255',
            'description' => 'required',
            'standarditemfile' => 'mimes:csv,txt',
            'itemfile' => 'mimes:csv,txt',
        ]);
        $input = $request->all();
        $dataset = Dataset::create($input);
        if($request->hasFile('standarditemfile')){
            $standardItemFile = $request->file('standarditemfile');
            $this->standardItem2DB($standardItemFile,$dataset->id);
        }
        if($request->hasFile('itemfile')){
            $itemFile = $request->file('itemfile');
            $this->item2DB($itemFile,$dataset->id);
        }

        Session::flash('flash_message', '数据集'.$input['name'].'创建成功');
        return \Redirect::back();
    }

    public function index(){

        $datasets = Dataset::paginate(5);

        $datasets->setPath(url('/back/dataset'));
        return view('back.dataset.index',compact('datasets'));
    }


    public function edit($id){
        $dataset = Dataset::findOrFail($id);
        return view('back.dataset.edit',compact('dataset'));
    }
    public function update(Request $request){
        $this->validate($request, [
            'name' => 'required|max:255',
            'description' => 'required',
        ]);
        $input = $request->all();
        $dataset = Dataset::find($input['id']);
        $dataset->name = $input['name'];
        $dataset->description = $input['description'];
        $dataset->save();
        Session::flash('flash_message', '修改成功');
        return \Redirect::back();
    }
    public function destroy($id){
        $dataset = \App\Dataset::findOrFail($id);
//        $dataset->StandardItems()->delete();
        $dataset->delete();
        Session::flash('flash_message', '数据集'.$dataset->name.'删除成功');
        return \Redirect::back();
    }

    public function importStandardItem(Request $request){
        $this->validate($request, [
            'dataset_id' => 'required',
            'standarditemfile' => 'required|mimes:csv,txt',
        ]);
        $input = $request->all();
        $datasetID = $input['dataset_id'];
        $standardItemFile = $request->file('standarditemfile');
        $this->standardItem2DB($standardItemFile,$datasetID);

        Session::flash('flash_message', '标准数据导入成功');
        return \Redirect::back();
    }
    public function importItem(Request $request){
        $this->validate($request, [
            'dataset_id' => 'required',
            'itemfile' => 'required|mimes:csv,txt',
        ]);
        $input = $request->all();
        $datasetID = $input['dataset_id'];
        $itemFile = $request->file('itemfile');
        $this->item2DB($itemFile,$datasetID);

        Session::flash('flash_message', '标定数据导入成功');
        return \Redirect::back();
    }

    public function item2DB($file,$datasetId){
        if($file->isValid()){
            $clientName = $file->getClientOriginalName();
            $newName = date('ymdhis').$clientName;
            $path = $file->move('storage/uploads/dataset',$newName);
            $this->item2DBImpl($path,$datasetId);
        }
    }
    public function item2DBImpl($path,$datasetId){
        $fh = fopen($path,'r');
        $standardItemsMap = StandardItem::StandardItemsMap($datasetId);
        while ($line = fgets($fh)) {
            $row = explode(",",$line);
            Item::create(['path'=>$row[1],'standard_item_id'=>$standardItemsMap[$row[0]]]);
        }
        fclose($fh);
    }
    public function standardItem2DB($file,$datasetId){
        if($file->isValid()){
            $clientName = $file->getClientOriginalName();
            $newName = date('ymdhis').$clientName;
            $path = $file->move('storage/uploads/dataset',$newName);
            $this->standardItem2DBImpl($path,$datasetId);
        }
    }
    public function standardItem2DBImpl($path,$datasetId){
        if(StandardItem::where('dataset_id',$datasetId)->count() == 0){
            $maxID = DB::table("standard_items")->max('id');
            if ($maxID == null){
                $maxID = 1;
            }
            else{
                $maxID += 1;
            }
            $dataset = Dataset::findOrFail($datasetId);
            $dataset->current_standard_id = $maxID;
            $dataset->save();
        }
        $fh = fopen($path,'r');
        while ($line = fgets($fh)) {
            $row = explode(",",$line);
            StandardItem::create(['name'=>$row[0],'slug'=>$row[1],'path'=>$row[2],'dataset_id'=>$datasetId]);

        }
        fclose($fh);
    }

}
