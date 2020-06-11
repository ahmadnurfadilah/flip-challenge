<?php

require 'core/config.php';
require 'model/transaction.php';

if (isset($_SESSION['status']) && $_SESSION['status'] == 'login') {
	$transaction = new Transaction($conn);
	$transaction->user_id = $_SESSION['id'];
	$transactions = $transaction->get();
}

?>

<!DOCTYPE html>
<html lang="en">
	<head>
			<meta charset="UTF-8">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<title>Flip Challenges</title>
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
						<li class="nav-item">
							<a class="nav-link" href="/">Withdraw</a>
						</li>
						<li class="nav-item active">
							<a class="nav-link" href="/history.php">History</a>
						</li>
					</ul>
					<form class="form-inline my-2 my-lg-0">
						<?php
						if (isset($_SESSION['status']) && $_SESSION['status'] == 'login') { ?>
							<a href="/logout.php" class="btn btn-warning my-2 my-sm-0" type="submit">Sign Out</a>
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
					<div class="col-md-12">
						<?php
						
						if (isset($_SESSION['status']) && $_SESSION['status'] == 'login') { ?>

							<div class="card shadow-sm">
								<div class="card-header">
									<h3>Withdraw History</h3>
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
									<div class="table-responsive">
										<table class="table table-striped table-bordered table-hover">
											<thead>
												<tr>
													<th class="text-center" scope="col">#</th>
													<th scope="col">Bank</th>
													<th scope="col">Amount</th>
													<th scope="col">Fee</th>
													<th scope="col">Remark</th>
													<th class="text-center" scope="col">Status</th>
													<th scope="col">Time Served</th>
													<th class="text-center" scope="col">Action</th>
												</tr>
											</thead>
											<tbody>
												<?php
													foreach ($transactions as $key => $trx) {
													?>
													<tr>
														<th class="text-center" scope="row"><?php echo $key+1 ?></th>
														<td>
															<?php echo $trx['bank_code'] ?><br>
															<small class="text-muted"><?php echo $trx['account_number'] ?> - <?php echo $trx['beneficiary_name'] ?></small>
														</td>
														<td>Rp<?php echo number_format($trx['amount']) ?></td>
														<td>Rp<?php echo number_format($trx['fee']) ?></td>
														<td><?php echo $trx['remark'] ?></td>
														<td class="text-center">
															<?php
															if ($trx['status'] == 'PENDING') { ?>
																<span class="badge badge-warning">PENDING</span>
															<?php
															} else {?>
																<span class="badge badge-success"><?php echo $trx['status'] ?></span>
															<?php
															}
															?>
														</td>
														<td>
															<?php
															if ($trx['time_served'] == NULL) { ?>
																-
															<?php
															} else {?>
																<?php echo $trx['time_served'] ?>
															<?php
															}
															?>
														</td>
														<td class="text-center">
															<?php
															if ($trx['receipt'] == '') { ?>
																<a href="/withdraw.php?status=check&id=<?php echo $trx['slightly_id'] ?>" class="btn btn-warning">Check</a>
															<?php
															} else {?>
																<a target="_blank" href="<?php echo $trx['receipt'] ?>" class="btn btn-success">Receipt</a>
															<?php
															}
															?>
														</td>
													</tr>
												<?php
												}
												?>
											</tbody>
										</table>
									</div>
								</div>
							</div>

						<?php
						} else { ?>
							<div class="card shadow-sm">
								<div class="card-header">
									<h3>Sign In</h3>
								</div>
								<div class="card-body">
									<form action="/login.php" method="post">
										<div class="form-group">
											<label for="email">Email</label>
											<input type="text" name="email" id="email" class="form-control" value="user1@gmail.com">
										</div>
										<div class="form-group">
											<label for="password">Password</label>
											<input type="password" name="password" id="password" class="form-control" value="user1">
										</div>
										<button type="submit" class="btn btn-warning px-4">Submit</button>
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