<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> | E-learning</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
	<div class="container my-5">
    <div class="row justify-content-center">
        <div class="card col-sm-5 mt-5 shadow mx-3 mb-2">
            <div class="card-body">
                <h3 class="card-title text-center my-4 mb-5">
                    Admin Login
                </h3>
                <div class="info-primary error"><?php if($error) echo $error?></div>
                <form action="<?= base_url() ?>alumni/login" id="alumniLoginForm" method="POST">
                    <div class="form-group">
                        <label for="username">Username ( Email )</label>
                        <input type="text" value="<?php if($username) echo $username?>" name="username" id="username" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                    <div class="text-right mt-5">
                        <a href="<?= base_url() ?>" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-success">Login</button>
                    </div>
                </form>
            </div>
          </div>
      </div>
    </div>
</body>
</html>