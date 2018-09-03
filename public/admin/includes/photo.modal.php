<div class="modal fade" id="myModal<?php echo $row["id"]; ?>" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header text-center">
            <h4 class="modal-title"><?php echo "View Photo"; ?></h4>
        </div>
        <div class="modal-body">

                <img class="img-responsive" src="../<?php echo $row["photoName"]; ?>" alt=""> 
            <!-- <div class="progress m-t-xs full progress-small">
                <div style="width: 65%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="65" role="progressbar" class=" progress-bar progress-bar-warning">
                    <span class="sr-only">65% Complete (success)</span>
                </div>
            </div> -->
        </div>
        <div class="modal-footer">
            <button id="photoDeleteBtn<?php echo $row["id"]; ?>" type="button" class="btn-md btn-danger content-left" >Delete</button>
            <button type="button" class="btn-md btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>
</div>
<script>
    function doc(element) {
      return document.getElementById(element);
    }

    function l(r) {
        console.log(r);
    }

    var deleteBtn = doc("photoDeleteBtn"+'<?php echo $row["id"]; ?>');

    deleteBtn.addEventListener("click", function () {
        var answer =  confirm("Want to Delete?");
        if(answer === true){
           // Delete The Photo
             deletePhoto('<?php echo $row["id"]; ?>');
        }else{
            console.log("no");
        }
    });

    function deletePhoto(id)  {
        //Make an ajax Call to the server     
        var xhttp = new XMLHttpRequest();
        xhttp.open("post", "delete.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("ajaxRequest="+id); 
        xhttp.onreadystatechange = function () {
            if(this.readyState == 4 && this.status == 200){
               var serverRes = this.responseText.toString().trim();
               l(serverRes);
               if(serverRes == "deleted"){
                   hidePhoto(id);
               }
               
            }
        };
    }

    function hidePhoto(id) {
        l(id);
       doc(id).style.display = "none";
    }

</script>





