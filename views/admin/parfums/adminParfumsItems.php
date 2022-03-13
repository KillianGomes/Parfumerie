
<?php ob_start(); ?>
<h1 class="display-6 text-center text-decoration-underline text-secondary">Liste Parfums:</h1>
 <div class="row">
     <div class="col-4 offset-8">
     <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" class="input-group">
        <input class="form-control text-center" type="search" name="search" id="search" placeholder="Rechecher...">
        <button type="submit" class="btn btn-outline-secondary" name="soumis"><i class="fas fa-search"></i></button>
     </form>
     </div>
 </div>
  <table class="table table-striped">
      <thead>
          <tr>
              <th>Id</th>
              <th>Marque</th>
              <th>Modele</th>
              <th>Prix</th>
              <th>Image</th>
              <th>Quantite</th>
              <th>Contenance</th>
              <th>Description</th>
              <th>Categorie</th>
              <th colspan="2" class="text-center">Actions</th>
          </tr>
      </thead>
      <tbody>
          
          <tr>
          <?php if(is_array($parfums)){ foreach ($parfums as  $parfum) { ?>
              <td><?=$parfum->getId_p();?></td>
              <td><?=$parfum->getMarque();?></td>
              <td><?=$parfum->getModele();?></td>
              <td><?=$parfum->getPrix();?></td>
              <td><img src="./assets/images/<?=$parfum->getImage();?>" alt="" width="100"></td>
              <td><?=$parfum->getQuantite();?></td>
              <td><?=$parfum->getContenance();?></td>
              <td ><?=$parfum->getDescription();?></td>
              <td><?=$parfum->getCategorie()->getNom_cat();?></td>
              <td class="text-center">
                <a class="btn btn-warning" href="index.php?action=edit_p&id=<?=$parfum->getId_p();?>">
                    <i class="fas fa-pen"></i>
                </a>
              </td>
              <?php if($_SESSION['Auth']->id_g_grade != 3 ){ ?>
              <td  class="text-center">
                <a class="btn btn-danger" href="index.php?action=delete_p&id=<?=$parfum->getId_p();?>"
                    onclick="return confirm('Etes vous sûr de ...')">
                    <i class="fas fa-trash"></i>
                </a>
              </td>
              <?php } ?>
          </tr>
          <?php }}else{ echo"<tr class='text-center text-danger'><td colspan='10' >".$parfums."</td></tr>";} ?>
      </tbody>
  </table>
<?php 
    $contenu = ob_get_clean();
    require_once('./views/templateAdmin.php');
?>
