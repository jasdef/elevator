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
            <li><a href="<?=base_url("/mainpage/index")?>">首頁</a> <span class="divider">/</span></li>
            <li class="active">提醒事項</li>
        </ul>

        <div class="container-fluid">
            <div class="row-fluid">
                    


<div class="row-fluid">
    <div class="block span6">
        <a href="#tablewidget" class="block-heading" data-toggle="collapse">買賣單提醒</a>
        <div id="tablewidget" class="block-body collapse in">
            <table class="table sortable">
				<thead>
					<tr>
						<th><a href="#">#</a></th>												
						<th><a href="#">表單名稱</a></th>
						<th><a href="#">狀態</a></th>
						<th><a href="#">開始日期</a></th>
						<th><a href="#">總價</a></th>
						<th><a href="#">剩餘款項</a></th>
						<th class="sorttable_nosort">檢視</th>
						<th class="sorttable_nosort">編輯</th>
					</tr>
				</thead>
				<tbody>
<?php
					if(count($this->data) != 0 )
					{

						for($j = 0; $j < count($this->data['transaction']); $j++)
						{
?>							
						<tr>
							<td><?=$this->data['transaction'][$j]->id;?></td>
							<td><?=$this->data['transaction'][$j]->name;?></td>
							<td><?=$this->data['transaction'][$j]->status;?></td>
							<td><?=$this->data['transaction'][$j]->start_date;?></td>
							<td><?=$this->data['transaction'][$j]->total_price;?></td>
							<td><?=$this->data['transaction'][$j]->left_money;?></td>
							<td>
								<a href="<?=base_url("/Form/view_transaction_view")?>/transaction_id/<?=$this->data['transaction'][$j]->id;?>" ><i class="icon-eye-open"></i></a>
							</td>
							<td>
								<a href="<?=base_url("/Form/edit_transaction_view")?>/transaction_id/<?=$this->data['transaction'][$j]->id;?>" ><i class="icon-pencil"></i></a>
							</td>
						</tr>

<?php				
						}
					}
?>
				</tbody>
			</table>
        </div>
    </div>
    <div class="block span6">
        <a href="#widget1container" class="block-heading" data-toggle="collapse">簽約提醒 </a>
        <div id="tablewidget" class="block-body collapse in">
            <table class="table sortable">
				<thead>
					<tr>
						<th><a href="#">#</a></th>												
						<th><a href="#">表單名稱</a></th>
						<th><a href="#">狀態</a></th>
						<th><a href="#">開始日期</a></th>
						<th><a href="#">總價</a></th>
						<th><a href="#">剩餘款項</a></th>
						<th class="sorttable_nosort">檢視</th>
						<th class="sorttable_nosort">編輯</th>
					</tr>
				</thead>
				<tbody>
<?php
					if(count($this->data) != 0 )
					{

						for($j = 0; $j < count($this->data['transaction']); $j++)
						{
?>							
						<tr>
							<td><?=$this->data['transaction'][$j]->id;?></td>
							<td><?=$this->data['transaction'][$j]->name;?></td>
							<td><?=$this->data['transaction'][$j]->status;?></td>
							<td><?=$this->data['transaction'][$j]->start_date;?></td>
							<td><?=$this->data['transaction'][$j]->total_price;?></td>
							<td><?=$this->data['transaction'][$j]->left_money;?></td>
							<td>
								<a href="<?=base_url("/Form/view_transaction_view")?>/transaction_id/<?=$this->data['transaction'][$j]->id;?>" ><i class="icon-eye-open"></i></a>
							</td>
							<td>
								<a href="<?=base_url("/Form/edit_transaction_view")?>/transaction_id/<?=$this->data['transaction'][$j]->id;?>" ><i class="icon-pencil"></i></a>
							</td>
						</tr>

<?php				
						}
					}
?>
				</tbody>
			</table>
        </div>
    </div>
	
	
</div>

<div class="row-fluid">
    <div class="block span6">
        <div class="block-heading">
            <span class="block-icon pull-right">
                <a href="#" class="demo-cancel-click" rel="tooltip" title="Click to refresh"><i class="icon-refresh"></i></a>
            </span>

            <a href="#widget2container" data-toggle="collapse">本月保養名單(保固中)</a>
        </div>
        <div id="tablewidget" class="block-body collapse in">
            <table class="table sortable">
				<thead>
					<tr>
						<th><a href="#">#</a></th>												
						<th><a href="#">客戶名稱</a></th>
						<th><a href="#">簽約日期</a></th>
						<th><a href="#">已保養次數</a></th>
						<th><a href="#">剩餘保養次數</a></th>
						<th class="sorttable_nosort">檢視</th>
						<th class="sorttable_nosort">動作</th>
					</tr>
				</thead>
				<tbody>
<?php
					if(count($this->data) != 0 )
					{

						for($j = 0; $j < count($this->data['warranty']); $j++)
						{
?>							
						<tr>
							<td><?=$this->data['warranty'][$j]->id;?></td>
							<td><?=$this->data['warranty'][$j]->contacter_1;?></td>
							<td><?=$this->data['warranty'][$j]->effective_date;?></td>
							<td><?=$this->data['warranty'][$j]->warranty_times;?></td>
							<td><?=$this->data['warranty'][$j]->left_times;?></td>
							<td>
								<a href="<?=base_url("/Form/view_transaction_view")?>/transaction_id/<?=$this->data['transaction'][$j]->id;?>" ><i class="icon-eye-open"></i></a>
							</td>
							<td>
								<a href="<?=base_url("/Form/edit_transaction_view")?>/transaction_id/<?=$this->data['transaction'][$j]->id;?>" ><i class="icon-pencil"></i></a>
							</td>
						</tr>

<?php				
						}
					}
?>
				</tbody>
			</table>
        </div>
    </div>
    <div class="block span6">
        <p class="block-heading">公告</p>
        <div class="block-body">
            <h2>Built with Less</h2>
            <p>The CSS is built with Less. There is a compiled version included if you prefer plain CSS.</p>
            <p>Fava bean jícama seakale beetroot courgette shallot amaranth pea garbanzo carrot radicchio peanut leek pea sprouts arugula brussels sprout green bean. Spring onion broccoli chicory shallot winter purslane pumpkin gumbo cabbage squash beet greens lettuce celery. Gram zucchini swiss chard mustard burdock radish brussels sprout groundnut. Asparagus horseradish beet greens broccoli brussels.</p>
            <p><a class="btn btn-primary btn-large">Learn more &raquo;</a></p>
        </div>
    </div>
</div>
                   
                    <footer>
                        <hr>

                        <!-- Purchase a site license to remove this link from the footer: http://www.portnine.com/bootstrap-themes -->
                        <p class="pull-right">A <a href="http://www.portnine.com/bootstrap-themes" target="_blank">Free Bootstrap Theme</a> by <a href="http://www.portnine.com" target="_blank">Portnine</a></p>

                        <p>&copy; 2012 <a href="http://www.portnine.com" target="_blank">Portnine</a></p>
                    </footer>
                    
            </div>
        </div>
    </div>
    


    <script src="lib/bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript">
        $("[rel=tooltip]").tooltip();
        $(function() {
            $('.demo-cancel-click').click(function(){return false;});
        });
    </script>
    
  </body>
</html>


