<?php
function InsertRecord($conn, $data)
{
    // Step 1: Get all values from data array
    $fullname = $data['fullname'];
    $companyName = $data['companyName'];
    $email = $data['Email'];
    $phone = $data['phone'];
    $shipmentType = $data['shipmentType'];
    $transportMode = $data['transportMode'];
    $originCountry = $data['originCountry'];
    $originPort = $data['originPort'];
    $destCountry = $data['destCountry'];
    $destPort = $data['destPort'];
    $productDescription = $data['productDescription'];
    $hsCode = $data['hsCode'];
    $weight = $data['weight'];
    $quantity = $data['quantity'];
    $dimensions = $data['dimensions'];
    $instructions = $data['instructions'];
    $chargeCode = $data['chargeCode'];
    $time = $data['time'];
    $userId = $data['userId'];

    // Step 2: Create SQL query
    // $sql = "INSERT INTO shipment_details values('',$fullname,$companyName,$email,$phone,$shipmentType,$transportMode,$originCountry,$originPort,$destCountry,$destPort,$productDescription,$hsCode,$weight,$quantity,$dimensions,$instructions,$chargeCode,$time,$userId);";
$sql = "INSERT INTO shipment_details (Full_Name, Company_Name, Email, Phone, Shipment_Type, Transport_Mode, Origin_Country, Origin_Port, Dest_Country, Dest_Port, Product_Description, HS_Code, Weight, Quantity, Dimensions, Instructions, Shipment_Charge, Shipment_Time, User_ID) VALUES ('$fullname', '$companyName', '$email', '$phone', '$shipmentType', '$transportMode', '$originCountry', '$originPort', '$destCountry', '$destPort', '$productDescription', '$hsCode', '$weight', '$quantity', '$dimensions', '$instructions', '$chargeCode', '$time', '$userId')";
    // Step 8: Return result
    if (mysqli_query($conn, $sql)) {
        return mysqli_insert_id($conn);
    } else {
        return false;
    }
}
