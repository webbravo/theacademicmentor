"use strict";
function doc(el) {
    var element = document.getElementById(el);
    return element;
}

window.addEventListener("DOMContentLoaded", function () {
    doc("myProgressBarEl").style.display= "none";
});

var uploadBtn = doc("uploadPhoto");
uploadBtn.addEventListener("click", function (e) {
    e.preventDefault();
    //console.log("The BTN is clicked!");

    // Call the Upload file Function
       uploadFile();
    
});

function uploadFile() {
    var file = doc("galleryPhoto").files[0];
    //console.log(file.name+" "+file.size+" "+ file.type);

    var formdata  = new FormData();

    formdata.append("galleryPhoto", file);
	var ajax = new XMLHttpRequest();
	ajax.upload.addEventListener("progress", progressHandler, false);
	ajax.addEventListener("load", completeHandler, false);
	ajax.addEventListener("error", errorHandler, false);
	ajax.addEventListener("abort", abortHandler, false);
	ajax.open("POST", "uploadPhoto.php");
	ajax.send(formdata);
    
}

function progressHandler(event){
    var byte = doc("progressText").innerHTML = "Uploaded "+event.loaded+" bytes of "+event.total
    //console.log(byte);
    doc("myProgressBarEl").style.display= "block";
    var percent = (event.loaded / event.total) * 100;
    var progressValue = Math.round(percent); 
	doc("progressBar").setAttribute("style", "width: "+progressValue+"%");
    doc("progressText").innerHTML = Math.round(percent)+"% uploaded... please wait";
}


function completeHandler(event){
    doc("progressText").innerHTML = event.target.responseText;
    doc("progressBar").setAttribute("style", "width: "+100+"%"); 
    doc("progressBar").style.backgroundColor = "#78CB00"; 
    console.log(event.target.responseText);
}

function errorHandler(event){
	alert("Upload Failed");
}

function abortHandler(event){
   alert("Upload Aborted");
}