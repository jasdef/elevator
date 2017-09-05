	<!DOCTYPE html>
	<html lang="en">
		<?php
			include "head.php";
		?> 
		<body> 
			<script type='text/javascript'>

			function addOption(list, text, value, selectIndex)
			{
				var index=list.options.length;
				list.options[index]=new Option(text, value);
				if (selectIndex != 0)
					list.selectedIndex = index;
			}				
			
			function hideObject(formType)
			{
				if (formType == 1)
				{				
					document.getElementById("WarrantyName").style.visibility = "hidden";
					document.getElementById("Warranty").style.visibility = "hidden";
					document.getElementById("Month").style.visibility = "hidden";
					document.getElementById("MonthName").style.visibility = "hidden";
				}
				
				
				if (formType == 2)
				{				
					document.getElementById("WarrantyName").style.visibility = "hidden";
					document.getElementById("Warranty").style.visibility = "hidden";
					document.getElementById("Month").style.visibility = "visible";
					document.getElementById("MonthName").style.visibility = "visible";
				}
					
				if (formType == 3) 
				{
					document.getElementById("WarrantyName").style.visibility = "visible";
					document.getElementById("Warranty").style.visibility = "visible";
					document.getElementById("Month").style.visibility = "hidden";
					document.getElementById("MonthName").style.visibility = "hidden";					
				}
			}
			
			
			</script>
			<?php
				include "navbar.php";
				include "sidebar-nav.php";
			?>
		
			<div class="content">
				
				<div class="header">
					
					<h1 class="page-title">編輯表單</h1>
				</div>
				
					<ul class="breadcrumb">
						<li><a href="<?=base_url("/mainpage/index")?>">首頁</a> <span class="divider">/</span></li>
						<li><a href="<?=site_url("/form/form_home")?>">表單管理</a> <span class="divider">/</span></li>
						<li class="active">編輯表單</li>
					</ul>

				<div class="container-fluid">
					<div class="row-fluid">
						<form id="tab" action="<?=site_url("/form/form_edit")?>" method="post">
							<div class="btn-toolbar">
								<button class="btn btn-primary" type="submit"><i class="icon-plus"></i>儲存</button>
								<a href=""<?=base_url("/form/form_home")?>""><button class="btn ">取消</button></a>
							</div>
							<div class="well">
								<label>表單編號</label>
								<input type="text" name = "Id" value="<?php print($this->data['id']);?>" readonly="readonly" class="input-xlarge">
								
								<label>表單類型</label>
								<select id="FormType" name="FormType" class="input-xlarge" onchange="location.href=<?php base_url("/form/create_form/")?>this.value">			
									<option value = 1 <?php if ($this->data['form_type'] == 1)echo "selected=\"selected\"";?>>買賣合約書</option>
									<option value = 2 <?php if ($this->data['form_type'] == 2)echo "selected=\"selected\"";?>>保養合約書</option>
									<option value = 3 <?php if ($this->data['form_type'] == 3) echo "selected=\"selected\"";?>>保固合約書</option>
								</select>									
																
								<label>表單狀態</label>
								<select id="FormStatus" name="FormStatus" class="input-xlarge" >
									<option value = 0 <?php if ($this->data['status'] == 0)echo "selected=\"selected\"";?>>請選擇表單狀態</option>
									<option value = 1 <?php if ($this->data['status'] == 1)echo "selected=\"selected\"";?>>已開發票</option>
									<option value = 2 <?php if ($this->data['status'] == 2)echo "selected=\"selected\"";?>>已送請款單</option>
									<option value = 3 <?php if ($this->data['status'] == 3)echo "selected=\"selected\"";?>>已送請款單/發票</option>
									<option value = 4 <?php if ($this->data['status'] == 4)echo "selected=\"selected\"";?>>尚未收款</option>
									<option value = 5 <?php if ($this->data['status'] == 5)echo "selected=\"selected\"";?>>已收款</option>
								</select>
															
								<label>合約已回/未回</label>
								<select id="IsReturn" name="IsReturn" class="input-xlarge" >
									<option value = 1 <?php if ($this->data['is_return'] == 0)echo "selected=\"selected\"";?>>未回</option>
									<option value = 2 <?php if ($this->data['is_return'] == 0)echo "selected=\"selected\"";?>>已回</option>
								</select>							
								
								<label>電梯</label>
								<select id="Elevator" name="Elevator" class="input-xlarge" >
								<option value = 0 selected="selected">請選擇電梯型號</option>
								</select>
								<?php if ($this->data['elevator'] != 0)
								   {
										
										foreach($this->data['elevator'] as $row)
										{
											$selectIndex = 0;
											if ($row->id == $this->data['elevator_id'])
												$selectIndex = $row->id;
										
								?>
									<script type='text/javascript'>
									addOption(document.getElementById("Elevator"), "<?php  echo $row->model;?>", "<?php echo $row->id;?>", "<?php echo $selectIndex;?>");
									
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
											$selectIndex = 0;
											if ($row->id == $this->data['customer_id'])
												$selectIndex = $row->id;
								?>
									<script type='text/javascript'>
									addOption(document.getElementById("Customer"), "<?php  echo $row->name;?>", "<?php echo $row->id;?>", "<?php echo $selectIndex;?>");
									
									</script>								
								<?php
										}
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
								
								<label id="MonthName">單雙月</label>
								<select name="Month" id="Month" class="input-xlarge">
									<option value = 1 <?php if ($this->data['month'] == 0)echo "selected=\"selected\"";?>>單月</option>
									<option value = 2 <?php if ($this->data['month'] == 0)echo "selected=\"selected\"";?>>雙月</option>
								</select>

								<label id="WarrantyName">保固期限(月)</label>
								<input type="text" id="Warranty" name="Warranty" value="12" class="input-xlarge">
										
								<script type='text/javascript'>
									hideObject("<?php echo $this->data['form_type'];?>");								
								</script>	
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


