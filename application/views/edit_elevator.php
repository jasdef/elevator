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
					
					<h1 class="page-title">編輯電梯</h1>
				</div>
				
					<ul class="breadcrumb">
						<li><a href="<?=base_url("/mainpage/index")?>">首頁</a> <span class="divider">/</span></li>
						<li><a href="<?=site_url("/elevator/elevator_home")?>">電梯管理</a> <span class="divider">/</span></li>
						<li class="active">編輯電梯</li>
					</ul>

				<div class="container-fluid">
					<div class="row-fluid">
						<form id="tab" action="<?=site_url("/elevator/elevator_edit")?>" method="post">
							<div class="btn-toolbar">
								<button class="btn btn-primary" type="submit"><i class="icon-plus"></i>儲存</button>
								<button class="btn" type="button" onclick="history.back()">取消</button>
							</div>
							<div class="well">			
								<label>電梯編號</label>
								<input type="text" name = "Id" value="<?php print($this->data['id']);?>" readonly="readonly" class="input-xlarge">
								<label>電梯型號</label>
								<input type="text" name = "Model" value="<?php print($this->data['model']);?>" class="input-xlarge">
							</div>
						</form>
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
			<script type="text/javascript">
				var count=1;
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
					for(var i=0, n=checkboxes.length;i<=n;i++) 
					{
						if(i==n){
							count=count+1;
						}
						if((count%2)==0)
						{
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
				$(function() {
					$('.demo-cancel-click').click(function(){return false;});
				});
			</script>
		</body>
	</html>


