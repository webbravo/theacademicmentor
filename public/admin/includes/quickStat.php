<?php 
    
?>

<div class="row">


<div class="col-md-6 col-lg-3">
    <div class="card orange white-text clearfix">

        <div class="card-content clearfix">
            <i class="fa fa-book background-icon"></i>
            <p class="card-stats-title right panel-title wdt-lable"><a href="http://">Books</a></p>
            <h4 class="right panel-middle margin-b-0 wdt-lable"><?php if(isset( $total_award)){echo $total_award;}?></h4>

            <div class="clearfix"></div>
        </div>

    </div>
</div>

<!-- <div class="col-md-6 col-lg-3">
    <div class="card orange white-text clearfix">

        <div class="card-content clearfix">
            <i class="fa fa-calendar-o background-icon"></i>
            <p class="card-stats-title right panel-title wdt-lable">Total Events</p>
            <h4 class="right panel-middle margin-b-0 wdt-lable">12</h4>
            <div class="clearfix"></div>
        </div>

    </div>
</div> -->

<div class="col-md-6 col-lg-3">
    <div class="card teal white-text clearfix">

        <div class="card-content clearfix">
            <i class="fa fa-pencil-square-o background-icon"></i>
            <p class="card-stats-title right panel-title wdt-lable">Blog</p>
            <h4 class="right panel-middle margin-b-0 wdt-lable"><?php if(isset( $total_blog)){echo $total_blog;}?></h4>
            <div class="clearfix"></div>
        </div>

    </div>
</div>

<div class="col-md-6 col-lg-3">
    <div class="card green white-text clearfix">

        <div class="card-content clearfix">
            <i class="fa fa-calendar-o background-icon"></i>
            <p class="card-stats-title right panel-title wdt-lable">Upcoming Events</p>
            <h4 class="right panel-middle margin-b-0 wdt-lable"><?php if(isset($total_event)){echo $total_event;}?></h4>

            <div class="clearfix"></div>
        </div>

    </div>
</div>
<!-- <div class="col-md-6 col-lg-3">
    <div class="card cyan white-text clearfix">
        <div class="card-content clearfix">
            <i class="fa fa-group background-icon"></i> 
            <p class="card-stats-title right panel-title wdt-lable">Gallery Photos</p>
            <h4 class="right panel-middle margin-b-0 wdt-lable"><?php //if(isset($total_photo)){echo $total_photo;}?></h4>
            <div class="clearfix"></div>
        </div>

    </div>
</div> -->
<div class="col-md-6 col-lg-3">
    <div class="card green white-text clearfix">

        <div class="card-content clearfix">
            <i class="fa fa-camera background-icon"></i>
            <p class="card-stats-title right panel-title wdt-lable">Videos</p>
            <h4 class="right panel-middle margin-b-0 wdt-lable">0</h4>

            <div class="clearfix"></div>
        </div>

    </div>
</div>

</div>