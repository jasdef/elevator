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
					
					<h1 class="page-title">新增客戶</h1>
				</div>
				
					<ul class="breadcrumb">
						<li><a href="<?=base_url("/mainpage/index")?>">首頁</a> <span class="divider">/</span></li>
						<li><a href="<?=site_url("/customer/customer_home")?>">客戶管理</a> <span class="divider">/</span></li>
						<li class="active">新增客戶</li>
					</ul>

				<div class="container-fluid">
					<div class="row-fluid">
						<form id="tab" action="<?=site_url("/customer/customer_create")?>" method="post">
							<div class="btn-toolbar">
								<button class="btn btn-primary" type="submit"><i class="icon-plus"></i>新增</button>
								<a href=""<?=base_url("/customer/customer_home")?>""><button class="btn ">取消</button></a>
							</div>
							<div class="well">
								<label>公司名稱</label>
								<input type="text" name = "company" value="" class="input-xlarge">
								
								
								<label>聯絡人</label>
								<input type="text" name = "contacter_1" value="" class="input-xlarge">	<a href="javascript:" onclick="addField('contacter_')"><i class="icon-pencil"></i></a>	<a href="javascript:" onclick="delField('contacter_')"><i class="icon-remove"></i></a>	
								<span id="contacter_"></span> 
						
								
								
								<label>地址</label>
								<input type="text" name = "Address_1" value="" class="input-xlarge">	<a href="javascript:" onclick="addField('Address_')"><i class="icon-pencil"></i></a>	<a href="javascript:" onclick="delField('Address_')"><i class="icon-remove"></i></a>
								<span id="Address_"></span> 
																
								<label>電話</label>								
								<input type="text" name = "Tel_1" value="" class="input-xlarge">	<a href="javascript:" onclick="addField('Tel_')"><i class="icon-pencil"></i></a>	<a href="javascript:" onclick="delField('Tel_')"><i class="icon-remove"></i></a>
								<span id="Tel_"></span> 
								
								
								<label>傳真</label>
								<input type="text" name = "Fax" value="" class="input-xlarge">
								
								<label>統一編號</label>
								<input type="text" name = "Num" value="" class="input-xlarge">
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
			
			<script> //新增欄位 java script
				var countMin = 1; 
				var countMax = 3;
				var contMin = 1;
				var AddrMin = 1;
				var TelMin = 1;
				var commonName ;
				function addField(name) { 
					
					if(name == "contacter_")
					{	
						var count = contMin;	
						++contMin;
						commonName	= "聯絡人";		
					}
					else if(name == "Address_")
					{
						var count = AddrMin;
						++AddrMin;
						commonName	= "地址";					
					}
					else if(name == "Tel_")
					{
						var count = TelMin;
						++TelMin;
						commonName	= "電話";						
					}
					if(count == countMax) 
						alert("最多"+countMax+"個欄位"); 
					else	 
						document.getElementById(name).innerHTML += "<div>" + commonName+(++count) +"</br>"+ '<input type="text" name="' + name + count + '"class="input-xlarge"></div>';	 
				}
				function delField(name) {
					if(name	==	"contacter_")
					{								
						count = contMin;
						contMin--;
					}
					else if(name == "Address_")
					{
						count = AddrMin;
						AddrMin--;
					}
					else if(name == "Tel_")
					{						
						count = TelMin;
						TelMin--;
					}		
					if (count > countMin) {
						var fs = document.getElementById(name); 
						fs.removeChild(fs.lastChild);
					} else {
						alert("無新增欄位可以刪除");
					}	
				}
			</script>
			
		</body>
	</html>


