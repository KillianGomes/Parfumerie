<?php ob_start(); ?>
<h1 class="display-6 text-center text-secondary text-decoration-underline">Les Grades:</h1>
  <table class="table table-striped">
      <thead>
          <tr>
              <th>Id</th>
              <th>Nom</th>
              <th colspan="2" class="text-center">Actions</th>
          </tr>
      </thead>
      <tbody>
          <?php foreach ($allGrades as  $grade) { ?>
          <tr>
             <td><?=$grade->getId_g()?></td>
             <td><?=$grade->getNom_g()?></td>
             <td><a class="btn btn-warning" href="index.php?action=edit_g&id=<?=$grade->getId_g();?>"><i class="fas fa-edit" aria-hidden="true"></i></a></td>
             <?php if($_SESSION['Auth']->id_g_grade != 3 ){ ?>
             <td><a class="btn btn-danger" href="index.php?action=delete_g&id=<?=$grade->getId_g();?>"><i class="fas fa-trash" aria-hidden="true"></i></a></td>
            <?php } ?>
          </tr>
          <?php } ?>
      </tbody>
  </table>
  


<?php 
    $contenu = ob_get_clean();
    require_once('./views/templateAdmin.php');
?>
