<div>
	<div class="container">
		<div class="row">
			<div class="col-md-12 d-flex justify-content-center">

				<form class="form-signin" method="post">
					<h1 class="h3 mb-3 font-weight-normal">Please sign up</h1>
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
					<input type="email" id="inputEmail" name="email" value="<?= $email; ?>" class="form-control"
					       placeholder="Email address" >
						<?php if (!empty($errors['email'])): ?>
          <ul class="form-errors-list">
						<?php foreach ($errors['email'] as $error): ?>
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
					<button class="btn btn-lg btn-primary btn-block" name="sign-up" type="submit">Sign up</button>
				</form>

			</div>
		</div>
	</div>
</div>