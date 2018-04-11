<!DOCTYPE html>
<html lang="en">
<?php
include "head.php";
?>

<body class="">
<!--<![endif]-->
<?php
include "navbar.php";
include "sidebar-nav.php";
?>


<div class="content">

    <div class="header">
        <div class="stats">
            <p class="stat"><span class="number">53</span>tickets</p>
            <p class="stat"><span class="number">27</span>tasks</p>
            <p class="stat"><span class="number">15</span>waiting</p>
        </div>

        <h1 class="page-title">提醒事項</h1>
    </div>

    <ul class="breadcrumb">
        <li><a href="<?= base_url("/mainpage/index") ?>">首頁</a> <span class="divider">/</span></li>
        <li class="active">提醒事項</li>
    </ul>

    <div class="container-fluid">
        <div class="row-fluid">

            <?php
            include "{$this->data['group']}.php";
            ?>

        </div>
    </div>
</div>


<script src="lib/bootstrap/js/bootstrap.js"></script>
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


