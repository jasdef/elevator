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
			
			<link rel="stylesheet" href="<?=base_url("js/jquery/jquery-ui.min.css");?>">
			<script src="<?=base_url("js/jquery/jquery.min.js");?>"></script>
			<script src="<?=base_url("js/jquery/jquery-ui.min.js");?>"></script>
			<link rel="stylesheet" href="jqueryui/style.css">
			
			<script>
				$(function() {
				$( "#signing_day" ).datepicker({
				  showOn: "button",
				  buttonImage: "<?=base_url("images/calendar.png");?>",//"../images/calendar.png"亦可執行
				  buttonImageOnly: true
				});
				$( "#signing_day" ).change(function() {
				$( "#signing_day" ).datepicker( "option", "dateFormat", "yy/mm/dd" );});
				});
			 
			 
			 	$(function() {
				$( "#datepicker1" ).datepicker({
				  showOn: "button",
				  buttonImage: "<?=base_url("images/calendar.png");?>",//"../images/calendar.png"亦可執行
				  buttonImageOnly: true
				});
				$( "#datepicker1" ).change(function() {
				$( "#datepicker1" ).datepicker( "option", "dateFormat", "yy/mm/dd" );});
				});
				
				$(function() {
				$( "#payment_date1" ).datepicker({
				  showOn: "button",
				  buttonImage: "<?=base_url("images/calendar.png");?>",//"../images/calendar.png"亦可執行
				  buttonImageOnly: true
				});
				$( "#payment_date1" ).change(function() {
				$( "#payment_date1" ).datepicker( "option", "dateFormat", "yy/mm/dd" );});
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
						var temp = document.getElementById('payment_amount'+(count+1));
					
						if (temp == null) 
						{
							break;						
						}
					
					}
					var items = new Array(count);
					var value=price;
					for (i =0; i < count; i++)
					{	
							
						items[i] = parseInt(document.getElementById('payment_amount'+(i+1)).value);
						var status = parseInt(document.getElementById('Item_status'+(i+1)).value);
						if (items[i] != 0) 
						{
							
							document.getElementById('Item'+(i+1)+"_price").value = parseInt(value -(items[i]));					
							value= parseInt(value -(items[i]));
						}
						
						if (status == 5)
						{
							result -= price *(items[i]*0.01);						
						}
					}
					
					document.getElementById('Left_money').value = result;
				
				}
				
				function calculatetime(element) 
				{
					
				var time = document.getElementById('signing_day').value;
				var overtime =parseInt( document.getElementById('mechanical_warranty').value);
				var result;
				var dt = new Date(time);
				var month = dt.getMonth();
				var day = dt.getDate();	
				var year = dt.getFullYear()+overtime;
				result=(year+'/'+month + '/' + day) ;
				document.getElementById('signing_over_day').value = result;
				}
				
			</script> 
	
			<div class="content">
				
				<div class="header">
					
					<h1 class="page-title">新增保養單</h1>
				</div>
				
					<ul class="breadcrumb">
						<li><a href="<?=base_url("/mainpage/index")?>">首頁</a> <span class="divider">/</span></li>
						<li><a href="<?=site_url("/service/service_home")?>">保養單管理</a> <span class="divider">/</span></li>
						<li class="active">新增保養單</li>
					</ul>

				<div class="container-fluid">
					<div class="row-fluid">
						<form id="tab" name="fomr1" name="create_custiner" action="<?=site_url("/service/service_create")?>" method="post">
							<div class="btn-toolbar">
								<button class="btn btn-primary" type="submit"><i class="icon-plus"></i>新增</button>
								<button class="btn" type="button" onclick="history.back()">取消</button>
							</div>
							<div class="well">

								<label>保固單編號</label>
								<input type="text" name = "warranty_id" value="" class="input-xlarge">
							
								<label>簽約日(西元yyyy/mm/dd)</label>
								<input type="text" id="signing_day" name = "signing_day" value="" class="input-xlarge">，簽約年限<input type="text" id="mechanical_warranty" name = "mechanical_warranty" value="" style=width:20px onChange="calculatetime(this)"> 年
								
								<label>簽約到期日(西元yyyy/mm/dd)</label>
								<input type="text" id="signing_over_day" name="signing_over_day" value="0" class="input-xlarge" disabled>
								
								<label>單雙月保養</label>
									<select id="service_month" name="service_month" class="input-xlarge" >
										<option value = 0 selected="selected">請選擇單雙月保養</option>
										<option value = 1 >單月保養</option>
										<option value = 2>雙月保養</option>
									</select>
																	
								<label>有無許可證</label>
									<select id="license" name="license" class="input-xlarge" >
										<option value = 1 selected="selected">有</option>
										<option value = 2>無</option>
									</select>
									
								<label>許可證到期日(西元yyyy/mm/dd)</label>
								<input type="text" id="datepicker1" name = "license_day" value="" class="input-xlarge">								
								
								<label>總價</label>
								<input type="text" id="Total_price" name = "Total_price" value="" class="input-xlarge"> 	

								<table  id="table" class="table sortable">
									<tbody>
									
									
									
										<tr>
										<th>繳款時間(西元yyyy/mm/dd)<br><input type="text" id="payment_date1" name="payment_date1" value=""  style=width:200px onChange="calculate(this)"></th>					
										<th>繳款金額<br><input type="text" id="payment_amount1" name="payment_amount1" value="0" style=width:200px onChange="calculate(this)"></th>
										<!--<td><label>金額</label></td>	-->				

										<th>剩餘金額<br><input type="text" id="Item1_price" name="Item1_price" value="0" style=width:200px disabled></th>
										<th>表單狀態<br>
											<select id="Item_status1" name="Item_status1" style=width:200px onChange="calculate(this)">

												<option value = 0 selected="selected">請選擇表單狀態</option>
												<option value = 1>已開發票</option>
												<option value = 2>已送請款單</option>
												<option value = 3>已送請款單/發票</option>
												<option value = 4>尚未收款</option>
												<option value = 5>已收款</option>
											</select>
										</th>
										<th>
											<br><input type="button" value="+" onclick="add_new_data()"> <input type="button" value="-" onclick="remove_data()">
										</th>
										</tr>
									</tbody>
								</table>
								<label>備註事項</label>
								<textarea name="remark" style="width:1000px;height:100px;"></textarea>								
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
			<script type="text/javascript">
				var min = 1;
				var tdunm;//判斷新增到第幾個欄位
				var Item  =1;
				function add_new_data() {	
					var num = document.getElementById("table").rows.length;
					//建立新的tr 因為是從0開始算 所以目前的row數剛好為目前要增加的第幾個tr
					
					for (i =0; i < num; i++)
					{
						$(function() {
						$( "#payment_date"+(i+1) ).datepicker({
						showOn: "button",
						buttonImage: "<?=base_url("images/calendar.png");?>",//"../images/calendar.png"亦可執行
						buttonImageOnly: true

				   
						});
						$( "#payment_date"+(i+1) ).change(function() {
						$( "#payment_date"+(i+1) ).datepicker( "option", "dateFormat", "yy/mm/dd" );});
						});	
						
					}
					if(fomr1.payment_date1.value != "")
					{
						tdunm = 1;
						if(num == 2)
						{
							if(fomr1.payment_date2.value != "")
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
							if(fomr1.payment_date3.value != "")
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
							if(fomr1.payment_date4.value != "")
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
							if(fomr1.payment_date5.value != "")
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
							 Td.innerHTML='<input type="text" id="payment_date'+min+'" name="payment_date'+min+'" value="" style=width:200px onChange="calculate(this)">';
							 //這裡也可以用不同的變數來辨別不同的td (我是用同一個比較省事XD)
							 Td = Tr.insertCell(Tr.cells.length);
							 Td.innerHTML='<input type="text" id="payment_amount'+min+'" name="payment_amount'+min+'" value="0" style=width:200px onChange="calculate(this)">';
							 
							 Td = Tr.insertCell(Tr.cells.length);
							 Td.innerHTML='<input type="text" id="Item'+min+'_price" name="Item'+min+'_price" value="0" style=width:200px onChange="calculate(this)"  disabled>';
							 
							 Td = Tr.insertCell(Tr.cells.length);
							 Td.innerHTML='	<select id="Item_status'+min+'" name="Item_status'+min+'" style=width:200px onChange="calculate(this)"><option value = 0 selected="selected">請選擇表單狀態</option><option value = 1>已開發票</option><option value = 2>已送請款單</option><option value = 3>已送請款單/發票</option><option value = 4>尚未收款</option><option value = 5>已收款</option></select>';
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


