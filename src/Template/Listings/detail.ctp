
<script>
$(document).ready(function() {
    $('.item').click(function() {
        var id = $(this).attr('id');
        $.ajax({
            type: "POST",
            url: "/Listings/addFavourite/" + id,
            data: {
                listing_id: id
            },
            dataType: "json"
        }).done(function(data) {            
            alert(data['success']);
            location.reload();          
           
        });
    });
});
 </script>
 <style>
    .owl-carousel .owl-next,
    .owl-carousel .owl-prev {
        width: 40px;
        height: 40px;
        line-height: 50px;
        border-radius: 50%;
        position: absolute;
        top: 40%;
        font-size: 20px;
        color: #fff;
        text-align: center;
    }
    .owl-carousel .owl-prev {
        left: 0px;
    }
    .owl-carousel .owl-next {
        right: 0px;
    }
 </style>
<div class="row">
    <div class="col-lg-8">
        <div id="carousel_in" class="owl-carousel owl-theme">
            <?php if(!empty($listing->banner)) { ?>			
            <div class="item">
                <?= $this->Html->image('/files/listings/banner/'.$listing->banner_dir.'/proper_'.$listing->banner, ['class'=>'img-fluid']) ?>
            </div>
            <?php } ?>

            <?php if(!empty($listing->image)) { ?>
            <div class="item">
                <?= $this->Html->image('/files/listings/image/'.$listing->image_dir.'/proper_'.$listing->image, ['class'=>'img-fluid']) ?>
            </div>
            <?php } ?>

            <?php if(!empty($listing->image_1)) { ?>
            <div class="item">
                <?= $this->Html->image('/files/listings/image_1/'.$listing->image_1_dir.'/proper_'.$listing->image_1, ['class'=>'img-fluid']) ?>
            </div>
            <?php } ?>

            <?php if(!empty($listing->image_2)) { ?>
            <div class="item">
                <?= $this->Html->image('/files/listings/image_2/'.$listing->image_2_dir.'/proper_'.$listing->image_2, ['class'=>'img-fluid']) ?>
            </div>
            <?php } ?>

            <?php if(!empty($listing->image_3)) { ?>
            <div class="item">
                <?= $this->Html->image('/files/listings/image_3/'.$listing->image_3_dir.'/proper_'.$listing->image_3, ['class'=>'img-fluid']) ?>
            </div>
            <?php } ?>

            <?php if(!empty($listing->image_4)) { ?>
            <div class="item">
                <?= $this->Html->image('/files/listings/image_4/'.$listing->image_4_dir.'/proper_'.$listing->image_4, ['class'=>'img-fluid']) ?>
            </div>
            <?php } ?>          
        </div>
        <script>
        $('#carousel_in').owlCarousel({
            center: false,
            items: 1,
            loop: true,
            dots:true,
            nav:true,
            navText: ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
            margin: 0
        });      
        </script>
    </div>
    <!-- /col -->

    <aside class="col-lg-4" id="sidebar">
        <div class="box_detail  booking ">
            <div class="price">
                <h5 class="d-inline mr-2"><strong><?= $listing->listing_title ?></strong></h5>
				<div class="score">
                    <span><?php if($listing->avg_rating >= 4.0){ ?> Very Good
                    <?php } else if($listing->avg_rating >= 3.0){ ?> Good
                    <?php } else if($listing->avg_rating >= 2.0) { ?> Average <?php } else { ?> Below Average
                    <?php } ?> <em> <?= $listing->count ?> Reviews</em></span>
                    <strong> <?= $listing->avg_rating ?></strong>
                </div>
            </div>
            <!-- section2 -->
            <?php if(!empty($listing->mobile && $listing->hide_contact == false)) {?>
            <div class="d-flex align-items-center bg-white rounded p-2" style="">
                <div class="icon me-3" style="width: 25px; height: 25px;">
                    <i class="fa fa-phone" style="color:#ed2124"></i>
                </div>
                <span class="pl-2"><a target="_blank"
                        href="tel:+91<?= $listing->mobile ?>"><?= $listing->mobile ?></a></span>
            </div>
            <?php }?>

            <!-- section3 -->
            <?php if(!empty($listing->email)) {?>
            <div class="d-flex align-items-center bg-white rounded p-2" style="">
                <div class="icon me-3" style="width: 25px; height: 25px;">
                    <i class="fa fa-envelope" style="color:#ed2124"></i>
                </div>
                <span class="pl-2"><a href="mailto:<?= $listing->email ?>"><?= $listing->email ?></a></span>
            </div>
            <?php }?>
            <?php if(!empty($listing->website)) {?>
            <div class="d-flex align-items-center bg-white rounded p-2" style="">
                <div class="icon me-3" style="width: 25px; height: 25px;">
                    <i class="fa fa-link" style="color:#ed2124"></i>
                </div>
                <span class="pl-2"><a href="<?= $listing->website ?>"><?= $listing->website ?></a></span>
            </div>
            <?php }?>

            <!-- section4 -->
           

            <!-- section5 -->
            <?php if(!empty($listing->hourly_rate)) {?>
            <div class="d-flex align-items-center bg-white rounded p-2" style="">
                <div class="icon me-3" style="width: 25px; height: 25px;">
                    <i class="fa fa-dollar" style="color:#ed2124"></i>
                </div>
                <span class="pl-2"><strong>Hourly Rate :</strong> <?= $listing->hourly_rate ?></span>
            </div>
            <?php }?>

            <!-- section6 -->
            <?php if(!empty($listing->daily_rate)) {?>
            <div class="d-flex align-items-center bg-white rounded p-2" style="">
                <div class="icon me-3" style="width: 25px; height: 25px;">
                    <i class="fa fa-dollar" style="color:#ed2124"></i>
                </div>
                <span class="pl-2"><strong>Daily Rate :</strong> <?= $listing->daily_rate ?></span>
            </div>
            <?php }?>
          

            <?php if($this->AuthUser->user()){ ?>
            <div class="d-flex align-items-center bg-white rounded p-2">
                <?= $this->Form->create($listing, ['url' => ['controller' => 'Listings', 'action' => 'message'],  'style'=>'width:100%']); ?>
                <h5 class="font-weight-bold"> <span>Contact Vendor</span> </h5>


                <?= $this->Form->control('from_date', ['name'=>"from_date", 'format'=>'DDMMYY']); ?>
                <?= $this->Form->control('to_date', ['name'=>"to_date", 'format'=>'DDMMYY']); ?>
                <?= $this->Form->control('message',['rows'=>3, 'placeholder'=>'Hi, please contact me if it’s available!!', 'default'=>'Hi, please contact me if it’s available!!']) ?>
                <div align="center">                    
                    <button class="btn_1 full-width">Send</button>               
                    <?php if(!empty($this->AuthUser->User('id'))) { ?>
                    <?php if(!empty($favourate)){	?> 
                        <a href="#"  class="btn_1 full-width outline wishlist item" id="<?php echo $listing->id ?>"> <i class="icon_heart like"></i> Remove from wishlist</a>  
                    <?php } else{ ?>
                        <a href="#"   class="btn_1 full-width outline wishlist item"  id="<?php echo $listing->id ?>"><i class="icon_heart"></i> Add to wishlist</a>
                    <?php }  } ?>     
                </div>
                <?= $this->Form->end();?>              
            </div>
            <?php } else{ ?>
            <div class="d-flex align-items-center bg-white rounded p-2">
                <a href="/members/login" class="btn_1">Login to Contact Vendor</a>
            </div>
            <?php } ?>

            <!-- section7 -->


        </div>

    </aside>
</div>
<!-- /row -->
<div class="row">
    <div class="col-lg-8">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                    aria-selected="true">Description</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                    aria-controls="profile" aria-selected="false">Reviews</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="bg-white p-3" style="min-height: 780px;">
                    <h4 class="font-weight-bold"><?= $listing->listing_title ?></h4>
                    <p><?= $listing->description ?></p>
                    <?php   if(!empty($listing->business_hours)) { 
                            $business = json_decode($listing->business_hours);

                            // debug($business); exit;
                           
                        ?> 
                    <div class="opening">
                        <div class="ribbon">
                            <span class="open">Now Open</span>
                        </div>
                        <i class="icon_clock_alt"></i>
                        <h4 class="font-weight-bold">Opening Hours</h4>
                        <div class="row">                            
                            <div class="col-md-6">
                                <table  width="100%">
                                    <tbody>
                                    <?php $arr= [
                                        'Friday',
                                        'Saturday',
                                        'Sunday'
                                    ]; $count = 0;
                                    foreach($business as $i=>$day){ 
                                        if($count <= 3)  {                                     
                                        if($day == 'Closed'){  $count++;  ?>        
                                         <tr>
                                            <td  width="50%"><?= $i ?>  &emsp;</td>
                                            <td>Closed</td>
                                        </tr>                      
                                           
                            
                                        <?php } else if($day[0] != ''){ ?>
                                            <tr>
                                            <td  width="50%"><?= $i ?>  &emsp; </td>
                                            <td><?= $day[0]."-".$day[1] ?></td>
                                        </tr>  
                                       
                                    <?php  $count++; 
                                         }  $check = $i; } } ?>
                                    </tbody>
                                </table>                                
                            </div>   
                            <div class="col-md-6">
                                <table width="100%">
                                    <tbody>
                                    <?php $count = 0;  foreach($business as $i=>$day){ 
                                        if($check == $i)  {
                                            $count = 1;
                                            continue;
                                         }
                                      
                                         if($count == 1)  {     

                                        if($day == 'Closed'){    ?>        
                                         <tr>
                                            <td width="50%"><?= $i ?>  &emsp;</td>
                                            <td>Closed</td>
                                        </tr>                      
                                           
                            
                                        <?php } else if($day[0] != ''){ ?>
                                            <tr>
                                            <td  width="50%"><?= $i ?>  &emsp; </td>
                                            <td><?= $day[0]."-".$day[1] ?></td>
                                        </tr>  
                                       
                                    <?php } }   } ?>
                                    </tbody>
                                </table>                                
                            </div>                             
                        </div>
                    </div> 
                    <?php }?> <br>                    
                    <?php if(!empty($listing->google_location)) { ?>
                        <h4 class="font-weight-bold">Location</h4>
                        <div class="d-flex align-items-center bg-white rounded p-2 price" style="">
                            <?= $listing->google_location ?>
                        </div>
                     <?php } ?>



                     <section>                        
                        <h4 class="font-weight-bold">Reviews</h4>
                        <div class="box box-block bg-white p-3 mt-1">
                            <?php if($this->AuthUser->user()) { ?>
                            <?= $this->Form->create($comment,['type'=>'file','novalidate'=>true]) ?>
                            <fieldset>
                                <h5 class="font-weight-bold">Post your Review</h5>
                                <div class="rate"></div>
                                <?php echo $this->Form->hidden('rating', ['id'=>'rating']); ?>
                                <?php echo $this->Form->control('comment', ['rows' => 3]); ?>
                            </fieldset>
                            <fieldset>
                                <div class="pull-right">
                                    <button class="btn_1">Post</button>
                                </div>
                            </fieldset>
                        </div>
                        <?= $this->Form->end() ?>
                        <?php } else { ?>
                           
                            <div class="box box-block bg-white p-3 mt-1">
                                <strong>Login to Post Review.</strong><br>
                                <?php echo $this->Form->create('User',array('url' => ['controller'=>'Members','action' => 'login'],'class'=>'form-material mb-1 material-danger'));?>
                                <div class="form-group">
                                    <?= $this->Form->input('email',['class'=>'form-control','label'=>false,'type'=>'text','placeholder'=>'Email']);?>
                                </div>
                                <div class="form-group">
                                    <?= $this->Form->input('password',['class'=>'form-control','label'=>false,'type'=>'password','placeholder'=>'Password']);?>
                                    <?= $this->Form->hidden('origin') ?>
                                </div>
                                <div class="clearfix add_bottom_15">
                                    <div class="float-right"><a id="forgot" href="javascript:void(0);">Forgot Password?</a></div>
                                </div>
                                <div class="px-2 form-group mb-3">
                                    <button type="submit" class="btn_1 btn-block text-uppercase">Log in</button>
                                </div>
                                <?php echo $this->Form->end();?>
                                <div class="p-2 text-xs-center text-muted">
                                    <?= $this->Form->postLink($this->Html->image('google_login.png'), '/oauth/google', ['escape'=>false]); ?>
                                </div>
                                <div class="px-2 form-group">
                                    <span align=left><strong>New User? .</strong></span>
                                    <span><?= $this->Html->link('Register Now', ['controller'=>'Members','action'=>'register']) ?></span>
                                </div>
                                <?php echo $this->Form->create(null,array('url' => ['controller'=>'Members','action' => 'forgot'],'class'=>'form-material mb-1 material-danger'));?>
                                <div id="forgot_pw">
                                    <div class="form-group">
                                        <input type="email" class="form-control" name="email" id="email"
                                            placeholder="Type your email">
                                    </div>
                                    <p>A new password will be sent shortly.</p>
                                    <div class="text-center"><input type="submit" value="Reset Password" class="btn_1"></div>
                                </div>
                                <?php echo $this->Form->end();?>

                            </div>
                        <?php } ?>
                        <div class="reviews-container add_bottom_30">
                            <div class="row">
                                <div class="col-lg-3">
                                    <div id="review_summary">
                                        <strong><?= $listing->avg_rating ?></strong>
                                        <em><?php if($listing->avg_rating >= 4.0){ ?> Very Good
                                            <?php } else if($listing->avg_rating >= 3.0){ ?> Good
                                            <?php } else if($listing->avg_rating >= 2.0) { ?> Average <?php } else { ?> Below Average <?php } ?>
                                        </em>
                                        <small>Based on <?= $listing->count ?> reviews</small>
                                    </div>
                                </div>                               
                                <div class="col-lg-9"> 
                                                                     
                                    <div class="row">
                                        <div class="col-lg-10 col-9">
                                            <div class="progress">
                                                <?php if(!empty($combine['5'])) {
                                                    $avg = $combine['5'] / $listing->count *100;
                                                ?>
                                                <div class="progress-bar" role="progressbar" style="width: <?= $avg ?>%" aria-valuenow="<?= $avg ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                <?php } else { ?>
                                                    <div class="progress-bar" role="progressbar" style="width: 0" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-3"><small><strong>5 stars</strong></small></div>
                                    </div>
                                   
                                    <!-- /row -->                                   
                                    <div class="row">
                                        <div class="col-lg-10 col-9">
                                            <div class="progress">
                                                <?php if(!empty($combine['4'])) {
                                                    $avg = $combine['4'] / $listing->count *100;
                                                ?>
                                                <div class="progress-bar" role="progressbar" style="width: <?= $avg ?>%" aria-valuenow="<?= $avg ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                <?php } else { ?>
                                                    <div class="progress-bar" role="progressbar" style="width: 0" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-3"><small><strong>4 stars</strong></small></div>
                                    </div>                                    
                                    <!-- /row -->
                                    <div class="row">
                                        <div class="col-lg-10 col-9">
                                            <div class="progress">
                                                <?php if(!empty($combine['3'])) {
                                                    $avg = $combine['3'] / $listing->count *100;
                                                ?>
                                                <div class="progress-bar" role="progressbar" style="width: <?= $avg ?>%" aria-valuenow="<?= $avg ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                <?php } else { ?>
                                                    <div class="progress-bar" role="progressbar" style="width: 0" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-3"><small><strong>3 stars</strong></small></div>
                                    </div>
                                    <!-- /row -->
                                    <div class="row">
                                        <div class="col-lg-10 col-9">
                                            <div class="progress">
                                                <?php if(!empty($combine['2'])) {
                                                    $avg = $combine['2'] / $listing->count *100;
                                                ?>
                                                <div class="progress-bar" role="progressbar" style="width: <?= $avg ?>%" aria-valuenow="<?= $avg ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                <?php } else { ?>
                                                    <div class="progress-bar" role="progressbar" style="width: 0" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-3"><small><strong>2 stars</strong></small></div>
                                    </div>
                                    <!-- /row -->
                                    <div class="row">
                                        <div class="col-lg-10 col-9">
                                            <div class="progress">
                                                <?php if(!empty($combine['1'])) {
                                                    $avg = $combine['1'] / $listing->count *100;
                                                ?>
                                                <div class="progress-bar" role="progressbar" style="width: <?= $avg ?>%" aria-valuenow="<?= $avg ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                <?php } else { ?>
                                                    <div class="progress-bar" role="progressbar" style="width: 0" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-3"><small><strong>1 stars</strong></small></div>
                                    </div>
                                    <!-- /row -->
                                </div>
                            </div>
                            <!-- /row -->
                        </div>

                        <?php if(!empty($listing->comments)) { ?>
                        <div class="reviews-container">
                        <?php foreach($listing->comments as $comment) { ?>                           
                            <div class="testimonial-carousel1 wow fadeInUp" data-wow-delay="0.1s">
                                <div class="bg-white rounded p-3 mb-4" style="border-left: 4px solid #ed2124;">
                                    <p class="mb-0">"<?=$comment->comment ?>"</p>
                                    <div class="d-flex align-items-center">
                                        <div class="">
                                            <h6 class="fw-bold mb-1 font-weight-bold"><?= @$comment->user->name ?> | posted:
                                                <?= $this->Time->timeAgoInWords($comment->created) ?></h6>
                                            <small>
                                                <div class="rating" data-rate-value=<?=$comment->rating ?>></div>
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                         
                        </div>
                        <?php } ?>
                        <!-- /review-container -->
                    </section>
                </div>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="box box-block bg-white p-3 mt-1">
                    <?php if($this->AuthUser->user()) { ?>
                    <?= $this->Form->create($comment,['type'=>'file','novalidate'=>true]) ?>
                    <fieldset>
                        <h5 class="font-weight-bold">Post your Review</h5>
                        <div class="rate"></div>
                        <?php echo $this->Form->hidden('rating', ['id'=>'rating']); ?>
                        <?php echo $this->Form->control('comment', ['rows' => 3]); ?>
                    </fieldset>
                    <fieldset>
                        <div class="pull-right">
                            <button class="btn_1">Post</button>
                        </div>
                    </fieldset>
                </div>
                <?= $this->Form->end() ?>
                <?php } else { ?>
                <br>
                <div class="box box-block bg-white p-3 mt-1">
                    <strong>Login to Post Review.</strong><br>
                    <?php echo $this->Form->create('User',array('url' => ['controller'=>'Members','action' => 'login'],'class'=>'form-material mb-1 material-danger'));?>
                    <div class="form-group">
                        <?= $this->Form->input('email',['class'=>'form-control','label'=>false,'type'=>'text','placeholder'=>'Email']);?>
                    </div>
                    <div class="form-group">
                        <?= $this->Form->input('password',['class'=>'form-control','label'=>false,'type'=>'password','placeholder'=>'Password']);?>
                        <?= $this->Form->hidden('origin') ?>
                    </div>
                    <div class="clearfix add_bottom_15">
                        <div class="float-right"><a id="forgot" href="javascript:void(0);">Forgot Password?</a></div>
                    </div>
                    <div class="px-2 form-group mb-3">
                        <button type="submit" class="btn_1 btn-block text-uppercase">Log in</button>
                    </div>
                    <?php echo $this->Form->end();?>
                    <div class="p-2 text-xs-center text-muted">
                        <?= $this->Form->postLink($this->Html->image('google_login.png'), '/oauth/google', ['escape'=>false]); ?>
                    </div>
                    <div class="px-2 form-group">
                        <span align=left><strong>New User? .</strong></span>
                        <span><?= $this->Html->link('Register Now', ['controller'=>'Members','action'=>'register']) ?></span>
                    </div>
                    <?php echo $this->Form->create(null,array('url' => ['controller'=>'Members','action' => 'forgot'],'class'=>'form-material mb-1 material-danger'));?>
                    <div id="forgot_pw">
                        <div class="form-group">
                            <input type="email" class="form-control" name="email" id="email"
                                placeholder="Type your email">
                        </div>
                        <p>A new password will be sent shortly.</p>
                        <div class="text-center"><input type="submit" value="Reset Password" class="btn_1"></div>
                    </div>
                    <?php echo $this->Form->end();?>

                </div>
                <?php } ?>
                <?php if(!empty($listing->comments)) { ?>
                <h5 class="font-weight-bold mt-5"> Reviews </h5>
                <div>
                    <?php foreach($listing->comments as $comment) { ?>
                    <div class="testimonial-carousel1 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="bg-white rounded p-3 mb-4" style="border-left: 4px solid #ed2124;">
                            <p class="mb-0">"<?=$comment->comment ?>"</p>
                            <div class="d-flex align-items-center">
                                <div class="">
                                    <h6 class="fw-bold mb-1 font-weight-bold"><?= @$comment->user->name ?> | posted:
                                        <?= $this->Time->timeAgoInWords($comment->created) ?></h6>
                                    <small>
                                        <div class="rating" data-rate-value=<?=$comment->rating ?>></div>
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>


<script type='text/javascript'
    src='https://platform-api.sharethis.com/js/sharethis.js#property=629da7576d36b1001983c5d4&product=sop'
    async='async'></script>
<script>
$(document).ready(function() {
    var options = {
        max_value: 5,
        step_size: 1,
        initial_value: 5,
        update_input_field_name: $("#rating"),
    }

    $(".rate").rate(options);

    $(".rating").rate({
        readonly: true
    });

    $('input[name="from_date"]').daterangepicker({
        "singleDatePicker": true,
        "parentEl": '#input-dates',
        "opens": "left"
    }, function(start, end, label) {
        console.log('New date range selected: ' + start.format('DD-MM-YYYY') + ' to ' + end.format('DD-MM-YYYY') + ' (predefined range: ' + label + ')');
    });

    $('input[name="to_date"]').daterangepicker({
        "singleDatePicker": true,
        "parentEl": '#input-dates',
        "opens": "left"
    }, function(start, end, label) {
        console.log('New date range selected: ' + start.format('DD-MM-YYYY') + ' to ' + end.format('DD-MM-YYYY') + ' (predefined range: ' + label + ')');
    });
});

</script>
