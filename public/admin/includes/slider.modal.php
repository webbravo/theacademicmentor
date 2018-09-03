<div class="modal fade" id="myModal<?php echo $rows["id"]; ?>" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header text-center">
        </div>
        <div class="modal-body">

                <img class="img-responsive" src="../<?php echo $rows["photo"]; ?>" alt=""> 
                <p><?php echo htmlspecialchars_decode( $rows["caption"]); ?></p> 
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