

    var save =  function() {

        // GET THE TEST RESULT
            const testResult = localStorage.getItem("TAMCareerInterest");
            console.log(localStorage.getItem("TAMCareerInterest"));
            

        // Function to save the 
            var saveCareerInterest = function (testResult) {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function () {
                    if (this.status === 200 && this.readyState === 4) {
                        if (this.responseText === "Succeeded") {
                            console.log("The Student record was updated!");
                        }else{
                            console.log(this.responseText);
                        }
                    }
                };
                xhttp.open("POST", "saveResult.php", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("careerInterest="+testResult);
            }

            saveCareerInterest(testResult);
    };


// THE SAVE SELCTION BUTTON ON THE field-of-study.php PAGE
   let saveSelectionBtn = document.querySelector("#save_selection");
   saveSelectionBtn.addEventListener("click", saveSelection);
   function saveSelection() {
        var firstOptionCheckBoxes  = document.querySelectorAll('.firstOption:checked').value;
        var secondOptionCheckBoxes = document.querySelectorAll('.secondOption:checked').value;

       
        var firstOption = $('.firstOption:checked').map(function() {
            return this.value;
        }).get();

        var secondOption = $('.secondOption:checked').map(function() {
            return this.value;
        }).get();

        if (Array.isArray(firstOption, secondOption) && firstOption.length == 0  && secondOption.length == 0) {
            alert("NO SELECTION WAS MADE!");
            return;
        }else{

           // SAVE THE SELECTION VIA AJAX
           saveSelectionViaAJAX(firstOption, secondOption);
        }
        
       

        // for (let i = 0; i < firstOption.length; i++) {
        //    console.log(firstOption[i]);
        // }

        // for (let i = 0; i < secondOption.length; i++) {
        //    console.log(secondOption[i]);
        // }

        // console.log();
        // console.log(secondOptionCheckBoxes);
       
   }

   function saveSelectionViaAJAX(firstOption, secondOption) {
       if (firstOption === undefined) firstOption = "NULL";
       if (secondOption === undefined) secondOption = "NULL";
       console.log(firstOption);
       console.log(secondOption);
       
       
       // SHOW THE LOADING GIF
       showLoadingGIF();

        var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.status === 200 && this.readyState === 4) {                    
                    if (this.responseText === "Succeeded"){
                        hideLoadingGIF();
                        Materialize.toast('Career Possibility was saved!', 3000, 'green lighten-1');                      
                        console.log("The Student record was updated!");
                        showMessage();
                    }else{
                        console.log(this.responseText);
                    }
                }
            };
            xhttp.open("POST", "saveResult.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("firstOption="+firstOption+"&secondOption="+secondOption);
   }


function showLoadingGIF() {
    document.getElementById('preloader').style.display = 'inline';
}

function hideLoadingGIF() {
    document.getElementById('preloader').style.display = 'none';
}


function showMessage() {
    setTimeout(function () {
        alert('Thanks for taking the test, you can logout now!');
    }, 6000)
}

    // Save the result to the database using AJAX
    // console.log(saveCareerInterest(localStorage.getItem("TAMCareerInterest")));