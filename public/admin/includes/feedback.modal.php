<div class="modal fade" id="myModal<?php echo $rows["id"]; ?>" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header text-center">
            <h4 class="modal-title"><?php// echo $rows["name"]; ?></h4>
        </div>
        <div class="modal-body">
            <p><?php echo htmlspecialchars_decode( $rows["feedback"]); ?></p> 
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>
</div>