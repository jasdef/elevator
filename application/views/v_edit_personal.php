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
					
					<h1 class="page-title">編輯客戶</h1>
				</div>
				
					<ul class="breadcrumb">
						<li><a href="<?=base_url("/mainpage/index")?>">首頁</a> <span class="divider">/</span></li>
						<li><a href="<?=site_url("/Personal/personal_home")?>">客戶管理</a> <span class="divider">/</span></li>
						<li class="active">編輯客戶</li>
					</ul>

				<div class="container-fluid">
					<div class="row-fluid">
						<form id="tab" name="edit_custiner" action="<?=site_url("/Personal/personal_edit")?>" method="post">
							<div class="btn-toolbar">
								<button class="btn btn-primary" type="submit"><i class="icon-plus"></i>儲存</button>
								<button class="btn" type="button" onclick="history.back()">取消</button>
							</div>
							<div class="well">			
								<label>人員編號</label>
								<input type="text" name = "Id" value="<?php print($this->data['id']);?>" readonly="readonly" class="input-xlarge">
								
								<label>帳號</label>
								<input type="text" name = "account" value="<?php print($this->data['account']);?>"  readonly="readonly" class="input-xlarge">
																
								<label>密碼</label>
								<input type="password" name = "password" value="<?php print($this->data['password']);?>" class="input-xlarge">
								
								<label>姓名</label>
								<input type="text" name = "name" value="<?php print($this->data['name']);?>" class="input-xlarge">

								<label>權限</label><?//  後端判斷的值 傳送到前段data[1],data[2],data[3] ?>
								<select name="permission">
								<option value="1" <?php if ($this->data['permission'] == 1)echo "selected=\"selected\"";?>>系統管理員</option>
								<option value="2" <?php if ($this->data['permission'] == 2)echo "selected=\"selected\"";?>>會計</option>
								<option value="3" <?php if ($this->data['permission'] == 3)echo "selected=\"selected\"";?>>員工</option>
								</select>
							
								<label>狀態</label>
								<select name="status"><?//  後端判斷的值 傳送到前段data[4],data[5] ?>
								<option value="0" <?php if ($this->data['status'] == 0)echo "selected=\"selected\"";?>>未鎖定</option>
								<option value="1" <?php if ($this->data['status'] == 1)echo "selected=\"selected\"";?>>鎖定</option>
								</select>
								
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
					for(var i = 0, n=checkboxes.length;i <= n;i++) 
					{
						if(i == n){
							count = count+1;
						}
						if((count%2) == 0)
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
			
			<script> //新增欄位 java script
				var countMin = 1; 
				var contMin =<?echo $this->data[14];?>;
				var AddrMin = <?echo $this->data[15];?>;
				var TelMin = <?echo $this->data[16];?>;
				var divname;
				$("#cont_bnt").click(function () //聯絡人欄位新增
				{	var contname = "contacter_";
					var Fieldvarle;
					var insdivname = "" +contname+ contMin ;
					if(edit_custiner.contacter_1.value != "")
					{	
						Fieldvarle = 1;	
						if(divname == insdivname)
						{	
							if(edit_custiner.contacter_2.value != "")
							{								
								Fieldvarle = 1;
							}
							else
							{								
								Fieldvarle = 0;
							}
						}
					}
					else
					{
						Fieldvarle = 0;
					}
					if(Fieldvarle != 0)
					{
						if(contMin < 3)
						{
						contMin++;
						divname=""+contname+ contMin ;
						$("#contacter_").append('<div id="' +contname+ contMin + '">聯絡人'+contMin+'<br><input type="text" name="contacter_'+contMin+'" value="" class="input-xlarge" /> </div>');
						}																		//			<input type="text" name = "contacter_1" value="" class="input-xlarge">
						else
						{	
							alert("最多3個欄位"); 
						}
					}
					else
					{
						alert("欄位為空值");
					}
				});
				
				$("#addr_bnt").click(function () //地址欄位新增
				{	var addrname = "address_";
					var Fieldvarle;
					var insdivname = "" +addrname+ AddrMin ;
					if(edit_custiner.address_1.value != "")
					{	
						Fieldvarle = 1;	
						if(divname == insdivname)
						{	
							if(edit_custiner.address_2.value != "")
							{								
								Fieldvarle = 1;
							}
							else
							{								
								Fieldvarle = 0;
							}
						}
					}
					else
					{
						Fieldvarle = 0;
					}	
					if(Fieldvarle != 0)
					{
						if(AddrMin < 3)
						{
						AddrMin++;
						divname=""+addrname+ AddrMin ;
						$("#address_").append('<div id="' +addrname+ AddrMin + '">地址'+AddrMin+'<br><input type="text" name="address_'+AddrMin+'" value="" class="input-xlarge" /> </div>');
						}																		//			<input type="text" name = "contacter_1" value="" class="input-xlarge">
						else
						{	
							alert("最多3個欄位"); 
						}
					}
					else
					{
						alert("欄位為空值");
					}
				});
				
				$("#tel_bnt").click(function () //電話欄位新增
				{	var telname = "tel_";
					var Fieldvarle;
					var insdivname = "" +telname+ TelMin ;
					if(edit_custiner.tel_1.value != "")
					{	
						Fieldvarle = 1;	
						if(divname == insdivname)
						{	
							if(edit_custiner.tel_2.value != "")
							{								
								Fieldvarle = 1;
							}
							else
							{								
								Fieldvarle = 0;
							}
						}
					}
					else
					{
						Fieldvarle = 0;
					}
					if(Fieldvarle != 0)
					{
						if(TelMin < 3)
						{
						TelMin++;
						divname="div"+telname+ TelMin ;
						$("#tel_").append('<div id="' +telname+ TelMin + '">電話'+TelMin+'<br><input type="text" name="tel_'+TelMin+'" value="" class="input-xlarge" /> </div>');
						}																		
						else
						{	
							alert("最多3個欄位"); 
						}
					}
					else
					{
						alert("欄位為空值");
					}
				});
					
				function delField(name) //刪除欄位
				{
					if(name	==	"contacter_")
					{
						count = contMin;
						if(contMin > 1)
						{
							contMin--;
						}
					}
					else if(name == "address_")
					{
						count = AddrMin;
						if(AddrMin > 1)
						{
							AddrMin--;
						}
					}
					else if(name == "tel_")
					{						
						count = TelMin;
						if(TelMin > 1)
						{
							TelMin--;
						}
					}		
					if (count > countMin) {
						$("#"+name+count).remove();
						
					} 
					else 
					{
						alert("無新增欄位可以刪除");
					}	
				}
			</script> 
		</body>
	</html>

