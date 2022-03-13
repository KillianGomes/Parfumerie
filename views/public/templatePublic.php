<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Parfumerie</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <link rel="stylesheet" href="./assets/css/templatePublic.css">

</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-warning">
        <div class="container-fluid">
          <a class="navbar-brand text-dark" href="index.php">BuyParfum</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse " id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item" style="margin-left: 30px;">
                <a class="nav-link active text-dark" aria-current="page" href="index.php">Accueil</a>
              </li>
              <li class="nav-item" style="margin-left: 30px;">
                <a class="nav-link text-dark" href="index.php?action=apropos">A propos</a>
              </li>
              <li class="nav-item" style="margin-left: 30px;">
                <a class="nav-link text-dark" href="index.php?action=contact">Contact</a>
              </li>
            
            </ul>
            
          </div>
        </div>
      </nav>
</header>
<main>
    <?=$contenu;?>
</main>
<footer>
    <nav class="navbar navbar-expand-lg navbar-dark bg-warning ">
        <div class="container-fluid">
          <a class="navbar-brand text-dark" href="#">BuyParfum</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2  mb-lg-0" style="margin-left: 30px;">
              <li class="nav-item " style="margin-left: 30px;">
                <a class="nav-link active text-dark" aria-current="page" href="#">Accueil</a>
              </li>
              <li class="nav-item" style="margin-left: 30px;"> <a class="nav-link active text-dark" href="">Condition générale</a></li>
              <li class="nav-item" style="margin-left: 30px;"><a class="nav-link active text-dark" href="">Politique de confidentialité</a></li>
              <li class="nav-item" style="margin-left: 30px;"><a class="nav-link active text-dark" href="">faq</a></li>
              <li> <input type="text" placeholder="Votre newsletter..." style="margin-left: 30px;"><button class="btn btn-secondary">Evoyer</button></li>
            </ul>
            <span class="text-right">Copyright<i class="fa fa-copyright" aria-hidden="true"></i>2021</span> 
        </div>
        </div>
      </nav>
</footer>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?version=3.52.1&features=fetch"></script>
<script src="https://js.stripe.com/v3/"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="./assets/js/scriptStripe.js"></script>
</body>
</html>