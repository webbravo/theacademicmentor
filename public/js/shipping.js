
let shippingForm   = document.querySelector("form");
let editForm   = document.querySelector(".editForm");
let shippingStatus = document.querySelector(".shippingStatus");
let checkoutBtn    = document.querySelector(".checkoutBtn");


//
document.addEventListener('DOMContentLoaded', function () {
   // Display the shipping status to tell the user weather have entered their shipping details
     displayShippingStatus();

   //Disable check out button
     disableOrEnableCheckOutBtn();
});


// ADD THE EVENT FOR THE CHECKOUT BUTTON
   function disableOrEnableCheckOutBtn() {
       if (localStorage.TAMCSD === undefined) {
            if (checkoutBtn.classList.contains('disabled') === false) {
                checkoutBtn.classList.add('disabled');
            } 
       }else{
           if (checkoutBtn.classList.contains('disabled') === true ) {
                checkoutBtn.classList.remove('disabled');
            } 
       }
   }

// ADD SHIPPING DETAILS EVENT LISTENER
if (shippingForm !== null) {
 
    shippingForm.addEventListener("submit", function (e) {
        e.preventDefault();

        let fullname  =  e.target[0].value;
        let email     =  e.target[1].value;
        let phone     =  e.target[2].value;
        let address   =  e.target[3].value;

        addShippingDetails(fullname, email, phone, address);
        getPaymentDetails();
        
    });
  
}

function displayShippingStatus() {
    if(localStorage.TAMCSD === undefined){
        // display not logged in component
         showNotLoggedIn();
         console.log("Not logged in");
    }else{
        showLoggedIn();
        getAndDisplayShippingDetailsFromLocalStorage();
        console.log("Currently logged in");
    }
}




function addShippingDetails(fullname, email, phone, address) {
    // Create a XHR instance  
    var xhttp = new XMLHttpRequest();
    xhttp.open("POST", "cartAction.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            // If the insert to the cart was successful
              console.log(this.responseText);
              if(this.responseText) Materialize.toast('Shipping details added!', 3000, 'teal lighten-3');
        }else if(this.status === 404){
            document.write('URL could not be reached');                  
        } else {
            
        }
    }
 

     xhttp.send(`fullname=${fullname}&email=${email}&phone=${phone}&address=${address}&action=addShippingDetails`);
 
     xhttp.onerror = function () {
         console.log('An error has occured!');
     }
     
    // Save shipping details for Future uses
       saveShippingDetail(fullname, email, phone, address);

    // Redisplay the Shipping status to the users
       displayShippingStatus();

    // Enable check out button
       disableOrEnableCheckOutBtn();
}


function updateShippingDetails(fullname, email, phone, address) {

    
    // Create a XHR instance  
    var xhttp = new XMLHttpRequest();
    xhttp.open("POST", "cartAction.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            // If the insert to the cart was successful
            if(this.responseText) Materialize.toast('Shipping details added!', 3000, 'teal lighten-3');

        }else if(this.status === 404){
            document.write('URL could not be reached');                  
        } else {
            
        }
    }
 

     xhttp.send(`fullname=${fullname}&email=${email}&phone=${phone}&address=${address}&action=addShippingDetails`);
 
     xhttp.onerror = function () {
         console.log('An error has occured!');
     }
     
    // Save shipping details for Future uses
    saveShippingDetail(fullname, email, phone, address);

    // Redisplay the Shipping status to the users
     displayShippingStatus();
}

function getAndDisplayShippingDetailsFromLocalStorage() {
   
    var customer = JSON.parse(localStorage.getItem('TAMCSD'));
    editForm[0].value = customer.fullname;
    editForm[1].value = customer.email;
    editForm[2].value = customer.phone;
    editForm[3].value = customer.address;
    //Reinitialize the Material label on the page
    Materialize.updateTextFields();

}

function saveShippingDetail(fullname, email, phone, address) {
    let shippingDetails = {
        "fullname": fullname,
        "email": email,
        "phone": phone,
        "address": address

    };
    localStorage.setItem('TAMCSD', JSON.stringify(shippingDetails));
}


function showNotLoggedIn(){
    // this is a component
    
    const info = `<h4 class="flow-text red-text">
                    Welcome Customer, we don't have your shipping details, please add one 
                </h4>
                <a  href="#loginModal" style="margin-top:20px;" class=" modal-trigger btn green btn-md white-text">
                         <i class="fa fa-plus"></i> Add shipping details
                </a>`
    shippingStatus.innerHTML = info;   
    // console.log(info);
      
    
}


function showLoggedIn(){
    // this is a component
    
    const info = `<h3 class="flow-text green-text">
                    We now have a shipping detail for your order! 
                </h3>
                <a  href="#editLoginModal" style="margin-top:20px;" class=" modal-trigger btn green btn-md white-text">
                        Edit shipping details <i class="fa fa-user"></i> 
                </a>`
    shippingStatus.innerHTML = info;   
    // console.log(info);
      
    
}

function showReturnToHomePage(){
    // this is a component
    
    const info = `<h3 class="flow-text green-text">
                    We now have a shipping detail for your order! 
                </h3>
                <a  href="index.php" style="margin-top:20px;" class=" modal-trigger btn green btn-md white-text">
                        Edit shipping details <i class="fa fa-user"></i> 
                </a>`
    shippingStatus.innerHTML = info;   
    // console.log(info);
      
    
}