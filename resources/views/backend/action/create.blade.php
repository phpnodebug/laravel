@inject('menuPresenter','App\Presenters\Backend\ActionPresenter')
<div class="bjui-pageContent">
    <form  action="{{route('backend.action.store')}}" data-toggle="validate" method="post">
        {{ csrf_field() }}
        <table class="table table-bordered table-hover  table-striped table-top table-condensed"   >
            <tr>
                <th><label class="x85">操作分组：</label></th>
                <td>
                    <select name="group" id='type' data-rule="required" data-width="300" data-size="5"   data-max-options="1" data-toggle="selectpicker">

                        @foreach(config('ui.action-group') as $key => $group)
                            <option value="{{$key}}">{{$group}}</option>
                        @endforeach
                    </select>

                </td>
            </tr>
            <tr>
                <th>操作名称:</th>
                <td><input type="text" class="input-nm"  data-rule="标识:required"   name="name"  id="name" value="" placeholder="操作名称" size="30"></td>
            </tr>


            <tr>
                <th>操作描述:</th>
                <td><input type="text" class="input-nm"  data-rule="描述:required"    name="description" id="description" value="" placeholder="操作描述" size="30"></td>
            </tr>
            <tr>
                <th><label class="x85">操作标识：</label></th>
                <td>
                    <input type="text" class="input-nm"  data-rule="标识:required"   name="action"  id="action" value="" placeholder="操作标识" size="30">
                   {{-- <select name="action" id='action' data-rule="required" data-width="200" data-size="5"   data-max-options="1" data-toggle="selectpicker">
                        @foreach($actions as $key => $action)
                            <option value="{{$action}}">{{$action}}</option>
                        @endforeach
                    </select>--}}

                </td>
            </tr>
            <tr>
                <th>是否显示:</th>
                <td>
                    <input type="radio" name="state" checked id="state1" value="1" data-toggle="icheck" data-label="显示">
                    <input type="radio" name="state" id="state2" value="0" data-toggle="icheck" data-label="不显示">
                </td>
            </tr>
            <tr>
                <th>排序:</th>
                <td><input type="text" class="input-nm"  data-rule="排序:required;digits"   name="sort" id="sort" value="" placeholder="操作排序" size="10"></td>
            </tr>

        </table>
    </form>
</div>

<div class="bjui-pageFooter">
    <ul>
        <li><button type="button" class="btn-close" data-icon="">取消</button></li>
        <li><button type="submit" class="btn-default">保存</button></li>
    </ul>
</div>



