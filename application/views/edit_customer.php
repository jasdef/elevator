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
						<li><a href="<?=site_url("/customer/elevator_home")?>">客戶管理</a> <span class="divider">/</span></li>
						<li class="active">編輯客戶</li>
					</ul>

				<div class="container-fluid">
					<div class="row-fluid">
						<form id="tab" action="<?=site_url("/customer/customer_edit")?>" method="post">
							<div class="btn-toolbar">
								<button class="btn btn-primary" type="submit"><i class="icon-plus"></i>儲存</button>
								<a href=""<?=base_url("/customer/customer_home")?>""><button class="btn ">取消</button></a>
							</div>
							<div class="well">			
								<label>客戶編號</label>
								<input type="text" name = "Id" value="<?php print($this->data['id']);?>" readonly="readonly" class="input-xlarge">
								<label>公司名稱</label>
								<input type="text" name = "company" value="<?php print($this->data['company']);?>" class="input-xlarge">
								
								
								<label>聯絡人</label>
								<input type="text" name = "Address" value="<?php print($this->data['contacter_1']);?>" class="input-xlarge"> <a href="javascript:" onclick="addField('contacter_')"><i class="icon-pencil"></i></a>	<a href="javascript:" onclick="delField('contacter_')"><i class="icon-remove"></i></a>
								<span id="contacter_">
								<?php
									if($this->data['contacter_2'] != null)
									{
										echo "<div>聯絡人2</br> <input type=text name= contacter_2 value=".$this->data['contacter_2']." class=input-xlarge></div>";
										if($this->data['contacter_3'] != null)
										{
											echo "<div>聯絡人3</br> <input type=text name= contacter_3 value=".$this->data['contacter_3']." class=input-xlarge></div>";
										}
									}
								?>
								</span> 
								
								
								<label>地址</label>
								<input type="text" name = "Address" value="<?php print($this->data['address_1']);?>" class="input-xlarge"> <a href="javascript:" onclick="addField('Address_')"><i class="icon-pencil"></i></a>	<a href="javascript:" onclick="delField('Address_')"><i class="icon-remove"></i></a>
								<span id="Address_">
								<?php
									if($this->data['address_2'] != null)
									{
										echo "<div>地址2</br> <input type=text name= address_2 value=".$this->data['address_2']." class=input-xlarge></div>";
										if($this->data['address_3'] != null)
										{
											echo "<div>地址3</br> <input type=text name= address_3 value=".$this->data['address_3']." class=input-xlarge></div>";
										}
									}
								?>
								</span>
								
								<label>電話</label>
								<input type="text" name = "Tel" value="<?php print($this->data['tel_1']);?>" class="input-xlarge"> <a href="javascript:" onclick="addField('Tel_')"><i class="icon-pencil"></i></a>	<a href="javascript:" onclick="delField('Tel_')"><i class="icon-remove"></i></a>
								<span id="Tel_">
								<?php
									if($this->data['tel_2'] != null)
									{	
										echo "<div>電話2</br> <input type=text name= tel_2 value=".$this->data['tel_2']." class=input-xlarge></div>";
										if($this->data['tel_3'] != null)
										{
											echo "<div>電話3</br> <input type=text name= tel_3 value=".$this->data['tel_3']." class=input-xlarge></div>";
										}
									}
								?>
								</span>
								
								<label>傳真</label>
								<input type="text" name = "Fax" value="<?php print($this->data['fax']);?>" class="input-xlarge">
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
				var countMax = 3;
				var contMin = <?php echo $this->data[14];?>;
				var AddrMin = <?php echo $this->data[15];?>;
				var TelMin = <?php echo $this->data[16];?>;
				var commonName 
												
				function addField(name) { 
					
					if(name == "contacter_")
					{	
						var count = contMin;
						if	(contMin < 3)
						{						
							++contMin;
						}
						commonName	= "聯絡人";		
					}
					else if(name == "Address_")
					{
						var count = AddrMin;
						if	(AddrMin < 3)
						{						
							++AddrMin;
						}
						commonName	= "地址";					
					}
					else if(name == "Tel_")
					{
						var count = TelMin;
						if	(TelMin < 3)
						{						
							++TelMin;
						}
						commonName	= "電話";						
					}
				function delField(name) {
					if(name	==	"contacter_")
					{	
						count = contMin;
						if(contMin > 1)
						{
							contMin--;
						}
					}
					else if(name == "Address_")
					{
						count = AddrMin;
						if(AddrMin > 1)
						{
							AddrMin--;
						}
					}
					else if(name == "Tel_")
					{						
						count = TelMin;
						if(TelMin > 1)
						{
							TelMin--;
						}
					}	
					if (count > countMin) {
						var fs = document.getElementById(name); 
						fs.removeChild(fs.childNodes[count-1]);
						//alert("已刪除最後一個欄位");
					} else {
						alert("無新增欄位可以刪除");
					}	
				}
			</script>
		</body>
	</html>

