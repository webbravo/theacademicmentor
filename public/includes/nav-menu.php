                <header class="z-depth-3 ">
                    <div class="navbar content-wrapper row">
                        <div class="left col m3 s6 logo  ">
                            <a href="index.php"><img data-src="images/logo/logo.png" alt=""></a>
                        </div>
                        <div class="right nav col m9">
                            <ul id="nav-mobile" class=" s12 hide-on-med-and-down ">
                                <li><a href="about.php">About TAM</a></li>
                                <li><a href="video.php">Free Videos</a></li>
                                <li><a href="events.php">LIVE EVENTS</a></li>
                                <li class='dropdown-button' data-activates='dropdown1'><a> <i class="fa fa-bars"></i> MENU</a></li>                  
                                <ul id='dropdown1' class='dropdown-content'>
                                    <li><a href="blog.php">Blog</a></li>
                                    <li><a href="book-store.php">Book-Store</a></li> 
                                    <li><a href="grind-gear.php">Grind Gear</a></li>
                                    <li><a href="careertest/">Career test</a></li>
                                    <li><a href="testimonials.php">Testimonials</a></li>
                                    
                                    <li class="divider"></li>
                                    <li><a href="events.php">TAM Event</a></li>
                                </ul> 
                                <li><a class="btn waves-effect btn-large tam-orange-btn" href="bookings.php">Book TAM <i class="material-icons left">book</i></a></li>
                            </ul>
                            <div class="humburger right col m2 s2 hide-on-large-only ">
                                <a href="" data-activates="slide-out" class="button-collapse">
                                    <i class="material-icons">menu</i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <ul class="side-nav" id="slide-out">
                        <li>
                            <div class="center logo  ">
                                <a href="index.php"><img data-src="images/logo/lg.png" alt=""></a>
                            </div>
                        </li>
                        <li><div class="divider"></div></li>                        
                        <li class="<?php if(isset($aboutPage)) echo "active"; ?>"><a href="about.php">About TAM</a></li>
                        <li class="<?php if(isset($videoPage)) echo "active"; ?>"><a href="video.php">Free Videos</a></li>
                        <li class="<?php if(isset($blogPage)) echo "active"; ?>"><a href="blog.php">Blog</a></li>   
                        <li class="divider"></li>                 
                        <li class="<?php if(isset($grindPage)) echo "active"; ?>"><a href="grind-gear.php">Grind Gear</a></li>
                        <li class="<?php if(isset($bookStorePage)) echo "active"; ?>"><a href="book-store.php">Book-Store</a></li> 
                        <li class="divider"></li>                 
                        <li class="<?php if(isset($careertestPage)) echo "active"; ?>"><a href="careertest/">Career test</a></li>
                        <li class="<?php if(isset($testimonialsPage)) echo "active"; ?>"><a href="testimonials.php">Testimonials</a></li>
                        <li class="<?php if(isset($eventsPage)) echo "active"; ?>"><a href="events.php">TAM Event</a></li>                                                        
                        <li class="divider"></li>
                        <a href="bookings.php">

                        <li style="padding: 10px 25px;"><button class="btn waves-effect btn-large tam-orange-btn" href="bookings.php">Book TAM <i class="material-icons left">book</i></button></li>
                        
                        </a>
                    </ul>
                </header>