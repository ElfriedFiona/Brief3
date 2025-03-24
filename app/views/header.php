<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand text-center" href="index.php">Gestion Clients</a>
  <div class="collapse navbar-collapse">
    <ul class="navbar-nav ml-auto">
      <?php if(isset($_SESSION['user'])): ?>
        <li class="nav-item"><a class="nav-link" href="index.php?controller=auth&action=logout">Déconnexion</a></li>
      <?php endif; ?>
    </ul>
  </div>
</nav>
<div class="container mt-4">



</body>

</html>