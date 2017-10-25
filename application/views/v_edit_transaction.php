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
					
					<h1 class="page-title">編輯買賣單</h1>
				</div>
				
					<ul class="breadcrumb">
						<li><a href="<?=base_url("/mainpage/index")?>">首頁</a> <span class="divider">/</span></li>
						<li><a href="<?=site_url("/form/transaction_home")?>">買賣單管理</a> <span class="divider">/</span></li>
						<li class="active">編輯買賣單</li>
					</ul>

				<div class="container-fluid">
					<div class="row-fluid">
						<form id="tab" name="fomr1" action="<?=site_url("/form/edit_transaction_model")?>" method="post">
							<div class="btn-toolbar">
								<button class="btn btn-primary" type="submit"><i class="icon-plus"></i>儲存</button>
								<button class="btn" type="button" onclick="history.back()">取消</button>
							</div>
							<div class="well">
								<label>編號</label>
								<input type="text" name = "Id" value="<?php print($this->data['id']);?>" readonly="readonly" class="input-xlarge">
								
								<label>表單名稱</label>
								<input type="text" name = "Company_name" value="<?php print($this->data['name']);?>" class="input-xlarge">
								
								<label>總價</label>
								<input type="text" id="Total_price" name="Total_price" value="<?php print($this->data['total_price']);?>" class="input-xlarge" onChange="calculate(this)">					
								
								<label>簽約日(西元yyyy/mm/dd)</label>
								<input type="text" name = "Start_date" value="<?php print($this->data['start_date']);?>" class="input-xlarge">
								
								<label>合約已回/未回</label>
								<select id="IsReturn" name="IsReturn" class="input-xlarge" >
									<option value = 1 <?php if ($this->data['is_return'] == 1)echo "selected=\"selected\"";?>>未回</option>
									<option value = 2 <?php if ($this->data['is_return'] == 2)echo "selected=\"selected\"";?>>已回</option>
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
											$selectIndex = 0;
											if ($row->id == $this->data['customer_id'])
												$selectIndex = $row->id;										
								?>
									<script type='text/javascript'>
										addOption(document.getElementById("Customer"), "<?php echo $row->company;?>", "<?php echo $row->id;?>", "<?php echo $selectIndex;?>");
									</script>								
								<?php
										}
								   }
								?>	
																
								<label>收款提醒(間隔幾個月)</label>
								<input type="text" name = "Remind" value="<?php print($this->data['remind_month']);?>" class="input-xlarge">
								
								<table id="table" class="table sortable">
									<tbody>
										<tr>
										<td><input type="text" id="Item_name1" name="Item_name1" value="<?php print($this->data['item_name1']);?>" class="input" onChange="calculate(this)"></td>			
										<td><input type="text" id="Item1" name="Item1" value="<?php print($this->data['item1']);?>" class="input" onChange="calculate(this)"></td>
										<td><label>金額</label></td>					

										<td><input type="text" id="Item1_price" name="Item1_price" value="0" class="input" disabled></td>
										<td>
											<select id="Item_status1" name="Item_status1" class="input" onChange="calculate(this)">

												<option value = 0 <?php if ($this->data['item_status1'] == 0)echo "selected=\"selected\"";?>>請選擇表單狀態</option>
												<option value = 1 <?php if ($this->data['item_status1'] == 1)echo "selected=\"selected\"";?>>已開發票</option>
												<option value = 2 <?php if ($this->data['item_status1'] == 2)echo "selected=\"selected\"";?>>已送請款單</option>
												<option value = 3 <?php if ($this->data['item_status1'] == 3)echo "selected=\"selected\"";?>>已送請款單/發票</option>
												<option value = 4 <?php if ($this->data['item_status1'] == 4)echo "selected=\"selected\"";?>>尚未收款</option>
												<option value = 5 <?php if ($this->data['item_status1'] == 5)echo "selected=\"selected\"";?>>已收款</option>
											</select>
										</td>

										<td>
											<input type="button" value="+" onclick="add_new_data()"> <input type="button" value="-" onclick="remove_data()">
										</td>

										</tr>	
								<?php
										$j=$this->data[1];
										for($i=1;$i<$j;$i++)
										{										
											echo '<tr>';
											echo '<td><input type="text" id="Item_name'.($i+1). '" name="Item_name'.($i+1). '" value="'.$this->data["item_name".($i+1)].'" class="input" onChange="calculate(this)"></td>';		
											echo '<td><input type="text" id="Item'.($i+1). '" name="Item'.($i+1). '" value="' .$this->data["item".($i+1)]. '" class="input" onChange="calculate(this)"></td>';
											echo '<td><label>金額</label></td>';					
											echo '<td><input type="text" id="Item'.($i+1). '_price" name="Item'.($i+1). '_price" value="0" class="input" onChange="calculate(this)"  disabled></td>';
											echo '<td>';
												echo '<select id="Item_status'.($i+1). '" name="Item_status'.($i+1). '" class="input" >';
													echo '<option value = 0 "'; if ($this->data["item_status".($i+1)] == 0) echo "selected=\"selected\""; echo '">請選擇表單狀態</option>';
													echo '<option value = 1 "'; if ($this->data["item_status".($i+1)] == 1) echo "selected=\"selected\""; echo '">已開發票</option>';
													echo '<option value = 2 "'; if ($this->data["item_status".($i+1)] == 2) echo "selected=\"selected\""; echo '">已送請款單</option>';
													echo '<option value = 3 "'; if ($this->data["item_status".($i+1)] == 3) echo "selected=\"selected\""; echo '">已送請款單/發票</option>';
													echo '<option value = 4 "'; if ($this->data["item_status".($i+1)] == 4) echo "selected=\"selected\""; echo '">尚未收款</option>';
													echo '<option value = 5 "'; if ($this->data["item_status".($i+1)] == 5) echo "selected=\"selected\""; echo '">已收款</option>';
												echo '</select>';
											echo '</td>';
											echo '<td>';
											echo '</td>';
											echo '</tr>	';										
										}
								?>		
									</tbody>
								</table>													
								
								<label>剩餘款項</label>
								<input type="text" id="Left_money" name="Left_money" value="0" class="input-xlarge">

							</div>
						</form>
						<script type='text/javascript'>
							calculate(this);
						</script>	
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
			
			
			<script type="text/javascript">
				var min=<?php echo $this->data[1];?>;已顯示欄位
				//var kk=0;
				var tdunm;//判斷新增到第幾個欄位
				function add_new_data() {
					var num = document.getElementById("table").rows.length;
					//建立新的tr 因為是從0開始算 所以目前的row數剛好為目前要增加的第幾個tr
					if(fomr1.Item_name1.value != "")
					{	
						tdunm =1;
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
							 //建立新的td 而Tr.cells.length就是這個tr目前的td數
							 Td = Tr.insertCell(Tr.cells.length);
							 //而這個就是要填入td中的innerHTML
							 Td.innerHTML='<input type="text" id="Item_name'+min+'" name="Item_name'+min+'" value="" class="input" onChange="calculate(this)">';
							 //這裡也可以用不同的變數來辨別不同的td (我是用同一個比較省事XD)
							 Td = Tr.insertCell(Tr.cells.length);
							 Td.innerHTML='<input type="text" id="Item'+min+'" name="Item'+min+'" value="0" class="input" onChange="calculate(this)">';
							 
							 Td = Tr.insertCell(Tr.cells.length);
							 Td.innerHTML='<label>金額</label>';
							 
							 Td = Tr.insertCell(Tr.cells.length);
							 Td.innerHTML='<input type="text" id="Item'+min+'_price" name="Item'+min+'_price" value="0" class="input" onChange="calculate(this)"  disabled>';
							 
							 Td = Tr.insertCell(Tr.cells.length);
							 Td.innerHTML='	<select id="Item_status'+min+'" name="Item_status'+min+'" class="input"><option value = 0 selected="selected">請選擇表單狀態</option><option value = 1>已開發票</option><option value = 2>已送請款單</option><option value = 3>已送請款單/發票</option><option value = 4>尚未收款</option><option value = 5>已收款</option></select>';
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


