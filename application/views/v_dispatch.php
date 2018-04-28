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
				
				<h1 class="page-title">派遣名單管理</h1>
			</div>
			
				<ul class="breadcrumb">
					<li><a href="<?=base_url("/mainpage/index")?>">首頁</a> <span class="divider">/</span></li>
					<li class="active">派遣名單管理</li>
				</ul>
			<div class="container-fluid">
				<div class="row-fluid">
				
					<div class="container-fluid">
						<div class="row-fluid">
							<form action="<?=base_url("/Distatch/form_borad")?>" method="post">
								<div class="well">
									<table class="table sortable">
										<thead>
											<tr>
												<th><a href="#">#</a></th>
												<th><a href="#">表單類型</a></th>
												<th><a href="#">表單名稱</a></th>
												<th><a href="#">派遣狀態</a></th>
												<th><a href="#">派遣人</a></th>
												<th><a href="#">被派遣人</a></th>
												<th class="sorttable_nosort">動作</th>
												<th class="sorttable_nosort">更換員工</th>
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
														<td><?=$this->data[$j]->type_name;?></td>
														<td><?=$this->data[$j]->table_name;?></td>
														<td><?=$this->data[$j]->status;?></td>
														<td><?=$this->data[$j]->dispatch_name;?></td>
														<td><?=$this->data[$j]->staff_name;?></td>
														<td>
															<a href="<?=base_url("/dispatch/check_done/dispatch_id/".$this->data[$j]->id."")?>" <?php if($this->data[$j]->is_finish != 3)echo 'hidden';?> >確認完成</a>
														</td>
														<td>
															<a href="<?=base_url("/dispatch/chage_staff_view")?>/dispatch_id/<?=$this->data[$j]->id;?>" ><i class="icon-pencil"></i></a>
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





