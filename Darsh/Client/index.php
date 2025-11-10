<?php
/**
 * Global Logistic Portal - Main Entry Point
 * Modern Import-Export Solutions Platform
 */

// Get the request URI and path
$request_uri = $_SERVER['REQUEST_URI'];
$path = parse_url($request_uri, PHP_URL_PATH);
$root = '/Darsh/Client';

switch ($path) {
    case "$root/Authentication":
        require 'Pages/login.php';
        break;
    case "$root/Home":
        require 'Pages/home.php';
        break;
    case "$root/Logout":
        require 'Pages/logout.php';
        break;
    case "$root/Signup":
        require 'Pages/Signup.php';
        break;
    case "$root/Signup-User":
        require 'Services/Signup_services.php';
        break;
    case "$root/Dashboard":
        require 'Pages/Dashboard.php';
        break;
    case "$root/Service":
        require 'Pages/service.php';
        break;
    case "$root/Insert":
        require 'Services/Insert.php';
        break;
    case "$root/UpdateContact":
        require 'Services/UpdateContact.php';
        break;



    default:
        // Handle 404 Not Found errors for all other paths
        http_response_code(404);
        ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>404 - Page Not Found | Global Logistic Portal</title>
            <link rel="stylesheet" href="CSS/style.css">
            <style>
                .error-page {
                    min-height: 100vh;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    background: linear-gradient(135deg, #006d77 0%, #004d56 100%);
                    color: white;
                    text-align: center;
                    padding: 2rem;
                }

                .error-content h1 {
                    font-size: 8rem;
                    margin-bottom: 1rem;
                    font-weight: 800;
                }

                .error-content h2 {
                    font-size: 2rem;
                    margin-bottom: 1rem;
                    font-weight: 600;
                }

                .error-content a {
                    display: inline-block;
                    margin-top: 2rem;
                    padding: 1rem 2rem;
                    background: white;
                    color: #006d77;
                    text-decoration: none;
                    border-radius: 8px;
                    font-weight: 600;
                    transition: all 0.3s ease;
                }

                .error-content a:hover {
                    transform: translateY(-3px);
                    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
                }
            </style>
        </head>

        <body>
            <div class="error-page">
                <div class="error-content">
                    <h1>404</h1>
                    <h2>Page Not Found</h2>
                    <p>The page you're looking for doesn't exist.</p>
                    <a href="<?php echo $root.'/Home'; ?>">Return to Home</a>
                </div>
            </div>
        </body>

        </html>
        <?php
        break;
}
?>
