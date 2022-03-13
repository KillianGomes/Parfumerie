<?php ob_start();?>

<div class="container">
  <h2 class="text-white text-center bg-dark">Ma commande</h2>
<div class="row " style="margin-left: 25%;" style="margin-top: 5%;">
  <div class="col-8 ">
    <div class="card mb-3 bg-secondary" >
      <div class="row g-0">
        <div class="col-md-4">
          <img src="./assets/images/<?=$image;?>" width="200" alt="..." >
        </div>
        <div class="col-md-8">
          <div class="card-body">
            <h5 class="card-title"><?=$marque;?> - <?=$modele;?></h5>
            <p class="card-text text-warning">Contenance: <?=$contenance;?></p>
            <p class="card-text text-warning">Prix: <?=$prix;?> €</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row" style="margin-left: 25%;">
  <div class="col-8">
  <h4 class="text-center text-light bg-secondary">Validation</h4>
    <form>
      <label for="email">Email*</label>
      <input type="email"id="email" class="form-control" placeholder="Votre email svp...">
      <label for="quant">Quantite*</label>
      <input type="number" id="quant" class="form-control" min="1" value="1" max="<?=$nb;?>">
      <input type="hidden" id="ref" value="<?=$id;?>">
      <input type="hidden" id="modele" value="<?=$modele;?>">
      <input type="hidden" id="marque" value="<?=$marque;?>">
      <input type="hidden" id="contenance" value="<?=$contenance;?>">
      <input type="hidden" id="prix" value="<?=$prix;?>">
      <input type="hidden" id="nb" value="<?=$nb;?>">

      <button id="checkout-button" class="btn btn-danger col-12 mt-2">
      <i class="fab fa-cc-visa"></i> Valider
      </button>
    </form>
  </div>
</div>
</div>
<?php 
    $contenu = ob_get_clean();
    require_once('./views/public/templatePublic.php');
?>