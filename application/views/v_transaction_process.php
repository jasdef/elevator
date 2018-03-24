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

<div class="content">

    <div class="header">

        <h1 class="page-title">買賣單管理</h1>
    </div>

    <ul class="breadcrumb">
        <li><a href="<?= base_url("/mainpage/index") ?>">首頁</a> <span class="divider">/</span></li>
        <li class="active">買賣單管理</li>
    </ul>
    <div class="container-fluid">
        <div class="row-fluid">

            <div class="container-fluid">
                <div class="row-fluid">
                    <style>
                        form button {
                            vertical-align: middle;
                        }
                    </style>

                    <div class="btn-toolbar"></div>

                    <div class="well">
                        <h4><a href="<?=base_url("/Form/transaction_home")?>" >[買賣單]</a></h4>
                        <table class="table sortable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>表單名稱</th>
                                <th>狀態</th>
                                <th>開始日期</th>
                                <th class="sorttable_nosort">檢視</th>
                                <th class="sorttable_nosort">編輯</th>
                                <th class="sorttable_nosort">刪除</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($this->data['RowTransactiondata'])):?>
                                    <td><?=$this->data['RowTransactiondata']['id'] ?></td>
                                    <td><?=$this->data['RowTransactiondata']['name'] ?></td>
                                    <td><?=$this->data['RowTransactiondata']['status_sta'] ?></td>
                                    <td><?=$this->data['RowTransactiondata']['start_date'] ?></td>
                                    <td>
                                        <a href="<?=base_url("/Form/view_transaction_view")?>/transaction_id/<?=$this->data['RowTransactiondata']['id'];?>" ><i class="icon-eye-open"></i></a>
                                    </td>
                                    <td>
                                        <a href="<?=base_url("/Form/edit_transaction_view")?>/transaction_id/<?=$this->data['RowTransactiondata']['id'];?>" ><i class="icon-pencil"></i></a>
                                    </td>
                                    <td>
                                        <a href="<?=base_url("/Form/delete_transaction_model")?>/transaction_id/<?=$this->data['RowTransactiondata']['id'];?>" ><i class="icon-remove"></i></a>
                                    </td>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="well">
                        <h4>[保固單]</h4>
                        <table class="table sortable">
                            <thead>
                            <tr>
                                <th>保固單編號</th>
                                <th>買賣單名稱</th>
                                <th>客戶名稱</th>
                                <th>聯絡人</th>
                                <th>地址</th>
                                <th>電話</th>
                                <th class="sorttable_nosort">檢視</th>
                                <th class="sorttable_nosort">編輯</th>
                                <th class="sorttable_nosort">刪除</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(!empty($this->data['Warrantyldatalist'])):?>
                                <?php foreach ($this->data['Warrantyldatalist'] as $k=>$v):?>
                                    <tr>
                                        <td><a href="<?=base_url("/Form/transaction_home")?>?transaction_id=<?=$this->data['RowTransactiondata']['id'];?>&warranty_id=<?=$v['id']?>"><?=$v['id'] ?></a></td>
                                        <td><?=$this->data['RowTransactiondata']['id'] ?></td>
                                        <td><?=$v['customer'] ?></td>
                                        <td><?=$v['contacter_1'] ?></td>
                                        <td><?=$v['address'] ?></td>
                                        <td><?=$v['tel_1'] ?></td>
                                        <td>
                                            <a href="<?=base_url("/Warranty/view_warranty_view")?>/warranty_id/<?=$v['id'];?>" ><i class="icon-eye-open"></i></a>
                                        </td>
                                        <td>
                                            <a href="<?=base_url("/Warranty/edit_warranty")?>/warranty_id/<?=$v['id'];?>" ><i class="icon-pencil"></i></a>
                                        </td>
                                        <td>
                                            <a href="<?=base_url("/Warranty/delete_warranty")?>/warranty_id/<?=$v['id'];?>" ><i class="icon-remove"></i></a>
                                        </td>
                                        <td>
                                            <a href="<?=base_url("/Service/service_create_by_warranty/".$v['id']."")?>">產生保養單</a>
                                        </td>
                                    </tr>
                                <?php endforeach;?>
                            <?php else:?>
                                <tr><td colspan="7">查無資料</td></tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    </div>
                    <div class="modal small hide fade" id="myModal" tabindex="-1" role="dialog"
                         aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h3 id="myModalLabel">Delete Confirmation</h3>
                        </div>
                        <div class="modal-body">
                            <p class="error-text"><i class="icon-warning-sign modal-icon"></i>Are you sure you want to
                                delete the user?</p>
                        </div>
                        <div class="modal-footer">
                            <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
                            <button class="btn btn-danger" data-dismiss="modal">Delete</button>
                        </div>
                    </div>
                    <footer>
                        <hr>
                        <!-- Purchase a site license to remove this link from the footer: http://www.portnine.com/bootstrap-themes -->
                        <p class="pull-right">A <a href="http://www.portnine.com/bootstrap-themes" target="_blank">Free
                                Bootstrap Theme</a> by <a href="http://www.portnine.com" target="_blank">Portnine</a>
                        </p>
                        <p>&copy; 2012 <a href="http://www.portnine.com" target="_blank">Portnine</a></p>
                    </footer>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    public

    function onclik(i) {
        $.cookie('project_id', i);
        $(this).closest('form').submit();
    }
</script>
<script type="text/javascript">
    $("[rel=tooltip]").tooltip();
    $(function () {
        $('.demo-cancel-click').click(function () {
            return false;
        });
    });
</script>
</body>
</html>





