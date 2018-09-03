<div class="modal fade" id="myModal<?php echo $rows["id"]; ?>" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header text-center">
            <h4 class="modal-title"><?php echo $rows["videoTitle"]; ?></h4>
        </div>
        <div class="modal-body">
            <div class="embed-responsive embed-responsive-16by9">
                <p><?php echo  $rows["videoURL"]; ?></p>
            </div>
            <br/>
            <p><?php echo  $rows["videoCaption"]; ?></p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>
</div>