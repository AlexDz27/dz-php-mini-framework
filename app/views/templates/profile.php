<div class="container mt-5">
  <div class="row">
    <div class="col-md-6">
      <h3>Avatar</h3>
      <?php if ($userData['ava_path'] === null): ?>
        <img src="public/img/no-ava.jpg" alt="">
      <?php else: ?>
        <img class="user-ava--profile" src="<?= $userData['ava_path']; ?>" alt="">
      <?php endif; ?>
      <form class="mt-3" method="post" enctype="multipart/form-data">
        <p>
        <input type="file" name="ava" id="">
        </p>
        <p>
        <button name="ava" type="submit">Submit avatar</button>
        </p>
      </form>
      <?php if ($errors): ?>
        <ul class="form-errors-list">
          <?php foreach ($errors as $error): ?>
            <li><?= $error; ?></li>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>
    </div>
    <div class="col-md-6">
      <p>Username: <?= $userData['username']; ?></p>
      <p>Email: <?= $userData['email']; ?></p>
    </div>
  </div>
</div>

