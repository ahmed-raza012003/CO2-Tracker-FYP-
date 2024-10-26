<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Custom CSS -->
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f0f2f5; /* Light background for contrast */
        }
        .login-container {
            display: flex;
            width: 90%;
            max-width: 800px;
            height: 70vh;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3); /* Enhanced shadow */
            transition: transform 0.3s; /* Smooth transform effect */
        }
        .login-container:hover {
            transform: translateY(-5px); /* Lift effect on hover */
        }
        .login-image-container {
            flex: 1;
            height: 100%;
            position: relative; /* For overlay positioning */
        }
        .login-image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover; /* Cover the entire area */
        }
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5); /* Darker overlay for better contrast */
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .signup-bar {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: rgba(255, 255, 255, 0.8); /* Light transparent background */
            text-align: center;
            padding: 10px 0;
        }
        .signup-bar a {
            color: #28a745; /* Green text */
            text-decoration: none;
            font-weight: bold;
        }
        .login-form-container {
            flex: 1;
            background-color: #ffffff;
            padding: 40px; /* Increased padding for comfort */
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: -5px 0 15px rgba(0, 0, 0, 0.1); /* Shadow for the form area */
        }
        .login-form {
            width: 100%;
            max-width: 400px; /* Set max width for the form */
            text-align: center; /* Center text */
        }
        .btn-custom-green {
            background-color: #28a745;
            border: none;
            color: white;
        }
        .btn-custom-green:hover {
            background-color: #218838;
        }
        .text-orange {
            color: #ff8c00;
            display: flex;
            flex-direction: column; /* Stack icon above text */
            align-items: center; /* Center align */
        }
        .icon-leaf {
            color: #28a745; /* Leaf color */
            font-size: 2rem; /* Adjust size of the icon */
            margin-bottom: 5px; /* Space between icon and text */
        }
    </style>
</head>
<body>

    <div class="login-container">
        <!-- Left side with image -->
        <div class="login-image-container">
            <img src="/images/register.jpg" alt="Register Image">
            <div class="signup-bar">
                <p>Already have an account? <a href="/login">Login now</a></p>
            </div>
        </div>

        <!-- Right side with registration form -->
        <div class="login-form-container">
            <div class="login-form">
                <h3 class="mb-4 text-orange">
                    <i class="fas fa-leaf icon-leaf"></i> 
                    Create Your Account
                </h3>

                <form method="POST" action="/register">
                    @csrf <!-- Laravel Blade directive for CSRF token -->

                    <!-- Name -->
                    <div class="form-group mb-3">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                            <input type="text" id="name" name="name" class="form-control" required autofocus placeholder="Full Name">
                        </div>
                    </div>

                    <!-- Email Address -->
                    <div class="form-group mb-3">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            <input type="email" id="email" name="email" class="form-control" required placeholder="Email Address">
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="form-group mb-3">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input type="password" id="password" name="password" class="form-control" required placeholder="Password">
                        </div>
                    </div>

                    <!-- Confirm Password -->
                    <div class="form-group mb-3">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required placeholder="Confirm Password">
                        </div>
                    </div>

                    <!-- Register Button -->
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-custom-green">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
