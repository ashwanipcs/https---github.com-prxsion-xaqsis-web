<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">    
    <!--====== Title ======-->
    <title>XAQSIS - Get control of your project | Home</title>    
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="{{ url('public/assets/assets/images/favicon.png') }}" type="image/png">        
    <!--====== Slick CSS ======-->
    <link rel="stylesheet" href="{{ url('public/assets/assets/css/slick.css') }}">        
    <!--====== Font Awesome CSS ======-->
    <link rel="stylesheet" href="{{ url('public/assets/assets/css/font-awesome.min.css') }}">        
    <!--====== Line Icons CSS ======-->
    <link rel="stylesheet" href="{{ url('public/assets/assets/css/LineIcons.css') }}">        
    <!--====== Animate CSS ======-->
    <link rel="stylesheet" href="{{ url('public/assets/assets/css/animate.css') }}">        
    <!--====== Magnific Popup CSS ======-->
    <link rel="stylesheet" href="{{ url('public/assets/assets/css/magnific-popup.css') }}">        
    <!--====== Bootstrap CSS ======-->
    <link rel="stylesheet" href="{{ url('public/assets/assets/css/bootstrap.min.css') }}">    
    <!--====== Default CSS ======-->
    <link rel="stylesheet" href="{{ url('public/assets/assets/css/default.css') }}">    
    <!--====== Style CSS ======-->
    <link rel="stylesheet" href="{{ url('public/assets/assets/css/style.css') }}">    
</head>
<body>
    <!--====== PRELOADER PART START ======-->
    <div class="preloader">
        <div class="loader">
            <div class="ytp-spinner">
                <div class="ytp-spinner-container">
                    <div class="ytp-spinner-rotator">
                        <div class="ytp-spinner-left">
                            <div class="ytp-spinner-circle"></div>
                        </div>
                        <div class="ytp-spinner-right">
                            <div class="ytp-spinner-circle"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--====== PRELOADER PART ENDS ======-->
    
    <!--====== HEADER PART START ======-->
    <header class="header-area">
        <div class="navbar-area headroom">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <nav class="navbar navbar-expand-lg">
                            <a class="navbar-brand" href="{{url('/')}}">
                                <img src="{{ url('public/assets/assets/images/logo.png') }}" alt="Logo">
                            </a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                                
                            </div> <!-- navbar collapse -->
                            
                            <div class="navbar-btn d-none d-sm-inline-block fontFamily" style="font-weight: bold;">
                                <a class="lightBlueColor" href="{{route('login')}}">Login</a> | <a class="lightBlueColor" href="{{route('register')}}" >SignUp</a>
                            </div>
                        </nav> <!-- navbar -->
                    </div>
                </div> <!-- row -->
            </div> <!-- container -->
        </div> <!-- navbar area -->
        
        <div id="home" class="header-hero bg_cover d-lg-flex align-items-center" style="background-image: url({{ url('public/assets/assets/images/archi.jpg') }})">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="header-hero-content">
                            <h1 class="hero-title wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s"><b>Take control of</b> <span>Cost over run</span> and unexpected <b>Delays.</b></h1>
                            <p class="text wow fadeInUp textJustify" data-wow-duration="1s" data-wow-delay="0.5s">XAQSIS helps construction projects to complete within budget and timeline so business can focus on other important tasks.</p>
                            <div class="header-singup wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.8s">
                                <a class="main-btn" data-scroll-nav="1" onclick="goto('GIT')">Talk to us</a>
                            </div>
                        </div> <!-- header hero content -->
                    </div>

                    <div class="col-lg-7">
                        <div class="header-hero-image d-flex align-items-center wow fadeInRightBig" data-wow-duration="1s" data-wow-delay="1.1s">
                            <div class="image">
                                <img src="{{ url('public/assets/assets/images/hero-image.png') }}" alt="Hero Image">
                            </div>
                        </div> <!-- header hero image -->
                    </div>
                </div> <!-- row -->
            </div> <!-- container -->
            
        </div> <!-- header hero -->
    </header>
    
    <!--====== HEADER PART ENDS ======-->
    
    
    <!--====== OUR SERVICE PART START ======-->
    
    <section id="services" class="our-services-area pt-115 pb-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-5 col-lg-6 col-md-8 col-sm-9">
                    <div class="section-title text-center wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s">
                        <h4 class="title">See how easy it is <span>to use XAQSIS</span></h4>
                    </div> <!-- section title -->
                </div>
            </div> <!-- row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="our-services-tab pt-30">
                        <ul class="nav justify-content-center wow fadeIn" data-wow-duration="1s" data-wow-delay="0.5s" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="active" id="business-tab" data-toggle="tab" href="#step1" role="tab" aria-controls="business" aria-selected="true">
                                    <i class="lni-briefcase"></i> <span>1.<br>Create a Project</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a id="digital-tab" data-toggle="tab" href="#step2" role="tab" aria-controls="digital" aria-selected="false">
                                    <i class="lni-add-file"></i> <span>2.<br>Add Activities</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a id="market-tab" data-toggle="tab" href="#step3" role="tab" aria-controls="market" aria-selected="false">
                                    <i class="lni-play"></i> <span>3. <br>Run Simulation</span>
                                </a>
                            </li>
							<li class="nav-item">
                                <a id="market-tab" data-toggle="tab" href="#step4" role="tab" aria-controls="market" aria-selected="false">
                                    <i class="lni-stats-up"></i> <span>4.<br>Get Full Insight</span>
                                </a>
                            </li>

                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="step1" role="tabpanel" aria-labelledby="business-tab">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="our-services-image mt-50">
                                            <img src="{{ url('public/assets/assets/images/our-service-1.jpg') }}" alt="service">
                                        </div> <!-- our services image -->
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="our-services-content mt-45">
                                            <h3 class="services-title">Create or manage <span>multiple projects with strict Budget and Timeline.</span></h3>
                                            <p class="text">With XAQSIS you can deliver projects without cost over runs and delays. Give back your clients benefits of saved money and time. </p>                                     
                                            <div class="our-services-progress d-flex align-items-center mt-55">
                                                <div class="circle" id="circles-1"></div>
                                                <div class="progress-content">
                                                    <h4 class="progress-title">Consultancy<br> Agency Skill.</h4>
                                                </div>
                                            </div>
                                        </div> <!-- our services content -->
                                    </div>
                                </div> <!-- row -->
                            </div>
                            
                            <div class="tab-pane fade" id="step2" role="tabpanel" aria-labelledby="digital-tab">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="our-services-image mt-50">
                                            <img src="{{ url('public/assets/assets/images/our-service-1.jpg') }}" alt="service">
                                        </div> <!-- our services image -->
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="our-services-content mt-45">
                                            <h3 class="services-title">Press a button - <span>start by adding activities.</span></h3>
                                            <p class="text">Add activities, enter cost, tune duration, change again, add more activities. </p>
                                            
                                            <div class="our-services-progress d-flex align-items-center mt-55">
                                                <div class="circle" id="circles-2"></div>
                                                <div class="progress-content">
                                                    <h4 class="progress-title">Digital Marketing <br> Skill.</h4>
                                                </div>
                                            </div>
                                        </div> <!-- our services content -->
                                    </div>
                                </div> <!-- row -->
                            </div>
                            
                            <div class="tab-pane fade" id="step3" role="tabpanel" aria-labelledby="market-tab">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="our-services-image mt-50">
                                            <img src="{{ url('public/assets/assets/images/our-service-1.jpg') }}" alt="service">
                                        </div> <!-- our services image -->
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="our-services-content mt-45">
                                            <h3 class="services-title">Run a Simulation <span> </span></h3>
                                            <p class="text">XAQSIS - one of its kind to introduce Monte Carlo Simulation in estimating accurate cost and duration for contruction project.<br>  
											<br> Probabilistic Results. Results show not only what could happen, but how likely each outcome is. </p>
                                            
                                            <div class="our-services-progress d-flex align-items-center mt-55">
                                                <div class="circle" id="circles-3"></div>
                                                <div class="progress-content">
                                                    <h4 class="progress-title">Market Analysis <br> Agency Skill.</h4>
                                                </div>
                                            </div>
                                        </div> <!-- our services content -->
                                    </div>
                                </div> <!-- row -->
                            </div>
							
							<div class="tab-pane fade" id="step4" role="tabpanel" aria-labelledby="market-tab">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="our-services-image mt-50">
                                            <img src="{{ url('public/assets/assets/images/our-service-1.jpg') }}" alt="service">
                                        </div> <!-- our services image -->
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="our-services-content mt-45">
                                            <h3 class="services-title">Get Full Insight <span> with simulation results</span></h3>
                                            <p class="text">XAQSIS performs variation analysis by building models of possible results by substituting a range of values—a probability distribution—for any factor that has inherent uncertainty<br>  
											</p>
                                           
                                            <div class="our-services-progress d-flex align-items-center mt-55">
                                                <div class="circle" id="circles-3"></div>
                                                <div class="progress-content">
                                                    <h4 class="progress-title">Market Analysis <br> Agency Skill.</h4>
                                                </div>
                                            </div>
                                        </div> <!-- our services content -->
                                    </div>
                                </div> <!-- row -->
                            </div>
							
							
                        </div> <!-- tab content -->
                    </div> <!-- our services tab -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>
    
    <!--====== OUR SERVICE PART ENDS ======-->
    
	   <!--====== ABOUT PART START ======-->
    
    <section id="about" class="about-area pt-115 pb-100 lavBackground">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <div class="about-title text-center wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s">
                        <h3 class="title"><span>Our 10 years working experience to </span> take care of your business goal.</h3>
                    </div>
                </div>
            </div> <!-- row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="about-image mt-60 wow fadeIn" data-wow-duration="1s" data-wow-delay="0.5s">
                        <img src="{{ url('public/assets/assets/images/about.png') }}" alt="about">
                    </div> <!-- about image -->
                </div>
            </div> <!-- row -->
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="about-content pt-45">
                        <p class="text wow fadeInUp textJustify" data-wow-duration="1s" data-wow-delay="0.4s"> PRXSION Technologies is a Data Solutions and Consulting Services company. We help businesses make smart and data-driven decisions by providing them with relevant Insights. 
							<br> XAQSIS is a flagship product of PRXSION Technologies. It encapsulate Statistics and Project management techniques to provide easy to use tool for cost consultant and builder to take control of construction projects. </p>
                        
                        
                    </div> <!-- about content -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>
    
    <!--====== ABOUT PART ENDS ======-->
 
	
    <!--====== SERVICE PART START ======-->
    
    <section id="service" class="service-area pt-105 pb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="section-title wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s">
                            <h4 class="title">The reasons to choose us <span>as your business partner</span></h4>
                    </div> <!-- section title -->
                </div>
            </div> <!-- row -->
            <div class="service-wrapper mt-60 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.6s">
                <div class="row no-gutters justify-content-center">
                    <div class="col-lg-4 col-md-7">
                        <div class="single-service d-flex">
                            <div class="service-icon">
                                <img src="{{ url('public/assets/assets/images/service-2.png') }}" alt="Icon">
                            </div>
                            <div class="service-content media-body">
                                <h4 class="service-title">Manage multiple projects with strict budgets and timelines.</h4>
                                <p class="text">With XAQSIS you can deliver projects without cost over runs and delay. Give back your clients benefits of saved money and time.</p>
                            </div>
                            <div class="shape shape-1">
                                <img src="{{ url('public/assets/assets/images/shape/shape-1.svg') }}" alt="shape">
                            </div>
                            <div class="shape shape-2">
                                <img src="{{ url('public/assets/assets/images/shape/shape-2.svg') }}" alt="shape">
                            </div>
                        </div> <!-- single service -->
                    </div>
                    <div class="col-lg-4 col-md-7">
                        <div class="single-service service-border d-flex">
                            <div class="service-icon">
                                <img src="{{ url('public/assets/assets/images/service-1.png') }}" alt="Icon">
                            </div>
                            <div class="service-content media-body">
                                <h4 class="service-title">Full visibility of projects</h4>
                                <p class="text">With XAQSIS you and your client get a 360 degree view of all on going projects. You can follow money and time at the same time.</p>
                            </div>
                            <div class="shape shape-3">
                                <img src="{{ url('public/assets/assets/images/shape/shape-3.svg') }}" alt="shape">
                            </div>
                        </div> <!-- single service -->
                    </div>
                    <div class="col-lg-4 col-md-7">
                        <div class="single-service d-flex">
                            <div class="service-icon">
                                <img src="{{ url('public/assets/assets/images/service-3.png') }}" alt="Icon">
                            </div>
                            <div class="service-content media-body">
                                <h4 class="service-title">Customer Relationship</h4>
                                <p class="text">You can be sure that the construction process is done with an attention to a single detail so you can maintain good customer relations.</p>
                            </div>
                            <div class="shape shape-4">
                                <img src="{{ url('public/assets/assets/images/shape/shape-4.svg') }}" alt="shape">
                            </div>
                            <div class="shape shape-5">
                                <img src="{{ url('public/assets/assets/images/shape/shape-5.svg') }}" alt="shape">
                            </div>
                        </div> <!-- single service -->
                    </div>
                </div> <!-- row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="header-singup wow fadeInUp text-center pt-20 pb-30" data-wow-duration="1s" data-wow-delay="0.8s">
                            <a class="main-btn" data-scroll-nav="1" onclick="goto('GIT')" style="color: white; box-shadow: 10px 12px 1px rgb(0 0 0 / 10%);">Let us know what you think!</a>
                        </div> <!-- service btn -->
                    </div>
                </div> <!-- row -->
            </div> <!-- service wrapper -->
        </div> <!-- container -->
    </section>    
    <!--====== SERVICE PART ENDS ======-->    
    <!--====== PRICING PART START ======-->    
    <section data-scroll-index="0" id="pricing" class="pricing-area pt-115 pb-100 lavBackground">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="section-title text-center pb-20 wow fadeInUpBig" data-wow-duration="1s" data-wow-delay="0.2s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.2s; animation-name: fadeInUpBig;">
                        <h4 class="title">Providing Best Pricing <span>For Your Business.</span></h4>
                    </div> <!-- section title -->
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="section-title text-center pb-20 wow fadeInUpBig" data-wow-duration="1s" data-wow-delay="0.2s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.2s; animation-name: fadeInUpBig;">
                        <h3 class="title">Unlimited Bandwidth. <div>1 Credit = 1 Month = 1 Project</div></h3>
                    </div> <!-- section title -->
                </div>

            </div> <!-- row -->


            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-7 col-sm-9">
                    <div class="single-pricing text-center pricing-color-1 mt-30 wow fadeIn" data-wow-duration="1s" data-wow-delay="0.3s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.3s; animation-name: fadeIn; height: 85%; border: 1px solid lavender; border-radius: 10px; background-color: white; box-shadow: 10px 12px 1px rgb(0 0 0 / 10%);">
                        <div class="pricing-price">
                             <span class="price"><b>0.00</b><div class="symbol">INR/Credit</div></span>
                        </div>
                        <div class="pricing-title">
                            <h4 class="title">FREE</h4>
                        </div>
                        <div class="pricing-list">
                            <ul>
                                <li>Limited Access</li>
                                <li>1 Month Support</li>
                                <li style="text-decoration: line-through;">Free 10 Credits</li>
                            </ul>
                        </div>
                        <div class="pricing-btn pt-50">
                            <a class="main-btn main-btn-2" href="{{route('register')}}">Sign Up Now !</a>
                        </div>
                    </div> <!-- single pricing -->
                </div>
                <div class="col-lg-4 col-md-7 col-sm-9">
                    <div class="single-pricing text-center pricing-color-1 mt-30 wow fadeIn" data-wow-duration="1s" data-wow-delay="0.3s" style="visibility: visible;animation-duration: 1s;animation-delay: 0.3s;animation-name: fadeIn;height: 85%;border: 1px solid lavender;border-radius: 10px;background-color: white; box-shadow: 10px 12px 1px rgb(0 0 0 / 10%);">
                        <div class="pricing-price">
                             <span class="price"><b>5000.00</b><div class="symbol">INR/Credit</div></span>
                        </div>
                        <div class="pricing-title ">
                            <h4 class="title">PREMIUM</h4>
                        </div>
                        <div class="pricing-list ">
                            <ul>
                                <li>Unlimited Access</li>
                                <li>24x7 Support</li>
                                <li>Free 10 Credits</li>
                            </ul>
                        </div>
                        <div class="pricing-btn pt-50">
                            <a class="main-btn main-btn-2" href="{{route('register')}}">Sign Up Now !</a>
                        </div>
                    </div> <!-- single pricing -->
                </div>

            </div> <!-- row -->

            <div class="row justify-content-center">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="section-title text-center pb-20 wow fadeInUpBig" data-wow-duration="1s" data-wow-delay="0.2s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.2s; animation-name: fadeInUpBig;">
                        <h4 class="title">No annual contract, purchase credits as you require.</h5>
                    </div> <!-- section title -->
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="section-title text-center pb-20 wow fadeInUpBig" data-wow-duration="1s" data-wow-delay="0.2s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.2s; animation-name: fadeInUpBig;">
                        <h4 class="title">If you don't like the product, you can still view and export existing projects</h5></div>
                    </div> <!-- section title -->
                </div>

            </div>


         <!-- container -->
    </section>
    
    <!--====== PRICING PART ENDS ======-->    
    <!--====== TESTIMONIAL PART START ======-->    
    <section id="testimonial" class="testimonial-area pt-70 pb-100">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-xl-5 col-lg-6">
                    <div class="testimonial-left-content mt-45 wow fadeIn" data-wow-duration="1s" data-wow-delay="0.3s">
                        <div class="section-title">
                            <h4 class="title">What is Simulation and how it benefits projects?</h4>
                        </div> <!-- section title -->
                        
                        <p class="text">Simulations are used to model the probability of different outcomes in a process that cannot easily be predicted due to the intervention of random variables. It is a technique used to understand the impact of risk and uncertainty in prediction and forecasting models.<br> <br> It can be used to tackle a range of problems in virtually every field such as finance, engineering, supply chain, and science. Now first time, XAQSIS </p>
                    </div> <!-- testimonial left content -->
                </div>
                <div class="col-lg-6">
                    <div class="testimonial-right-content mt-50 wow fadeIn" data-wow-duration="1s" data-wow-delay="0.6s">
                        <!-- <div class="quota">
                            <i class="lni-quotation"></i>
                        </div> -->
                        <div class="testimonial-content-wrapper testimonial-active pl-10 pr-10 pb-10">
                            <div class="single-testimonial">
                                <div class="testimonial-text">
                                    <p class="text">Probabilistic Results: Results show not only what could happen, but how likely each outcome is.</p>
                                </div>
                                <div class="testimonial-author d-sm-flex justify-content-between">
									<!-- We can add items here -->
                                </div>
                            </div> <!-- single testimonial -->
                            <div class="single-testimonial">
                                <div class="testimonial-text">
                                    <p class="text">Graphical Results: Because of the data a Monte Carlo simulation generates, it’s easy to create graphs of different outcomes and their chances of occurrence. This is important for communicating findings to other stakeholders.</p>
                                </div>
                                <div class="testimonial-author d-sm-flex justify-content-between">
									<!-- We can add items here -->
                                    
                                </div>
                            </div> <!-- single testimonial -->
                            <div class="single-testimonial">
                                <div class="testimonial-text">
                                    <p class="text">Sensitivity Analysis: With just a few cases, deterministic analysis makes it difficult to see which variables impact the outcome the most. In Monte Carlo simulation, it’s easy to see which inputs had the biggest effect on bottom-line results.</p>
                                </div>
                                <div class="testimonial-author d-sm-flex justify-content-between">
									<!-- We can add items here -->
                                </div>
                            </div> <!-- single testimonial -->
							 <div class="single-testimonial">
                                <div class="testimonial-text">
                                    <p class="text">Scenario Analysis: In deterministic models, it’s very difficult to model different combinations of values for different inputs to see the effects of truly different scenarios. Using simulation, analysts can see exactly which inputs had which values together when certain outcomes occurred. This is invaluable for pursuing further analysis.</p>
                                </div>
                                <div class="testimonial-author d-sm-flex justify-content-between">
									<!-- We can add items here -->
                                </div>
                            </div> <!-- single testimonial -->
                        </div> <!-- testimonial content wrapper -->
                    </div> <!-- testimonial right content -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>    
    <!--====== TESTIMONIAL PART ENDS ======-->   
    <!--====== CONTACT PART START ======-->
    <section data-scroll-index="1" id="contact" class="contact-area pt-120 pb-120 lavBackground">
        <div class="container ">
            <div class="row justify-content-center" id="inTouch">
                <div class="col-lg-4">
                    <div class="section-title text-center pb-20 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s">
                        <h4 class="title">Get In <span>Touch.</span></h4>
                    </div> <!-- section title -->
                </div>
            </div> <!-- row -->
            
            <div class="row">
                <div class="col-lg-12">
                    <div id="GIT" class="contact-wrapper-form pt-65  wow fadeInUpBig" data-wow-duration="1s" data-wow-delay="0.5s">
                        <h4 class="contact-title pb-10"><i class="lni-envelope"></i> Leave <span>A Message.</span></h4>
							 @if(Session::has('success'))
							<div class="alert alert-success">
								{{ Session::get('success') }}
								@php
									Session::forget('success');
								@endphp
							</div>
							@endif
                        <form id="contact-form" action="{{ route('contact-form')}}" method="post">
							  {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="contact-form mt-45">
                                        <label>Enter Your Name</label>
                                        <input type="text" name="name" class="form-control" placeholder="Full Name" value="{{ old('name') }}">
                                        @if ($errors->has('name'))
                                            <span class="text-danger">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div> <!-- contact-form -->
                                </div>
                                <div class="col-md-6">
                                    <div class="contact-form mt-45">
                                        <label>Enter Your Email</label>
                                      	 <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
                                        @if ($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div> <!-- contact-form -->
                                </div>
                                <div class="col-md-12">
                                    <div class="contact-form mt-45">
                                        <label>Your Message</label>                                       
										<textarea name="message" class="form-control" placeholder="Enter your message...">{{ old('message') }}</textarea>
                                        @if ($errors->has('message'))
                                            <span class="text-danger">{{ $errors->first('message') }}</span>
                                        @endif
                                    </div> <!-- contact-form -->
                                </div>
                                <p class="form-message"></p>
                                <div class="col-md-12">
                                    <div class="contact-form mt-45">
                                        <button type="submit" class="main-btn">Send Now</button>
                                    </div> <!-- contact-form -->
                                </div>
                            </div> <!-- row -->
                        </form>
                    </div> <!-- contact wrapper form -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>

    <!--====== CONTACT PART ENDS ======-->
    
	
    <!--====== FOOTER PART START ======-->
    
    <footer id="footer" class="footer-area bg_cover" style="background-image: url({{url('public/assets/assets/images/archi.jpg') }})">
        <div class="container">
            <div class="footer-widget pt-5 pb-5">
                <div class="row">
                    <div class="col-lg-8 col-sm-8 order-sm-1 order-lg-1">
                        <div class="footer-about pt-40">
                            <a href="#">
                                <img src="{{ url('public/assets/assets/images/logo.png') }}" alt="Logo">
                            </a>
                            <p class="text">PRXSION Technologies is a Data Solutions and Consulting Services company. We help businesses make smart and data-driven decisions by providing them with relevant Insights.</p> 
							<p class="text">XAQSIS is a flagship product of PRXSION Technologies. It encapsulate Statistics and Project management techniques to provide easy to use tool for cost consultant and builder to take control of construction projects. </p>
                        </div> <!-- footer about -->
                    </div>
                  
                   
                    <div class="col-lg-4 col-sm-2 order-sm-2 order-lg-4">
                        <div class="footer-contact pt-40">
                            <div class="footer-title">
                                <h5 class="title">Contact Info</h5>
                            </div>
                            <div class="contact pt-10">
                                <p class="text">H402, PALACIA <br>
                                    WAGHBIL, GHODHBUNDER ROAD, <br>
                                    THANE(W) - 400615, MAHARASHTRA<br>
                                    INDIA</p>
                                <p class="text">hello@xaqsis.com</p>
                                <p class="text">+91 99303 00053</p>

                                <ul class="social mt-40">
                                    <li><a href="#"><i class="lni-facebook"></i></a></li>
                                    <li><a href="#"><i class="lni-twitter"></i></a></li>
                                    <li><a href="#"><i class="lni-instagram"></i></a></li>
                                    <li><a href="#"><i class="lni-linkedin"></i></a></li>
                                </ul>
                            </div> <!-- contact -->
                        </div> <!-- footer contact -->
                    </div>
                </div> <!-- row -->
            </div> <!-- footer widget -->
            <div class="footer-copyright text-center">
                <p class="text">© 2022 Prxsion Technologies Pvt Ltd. <a href="https://www.prxsion.com" rel="nofollow">Prxsion Technologies</a> All Rights Reserved.</p>
            </div>
        </div> <!-- container -->
    </footer>    
    <!--====== FOOTER PART ENDS ======-->    
    <!--====== BACK TOP TOP PART START ======-->
    <a href="#" class="back-to-top"><i class="lni-chevron-up"></i></a>
    <!--====== BACK TOP TOP PART ENDS ======-->  
    <!--====== Jquery js ======-->
    <script src="{{ url('public/assets/assets/js/vendor/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ url('public/assets/assets/js/vendor/modernizr-3.7.1.min.js') }}"></script>    
    <!--====== Bootstrap js ======-->
    <script src="{{ url('public/assets/assets/js/popper.min.js') }}"></script>
    <script src="{{ url('public/assets/assets/js/bootstrap.min.js') }}"></script>    
    <!--====== Slick js ======-->
    <script src="{{ url('public/assets/assets/js/slick.min.js') }}"></script>    
    <!--====== Isotope js ======-->
    <script src="{{ url('public/assets/assets/js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ url('public/assets/assets/js/isotope.pkgd.min.js') }}"></script>    
    <!--====== Counter Up js ======-->
    <script src="{{ url('public/assets/assets/js/waypoints.min.js') }}"></script>
    <script src="{{ url('public/assets/assets/js/jquery.counterup.min.js') }}"></script>    
    <!--====== Circles js ======-->
    <script src="{{ url('public/assets/assets/js/circles.min.js') }}"></script>    
    <!--====== Appear js ======-->
    <script src="{{ url('public/assets/assets/js/jquery.appear.min.js') }}"></script>    
    <!--====== WOW js ======-->
    <script src="{{ url('public/assets/assets/js/wow.min.js') }}"></script>    
    <!--====== Headroom js ======-->
    <script src="{{ url('public/assets/assets/js/headroom.min.js') }}"></script>    
    <!--====== Jquery Nav js ======-->
    <script src="{{ url('public/assets/assets/js/jquery.nav.js') }}"></script>    
    <!--====== Scroll It js ======-->
    <script src="{{ url('public/assets/assets/js/scrollIt.min.js') }}"></script>    
    <!--====== Magnific Popup js ======-->
    <script src="{{ url('public/assets/assets/js/jquery.magnific-popup.min.js') }}"></script>    
    <!--====== Main js ======-->
    <script src="{{ url('public/assets/assets/js/main.js') }}"></script>    
</body>

</html>

<script>
    function goto($hashtag){
     //document.location = "index.html#" + $hashtag;
	 document.location = "{{url('/')}}#" + $hashtag;
    }

    $( document ).ready(function() {
        // $('.lni-arrow-left').hide();
        // $('.lni-arrow-right').hide();
    });
</script>
