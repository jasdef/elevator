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

			function addOption(list, text, value, selectIndex)
			{
				var index=list.options.length;
				list.options[index]=new Option(text, value);
				if (selectIndex != 0)
					list.selectedIndex = index;
			}				
			
			
			</script>
			<?php
				include "navbar.php";
				include "sidebar-nav.php";
			?>
		
			<div class="content">
				
				<div class="header">
					
					<h1 class="page-title">派遣員工</h1>
				</div>
				
					<ul class="breadcrumb">
						<li><a href="<?=base_url("/mainpage/index")?>">首頁</a> <span class="divider">/</span></li>
						<li><a href="<?=site_url("/dispatch/dispatch_home")?>">派遣列表</a> <span class="divider">/</span></li>
						<li class="active">派遣員工</li>
					</ul>

				<div class="container-fluid">
					<div class="row-fluid">
						<form id="tab" name="fomr1" action="<?=site_url("/dispatch/change_staff")?>" method="post" enctype="multipart/form-data">
							<div class="btn-toolbar">
								<button class="btn btn-primary" type="submit"><i class="icon-plus"></i>儲存</button>
								<button class="btn" type="button" onclick="history.back()">取消</button>
							</div>
							<div class="well">
								<table class="table sortable">
									<tr>
									<th>
									編號<br>
									<input type="text" name = "Id" value="<?php print($this->data['id']);?>" readonly="readonly" style=width:200px>
									</th>
									</tr>
									
									<tr>
									<th>								
									員工選擇<br>
									<select id="Staff" name="Staff" style=width:215px >
										<option value = 0 selected="selected">請選擇員工</option>
									</select>
									<?php 
									   if ($this->data['all_staff'] != 0)
									   {
										  
											foreach($this->data['all_staff'] as $row)
											{			
												$selectIndex = 0;
												if ($row->id == $this->data['staff'])
													$selectIndex = $row->id;										
									?>
										<script type='text/javascript'>
											addOption(document.getElementById("Staff"), "<?php echo $row->name;?>", "<?php echo $row->id;?>", "<?php echo $selectIndex;?>");
										</script>								
									<?php
											}
									   }
									?>	
									</th>
									</tr>
								</table>
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


