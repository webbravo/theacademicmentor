   
//   var customer = JSON.parse(localStorage.getItem('TAMCSD'));
//   let fullname =  customer.fullname;
//   let name = fullname.split(" ");

  let firstname = document.getElementById("firstName");
  let lastname  = document.getElementById("lastName");
  let phone     = document.getElementById("phone");
  let email     = document.getElementById("email");
  let amount    = document.getElementById("amount");
  
  function getPaymentDetails() {
    // Create a XHR instance    
    var xhttp = new XMLHttpRequest();
    xhttp.open("POST", "cartAction.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            // Object was returned
            console.log(this.responseText);
            
            data = JSON.parse(this.responseText)
            if(data) {
                firstname.value = data.firstName;
                lastname.value  = data.lastName;
                phone.value     = data.phone;
                email.value     = data.email;
                amount.value    = data.amount;
            }
        }else if(this.status === 404){
            document.write('URL could not be reached');                  
        } else {
            
        }
    };

    xhttp.send(`action=getPaymentDetails`);

    xhttp.onerror = function () {
        console.log('An error has occured!');
    }


  }   
//   console.log(email.value);
  
  function payWithPaystack(){

    var handler = PaystackPop.setup({
      key: 'pk_test_b1fbb9ec7d52cedb1594e81fdfb5931669afbe95',
      email:  email.value,
      amount: amount.value * 100,
      ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
      firstname: firstname.value,
      lastname: lastname.value,
      // label: "Optional string that replaces customer email"
      metadata: {
         custom_fields: [
            {
                display_name: phone.value,
                variable_name: phone.value,
                value: phone.value
            }
         ]
      },


      callback: function(response){
          console.log('success. transaction ref is ' + response.reference);

         

          // Payment succeeded
           document.getElementById("refCode").textContent = response.reference;
           localStorage.clear();
           setTimeout(function(){ $('#success').modal('open')}  , 2000);
           disableOrEnableCheckOutBtn();
           showReturnToHomePage();

        // Call the Function to Place Order for the customer
            placeOrder(response.reference);
      },


      onClose: function(){
        //   alert('window closed');
        Materialize.toast('Payment cancelled!', 3000, 'red lighten-3');

      }
    });
    handler.openIframe();
  }

function placeOrder(ref_id) {
     // Create a XHR instance    
     console.log(ref_id);
     
     var xhttp = new XMLHttpRequest();
     xhttp.open("POST", "cartAction.php", true);
     xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
     xhttp.onreadystatechange = function () {
         if (this.readyState === 4 && this.status === 200) {
             // If the insert to the cart was successful
             if(this.responseText){
                subtotal.textContent = "Paid"
                shipping.textContent = "Paid"
                vat.textContent = "Paid"
                totalEL.textContent = "Paid"
             }else{
               console.log('An error has occured!');
             }
         }else if(this.status === 404){
             document.write('URL could not be reached');                  
         } else {
             
         }
     }

     xhttp.send(`action=placeOrder&ref_code=${ref_id}`);
 
     xhttp.onerror = function () {
         console.log('An error has occured!');
     }
}


function showReturnToHomePage(){
    // this is a component
    
    const info = `<h3 class="flow-text red-text">
                   
                </h3>
                <a  href="index.php" style="margin-top:20px;" class=" modal-trigger btn green btn-md white-text">
                        Goto homepage <i class="fa fa-arrow-left"></i> 
                </a>`
    document.querySelector(".shippingStatus").innerHTML = info;   
    console.log(document.querySelector(".shippingStatus"));
      
    
}
