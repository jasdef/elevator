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
				
				<h1 class="page-title">表單管理</h1>
			</div>
			
				<ul class="breadcrumb">
					<li><a href="<?=base_url("/mainpage/index")?>">首頁</a> <span class="divider">/</span></li>
					<li class="active">表單管理</li>
				</ul>
			<div class="container-fluid">
				<div class="row-fluid">
				
					<div class="container-fluid">
						<div class="row-fluid">
								<div class="btn-toolbar">
									<a href="<?=base_url("/Form/create_form")?>"><button class="btn btn-primary" id="new_people"><i class="icon-plus"></i>新增</button></a>
								</div>
							<form action="<?=base_url("/Form/form_borad")?>" method="post">
								<div class="well">
									<table class="table sortable">
										<thead>
											<tr>
												<th><a href="#">#</a></th>
												<th><a href="#">表單名稱</a></th>
												<th><a href="#">單雙月</a></th>
												<th><a href="#">開始日期</a></th>
												<th><a href="#">電梯型號</a></th>
												<th class="sorttable_nosort">編輯</th>
												<th class="sorttable_nosort">刪除</th>
											</tr>
										</thead>
										<tbody>
										<?php
										//echo $id1234=$_SESSION["pagesheet"];
										//if($_SESSION["pagesheet"]!=null)
											$id=$_SESSION["pagesheet"];
										//else
											//$id=1;
										
											if ($this->data != 0) 
											{		
													$i=count($this->data);	
													$j=($id-1)*10;
													$o=$id*10;
													//echo $i;
													
												foreach($this->data as $row)
												{ $k1234=$row->id;
													//echo $k1234;
													if($k1234<=$j)
													 $row->id;
												else	
												if($k1234<=$o){
													
										?>
											<tr>
												<td><?=$row->id;?></td>
												<td><?=$row->month;?></td>
												<td><?=$row->start_date;?></td>
												<td><?=$row->end_date;?></td>
												<td><?=$row->permission_date;?></td>
												<td>
													<a href="<?=base_url("/projectview_admin/project_board")?>/project_id/<?=$row->id;?>" ><i class="icon-pencil"></i></a>
													<a href="<?=base_url("/projectview_admin/project_board")?>/project_id/<?=$row->id;?>" ><i class="icon-remove"></i></a>
												</td>
											</tr>
												<?php
												}
												//$j++;
												}// endforeach;
											}?>
										</tbody>
									</table>
								</div>
							</form>
							
							<div class="pagination">
								<ul>
								
								<?php
								if ($this->data != 0) 
								{	
									$k=count($this->data);
									//$data123=$_SESSION;
									if($k>=10)
									{if($k%10!=0){
										$l=$k/10+1;
										$l= floor($l);
									}else{
									$l=$k/10;}
									//echo $l;
									if($l>1){
										if($id>1){
											$idprev=$id-1;
										?>
										<li><a href="<?=base_url("/Form/pagesheet/".$idprev)?>">Prev</a></li>
								<?php	
										}else{
										?>
									<li><a href="<?=base_url("/Form/pagesheet/".$id)?>">Prev</a></li>
										<?php	}
										$mn=ceil($id/10);
										//$l=21;
									if($l>10 )
									{	
										
										$mnum=floor(($id-1)/10);
										$m=$mnum*10;
										$l2=($mnum+1)*10;
										
										if($l2>$l)
											$l2=$l;

									}
									else
									{
										$l2=$l;
										$m=0;
									}
										
								for($m;$m<$l2;$m++){
									$n=$m+1;
								?>
											
									<li><a href="<?=base_url("/Form/pagesheet/".$n)?>"><?=$n?></a></li>
									
								<?
									}
									if($id==$l){
									?>
									<li><a href="<?=base_url("/Form/pagesheet/".$id)?>">Next</a></li>
									<?}else{
										$idNext=$id+1;
										?>
									<li><a href="<?=base_url("/Form/pagesheet/".$idNext)?>">Next</a></li>
									<?}
									}}
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





