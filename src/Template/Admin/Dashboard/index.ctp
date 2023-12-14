<?php if(!empty($announcement)) { ?>
<div class="row row-md">
    <div class="col-lg-12 col-md-12 col-xs-12">
        <div class="card card-inverse card-info text-xs-center">
            <div class="card-block">
                <blockquote class="card-blockquote">
                    <h4 class='marquee'><?php echo $announcement->announcement; ?></h4>
                </blockquote>
            </div>
        </div>    
    </div>
</div>
<?php } ?>
