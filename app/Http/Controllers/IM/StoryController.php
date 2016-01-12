<?php

namespace App\Http\Controllers\IM;

use App\Models\Admin\IMStory;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;


use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;


class StoryController extends Controller
{
    public function __construct()
    {
        echo '__construct';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        //接收参数
        $input = Input::all();

        //echo $key_id = Input::get('key_ID');
        /*echo $input['key_ID'];
        dd($input);*/



        $models = IMStory::select('id','title','creatorname','priority','permission')->where('storystatus','0')->where('selfstory','0')->orderBy('id','desc');

        //搜索分页条件
        $viewWhere = [];
        //搜索查询
        if(isset($input['key_ID']) && !empty($input['key_ID'])){
            $models->where('id',$input['key_ID']);
            $viewWhere['key_ID'] = $input['key_ID'];
        }

        if(isset($input['key_title']) && !empty($input['key_title'])){
            $models->where('title','like','%'.$input['key_title'].'%');
            $viewWhere['key_title'] = $input['key_title'];
        }

        $lists = $models->paginate(10);
        /*$sql = DB::getQueryLog();

        $query = end($sql);
        dd($query);*/

//        dd($lists);
        return view('admin.story.index',['lists'=>$lists,'pageWhere'=>$input]);
    }


    /**
     * 删除剧
     */
    public function delStatus($id){
        //删除信息
        IMStory::where('id', $id) ->update(['storystatus' => 1]);

        //return  Redirect::back()->withInput()->withErrors('删除成功！');

        return Redirect::back()->with('status', '删除成功！');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        echo "create";
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        echo 'store';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        echo 'show';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = (int)$id;
        if(!$id){
            return Redirect::back()->withError('参数错误！');
        }

        //获取数据
        $edit = IMStory::select('id','priority','permission')->where('id',$id)->where('storystatus','0')->where('selfstory','0')->first();

        return view('admin.story.edit',['edit'=>$edit]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $rules = [
            'priority'=>'numeric|min:0',
            'permission'=>'numeric|min:0',
        ];

        /*$this->validate($request,[
            'priority'=>'numeric|min:0',
            'permission'=>'numeric|min:0',
        ]);*/

        $validator = Validator::make(Input::all(),$rules);
        if ($validator->passes()) {
            IMStory::where('id', $id) ->update(['priority' => $request->input('priority'),'permission' => $request->input('permission')]);
            return Redirect::to('admin/story');
        }else{
            return Redirect::back()->withInput()->withErrors($validator);
        }

    }

    public function ajaxEdit(Request $request){

        echo 'ajaxEdit';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
