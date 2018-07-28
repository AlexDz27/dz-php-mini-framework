<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <base href="/">
  <link rel="stylesheet" href="public/css/main.css">
  <title><?= APP_TITLE; ?></title>
</head>
<body>

<div class="page-info-header">
  <div class="container">
    <div class="row">
      <div class="col-md-12 d-flex justify-content-end">
        <div class="logo">
          <a href="/">
            <span class="logo__span logo__span--1">Buy</span><span class="logo__span logo__span--2">From</span><span
                class="logo__span logo__span--3">Me</span>
          </a>
        </div>
        <div class="login-wrapper">
	        <?php if (empty($userData)): ?>
            <a href="/sign-in">Sign in</a>
            &nbsp;&nbsp;
            <a href="/sign-up">Sign up</a>
          <?php else: ?>
            <?php if (empty($userData['ava_path'])): ?>
              <img class="header-ava" src="public/img/no-ava.jpg" alt="">
            <?php else: ?>
              <img class="header-ava" src="<?= $userData['ava_path']; ?>" alt="">
            <?php endif; ?>
            <span>Welcome, <b><?= $userData['username']; ?></b></span>
            &nbsp;&nbsp;
            <a href="/profile">My profile</a>
            &nbsp;&nbsp;
            <a href="/logout">Sign out</a>
	        <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>
