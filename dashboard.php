<!doctype html>
<html lang="en">
<?php
require_once "includes/initialize.php";
?>
<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<meta name="description" content="A Farm Care Application" />
		<meta name="keywords" content="Farmcare, Agricultural Inventory, Codefest, Farmz, Team Entwickler, Oseni Luthfulahi, Awwal Akanbi, Adeogun Oluwaseyi, Chuwkunonoso Okonji" />
		<meta name="author" content="Team Entwickler" />
		<!-- <link rel="shortcut icon" href="img/favicon.ico" /> -->
		<title>FarmZ - Dashboard</title>

		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">

		<!-- Common CSS -->
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<link rel="stylesheet" href="fonts/icomoon/icomoon.css" />
		<link rel="stylesheet" href="css/main.css" />

		<!-- Other CSS includes plugins - Cleanedup unnecessary CSS -->
		<!-- Chartist css -->
		<link href="vendor/chartist/css/chartist.min.css" rel="stylesheet" />
		<link href="vendor/chartist/css/chartist-custom.css" rel="stylesheet" />

	</head>
	<body>
    <script src="js/jquery.js"></script>
    <script type="text/javascript" charset="utf-8">
        function getLocation() {
            if(navigator.geolocation){
                navigator.geolocation.getCurrentPosition(function(position) {
                    geo_loc = processGeolocationResult(position);
                    currLatLong = geo_loc.split(",");
                    initializeCurrent(currLatLong[0], currLatLong[1]);
                });
            }else
                alert("Browser does not support Geo location");
        }

        //Get geo location result
        function processGeolocationResult(position) {
            html5Lat = position.coords.latitude; //Get latitude
            html5Lon = position.coords.longitude; //Get longitude
            html5TimeStamp = position.timestamp; //Get timestamp
            html5Accuracy = position.coords.accuracy; //Get accuracy in meters
            return (html5Lat).toFixed(8) + ", " + (html5Lon).toFixed(8);
        }

        //Check value is present or not & call google api function
        function initializeCurrent(latcurr, longcurr) {
            var geoLoc ={
                lat 	:	latcurr,
                long	:	longcurr
            };
            var apiKey = 'AIzaSyCtaAySLoRcPoiR-UF2DgkL0pNB3Cmhsrg';
            var url = 'https://maps.googleapis.com/maps/api/geocode/json?latlng='+latcurr+','+longcurr+'&key='+apiKey;
            $.ajax({
                url:	url,
                success : function (response) {
                    if(response.status==='OK' && (response['results'])){
                        var address = processUserLocation(response);
                        //Add address gotten from gmap api to data
                        geoLoc.address = address ;
                        getWeather(geoLoc,address);
                    }
                },
                error	: function (response) {}
            });
        }
        function getWeather(location,gMapApiAddress) {
            //Use Data to getCurrent Weather
            $.ajax({
                method	: 	"POST",
                url		:	'ajax/getLocationWeather.php',
                data	:	location,
                success : function (response) {
                    response = JSON.parse(response);
                    var year  			= response.date.length>4 ? response.date.substr(0,4) : currentDate.getFullYear();
                    var forecastData 	= response.forecast[0];
                    var conditionText	= forecastData.conditionsText;
                    var weatherData = {
                        condition	:	conditionText,
                        year		:	year,
                        temp		:	parseInt(forecastData.temperatures.value),
                        location	:	gMapApiAddress
                    };
                    updateWeatherUI(weatherData);
                },
                error	: function (response) {}
            });
        }

        function processUserLocation(response) {
            //Map Api returns nearby location choose on randomly and set as string location
            //Google Maps Api returns more than one address ,fetch one index at random
            var maxIndex    = response['results'].length;
            var randomIndex = Math.floor(Math.random() * maxIndex); // number between 0 and 8
            //Pick last two address ie Lagos,Nigeria or Oyo,Nigeria
            var result      = response['results'][randomIndex]['address_components'];
            return (result.length === 1) ? result[0].long_name : result[result.length - 2].long_name + ', ' + result[result.length - 1].long_name;
        }

        function updateWeatherUI(data) {
            var condition = data.condition;
            condition	  = condition.split(",");
            //Pick one of the conditions
            var randomIndex = Math.floor(Math.random() * condition.length); // number between 0 and length
            condition	  = condition[randomIndex];
            //Update text on screen to new values
            $("#weatherConditionYear").text(data.year);
            $("#weatherConditionsText").text(condition);
            $("#weatherConditionDegree").text(data.temp+'\u00b0');  // add degree symbol
            $("#weatherConditionLocal").text(data.location);
            //Show pop up on screen
        }
    </script>

		<!-- Loading starts -->
		<div class="loading-wrapper">
			<div class="loading">
				<span></span>
				<span></span>
				<span></span>
				<span></span>
				<span></span>
			</div>
		</div>
		<!-- Loading ends -->

		<!-- BEGIN .app-wrap -->
		<div class="app-wrap">
			<!-- BEGIN .app-heading -->
			<header class="app-header">
				<div class="container-fluid">
					<div class="row gutters">
						<div class="col-xl-7 col-lg-7 col-md-7 col-sm-7 col-8">
							<a class="mini-nav-btn" href="#" id="app-side-mini-toggler">
								<i class="icon-arrow_back"></i>
							</a>
							<a href="#app-side" data-toggle="onoffcanvas" class="onoffcanvas-toggler" aria-expanded="true">
								<i class="icon-chevron-thin-left"></i>
							</a>
							<div class="custom-search hidden-sm hidden-xs">
								<!-- <i class="icon-magnifying-glass"></i> -->
								<!-- <input type="text" class="search-query" placeholder="Search ..."> -->
								<h1>FarmZ</h1>
							</div>
						</div>
						<div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 col-4">
							<ul class="header-actions">
								<li>
									<a href="#" id="userSettings" class="user-settings" data-toggle="dropdown" aria-haspopup="true">
										<img class="avatar" src="img/avatar2.svg" alt="User Thumb" />
										<span class="user-name">Custom User</span>
										<i class="icon-chevron-small-down"></i>
									</a>
									<div class="dropdown-menu lg dropdown-menu-right" aria-labelledby="userSettings">
										<ul class="user-settings-list">
											<li>
												<a href="profile.html">
													<div class="icon">
														<i class="icon-account_circle"></i>
													</div>
													<p>Profile</p>
												</a>
											</li>
											<li>
												<a href="profile.html">
													<div class="icon red">
														<i class="icon-cog3"></i>
													</div>
													<p>Settings</p>
												</a>
											</li>
											<li>
												<a href="filters.html">
													<div class="icon yellow">
														<i class="icon-schedule"></i>
													</div>
													<p>Activity</p>
												</a>
											</li>
										</ul>
										<div class="logout-btn">
											<a href="login.html" class="btn btn-primary">Logout</a>
										</div>
									</div>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</header>
			<!-- END: .app-heading -->
			<!-- BEGIN .app-container -->
			<div class="app-container">
				<!-- BEGIN .app-side -->
				<aside class="app-side" id="app-side">
					<!-- BEGIN .side-content -->
					<div class="side-content ">
						<!-- BEGIN .user-profile -->
						<div class="user-profile">
							<a href="index.html" class="logo">
								<!-- <img src="img/unify.png" alt="Unify Admin Dashboard" /> -->
								<h3>FarmZ</h3>
							</a>
							<h6 class="location-name">San Francisco</h6>
							<!-- <button class="btn btn-primary">Get My Location</button> -->
						</div>
						<!-- END .user-profile -->
						<!-- BEGIN .side-nav -->
						<nav class="side-nav">
							<!-- BEGIN: side-nav-content -->
							<ul class="unifyMenu" id="unifyMenu">
								<li class="active selected">
									<a href="dashboard.php">
										<span class="has-icon">
											<i class="icon-laptop_windows"></i>
										</span>
										<span class="nav-title">DashBoard</span>
									</a>
								</li>
								<li>
									<a href="inventory.php">
										<span class="has-icon">
											<i class="icon-chart-area-outline"></i>
										</span>
										<span class="nav-title" title="Animals/Plants">Inventory</span>
									</a>
								</li>
								<li>
									<a href="todo.html">
										<span class="has-icon">
											<i class="icon-flash-outline"></i>
										</span>
										<span class="nav-title">Todo/Activities</span>
									</a>
								</li>
								<li>
									<a href="news.html">
										<span class="has-icon">
											<i class="icon-info-large-outline"></i>
										</span>
										<span class="nav-title">News Feed</span>
									</a>
								</li>
								<!-- <li>
									<a href="#" class="has-arrow" aria-expanded="false">
										<span class="has-icon">
											<i class="icon-adjust2"></i>
										</span>
										<span class="nav-title">Farm Services</span>
									</a>
									<ul aria-expanded="false">
										<li>
											<a href="dashboard2.html">Plants</a>
										</li>
										<li>
											<a href="dashboard2.html">Animals</a>
										</li>
									</ul>
								</li> -->
							</ul>
							<!-- END: side-nav-content -->
						</nav>
						<!-- END: .side-nav -->
					</div>
					<!-- END: .side-content -->
				</aside>
				<!-- END: .app-side -->

				<!-- BEGIN .app-main -->
				<div class="app-main">
					<!-- BEGIN .main-heading -->
					<header class="main-heading">
						<div class="container-fluid">
							<div class="row">
								<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
									<div class="page-icon">
										<i class="icon-laptop_windows"></i>
									</div>
									<div class="page-title">
										<h5>Dashboard</h5>
										<h6 class="sub-heading">Welcome!</h6>
									</div>
								</div>
							</div>
						</div>
					</header>
					<!-- END: .main-heading -->
					<!-- BEGIN .main-content -->
					<div class="main-content">
							<div class="gutters row">
								<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                                    <?php
                                        // TODO: Add loggedInUser Id here @develen
                                        $loggedInUser= 1;
                                        $userGeoData = mysqli_fetch_array(mysqli_query($database,"SELECT longitude,latitude,last_known_location FROM user WHERE id='{$loggedInUser}'"));
                                        if($userGeoData['longitude'] || $userGeoData['latitude'] || $userGeoData['last_known_location']){
                                            $hasLocationData=1;
                                        }else
                                            $hasLocationData=0;
                                    ?>
                                    <?php if($hasLocationData): ?>
									    <button onclick="getLocation()" class="btn btn-primary">Update My Location <i class="icon-target2"></i></button>
                                    <?php else: ?>
                                        <button onclick="getLocation()" class="btn btn-primary">Get My Location <i class="icon-target2"></i></button>
                                    <?php endif; ?>
								</div>
								<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
									<button class="btn btn-primary">Edit My Profile <i class="icon-gears"></i></button>
								</div>
							</div>
							<div class="gutters row">
								<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
									<!-- this is for map image from the location you get -->
									<div id="showMap">

									</div>
								</div>
								<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
									<!-- this for profile edit -->
								</div>
							</div>
							<div class="row gutters" style="margin-top: 30px">
								<!-- visual representation for climate condition -->
                                <?php
                                    if($hasLocationData):
                                        $userGeoDataLat     =   $userGeoData['latitude'];
                                        $userGeoDataLong    =   $userGeoData['longitude'];
                                        $userGeoDataAddress =   $userGeoData['last_known_location'];
                                    ?>
                                    <script>
                                        //Update ui with info already saved
                                        var userGeoLocation = {
                                            lat 	:	<?=$userGeoDataLat?>,
                                            long	:	<?=$userGeoDataLong?>,
                                            address :   '<?=$userGeoDataAddress?>'
                                        };
                                        getWeather(userGeoLocation,'<?php echo $userGeoDataAddress; ?>');
                                    </script>
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        <div class="weather-widget cloudy">
                                            <h3 id="weatherConditionsText">Showers</h3>
                                            <p id="weatherConditionYear">2018</p>
                                            <h2 id="weatherConditionDegree">12&deg;</h2>
                                            <p id="weatherConditionLocal">Ibadan, Nigeria</p>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        <div class="weather-widget cloudy">
                                            <h3 id="weatherConditionsText">Showers</h3>
                                            <p id="weatherConditionYear">2018</p>
                                            <h2 id="weatherConditionDegree">12&deg;</h2>
                                            <p id="weatherConditionLocal">Ibadan, Nigeria</p>
                                        </div>
                                    </div>
                                <?php endif; ?>


								<!-- only one should be displayed according to the area's climate -->


								<!-- <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
									<div class="weather-widget rainy">
										<h3>Rainy</h3>
										<p>Sunday 07:00 AM</p>
										<h2>7&deg;</h2>
										<p>Berlin, Germany</p>
									</div>
								</div>
								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
									<div class="weather-widget sunny">
										<h3>Sunny</h3>
										<p>Sunday 10:00 AM</p>
										<h2>25&deg;</h2>
										<p>Los Angeles, CA, USA</p>
									</div>
								</div> -->
						</div>
					</div>
					<!-- END: .main-content -->
				</div>
				<!-- END: .app-main -->
			</div>
			<!-- END: .app-container -->
			<!-- BEGIN .main-footer -->
			<footer class="main-footer fixed-btm">
				<p>Address: <div id="address"></div></p>
				Team Entwickler for Code Fest
			</footer>
			<!-- END: .main-footer -->
		</div>
		<!-- END: .app-wrap -->
		<!-- jQuery first, then Tether, then other JS. -->
		<script src="js/tether.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="vendor/unifyMenu/unifyMenu.js"></script>
		<script src="vendor/onoffcanvas/onoffcanvas.js"></script>
		<script src="js/moment.js"></script>

		<!-- Newsticker JS -->
		<script src="vendor/newsticker/newsTicker.min.js"></script>
		<script src="vendor/newsticker/custom-newsTicker.js"></script>

		<!-- Slimscroll JS -->
		<script src="vendor/slimscroll/slimscroll.min.js"></script>
		<script src="vendor/slimscroll/custom-scrollbar.js"></script>

		<!-- Slimscroll JS -->
		<script src="vendor/sparkline/sparkline-retina.js"></script>
		<script src="vendor/sparkline/custom-sparkline.js"></script>

		<!-- Common JS -->
		<script src="js/common.js"></script>

	</body>
</html>