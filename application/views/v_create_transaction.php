	<!DOCTYPE html>
	<html lang="en">
		<?php
			include "head.php";
		?> 
		<body> 
			
			<link rel="stylesheet" href="<?=base_url("js/jquery/jquery-ui.min.css");?>">
			<script src="<?=base_url("js/jquery/jquery.min.js");?>"></script>
			<script src="<?=base_url("js/jquery/jquery-ui.min.js");?>"></script>
			<link rel="stylesheet" href="jqueryui/style.css">
			
			<script type='text/javascript'>

			 $(function() {
				$( "#datepicker" ).datepicker({
				  showOn: "button",
				  buttonImage: "<?=base_url("images/calendar.png");?>",
				  buttonImageOnly: true

				   
				});
				$( "#datepicker" ).change(function() {
				$( "#datepicker" ).datepicker( "option", "dateFormat", "yy/mm/dd" );});
			 });		

			function addOption(list, text, value)
			{
				var index=list.options.length;
				list.options[index]=new Option(text, value);
		
			}				
			
			function calculate(element) 
			{
				
				var price = document.getElementById('Total_price').value;
				var result = parseInt(price);				
				var count = 0;
				
				for (; count < 6; count++)
				{
					var temp = document.getElementById('Item'+(count+1));
					
					if (temp == null) 
					{
						break;						
					}
					
				}
				
				var items = new Array(count);
				
				for (i =0; i < count; i++)
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
						<form id="tab" name="fomr1" action="<?=site_url("/form/create_transaction_model")?>" method="post">
							<div class="btn-toolbar">
								<button class="btn btn-primary" type="submit"><i class="icon-plus"></i>新增</button>
								<button class="btn" type="button" onclick="history.back()">取消</button>
							</div>
							<div class="well">
							<table class="table sortable">	
								<tr>
									<th>
										表單名稱<br>
										<input type="text" name = "Company_name" value="" style=width:200px>
									</th>
								</tr>
								<tr>
									<th>
										電梯台數<br>
										<input type="text" id="Elevator_num" name="Elevator_num" value="0" style=width:200px onChange="calculate(this)">	
									</th>
								</tr>
								<tr>
									<th>
										總價<br>
										<input type="text" id="Total_price" name="Total_price" value="0" style=width:200px onChange="calculate(this)">					
									</th>
								</tr>
								<tr>
									<th>
										簽約日(西元yyyy/mm/dd)<br>
										<input type="text" id="datepicker" name = "Start_date" value="1990/05/01" style=width:200px>
									</th>
								</tr>
								<tr>
									<th>
										合約已回/未回<br>
										<select id="IsReturn" name="IsReturn" style=width:215px >
											<option value = 1 selected="selected">未回</option>
											<option value = 2>已回</option>
										</select>							
									</th>
								</tr>
								<tr>
									<th>
										含稅/未稅<br>
										<select id="IsReturn" name="IsReturn" style=width:215px >
											<option value = 1 selected="selected">含稅</option>
											<option value = 2>未稅</option>
										</select>							
									</th>
								</tr>
								<tr>
									<th>
										是否開發票<br>
										<select id="IsReturn" name="IsReturn" style=width:215px >
											<option value = 1 selected="selected">是</option>
											<option value = 2>否</option>
										</select>							
									</th>
								</tr>
								<tr>
									<th>
										客戶<br>
										<select id="Customer" name="Customer" style=width:215px >
										<option value = 0 selected="selected">請選擇客戶</option>
										</select>
										<?php 
										   if ($this->data['customer'] != 0)
										   {
											  
												foreach($this->data['customer'] as $row)
												{										
										?>
											<script type='text/javascript'>
												addOption(document.getElementById("Customer"), "<?php echo $row->company;?>", "<?php echo $row->id;?>");
											
											</script>								
										<?php
												}
										   }
										?>															
									</th>
								</tr>
								<table  class="table sortable">
									<tr>
										<th>
											備註事項<br>
											<textarea name="Remark" style="width:1000px;height:100px;"></textarea>	
										</th>
									</tr>
								</table>
														
								</table>
								<table  id="table" class="table sortable">
									<tbody>
																			
										<label><strong>收款明細</strong></label>																		
										<tr>
										<td><label>項目名稱</label></td>	
										<td><input type="text" id="Item_name1" name="Item_name1" value="" style=width:200px onChange="calculate(this)"></td>	
										<td><label>金額百分比</label></td>										
										<td><input type="text" id="Item1" name="Item1" value="0" style=width:200px onChange="calculate(this)"></td>
								
										<td><label>金額</label></td>					

										<td><input type="text" id="Item1_price" name="Item1_price" value="0" style=width:200px disabled></td>
										<td>
											<select id="Item_status1" name="Item_status1" style=width:200px onChange="calculate(this)">

												<option value = 0 selected="selected">請選擇表單狀態</option>
												<option value = 1>已開發票</option>
												<option value = 2>已送請款單</option>
												<option value = 3>已送請款單/發票</option>
												<option value = 4>尚未收款</option>
												<option value = 5>已收款</option>
											</select>
										</td>
										<td>
											<input type="button" value="+"  onclick="add_new_data()"> <input type="button" value="-" onclick="remove_data()">
										</td>
										</tr>
									</tbody>
								</table>													
								<table class="table sortable">
									<tr>
									<th>
										剩餘款項<br>
										<input type="text" id="Left_money" name="Left_money" value="0" style=width:200px>
									</th>
									</tr>
								</table>
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
			
			<script type="text/javascript">
				var min=1;
				var tdunm;//判斷新增到第幾個欄位
				function add_new_data() {
					var num = document.getElementById("table").rows.length;
					//建立新的tr 因為是從0開始算 所以目前的row數剛好為目前要增加的第幾個tr
					if(fomr1.Item_name1.value != "")
					{
						tdunm = 1;
						if(num == 2)
						{
							if(fomr1.Item_name2.value != "")
							{
								tdunm = 1;
							}
							else
							{
								tdunm = 0;
							}
						}
						else if(num == 3)
						{
							if(fomr1.Item_name3.value != "")
							{
								tdunm = 1;
							}
							else
							{
								tdunm = 0;
							}
						}		
						else if(num == 4)
						{
							if(fomr1.Item_name4.value != "")
							{
								tdunm = 1;
							}
							else
							{
								tdunm = 0;
							}
						}
						else if(num == 5)
						{
							if(fomr1.Item_name5.value != "")
							{
								tdunm = 1;
							}
							else
							{
								tdunm = 0;
							}
						}
					}
					else
					{
						tdunm = 0;	
					}
					if(tdunm != 0)
					{
						if(min<6)
						{
							min++;
							 //先取得目前的row數

							 var Tr = document.getElementById("table").insertRow(num);
							 
							 Td = Tr.insertCell(Tr.cells.length);
							 Td.innerHTML='<label>項目名稱</label>';
							 
							 //建立新的td 而Tr.cells.length就是這個tr目前的td數
							 Td = Tr.insertCell(Tr.cells.length);
							 //而這個就是要填入td中的innerHTML
							 Td.innerHTML='<input type="text" id="Item_name'+min+'" name="Item_name'+min+'" value="" class="input" onChange="calculate(this)">';
							 //這裡也可以用不同的變數來辨別不同的td (我是用同一個比較省事XD)
							 Td = Tr.insertCell(Tr.cells.length);
							 Td.innerHTML='<label>金額百分比</label>';
							 
							 Td = Tr.insertCell(Tr.cells.length);
							 Td.innerHTML='<input type="text" id="Item'+min+'" name="Item'+min+'" value="0" class="input" onChange="calculate(this)">';
							 
							 Td = Tr.insertCell(Tr.cells.length);
							 Td.innerHTML='<label>金額</label>';
							 
							 Td = Tr.insertCell(Tr.cells.length);
							 Td.innerHTML='<input type="text" id="Item'+min+'_price" name="Item'+min+'_price" value="0" class="input" onChange="calculate(this)"  disabled>';
							 
							 Td = Tr.insertCell(Tr.cells.length);
							 Td.innerHTML='	<select id="Item_status'+min+'" name="Item_status'+min+'" class="input" onChange="calculate(this)"><option value = 0 selected="selected">請選擇表單狀態</option><option value = 1>已開發票</option><option value = 2>已送請款單</option><option value = 3>已送請款單/發票</option><option value = 4>尚未收款</option><option value = 5>已收款</option></select>';
							 //這樣就好囉 記得td數目要一樣 不然會亂掉~

						}
						else
						{
							alert("最多6個欄位");
						}
					}
					else
					{
						alert("欄位空白");
					}
						
				}
				function remove_data() {
					//先取得目前的row數
					var num = document.getElementById("table").rows.length;
					//防止把標題跟原本的第一個刪除XD
					if(num >1)
					{
						min--;
					//刪除最後一個
					document.getElementById("table").deleteRow(-1);
					}
				}
			</script>
			
		</body>
	</html>


