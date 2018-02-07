	<div class="sidebar-nav">
        <?php 
			if($_SESSION["permission"] == 1 || $_SESSION["permission"] == 2) {
		?>
		<a href="#forms-menu" class="nav-header" data-toggle="collapse"><i class="icon-list"></i>表單管理</i></a>
		
		<ul id="forms-menu" class="nav nav-list collapse in">
            <li ><a href="<?=base_url("/form/transaction_home")?>"><i class="icon-caret-right"></i>買賣單</a></li>
            <li ><a href="<?=base_url("/Warranty/warranty_home")?>"><i class="icon-caret-right"></i>保固單</a></li>
            <li ><a href="<?=base_url("/service/service_home")?>"><i class="icon-caret-right"></i>保養名冊</a></li>
            <li ><a href="<?=base_url("/form/upload")?>"><i class="icon-caret-right"></i>新增上傳檔案</a></li>
        </ul>
		
			
		<a href="#elevator-menu" class="nav-header" data-toggle="collapse"><i class="icon-folder-open"></i>電梯管理</i></a>
        <ul id="elevator-menu" class="nav nav-list collapse in">
            <li ><a href="<?=base_url("/elevator/elevator_home")?>">電梯列表</a></li>
		</ul>
		
		<a href="#customer-menu" class="nav-header" data-toggle="collapse"><i class="icon-book"></i>客戶管理</i></a>
        <ul id="customer-menu" class="nav nav-list collapse in">
            <li ><a href="<?=base_url("/customer/customer_home")?>">客戶列表</a></li>
		</ul>
		
		<a href="#personal-menu" class="nav-header" data-toggle="collapse"><i class="icon-user"></i>人員管理</i></a>
        <ul id="personal-menu" class="nav nav-list collapse in">
            <li ><a href="<?=base_url("/personal/personal_home")?>">人員列表</a></li>
		</ul>

		
		<?php
			}
			else if($_SESSION["permission"] == 3) {
		?>
		<a href="#" class="nav-header" data-toggle="collapse"><i class="icon-user"></i>權限</a>
        <ul id="dashboard-menu" class="nav nav-list collapse in">
            <li ><a href="<?=base_url("/userapplication/users")?>">權限申請狀況</a></li>
			<li ><a href="<?=base_url("/userapplication/usersadmin")?>">權限管理</a></li>
        </ul>

        <a href="#" class="nav-header" data-toggle="collapse"><i class="icon-folder-open"></i>專案</i></a>
        <ul id="accounts-menu" class="nav nav-list collapse in">
            <li ><a href="<?=base_url("/projectadmin/project_home")?>">專案管理</a></li>
            <li ><a href="#">受測名單</a></li>
        </ul>
		
        <a href="#" class="nav-header" data-toggle="collapse"><i class="icon-list-ol"></i>規則</a>
        <ul id="rule-menu" class="nav nav-list collapse in">
            <li ><a href="<?=base_url("/rulelist/rulelistshow")?>">規則清單</a></li>
        </ul>
		
		<a href="#" class="nav-header" data-toggle="collapse"><i class="icon-search"></i>追蹤</a>
        <ul id="track-menu" class="nav nav-list collapse in">
            <li ><a href="<?=base_url("/usertrack/usertracking")?>">追蹤名單</a></li>
        </ul>
		
        <a href="#" class="nav-header" data-toggle="collapse"><i class="icon-th-list"></i>圖表</a>
        <ul id="legal-menu" class="nav nav-list collapse in">
            <li ><a href="#">評測結果</a></li>
            <li ><a href="<?=base_url("/projectadmin/excel")?>">匯出檔案</a></li>
        </ul>
		<?php
			}
			else{
		?>
		<a href="#accounts-menu" class="nav-header collapsed" data-toggle="collapse"><i class="icon-folder-open"></i>表單</i></a>
        <ul id="accounts-menu" class="nav nav-list collapse in">
            <li ><a href="<?=base_url("/projectadmin/project_home")?>">表單管理</a></li>
        </ul>	
		
		<a href="#" class="nav-header collapsed" data-toggle="collapse"><i class="icon-folder-open"></i>電梯</i></a>
        <ul id="accounts-menu" class="nav nav-list collapse in">
            <li ><a href="<?=base_url("/projectadmin/project_home")?>">電梯管理</a></li>
        </ul>
		<?php
			}
		?>
    </div>