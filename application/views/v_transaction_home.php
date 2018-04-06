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
					<li><a href="<?=base_url("/mainpage/index")?>">首頁</a> <span class="divider">/</span></li>
					<li class="active">買賣單管理</li>
				</ul>
			<div class="container-fluid">
				<div class="row-fluid">
				
					<div class="container-fluid">
						<div class="row-fluid">
								<style>
									form button
									{
										vertical-align: middle;
									}
								</style>
						<form action="<?=base_url("/Form/transaction_home")?>" method="get">
							<input text="text" name = "Search" value="" class="input-xlarge" placeholder="表單名稱">
							<button class="btn btn-primary">搜尋</button>
						</form>

								<div class="btn-toolbar">
									<a href="<?=base_url("/Form/create_transaction_view")?>"><button class="btn btn-primary" id="new_people"><i class="icon-plus"></i>新增</button></a>
								</div>
							<form action="<?=base_url("/Form/form_borad")?>" method="post">
								<div class="well">
									<table class="table sortable">
										<thead>
											<tr>
												<th><a href="./transaction_home?isorder=id&isby=<?=$this->data['isby'];?>">#</a></th>
												<th><a href="./transaction_home?isorder=name&isby=<?=$this->data['isby'];?>">表單名稱</a></th>
												<th><a href="#">狀態</a></th>
												<th><a href="./transaction_home?isorder=start_date&isby=<?=$this->data['isby'];?>">開始日期</a></th>
												<th><a href="./transaction_home?isorder=total_price&isby=<?=$this->data['isby'];?>">總價</a></th>
												<th><a href="#">剩餘款項</a></th>
												<th class="sorttable_nosort">檢視</th>
												<th class="sorttable_nosort">編輯</th>
												<th class="sorttable_nosort">刪除</th>
												<th class="sorttable_nosort">動作</th>
											</tr>
										</thead>
										<tbody>
					<?php
											if(count($this->data) != 0 )
											{
												$fristitem = $this->data['fristitem'];
												$itemmax = $this->data['itemmax'];
												for($j = 0; $fristitem < $itemmax;$j++)
												{
					?>							
												<tr>
													<td><?=$this->data[$j]->id;?></td>
													<td><a href="<?=base_url("/Form/transaction_home")?>?transaction_id=<?=$this->data[$j]->id;?>" ><?=$this->data[$j]->name;?></td>
													<td><?=$this->data[$j]->status;?></td>
													<td><?=$this->data[$j]->start_date;?></td>
													<td><?=number_format($this->data[$j]->total_price,0,'.',',');?></td>
													<td><?=number_format($this->data[$j]->left_money,0,'.',',');?></td>
													<td>
														<a href="<?=base_url("/Form/view_transaction_view")?>/transaction_id/<?=$this->data[$j]->id;?>" ><i class="icon-eye-open"></i></a>
													</td>
													<td>
														<a href="<?=base_url("/Form/edit_transaction_view")?>/transaction_id/<?=$this->data[$j]->id;?>" ><i class="icon-pencil"></i></a>
													</td>
													<td>
														<a href="<?=base_url("/Form/delete_transaction_model")?>/transaction_id/<?=$this->data[$j]->id;?>" ><i class="icon-remove"></i></a>
													</td>
													<td>
														<a href="<?=base_url("/Warranty/warranty_create_by_transaction/".$this->data[$j]->id."/".$this->data[$j]->elevator_num."")?>" <?php if(!$this->data[$j]->is_complete || $this->data[$j]->is_signing)echo 'hidden';?> >結單</a>
													</td>
												</tr>

					<?php						$fristitem++;
												}
											}
					?>
										</tbody>
									</table>
								</div>
							</form>
							
							<div class="pagination">
								<ul>
								
					<?php			if(count($this->data) != 0 )
									{
										$pagefrist = $this->data['pagefrist'];//第一頁
										$pagetotal = $this->data['pagetotal'];//共有幾頁
										$pageid = $this->data['pageid'];//第幾頁
										if($pagetotal > 1 )
										{
											if($pageid > 1 )
											{
												$idprev = $pageid - 1 ;
					?>
												<li><a href="<?=base_url("/Form/switch_page/".$idprev)?>">Prev</a></li>
					<?php	
											}
											else
											{
					?>
												<li><a href="<?=base_url("/Form/switch_page/".$pageid)?>">Prev</a></li>
					<?php					
											}
											for(;$pagefrist < $pagetotal;$pagefrist++)
											{
												$pageitemid = $pagefrist + 1 ;
					?>
												<li><a href="<?=base_url("/Form/switch_page/".$pageitemid)?>"><?=$pageitemid?></a></li>
					<?php
											}
											if($pageid == $pagetotal)
											{
					?>
												<li><a href="<?=base_url("/Form/switch_page/".$pageid)?>">Next</a></li>
					<?php
											}
											else
											{
												$idNext = $pageid + 1;
					?>
												<li><a href="<?=base_url("/Form/switch_page/".$idNext)?>">Next</a></li>
					<?php
											}
										}
									}
					?>									
									
								</ul>
							</div>
							<div class="modal small hide fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
									<h3 id="myModalLabel">Delete Confirmation</h3>
								</div>
								<div class="modal-body">
									<p class="error-text"><i class="icon-warning-sign modal-icon"></i>Are you sure you want to delete the user?</p>
								</div>
								<div class="modal-footer">
									<button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
									<button class="btn btn-danger" data-dismiss="modal">Delete</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script>
			public function onclik(i){
				$.cookie('project_id', i);
				$(this).closest('form').submit();
			}
		</script>
		<script type="text/javascript">
			$("[rel=tooltip]").tooltip();
			$(function() {
				$('.demo-cancel-click').click(function(){return false;});
			});
		</script>
	</body>
</html>





