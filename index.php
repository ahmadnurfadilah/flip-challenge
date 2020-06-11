<?php
require 'core/config.php';
?>

<!DOCTYPE html>
<html lang="en">
	<head>
			<meta charset="UTF-8">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<title>Flip Challenge</title>
			<link rel="stylesheet" href="assets/css/bootstrap.css">
	</head>
	<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
			<div class="container">
				<a class="navbar-brand" href="/">
					<img src="https://flip.id/aset_gambar/logo.png" alt="Logo Flip" style="height:30px">
				</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav mr-auto">
						<li class="nav-item active">
							<a class="nav-link" href="/">Withdraw</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="/history.php">History</a>
						</li>
					</ul>
					<form class="form-inline my-2 my-lg-0">
						<?php
						if (isset($_SESSION['status']) && $_SESSION['status'] == 'login') { ?>
							<a href="/auth/logout.php" class="btn btn-warning my-2 my-sm-0" type="submit">Sign Out</a>
						<?php
						} else { ?>
							<a href="/" class="btn btn-warning my-2 my-sm-0" type="submit">Sign In</a>
						<?php
						}
						?>
					</form>
				</div>
			</div>
		</nav>

		<section class="mt-5">
			<div class="container">
				<div class="row">
					<div class="col-md-6 offset-md-3">
						<?php
						
						if (isset($_SESSION['status']) && $_SESSION['status'] == 'login') { ?>

							<div class="card shadow-sm">
								<div class="card-header">
									<h3>Withdraw</h3>
								</div>
								<div class="card-body">
									<form action="/withdraw.php" method="post">
										<div class="form-group">
											<label for="bank_code">Bank</label>
											<select name="bank_code" id="bank_code" class="form-control">
												<option value="BCA">BCA</option>
												<option value="BNI">BNI</option>
												<option value="BRI">BRI</option>
												<option value="Mandiri">Mandiri</option>
											</select>
										</div>
										<div class="form-group">
											<label for="account_number">Account Number</label>
											<input type="text" name="account_number" id="account_number" class="form-control" placeholder="....">
										</div>
										<div class="form-group">
											<label for="amount">Amount</label>
											<input type="number" name="amount" id="amount" class="form-control" placeholder="....">
										</div>
										<div class="form-group">
											<label for="remark">Remark</label>
											<input type="text" name="remark" id="remark" class="form-control" placeholder="....">
										</div>
										<button type="submit" class="btn btn-warning px-4">Request</button>
									</form>
								</div>
							</div>

						<?php
						} else { ?>
							<div class="card shadow-sm">
								<div class="card-header">
									<h3>Sign In</h3>
								</div>
								<div class="card-body">
									<?php
									if (isset($_SESSION['error'])) { ?>
										<div class="alert alert-danger">
											<?php echo $_SESSION['error'] ?>
										</div>
									<?php
										unset($_SESSION["error"]);
									}
									?>
									<form action="/auth/login.php" method="post">
										<div class="form-group">
											<label for="email">Email</label>
											<input type="text" name="email" id="email" class="form-control" value="user1@gmail.com" required>
										</div>
										<div class="form-group">
											<label for="password">Password</label>
											<input type="password" name="password" id="password" class="form-control" value="user1" required>
										</div>
										<button type="submit" class="btn btn-warning px-4">Sign In</button>
									</form>
								</div>
							</div>
					<?php
						}
						?>
					</div>
				</div>
			</div>
		</section>
	</body>
</html>