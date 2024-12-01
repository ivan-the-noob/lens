

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>LENSFOLIOHUB</title>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">

	<link rel="stylesheet" href="../../css/login.css">
</head>
<body>

	<div class="scene d-flex justify-content-center align-items-center">

		
		<div class="container box">
			<div class="box1 box11 text-center">
				<h3>LENSFOLIOHUB</h3>
				<div class="line"></div>
				<p class="register-p">Enter your details and start your journey with us</p>
				<button class="registerbtn" id="registerBtn">GET STARTED</button>
			</div>
			<div class="box2 box22">
			<?php
			session_start();
			require '../../../db/db.php'; 
				if (isset($_SESSION['signup_success'])) {
					echo '<div class="alert alert-success">' . $_SESSION['signup_success'] . '</div>';
					unset($_SESSION['signup_success']);
				}
				if (isset($_SESSION['login_error'])) {
					echo '<div class="alert alert-danger">' . $_SESSION['login_error'] . '</div>';
					unset($_SESSION['login_error']);
				}
			?>
				<div class="wrapper">
					<form action="../../function/php/login.php" method="POST">
						<h2>Login</h2>
						<div class="input-field">
							<input type="text" name="email" required>
							<label>Enter your email</label>
						</div>
						<div class="input-field">
							<input type="password" name="password" required>
							<label>Enter your password</label>
						</div>
						<a href="#" class="forgot">Forgot Password?</a>
						
						<button type="submit" class="mt-2">Log In</button>
						<div class="d-flex register">
							<p class="mb-0 d-flex text-align-center justify-content-center align-items-center mx-auto gap-1 mt-2" >Don't have an account?<a href="#" class="a-reg">Register</a></p>
						</div>
					</form>
				</div>



			</div>
		</div>

		<!-- Second container (Registration) -->
		<div class="container2 box">
			<div class="box1 box33">
				<h3 class="create-account">CREATE ACCOUNT</h3>
				<form action="../../function/php/signup.php" method="POST" id="signupForm">
				<div class="form-group">
					<label class="hidden-label">Are you a:</label>
					<div>					
						<div class="radio-group">
							<input type="radio" id="customer" name="role" value="customer" required>
							<label for="customer">Customer</label>
						</div>
					</div>
					<div>
						<div class="radio-group">
							<input type="radio" id="supplier" name="role" value="supplier" required>
							<label for="supplier">Supplier</label>
						</div>
					</div>
				</div>
				<div class="input-field">
					<input type="text" name="name" required>
					<label for="name">Enter your name</label>
				</div>

				<div class="input-field">
					<input type="email" name="email" required>
					<label for="email">Enter your email</label>
				</div>

				<div class="input-field">
					<input type="password" name="password" id="password" required>
					<label for="password">Enter your password</label>
				</div>

				<div class="input-field">
					<input type="password" name="confirm-password" id="confirm-password" required>
					<label for="confirm-password">Confirm your password</label>
				</div>


				<div class="alert-error" role="alert" id="password-error" style="display: none;">
						Passwords do not match!
					</div>
				<button type="submit" class="loginbtn">Sign Up</button>
			</div>
			</form>
			<div class="box2 box44 text-center">
				<h3>Welcome Back!</h3>
				<div class="lined"></div>
				<p>Already have an account?</p>
				<button class="loginbtn" id="loginBtn">LOG-IN</button>
			</div>
		</div>
	</div>

	<script>
   document.getElementById('signupForm').addEventListener('submit', function(event) {
        // Get the password and confirm password values
        var password = document.getElementById('password').value;
        var confirmPassword = document.getElementById('confirm-password').value;
        var errorDiv = document.getElementById('password-error');

        // Check if passwords match
        if (password !== confirmPassword) {
            // Show error message and prevent form submission
            errorDiv.style.display = 'block';
            event.preventDefault(); // Prevent form submission
            return false; // Explicitly prevent submission
        } else {
            // Hide error message and allow form submission
            errorDiv.style.display = 'none';
        }
    });
</script>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.8/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.min.js"></script>
	<script src="../../function/script/login.js"></script>
</body>
</html>
