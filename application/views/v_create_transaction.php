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
			
			function calculate(element) 
			{
				var items = new Array(6);
				var price = document.getElementById('Total_price').value;
				var result = parseInt(price);
				
				for (i =0; i < 6; i++)
				{
					items[i] = parseInt(document.getElementById('Item'+(i+1)).value);
					var status = parseInt(document.getElementById('Item_status'+(i+1)).value);
					if (items[i] != 0) 
					{
						document.getElementById('Item'+(i+1)+"_price").value = parseInt(price *(items[i]*0.01));					
						
					}
					
					if (status == 5)
					{
						result -= price *(items[i]*0.01);						
					}
				}
					
				document.getElementById('Left_money').value = result;
				
			}
					
			
			</script>
			<?php
				include "navbar.php";
				include "sidebar-nav.php";
			?>
		
			<div class="content">
				
				<div class="header">
					
					<h1 class="page-title">新增買賣單</h1>
				</div>
				
					<ul class="breadcrumb">
						<li><a href="<?=base_url("/mainpage/index")?>">首頁</a> <span class="divider">/</span></li>
						<li><a href="<?=site_url("/form/transaction_home")?>">買賣單管理</a> <span class="divider">/</span></li>
						<li class="active">新增買賣單</li>
					</ul>

				<div class="container-fluid">
					<div class="row-fluid">
						<form id="tab" action="<?=site_url("/form/create_transaction_model")?>" method="post">
							<div class="btn-toolbar">
								<button class="btn btn-primary" type="submit"><i class="icon-plus"></i>新增</button>
								<button class="btn" type="button" onclick="history.back()">取消</button>
							</div>
							<div class="well">
								
								<label>公司名稱</label>
								<input type="text" name = "Company_name" value="" class="input-xlarge">
								
								<label>總價</label>
								<input type="text" id="Total_price" name="Total_price" value="0" class="input-xlarge" onChange="calculate(this)">					
								
								<label>簽約日(西元yyyy/mm/dd)</label>
								<input type="text" name = "Start_date" value="1990/05/01" class="input-xlarge">
								
								<label>合約已回/未回</label>
								<select id="IsReturn" name="IsReturn" class="input-xlarge" >
									<option value = 1 selected="selected">未回</option>
									<option value = 2>已回</option>
								</select>							
								
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
																
								<label>收款提醒(間隔幾個月)</label>
								<input type="text" name = "Remind" value="0" class="input-xlarge">
								
								<table class="table sortable">
									<tbody>
										<tr>
										<td><label>訂金</label></td>					
										<td><input type="text" id="Item1" name="Item1" value="0" class="input-xlarge" onChange="calculate(this)"></td>
										<td><label>金額</label></td>					
										<td><input type="text" id="Item1_price" name="Item1_price" value="0" class="input-xlarge" disabled></td>
										<td>
											<select id="Item_status1" name="Item_status1" class="input-xlarge" onChange="calculate(this)">
												<option value = 0 selected="selected">請選擇表單狀態</option>
												<option value = 1>已開發票</option>
												<option value = 2>已送請款單</option>
												<option value = 3>已送請款單/發票</option>
												<option value = 4>尚未收款</option>
												<option value = 5>已收款</option>
											</select>
										</td>
										</tr>								
										<tr>
											<td><label>貨到</label></td>					
											<td><input type="text" id="Item2" name="Item2" value="0" class="input-xlarge" onChange="calculate(this)"></td>
											<td><label>金額</label></td>					
											<td><input type="text" id="Item2_price" name="Item2_price" value="0" class="input-xlarge" disabled></td>
											<td>
												<select id="Item_status2" name="Item_status2" class="input-xlarge" onChange="calculate(this)">
													<option value = 0 selected="selected">請選擇品項狀態</option>
													<option value = 1>已開發票</option>
													<option value = 2>已送請款單</option>
													<option value = 3>已送請款單/發票</option>
													<option value = 4>尚未收款</option>
													<option value = 5>已收款</option>
												</select>
											</td>
										</tr>	
										<tr>
											<td><label>安裝完成</label></td>					
											<td><input type="text" id="Item3" name="Item3" value="0" class="input-xlarge" onChange="calculate(this)"></td>
											<td><label>金額</label></td>					
											<td><input type="text" id="Item3_price" name="Item3_price" value="0" class="input-xlarge" disabled></td>
											<td>
												<select id="Item_status3" name="Item_status3" class="input-xlarge" onChange="calculate(this)">
													<option value = 0 selected="selected">請選擇品項狀態</option>
													<option value = 1>已開發票</option>
													<option value = 2>已送請款單</option>
													<option value = 3>已送請款單/發票</option>
													<option value = 4>尚未收款</option>
													<option value = 5>已收款</option>
												</select>
											</td>
										</tr>	
																				<tr>
											<td><label>試車完成</label></td>					
											<td><input type="text" id="Item4" name="Item4" value="0" class="input-xlarge" onChange="calculate(this)" onkeyup="if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,'')}else{this.value=this.value.replace(/\D/g,'')}" onafterpaste="if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,'')}else{this.value=this.value.replace(/\D/g,'')}"></td>
											<td><label>金額</label></td>					
											<td><input type="text" id="Item4_price" name="Item4_price" value="0" class="input-xlarge" disabled></td>
											<td>
												<select id="Item_status4" name="Item_status4" class="input-xlarge" onChange="calculate(this)">
													<option value = 0 selected="selected">請選擇品項狀態</option>
													<option value = 1>已開發票</option>
													<option value = 2>已送請款單</option>
													<option value = 3>已送請款單/發票</option>
													<option value = 4>尚未收款</option>
													<option value = 5>已收款</option>
												</select>
											</td>
										</tr>	
																				<tr>
											<td><label>取得合格證</label></td>					
											<td><input type="text" id="Item5" name="Item5" value="0" class="input-xlarge" onChange="calculate(this)"></td>
											<td><label>金額</label></td>					
											<td><input type="text" id="Item5_price" name="Item5_price" value="0" class="input-xlarge" disabled></td>
											<td>
												<select id="Item_status5" name="Item_status5" class="input-xlarge" onChange="calculate(this)">
													<option value = 0 selected="selected">請選擇品項狀態</option>
													<option value = 1>已開發票</option>
													<option value = 2>已送請款單</option>
													<option value = 3>已送請款單/發票</option>
													<option value = 4>尚未收款</option>
													<option value = 5>已收款</option>
												</select>
											</td>
										</tr>	
																				<tr>
											<td><label>驗收完成</label></td>					
											<td><input type="text" id="Item6" name="Item6" value="0" class="input-xlarge" onChange="calculate(this)"></td>
											<td><label>金額</label></td>					
											<td><input type="text" id="Item6_price" name="Item6_price" value="0" class="input-xlarge" disabled></td>
											<td>
												<select id="Item_status6" name="Item_status6" class="input-xlarge" onChange="calculate(this)">
													<option value = 0 selected="selected">請選擇品項狀態</option>
													<option value = 1>已開發票</option>
													<option value = 2>已送請款單</option>
													<option value = 3>已送請款單/發票</option>
													<option value = 4>尚未收款</option>
													<option value = 5>已收款</option>
												</select>
											</td>
										</tr>	
									</tbody>
								</table>													
								
								<label>剩餘款項</label>
								<input type="text" id="Left_money" name="Left_money" value="0" class="input-xlarge">

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


