<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include("supports/header.php");?>
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <?php include("supports/nav.php")?>
        <!-- Call to action section-->
        <section class="cta">
            <div class="cta-content">
                <div class="container px-5 text-center">
                    <h1 class="text-white  display-1 lh-1 mb-4">
                        Hire or consult a lawyer in 3 easy steps.
                    </h1>
                    <a class="btn btn-outline-light py-3 px-4 rounded-pill" href="access/login">Hire a lawyer</a> <a class="btn btn-outline-light py-3 px-4 rounded-pill" href="consult-process">Consult a lawyer</a>
                    <p class="fs-5 mt-3 text-white">The best platform to find and get a lawyer in Zambia</p>
                </div>
            </div>
        </section>

        <!-- App features section-->
        <section id="features">
            <div class="container px-5">
                <div class="row gx-5 align-items-center">
                    <div class="col-lg-8 order-lg-1 mb-5 mb-lg-0">
                        <div class="container-fluid px-5">
                            <div class="row gx-5">
                                <div class="col-md-4 ">
                                    <!-- Feature item-->
                                    <div class="text-center">
                                        <i class="bi-phone icon-feature text-gradient bg-New d-block mb-3"></i>
                                        <h3 class="font-alt">One</h3>
                                        <p class="text-dark fs-5 mb-0">Create your account in an easy way</p>
                                    </div>
                                </div>
                                <div class="col-md-4 ">
                                    <!-- Feature item-->
                                    <div class="text-center">
                                        <i class="bi-pen icon-feature text-gradient bg-New d-block mb-3"></i>
                                        <h3 class="font-alt">Two</h3>
                                        <p class="text-dark fs-5 mb-0">Post your case anynimously and receive proposals from lawyers</p>
                                    </div>
                                </div>
                            
                                <div class="col-md-4  mb-md-0">
                                    <!-- Feature item-->
                                    <div class="text-center">
                                        <i class="bi-view-list icon-feature text-gradient bg-New d-block mb-3"></i>
                                        <h3 class="font-alt">Three</h3>
                                        <p class="text-dark fs-5 mb-0">Review the proposals and select the best lawyer to represent you</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 order-lg-0">
                        <!-- Features section device mockup-->
                        <div class="features-device-mockup">
                           
                            <div class="device-wrapper">
                                <div class="device" data-device="iPhoneX" data-orientation="portrait" data-color="black">
                                    <div class="screen bg-black">
                                        <!-- PUT CONTENTS HERE:-->
                                        <!-- * * This can be a video, image, or just about anything else.-->
                                        <!-- * * Set the max width of your media to 100% and the height to-->
                                        <!-- * * 100% like the demo example below.-->
                                        <!-- <video muted="muted" autoplay="" loop="" style="max-width: 100%; height: 100%"><source src="dist_old/assets/img/demo-screen.mp4" type="video/mp4" /></video> -->
                                        <img src="dist_old/images/practice.svg" alt="" style="max-width: 100%; height: 100%">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Quote/testimonial aside-->
        <aside class="text-center bg-New">
            <div class="container px-5">
                <div class="row gx-5 justify-content-center">
                    <div class="col-xl-8">
                        <div class="h2 fs-1 text-white mb-4">"An intuitive solution to a common problem that we all face, wrapped up in a single site!"</div>
                        <!-- <img src="dist_old/assets/img/tnw-logo.svg" alt="..." style="height: 3rem" /> -->
                        <p class="fs-4 text-white">L.A.Z</p>
                    </div>
                </div>
            </div>
        </aside>
        <!-- Mashead header-->
        <header class="masthead">
            <div class="container px-5">
                <div class="row gx-5 align-items-center">
                    <div class="col-lg-6">
                        <!-- Mashead text and app badges-->
                        <div class="mb-5 mb-lg-0 text-center text-lg-start">
                            <h4 class="display-1 lh-1 mb-3">Find lawyers by location</h4>
                            <a href="search-lawyer-by-city?city-name=Lusaka" class="btn btn-outline-dark m-1 py-3 px-4 rounded-pill">Lusaka</a>
                            <a href="search-lawyer-by-city?city-name=Chinsali" class="btn btn-outline-dark m-1 py-3 px-4 rounded-pill">Chinsali</a>
                            <a href="search-lawyer-by-city?city-name=Ndola" class="btn btn-outline-dark m-1 py-3 px-4 rounded-pill">Ndola</a>
                            <a href="search-lawyer-by-city?city-name=Kabwe" class="btn btn-outline-dark m-1 py-3 px-4 rounded-pill">Kabwe</a>
                            <a href="search-lawyer-by-city?city-name=Mansa" class="btn btn-outline-dark m-1 py-3 px-4 rounded-pill">Mansa</a>
                            <a href="search-lawyer-by-city?city-name=Kasama" class="btn btn-outline-dark m-1 py-3 px-4 rounded-pill">Kasama</a>
                            <a href="search-lawyer-by-city?city-name=Mongu" class="btn btn-outline-dark m-1 py-3 px-4 rounded-pill">Mongu</a>
                            <a href="search-lawyer-by-city?city-name=Chipata" class="btn btn-outline-dark m-1 py-3 px-4 rounded-pill">Chipata</a>
                            <a href="search-lawyer-by-city?city-name=Solwezi" class="btn btn-outline-dark m-1 py-3 px-4 rounded-pill">Solwezi</a>
                            <a href="search-lawyer-by-city?city-name=Choma" class="btn btn-outline-dark m-1 py-3 px-4 rounded-pill">Choma</a>
                            <div class="mt-5">
                                <form method="get" action="search-lawyer-by-city">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="text" name="city-name" id="city-name" class="form-control form-control-user" placeholder="Enter City | District Name " required>
                                            <button class="btn btn-secondary" type="submit">Search</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <!-- Masthead device mockup feature-->
                        <div class="masthead-device-mockup">
                            
                            <div class="device-wrapper">
                                <div class="device" data-device="iPhoneX" data-orientation="portrait" data-color="black">
                                    <div class="screen bg-black">
                                        <!-- PUT CONTENTS HERE:-->
                                        <!-- * * This can be a video, image, or just about anything else.-->
                                        <!-- * * Set the max width of your media to 100% and the height to-->
                                        <!-- * * 100% like the demo example below.-->
                                        <!-- <video muted="muted" autoplay="" loop="" style="max-width: 100%; height: 100%"><source src="dist_old/assets/img/demo-screen.mp4" type="video/mp4" /></video> -->
                                        <img src="dist_old/images/location.svg" alt="location" class="img-fluid" style="max-width: 100%; height: 100%">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Basic features section-->
        <section class="bg-light">
            <div class="container px-5">
                <div class="row gx-5 align-items-center justify-content-center justify-content-lg-between">
                    <div class="col-12 col-lg-5">
                        <h2 class="display-4 lh-1 mb-4">Find a lawyer by practice</h2>
                        <a href="search-lawyer-by-practice?area-of-law=Business" class="btn btn-outline-dark m-1 py-3 px-4 rounded-pill">Business</a>
                        <a href="search-lawyer-by-practice?area-of-law=Commercial" class="btn btn-outline-dark m-1 py-3 px-4 rounded-pill">Commercial</a>
                        <a href="search-lawyer-by-practice?area-of-law=Criminal" class="btn btn-outline-dark m-1 py-3 px-4 rounded-pill">Criminal</a>
                        <a href="search-lawyer-by-practice?area-of-law=Family" class="btn btn-outline-dark m-1 py-3 px-4 rounded-pill">Family</a>
                        <a href="search-lawyer-by-practice?area-of-law=Immigration" class="btn btn-outline-dark m-1 py-3 px-4 rounded-pill">Immigration</a>
                        <a href="search-lawyer-by-practice?area-of-law=Labor and employment" class="btn btn-outline-dark m-1 py-3 px-4 rounded-pill">Labor and employment</a>
                        <a href="search-lawyer-by-practice?area-of-law=Real Estate" class="btn btn-outline-dark m-1 py-3 px-4 rounded-pill">Real Estate</a>
                        <a href="search-lawyer-by-practice?area-of-law=Intellectual Property" class="btn btn-outline-dark m-1 py-3 px-4 rounded-pill">Intellectual Property</a>
                        <a href="search-lawyer-by-practice?area-of-law=Contracts" class="btn btn-outline-dark m-1 py-3 px-4 rounded-pill">Contracts</a>
                        <a href="search-lawyer-by-practice?area-of-law=Divorce" class="btn btn-outline-dark m-1 py-3 px-4 rounded-pill">Divorce</a>
                        <div class="mt-5">
                            <form method="get" action="search-lawyer-by-city">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" name="area_of_practice" id="area_of_practice" class="form-control form-control-user" placeholder="Enter lawyer's area of practice ">
                                        <button class="btn btn-secondary">Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-sm-8 col-md-6">
                        <div class="px-5 px-sm-0"><img class="img-fluid rounded-circle" src="dist_old/images/practice.svg" alt="..." /></div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- App badge section-->
        <section class="bg-New" id="download">
            <div class="container px-5">
                <h2 class="text-center text-white font-alt mb-4">Are you a lawyer?</h2>
                <div class="row">
                    <div class="col-md-6">
                        <p class="fs-5 text-white">Milatu Services is here to help client lawyer relationship by creating an online platform where prospective clients come to lawyers, and lawyers connect directly with those clients–at the click of a button.</p>

                        <p class="fs-5 text-white">We can help you get more clients. Simply create your profile to be listed in our lawyers directory and network, and immediately start receiving email summaries of relevant legal projects. Learn more here or sign up below.</p>

                        <a href="" class="btn btn-outline-light m-1 py-3 px-4 rounded-pill">Create your account</a>
                    </div>
                    <div class="col-md-6">
                        <img src="dist_old/images/contract.jpeg" alt="location" class="img-fluid rounded">
                    </div>
                </div>
            </div>
        </section>

        <?php include("supports/footer.php")?>
        
    </body>
</html>
