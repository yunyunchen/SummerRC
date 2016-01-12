@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">编辑剧</div>

                    <div class="panel-body">

                        @include('_layouts.alertinfo')

                        <form action="{{ URL('admin/story/'.$edit->id) }}" method="POST">
                            <input name="_method" type="hidden" value="PUT">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label for="story-priority">排序:</label>
                                <input type="text" name="priority" class="form-control" id="story-priority" required="required" value="{{ $edit->priority }}">
                            </div>

                            <div class="form-group">
                                <label>阅读权限:</label>
                                <div class="">
                                    <label class="radio-inline">
                                        <input class="" type="radio" name="permission" value="1" {{ ($edit->permission=='1')?"checked":'' }}>打开
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="permission" value="0" {{ ($edit->permission=='0')?"checked":'' }}>关闭
                                    </label>
                                </div>
                            </div>

                            <button class="btn btn-lg btn-info">编辑 剧</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection