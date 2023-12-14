<?php 
	use Cake\I18n\Number;
	use Cake\Core\Configure;

	$url = $this->Url->build('/', [
		'escape' => false,
		'fullBase' => true,
	],true);

?>
<nav class="navbar navbar-light">
	<div class="navbar-left">
		<a class="navbar-brand" href="/Dashboard/index">
			<p style="color:#fff;"><?= Configure::read("Project.name"); ?></p>
			<!--<div class="logo"></div>-->
		</a>
		<div class="toggle-button dark sidebar-toggle-first float-xs-left hidden-md-up">
			<span class="hamburger"></span>
		</div>
		<div class="toggle-button dark float-xs-right hidden-md-up" data-toggle="collapse" data-target="#collapse-1">
			<span class="more"></span>
		</div>
	</div>
	<div class="navbar-right navbar-toggleable-sm collapse" id="collapse-1">
		<div class="toggle-button light sidebar-toggle-second float-xs-left hidden-sm-down">
			<span class="hamburger"></span>
		</div>
		<ul class="nav navbar-nav float-md-right">
			<li class="nav-item dropdown hidden-sm-down">
				<a href="#" data-toggle="dropdown" aria-expanded="false">
					<!--
					<span class="avatar box-32">
						<?php 
							/*$string = "";
							$expr = '/(?<=\s|^)[a-z]/i';
							preg_match_all($expr, $string, $matches);
							$result = implode('', $matches[0]);
							$result = strtoupper($result);*/
						?>
						<button class="btn btn-circle btn-icon-only btn-black" data-toggle="tooltip" data-placement="bottom" title=""><?php //echo $result; ?></button>
					</span>
					-->
					<span class="avatar box-32">
						<?php echo $this->Html->image('/img/avatars/avatar.png'); ?>
					</span>		
				</a>
				<div class="dropdown-menu dropdown-menu-right animated fadeInUp">
					<!--<?php 
						//echo $this->Html->link('<i class="ti-user mr-0-5"></i> Update Profile',['controller'=>'associates','action'=>'profile'],['class' => 'dropdown-item','escape'=>false]); 
					?>-->
					<div class="dropdown-divider"></div>
					<?php 
						echo $this->Html->link('<i class="ti-eraser mr-0-5"></i> Change Password',['controller'=>'account','action'=>'changePassword'],['class' => 'dropdown-item','escape'=>false]); 
						echo $this->Html->link('<i class="ti-power-off mr-0-5"></i> Sign out',['controller'=>'account','action'=>'logout'],['class' => 'dropdown-item','escape'=>false]); 
					?>
				</div>
			</li>
		</ul>
	</div>
</nav>
