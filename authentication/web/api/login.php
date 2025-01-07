

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
				<div class="dont mt-4">
					<p class="register-p">Enter your details and start your journey with us</p>
					<p class="mb-0 d-flex text-align-center justify-content-center align-items-center mx-auto gap-1 mt-2" >Don't have an account?</p>
					<button class="registerbtn" id="registerBtn">GET STARTED</button>
				</div>
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
						
					</form>
				</div>

				<?php if (isset($_SESSION['disable_status']) && $_SESSION['disable_status'] === true): ?>
				<script>
					document.addEventListener("DOMContentLoaded", function() {
						var modal = new bootstrap.Modal(document.getElementById('disableModal'));
						modal.show();
					});
				</script>
				<?php unset($_SESSION['disable_status']); ?>
			<?php endif; ?>

		




			</div>
		</div>

		<div class="modal fade" id="recoverModal" tabindex="-1" role="dialog" aria-labelledby="recoverModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<form action="../../function/php/process_recovery.php" method="POST">
						<div class="modal-header">
							<h5 class="modal-title" id="recoverModalLabel">Request Account Recovery</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<div class="mb-3">
								<label for="emailAddress" class="form-label">Email Address</label>
								<input type="email" class="form-control" id="emailAddress" name="email" value="<?php echo htmlspecialchars($_POST['email'] ?? '', ENT_QUOTES); ?>" required>
							</div>
							<div class="mb-3">
								<label for="recoveryReason" class="form-label">Explain why your account should be recovered:</label>
								<textarea class="form-control" id="recoveryReason" name="recovery_reason" rows="4" required></textarea>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
							<button type="submit" class="btn btn-primary">Submit Request</button>
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

					<!-- Common fields for both roles -->
					<div class="input-field">
						<input type="text" name="name" required>
						<label for="name">Enter your name</label>
					</div>

					<div class="input-field">
						<input type="text" name="address" id="address" required>
						<label for="address">Enter your address</label>
					</div>

					<div class="input-field">
						<input type="date" name="birthday" placeholder="hi" required>
						<label for="birthday">Enter your birthdate</label>
					</div>

					<div class="input-field">
						<input type="url" name="social_link" required>
						<label for="social_link">Enter your fb/ig link</label>
					</div>

					<!-- Customer-specific fields -->
					<div id="customerFields" class="roleFields" style="display:none;">
						<div class="input-field">
							<input type="text" name="username" required>
							<label for="username">Enter your username</label>
						</div>
					</div>

					<!-- Supplier-specific fields -->
					<div id="supplierFields" class="roleFields" style="display:none;">
						<div class="input-field">
							<input type="text" name="profession">
							<label for="profession">Enter your profession</label>
						</div>

						<div class="input-field">
							<input type="number" name="years_in_profession">
							<label for="years_in_profession">Years in Profession</label>
						</div>

						<div class="input-field">
							<input type="text" name="username">
							<label for="username">Enter your username</label>
						</div>
					</div>
					<div class="d-flex gap-2">
						<div class="input-field">
							<input type="password" name="password" id="password" required pattern=".{8,}" title="Password must be at least 8 characters long and contain at least one special character">
							<label for="password">Enter your password</label>
						</div>

						<div class="input-field">
							<input type="password" name="confirm-password" id="confirm-password" required>
							<label for="confirm-password">Confirm your password</label>
						</div>
					</div>
					<div class="alert-error" role="alert" id="password-error" style="display: none;">
						Passwords do not match!
					</div>

					<button type="submit" class="loginbtn">Sign Up</button>
				</form>
			</div>
			<div class="box2 box44 text-center">
				<h3>Welcome Back!</h3>
				<div class="lined"></div>
				<p>Already have an account?</p>
				<button class="loginbtn" id="loginBtn">LOG-IN</button>
			</div>
		</div>

		

	<script>
		document.getElementById('signupForm').addEventListener('submit', function(event) {
			var password = document.getElementById('password').value;
			var confirmPassword = document.getElementById('confirm-password').value;
			var errorDiv = document.getElementById('password-error');
			var specialCharPattern = /[!@#$%^&*(),.?":{}|<>]/;

			if (password !== confirmPassword) {
				errorDiv.textContent = "Passwords do not match!";
				errorDiv.style.display = 'block';
				event.preventDefault();
				return false;
			} else if (password.length < 8) {
				errorDiv.textContent = "Password must be at least 8 characters long!";
				errorDiv.style.display = 'block';
				event.preventDefault();
				return false;
			} else if (!specialCharPattern.test(password)) {
				errorDiv.textContent = "Password must contain at least one special character!";
				errorDiv.style.display = 'block';
				event.preventDefault();
				return false;
			} else {
				errorDiv.style.display = 'none';
			}
		});

		document.getElementById('customer').addEventListener('change', function() {
        document.getElementById('customerFields').style.display = 'block';
        document.getElementById('supplierFields').style.display = 'none';
		});

		document.getElementById('supplier').addEventListener('change', function() {
			document.getElementById('supplierFields').style.display = 'block';
			document.getElementById('customerFields').style.display = 'none';
		});
		document.querySelectorAll('input[name="role"]').forEach(role => {
        role.addEventListener('change', function () {
            const isCustomer = this.value === 'customer';

            document.querySelectorAll('.customer-only').forEach(field => {
                field.style.display = isCustomer ? 'block' : 'none';
                field.querySelector('input').disabled = !isCustomer;
            });

            document.querySelectorAll('.supplier-only').forEach(field => {
                field.style.display = !isCustomer ? 'block' : 'none';
                field.querySelector('input').disabled = isCustomer;
            });
        });
    });

		
	</script>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.8/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.min.js"></script>
	<script src="../../function/script/login.js"></script>
</body>
</html>
