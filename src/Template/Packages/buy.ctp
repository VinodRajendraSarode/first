<main>
	<div class="container margin_60 ">
		<div class="pricing-container cd-has-margins">
			<ul class="pricing-list bounce-invert">
				<?php foreach ($packages as $package): //debug($package);exit; ?>
					<li>
						<ul class="pricing-wrapper">
							<li data-type="monthly" class="is-visible">
								<header class="pricing-header">
									<h2><?php echo $package->package; ?></h2>
									<!--<div class="price">
										<span class="currency">$</span>
										<span class="price-value">30</span>
										<span class="price-duration">mo</span>
									</div>-->
								</header>
								<!-- /pricing-header -->
								<div class="pricing-body">
									<ul class="pricing-features">
										<li><em>No of Listing</em> <?php echo $package->no_of_listings; ?></li>
										<li><em>Period</em> <?php echo $package->period; ?></li>
										<!--<//?php if($package->active == '1'){ ?>
										<li><em>Status</em><span class="text-success">Active</span> </li>
										<//?php }else{?>
											<li><em>Status</em><span class="text-danger">InActive</span></li>
										<//?php }?>-->
									</ul>
								</div>
								<!-- /pricing-body -->
								<footer class="pricing-footer">
									<a class="select-plan" href="/members/buy/<?php echo $package->id;?>">Add Listing</a>
								</footer>
							</li>
						</ul>
						<!-- /pricing-wrapper -->
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</div>
			<!-- /container -->

		
			<!--/bg_color_1-->
		</main>