<?php
/**
 * Update Contact Details for a Shipment Order
 * Only allows updating contact information (Full_Name, Company_Name, Email, Phone)
 */
function UpdateContactDetails($conn, $order_id, $data)
{
    // Validate order_id
    if (empty($order_id) || !is_numeric($order_id)) {
        return false;
    }

    // Get values from data array
    $fullname = mysqli_real_escape_string($conn, $data['fullname']);
    $companyName = mysqli_real_escape_string($conn, $data['companyName']);
    $email = mysqli_real_escape_string($conn, $data['email']);
    $phone = mysqli_real_escape_string($conn, $data['phone']);
    $userId = $data['userId'];

    // Create SQL query using prepared statement for security
    $sql = "UPDATE shipment_details 
            SET Full_Name = ?, 
                Company_Name = ?, 
                Email = ?, 
                Phone = ? 
            WHERE ID = ? AND User_ID = ?";
    
    $stmt = mysqli_prepare($conn, $sql);
    
    if (!$stmt) {
        return false;
    }
    
    // Bind parameters
    mysqli_stmt_bind_param($stmt, "ssssii", $fullname, $companyName, $email, $phone, $order_id, $userId);
    
    // Execute query
    $result = mysqli_stmt_execute($stmt);
    
    // Close statement
    mysqli_stmt_close($stmt);
    
    return $result;
}
?>

