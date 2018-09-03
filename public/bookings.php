<?php 
    require_once '../core/initialize.php';

    global $booking;  

    if(isset($_POST['request']) && isset( $_POST['company_address']) && isset( $_POST['event_date']) && isset( $_POST['product_sales']) ) {
        # Prepare the form data in an array
        $formData = [
            'fullname'              =>   trim($_POST['fullname']),
            'email'                 =>   trim($_POST['email']),
            'phone'                 =>   trim($_POST['phone']),
            'company_name'          =>   trim($_POST['company_name']),
            'company_address'       =>   trim($_POST['company_address']),
            'company_state'         =>   trim($_POST['company_state']),
            'organization_type'     =>   trim($_POST['organization_type']),
            'projected_budget'      =>   trim($_POST['projected_budget']),
            'event_center'          =>   trim($_POST['event_center']),
            'event_location'        =>   trim($_POST['event_location']),
            'event_name'            =>   trim($_POST['event_name']),
            'event_purpose'         =>   trim($_POST['event_purpose']), 	
            'event_date'            =>   trim($_POST['event_date']),
            'event_time'            =>   trim($_POST['event_time']),
            'presentation_topic'    =>   trim($_POST['presentation_topic']),
            'attendees_number'      =>   trim($_POST['attendees_number']),
            'attendees_demograph'   =>   trim($_POST['attendees_demograph']),
            'open_event'            =>   trim($_POST['open_event']),
            'event_has_ticket'      =>   trim($_POST['event_has_ticket']),
            'record_event'          =>   trim($_POST['record_event']),
            'product_sales'         =>   trim($_POST['product_sales']),
            'booking_status'        =>   trim('new')
        ];

        // CHECK IF THE USER HAS A PENDING A BOOKING
        $ph = $_POST['phone'];
        $em = $_POST['email'];
        $dt = $_POST['event_date'];
        if($booking->checkForPendingBooking($ph, $em, $dt) === false){
            // Create a new booking because it returned false;
            if ($booking->createBooking($formData) === true) {
                $alert = '<div id="modal1" class="modal open" style="z-index: 1003; display: block; top: 10%; opacity: 1; transform: scaleX(1);">
                        <div class="modal-content">
                            <h3 class="green-text">Successful</h3><br/>
                            <p>it\'s good to know you would like to work us, <br/> we respond to your booking request within 24hrs, Thanks </p>
                        </div>
                        <div class="modal-footer">
                            <a href="bookings.php" class="right modal-action modal-close waves-effect waves-red btn-flat ">close</a>
                        </div>
                    </div> <div class="modal-overlay" style="z-index: 1002; display: block; opacity: 0.5;"></div>';
            } 
        }else {
                $alert = '<div id="modal1" class="modal open" style="z-index: 1003; display: block; top: 10%; opacity: 1; transform: scaleX(1);">
                            <div class="modal-content">
                                <h3 class="red-text">You have one Pending booking</h3><br/>
                                <p>it\'s like you just recently sent a booking request, <br/> Please we\'ll respond to your booking request within 24hrs, Thanks </p>
                            </div>
                            <div class="modal-footer">
                                <a href="bookings.php" class="right modal-action modal-close waves-effect waves-red btn-flat ">close</a>
                            </div>
                        </div> <div class="modal-overlay" style="z-index: 1002; display: block; opacity: 0.5;"></div>';
        }
        
    } 
?>
<!DOCTYPE html>
<html>
<head>
    <title>Booking - The Academic Mentor</title>    
    <?php include_once('includes/head.php');?>
</head>
<body>
    <div id="full-page" class="container-fluid" style="background-color:white;">
        <section class="row" id="overlay-black">
            <div class="about-top">
               <?php include_once('includes/nav-menu.php');?>
            </div>
        </section>
       
        <section class="row">
            <div class="content-wrapper">
                <div id="booking-content">
                    <h2>The Academic Mentor Client form</h2>
                    <div id="booking-form"> 
                        <?php  if(isset($alert)) echo $alert ;?>
                        <form class="login-form z-depth-1" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                            <!-- <div class="input-field col m12 s12">
                                <input type="text" id="firstname">
                                <label for="firstname"> <i class="fa fa-user left"></i> Enter Firstname</label>
                            </div> -->
                            <div class="input-field col m12 s12">
                                <input type="text" id="fullname" name="fullname" class="validate" minlength="7" required>
                                <label for="fullname" data-error="name too short" data-success=""><i class="fa fa-user left"></i> Enter fullname *</label>
                            </div>
                            <div class="input-field col m12 s12">
                                <input type="email" id="email" name="email" class="validate" required>
                                <label for="email" data-error="invalid email" data-success=""><i class="fa fa-envelope left"></i> Email address *</label>
                            </div>
                            <div class="input-field col m12 s12">
                                <input type="number" id="phone" name="phone" class="validate" minlength="6" required>
                                <label for="phone" data-error="phone too short" data-success=""><i class="fa fa-phone left"></i>Phone number *</label>
                            </div>
                            <div class="input-field col m12 s12">
                                <input type="text" id="company_name" name="company_name" class="validate" minlength="6"  required>
                                <label for="company_name" data-error="name too short" data-success=""><i class="fa fa-industry left"></i>Company name *</label>
                            </div>
                            <div class="input-field col m12 s12">
                                <input type="text" id="company_address" name="company_address" class="validate" minlength="10" required>
                                <label for="company_address" data-error="Enter full address" data-success=""><i class="fa fa-home left"></i>Company full address *</label>
                            </div>
                            <!-- <div class="input-field col m12 s12">
                                    <input class="invalid" type="text" id="company_address" required>
                                    <label for="company_address" data-error="Wrong input"><i class="fa fa-home left"></i>Company full address *</label>
                                </div> -->
                            <div class="input-field col m12 s12">
                                <input type="text" id="company_state" name="company_state" class="validate" minlength="5" required>
                                <label for="company_state" data-error="State too short" data-success=""><i class="fa fa-flag left"></i>Company State *</label>
                            </div>
                            <div class="input-field col s12">
                                <select name="organization_type" class="" required>
                                    <option value="" disabled selected><p class="grey-text">Organization Type *</p></option>
                                    <option value="primary School">Primary School</option>
                                    <option value="secondary School">Secondary School</option>
                                    <option value="College/University">College/University</option>
                                    <option value="Non-profit Religious">Non-profit Religious</option>
                                    <option value="Non-profit Non-Religious">Non-profit Non-Religious</option>
                                    <option value="corporate">Coporate</option>
                                </select>
                            </div>
                            <div class="input-field col s12">
                                <select name="projected_budget" class="" required>
                                    <option value="" disabled selected><p class="grey-text">Projected Budget *</p></option>
                                    <option value="N10-25k">N10 - 25k</option>
                                    <option value="N25-50k">N25 - 50k</option>
                                    <option value="N50-100k">N50 - 100k</option>
                                    <option value="N100-150k">N100 - 150k</option>
                                    <option value="N150k">N150k Plus</option>
                                    
                                </select>
                            </div>
                            <div class="input-field col m12 s12">
                                <input type="text" id="event_center" name="event_center" class="validate" minlength="5" data-length="20" required>
                                <label for="event_center" data-error="Enter a valid name" data-success=""><i class="fa fa-home left"></i>Name of event Center *</label>
                            </div>
                            <div class="input-field col m12 s12">
                                <div class="input-field col s12">
                                    <textarea id="textarea1" name="event_location" class="materialize-textarea" data-length="120"></textarea>
                                    <label for="event_location"><i class="fa fa-home left"></i>Venue Address/Location  *</label>
                                </div>
                            </div>
                            <div class="input-field col m12 s12">
                                <input type="text" id="event_name" name="event_name" class="validate" minlength="6" data-length="100" required>
                                <label for="event_name" data-error="Enter a complete event name" data-success=""><i class="fa fa-flag left"></i>Event Name *</label>
                            </div>
                            <div class="input-field col m12 s12">
                                <input type="text" id="event_purpose" name="event_purpose" class="validate" minlength="6"  required>
                                <label for="event_purpose" data-error="enter more details" data-success="" ><i class="fa fa-braille left"></i>Purpose of Event *</label>
                            </div>
                            <div class="input-field col m12 s12">
                                <input type="text" id="event_date" name="event_date" class="datepicker" required>
                                <label for="event_date"><i class="fa fa-calendar-check-o left"></i>Event Date *</label>
                            </div>
                            <div class="input-field col m12 s12">
                                <input type="text" id="event_time" name="event_time" class="timepicker" required>
                                <label for="event_time"><i class="fa fa-clock-o left"></i>Event Time *</label>
                            </div>
                            <div class="input-field col m12 s12">
                                <input type="text" id="presentation_topic" name="presentation_topic" class="validate" minlength="6" required>
                                <label for="presentation_topic" data-error="Please, give more details" data-success=""><i class="fa fa-clipboard left"></i>Topic chosen for Presentation *</label>
                            </div>
                            <div class="input-field col s12">
                                <select name="attendees_number" class="" required>
                                    <option value="" disabled selected><p class="grey-text"><i class="fa fa-calendar-check-o left"></i>Number of Attendees *</p></option>
                                    <option value="Under 500">Under 500</option>
                                    <option value="500-1000">500-1000</option>
                                    <option value="1000-3000">1000-3000</option>
                                    <option value="3000-5000">3000-5000</option>
                                    <option value="5000 Plus">5000 Plus</option>
                                </select>
                            </div>
                            <div class="input-field col m12 s12">
                                <input type="text" id="attendees_demograph" name="attendees_demograph" class="validate" minlength="6" required>
                                <label for="attendees_demograph" data-error="Please, give more details" data-success=""><i class="fa fa-teacher left"></i>Attendee Demographics *</label>
                            </div>
                            <div class="input-field col s12">
                                <select id="open_event"  name="open_event" required>
                                    <option value="" disabled selected><p class="grey-text">Will this event be open to the public</p></option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                            <div class="input-field col s12">
                                <select id="event_has_ticket" name="event_has_ticket" required>
                                    <option value="" disabled selected><p class="grey-text">Will ticket be sold for the event</p></option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                            <div class="input-field col s12">
                                <select id="record_event" name="record_event" required>
                                    <option value="" disabled selected><p class="grey-text">Do you intend to record or live stream event</p></option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                            <div class="input-field col s12">
                                <select id="product_sales" name="product_sales"  required>
                                    <option value="" disabled selected><p class="grey-text">Can product be sold at this event</p></option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                            <div class="input-field col m12 s12">
                                <button type="submit" name="request" class="btn btn-large signin_btn"><i class="large material-icons right">send</i>Request Event</button>              
                            </div>
                        </form>
                    </div>
                    <div class="col m12 s12" style="margin: auto">
                        <p>
                            <em>
                                <span style="font-size: 0.7em; color: rgb(185, 185, 185);">
                                    TAM does not hold dates for non-committal inquiries. 
                                    TAM will TEMPORARILY hold dates once a FULLY executed 
                                    agreement has been reached as evidenced by a signed 
                                    contract with both signatures. Dates are NOT reserved 
                                    until you have received confirmation that your deposit has
                                    been received.
                                </span>
                            </em>
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <footer>
                <div class="row top">
                     <div class="content-wrapper">
                         <div class="row footer-content">
                             <div class="logo col m6 s12">
                                 <img src="images/logo/logo.png" alt="">
                             </div>
                             <div class="right col m6 s12 social-icon">
                                 <ul >
                                     <li><a href="https://facebook.com/theacademicmentor"><i class="fa fa-inverse fa-2x fa-facebook"></i></a></li>
                                     <li><a href="https://instagram.com/_theacademicmentor"><i class="fa fa-inverse fa-2x fa-instagram"></i></a></li>
                                     <li><a href="https://linkedin.com/_theacademicmentor"><i class="fa fa-inverse fa-2x fa-linkedin"></i></a></li>
                                     <li><a href="https://twitter.com/theacademicmentor"><i class="fa fa-inverse fa-2x fa-twitter"></i></a></li>
                                 </ul>
                             </div>
                             <p class="col m12 s12 address">
                                 120 Airport Rd, Warri, Delta State | 
                                 <a title="click to send a whatsapp message" href="https://api.whatsapp.com/send?phone=2348036969390&text=Hello,%20I%20saw%20the%20website%20you%20did%20on%20theacamedicmentor.com%20" >
                                     0803 696 9390
                                 </a>
                                 | info@theacademicmentor.com
                             </p>
                             
                         </div>
                     </div>
                </div>
                <div class="bottom">
                     <div class="content-wrapper">
                         <div class="row footer-content">
                             <p class=" col m10 s12">&copy; 2018 TAM | All Rights Reserved</p>
                             <p class=" col m2 s12"><a title="click to send a whatsapp message" href="https://api.whatsapp.com/send?phone=2348062416692&text=Hello,%20I%20saw%20the%20website%20you%20did%20on%20theacamedicmentor.com%20" ><i class="fa fa-heart"></i>&nbsp;&nbsp;@teamwebbravo</a></p>
                         </div>
                     </div>
                </div>
        </footer>
    </div>
  


       
    <script type="text/javascript" src="js/jquery-2.1.4.min.js"></script> 
    <script type="text/javascript" src="js/materialize.js"></script>
    <script type="text/javascript" src="js/custom.js"></script>
    <script>
        $(document).ready(function () {
            $('select').material_select();
            $('input#input_text, textarea#textarea1').characterCounter();
            $('.timepicker').pickatime({
                default: 'now', // Set default time: 'now', '1:30AM', '16:30'
                fromnow: 0,       // set default time to * milliseconds from now (using with default = 'now')
                twelvehour: true, // Use AM/PM or 24-hour format
                donetext: 'OK', // text for done-button
                cleartext: 'Clear', // text for clear-button
                canceltext: 'Cancel', // Text for cancel-button,
                container: undefined, // ex. 'body' will append picker to body
                autoclose: false, // automatic close timepicker
                ampmclickable: true, // make AM PM clickable
                aftershow: function(){} //Function for after opening timepicker
            });
            $('.datepicker').pickadate({
                selectMonths: true, // Creates a dropdown to control month
                selectYears: 10, // Creates a dropdown of 15 years to control year,
                today: 'Today',
                clear: 'Clear',
                close: 'Ok',
                format: 'mmm dd, yyyy',
                closeOnSelect: false, // Close upon selecting a date,
                container: undefined, // ex. 'body' will append picker to body
            });
            
            $('.modal').modal();
          
        });
    </script>
</body>
</html>