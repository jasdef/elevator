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
					
					<h1 class="page-title">編輯保固單</h1>
				</div>
				
					<ul class="breadcrumb">
						<li><a href="<?=base_url("/mainpage/index")?>">首頁</a> <span class="divider">/</span></li>
						<li><a href="<?=site_url("/warranty/elevator_home")?>">保固單管理</a> <span class="divider">/</span></li>
						<li class="active">編輯保固單</li>
					</ul>

				<div class="container-fluid">
					<div class="row-fluid">
						<form id="tab" name="edit_custiner" action="<?=site_url("/warranty/warranty_edit")?>" method="post">
							<div class="btn-toolbar">
								<button class="btn btn-primary" type="submit"><i class="icon-plus"></i>儲存</button>
								<a href=""<?=base_url("/warranty/warranty_home")?>""><button class="btn ">取消</button></a>
							</div>
							<div class="well">			
								<label>客戶編號</label>
								<input type="text" name = "Id" value="<?php print($this->data['id']);?>" readonly="readonly" class="input-xlarge">
								<label>客戶名稱</label>
								<input type="text" name = "customer" value="<?php print($this->data['customer']);?>" class="input-xlarge">
								
								
								<label>聯絡人</label>
								<input type="text" name = "contacter_1" value="<?php print($this->data['contacter_1']);?>" class="input-xlarge"> <input type="button" id="cont_bnt" value="+"  /> <input type="button" onclick="delField('contacter_')" value="-" />
								<div id="contacter_">
								<?
									if($this->data['contacter_2'] != null)
									{
										echo "<div id=contacter_2>聯絡人2</br> <input type=text name= contacter_2 value=".$this->data['contacter_2']." class=input-xlarge></div>";
										if($this->data['contacter_3'] != null)
										{
											echo "<div id=contacter_3>聯絡人3</br> <input type=text name= contacter_3 value=".$this->data['contacter_3']." class=input-xlarge></div>";
										}
									}
								?>
								</div>
								
								<label>地址</label>
								<input type="text" name = "address" value="<?php print($this->data['address']);?>" class="input-xlarge">
								
								<label>電話</label>
								<input type="text" name = "tel_1" value="<?php print($this->data['tel_1']);?>" class="input-xlarge"> <input type="button" id="tel_bnt" value="+"  /> <input type="button" onclick="delField('tel_')" value="-" />
								<div id="tel_">
								<?
									if($this->data['tel_2'] != null)
									{	
										echo "<div id=tel_2>電話2</br> <input type=text name= tel_2 value=".$this->data['tel_2']." class=input-xlarge></div>";
										if($this->data['tel_3'] != null)
										{
											echo "<div id=tel_3>電話3</br> <input type=text name= tel_3 value=".$this->data['tel_3']." class=input-xlarge></div>";
										}
									}
								?>
								</div>	
								
								<label>傳真</label>
								<input type="text" name = "fax_1" value="<?php print($this->data['fax_1']);?>" class="input-xlarge"> <input type="button" id="fax_bnt" value="+"  /> <input type="button" onclick="delField('fax_')" value="-" />
								<div id="fax_">
								<?
									if($this->data['fax_2'] != null)
									{	
										echo "<div id=fax_2>電話2</br> <input type=text name= fax_2 value=".$this->data['fax_2']." class=input-xlarge></div>";
										if($this->data['fax_3'] != null)
										{
											echo "<div id=fax_3>電話3</br> <input type=text name= fax_3 value=".$this->data['fax_3']." class=input-xlarge></div>";
										}
									}
								?>
								</div>	
								<label>統一編號</label>
								<input type="text" name = "Num" value="<?php print($this->data['num']);?>" class="input-xlarge">
								
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
				var TelMin = <?echo $this->data[15];?>;
				var faxMin = <?echo $this->data[16];?>;
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
						divname=""+telname+ TelMin ;
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
				$("#fax_bnt").click(function () //傳真欄位新增
				{	var faxname = "fax_";
					var Fieldvarle;
					var insdivname = "" +faxname+ faxMin ;
					if(edit_custiner.fax_1.value != "")
					{	
						Fieldvarle = 1;	
						if(divname == insdivname)
						{	
							if(edit_custiner.fax_2.value != "")
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
						if(faxMin < 3)
						{
						faxMin++;
						divname=""+faxname+ faxMin ;
						$("#fax_").append('<div id="' +faxname+ faxMin + '">傳真'+faxMin+'<br><input type="text" name="fax_'+faxMin+'" value="" class="input-xlarge" /> </div>');
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
					else if(name == "fax_")	
					{
						count = faxMin;
						if(faxMin > 1)
						{
							faxMin--;
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

