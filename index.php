<?php
require_once 'core/init.php';

// create new user instance
$user = new User();

// check if user is logged in
if ($user->isLoggedIn()) {
    // if user is not logged in, redirect to login page
    Redirect::to('consumer.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="The Smart City definition varies from city to city and country to country, depending on the level of development, willingness to change and reform, resources and aspirations of the city residents.">
	<meta name="keywords" content="smart city, iit kanpur, power system lab, home automation, demand response, ishtiyaq husain">
	<meta name="author" content="Ishtiyaq Husain">

	<link rel="author" href="humans.txt" />

    <title>SmartCity</title>

    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/main.css">
    <link rel="stylesheet" type="text/css" href="assets/css/responsive.css">
    <link rel="stylesheet" media="screen" href="assets/fonts/font-awesome/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="assets/extras/animate.css">
    <link rel="stylesheet" type="text/css" href="assets/extras/lightbox.css">
    <script src="assets/js/jquery-min.js"></script>
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body data-spy="scroll" data-offset="20" data-target="#navbar">
    <!-- Nav Menu Section -->
    <div class="logo-menu">
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation" data-spy="affix" data-offset-top="50">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header col-md-3">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#home"><i class="fa fa-building-o"></i> SmartCity</a>
                </div>

                <div class="collapse navbar-collapse" id="navbar">
                    <ul class="nav navbar-nav col-md-9 pull-right">
                        <li class="active"><a href="#hero-area"><i class="fa fa-home"></i> Home</a></li>
<!--                         <li><a href="#implementation"><i class="fa fa-cogs"></i> Implementation</a></li> -->
<!--                         <li><a href="#gallery"><i class="fa fa-picture-o"></i> Gallery</a></li> -->
<!--                         <li><a href="#team"><i class="fa fa-users"></i> Team</a></li> -->
                        <li><a href="#contact"><i class="fa fa-envelope"></i> Contact</a></li>
                        <li><a href="login.php"><i class="fa fa-key"></i> Login</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <!-- Nav Menu Section End -->

    <!-- Hero Area Section -->
    <section id="hero-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="title">Smart City Pilot Project</h1>
                    <h2 class="subtitle">Supported by Ministry of Power & IIT Kanpur</h2>
                    <img class="col-md-6 col-sm-6 col-xs-12 animated fadeInLeft" src="assets/img/hero/hero_02.png" alt="">

                    <div class="col-md-6 col-sm-6 col-xs-12 animated fadeInRight delay-0-5">
                        <p class="text-justify">
                            The Smart City definition varies from city to city and country to country, depending on the level of development, willingness to change and reform, resources and aspirations of the city residents.
                            <br/><br/>
                            Smart energy grids are the backbone of the future Smart Cities. The smart distribution system of the smart grid will be responsible for intelligent management and operation of energy networks in cities.
                        </p>
                        <!--<a href="#" class="btn btn-common btn-lg">Donload Now!</a>-->
                        <!--<a href="#" class="btn btn-primary btn-lg">Learn More</a>-->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Hero Area Section End-->

    <!-- Service Section -->

<!--
    <section id="implementation">
        <div class="container text-center">
            <div class="row">
                <h1 class="title">What we do</h1>
                <h2 class="subtitle">Lorem Ipsum is simply dummy text</h2>

                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="service-item">
                        <img src="assets/img/services/responsive.png" alt="">
                        <h3>Fully Responsive</h3>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="service-item">
                        <img src="assets/img/services/bs3.png" alt="">
                        <h3>Bootstrap 3</h3>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="service-item">
                        <img src="assets/img/services/free.png" alt="">
                        <h3>100% Free</h3>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text</p>
                    </div>
                </div>

            </div>
        </div>
    </section>
-->
    <!-- Service Section End -->

    <!-- Portfolio Section -->

<!--
    <section id="gallery">
        <div class="container">
            <div class="row">
                <h1 class="title">Gallery</h1>
                <h2 class="subtitle">Solar Panel and Scada Installation</h2>

                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="portfolio-item wow fadeInLeft" data-wow-delay=".5s">
                        <a href="#"><img src="assets/img/portfolio/img1.jpg" alt=""></a>
                        <div class="overlay">
                            <div class="icons">
                                <a data-lightbox="image1" href="assets/img/portfolio/img1.jpg" class="preview"><i class="fa fa-search-plus fa-4x"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="portfolio-item wow fadeInLeft" data-wow-delay=".7s">
                        <a href="#"><img src="assets/img/portfolio/img2.jpg" alt=""></a>
                        <div class="overlay">
                            <div class="icons">
                                <a data-lightbox="image1" href="assets/img/portfolio/img2.jpg" class="preview"><i class="fa fa-search-plus fa-4x"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="portfolio-item wow fadeInLeft" data-wow-delay=".9s">
                        <a href="#"><img src="assets/img/portfolio/img3.jpg" alt=""></a>
                        <div class="overlay">
                            <div class="icons">
                                <a data-lightbox="image1" href="assets/img/portfolio/img3.jpg" class="preview"><i class="fa fa-search-plus fa-4x"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 wow fadeInRight" data-wow-delay="1.1s">
                    <div class="portfolio-item">
                        <a href="#"><img src="assets/img/portfolio/img4.jpg" alt=""></a>
                        <div class="overlay">
                            <div class="icons">
                                <a data-lightbox="image1" href="assets/img/portfolio/img4.jpg" class="preview"><i class="fa fa-search-plus fa-4x"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 wow fadeInRight" data-wow-delay="1.3s">
                    <div class="portfolio-item">
                        <a href="#"><img src="assets/img/portfolio/img5.jpg" alt=""></a>
                        <div class="overlay">
                            <div class="icons">
                                <a data-lightbox="image1" href="assets/img/portfolio/img5.jpg" class="preview"><i class="fa fa-search-plus fa-4x"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 wow fadeInRight" data-wow-delay="1.5s">
                    <div class="portfolio-item">
                        <a href="#"><img src="assets/img/portfolio/img6.jpg" alt=""></a>
                        <div class="overlay">
                            <div class="icons">
                                <a data-lightbox="image1" href="assets/img/portfolio/img6.jpg" class="preview"><i class="fa fa-search-plus fa-4x"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
-->
    <!-- Portfolio Section End -->

    <!-- Client Section -->
<!--
    <section id="team">
        <div class="container">
            <div class="row">

                <h1 class="title">Team</h1>
                <h2 class="subtitle">Lorem Ipsum is simply dummy text</h2>
                <div class="wow fadeInDown">
                    <img class="col-md-3 col-md-3 col-sm-3 col-xs-12 img-circle img-responsive" src="http://iitk.ac.in/smartcity/img/team/saikat.jpg" alt="client-1">
                    <img class="col-md-3 col-md-3 col-sm-3 col-xs-12" src="assets/img/clients/img2.png" alt="client-2">
                    <img class="col-md-3 col-md-3 col-sm-3 col-xs-12" src="assets/img/clients/img3.png" alt="client-3">
                    <img class="col-md-3 col-md-3 col-sm-3 col-xs-12" src="assets/img/clients/img4.png" alt="client-4">
                </div>
            </div>
        </div>
    </section>
-->
    <!-- Client Section End -->

    <!-- About Section -->

<!--
    <section id="about">
        <div class="container">
            <div class="row">
                <h1 class="title">About us</h1>
                <h2 class="subtitle">Lorem Ipsum is simply dummy text</h2>
                <div class="col-md-8 col-sm-12">
                    <p>
                        A wonderful serenity has taken possession of my entire soul,
                        like these sweet mornings of spring which I enjoy with my whole
                        heart. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        Nulla quam velit, vulputate eu pharetra nec, mattis ac neque.
                        Duis vulputate commodo lectus, ac blandit elit. Lorem Ipsum is
                        simply dummy text of the printing and typesetting industry.
                        Lorem Ipsum has been the industry's standard dummy text. Lorem
                        Ipsum is simply dummy text of the printing and typesetting industry.
                        Lorem Ipsum has been the industry's standard dummy text. Lorem Ipsum
                        is simply dummy text of the printing and typesetting industry. Lorem
                        Ipsum has been the industry's standard dummy text.
                    </p>
                </div>
                <img class="col-md-4 col-md-4 col-sm-12 col-xs-12" src="assets/img/about/graph.png" alt="">
            </div>
        </div>
    </section>
-->
    <!-- About Section End -->

    <!-- Conatct Section -->
    <section id="contact">
        <div class="container text-center">
            <div class="row">
                <h1 class="title">Contact us</h1>
                <h2 class="subtitle">Get in touch with Smart City Team</h2>
<!--
                <form role="form" class="contact-form" method="post">
                    <div class="col-md-6 wow fadeInLeft" data-wow-delay=".5s">
                        <div class="form-group">
                            <div class="controls">
                                <input type="text" class="form-control" placeholder="Name" name="name">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="controls">
                                <input type="email" class="form-control email" placeholder="Email" name="email">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="controls">
                                <input type="text" class="form-control requiredField" placeholder="Subject" name="subject">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="controls">
                                <textarea rows="7" class="form-control" placeholder="Message" name="message"></textarea>
                            </div>
                        </div>
                        <button type="submit" id="submit" class="btn btn-lg btn-common">Send</button>
                        <div id="success" style="color:#34495e;"></div>
                    </div>
                </form>
-->

<!--                 <div class="col-md-6 wow fadeInRight"> -->
	                <div class="col-lg-12 wow fadeInRight">
                    <!--<div class="social-links">-->
                        <!--<a class="social" href="#" target="_blank"><i class="fa fa-facebook fa-2x"></i></a>-->
                        <!--<a class="social" href="#" target="_blank"><i class="fa fa-twitter fa-2x"></i></a>-->
                        <!--<a class="social" href="#" target="_blank"><i class="fa fa-google-plus fa-2x"></i></a>-->
                        <!--<a class="social" href="#" target="_blank"><i class="fa fa-linkedin fa-2x"></i></a>-->
                    <!--</div>-->
                    <div class="contact-info">
                        <h3>Principal Investigator</h3>
                        <h4>Dr. Saikat Chakrabarti</h4>
                        <address>
                        ADVANCED POWER SYSTEM LAB<br/>
                        Room # 105B , ACES Building<br/>
                        Department of Electrical Engineering<br/>
                        Indian Institute of Technology Kanpur<br/>
                        Kanpur - 208016
                        </address>
                        <p><i class="fa fa-map-marker"></i> (+91) 512-259-5420</p>
                        <p><i class="fa fa-envelope"></i> smartcityiitk[at]yahoo.co.in</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Conatct Section End-->

    <div id="copyright">
        <div class="container">
            <div class="col-md-10">
                <!--<p>© Corporal 2014 All right reserved. Design & Developed by <a href="http://graygrids.com">GrayGrids</a></p>-->
                <p>© Power System Lab, <a href="https://www.iitk.ac.in/ee/" target="_blank">Department of EE</a>, <a href="https://www.iitk.ac.in" target="_blank">IIT Kanpur</a></p>
            </div>
            <div class="col-md-2">
                <span class="to-top pull-right"><a href="#hero-area"><i class="fa fa-angle-up fa-2x"></i></a></span>
            </div>
        </div>
    </div>
    <!-- Copyright Section End-->

    <!-- Bootstrap JS -->
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- Smooth Scroll -->
    <!-- Smooth Scroll -->
    <script src="assets/js/smooth-scroll.js"></script>
    <script src="assets/js/lightbox.min.js"></script>

    <!-- All JS plugin Triggers -->
    <script src="assets/js/main.js"></script>

</body>

</html>
