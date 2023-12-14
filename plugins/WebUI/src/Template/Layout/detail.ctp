<?php echo $this->element('header'); ?>
<div id="page" class="theia-exception">
	<header class="header_in">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-12">
					<div id="logo" class="p-0">
						<a href="/" title="">
						<?php
							echo $this->Html->image(\Cake\Core\Configure::read('logo.name'), ['class'=>'']);
						?>
						</a>
					</div>
				</div>
				<div class="col-lg-9 col-12">
					<?= $this->element('menu'); ?>
				</div>
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</header>
	<!-- /header -->
	<main class="">
		<div id="results">
		   <div class="container">
			   <div class="row">
			   	<!-- <div class="col-lg-3 col-md-4 col-10"><h4><strong><//?php if(!empty($data)){ ?>We have serach "<//?php echo $data;?>"<//?php }?></strong></h4></div> -->
					<div class="col-lg-12 col-md-12 col-2">
						    <?= $this->Form->create(null,['url'=>['controller'=>'Listings', 'action'=>'search'],['class'=>'form-inline','valueSources' => 'query','id'=>'SearchForm']]) ?>
							<a href="#0" class="search_mob btn_search_mobile"></a>
							<div class="row  custom-search-input-2 inner">
								<div class="col-lg-5">
									<div class="form-group">
										<div class="typeahead__container">
											<?php echo $this->Form->control('listing',['label'=>false,'class'=>"form-control listing-type", 'type'=>"text", 'placeholder'=>"What are you looking for...", 'autocomplete'=>'off']); ?>
										</div>
									</div>
								</div>
								<!-- city -->
								<div class="col-lg-3">
									<?php							
										$cities = $this->City->getCities(); 
										echo $this->Form->control('cities', ['label'=>false, 'options'=>$cities, 'class'=>'wide', 'empty'=>'search by city']);
									?>
								</div>
								<!-- city -->
								<div class="col-lg-3">
									<?php
										$category = $this->Ctgy->getCategory();
										echo $this->Form->control('category', ['label'=>false, 'options'=>$category, 'class'=>'wide ft', 'empty'=>'Search by category']);
									?>
								</div>
								
								<div class="col-lg-1">
									<input type="submit" value="Search">
								</div>
							</div>
							<!-- /row -->
				            <?= $this->Form->end() ?>
					</div>
			   </div>

			   
				<div class="search_mob_wp">
					<div class="custom-search-input-2">
                        <?= $this->Form->create(null,['url'=>['controller'=>'Listings', 'action'=>'search'],['class'=>'form-inline','valueSources' => 'query','id'=>'SearchForm']]) ?>
						<div class="form-group">
							<div class="typeahead__container">
								<?php echo $this->Form->control('listing',['label'=>false,'class'=>"form-control listing-type", 'type'=>"text", 'placeholder'=>"What are you looking for..."]); ?>								
							</div>
						</div>
						<!-- city -->
						
							<?php							
								$cities = $this->City->getCities(); 
								echo $this->Form->control('cities', ['label'=>false, 'options'=>$cities, 'class'=>'wide', 'empty'=>'search by city']);
							?>

							<?php
								$category = $this->Ctgy->getCategory();
								echo $this->Form->control('category', ['label'=>false, 'options'=>$category, 'class'=>'wide ft', 'empty'=>'Search by category']);
							?>
						
						<!-- city -->
						
						<input type="submit" value="Search">
                        <?= $this->Form->end() ?>
					</div>
				</div>
				<!-- /search_mobile -->
		   </div>
		   <!-- /container -->
	   </div>
		<div class="container mt-5 margin_60_35">
			<?= $this->Flash->render(); ?>
			<div id="ajaxDiv">
				<?= $this->fetch('content'); ?>						
			</div>
				<!-- /row -->
		</div>
		<!-- /container -->
		
	</main>
	<!--/main-->
	
<?php echo $this->element('footer'); ?>