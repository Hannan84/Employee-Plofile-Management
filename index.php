<?php

	include('connect.php');
	if(isset($_POST['submit'])){
		/*print_r($_POST);
		print_r($_FILES);
		*/
		$user_name = $_POST['user_name'];
		$user_email = $_POST['user_email'];
		$user_password = $_POST['user_password'];
		$user_phone = $_POST['user_phone'];
		$user_address = $_POST['user_address'];
		$user_bio = $_POST['user_bio'];
		$user_job_main = $_POST['user_job_main'];
		$main_skill = $_POST['main_skill'];
		$user_job_sub = $_POST['user_job_sub'];
		$sub_skill = $_POST['sub_skill'];
		$pic_name = $_FILES['pic']['name'];
		$ext = substr($pic_name,-4);
		$pic_ext = strtolower($ext);
		$pic = time().$pic_ext;
		$ssc = $_POST['ssc'];
		$hsc = $_POST['hsc'];
		$gra = $_POST['gra'];
		$post_gra = $_POST['post_gra'];
		$url = md5($user_email);
		
		$error = 0;
		$error_msg="";
		
		if($user_name==""){
			$error=$error+1;
			$error_msg.="<div class='block'><b>User Name:</b> Required.</div>";
		};
		if($user_email==""){
			$error=$error+1;
			$error_msg.="<div class='block'><b>Email:</b> Required.</div>";
		};
		if(filter_var($user_email,FILTER_VALIDATE_EMAIL)==false){
			$error=$error+1;
			$error_msg.="<div class='block'>Not Valid <b>Email</b>.</div>";
		};
		if($user_password==""){
			$error=$error+1;
			$error_msg.="<div class='block'><b>Password:</b> Required.</div>";
		};
		if(!preg_match('/[0-9]?[a-z]?[A-Z]/',$user_password)){
			$error=$error+1;
			$error_msg.="<div class='block'>Password Must Contained <b>[0-9],[a-z] and [A-Z]</b>.</div>";
		};
		if(strlen($user_password)<8){
			$error=$error+1;
			$error_msg.="<div class='block'>Password Must Have Minimum <b>8 Characters</b>.</div>";
		};
		if($user_phone=="" || $user_phone=="880"){
			$error=$error+1;
			$error_msg.="<div class='block'><b>Phone:</b> Required.</div>";
		};
		if($user_address==""){
			$error=$error+1;
			$error_msg.="<div class='block'><b>Address:</b> Required.</div>";
		};
		if($user_bio==""){
			$error=$error+1;
			$error_msg.="<div class='block'><b>Biography:</b> Required.</div>";
		};
		if($user_job_main==0){
			$error=$error+1;
			$error_msg.="<div class='block'><b>Main Job:</b> Required.</div>";
		};
		if($main_skill==""){
			$error=$error+1;
			$error_msg.="<div class='block'><b>Main Job Skill:</b> Required.</div>";
		};
		if($user_job_sub==0){
			$error=$error+1;
			$error_msg.="<div class='block'><b>Sub Job:</b> Required.</div>";
		};
		if($sub_skill==""){
			$error=$error+1;
			$error_msg.="<div class='block'><b>Sub Job Skill:</b> Required.</div>";
		};
		if($pic==""){
			$error=$error+1;
			$error_msg.="<div class='block'><b>Picture:</b> Required.</div>";
		};
		if($_FILES['pic']['type']!="image/jpeg" && $_FILES['pic']['type']!="image/png"){
			$error=$error+1;
			$error_msg.="<div class='block'>Only <b>JPG or PNG Format</b> Supported.</div>";
		}; 
		if($_FILES['pic']['size']>10737418240){
			$error=$error+1;
			$error_msg.="<div class='block'>Upload Limit Maximum 10MB..</div>";
		};  #File Size Error
		if($ssc==""){
			$error=$error+1;
			$error_msg.="<div class='block'><b>SSC:</b> Required.</div>";
		};
		if($hsc==""){
			$error=$error+1;
			$error_msg.="<div class='block'><b>HSC:</b> Required.</div>";
		};
		if($gra==""){
			$error=$error+1;
			$error_msg.="<div class='block'><b>Graduation:</b> Required.</div>";
		};
		if($post_gra==""){
			$error=$error+1;
			$error_msg.="<div class='block'><b>Post Graduation:</b> Required.</div>";
		};
		if($error==0){
			/*$insert = "INSERT INTO info VALUES('','$user_name','$user_email','$user_password','$user_phone','$user_address','$user_bio','$user_job_main','$main_skill','$user_job_sub','$sub_skill','$pic','$ssc','$hsc','$gra','$post_gra','$url')";*/
			$insert = "INSERT INTO info (`id`, `user_name`, `user_email`, `user_password`, `user_phone`, `user_address`, `user_bio`, `user_job_main`, `main_skill`, `user_job_sub`, `sub_skill`, `pic`, `ssc`, `hsc`, `gra`, `post_gra`) VALUES (NULL, '".$user_name."', '".$user_email."', '".$user_password."', '".$user_phone."', '".$user_address."', '".$user_bio."', '".$user_job_main."', '".$main_skill."', '".$user_job_sub."', '".$sub_skill."', '".$pic."', '".$ssc."', '".$hsc."', '".$gra."', '".$post_gra."');";
		
			$object = new connect;
			$object->insert($insert);
			if($insert){
				$upload = move_uploaded_file($_FILES['pic']['tmp_name'],"picture/".$pic);
				if($upload){
					session_start();
					$_SESSION['user'] = $user_email;
					header('location:personal.php');
				}
			}
		}
		else{
			echo "<div class='error'>$error_msg</div>";
		}
		
		
	}
	
	/*echo "<select>";
	$object = new connect;
	$select_option="SELECT * FROM job";
	$option_select=$object->option($select_option);
	while($loop_result = $option_select->fetch_object()){
		echo "<option value='id'>".$loop_result-> job_name."</option>";
	}
	echo "</select>";*/
	
	

?>


<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Register</title>  
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href='https://fonts.googleapis.com/css?family=Nunito:400,300' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel="stylesheet" href="css/style.css">
  <style>
	  .error{
		  background-color:#ff8080;
		  color:#fff;
		  width:600px;
		  margin:0 auto;
		  padding:10px;
		  border-radius:5px;
		  
	  }
  </style>
</head>

<body>
      <form method="post" enctype="multipart/form-data">
      
        <h1>Register</h1>
        
        <fieldset>
          <legend><span class="number">1</span>Your basic info</legend>
          <label for="name">Name:</label>
          <input type="text" id="name" name="user_name" >
          
          <label for="mail">Email:</label>
          <input type="text" id="mail" name="user_email" >
          
          <label for="password">Password:</label>
          <input type="password" id="password" name="user_password" >
          
          <label for="phone">Phone:</label>
          <input type="text" id="phone" name="user_phone" value="880" >
          
          <label for="address">Address:</label>
          <input type="text" id="address" name="user_address" >
        </fieldset>
        
        <fieldset>
          <legend><span class="number">2</span>Your profile</legend>
          <label for="bio">Biography:</label>
          <textarea id="bio" name="user_bio"></textarea>
        </fieldset>
        <fieldset>
        <label for="main_job">Main Job Role:</label>
        <select id="main_job" name="user_job_main">
			<optgroup label="Select Main Job">
				<?php
					$object = new connect;
					$select_option="SELECT * FROM job";
					$option_select=$object->option($select_option);
					while($loop_result = $option_select->fetch_object()){
						echo "<option>".$loop_result-> id .".".$loop_result-> job_name."</option>";
				}?>
			</optgroup>
        </select>
        <label for="main_skill">Skill Level:</label>
          <input type="text" id="main_skill" name="main_skill">
        <label for="sub_job">Sub Job Role:</label>
        <select id="sub_job" name="user_job_sub">
			<optgroup label="Select Sub Job">
				<?php
					$object = new connect;
					$select_option="SELECT * FROM job";
					$option_select=$object->option($select_option);
					while($loop_result = $option_select->fetch_object()){
						echo "<option>".$loop_result-> id .".".$loop_result-> job_name."</option>";
				}?>
			</optgroup>
        </select>
        <label for="sub_skill">Skill Level:</label>
          <input type="text" id="sub_skill" name="sub_skill">
         
          <br><br>
         <label for="main_skill">Upload Profile Picture :</label> 
         <input type="file" name="pic" />
        
        
        </fieldset>
        
        <fieldset>
          <legend><span class="number">3</span>Your educational info</legend>
          <label for="ssc">SSC:</label>
          <textarea id="ssc" name="ssc"></textarea>
          <label for="hsc">HSC:</label>
          <textarea id="hsc" name="hsc"></textarea>
          <label for="gra">GRADUATION:</label>
          <textarea id="gra" name="gra"></textarea>
          <label for="post_gra">POST-GRADUATION:</label>
          <textarea id="post_gra" name="post_gra"></textarea>
        </fieldset>
        <button type="submit" name="submit">Sign Up</button>
		<center><a style="text-decoration:none;color:#5fcf80;" href="login.php">Login Here</a></center>
      </form>     
</body>
</html>

