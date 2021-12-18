<!DOCTYPE html>
<html lang="en">
<head>
  <title>Weather App</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="js/jquery.min.js"></script>
  <script src="js//popper.min.js"></script>
  <script src="/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <h4 style="text-align:center;">CLOUDWARE TASK TWO</h4>
    <h4 style="text-align:center;">WEATHER APP</h4>
  <img src="img/weather.jpg" class="mx-auto d-block img-thumbnail" style="width:30%"> 
  <center><fieldset>
    <legend>ENTER THE NAME OF THE CITY</legend>
  <form action="index.php" method="post">
<input type="text" name="city" placeholder="Enter the name of the city" required="required">
<input type="submit" name="submit" value="Submit">
</form>
  </fieldset></center><br><br>
  <?php
  if(isset($_POST['submit'])){
//curl for weather api
$apikey="97ee2bef00fe4108b5165351211812";
$weather_location=filter_input(INPUT_POST,'city',FILTER_SANITIZE_STRING);
$url="http://api.weatherapi.com/v1/current.json?key={$apikey}&q={$weather_location}&aqi=no";    
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => [
      "accept: application/json",
      "cache-control: no-cache"
    ],
  ));
  

$response = curl_exec($curl);
curl_close($curl);
$decode_response=json_decode($response);
//curl end
  ?>
  <h4 style="text-align:center;"><span style="text-transform: uppercase;"><?php echo $decode_response->location->name." ".$decode_response->location->region." ".$decode_response->location->country;?></span> CURRENT WEATHER UPDATE</h4>
<table border="1" style="border-collapse: collapse;width:70%" align="center">
  <tr>
    <td colspan="2"><img src="<?php echo $decode_response->current->condition->icon;?>">
    <b><?php echo round($decode_response->current->temp_c);?></b><sup>o</sup>C
    <br>
    <p><?php echo $decode_response->current->condition->text;?></p>
  </td>
  </tr>
  <tr>
    <td>WIND: <?php echo $decode_response->current->wind_dir." ".round($decode_response->current->wind_kph)."km/h";?></td><td>WIND GUSTS:<?php echo round($decode_response->current->gust_kph)."km/h";?></td>
  </tr>
  <tr>
    <td>HUMIDITY: <?php echo $decode_response->current->humidity."%";?></td><td>PRESSURE: <?php echo $decode_response->current->pressure_mb."mb";?></td>
  </tr>
  <tr>
    <td>PRECIPITATION: <?php echo $decode_response->current->precip_mm."%";?></td><td>CLOUD COVER: <?php echo $decode_response->current->cloud."%";?></td>
  </tr>
  <tr>
    <td colspan="2">UV: <?php echo $decode_response->current->uv;?></td>
  </tr>
</table>
<br><br>
<?php } ?>
</div>

</body>
</html>
