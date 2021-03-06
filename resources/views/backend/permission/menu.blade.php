<meta name="_token" content="{!! csrf_token() !!}"/>
<div class="bjui-pageContent">
    <div class="box-body">
        <button id="check-all-true" type="button" class="btn btn-sm btn-flat btn-info">全部选择</button>
        <button id="check-all-false" type="button" class="btn btn-sm btn-flat btn-warning">取消选择</button>
    </div>
    <div class="box-body">

             <ul id="tree" class="ztree"></ul>

    </div>
</div>
<div class="bjui-pageFooter">
    <ul>
        <li><button type="button"  class="btn-close" data-icon="">取消</button></li>
        <li><button type="submit" id='savemenupermission' class="btn-default">保存</button></li>
    </ul>
</div>
<script type="text/javascript">
    var id = {{ $id }};
    var nodes = {!! $data !!};
    var setting = {
        check: {
            enable: true,
            chkboxType: {"Y": "ps", "N": "ps"}
        },
        data: {
            simpleData: {
                enable: true
            }
        }
    };

    $(document).ready(function () {
        $.fn.zTree.init($("#tree"), setting, nodes);
        var zTree = $.fn.zTree.getZTreeObj("tree");

        $('#check-all-true').click(function () {
            zTree.checkAllNodes(true);
        });

        $('#check-all-false').click(function () {
            zTree.checkAllNodes(false);
        });

        $(document).ready(function () {
            $.fn.zTree.init($("#tree"), setting, nodes);
            var zTree = $.fn.zTree.getZTreeObj("tree");

            $('#check-all-true').click(function () {
                zTree.checkAllNodes(true);
            });

            $('#check-all-false').click(function () {
                zTree.checkAllNodes(false);
            });

            $('#savemenupermission').click(function () {
                var tree = zTree.getCheckedNodes(true);

                var menus = [];
                for (var i = 0; i < tree.length; i++) {
                    menus.push(tree[i].id);
                }
                $(this).bjuiajax('doAjax',{
                    url:"{{route('backend.permission.associate.menus')}}",
                    data:{id:id,menus: menus},
                    loadingmask:true
                })
            });
        });

    });


   $.ajaxSetup({
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
    });

</script>


