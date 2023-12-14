<div class="custom-scroll custom-scroll-light">
	<ul class="sidebar-menu">
		<li class="compact-hide">
			<a href="#" class="waves-effect  waves-light">
				<span class="s-icon"><i class="ti-anchor"></i></span>
				<span class="s-text">Dashboard</span>
			</a>
		</li>
		<li class="with-sub">
			<a href="#" class="waves-effect  waves-light">
				<span class="s-caret"><i class="fa fa-angle-down"></i></span>
				<span class="s-icon"><i class="fa fa-file-text"></i></span>
				<span class="s-text">Master</span>
			</a>
			<ul>
				<li><?= $this->AuthUser->link(__('Country'), ['controller'=>'Countries','action' => 'index']) ?></li>
				<li><?= $this->AuthUser->link(__('Province'), ['controller'=>'States','action' => 'index']) ?></li>
				<li><?= $this->AuthUser->link(__('City'), ['controller'=>'Cities','action' => 'index']) ?></li>
				<li><?= $this->AuthUser->link(__('Categories'), ['controller'=>'Categories','action' => 'index']) ?></li>
				<li><?= $this->AuthUser->link(__('Sub Categories'), ['controller'=>'SubCategories','action' => 'index']) ?></li>
				<li><?= $this->AuthUser->link(__('Members'), ['controller'=>'Members','action' => 'index']) ?></li>
				<li><?= $this->AuthUser->link(__('Packages'), ['controller'=>'Packages','action' => 'index']) ?></li>
				<li><?= $this->AuthUser->link(__('Listing'), ['controller'=>'Listings','action' => 'index']) ?></li>
				<li><?= $this->AuthUser->link(__('Subscriptions'), ['controller'=>'Subscriptions','action' => 'index']) ?></li>

			</ul>
		</li>
		<li class="with-sub">
			<a href="#" class="waves-effect  waves-light">
				<span class="s-caret"><i class="fa fa-angle-down"></i></span>
				<span class="s-icon"><i class="fa fa-file-text"></i></span>
				<span class="s-text">Report</span>
			</a>
			<ul>
				<li><?= $this->AuthUser->link(__('Subscription Report'), ['plugin'=>false, 'controller'=>'Reports','action' => 'SubscriptionReport']) ?></li>

			</ul>
		</li>

		<li class="with-sub">
			<a href="#" class="waves-effect  waves-light">
				<span class="s-caret"><i class="fa fa-angle-down"></i></span>
				<span class="s-icon"><i class="fa fa-file-text"></i></span>
				<span class="s-text">Content</span>
			</a>
			<ul>
				<li><?= $this->AuthUser->link(__('Pages'), ['plugin'=>false, 'controller'=>'Pages','action' => 'index']) ?></li>
				<li><?= $this->AuthUser->link(__('Sections'), ['plugin'=>false, 'controller'=>'Sections','action' => 'index']) ?></li>
			</ul>
		</li>


		<?php
			if(
				$this->AuthUser->hasAccess(['controller'=>'Roles','action' => 'index']) ||
				$this->AuthUser->hasAccess(['controller'=>'Users','action' => 'index'])
			) {
		?>
		<li class="with-sub">
			<a href="#" class="waves-effect  waves-light">
				<span class="s-caret"><i class="fa fa-angle-down"></i></span>
				<span class="s-icon"><i class="fa fa-file-text"></i></span>
				<span class="s-text">Security</span>
			</a>
			<ul>
				<li><?= $this->AuthUser->link(__('Roles'), ['plugin'=>false, 'controller'=>'Roles','action' => 'index']) ?></li>
				<li><?= $this->AuthUser->link(__('Users'), ['plugin'=>false, 'controller'=>'Users','action' => 'index']) ?></li>
				<li><?= $this->AuthUser->link(__('Permissions'), ['plugin'=>false, 'controller'=>'Auth','action' => 'index']) ?></li>
			</ul>
		</li>
		<?php } ?>
	</ul>
</div>
