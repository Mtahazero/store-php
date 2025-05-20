<?php 
    session_start() ;
    include '../public/CSRF.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - ShopNow</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../public/css/singup.css">
    <link rel="stylesheet" href="../public/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
   
   <?php
        include '../public/nav.php';
   ?>
    <!-- Signup Form -->
    <div class="container">
        <form class="signup-form" id="signupForm" method ='post' action="../action/signup.php">
            <h2>Create Your Account</h2>
            <?php if(isset($_SESSION['error'])&&!empty($_SESSION['error'])){ ?>
                <div class="alert alert-danger" role="alert">
                   <?=$_SESSION['error']?>
                </div>
            <?php } unset($_SESSION['error']);
                if(isset($_SESSION['success'])&&!empty($_SESSION['success'])){ ?>
                <div class="alert alert-success" role="alert">
                <?=$_SESSION['success']?>
                </div>
            <?php } unset($_SESSION['success']);?>

            <input type="hidden" name="csrf_token" value="<?php echo generateCsrfToken(); ?>">
            
            <div class="form-group">
                <label for="fullname">Full Name</label>
                <input type="text" id="fullname" name="fullname" required
                value ="<?php echo isset($_SESSION['fullname'])? $_SESSION['fullname']:'' ?>">
                <i class="fas fa-user input-icon"></i>
            </div>
            
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" required
                value ="<?php echo isset($_SESSION['email'])? $_SESSION['email']:'' ?>">
                <i class="fas fa-envelope input-icon"></i>
            </div>
            <?php  
                unset($_SESSION['fullname']);
                unset($_SESSION['email']); 
            ?>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required minlength="6">
                <i class="fas fa-lock input-icon"></i>
                <i class="fas fa-eye password-toggle" id="togglePassword"></i>
            </div>
            
            <div class="form-group">
                <label for="confirmPassword">Confirm Password</label>
                <input type="password" id="confirmPassword" name="confirmPassword" required minlength="6">
                <i class="fas fa-lock input-icon"></i>
            </div>
            
            <div class="terms">
                <input type="checkbox" id="agreeTerms" name="agree">
                <label for="agreeTerms">I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a></label>
            </div>
            
            <button type="submit" name = 'submit' class="btn">Sign Up</button>
            
            <div class="login-link">
                Already have an account? <a href="login.php">Log in</a>
            </div>
            
            <div class="divider">or sign up with</div>
            
            <div class="social-login">
                <button type="button" class="social-btn facebook-btn">
                    <i class="fab fa-facebook-f"></i>
                </button>
                <button type="button" class="social-btn google-btn">
                    <i class="fab fa-google"></i>
                </button>
                <button type="button" class="social-btn twitter-btn">
                    <i class="fab fa-twitter"></i>
                </button>
            </div>
        </form>
    </div>


    
    <?php include "../public/footer.php";?>
</body>
</html>