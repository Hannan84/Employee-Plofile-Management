<?php

	session_start();
	if(empty($_SESSION['user'])){
		header('location:login.php');
	}
	include('connect.php');
	$object=new connect;
	$id= $_GET['edit'];
	$select = "SELECT * FROM info WHERE id='$id'";
	$select_result = $object->select($select);
	/*while($select_loop=$select_result->fetch_object()){
		echo $select_loop->user_name;
	}*/
	$select_loop=$select_result->fetch_object();
	
	
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
			$update = "UPDATE info SET user_name='$user_name',user_email='$user_email',user_password='$user_password',user_phone='$user_phone',user_address='$user_address',user_bio='$user_bio',user_job_main='$user_job_main',main_skill='$main_skill',user_job_sub='$user_job_sub',sub_skill='$sub_skill',pic='$pic',ssc='$ssc',hsc='$hsc',gra='$gra',post_gra='$post_gra' WHERE id='$id'";
		
			$object = new connect;
			$object->update($update);
			if($update){
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

?>

<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Edit Account - <?php echo $select_loop->user_name; ?></title>  
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
      
        <h1>Update</h1>
        
        <fieldset>
          <legend><span class="number">1</span>Your basic info</legend>
          <label for="name">Name:</label>
          <input type="text" id="name" name="user_name" value="<?php echo $select_loop->user_name; ?>">
          
          <label for="mail">Email:</label>
          <input type="email" id="mail" name="user_email" value="<?php echo $select_loop->user_email; ?>">
          
          <label for="password">Password:</label>
          <input type="password" id="password" name="user_password" value="<?php echo $select_loop->user_password; ?>">
          
          <label for="phone">Phone:</label>
          <input type="text" id="phone" name="user_phone" value="<?php echo $select_loop->user_phone; ?>">
          
          <label for="address">Address:</label>
          <input type="text" id="address" name="user_address" value="<?php echo $select_loop->user_address; ?>">
        </fieldset>
        
        <fieldset>
          <legend><span class="number">2</span>Your profile</legend>
          <label for="bio">Biography:</label>
          <textarea id="bio" name="user_bio"><?php echo $select_loop->user_bio; ?></textarea>
        </fieldset>
        <fieldset>
        <label for="main_job">Main Job Role:</label>
        <select id="main_job" name="user_job_main">
            <optgroup label="Select Sub Job">
				<?php
					$object = new connect;
					$select_option="SELECT * FROM job";
					$option_select=$object->option($select_option);
					while($loop_result = $option_select->fetch_object()){?>
					<option value="<?php echo $job = $loop_result-> id;?>"<?php 
					if($job==$select_loop->user_job_main){
						echo " selected";
					} ?>><?php echo $loop_result-> job_name;?></option>
				<?php } ?>
			</optgroup>
        </select>
        <label for="main_skill">Skill Level:</label>
          <input type="text" id="main_skill" name="main_skill" value="<?php echo $select_loop->main_skill; ?>">
        <label for="sub_job">Sub Job Role:</label>
        <select id="sub_job" name="user_job_sub">
			<optgroup label="Select Sub Job">
				<?php
					$object = new connect;
					$select_option="SELECT * FROM job";
					$option_select=$object->option($select_option);
					while($loop_result = $option_select->fetch_object()){?>
					<option value="<?php echo $job = $loop_result-> id;?>"<?php 
					if($job==$select_loop->user_job_sub){
						echo " selected";
					} ?>><?php echo $loop_result-> job_name;?></option>
				<?php } ?>
			</optgroup>
        </select>
        <label for="sub_skill">Skill Level:</label>
          <input type="text" id="sub_skill" name="sub_skill" value="<?php echo $select_loop->sub_skill; ?>">
         
          <br><br>
         <label for="main_skill">Upload Profile Picture :</label> 
         <input type="file" name="pic" />
        
        
        </fieldset>
        
        <fieldset>
          <legend><span class="number">1</span>Your educational info</legend>
          <label for="ssc">SSC:</label>
          <textarea id="ssc" name="ssc"><?php echo $select_loop->ssc; ?></textarea>
          <label for="hsc">HSC:</label>
          <textarea id="hsc" name="hsc"><?php echo $select_loop->hsc; ?></textarea>
          <label for="gra">GRADUATION:</label>
          <textarea id="gra" name="gra"><?php echo $select_loop->gra; ?></textarea>
          <label for="post_gra">POST-GRADUATION:</label>
          <textarea id="post_gra" name="post_gra"><?php echo $select_loop->post_gra; ?></textarea>
        </fieldset>
        <button type="submit" name="submit">Update</button>
          <div class="cancel">
              <a href="personal.php">Cancel</a>
          </div>
      </form>
      
    </body>
</html>



