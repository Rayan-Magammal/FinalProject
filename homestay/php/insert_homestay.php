<?php
	if (!isset($_POST)) {
    $response = array('status' => 'failed', 'data' => null);
    sendJsonResponse($response);
    die();
	}
	include_once("dbconnect.php");
	$userid = $_POST['userid'];
  $hsname= ucwords(addslashes($_POST['hsname']));
	$hsdesc= ucfirst(addslashes($_POST['hsdesc']));
	$hsprice= $_POST['hsprice'];
  $mealPrice= $_POST['mealPrice'];
  $noRoom= $_POST['noRoom'];
  $state= addslashes($_POST['state']);
  $local= addslashes($_POST['local']);
  $lat= $_POST['lat'];
  $lon= $_POST['lon'];
  $image= $_POST['image'];
  $imagetwo= $_POST['imagetwo'];
  $imagethree= $_POST['imagethree'];
	
	$sqlinsert = "INSERT INTO `tbl_homstay`( `user_id`, `homestay_name`, `homestay_desc`, `homestay_price`, `homestay_mealprice`, `no_room`, `homestay_state`, `homestay_local`, `homestay_lat`, `homestay_long`) VALUES ('$userid','$hsname','$hsdesc',$hsprice,$mealPrice,$noRoom,'$state','$local','$lat','$lon')";
	
  try {
		if ($conn->query($sqlinsert) === TRUE) {
			$decoded_string = base64_decode($image);
			$filename = mysqli_insert_id($conn);
			$path = '../assets/homestayimages/'.$filename.'.png';
			file_put_contents($path, $decoded_string);
			
			$decoded_string = base64_decode($imagetwo);
			$filename = mysqli_insert_id($conn);
			$path = '../assets/homestayimages/'.$filename.'.2'.'.png';
			file_put_contents($path, $decoded_string);
			
			$decoded_string = base64_decode($imagethree);
			$filename = mysqli_insert_id($conn);
			$path = '../assets/homestayimages/'.$filename.'.3'.'.png';
			file_put_contents($path, $decoded_string);
			
			$response = array('status' => 'success', 'data' => null);
			sendJsonResponse($response);
		}
		else{
			$response = array('status' => 'failed', 'data' => null);
			sendJsonResponse($response);
		}
	}
	catch(Exception $e) {
		$response = array('status' => 'failed', 'data' => null);
		sendJsonResponse($response);
	}
	$conn->close();
	
	function sendJsonResponse($sentArray)
	{
    header('Content-Type= application/json');
    echo json_encode($sentArray);
	}
?>