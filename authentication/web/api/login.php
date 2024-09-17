

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Responsive Flip Animation</title>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
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
			?>
				<div class="User-Icon">
					<img src="../../../assets/img/R.png" alt="User-Icon">
				</div>

				<form action="../../function/php/login.php" method="POST">
					<label for="email">Email</label>
					<input type="text" name="email" class="form-control mb-2" required>
					
					<label for="password">Password</label>
					<input type="password" name="password" class="form-control mb-2" required>
					<a href="#">Forgot Password?</a>
					
					<button type="submit" class="loginbtn">Log In</button>
					
					
				</form>

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
				<label for="name">Name</label>
				<input type="text" name="name" class="form-control mb-2" required>
				
				<label for="email">Email</label>
				<input type="email" name="email" class="form-control mb-2" required>
				<label for="password">Password</label>
				<input type="password" name="password" id="password" class="form-control mb-2" required>

				<label for="confirm-password">Confirm Password</label>
				<input type="password" name="confirm-password" id="confirm-password" class="form-control mb-2" required>

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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<script src="../../function/script/login.js"></script>
</body>
</html>
