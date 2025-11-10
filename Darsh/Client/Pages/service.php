<?php
require 'Utils/tosted.php';
$status = isset($_GET['status']) ? $_GET['status'] : '';
$message = isset($_GET['message']) ? $_GET['message'] : '';
$Shipment_type = isset($_GET['type']) ? $_GET['type'] : '';

session_start();
if (!isset($_SESSION['User_Logged-In'])) {
    header("Location: Authentication");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Requirement Form - Logistics</title>
    <!-- Link to the external CSS file -->
    <link rel="stylesheet" href="CSS/services.css?v=<?php echo time(); ?>">
    <!-- Google Fonts - Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>
    <?php if ($status === 'success') { ?>
        <div class="success-message"><?php echo $message; ?></div>
    <?php } ?>
    <?php if ($status === 'error') { ?>
        <div class="field-error"><?php echo $message; ?></div>
    <?php } ?>
    <div class="form-container">
        <header>
            <div class="logo-container">
                <img src="Public/Images/logo2.png" alt="Global Logistic Portal Logo" class="header-logo">
            </div>
            <h1>Product Requirement Form</h1>
            <p>Please fill out the details below to help us process your shipment.</p>
            <div class="header-actions">
                <a href="/Darsh/Client/Home" class="back-btn">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M19 12H5M12 19l-7-7 7-7"/>
                    </svg>
                    Back to Home
                </a>
            </div>
        </header>

        <form action="Insert?type=<?php echo $Shipment_type ?>" method="POST">
            <!-- Contact Information Section -->
            <fieldset>
                <legend>Contact Information</legend>
                <div class="form-grid">
                    <div class="form-group">
                        <label for="fullName">Full Name</label>
                        <input type="text" id="fullName" name="fullName"  required>
                    </div>
                    <div class="form-group">
                        <label for="companyName">Company Name</label>
                        <input type="text" id="companyName" name="companyName" >
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="tel" id="phone" name="phone"  required>
                    </div>
                </div>
            </fieldset>

            <!-- Shipment Details Section -->
            <fieldset>
                <legend>Shipment Details</legend>
                <div class="form-group radio-group">
                    <label>Shipment Type</label>
                    <div class="radio-options">
                        <label for="import"><input type="radio" id="import" name="shipmentType" value="import" checked>
                            Import</label>
                        <label for="export"><input type="radio" id="export" name="shipmentType" value="export">
                            Export</label>
                    </div>
                </div>
                <div class="form-group radio-group">
                    <label>Mode of Transport</label>
                    <div class="radio-options">
                        <?php if ($Shipment_type) { ?>
                        <label for="<?php echo $Shipment_type ?>"><input type="radio" id="<?php echo $Shipment_type ?>"
                                name="transportMode" value="<?php echo $Shipment_type ?>" checked>
                            <?php echo $Shipment_type ?></label>
                            <?php } else { ?>
                            <label for="air"><input type="radio" id="air" name="transportMode" value="Air Freight" checked>
                                Air Freight</label>
                        <label for="road"><input type="radio" id="road" name="transportMode" value="Road Transport">
                            Road Transport</label>
                        <label for="sea"><input type="radio" id="sea" name="transportMode" value="Sea Freight">
                                Sea Freight</label>
                        <?php }?>
                    </div>
                    </div>
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="originCountry">Origin Country</label>
                            <select name="originCountry" id="originCountry">
                                <option value="" selected>Select</option>
                                <option value="India">India</option>
                                <option value="China">China</option>
                                <option value="UK">Uk</option>
                                <option value="USA">Usa</option>
                                <option value="Japan">Japan</option>
                                <option value="Canada">Canada</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="originPort">Origin City / Port</label>
                            <select name="originPort" id="originPort">
                                <option value="" selected>Select</option>
                                <option value="Canada-Vancouver">Canada-Vancouver</option>
                                <option value="India-Hazira">India-Hazira</option>
                                <option value="Japan-Tokyo">Japan-Tokyo</option>
                                <option value="Uk-Felixstowe">Uk-Felixstowe</option>
                                <option value="Usa-Los Angeles">Usa-Los Angeles</option>
                                <option value="China-Shanghai">China-Shanghai</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="destCountry">Destination Country</label>
                            <select name="destCountry" id="destCountry">
                                <option value="" selected>Select</option>
                                <option value="India">India</option>
                                <option value="China">China</option>
                                <option value="UK">Uk</option>
                                <option value="USA">Usa</option>
                                <option value="Japan">Japan</option>
                                <option value="Canada">Canada</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="destPort">Destination City / Port</label>
                            <select name="destPort" id="destPort">
                                <option value="" selected>Select</option>
                                <option value="Canada-Vancouver">Canada-Vancouver</option>
                                <option value="India-Hazira">India-Hazira</option>
                                <option value="Japan-Tokyo">Japan-Tokyo</option>
                                <option value="Uk-Felixstowe">Uk-Felixstowe</option>
                                <option value="Usa-Los Angeles">Usa-Los Angeles</option>
                                <option value="China-Shanghai">China-Shanghai</option>
                            </select>
                        </div>
                    </div>
            </fieldset>

            <!-- Product Information Section -->
            <fieldset>
                <legend>Product Information</legend>
                <div class="form-group">
                    <label for="productDescription">Product Description</label>
                    <input type="text" id="productDescription" name="productDescription"
                        required>
                </div>
                <div class="form-grid">
                    <div class="form-group">
                        <label for="hsCode">HS Code (Optional)</label>
                        <input type="text" id="hsCode" name="hsCode" >
                    </div>
                    <div class="form-group">
                        <label for="weight">Total Weight (kg)</label>
                        <input type="number" id="weight" name="weight" required>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity / Units</label>
                        <input type="number" id="quantity" name="quantity"  required>
                    </div>
                    <div class="form-group">
                        <label for="dimensions">Dimensions (L x W x H cm)</label>
                        <input type="text" id="dimensions" name="dimensions" >
                    </div>
                </div>
            </fieldset>

            <!-- Additional Information Section -->
            <fieldset>
                <legend>Additional Information</legend>
                <div class="form-group">
                    <label for="instructions">Special Instructions or Comments</label>
                    <textarea id="instructions" name="instructions" rows="5"
></textarea>
                </div>
            </fieldset>
            <fieldset>
                <legend>Shipment Charge & Time</legend>
                <div class="form-group">
                    <label for="chargeCode">Shipment Charge</label>
                    <input type="text" id="chargeCode" name="chargeCode" value="25.50"
                        readonly>
                </div>
                <div class="form-group">
                    <label for="chargeCode">Shipment Time</label>
                    <input type="text" id="time" name="time"  readonly>
                </div>
            </fieldset>

            <!-- Submit Button -->
            <div class="form-group submit-group">
                <a href="/Darsh/Client/Dashboard" class="back-btn-secondary">Back to Dashboard</a>
                <button type="submit" class="submit-btn">Submit Requirement</button>
            </div>
        </form>
    </div>

</body>
<script>

    const date = new Date();
    date.setDate(date.getDate() + 3);
    const year = date.getFullYear();
    const month = (date.getMonth() + 1).toString().padStart(2, '0'); // Month is 0-indexed
    const day = date.getDate().toString().padStart(2, '0');

    const formattedDate = `${year}/${month}/${day}`;

    document.getElementById('time').value = formattedDate;


    const successMessage = document.querySelector('.success-message, .field-error');
    if (successMessage) {
        setTimeout(() => {
            successMessage.remove();
            removeUrlParameter('status');
        }, 3000);
    }
    function removeUrlParameter(parameter) {
        // Create a URL object from the current URL
        const url = new URL(window.location.href);

        // Use the searchParams API to delete the specified parameter
        url.searchParams.delete(parameter);

        // Update the URL in the browser without reloading the page
        window.history.replaceState({}, '', url.toString());
    }
</script>

</html>