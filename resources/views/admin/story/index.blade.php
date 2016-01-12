@extends('app')
{{-- 标题 --}}
@section('title', '剧管理')

@section('content')
<style>
    .mb5{margin-bottom: 5px;}
</style>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">剧管理</div>

                    <div class="panel-body">
                        {{-- 视图中包含另一个视图 --}}
                        @include('_layouts.alertinfo')

                        <form class="form-inline mb5" role="form" action="{{ URL('admin/story') }}">
                            <div class="form-group">
                                <div class="col-md-3">
                                    <input name="key_ID" type="type" class="form-control" placeholder="ID" value="{{ @isset($pageWhere['key_ID'])?$pageWhere['key_ID']:'' }}">
                                </div>

                            </div>
                            <div class="form-group">
                                <div class="col-md-3">
                                    <input name="key_title" type="type" class="form-control" placeholder="标题" value="{{ @isset($pageWhere['key_title'])?$pageWhere['key_title']:'' }}">
                                </div>
                            </div>
                            <input type="submit" class="btn btn-success" value="查询" />
                        </form>

                        <table class="table table-striped">
                            <tr class="row">
                                <th class="col-lg-1">ID</th>
                                <th class="col-lg-3">标题</th>
                                <th class="col-lg-3">作者</th>
                                <th class="col-lg-1">排序</th>
                                <th class="col-lg-2">阅读权限</th>
                                <th class="col-lg-1">编辑</th>
                                <th class="col-lg-1">删除</th>
                            </tr>
                            @foreach ($lists as $li)
                                <tr class="row" data-id="{{ $li->id }}">
                                    <td class="col-lg-1">
                                        {{ $li->id }}
                                    </td>
                                    <td class="col-lg-6">
                                        @if ($li->id)
                                            <a href="http://reader.yuxip.com/ichees/read?storyid={{ $li->id }}" target="_blank">
                                                <h4>{{ $li->title }}</h4>
                                            </a>
                                        @else
                                            <h3>{{ $li->title }}</h3>
                                        @endif
                                    </td>
                                    <td class="col-lg-3">
                                        {{ $li->creatorname }}
                                        {{--<a href="{{ URL('pages/'.$comment->page_id) }}" target="_blank">
                                            {{ App\Page::find($comment->page_id)->title }}
                                        </a>--}}
                                    </td>
                                    <td class="col-lg-1">{{ $li->priority }}</td>
                                    <td class="col-lg-1">{{ ($li->permission=='1')?'打开':'关闭' }}</td>
                                    <td class="col-lg-1">
                                        <a href="{{ URL('admin/story/'.$li->id.'/edit') }}" class="btn btn-success">编辑</a>
                                        <a type="button" class="btn btn-primary js-edit" data-toggle="modal" data-target=".bs-example-modal-lg">Large modal</a>

                                    </td>
                                    <td class="col-lg-1">
                                        <a href="{{ URL('admin/story/'.$li->id.'/delStatus') }}" class="btn btn-danger">删除</a>
                                        {{--<form action="{{ URL('admin/story/'.$li->id) }}" method="POST" style="display: inline;">
                                            <input name="_method" type="hidden" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <button type="submit" class="btn btn-danger">删除</button>
                                        </form>--}}
                                    </td>
                                </tr>
                            @endforeach
                        </table>

                        <div class="col-lg-offset-3">{!! $lists->appends($pageWhere)->render() !!}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Large modal -->
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myLargeModalLabel">排序</h4>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <input name="_method" type="hidden" value="PUT">
                        <input type="text" name="sort" placeholder="排序" />
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

    <script src="/js/jquery-2.1.4.min.js"></script>
    <script>
        $(function(){
           $(".js-edit").click(function(){
               var id = $(this).parents('tr').data('id');
               $.post('{{ URL('admin/story/ajaxEdit') }}',{id:id,_token:'{{ csrf_token() }}','_method':'GET' },function(data){
                   alert('ok');

               });

           });
        });
        $.ajax("")
    </script>

@endsection