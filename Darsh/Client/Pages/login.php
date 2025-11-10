<?php
require_once 'DB/connetction.php';
$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // ⚠️ Security Improvement: Use prepared statements to prevent SQL Injection
    $username = trim($_POST["username"]); // Trim input
    $password = $_POST["password"];

    // Use prepared statement to securely fetch the user's details and hashed password
    $sql = "SELECT ID, Username, Password FROM user_details WHERE email = ?";
    
    // Prepare statement
    $stmt = mysqli_prepare($conn, $sql);
    
    if ($stmt) {
        // Bind parameter (s for string)
        mysqli_stmt_bind_param($stmt, "s", $username);
        
        // Execute statement
        mysqli_stmt_execute($stmt);
        
        // Get the result set
        $result = mysqli_stmt_get_result($stmt);
        
        // Check if a user was found (i.e., if there is a row)
        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            
            // Verify the password
            if (password_verify($password, $row['Password'])) {
                // Success: Start session and redirect
                session_start();
                $_SESSION['User_Logged-In'] = true;
                $_SESSION['admin_username'] = $row['Username'];
                $_SESSION['admin_id'] = $row['ID'];
                $_SESSION['LAST_ACTIVITY'] = time();
                
                // Close statement before redirecting
                mysqli_stmt_close($stmt); 
                
                header("Location: /Darsh/Client/Home");
                exit();
            } else {
                // Failure: Password incorrect
                $error_message = "Invalid username or password. Please try again.";
            }
        } else {
            // Failure: Username/Email not found
            $error_message = "Invalid username or password. Please try again.";
        }
        
        // Close statement if it was opened
        mysqli_stmt_close($stmt); 
        
    } else {
        // Handle database error during preparation
        $error_message = "A database error occurred. Please try again later.";
        // Log error: mysqli_error($conn)
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Global Logistic Portal</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
            animation: slideUp 0.8s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .logo {
            width: 120px;
            height: 120px;
            margin-bottom: 30px;
            border-radius: 50%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .logo:hover {
            transform: scale(1.05);
        }

        .login-form h2 {
            color: #333;
            margin-bottom: 30px;
            font-size: 2rem;
            font-weight: 600;
        }

        .form-group {
            margin-bottom: 25px;
            text-align: left;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-weight: 500;
            font-size: 0.9rem;
        }

        .form-group input {
            width: 100%;
            padding: 15px 20px;
            border: 2px solid #e1e5e9;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }

        .form-group input:focus {
            outline: none;
            border-color: #667eea;
            background: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.15);
        }

        .login-btn {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        .login-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(102, 126, 234, 0.3);
        }

        .login-btn:active {
            transform: translateY(-1px);
        }

        .signup-link {
            margin-top: 25px;
            color: #666;
            font-size: 0.9rem;
        }

        .signup-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .signup-link a:hover {
            color: #764ba2;
        }

        .error-message {
            background: #fee;
            border: 2px solid #fcc;
            color: #c33;
            padding: 15px 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            font-size: 0.95rem;
            text-align: left;
            animation: shake 0.5s ease;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-10px); }
            75% { transform: translateX(10px); }
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 30px 20px;
            }

            .logo {
                width: 100px;
                height: 100px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <!-- <img src="Public/Images/logo1.png" alt="Global Logistic Portal Logo" class="logo"> -->
        <form class="login-form" action="" method="POST">
            <h2>Welcome Back</h2>

            <?php if (!empty($error_message)): ?>
                <div class="error-message">
                    <?php echo $error_message; ?>
                </div>
            <?php endif; ?>

            <div class="form-group">
                <label for="username">Username or Email</label>
                <input type="text" id="username" name="username" placeholder="Enter your username or email" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>

            <button type="submit" class="login-btn">Sign In</button>

            <p class="signup-link">Don't have an account? <a href="Signup">Create one here</a></p>
        </form>
    </div>
</body>
</html>

