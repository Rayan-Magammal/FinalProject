<?php
	error_reporting(0);
	if (!isset($_GET['userid'])) {
    $response = array('status' => 'failed', 'data' => null);
    sendJsonResponse($response);
    die();
	}
	$userid = $_GET['userid'];
	include_once("dbconnect.php");
	$sqlloadhomstay = "SELECT * FROM tbl_homstay WHERE user_id = '$userid'";
	$result = $conn->query($sqlloadhomstay);
	if ($result->num_rows > 0) {
		$homstayarray["homstay"] = array();
		while ($row = $result->fetch_assoc()) {
			$homstaylist = array();
			$homstaylist['homestay_id'] = $row['homestay_id'];
			$homstaylist['user_id'] = $row['user_id'];
			$homstaylist['homestay_name'] = $row['homestay_name'];
			$homstaylist['homestay_desc'] = $row['homestay_desc'];
			$homstaylist['homestay_price'] = $row['homestay_price'];
			$homstaylist['homestay_mealprice'] = $row['homestay_mealprice'];
			$homstaylist['no_room'] = $row['no_room'];
			$homstaylist['homestay_state'] = $row['homestay_state'];
			$homstaylist['homestay_local'] = $row['homestay_local'];
			$homstaylist['homestay_lat'] = $row['homestay_lat'];
			$homstaylist['homestay_long'] = $row['homestay_long'];
			$homstaylist['homestay_date'] = $row['homestay_date'];
			array_push($homstayarray["homstay"],$homstaylist);
		}
		$response = array('status' => 'success', 'data' => $homstayarray);
    sendJsonResponse($response);
		}else{
		$response = array('status' => 'failed', 'data' => null);
    sendJsonResponse($response);
	}
	
	function sendJsonResponse($sentArray)
	{
    header('Content-Type: application/json');
    echo json_encode($sentArray);
	}