<?php 
include 'header.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="http://localhost/TEST/app/public/assets/css/login.css">
</head>
<body>
<?php require_once 'header.php'; ?>
<?php if(isset($error)): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>
  <div class="login-wrap">
	<div class="login-html">
		<input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Connexion</label>
		<input id="tab-2" type="radio" name="tab" class="for-pwd"><label for="tab-2" class="tab"></label>
        
        <div class="login-form">
			<div class="sign-in-htm">
            <form method="POST" action="index.php?controller=auth&action=login">
				<div class="group">
					<label for="user" class="label">Email</label>
					<input id="user" type="email" name="email" class="input">
				</div>
				<div class="group">
					<label for="pass" class="label">Password</label>
					<input id="pass" type="password" name="password" class="input" data-type="password">
				</div>
				<div class="group">
                    <button type="submit" class="button">Se connecter</button>
				</div>
				<div class="hr"></div>
                </form>
			</div>
		</div>
	</div>
</div>
<?php require_once 'footer.php'; ?>
</body>
</html>