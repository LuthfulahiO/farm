<?php
include_once 'backend/user_auth.php';
$con = mysqli_connect(HOST, USER, PASS, DB) or die('Connection to database failed' . mysqli_error($con));
$user = new User();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reg_date = date("Y-m-d H:i:s");
    $register = $user->register($_REQUEST['firstname'], $_REQUEST['lastname'], $_REQUEST['username'], $_REQUEST['password'], $_REQUEST['country'], $_REQUEST['gender'],$_REQUEST['email'], $_REQUEST['mobile'],$reg_date, $con);
    if ($register) {
        echo "Registration Successful!";
        header("location:login.php");
    } else {
        echo "<script type='text/javascript'> alert('Email already exist, please Login')</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <title>FARMZ</title>
   <meta name="keywords" content="farm care" />
   <meta name="description" content="FARMZ">
   <meta name="author" content="raspatech.com">
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
                                       <a class="dropdown-item dropdown-toggle" href="login.php"> Login </a>
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

      <div class="page alternate-color">
         <div class="page-inner p-none alternate-color">

                <div class="smart-wrap">
                        <div class="smart-forms smart-container wrap-3" style="margin:50px auto !important">
                        
                            <div class="form-header header-primary">
                                <h4><i class="fa fa-pencil-square"></i>Create Account</h4>
                            </div><!-- end .form-header section -->
                            
                            <form method="post" action="" id="account">
                                <div class="form-body">
                                
                                    <label for="names" class="field-label">Your names</label>
                                    <div class="frm-row">
                                    
                                        <div class="section colm colm6">
                                            <label class="field prepend-icon">
                                                <input name="firstname" id="firstname" class="gui-input" placeholder="First name..." type="text" required>
                                                <span class="field-icon"><i class="fa fa-user"></i></span>  
                                            </label>
                                        </div><!-- end section -->
                                        
                                        <div class="section colm colm6">
                                            <label class="field prepend-icon">
                                                <input name="lastname" id="lastname" class="gui-input" placeholder="Last name..." type="text" required>
                                                <span class="field-icon"><i class="fa fa-user"></i></span>  
                                            </label>
                                        </div><!-- end section --> 
                                                                                   
                                    </div><!-- end frm-row section -->
                
                                    <div class="section">
                                        <label for="username" class="field-label">Choose your username </label>
                                        <div class="smart-widget sm-right smr-120">
                                            <label class="field prepend-icon">
                                                <input name="username" id="username" class="gui-input" placeholder="john-doe" type="text" required>
                                                <span class="field-icon"><i class="fa fa-user"></i></span>  
                                            </label>
                                        </div><!-- end .smart-widget section --> 
                                    </div><!-- end section -->
                                    
                                    <div class="section">
                                        <label for="password" class="field-label">Create a password</label>
                                        <label class="field prepend-icon">
                                            <input name="password" id="password" class="gui-input" type="password" required>
                                            <span class="field-icon"><i class="fa fa-lock"></i></span>  
                                        </label>
                                    </div><!-- end section -->
                                    
                                    <div class="section">
                                        <label for="confirmPassword" class="field-label">Confirm your password</label>
                                        <label class="field prepend-icon">
                                            <input name="confirmPassword" id="confirmPassword" class="gui-input" type="password" required>
                                            <span class="field-icon"><i class="fa fa-unlock-alt"></i></span>  
                                        </label>
                                    </div><!-- end section -->
                                    
                                    <label for="birthday" class="field-label">Date Of Birth</label>
                                    <div class="frm-row">
                                        <div class="section colm colm4">
                                            <label for="month" class="field select">
                                                <select id="month" name="month">
                                                    <option value="01">01 - Jan</option>
                                                    <option value="02">02 - Feb</option>
                                                    <option value="03">03 - Mar</option>
                                                    <option value="04">04 - Apr</option>
                                                    <option value="05">05 - May</option>
                                                    <option value="06">06 - Jun</option>
                                                    <option value="07">07 - Jul</option>
                                                    <option value="08">08 - Aug</option>
                                                    <option value="09">09 - Sep</option>
                                                    <option value="10">10 - Oct</option>
                                                    <option value="11">11 - Nov</option>
                                                    <option value="12">12 - Dec</option>
                                                </select>
                                                <i class="arrow double"></i>                             
                                            </label>
                                        </div><!-- end section -->
                                        
                                        <div class="section colm colm4">
                                            <label for="day" class="field">
                                                <input name="day" id="day" class="gui-input" placeholder="Day..." type="text" >
                                            </label>
                                        </div><!-- end section -->                        
                                        
                                        <div class="section colm colm4">
                                            <label for="year" class="field">
                                                <input name="year" id="year" class="gui-input" placeholder="Year..." type="text" >
                                            </label>
                                        </div><!-- end section -->                     
                                    
                                    </div><!-- end .frm-row section -->
                                    
                                    <div class="section">
                                        <label for="location" class="field-label">Country </label>
                                        <label class="field select">
                                            <select id="location" name="location" required>
                                                <option value="">Select country</option>
                                                <option value="AL">Albania</option>
                                                <option value="DZ">Algeria</option>
                                                <option value="AD">Andorra</option>
                                                <option value="AO">Angola</option>
                                                <option value="AI">Anguilla</option>
                                                <option value="AG">Antigua and Barbuda</option>
                                                <option value="AR">Argentina</option>
                                                <option value="AM">Armenia</option>
                                                <option value="AW">Aruba</option>
                                                <option value="AU">Australia</option>
                                                <option value="AT">Austria</option>
                                                <option value="AZ">Azerbaijan Republic</option>
                                                <option value="BS">Bahamas</option>
                                                <option value="BH">Bahrain</option>
                                                <option value="BB">Barbados</option>
                                                <option value="BE">Belgium</option>
                                                <option value="BZ">Belize</option>
                                                <option value="BJ">Benin</option>
                                                <option value="BM">Bermuda</option>
                                                <option value="BT">Bhutan</option>
                                                <option value="BO">Bolivia</option>
                                                <option value="BA">Bosnia and Herzegovina</option>
                                                <option value="BW">Botswana</option>
                                                <option value="BR">Brazil</option>
                                                <option value="BN">Brunei</option>
                                                <option value="BG">Bulgaria</option>
                                                <option value="BF">Burkina Faso</option>
                                                <option value="BI">Burundi</option>
                                                <option value="KH">Cambodia</option>
                                                <option value="CA">Canada</option>
                                                <option value="CV">Cape Verde</option>
                                                <option value="KY">Cayman Islands</option>
                                                <option value="TD">Chad</option>
                                                <option value="CL">Chile</option>
                                                <option value="C2">China Worldwide</option>
                                                <option value="CO">Colombia</option>
                                                <option value="KM">Comoros</option>
                                                <option value="CK">Cook Islands</option>
                                                <option value="CR">Costa Rica</option>
                                                <option value="HR">Croatia</option>
                                                <option value="CY">Cyprus</option>
                                                <option value="CZ">Czech Republic</option>
                                                <option value="CD">Democratic Republic of the Congo</option>
                                                <option value="DK">Denmark</option>
                                                <option value="DJ">Djibouti</option>
                                                <option value="DM">Dominica</option>
                                                <option value="DO">Dominican Republic</option>
                                                <option value="EC">Ecuador</option>
                                                <option value="EG">Egypt</option>
                                                <option value="SV">El Salvador</option>
                                                <option value="ER">Eritrea</option>
                                                <option value="EE">Estonia</option>
                                                <option value="ET">Ethiopia</option>
                                                <option value="FK">Falkland Islands</option>
                                                <option value="FO">Faroe Islands</option>
                                                <option value="FJ">Fiji</option>
                                                <option value="FI">Finland</option>
                                                <option value="FR">France</option>
                                                <option value="GF">French Guiana</option>
                                                <option value="PF">French Polynesia</option>
                                                <option value="GA">Gabon Republic</option>
                                                <option value="GM">Gambia</option>
                                                <option value="GE">Georgia</option>
                                                <option value="DE">Germany</option>
                                                <option value="GI">Gibraltar</option>
                                                <option value="GR">Greece</option>
                                                <option value="GL">Greenland</option>
                                                <option value="GD">Grenada</option>
                                                <option value="GP">Guadeloupe</option>
                                                <option value="GT">Guatemala</option>
                                                <option value="GN">Guinea</option>
                                                <option value="GW">Guinea Bissau</option>
                                                <option value="GY">Guyana</option>
                                                <option value="HN">Honduras</option>
                                                <option value="HK">Hong Kong</option>
                                                <option value="HU">Hungary</option>
                                                <option value="IS">Iceland</option>
                                                <option value="IN">India</option>
                                                <option value="ID">Indonesia</option>
                                                <option value="IE">Ireland</option>
                                                <option value="IL">Israel</option>
                                                <option value="IT">Italy</option>
                                                <option value="JM">Jamaica</option>
                                                <option value="JP">Japan</option>
                                                <option value="JO">Jordan</option>
                                                <option value="KZ">Kazakhstan</option>
                                                <option value="KE">Kenya</option>
                                                <option value="KI">Kiribati</option>
                                                <option value="KW">Kuwait</option>
                                                <option value="KG">Kyrgyzstan</option>
                                                <option value="LA">Laos</option>
                                                <option value="LV">Latvia</option>
                                                <option value="LS">Lesotho</option>
                                                <option value="LI">Liechtenstein</option>
                                                <option value="LT">Lithuania</option>
                                                <option value="LU">Luxembourg</option>
                                                <option value="MG">Madagascar</option>
                                                <option value="MW">Malawi</option>
                                                <option value="MY">Malaysia</option>
                                                <option value="MV">Maldives</option>
                                                <option value="ML">Mali</option>
                                                <option value="MT">Malta</option>
                                                <option value="MH">Marshall Islands</option>
                                                <option value="MQ">Martinique</option>
                                                <option value="MR">Mauritania</option>
                                                <option value="MU">Mauritius</option>
                                                <option value="YT">Mayotte</option>
                                                <option value="MX">Mexico</option>
                                                <option value="FM">Micronesia</option>
                                                <option value="MN">Mongolia</option>
                                                <option value="MS">Montserrat</option>
                                                <option value="MA">Morocco</option>
                                                <option value="MZ">Mozambique</option>
                                                <option value="NA">Namibia</option>
                                                <option value="NR">Nauru</option>
                                                <option value="NP">Nepal</option>
                                                <option value="NL">Netherlands</option>
                                                <option value="AN">Netherlands Antilles</option>
                                                <option value="NC">New Caledonia</option>
                                                <option value="NZ">New Zealand</option>
                                                <option value="NI">Nicaragua</option>
                                                <option value="NE">Niger</option>
                                                <option value="NU">Niue</option>
                                                <option value="NF">Norfolk Island</option>
                                                <option value="NO">Norway</option>
                                                <option value="OM">Oman</option>
                                                <option value="PW">Palau</option>
                                                <option value="PA">Panama</option>
                                                <option value="PG">Papua New Guinea</option>
                                                <option value="PE">Peru</option>
                                                <option value="PH">Philippines</option>
                                                <option value="PN">Pitcairn Islands</option>
                                                <option value="PL">Poland</option>
                                                <option value="PT">Portugal</option>
                                                <option value="QA">Qatar</option>
                                                <option value="CG">Republic of the Congo</option>
                                                <option value="RE">Reunion</option>
                                                <option value="RO">Romania</option>
                                                <option value="RU">Russia</option>
                                                <option value="RW">Rwanda</option>
                                                <option value="KN">Saint Kitts and Nevis Anguilla</option>
                                                <option value="PM">Saint Pierre and Miquelon</option>
                                                <option value="VC">Saint Vincent and Grenadines</option>
                                                <option value="WS">Samoa</option>
                                                <option value="SM">San Marino</option>
                                                <option value="ST">São Tomé and Príncipe</option>
                                                <option value="SA">Saudi Arabia</option>
                                                <option value="SN">Senegal</option>
                                                <option value="RS">Serbia</option>
                                                <option value="SC">Seychelles</option>
                                                <option value="SL">Sierra Leone</option>
                                                <option value="SG">Singapore</option>
                                                <option value="SK">Slovakia</option>
                                                <option value="SI">Slovenia</option>
                                                <option value="SB">Solomon Islands</option>
                                                <option value="SO">Somalia</option>
                                                <option value="ZA">South Africa</option>
                                                <option value="KR">South Korea</option>
                                                <option value="ES">Spain</option>
                                                <option value="LK">Sri Lanka</option>
                                                <option value="SH">St. Helena</option>
                                                <option value="LC">St. Lucia</option>
                                                <option value="SR">Suriname</option>
                                                <option value="SJ">Svalbard and Jan Mayen Islands</option>
                                                <option value="SZ">Swaziland</option>
                                                <option value="SE">Sweden</option>
                                                <option value="CH">Switzerland</option>
                                                <option value="TW">Taiwan</option>
                                                <option value="TJ">Tajikistan</option>
                                                <option value="TZ">Tanzania</option>
                                                <option value="TH">Thailand</option>
                                                <option value="TG">Togo</option>
                                                <option value="TO">Tonga</option>
                                                <option value="TT">Trinidad and Tobago</option>
                                                <option value="TN">Tunisia</option>
                                                <option value="TR">Turkey</option>
                                                <option value="TM">Turkmenistan</option>
                                                <option value="TC">Turks and Caicos Islands</option>
                                                <option value="TV">Tuvalu</option>
                                                <option value="UG">Uganda</option>
                                                <option value="UA">Ukraine</option>
                                                <option value="AE">United Arab Emirates</option>
                                                <option value="GB">United Kingdom</option>
                                                <option value="US">United States</option>
                                                <option value="UY">Uruguay</option>
                                                <option value="VU">Vanuatu</option>
                                                <option value="VA">Vatican City State</option>
                                                <option value="VE">Venezuela</option>
                                                <option value="VN">Vietnam</option>
                                                <option value="VG">Virgin Islands (British)</option>
                                                <option value="WF">Wallis and Futuna Islands</option>
                                                <option value="YE">Yemen</option>
                                                <option value="ZM">Zambia</option>
                                            </select>
                                            <i class="arrow double"></i>                    
                                        </label>  
                                    </div><!-- end section -->                    
                                    
                                    <div class="section">
                                        <label for="gender" class="field-label">Gender </label>
                                        <label class="field select">
                                            <select id="gender" name="gender" required>
                                                <option value="">I am...</option>
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                                <option value="other">Other</option>
                                            </select>
                                            <i class="arrow double"></i>                    
                                        </label>  
                                    </div><!-- end section -->
                                    
                                    <div class="section">
                                        <label for="email" class="field-label">Your email address</label>
                                        <label class="field prepend-icon">
                                            <input name="email" id="email" class="gui-input" placeholder="example@domain.com..." type="email" required>
                                            <span class="field-icon"><i class="fa fa-envelope"></i></span>  
                                        </label>
                                    </div><!-- end section -->                    
                                    
                                    <div class="section">
                                        <label for="mobile" class="field-label">Mobile phone </label>
                                        <label class="field prepend-icon">
                                            <input name="mobile" id="mobile" class="gui-input" placeholder="+256" type="tel" required>
                                            <span class="field-icon"><i class="fa fa-phone-square"></i></span>  
                                        </label>
                                    </div><!-- end section -->
                                    
                                    <div class="section">
                                        <label for="verify" class="field-label">Prove you're not a robot </label>
                                        <div class="smart-widget sm-left sml-80">
                                            <label class="field prepend-icon">
                                                <input name="verify" id="verify" class="gui-input" placeholder="Enter captcha" type="text">
                                                <span class="field-icon"><i class="fa fa-shield"></i></span>  
                                            </label>
                                            <label for="verify" class="button">4 + 12</label>
                                        </div><!-- end .smart-widget section --> 
                                    </div><!-- end section -->                                                            
                                    
                                    <div class="section">
                                        <label class="option">
                                            <input name="check1" type="checkbox">
                                            <span class="checkbox"></span> 
                                            Agree to our <a href="#" class="smart-link"> terms of service </a>                   
                                        </label>
                                    </div><!-- end section -->                                                                                
                                    
                                </div><!-- end .form-body section -->
                                <div class="form-footer">
                                    <button type="submit" class="button btn-primary">Create Account</button>
                                </div><!-- end .form-footer section -->
                            </form>
                            
                        </div><!-- end .smart-forms section -->
                    </div>
            


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