


// COMPUTE THE ORDER SUMMARY ONCE THE PAGE IS LOADED
document.addEventListener("DOMContentLoaded", function () {
    // GET ALL THE BTN ELEMENT 
    let allCartBtn     = document.querySelectorAll(".add-cart-btn");
    let cartUpdateBtn  = document.querySelectorAll(".updateBtn");
    let cartModalBtn   = document.querySelectorAll(".add_cart_btn1");
    let cartListHeader = document.querySelector(".cart-header");
    let allDeleteBtn   = document.querySelectorAll(".delete_item");

    // CART SUMMARY
    let subtotal      =  document.getElementById("subtotal");
    let shipping      =  document.getElementById("shipping");
    let vat           =  document.getElementById("vat");
    let totalEL       =  document.getElementById("total"); 

    computeOrderSummary();

    countCartItem();


    function showLoadingGIF(productID) {
        document.getElementById('gifpy_'+productID).style.display = 'block';
    }

    function hideLoadingGIF(productID) {
        document.getElementById('gifpy_'+productID).style.display = 'none';
    }

    if (allCartBtn !== null) {
        allCartBtn.forEach(function name(button) {
            button.addEventListener("click", function (e) {
                    e.preventDefault();
                    var productID = e.target.id;
            
                // Called the ajax function
                addToCart(productID); 
            });
        });

    }



    // ADD TO CART EVENT LISTENERS
    if (cartModalBtn !== null) {
        cartModalBtn.forEach(function name(button) {
            button.addEventListener("click", function (e) {
                    e.preventDefault();
                    let rowID = e.target.parentNode.id;
                    let productID = e.target.parentNode.id;
            
                // Called the ajax function
                addToCart(productID, rowID); 
            });
        });
    }



    if(cartUpdateBtn !== null){
        cartUpdateBtn.forEach(function name(button) {
            button.addEventListener("click", function (e) {
                e.preventDefault();

                let rowID = e.target.parentNode.id;              
                var productID = e.target.parentNode.id;
                // get the quantity of the item
                let itemQty = getItemQuatity(productID);

                // Called the ajax function
                updateCartItem(productID, itemQty); 

                // Update the summary
                computeOrderSummary();
            });
        });
    }


    if(allDeleteBtn !== null){
        allDeleteBtn.forEach(function (button) {
            button.addEventListener("click", function (e) {
                e.preventDefault();
                let productID = e.target.id;
                let rowID = e.target.parentNode.id;

                // Called the ajax function
                deleteItem(productID, rowID); 
            

                // Update the summary
                computeOrderSummary();
            });
        });
    }



   


    // ADD ITEM TO CART
    function addToCart(productID, rowID) {

        // SHOW THE USER THE LOADING ICON
        showLoadingGIF(productID);

        // Create a XHR instance    
            var xhttp = new XMLHttpRequest();
            xhttp.open("POST", "cartAction.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.onreadystatechange = function () {
                if (this.readyState === 4 && this.status === 200) {
                // If the insert to the cart was successful
                    if(this.responseText) {
                        showNumberItemInCart(this.responseText);
                        Materialize.toast('Item added to cart', 3000, 'teal lighten-3');                        
                        hideLoadingGIF(productID);
                    } 
                    
                }
                else if(this.status === 404){
                    document.write('URL could not be reached');                  
                } else {
                    
                }
            }

        // get the quantity of the item
            let itemQty = getItemQuatity(productID);

            xhttp.send(`qty=${itemQty}&id=${productID}&action=addToCart`);

            xhttp.onerror = function () {
                console.log('An error has occured!');
            }
    }


    // Delete Item from the cart list
    function  deleteItem(productID, rowID) {
        // Delete from the Cart via AJAX    
        let xhttp = new XMLHttpRequest();
        xhttp.open('POST', 'cartAction.php', true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.onreadystatechange = function () { 
            if (this.readyState === 4 && this.status === 200) {
            if(this.responseText === 'true')
            console.log(document.getElementById('item_'+productID));
            //Recompute the Summary
            computeOrderSummary();
            }else{
                console.log("loading...");
            }
            document.getElementById('item_'+productID).style.display = 'none';

        };
        xhttp.send(`action=removeCartItem&id=${rowID}` );

        xhttp.onerror = function () {
            console.error('An error has occured!');
        }

        // Count the 
        countCartItem();
    }

    // UPDATE CART QUANTITY ITEM
    function updateCartItem(productID, itemQty) {
        console.log(itemQty);
        console.log(productID);

        let xhttp = new XMLHttpRequest;
        xhttp.open("POST", "cartAction.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.onreadystatechange = function () {
            if (this.status === 200 && this.readyState === 4) {
                let numbers = this.responseText;
                console.log(numbers);
                if(numbers !== undefined) { 
                    showNumberItemInCart(number); 
                    document.getElementById('item_quatity_'+productID).textContent = `Qty: ${itemQty}`;
                    // console.log("Count was called");  
                    Materialize.toast('Cart item updated', 3000, 'teal lighten-3');
                }
            } 
        };
        xhttp.send(`action=updateCartItem&id=${productID}&qty=${itemQty}`);
        xhttp.onerror = function () {
            console.log("An error has occured");
        };
        xhttp.onprogress = function () {
            console.log("Loading...");
        };

    
    }



    function computeOrderSummary() {
        if(shipping && subtotal !== undefined){

            // get the subtotal
            computeSubTotal();

            // Get the shipping 
                shippingVal = 200.00;
                shipping.textContent = `N${shippingVal}`;

            // Get VAT 
                vatValue = 0.00;
                vat.textContent = `N${vatValue}`;

            // Get Total
            getCartTotal();
        }
    

    }



    function computeSubTotal() {
        var xhttp = new XMLHttpRequest();
        xhttp.open("POST", "cartAction.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
            let sub_total = this.responseText;
            subtotal.textContent = `N${sub_total}`;
            }else if(this.status === 404){
                document.write('URL could not be reached');                  
            } else {
                
            }
    }     

    xhttp.send(`action=computeSubtotal`);

    xhttp.onerror = function () {
        console.log('An error has occured!');
    }
    }


    function getCartTotal() {
        var xhttp = new XMLHttpRequest();
        xhttp.open("POST", "cartAction.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
            let cartTotal = this.responseText;
            totalEL.textContent = `N${cartTotal}`;
            }else if(this.status === 404){
                document.write('URL could not be reached');                  
            } else {
                
            }
    }     

    xhttp.send(`action=getTotal`);

    xhttp.onerror = function () {
        console.log('An error has occured!');
    }
    }


    // WHEN THE DOMCONTENT ID LOADED WE CALL THE COUNT ITEM FUNCTION
    // document.addEventListener("DOMContentLoaded", countCartItem);
    function countCartItem() {
        // Create a XHR instance 

        var xhttp = new XMLHttpRequest();
        xhttp.open("POST", "cartAction.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                let numbers = this.responseText;
                // Call the showNumberItemInCart() Method with the 
                if(numbers !== undefined)
                showNumberItemInCart(numbers);

            }else if(this.status === 404){
                document.write('URL could not be reached');                  
            } else {
                
            }
        }     

        xhttp.send(`action=countCartItem`);

        xhttp.onerror = function () {
            console.log('An error has occured!');
        }
    }



    function showNumberItemInCart(numbers) {
        
        let num = parseInt(numbers);
        let fabDiv = document.querySelector(".click-to-toggle"); 

        if (fabDiv !== null) {
            console.log(numbers);
            if (num === 0) {
                // Update the DOM UI Corretly, Hide the FAB div console.log(fabDiv);
                fabDiv.style.display = "none"
            } else if(num > 0) {
                // Update the DOM UI Corretly, Show  
                fabDiv.style.display = "block"
                fabDiv.firstElementChild.firstElementChild.textContent = num;
            }
        }else if(cartListHeader !== null){
            cartListHeader.textContent = `Your cart (${numbers})`;
        }
        
            
    }



    function getItemQuatity(productID) {
        // sm = SELECT MENU
        console.log(productID);
        
        let sm = document.getElementById("item_qty_"+productID);
        return sm.options[sm.selectedIndex].value;
    }


});


{/* <a class="btn" onclick="Materialize.toast('I am a toast', 4000,'',function(){alert('Your toast was dismissed')})">Toast!</a> */}
