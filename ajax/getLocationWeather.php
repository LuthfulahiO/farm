<?php
require_once "../includes/initialize.php";
$latitude   =  trim($_POST['lat']) ;
$longitude  =  trim($_POST['long']) ;
$address    =  trim($_POST['address']); //Gmap api address;
// TODO: Add loggedInUser Id here @develen
$loggedInUser  = 0;
//save address, latitude and longitude of current user to DB
mysqli_query($database,"UPDATE user SET latitude='{$latitude}',longitude='{$longitude}',last_known_location='{$address}' WHERE id='{$loggedInUser}' ");
$weatherApi =  new ClearApi();
$todayForecast = json_encode($weatherApi->getWeatherForecastForToday($latitude,$longitude));
echo $todayForecast;
