<?php
if(!isset($_session)){
    session_start();
}
include_once 'backend/user_auth.php';
$con = mysqli_connect(HOST, USER, PASS, DB) or die('Connection to database failed' . mysqli_error($con));

$user = new User();
if ($user->session())
{
    header("location:dashboard.php");
}

$user = new User();

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $login = $user->login($_REQUEST['email'],$_REQUEST['password'],$con);
    if($login){

        header("location:dashboard.php");
    }
    else
    {
        echo "Login Failed!";
    }
}
?>

<!DOCTYPE html>

<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <title>FARMZ | Login</title>
   <meta name="keywords" content="FARMS agronomy" />
   <meta name="description" content="FARMZ">
   <meta name="author" content="Team Entwickler">
   <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
   <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
   <link rel="apple-touch-icon" href="img/apple-touch-icon.png">

   <!-- Web Fonts  -->
   <link href="https://fonts.googleapis.com/css?family=Hind:300,400,500,600|Poppins:500,600" rel="stylesheet">

   <!-- Vendor CSS -->
   <link rel="stylesheet" href="vendor/tether/tether.min.css" />
   <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
   <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css">
   <link rel="stylesheet" href="vendor/bootstrap/css/glyphicon.css" />
   <link rel="stylesheet" href="vendor/ion-icons/css/ionicons.min.css" />
   <link rel="stylesheet" href="vendor/owl-carousel/owl.theme.css" />
   <link rel="stylesheet" href="vendor/owl-carousel/owl.carousel.css" />
   <link rel="stylesheet" href="vendor/magnific-popup/magnific-popup.css" />
   <link rel="stylesheet" href="vendor/lite-tooltip/css/litetooltip.css" />

   <link href="vendor/dzsparallaxer/dzsparallaxer.css" rel="stylesheet" />
   <link href="vendor/dzsparallaxer/dzsscroller/scroller.css" rel="stylesheet" />
   <link href="vendor/dzsparallaxer/advancedscroller/plugin.css" rel="stylesheet" />

   <!-- Theme CSS -->
   <link href="css/main.css" rel="stylesheet" />
   <link href="css/smart-forms.css" rel="stylesheet" />
   <link href="css/main-shortcodes.css" rel="stylesheet" />
   <link href="css/header.css" rel="stylesheet" />
   <link href="css/form-element.css" rel="stylesheet" />
   <link href="css/animation.css" rel="stylesheet" />
   <link href="css/responsive.css" rel="stylesheet" />
   <link href="css/utilities.css" rel="stylesheet" />
   <link href="css/skins/default.css" rel="stylesheet" />

   <!-- Theme Custom CSS -->
   <link rel="stylesheet" href="css/custom.css">

   <!-- Style Swicher -->
   <link href="vendor/style-switcher/style-switcher.css" rel="stylesheet" />
   <link href="vendor/style-switcher/bootstrap-colorpicker/css/bootstrap-colorpicker.css" rel="stylesheet" />
</head>
<body>
   <div class="wrapper">

      <!--Header-->
      <header id="header" class="header-narrow header-full-width" data-plugin-options="{'stickyEnabled': true, 'stickyEnableOnBoxed': true, 'stickyEnableOnMobile': true, 'stickyStartAt': 0, 'stickySetTop': '0', 'stickyChangeLogo': false}">
         <div class="header-body">
            <div class="header-container container">
               <div class="header-row">
                  <div class="header-column">
                     <div class="header-row">
                        <div class="header-logo">
                           <a href="index.html" style="font-size: 25px;font-weight: 500;">
                               <img alt="Farm Anywhere" width="108" height="72" src="img/logo_1.png">
                              FARMZ
                           </a>
                        </div>
                     </div>
                  </div>
                  <div class="header-column justify-content-end">
                     <div class="header-row">
                        <div class="header-nav header-nav-top-line justify-content-end">
                           <div class="header-nav-main header-nav-main-effect-2 header-nav-main-sub-effect-1">
                              <nav class="collapse">
                                 <ul class="nav nav-pills" id="mainNav">
                                    <li class="dropdown">
                                       <a class="dropdown-item dropdown-toggle" href="index.html">Who we are </a>
                                    </li>
                                    <li class="dropdown">
                                       <a class="dropdown-item dropdown-toggle" href="index.html">Contact </a>
                                    </li>
                                    <li class="dropdown">
                                       <a class="dropdown-item dropdown-toggle" href="register.php"> Sign Up </a>
                                    </li>
                                 </ul>
                              </nav>
                           </div>
                           <button class="btn header-btn-collapse-nav" data-toggle="collapse" data-target=".header-nav-main nav">
                              <i class="fa fa-bars"></i>
                           </button>
                        </div>
                     </div>
                  </div>

               </div>
            </div>
         </div>
      </header>
      <!--End Header-->

      <div class="page">
         <div class="page-inner p-none">
            

            <section class="section-primary alternate-color b-bordered">
                    <div id="divId">

  
                            <title> Smart Forms - Login </title>
                          <meta charset="utf-8">
                          <meta name="viewport" content="width=device-width, initial-scale=1.0">
                          
                          <!--<link rel="stylesheet" type="text/css"  href="css/smart-forms.css">
                          <link rel="stylesheet" type="text/css"  href="css/font-awesome.min.css">-->
                          
                      
                          <!--[if lte IE 9]>
                              <script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>    
                              <script type="text/javascript" src="js/jquery.placeholder.min.js"></script>
                          <![endif]-->    
                          
                          <!--[if lte IE 8]>
                              <link type="text/css" rel="stylesheet" href="css/smart-forms-ie8.css">
                          <![endif]-->
                             
                      
                      
                      
                      
                          <div class="smart-wrap">
                              <div class="smart-forms smart-container wrap-3" style="margin: 0 auto !important;">
                              
                                  <div class="form-header header-primary">
                                      <h4><i class="fa fa-sign-in"></i>Login</h4>
                                </div><!-- end .form-header section -->
                                  
                                  <form method="post" action=" " id="contact">
                                      <div class="form-body">
                                      
                                          <div class="spacer-b30">
                                              <div class="tagline"><span>Sign in</span></div><!-- .tagline -->
                                          </div>                 
                                      
                                          <!--<div class="section">
                                          <a href="#" class="button btn-social facebook span-left"> <span><i class="fa fa-facebook"></i></span> Facebook </a>
                                          <a href="#" class="button btn-social twitter span-left">  <span><i class="fa fa-twitter"></i></span> Twitter </a>
                                          <a href="#" class="button btn-social googleplus span-left"> <span><i class="fa fa-google-plus"></i></span> Google+ </a>
                                          </div>
                                          <div class="spacer-t30 spacer-b30">
                                              <div class="tagline"><span> OR  Login </span></div>
                                          </div>
                                          <!-- end section -->


                                          <div class="section">
                                              <label class="field prepend-icon">
                                                  <input name="email" id="email" class="gui-input" placeholder="Enter email" type="email" required>
                                                  <span class="field-icon"><i class="fa fa-user"></i></span>  
                                              </label>
                                          </div><!-- end section -->                    
                                          
                                          <div class="section">
                                              <label class="field prepend-icon">
                                                  <input name="password" id="password" class="gui-input" placeholder="Enter password" type="password" required>
                                                  <span class="field-icon"><i class="fa fa-lock"></i></span>  
                                              </label>
                                          </div><!-- end section -->  
                                          
                                          <div class="section">
                                              <label class="switch block">
                                                  <input name="remember" id="remember" checked="" type="checkbox">
                                                  <span class="switch-label" for="remember" data-on="YES" data-off="NO"></span> 
                                                  <span> Keep me logged in ?</span>
                                              </label>
                                          </div><!-- end section -->                                                           
                                          
                                      </div><!-- end .form-body section -->
                                      <div class="form-footer">
                                          <span><input type="submit" name="submit" value="Sign In" class="button btn-primary" /></span>
                                          <div>
                                              <p>Join the community of users Register <a href="register.php"> here </a></p>
                                          </div></span>
                                      </div><!-- end .form-footer section -->
                                  </form>
                                  
                              </div><!-- end .smart-forms section -->
                          </div><!-- end .smart-wrap section -->
                          
                          <div></div><!-- end section -->
                      
                      
                      
                      </div>
            </section>

            


         </div>

         <footer class="footer footer-2">

            <div class="copyright">
               <div class="container">
                  <div class="row">
                     <div class="col-sm-6">

                        <ul class="list-inline fs-13 mb-none">
                           <li><p class="mb-0 fw-6">© 2015-2018 Farmz</p></li>
                           <li><a href="pages-about.html">About</a></li>
                           <li><a href="blog-grid.html">Blog</a></li>
                           <li><a href="pages-contact.html">Contact</a></li>
                           <li><a href="#">Terms</a></li>
                           <li><a href="#">Jobs</a></li>
                           <li><a href="#">Sitemap</a></li>
                           <li><a href="#">Public Policy</a></li>
                        </ul>
                     </div>
                     <div class="col-sm-6">
                        <div class="clearfix pull-right">
                           <ul class="list-inline mb-0">
                              <li><a href="#"><div class="flag flag-tr"></div></a> </li>
                              <li><a href="#"><div class="flag flag-england"></div></a> </li>
                              <li><a href="#"><div class="flag flag-us"></div></a> </li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </footer>
      </div>
   </div>

   <!-- Vendor -->
   <script src="vendor/jquery/jquery.js"></script>
   <script src="vendor/jquery/jquery.nav.js"></script>
   <script src="vendor/jquery/jquery.validate.js"></script>
   <script src="vendor/jquery.appear/jquery.appear.min.js"></script>
   <script src="vendor/jquery.easing/jquery.easing.min.js"></script>
   <script src="vendor/jquery-cookie/jquery-cookie.min.js"></script>
   <script src="vendor/magnific-popup/jquery.magnific-popup.js"></script>
   <script src="vendor/modernizr/modernizr.min.js"></script>
   <script src="vendor/tether/tether.min.js"></script>
   <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
   <script src="vendor/menuzord/menuzord.js"></script>
   <script src="vendor/sticky/jquery.sticky.min.js"></script>
   <script src="vendor/isotope/jquery.isotope.min.js"></script>
   <script src="vendor/respond/respond.js"></script>
   <script src="vendor/images-loaded/imagesloaded.js"></script>
   <script src="vendor/owl-carousel/owl.carousel.js"></script>
   <script src="vendor/wow/wow.min.js"></script>
   <script src="vendor/lite-tooltip/js/litetooltip.js"></script>
   <script src="js/theme-plugins.js"></script>

   <script src="vendor/dzsparallaxer/dzsparallaxer.js"></script>
   <script src="vendor/dzsparallaxer/dzsscroller/scroller.js"></script>
   <script src="vendor/dzsparallaxer/advancedscroller/plugin.js"></script>

   <!-- Theme Initialization -->
   <script src="js/theme.js"></script>

   <!-- Custom JS -->
   <script src="js/custom.js"></script>

   <!-- Style Swicher -->
   <script src="vendor/style-switcher/style.switcher.js" id="styleSwitcherScript" data-base-path="" data-skin-src=""></script>
   <script src="vendor/style-switcher/style.switcher.localstorage.js"></script>
</body>

</html>