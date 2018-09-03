<div class="modal fade" id="myModal<?php echo $rows["id"]; ?>" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header text-center">
            <h4 class="modal-title"><?php echo $rows["eventTitle"]; ?></h4>
        </div>
        <div class="modal-body">

                <img class="img-responsive" src="../<?php echo $rows["eventPhoto"]; ?>" alt="">
                <h4>Location: <?php echo $rows["eventLocation"]; ?></h4> 
                <br/>
                <p><?php echo $rows["eventStory"]; ?></p>
                <br/>
                <a class="btn-lg btn-success center" target="_new" href="<?php echo $rows["eventLink"]; ?>">Event Link</a>
            <!-- <div class="progress m-t-xs full progress-small">
                <div style="width: 65%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="65" role="progressbar" class=" progress-bar progress-bar-warning">
                    <span class="sr-only">65% Complete (success)</span>
                </div>
            </div> -->
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>
</div>