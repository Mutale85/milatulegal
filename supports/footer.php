<div class="container mt-5 pg-footer">
    <?php 
        if (!isset($_COOKIE['newCookieBanner'])):
        
        ?>
        <div class="cookie-consent-banner">
            <div class="cookie-consent-banner__inner">
                <div class="cookie-consent-banner__copy">
                    <div class="cookie-consent-banner__header">THIS WEBSITE USES COOKIES</div>
                    <div class="cookie-consent-banner__description">We use cookies to personalise content, to provide many media features and to analyse our traffic. We also use the cookie information to help you navigate amonng the apps on this software for your good use of our site, cookies maybe used for analytics purposes to know which pages you have visited You consent to our cookies if you continue to use our website.</div>
                </div>

                <div class="cookie-consent-banner__actions">
                    <a href="" class="cookie-consent-banner__cta cookiesAgree">
                        OK
                    </a>
                
                    <a href="" class="cookie-consent-banner__cta cookie-consent-banner__cta--secondary cookiesAgree">
                        Decline
                    </a>
                </div>
            </div>
        </div>
        <?php endif;?>
        <footer class="footer">
            <svg class="footer-wave-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 100" preserveAspectRatio="none">
                <path class="footer-wave-path" d="M851.8,100c125,0,288.3-45,348.2-64V0H0v44c3.7-1,7.3-1.9,11-2.9C80.7,22,151.7,10.8,223.5,6.3C276.7,2.9,330,4,383,9.8 c52.2,5.7,103.3,16.2,153.4,32.8C623.9,71.3,726.8,100,851.8,100z"></path>
            </svg>
            <div class="footer-content">
                <div class="footer-content-column">
                    <div class="footer-logo">
                        <a class="footer-logo-link" href="">
                            <span class="hidden-link-text">Milatu</span>
                            <h4 class="text-dark">Milatu</h4>
                        </a>
                    </div>
                    <div class="footer-menu">
                        <h2 class="footer-menu-name"> Get Started</h2>
                        <ul id="menu-get-started" class="footer-menu-list">
                            <li class="menu-item menu-item-type-post_type menu-item-object-product">
                                <a href="signup-lawyers" title="signup-lawyers">Lawyers Signup</a>
                            </li>
                            <li class="menu-item menu-item-type-post_type menu-item-object-product">
                                <a href="access/signup-account" title="signup-client">Need Legal Help</a>
                            </li>
                            
                        </ul>
                    </div>
                </div>
                <div class="footer-content-column">
                    <div class="footer-menu">
                        <h2 class="footer-menu-name"> Company</h2>
                        <ul id="menu-company" class="footer-menu-list">
                            <li class="menu-item menu-item-type-post_type menu-item-object-page">
                                <a href="contact" title="contact">Contact</a>
                            </li>
                            <li class="menu-item menu-item-type-taxonomy menu-item-object-category">
                                <a href="">News</a>
                            </li>
                            <li class="menu-item menu-item-type-post_type menu-item-object-page">
                                <a href="https://golinkjobs.com" target="_blank">Careers</a>
                            </li>
                        </ul>
                    </div>
                  <div class="footer-menu">
                    <h2 class="footer-menu-name"> Legal</h2>
                    <ul id="menu-legal" class="footer-menu-list">
                      <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-privacy-policy menu-item-170434">
                        <a href="privacy">Privacy Notice</a>
                      </li>
                      <li class="menu-item menu-item-type-post_type menu-item-object-page">
                        <a href="terms-of-use">Terms of Use</a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="footer-content-column">
                    <div class="footer-menu">
                        <h2 class="footer-menu-name"> Quick Links</h2>
                        <ul id="menu-quick-links" class="footer-menu-list">
                            <li class="menu-item menu-item-type-custom menu-item-object-custom">
                                <a target="_blank" rel="noopener noreferrer" href="lawyers-info" title="lawyers-info">Lawyers Info</a>
                            </li>
                            
                            <li class="menu-item menu-item-type-post_type menu-item-object-page">
                                <a href="blogs" title="blog">Blog</a>
                            </li>
                            <li class="menu-item menu-item-type-post_type_archive menu-item-object-customer">
                                <a href="clients-info" title="clients-info">Client's info</a>
                            </li>
                            <!-- <li class="menu-item menu-item-type-post_type menu-item-object-page">
                                <a href="#">Reviews</a>
                            </li> -->
                        </ul>
                    </div>
                </div>
                <div class="footer-content-column">
                    <div class="footer-call-to-action">
                        <h2 class="footer-call-to-action-title"> Let's Chat</h2>
                        <p class="footer-call-to-action-description"> Have a support question?</p>
                        <a class="footer-call-to-action-button button rounded-pill px-3 mb-2 mb-lg-0" data-bs-toggle="modal" data-bs-target="#feedbackModal"> Get in Touch </a>
                    </div>
                    <div class="footer-call-to-action">
                       <!--  <h2 class="footer-call-to-action-title"> You Call Us</h2>
                        <p class="footer-call-to-action-link-wrapper text-dark"> <a class="footer-call-to-action-link" href="tel:+260976330092" class="text-dark" target="_self"> +260 976 330 092 </a></p> -->
                    </div>
                </div>
                <div class="footer-social-links"> 
                    <svg class="footer-social-amoeba-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 236 54">
                        <path class="footer-social-amoeba-path" d="M223.06,43.32c-.77-7.2,1.87-28.47-20-32.53C187.78,8,180.41,18,178.32,20.7s-5.63,10.1-4.07,16.7-.13,15.23-4.06,15.91-8.75-2.9-6.89-7S167.41,36,167.15,33a18.93,18.93,0,0,0-2.64-8.53c-3.44-5.5-8-11.19-19.12-11.19a21.64,21.64,0,0,0-18.31,9.18c-2.08,2.7-5.66,9.6-4.07,16.69s.64,14.32-6.11,13.9S108.35,46.5,112,36.54s-1.89-21.24-4-23.94S96.34,0,85.23,0,57.46,8.84,56.49,24.56s6.92,20.79,7,24.59c.07,2.75-6.43,4.16-12.92,2.38s-4-10.75-3.46-12.38c1.85-6.6-2-14-4.08-16.69a21.62,21.62,0,0,0-18.3-9.18C13.62,13.28,9.06,19,5.62,24.47A18.81,18.81,0,0,0,3,33a21.85,21.85,0,0,0,1.58,9.08,16.58,16.58,0,0,1,1.06,5A6.75,6.75,0,0,1,0,54H236C235.47,54,223.83,50.52,223.06,43.32Z"></path>
                    </svg>
                    <a class="footer-social-link linkedin" href="https://www.linkedin.com/company/osabox-co/" target="_blank">
                        <span class="hidden-link-text">Linkedin</span>
                        <i class="bi bi-linkedin"></i>
                    </a>
                    <a class="footer-social-link twitter" href="#" target="_blank">
                        <span class="hidden-link-text">Twitter</span>
                        <i class="bi bi-twitter"></i>
                    </a>
                    <a class="footer-social-link youtube" href="#" target="_blank">
                        <span class="hidden-link-text">Youtube</span>
                        <i class="bi bi-youtube"></i>
                    </a>
                    <a class="footer-social-link github" href="#" target="_blank">
                        <span class="hidden-link-text">Github</span>
                        <i class="bi bi-github"></i>
                    </a>
                </div>
            </div>
            <div class="footer-copyright">
                <div class="footer-copyright-wrapper">
                    <p class="footer-copyright-text">
                    <a class="footer-copyright-link" href="access/admin-login" target="_self"> &copy; <?php echo date("j-F-Y")?> | Milatu | All rights reserved. </a>
                  </p>
                </div>
            </div>
        </footer>
    </div>
    <!-- Feedback Modal-->
        <div class="modal fade" id="feedbackModal" tabindex="-1" aria-labelledby="feedbackModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-gradient-primary-to-secondary p-4">
                        <h5 class="modal-title font-alt text-white" id="feedbackModalLabel" >Send feedback</h5>
                        <button class="btn-close btn-close-white" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body border-0 p-4">
                       
                        <form id="contactForm" data-sb-form-api-token="API_TOKEN">
                            <!-- Name input-->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="name" type="text" placeholder="Enter your name..." data-sb-validations="required" />
                                <label for="name">Full name</label>
                                <div class="invalid-feedback" data-sb-feedback="name:required">A name is required.</div>
                            </div>
                            <!-- Email address input-->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="email" type="email" placeholder="name@example.com" data-sb-validations="required,email" />
                                <label for="email">Email address</label>
                                <div class="invalid-feedback" data-sb-feedback="email:required">An email is required.</div>
                                <div class="invalid-feedback" data-sb-feedback="email:email">Email is not valid.</div>
                            </div>
                            <!-- Phone number input-->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="phone" type="tel" placeholder="(123) 456-7890" data-sb-validations="required" />
                                <label for="phone">Phone number</label>
                                <div class="invalid-feedback" data-sb-feedback="phone:required">A phone number is required.</div>
                            </div>
                            <!-- Message input-->
                            <div class="form-floating mb-3">
                                <textarea class="form-control" id="message" type="text" placeholder="Enter your message here..." style="height: 10rem" data-sb-validations="required"></textarea>
                                <label for="message">Message</label>
                                <div class="invalid-feedback" data-sb-feedback="message:required">A message is required.</div>
                            </div>
                            
                            
                            <!-- Submit Button-->
                            <div class="d-grid"><button class="btn btn-primary rounded-pill btn-lg disabled" id="submitButton" type="submit">Submit</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="dist_old/js/scripts.js"></script>
        
        <link rel="stylesheet" type="text/css" href="supports/footer.css">

<script>
    $(document).ready(function(){
        $(".hamburger").click(function(){
            $(this).toggleClass("is-active");
        });
    });
    $(document).on("click", ".cookiesAgree", function(e){
        e.preventDefault();
        var cvalue = "newCookieBanner";
        var cname = "newCookieBanner";
        newCookieBannerSet(cname, cvalue);
        $(".cookie-consent-banner").hide("slow");
        // setTimeout(function(){
        //   $(".cookie-consent-banner").hide("slow");
        //   window.location = "./";
        // }, 500);
    })
    function newCookieBannerSet(cname, cvalue) {
        event.preventDefault();    
        const d = new Date();
        d.setTime(d.getTime() + (30*24*60*60*1000));
        let expires = "expires="+ d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }
</script>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/63b6a2ecc2f1ac1e202bd1c0/1gm0moskp';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
</script>
<!--End of Tawk.to Script-->
