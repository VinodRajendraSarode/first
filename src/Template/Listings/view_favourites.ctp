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
        });
    });
});
 </script>

 <?php if(!empty($title)){ ?>
 <h5 style="color:red"><?php echo $title; ?> :</h5><br>
 <?php } ?>

 <?php foreach ($listings as $i=> $listing): //debug($listing->toArray());exit;  ?>
 <div class="strip list_view abcd">
     <div class="row no-gutters">
         <div class="col-lg-5 col-5">
             <figure>
                 <a href="/<?=$listing->category->slug?>/<?= $listing->slug ?>" class="grid_item small">
                     <?= $this->Html->image('/files/listings/banner/'.$listing->banner_dir.'/proper_'.$listing->banner, ['class'=>'img-fluid']) ?>
                     <div class="read_more"><span>Read more</span></div>
                 </a>
                 <small><?php echo $listing->sub_category->sub_category ?></small>
             </figure>
         </div>
         <div class="col-lg-7 col-7">
             <div class="wrapper">
                 <?php if(!empty($this->AuthUser->User('id'))) { ?>
                 	<?php if(!empty($listing['favourites'][0]['listing_id'])){	?>
                        <?php foreach($listing->favourites as $favourite){ ?>
                            <?php if($favourite->user_id == $this->AuthUser->user('id')){ ?>
                                <a href="/Listings/addFavourite" class="wish_bt item liked" id="<?php echo $listing->id ?>"></a>
                            <?php }else{ ?>
                                <a href="/Listings/addFavourite" class="wish_bt item" id="<?php echo $listing->id ?>"></a>
                            <?php } ?>
                        <?php } ?>
                    <?php } else{ ?>
                        <a href="/Listings/addFavourite" class="wish_bt item" id="<?php echo $listing->id ?>"></a>
                    <?php } ?>                   
                 <?php } ?>

                 <h3>
                     <?php echo $this->Html->link($listing->listing_title, array('controller' => 'listings','action'=>'detail',$listing->id)); ?>
                 </h3>
                 <!-- section1 -->

                 <p><?= $listing->description ?></p>


             </div>




             <ul>
                 <li><span class="loc_open"><i class="fa fa-map-marker"></i> <?php echo $listing->city->city ?></span>
                 </li>
                 <li>
                     <div class="score">
                         <span><?php if($listing->avg_rating >= 4.0){ ?> Very Good
                            <?php } else if($listing->avg_rating >= 3.0){ ?> Good
							<?php } else if($listing->avg_rating >= 2.0) { ?> Average <?php } else { ?> Below Average
							<?php } ?> <em> <?= $listing->count ?> Reviews</em></span>
							<strong> <?= $listing->avg_rating ?></strong>
                     </div>
                 </li>
             </ul>
         </div>
     </div>
 </div>
 <?php endforeach; ?>

 <div class="pagination pagination-large">
     <ul class="pagination">
         <?php
                echo $this->Paginator->prev(__('prev'), array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
			    echo $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li','first' => 1));
                echo $this->Paginator->next(__('next'), array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
            ?>
     </ul>
 </div>



 <!-- /strip list_view -->