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
					
					<h1 class="page-title">新增表單</h1>
				</div>
				
					<ul class="breadcrumb">
						<li><a href="<?=base_url("/mainpage/index")?>">首頁</a> <span class="divider">/</span></li>
						<li><a href="<?=site_url("/form/form_home")?>">表單管理</a> <span class="divider">/</span></li>
						<li class="active">新增表單</li>
					</ul>

				<div class="container-fluid">
					<div class="row-fluid">
						<form id="tab" action="<?=site_url("/form/form_create")?>" method="post">
							<div class="btn-toolbar">
								<button class="btn btn-primary" type="submit"><i class="icon-plus"></i>新增</button>
								<a href=""<?=base_url("/form/form_home")?>""><button class="btn ">取消</button></a>
							</div>
							<div class="well">
								<label>電梯</label>
								<select name="Elevator" id="Elevator" class="input-xlarge">
									<option value = 1 selected="selected">單月</option>
									<option value = 2>雙月</option>
								</select>
								<label>單雙月</label>
								<select name="Month" id="Month" class="input-xlarge">
									<option value = 1 selected="selected">單月</option>
									<option value = 2>雙月</option>
								</select>
								<label>簽約日(西元yyyy/mm/dd)</label>
								<input type="text" name = "Start_date" value="1990/05/01" class="input-xlarge">
								<label>到期日(西元yyyy/mm/dd)</label>
								<input type="text" name = "End_date" value="1990/05/01" class="input-xlarge">
								<label>許可證到期日(西元yyyy/mm/dd)</label>
								<input type="text" name = "Permission_date" value="1990/05/01" class="input-xlarge">
								<label>價錢</label>
								<input type="text" name = "Price" value="0" class="input-xlarge">
								<label>收款提醒(間隔幾個月)</label>
								<input type="text" name = "Remind" value="0" class="input-xlarge">
								<label>統一編號</label>
								<input type="text" name = "Num" value="0" class="input-xlarge">
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


