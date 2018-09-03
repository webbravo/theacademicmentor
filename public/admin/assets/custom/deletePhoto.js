function doc(element) {
    return document.getElementById(element);
}



var deleteBtn = doc("photoDeleteBtn");

deleteBtn.addEventListener("click", function () {
    var answer =  confirm("Want to Delete?");
    if(answer === true){
        console.log("yes");
    }else{
        console.log("no");
    }
});

