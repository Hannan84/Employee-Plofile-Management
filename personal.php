<?php

	session_start();
	if(empty($_SESSION['user'])){
		header('location:login.php');
	}
	include('connect.php');
	$object=new connect;
	$user_email= $_SESSION['user'];
	$select = "SELECT * FROM info WHERE user_email='$user_email'";
	$select_result = $object->select($select);
	/*while($select_loop=$select_result->fetch_object()){
		echo $select_loop->user_name;
	}*/
	$select_loop=$select_result->fetch_object();

?>


<!DOCTYPE html>
<html>
<title>W3.CSS Template</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Lato", sans-serif;}
body, html {
    height: 100%;
    color: #777;
    line-height: 1.8;
}

/* Create a Parallax Effect */
.bgimg-1, .bgimg-2, .bgimg-3 {
    background-attachment: fixed;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}
.w3-wide {letter-spacing: 10px;}
.w3-hover-opacity {cursor: pointer;}

/* Turn off parallax scrolling for tablets and phones */
@media only screen and (max-device-width: 1024px) {
    .bgimg-1, .bgimg-2, .bgimg-3 {
        background-attachment: scroll;
    }
}
</style>
<script>
	function confirm_box(){
		var data = confirm("Want To Confirm Delete");
		if(data){ 
			window.location.href = "delete.php?email=";
		}
	
	}

</script>
<body>

<!-- Navbar (sit on top) -->
<div class="w3-top">
  <div class="w3-bar" id="myNavbar">
    <a class="w3-bar-item w3-button w3-hover-black w3-hide-medium w3-hide-large w3-right" href="javascript:void(0);" onclick="toggleFunction()" title="Toggle Navigation Menu">
      <i class="fa fa-bars"></i>
    </a>
    <a href="#about" class="w3-bar-item w3-button w3-hide-small"><i class="fa fa-user"></i> ABOUT</a>
    <a href="#skill" class="w3-bar-item w3-button w3-hide-small"><i class="fa fa-th"></i> SKILL</a>
    <a href="#education" class="w3-bar-item w3-button w3-hide-small"><i class="fa fa-th"></i> EDUCATION</a>
    <a href="#contact" class="w3-bar-item w3-button w3-hide-small"><i class="fa fa-envelope"></i> CONTACT</a>
    <a href="logout.php" class="w3-bar-item w3-button w3-hide-small w3-right w3-hover-red"> | LOGOUT </a>
    <a href="edit.php?edit=<?php echo $select_loop->id; ?>" class="w3-bar-item w3-button w3-hide-small w3-right w3-hover-red"> | EDIT INFO </a>
    <a href="delete.php?edit=<?php echo $select_loop->id; ?>" class="w3-bar-item w3-button w3-hide-small w3-right w3-hover-red" onClick="confirm_box()"> DELETE ACCOUNT </a>
    
  </div>

  <!-- Navbar on small screens -->
  <div id="navDemo" class="w3-bar-block w3-white w3-hide w3-hide-large w3-hide-medium">
    <a href="#about" class="w3-bar-item w3-button" onclick="toggleFunction()">ABOUT</a>
    <a href="#portfolio" class="w3-bar-item w3-button" onclick="toggleFunction()">PORTFOLIO</a>
    <a href="#contact" class="w3-bar-item w3-button" onclick="toggleFunction()">CONTACT</a>
    <a href="#" class="w3-bar-item w3-button">SEARCH</a>
  </div>
</div>

<!-- Container (About Section) -->
<div class="w3-content w3-container w3-padding-64" id="about">
  <h3 class="w3-center">ABOUT ME</h3>
  <p class="w3-center"><em>My Biography !</em></p>
  <p><?php echo $select_loop->user_bio; ?>.</p>
  <div class="w3-row">
    <div class="w3-col m6 w3-center w3-padding-large">
      <p><b><i class="fa fa-user w3-margin-right"></i><?php echo $select_loop->user_name; ?></b></p><br>
      <img src="picture/<?php echo $select_loop->pic; ?>" class="w3-round w3-image w3-opacity-off w3-hover-opacity-off" alt="Photo of Me" width="500">
    </div>

    <!-- Hide this text on small devices -->
    <div class="w3-col m6 w3-hide-small w3-padding-large">
      <p><?php echo $select_loop->user_bio; ?></p>
    </div>
  </div>
  <a name="skill"></a>
  <p class="w3-large w3-center w3-padding-16"><h2>I'm really good at:</h2></p>
  <p class="w3-wide">
  <?php
  $job_role_id = $select_loop->user_job_main;
  $select_join = "SELECT job_name FROM job WHERE id='$job_role_id'";
  $select_join_data = $object->select($select_join);
  $select_join_show = $select_join_data->fetch_object();
  echo $select_join_show->job_name;
  ?></p>
  <div class="w3-light-grey">
    <div class="w3-container w3-padding-small w3-dark-grey w3-center" style="width:<?php echo $select_loop->main_skill; ?>%"><?php echo $select_loop->main_skill; ?>%</div>
  </div>
  <p class="w3-wide">
  <?php
  $job_role_id = $select_loop->user_job_sub;
  $select_join = "SELECT job_name FROM job WHERE id='$job_role_id'";
  $select_join_data = $object->select($select_join);
  $select_join_show = $select_join_data->fetch_object();
  echo $select_join_show->job_name;
  ?></p>
  <div class="w3-light-grey">
    <div class="w3-container w3-padding-small w3-dark-grey w3-center" style="width:<?php echo $select_loop->sub_skill; ?>%"><?php echo $select_loop->sub_skill; ?>%</div>
  </div>
</div>
<br><br><br>
<a name="education"></a>
<div class="w3-content w3-container w3-padding-64" id="about">
  <div class="w3-row">

    <!-- Hide this text on small devices -->
    <div class="w3-col m12 w3-hide-small w3-padding-large custom-design-table">
    	<table style="width:100%" border="1px">
        	<tr style="height:50px;border:5px">
            	<td> SSC Result : </td>
                <td> <?php echo $select_loop->ssc; ?> </td>
            </tr>
            <tr style="height:50px">
            	<td> HSC Result : </td>
                <td> <?php echo $select_loop->hsc; ?> </td>
            </tr>
            <tr style="height:50px">
            	<td> GRADUATION Result : </td>
                <td> <?php echo $select_loop->gra; ?> </td>
            </tr>
            <tr style="height:50px">
            	<td> POST-GRADUATION Result : </td>
                <td> <?php echo $select_loop->post_gra; ?> </td>
            </tr>
         </table>
    </div>
  </div>
  
  
</div>


<!-- Modal for full size images on click-->
<div id="modal01" class="w3-modal w3-black" onclick="this.style.display='none'">
  <span class="w3-button w3-large w3-black w3-display-topright" title="Close Modal Image"><i class="fa fa-remove"></i></span>
  <div class="w3-modal-content w3-animate-zoom w3-center w3-transparent w3-padding-64">
    <img id="img01" class="w3-image">
    <p id="caption" class="w3-opacity w3-large"></p>
  </div>
</div>

<br><br><br>
<!-- Container (Contact Section) -->
<div class="w3-content w3-container w3-padding-64" id="contact">
  

  <div class="w3-row w3-padding-32 w3-section">
    <div class="w3-col m4 w3-container">
         <h3 class="w3-center">WHERE I WORK</h3>
        <p class="w3-center"><em>I'd love your feedback!</em></p>
    </div>
    <div class="w3-col m8 w3-panel">
      <div class="w3-large w3-margin-bottom">
        <i class="fa fa-map-marker fa-fw w3-hover-text-black w3-xlarge w3-margin-right"></i> <?php echo $select_loop->user_address; ?><br>
        <i class="fa fa-phone fa-fw w3-hover-text-black w3-xlarge w3-margin-right"></i> Phone: <?php echo $select_loop->user_phone; ?><br>
        <i class="fa fa-envelope fa-fw w3-hover-text-black w3-xlarge w3-margin-right"></i> Email: <?php echo $select_loop->user_email; ?><br>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Footer -->
 
<!-- Add Google Maps -->
<script>
function myMap()
{
  myCenter=new google.maps.LatLng(41.878114, -87.629798);
  var mapOptions= {
    center:myCenter,
    zoom:12, scrollwheel: false, draggable: false,
    mapTypeId:google.maps.MapTypeId.ROADMAP
  };
  var map=new google.maps.Map(document.getElementById("googleMap"),mapOptions);

  var marker = new google.maps.Marker({
    position: myCenter,
  });
  marker.setMap(map);
}

// Modal Image Gallery
function onClick(element) {
  document.getElementById("img01").src = element.src;
  document.getElementById("modal01").style.display = "block";
  var captionText = document.getElementById("caption");
  captionText.innerHTML = element.alt;
}

// Change style of navbar on scroll
window.onscroll = function() {myFunction()};
function myFunction() {
    var navbar = document.getElementById("myNavbar");
    if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
        navbar.className = "w3-bar" + " w3-card-2" + " w3-animate-top" + " w3-white";
    } else {
        navbar.className = navbar.className.replace(" w3-card-2 w3-animate-top w3-white", "");
    }
}

// Used to toggle the menu on small screens when clicking on the menu button
function toggleFunction() {
    var x = document.getElementById("navDemo");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else {
        x.className = x.className.replace(" w3-show", "");
    }
}
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBu-916DdpKAjTmJNIgngS6HL_kDIKU0aU&callback=myMap"></script>
<!--
To use this code on your website, get a free API key from Google.
Read more at: https://www.w3schools.com/graphics/google_maps_basic.asp
-->

</body>
</html>



