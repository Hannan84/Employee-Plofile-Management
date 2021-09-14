<?php

	session_start();
	if(empty($_SESSION['user'])){
		header('location:login.php');
	}
	include('connect.php');
	$object=new connect;
    $id= $_GET['edit'];
    $select = "DELETE FROM info WHERE id='$id'";
	$select_result = $object->select($select);
	/*while($select_loop=$select_result->fetch_object()){
		echo $select_loop->user_name;
	}*/
    // $select_loop=$select_result->fetch_object();  

    if ($select_result === TRUE) {
        header('location:index.php');
    } else {
        echo "Error deleting record: " . $select_result->error;
    }

?>