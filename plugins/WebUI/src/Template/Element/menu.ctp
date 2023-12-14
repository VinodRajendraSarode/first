<!-- /top_menu -->
<a href="#menu" class="btn_mobile">
	<div class="hamburger hamburger--spin" id="hamburger">
		<div class="hamburger-box">
			<div class="hamburger-inner"></div>
		</div>
	</div>
</a>
<nav id="menu" class="main-menu">
	<ul>
		<li><span><a href="/">Home</a></span></li>
		<li><span><a href="/about-us">About Us</a></span></li>
		<li><span><a href="/listings/">Listings</a></span></li>
		<?php if($this->AuthUser->user()) { ?>
		
			<?php if($this->AuthUser->user('is_vendor') == true) { ?>
				<li><a href="/listings/myListings" class="btn_add">Welcome <?= $this->AuthUser->user('name'); ?></a></li>
				<li><a href="/listings/add" class="btn_add">Add Listing</a></li>
			<?php } else { ?>
				<li><a href="/listings/index" class="btn_add">Welcome <?= $this->AuthUser->user('name'); ?></a></li>
			<?php } ?>
			<li><a href="/members/logout/" class="btn_add">Logout</a></li>
		<?php } else { ?>
			<li><a href="/members/login/" class="btn_add">Login</a></li>		
			<li><a href="/members/register" class="btn_add">Register</a></li>
		<?php } ?>
	</ul>
</nav>
