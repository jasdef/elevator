	<div class="navbar">
        <div class="navbar-inner">
			<ul class="nav pull-right">
				<li id="fat-menu" class="dropdown">
					<a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-user"></i> <?=$_SESSION["account"]. " 您好"?>
						<i class="icon-caret-down"></i>
					</a>

					<ul class="dropdown-menu">
						<li><a tabindex="-1" href="#">My Account</a></li>
						<li class="divider"></li>
						<li><a tabindex="-1" class="visible-phone" href="#">Settings</a></li>
						<li class="divider visible-phone"></li>
						<li><a tabindex="-1" href="<?=base_url("/home/logout")?>">Logout</a></li>
					</ul>
				</li>
			</ul>
			<a class="brand" href="<?=base_url("/mainpage/index")?>"><span class="second">利通電梯</span></a>
        </div>
    </div>