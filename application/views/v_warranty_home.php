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
				
				<h1 class="page-title">保固單管理</h1>
			</div>
			
				<ul class="breadcrumb">
					<li><a href="<?=base_url("/mainpage/index")?>">首頁</a> <span class="divider">/</span></li>
					<li class="active">保固單管理</li>
				</ul>
			<div class="container-fluid">
				<div class="row-fluid">
				
					<div class="container-fluid">
						<div class="row-fluid">
						<form action="<?=base_url("/Warranty/warranty_Search")?>" method="post">
								<table>
									<tr>
										<td><input type="text" name = "Search" value=""  class="input-xlarge"></td><td><button class="btn btn-primary" >搜尋</button></td>
									</tr>
								</table>
						</form>
								<div class="btn-toolbar">
									<a href="<?=base_url("/Warranty/create_warranty")?>"><button class="btn btn-primary" id="new_people"><i class="icon-plus"></i>新增</button></a>
								</div>
							<form action="<?=base_url("/Form/form_borad")?>" method="post">
								<div class="well">
									<table class="table sortable">
										<thead>
											<tr>
												<th><a href="#">客戶編號</a></th>
												<th><a href="#">客戶名稱</a></th>
												<th><a href="#">聯絡人</a></th>
												<th><a href="#">地址</a></th>
												<th><a href="#">電話</a></th>
												<th class="sorttable_nosort">編輯</th>
												<th class="sorttable_nosort">刪除</th>
											</tr>
										</thead>
										<tbody>
					<?php					if(count($this->data) != 0 )
											{
												$fristitem = $this->data['fristitem'];
												$itemmax = $this->data['itemmax'];	
												for($j = 0; $fristitem < $itemmax;$j++)	
												{
					?>	
													<tr>
														<td><?=$this->data[$j]->id;?></td>
														<td><?=$this->data[$j]->customer;?></td>
														<td><?=$this->data[$j]->contacter_1;?></td>
														<td><?=$this->data[$j]->address;?></td>
														<td><?=$this->data[$j]->tel_1;?></td>
														<td>
															<a href="<?=base_url("/Warranty/edit_warranty")?>/warranty_id/<?=$this->data[$j]->id;?>" ><i class="icon-pencil"></i></a>
														</td>
														<td>
															<a href="<?=base_url("/Warranty/delete_warranty")?>/warranty_id/<?=$this->data[$j]->id;?>" ><i class="icon-remove"></i></a>
														</td>
													</tr>
					<?php							$fristitem++;
												}
											}	
					?>
										</tbody>
									</table>
								</div>
							</form>
							
							<div class="pagination">
								<ul>
					<?php
											if(count($this->data) != 0 )
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
														<li><a href="<?=base_url("/Warranty/switch_page/".$idprev)?>">Prev</a></li>
					<?php	
													}
													else
													{
					?>
														<li><a href="<?=base_url("/Warranty/switch_page/".$pageid)?>">Prev</a></li>
					<?php					
													}
													for(;$pagefrist < $pagetotal;$pagefrist++)
													{
														$pageitemid = $pagefrist + 1 ;
					?>
											
														<li><a href="<?=base_url("/Warranty/switch_page/".$pageitemid)?>"><?=$pageitemid?></a></li>
									
					<?php
													}
													if($pageid == $pagetotal)
													{
					?>
														<li><a href="<?=base_url("/Warranty/switch_page/".$pageid)?>">Next</a></li>
					<?php
													}
													else
													{
														$idNext = $pageid + 1;
					?>
														<li><a href="<?=base_url("/Warranty/switch_page	/".$idNext)?>">Next</a></li>
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
							<footer>
								<hr>
								<!-- Purchase a site license to remove this link from the footer: http://www.portnine.com/bootstrap-themes -->
								<p class="pull-right">A <a href="http://www.portnine.com/bootstrap-themes" target="_blank">Free Bootstrap Theme</a> by <a href="http://www.portnine.com" target="_blank">Portnine</a></p>
								<p>&copy; 2012 <a href="http://www.portnine.com" target="_blank">Portnine</a></p>
							</footer>
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





