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
            if(data['success'] == 'Your Favourite has been Removed'){
                location.reload();
            }

        });
    });
});
 </script>

 <?php if(!empty($title)){ ?>
 <h5 style="color:red"><?php echo $title; ?> :</h5><br>
 <?php } ?>

 <div class="row abcd">


 <?php foreach ($listings as $i=> $listing): ?>

    <?php
        $fav = [];
        foreach($listing->favourites as $favourite){
            if($favourite->user_id == $this->AuthUser->user('id')) {
                $fav = $favourite->listing_id;
            }
        }

    ?>
    <div class="col-xl-4 col-lg-6 col-md-6">
        <div class="strip grid no-gutters">
            <figure>
            <div style="white-space:normal;">
                <?php if(!empty($this->AuthUser->User('id'))) { ?>
                    <?php if(!empty($fav)){ ?>
                        <a href="/Listings/addFavourite" class="wish_bt item liked" id="<?php echo $listing->id ?>"></a>
                    <?php }else{ ?>
                        <a href="/Listings/addFavourite" class="wish_bt item" id="<?php echo $listing->id ?>"></a>
                    <?php } ?>
                <?php } ?>
            </div>
                <a href="/<?=$listing->category->slug?>/<?= $listing->slug ?>">
                    <?= $this->Html->image('/files/listings/banner/'.$listing->banner_dir.'/proper_'.$listing->banner, ['class'=>'img-fluid']) ?>
                    <div class="read_more"><span>Read more</span></div>
                </a>
            </figure>
            <div class="wrapper">
                <h3  class="fix_height mb-2"><a href="/<?=$listing->category->slug?>/<?= $listing->slug ?>"><?= $listing->listing_title ?></a></h3>
                <small class="fix_height"> <?= $this->Text->truncate(strip_tags($listing->address), '200', ['ellipsis' => '...', 'exact' => false, 'html' => false]) ?></small> <br>

                <small> <?= (!empty($listing->hourly_rate)) ? $listing->hourly_rate.'/  Hour, ' : ' ' ?> &nbsp;
                    <?= (!empty($listing->daily_rate))  ? $listing->daily_rate.' /  Day' : ' ' ?>
                </small>
            </div>
            <ul>
                <li><span class="loc_open"><?= $listing->city->city ?></span></li>
                <li>
                    <div class="score">
                        <span>
                            <?php if($listing->avg_rating >= 4.0){ ?> Very Good
                            <?php } else if($listing->avg_rating >= 3.0){ ?> Good
                            <?php } else if($listing->avg_rating >= 2.0) { ?> Average <?php } else { ?> Below Average
                            <?php } ?> <em> <?= $listing->count ?> Reviews</em>
                        </span>
                        <strong> <?= $listing->avg_rating ?></strong>
                    </div>
                </li>
            </ul>
        </div>
    </div>
 <?php endforeach; ?>
 </div>

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
