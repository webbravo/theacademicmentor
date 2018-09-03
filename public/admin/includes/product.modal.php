<div class="modal fade" id="myModal<?php echo $rows["id"]; ?>" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title"> <?php echo $rows["name"]; ?></h4>
            </div>
            <div class="modal-body"> 
                <div class="col m6">
                    <!-- <h3>Name:/h3> -->
                    <h4><b>Product ID: </b><?php echo $rows["id"]; ?></h4>
                    <h4><b>Price: </b><span style="color:green"><?php echo "N". $rows["price"]; ?></span></h4>
                    <h4><b>Product Type: </b><?php echo $rows["product_type"]; ?></h4>
                    <h4><b>Brand: </b><?php echo  $rows["brand"]; ?></h4>
                    <h4><b>Date Added: </b><?php echo  $rows["created"]; ?></h4>
                    <h4><b>Update At: </b><?php echo $rows["modified"]; ?></h4>
                    <h4><b>Description:</b></h4>
                    <h5><?php echo htmlspecialchars_decode( $rows["description"]); ?></h5>
                </div> 
                <div class="col m6">
                    <img width="200" class="img-responsive" src="../<?php echo $rows["photo"]; ?>" alt=""> 
                </div>
                  

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