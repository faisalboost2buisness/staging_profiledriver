<style>

    .button{
        font-size: 11px;
    }
    .list > li, .list-link {
        padding: 0px 0;
    }
    .topsort{
        float: left;
        margin-top: 131px;
        position: absolute;
        top: 22px;
        width: 893px;
        z-index: 14;
    }
    #select_member{
        width:120px;
    }

    .ui-jqgrid-htable th{
        background: -moz-linear-gradient(center top , #efeff4, #d6dadf) repeat scroll 0 0 rgba(0, 0, 0, 0) !important;
        border-color: #cccccc !important;
        color: #666666 !important;
        border: 1px solid #cccccc !important;
        box-shadow: 1px 0 0 rgba(255, 255, 255, 0.85) inset, 0 1px 0 rgba(255, 255, 255, 0.85) inset !important;
        padding: 9px 5px !important;
        vertical-align: middle !important;
    }
    #roles_table > tbody > tr > th, #roles_table > tbody > tr > td,
    #resources_table > tbody > tr > th, #resources_table > tbody > tr > td,
    #rules_table > tbody > tr > th, #rules_table > tbody > tr > td,
    #sessions_table > tbody > tr > th, #sessions_table > tbody > tr > td
    {
        border-left: 1px dotted #cfcfcf;
        border-top: 1px solid #e6e6e6;
        border-right: 1px solid #e6e6e6;
        padding: 9px 5px;
        font-family: Arial,Helvetica,sans-serif !important;
        font-size: 13px !important;
        line-height: 16px !important;
        color:#666666 !important;
    }
    .ui-jqgrid .ui-jqgrid-htable th div{
        font-family: Arial,Helvetica,sans-serif !important;
        font-size: 13px !important;
        line-height: 16px !important;
        color:#666666 !important;
        font-weight: bold !important;
    }
    #roles_table tr:nth-child(odd),
    #resources_table tr:nth-child(odd),
    #rules_table tr:nth-child(odd),
    #sessions_table tr:nth-child(odd)
    {
        background-color: #ffffff !important;
        background-image: none !important;
    }
    #roles_table tr:nth-child(even),
    #resources_table tr:nth-child(even),
    #rules_table tr:nth-child(even),
    #sessions_table tr:nth-child(even)
    {
        background-color: #f7f7f7 !important;
        background-image: none !important;
    }
    .jqgfirstrow{
        height: 2px !important;
    }
    .ui-jqgrid .ui-jqgrid-pager{
        background: -moz-linear-gradient(center top , #086068, #086068) repeat scroll 0 0 rgba(0, 0, 0, 0) !important;
        color: white !important;
        height: 50px !important;
    }
    .ui-jqgrid .ui-pg-table td{
        padding: 7px !important;
        font-size: 13px;
        font-family: Arial,Helvetica,sans-serif !important;
    }
    .ui-tabs .ui-tabs-panel{
        padding-left: 0 !important;
        padding-right: 0 !important;
    }
    #header_cb{
        background-image: none !important;
    }

    .ui-widget-header{
        background: -moz-linear-gradient(center top , #086068, #086068) repeat scroll 0 0 rgba(0, 0, 0, 0) !important;
        color: white !important;;
        border: 1px solid #086068 !important;;
        border-radius: 10px 10px 0 0 !important;;
        box-shadow: 0 1px 0 rgba(255, 255, 255, 0.35) inset !important;
        height: 51px !important;
    }
    #delhdrules_table.ui-widget-header{
        height: 20px !important;
    }
    .cizacl_tabs{
        border: none !important;
        background: none !important;
    }
    .ui-tabs .ui-tabs-nav li a{
        padding: 17px 20px 16px !important;
    }
    .ui-tabs .ui-tabs-panel{
        padding-top: 0 !important;
    }
    .cizacl_tabs .button.glossy, .cizacl_tabs .glossy > .select-value, .cizacl_tabs .glossy > .select-arrow {
        background: -moz-linear-gradient(center top , #f5f5f7, #dededf 50%, #d1d1d2 50%, #dcdce0) repeat scroll 0 0 rgba(0, 0, 0, 0) !important;
        border-color: #cccccc !important;
        color: #666666 !important;
    }
    .ui-tabs .ui-tabs-nav li a, .ui-tabs.ui-tabs-collapsible .ui-tabs-nav li.ui-tabs-selected a {
        font-size: 13px !important;
        font-family: Arial,Helvetica,sans-serif !important;
    }

    .button_container{
        left: auto;
        position: absolute;
        right: 0;
        top: 20px;
    }

    .ui-tabs .ui-tabs-nav li.ui-tabs-selected a, .ui-tabs .ui-tabs-nav li.ui-state-disabled a, .ui-tabs .ui-tabs-nav li.ui-state-processing a{
        color:#808080 !important;
    }
    #roles_table tr.ui-state-highlight, #resources_table tr.ui-state-highlight, #rules_table tr.ui-state-highlight {
        background: url("images/ui-bg_highlight-soft_75_ffe45c_1x100.png") repeat-x scroll 50% top #FFCB68 !important;
        border: 1px solid #fed22f;
        color: #363636;
    }
    .inline-small-label > .label{
        margin-left: 0 !important;
        width: 110px !important;
    }
    .ui-pg-selbox{
        width: 40px !important;
        height: 20px !important;
    }
    .ui-pg-input{
        width: 22px !important;
        height: 20px !important;
    }
    .styled-select select{
        width: 115px !important;
        -moz-appreance:none;
        -webkit-appearance:none;
    }
    .resource_op .inline-small-label > .label{
        width: 225px !important;
    }
</style>
<script type="text/javascript" src="<?=base_url()?>js/libs/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/jquery.ui.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/setup.js"></script>
<!-- Template functions -->
<script type="text/javascript" src="<?=base_url()?>js/developr.input.js"></script>
<script type="text/javascript"src="<?=base_url()?>js/developr.navigable.js"></script>
<script type="text/javascript"src="<?=base_url()?>js/developr.notify.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/developr.scroll.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/developr.tooltip.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/developr.table.js"></script>
<!-- Plugins -->
<script type="text/javascript" src="<?=base_url()?>js/libs/jquery.tablesorter.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/libs/DataTables/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    /*$(document).ready(function(){

    });*/
    $(window).on("resize", function () {
        console.log('window resize');
        var $grid = $("#roles_table"),
        newWidth = $grid.closest(".ui-jqgrid").parent().width();
        $grid.setGridWidth(newWidth);

        var $grid = $("#resources_table"),
        newWidth = $grid.closest(".ui-jqgrid").parent().width();
        $grid.setGridWidth(newWidth);

        var $grid = $("#rules_table"),
        newWidth = $grid.closest(".ui-jqgrid").parent().width();
        $grid.setGridWidth(newWidth);
    });

</script>