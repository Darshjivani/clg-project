<?php
session_start();
require 'DB/connetction.php';
require 'Sql/Insert_Query.php';


$result = null;
$Data = null;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$Data = [
		'fullname' => $_POST['fullName'],
		'companyName' => $_POST['companyName'],
		'Email' => $_POST['email'],
		'phone' => $_POST['phone'],
		'shipmentType' => $_POST['shipmentType'],
		'transportMode' => $_POST['transportMode'],
		'originCountry' => $_POST['originCountry'],
		'originPort' => $_POST['originPort'],
		'destCountry' => $_POST['destCountry'],
		'destPort' => $_POST['destPort'],
		'productDescription' => $_POST['productDescription'],
		'hsCode' => $_POST['hsCode'],
		'weight' => $_POST['weight'],
		'quantity' => $_POST['quantity'],
		'dimensions' => $_POST['dimensions'],
		'instructions' => $_POST['instructions'],
		'chargeCode' => $_POST['chargeCode'],
		'time' => $_POST['time'],
		'userId' => $_SESSION['admin_id']
	];
	$result = InsertRecord($conn, $Data);
	if ($result) {
		$message = "Shipment request submitted successfully! We will contact you soon.";
		header('Location: Service?message=' . urlencode($message) . '&status=success');
	} else {
		$message = "Failed to submit shipment request. Please try again or contact support.";
		header('Location: Service?message=' . urlencode($message) . '&status=error');
	}
	exit();
} else {
	// Invalid request method
	header('Location: Service?message=Invalid request method&status=error');
	exit();
}
// mysqli_close($conn);
?>