<?php ob_start(); ?>

<div class="container" id="home">
        <div id="carouselExampleControls" class="carousel slide bg-secondary" data-bs-ride="carousel">
            <div class="carousel-inner" style="margin-left:38%">
              <div class="carousel-item active">
                <img src="./assets/images/k.jpg" class="d-block  " style="height:400px" alt="...">
              </div>
              <div class="carousel-item">
                <img src="./assets/images/chanel.jpg" class="d-block " style="height:400px" alt="...">
              </div>
              <div class="carousel-item">
                <img src="./assets/images/black.jpg" class="d-block " style="height:400px" alt="...">
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
          </div>
          <!---end carrousel-->
          <div class="row my-3">
              <div class="col-8">
                <div class="row row-cols-1 row-cols-md-2 g-4">
                    <?php foreach($parfs as $parf){ ?>
                    <div class="col">
                      <div class="card">
                        <img src="./assets/images/<?=$parf->getImage();?>" class="card-img-top text-center" style="height: 350px;" alt="...">
                        <div class="card-body">
                          <h5 class=" text-center bg-warning text-dark card-title"> <?=$parf->getCategorie()->getNom_cat();?>:  <?=$parf->getMarque();?></h5>
                          <p class="card-text text-secondary"><?=$parf->getDescription();?></p>
                          <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                             Modèle:
                              <span class="badge text-warning rounded-pill"><?=$parf->getModele();?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                            Contenance:
                              <span class="badge text-warning rounded-pill"><?=$parf->getContenance();?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                             Prix:
                              <span class="badge bg-warning rounded-pill"><?=$parf->getPrix();?> €</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                              Quantité:
                              <span class="badge bg-warning rounded-pill"><?=$parf->getQuantite();?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                              
                              <form action="index.php?action=checkout" method="post">
                                <input type="hidden" name="id"  value="<?=$parf->getId_p();?>">
                                <input type="hidden" name="marque"  value="<?=$parf->getMarque();?>">
                                <input type="hidden" name="modele" value="<?=$parf->getModele();?>">
                                <input type="hidden" name="contenance" value="<?=$parf->getContenance();?>">
                                <input type="hidden" name="image" value="<?=$parf->getImage();?>">
                                <input type="hidden" name="prix" value="<?=$parf->getPrix();?>">
                                <input type="hidden" name="quantite" value="<?=$parf->getQuantite();?>">
                                <?php if($parf->getQuantite() > 0){ ?>
                                  <button type="submit" class="btn btn-info" name="envoi">Acheter</button>
                                <?php } ?>
                              </form>
                              <strong class="badge rounded-pill">
                                <?php if($parf->getQuantite() == 0){ ?>
                                <a href="index.php?action=order&id=<?=$parf->getId_p();?>" class="btn btn-warning text-white">
                                   Commander
                                </a>
                                <?php } ?>
                              </strong>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <?php } ?>
         
              </div>
            </div>
              <!--end cards-->
              <div class="col-4">
                    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" class="input-group">
                        <input class="form-control text-center" type="search" name="search" id="search" placeholder="Rechecher...">
                        <button type="submit" class="btn btn-outline-secondary" name="soumis"><i class="fas fa-search"></i></button>
                     </form>
                <div class="card mt-1">
                    <ul class="list-group list-group-flush">
                      <?php foreach($tabCat as $cat ){ ?>
                      <li class="list-group-item text-center">
                        <a class="btn text-center" href="index.php?id=<?=$cat->getId_cat();?>"><?=ucfirst($cat->getNom_cat());?></a>
                      </li>
                     <?php } ?>
                    </ul>
                </div> 
              </div>
          
    </div>
 
<?php 
    $contenu = ob_get_clean();
    require_once('./views/public/templatePublic.php');
?>