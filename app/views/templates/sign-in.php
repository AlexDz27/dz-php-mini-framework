<?php if (isset($_GET['userCreated']) && $_GET['userCreated'] === 'true'): ?>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12 text-center register-thanks">
				Thanks for signing up!
			</div>
		</div>
	</div>
<?php endif; ?>

<div>
	<div class="container">
		<div class="row">
			<div class="col-md-12 d-flex justify-content-center">

				<form class="form-signin" method="post">
					<h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
					<p>
						<input class="form-control" name="username" value="<?= $username; ?>" id="" placeholder="Username" required
						       autofocus>
						<?php if (!empty($errors['username'])): ?>
					<ul class="form-errors-list">
						<?php foreach ($errors['username'] as $error): ?>
							<li><?= $error; ?></li>
						<?php endforeach; ?>
					</ul>
					<?php endif; ?>
					</p>
					<p>
						<input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password"
						       required>
						<?php if (!empty($errors['password'])): ?>
					<ul class="form-errors-list">
						<?php foreach ($errors['password'] as $error): ?>
							<li><?= $error; ?></li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
					</p>
					<button class="btn btn-lg btn-primary btn-block" name="sign-in" type="submit">Sign in</button>
				</form>

			</div>
		</div>
	</div>
</div>