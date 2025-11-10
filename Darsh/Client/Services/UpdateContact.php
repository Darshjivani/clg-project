<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['User_Logged-In'])) {
    header("Location: /Darsh/Client/Authentication");
    exit();
}

require 'DB/connetction.php';
require 'Sql/Update_Query.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $order_id = isset($_POST['order_id']) ? intval($_POST['order_id']) : 0;
    $fullName = isset($_POST['fullName']) ? trim($_POST['fullName']) : '';
    $companyName = isset($_POST['companyName']) ? trim($_POST['companyName']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
    
    // Validate required fields
    if (empty($order_id) || empty($fullName) || empty($email) || empty($phone)) {
        $message = "All required fields must be filled.";
        header('Location: /Darsh/Client/Dashboard?message=' . urlencode($message) . '&status=error');
        exit();
    }
    
    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Invalid email format.";
        header('Location: /Darsh/Client/Dashboard?message=' . urlencode($message) . '&status=error');
        exit();
    }
    
    // Prepare data array
    $data = [
        'fullname' => $fullName,
        'companyName' => $companyName,
        'email' => $email,
        'phone' => $phone,
        'userId' => $_SESSION['admin_id']
    ];
    
    // Update the record
    $result = UpdateContactDetails($conn, $order_id, $data);
    
    if ($result) {
        $message = "Contact details updated successfully!";
        header('Location: /Darsh/Client/Dashboard?message=' . urlencode($message) . '&status=success');
    } else {
        $message = "Failed to update contact details. Please try again.";
        header('Location: /Darsh/Client/Dashboard?message=' . urlencode($message) . '&status=error');
    }
    exit();
} else {
    // Invalid request method
    header('Location: /Darsh/Client/Dashboard?message=Invalid request method&status=error');
    exit();
}
?>

