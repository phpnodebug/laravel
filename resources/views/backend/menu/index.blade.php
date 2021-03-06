<meta name="_token" content="{!! csrf_token() !!}"/>

@inject('menuPresenter','App\Presenters\Backend\MenuPresenter')

<div class="bjui-pageHeader">
    <form id="pagerForm" data-toggle="ajaxsearch" action="{{ url('backend/menu/search')}}" method="POST">
        @include('backend.common.formHeader')
        <div class="bjui-searchBar">
            <label>菜单名称：</label>
            <input type="text" id="menuname" value="{{isset($search['name'])?$search['name']:''}}" name="search[name]"   class="form-control" size="10">&nbsp;
            <label>菜单路由：</label>
            <input type="text" id="menuroute" value="{{isset($search['route'])?$search['route']:''}}" name="search[route]"     class="form-control" size="10">&nbsp;

            <label>权限描述：</label>
            <input type="text" id="menudesc" value="{{isset($search['description'])?$search['description']:''}}" name="search[description]"    class="form-control" size="10">&nbsp;

            <button type="submit" class="btn-default" onclick="checkSearch();" data-icon="search">模糊查询</button>
            &nbsp;
            <a class="btn btn-orange" href="javascript:;" onclick="$(this).navtab('permissionslist', true);"
               data-icon="undo">清空查询</a>

            <button type="button" class="btn-blue btn" data-width="600" data-height="450" data-icon="fa-plus" data-width='530' data-toggle="dialog" data-id="addmenu"  data-fresh="true" data-url="{{route('backend.menu.create')}}" data-title="添加新菜单">添加新菜单</button>

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
    <table   data-toggle="tablefixed"   data-width="100%" data-nowrap="true" style='font-size:30px'>
        <thead>
        <tr>
            <th width="26"><input type="checkbox" class="checkboxCtrl" data-group="ids" data-toggle="icheck"></th>
            <th data-order-field="id">ID</th>
            <th data-order-field="parent_id">父级ID</th>
            <th data-order-field="name">菜单名称</th>
            <th data-order-field="description">菜单描述</th>
            <th data-order-field="route">菜单路由</th>
            <th data-order-field="tab_id">TAB_ID</th>
            <th data-order-field="icon">菜单打开时图标</th>
            <th data-order-field="data_fresh">页面打开时是否刷新</th>
            <th data-order-field="sort">排序</th>
            <th data-order-field="hide">是否显示</th>
            <th >操作</th>
        </tr>
        </thead>

        <tbody>

            @foreach($data['info'] as $item)
                <tr data-id="{{$item->id}}" >
                    <td><input type="checkbox" name="ids" data-toggle="icheck" value="{{$item->id}}"></td>
                    <td>{{$item->id}}</td>
                    <td>{{$item->parent_id}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->description}}</td>
                    <td>{{$item->route}}</td>
                    <td>{{$item->tab_id}}</td>
                    <td>{{$item->icon}}</td>
                    <td>{{$menuPresenter->tabFresh($item->data_fresh)}}</td>
                    <td>{{$item->sort}}</td>
                    <td>{{$menuPresenter->showDisplayFormat($item->hide)}}</td>

                    <td>

                            <a href="{{route('backend.menu.edit',['id'=>$item->id])}}" class="btn btn-green"
                               data-toggle="dialog" data-id="editadmin"  data-width="600" data-height="450"  data-title="编辑- {{$item->description}} -菜单">编辑</a>
                            <a href="{{URL::to('backend/menu/'.$item->id)}}" class="btn btn-red" data-toggle="doajax"
                               data-confirm-msg="确定要删除- {{$item->email}} -菜单？"  data-type="delete">删除</a>

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
        var menuname = $('#menuname').val();
        var menuroute = $('#menuroute').val();
        var menudesc = $('#menudesc').val();
        if (menuname=='' &&menuroute==''&& menudesc=='') {
            $(this).alertmsg('error', '搜索字段不能为空')
            return false;
        }
        return true;
    }
</script>