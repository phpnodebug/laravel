<meta name="_token" content="{!! csrf_token() !!}"/>
<div class="bjui-pageHeader">
    <form id="pagerForm" data-toggle="ajaxsearch" action="{{ url('backend/admin/search')}}" method="POST">
        @include('backend.common.formHeader')
        <div class="bjui-searchBar">
            <label>姓名：</label>
            <input type="text" id="search_name" value="{{isset($search['name'])?$search['name']:''}}" name="search[name]"   class="form-control" size="10">&nbsp;
            <label>邮箱：</label>
            <input type="text" id="search_email" value="{{isset($search['email'])?$search['email']:''}}" name="search[email]"  data-rule="email"  class="form-control" size="10">&nbsp;

            <button type="submit" class="btn-default" onclick="checkSearch();" data-icon="search">模糊查询</button>
            &nbsp;
            <a class="btn btn-orange" href="javascript:;" onclick="$(this).navtab('adminslist', true);"
               data-icon="undo">清空查询</a>

            <button type="button" class="btn-blue btn" data-icon="fa-plus" data-width='530' data-toggle="dialog" data-id="addrole"  data-fresh="true" data-url="{{route('backend.admin.create')}}" data-title="添加新用户">添加新用户</button>

            <div class="pull-right">
                <div class="btn-group">
                    <button type="button" class="btn-default dropdown-toggle" data-toggle="dropdown" data-icon="glyphicon-star">
                        批量操作<span class="caret"></span></button>
                    <ul class="dropdown-menu right" role="menu">
                        <li><a href="{{URL::to('backend/admin/selectdelete')}}" data-toggle="doajaxchecked" data-type='post'data-confirm-msg="确定要删除选中项吗？"
                               data-idname="ids" data-group="ids">删除选中</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </form>
</div>
<div class="bjui-pageContent tableContent">
    <table data-toggle="tablefixed" data-width="100%" data-nowrap="true" style='font-size:30px'>
        <thead>
        <tr>
            <th width="26"><input type="checkbox" class="checkboxCtrl" data-group="ids" data-toggle="icheck"></th>
            <th data-order-field="id">ID</th>
            <th data-order-field="name">姓名</th>
            <th data-order-field="email">邮箱</th>
            <th >操作</th>
        </tr>
        </thead>

        <tbody>
                @foreach($data['info'] as $item)
                    <tr data-id="{{$item->id}}">
                        <td><input type="checkbox" name="ids" data-toggle="icheck" value="{{$item->id}}"></td>
                        <td>{{$item->id}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->email}}</td>
                      {{--  <td>{{$item->roles}}</td>--}}
                        <td>

                                <a href="{{route('backend.admin.edit',['id'=>$item->id])}}" class="btn btn-green"
                                   data-toggle="dialog" data-id="editadmin"     data-title="编辑- {{$item->name}} -用户">编辑</a>
                                <a href="{{URL::to('backend/admin/'.$item->id)}}" class="btn btn-red" data-toggle="doajax"
                                   data-confirm-msg="确定要删除- {{$item->email}} -用户？"  data-type="delete">删除</a>

                        </td>
                    </tr>
                @endforeach
        </tbody>
    </table>
</div>

@include('backend.common.formFooter')

<script type="text/javascript">
    $.ajaxSetup({
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
    });
    function checkSearch() {
         var searName = $('#search_name').val();
         var searEmail = $('#search_email').val();
        if (searName==''&&searEmail=='') {
            $(this).alertmsg('error', '搜索字段不能为空')
            return false;
        }
        return true;
    }
</script>