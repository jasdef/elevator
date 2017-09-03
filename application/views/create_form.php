	<!DOCTYPE html>
	<html lang="en">
		<?php
			include "head.php";
		?> 
		<body> 
			<script type='text/javascript'>

			function addOption(list, text, value)
			{
				var index=list.options.length;
				list.options[index]=new Option(text, value);
		
			}				
			
			</script>
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
								<label>表單類型</label>
								<select id="FormType" name="FormType" class="input-xlarge" onchange="location.href=<?php base_url("/form/create_form/")?>this.value">
									<option value = 1 <?php if ($this->data['formType'] == 1)echo "selected=\"selected\"";?>>買賣合約書</option>
									<option value = 2 <?php if ($this->data['formType'] == 2)echo "selected=\"selected\"";?>>保養合約書</option>
									<option value = 3 <?php if ($this->data['formType'] == 3) echo "selected=\"selected\"";?>>保固合約書</option>
								</select>
								
								<label>表單狀態</label>
								<select id="FormStatus" name="FormStatus" class="input-xlarge" >
									<option value = 0 selected="selected">請選擇表單狀態</option>
									<option value = 1>已開發票</option>
									<option value = 2>已送請款單</option>
									<option value = 3>已送請款單/發票</option>
									<option value = 4>尚未收款</option>
									<option value = 5>已收款</option>
								</select>
															
								<label>合約已回/未回</label>
								<select id="IsReturn" name="IsReturn" class="input-xlarge" >
									<option value = 1 selected="selected">未回</option>
									<option value = 2>已回</option>
								</select>							
								
								<label>電梯</label>
								<select id="Elevator" name="Elevator" class="input-xlarge" >
								<option value = 0 selected="selected">請選擇電梯型號</option>
								</select>
								<?php if ($this->data['elevator'] != 0)
								   {
									  
										foreach($this->data['elevator'] as $row)
										{										
								?>
									<script type='text/javascript'>
									addOption(document.getElementById("Elevator"), "<?php  echo $row->model;?>", "<?php echo $row->id;?>");
									
									</script>								
								<?php
										}
								   }
								?>
								
								<label>客戶</label>
								<select id="Customer" name="Customer" class="input-xlarge" >
								<option value = 0 selected="selected">請選擇客戶</option>
								</select>
								<?php 
								   if ($this->data['customer'] != 0)
								   {
									  
										foreach($this->data['customer'] as $row)
										{										
								?>
									<script type='text/javascript'>
									addOption(document.getElementById("Customer"), "<?php  echo $row->name;?>", "<?php echo $row->id;?>");
									
									</script>								
								<?php
										}
								   }
								?>	
								
								<?php
									if ($this->data['formType'] == 2) 
									{									
																			
								?>
										<label>單雙月</label>
										<select name="Month" id="Month" class="input-xlarge">
											<option value = 1 selected="selected">單月</option>
											<option value = 2>雙月</option>
										</select>
								<?php 
									}
								?>
								
								
								<?php
									if ($this->data['formType'] == 3) 
									{									
																			
								?>
										<label>保固期限(月)</label>
										<input type="text" name = "Warranty" value="12" class="input-xlarge">
								<?php 
									}
								?>														
								
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

			<script src="lib/bootstrap/js/bootstrap.js"></script>
			<script type="text/javascript">
				$("[rel=tooltip]").tooltip();
				$(function() {
					$('.demo-cancel-click').click(function(){return false;});
				});
			</script>
		</body>
	</html>


