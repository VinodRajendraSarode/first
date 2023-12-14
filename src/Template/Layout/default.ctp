<?php echo $this->element('header'); ?>
      <section class="carousel-slider-main text-center border-top border-bottom bg-white">
         <div class="owl-carousel owl-carousel-slider">
            <div class="item">
               <a href="/"><img class="img-fluid" src="/files/slider.jpg" alt="Shop For Change"></a>
            </div>            
         </div>
      </section>
      <!--
      <section class="top-category section-padding">
         <div class="container">            
            <?php //$this->fetch('content'); ?>
         </div>
      </section>
      -->
      <section class="product-items-slider pt-5">
         <div class="container">
            <div class="section-header">
               <h3 class="text-center">Featured Categories <!--<span class="badge badge-success">&nbsp;</span>-->
                  <!--<a class="float-right text-secondary" href="/all-products">View All</a>-->
               </h3>
            </div>
            <?php echo $this->element('product-groups');?>
         </div>
      </section>
     <section class="product-items-slider">
         <div class="container">
            <div class="section-header">
               <h3 class="text-center">Today's Top <!--<span class="badge badge-success">&nbsp;</span>-->
                  <a class="float-right text-secondary"  href="/all-products"style="font-size: 14px;" >View All</a>
               </h3>
            </div>
            <?php echo $this->element('top-products');?>
         </div>
      </section>
      <section class="offer-product bg-white pt-5">
         <div class="container">
            <div class="row no-gutters">
               <div class="col-md-12">
                  <a href="#"><img class="img-fluid" src="/web_u_i/img/ad/1.jpg" alt=""></a>
               </div>
               
            </div>
         </div>
      </section>
      
      <section class="section-padding bg-white border-top">
      <div class="container">
         <div class="row">
            <div class="col-lg-3 col-sm-6">
               <div class="feature-box"> 
                  <img src="/web_u_i/img/logo_.png" alt="logo">
                  <h4 class="features">Features</h4>
               </div>
            </div><div class="col-lg-3 col-sm-6">
               <div class="feature-box"> <i class="mdi  mdi-star"></i>
                  <h6>Fair<br />Trade</h6>
               </div>
            </div>
            <div class="col-lg-3 col-sm-6">
               <div class="feature-box"> <i class="mdi mdi-truck-fast"></i>
                  <h6>Free<br />Delivery**</h6>
               </div>
            </div>
            <div class="col-lg-3 col-sm-6">
               <div class="feature-box"> <i class="mdi mdi-thumb-up"></i>
                  <h6>100%<br />Satisfaction</h6>
               </div>
            </div>
         </div>
      </div>
      </section>

      <!--<div class="container">
      <section class=" bg-dark inner-header p-3">
            <div class="row">
               <div class="col-md-12 text-center">
                  <h6 class="mt-0 mb-3 text-white">We Humbly Take Credit for Being India’s 1st Online Fair Trade Store That Reaches Out to Goals Beyond Profits to Ensure Sustainable Livelihoods for Artisans / farmers Across India.</h6>
               </div>
            </div>
      </section>
      </div>-->
      
      
   </div>
   <?php if(empty($this->AuthUser->user())) { ?>
   <script>
   /*
   $(document).ready(function(){
      $('#notice-modal').modal();
   });
   */
   </script>
   <?php } ?>
   <?php echo $this->element('footer'); ?>



