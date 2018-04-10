<!DOCTYPE html>
<html lang="en">
<?php
include "head.php";
?>
<body>
<?php
include "navbar.php";
include "sidebar-nav.php";
?>

<link rel="stylesheet" href="<?= base_url("js/jquery/jquery-ui.min.css"); ?>">
<script src="<?= base_url("js/jquery/jquery.min.js"); ?>"></script>
<script src="<?= base_url("js/jquery/jquery-ui.min.js"); ?>"></script>
<link rel="stylesheet" href="jqueryui/style.css">

<script>
    function ondeleteqwe(id, text, warranty_id) {
        if (confirm("確認刪除 [" + text + "] ")) {
            document.location.href = "<?=base_url("/Warranty/delete_imgadd")?>?id=" + id + "&warranty_id=" + warranty_id;
        }
    }
</script>
<script>
    $(function () {
        $("#datepicker").datepicker({
            showOn: "button",
            buttonImage: "<?=base_url("images/calendar.png");?>",//"../images/calendar.png"亦可執行
            buttonImageOnly: true


        });
        $("#datepicker").change(function () {
            $("#datepicker").datepicker("option", "dateFormat", "yy/mm/dd");
        });
    });
</script>

<div class="content">

    <div class="header">

        <h1 class="page-title">編輯保固單</h1>
    </div>

    <ul class="breadcrumb">
        <li><a href="<?= base_url("/mainpage/index") ?>">首頁</a> <span class="divider">/</span></li>
        <li><a href="<?= site_url("/warranty/warranty_home") ?>">保固單管理</a> <span class="divider">/</span></li>
        <li class="active">編輯保固單</li>
    </ul>

    <ul class="nav nav-tabs">
        <li class="active"><a href="#view_admin_group" data-toggle="tab">管理者權限</a></li>
        <li><a href="#view_finance_group" data-toggle="tab">財務權限</a></li>
        <li><a href="#view_employee_group" data-toggle="tab">人員權限</a></li>
    </ul>

    <div class="container-fluid">
        <div class="row-fluid">
            <div id="myTabContent" class="tab-content">
                <?php foreach($this->data['tabPane'] as $vTabPane): ?>
                <div class="tab-pane <?=$vTabPane=='admin_group'?'active':'' ?> in" id="<?='view_'.$vTabPane ?>">
                    <div class="span8">
                        <div class="well">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>主菜單管理</th>
                                    <th>子菜單管理</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($this->data['list'] as $k=>$v): ?>
                                <tr>
                                    <td><?=$v['menuid']?></td>
                                    <td>
                                        <label class="checkbox inline">
                                            <input type="checkbox" id="inlineCheckbox" name="sport[]" value="<?=$v['menuid']?>"  <?=$v[$vTabPane]==1?'checked':''?> > <?=$v['title']?>
                                        </label>
                                    </td>
                                    <td>
                                        <ul class="unstyled">
                                        <?php foreach ($v['sub'] as $k1=>$v1):?>
                                        <li>
                                            <label class="checkbox inline">
                                                <input type="checkbox" id="inlineCheckbox" name="sport[]" value="<?=$v1['menuid']?>" <?=$v[$vTabPane]==1?'checked':''?>> <?=$v1['title']?>
                                            </label>
                                        </li>
                                        <?php endforeach;?>
                                        </ul>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php endforeach;?>
            </div>
            <div class="modal small hide fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                 aria-hidden="true">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 id="myModalLabel">Delete Confirmation</h3>
                </div>
                <div class="modal-body">
                    <p class="error-text"><i class="icon-warning-sign modal-icon"></i>Are you sure you want to delete
                        the user?</p>
                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
                    <button class="btn btn-danger" data-dismiss="modal">Delete</button>
                </div>
            </div>


        </div>
    </div>
</div>
<script type="text/javascript">
    var count = 1;

    function OneClick() {
        document.getElementById('test').disabled = true;
        document.getElementById('new_people').disabled = false;
    }

    function OneClick1() {
        document.getElementById('test').disabled = false;
        document.getElementById('new_people').disabled = false;
    }

    function OneClick2() {
        document.getElementById('test').disabled = true;
        document.getElementById('new_people').disabled = true;
    }

    function checkall() {
        checkboxes = document.getElementsByName('selected');
        for (var i = 0, n = checkboxes.length; i <= n; i++) {
            if (i == n) {
                count = count + 1;
            }
            if ((count % 2) == 0) {
                checkboxes[i].checked = false;
            }
            elseSubjects
            {
                checkboxes[i].checked = true;
            }

        }
    }
</script>
<script src="lib/bootstrap/js/bootstrap.js"></script>
<script type="text/javascript">
    $("[rel=tooltip]").tooltip();
    $(function () {
        $('.demo-cancel-click').click(function () {
            return false;
        });
    });
</script>

<script> //新增欄位 java script
    var countMin = 1;
    var contMin =<?php echo $this->data['contacter_count'];?>;
    var TelMin = <?php echo $this->data['tel_count'];?>;
    var faxMin = <?php echo $this->data['fax_count'];?>;
    var divname;
    $("#cont_bnt").click(function () //聯絡人欄位新增
    {
        var contname = "contacter_";
        var Fieldvarle;
        var insdivname = "" + contname + contMin;
        if (edit_custiner.contacter_1.value != "") {
            Fieldvarle = 1;
            if (divname == insdivname) {
                if (edit_custiner.contacter_2.value != "") {
                    Fieldvarle = 1;
                }
                else {
                    Fieldvarle = 0;
                }
            }
        }
        else {
            Fieldvarle = 0;
        }
        if (Fieldvarle != 0) {
            if (contMin < 3) {
                contMin++;
                divname = "" + contname + contMin;
                $("#contacter_").append('<div id="' + contname + contMin + '">聯絡人' + contMin + '<br><input type="text" name="contacter_' + contMin + '" value="" class="input-xlarge" /> </div>');
            }
            else {
                alert("最多3個欄位");
            }
        }
        else {
            alert("欄位為空值");
        }
    });

    $("#tel_bnt").click(function () //電話欄位新增
    {
        var telname = "tel_";
        var Fieldvarle;
        var insdivname = "" + telname + TelMin;
        if (edit_custiner.tel_1.value != "") {
            Fieldvarle = 1;
            if (divname == insdivname) {
                if (edit_custiner.tel_2.value != "") {
                    Fieldvarle = 1;
                }
                else {
                    Fieldvarle = 0;
                }
            }
        }
        else {
            Fieldvarle = 0;
        }
        if (Fieldvarle != 0) {
            if (TelMin < 3) {
                TelMin++;
                divname = "" + telname + TelMin;
                $("#tel_").append('<div id="' + telname + TelMin + '">電話' + TelMin + '<br><input type="text" name="tel_' + TelMin + '" value="" class="input-xlarge" /> </div>');
            }
            else {
                alert("最多3個欄位");
            }
        }
        else {
            alert("欄位為空值");
        }
    });
    $("#fax_bnt").click(function () //傳真欄位新增
    {
        var faxname = "fax_";
        var Fieldvarle;
        var insdivname = "" + faxname + faxMin;
        if (edit_custiner.fax_1.value != "") {
            Fieldvarle = 1;
            if (divname == insdivname) {
                if (edit_custiner.fax_2.value != "") {
                    Fieldvarle = 1;
                }
                else {
                    Fieldvarle = 0;
                }
            }
        }
        else {
            Fieldvarle = 0;
        }
        if (Fieldvarle != 0) {
            if (faxMin < 3) {
                faxMin++;
                divname = "" + faxname + faxMin;
                $("#fax_").append('<div id="' + faxname + faxMin + '">傳真' + faxMin + '<br><input type="text" name="fax_' + faxMin + '" value="" class="input-xlarge" /> </div>');
            }
            else {
                alert("最多3個欄位");
            }
        }
        else {
            alert("欄位為空值");
        }
    });

    function delField(name) //刪除欄位
    {
        if (name == "contacter_") {
            count = contMin;
            if (contMin > 1) {
                contMin--;
            }
        }
        else if (name == "address_") {
            count = AddrMin;
            if (AddrMin > 1) {
                AddrMin--;
            }
        }
        else if (name == "tel_") {
            count = TelMin;
            if (TelMin > 1) {
                TelMin--;
            }
        }
        else if (name == "fax_") {
            count = faxMin;
            if (faxMin > 1) {
                faxMin--;
            }
        }
        if (count > countMin) {
            $("#" + name + count).remove();

        }
        else {
            alert("無新增欄位可以刪除");
        }
    }
</script>
</body>
</html>

