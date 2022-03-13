
<?php ob_start(); ?>
<h1 class="display-6 text-center text-secondary text-decoration-underline">Liste des Utilisateurs:</h1>
  <table class="table table-striped">
      <thead>
          <tr>
              <th>Id</th>
              <th>Nom</th>
              <th>Prénom</th>
              <th>Login</th>
              <th>Email</th> 
              <th>Grade</th> 
              <?php if($_SESSION['Auth']->id_g_grade == 1){ ?>
              <th class="text-center">Actions</th>
              <?php } ?>
          </tr>
      </thead>
      <tbody>
          <?php foreach ($allUsers as  $user) { ?>
          <tr>
              <td><?=$user->getId_u();?></td>
              <td><?=$user->getNom_u();?></td>
              <td><?=$user->getPrenom_u();?></td>
              <td><?=$user->getLogin();?></td>
              <td><?=$user->getEmail();?></td>
              <td><?=$user->getGrade()->getNom_g();?></td>
              <?php if($_SESSION['Auth']->id_g_grade == 1){ ?>
              <td class="text-center">
                <?php
                    echo($user->getStatut())
                    ? "<a href='index.php?action=list_u&id=".$user->getId_u()."&statut=".$user->getStatut()."'  onclick='return confirm(`Etes-vous sûr de vouloir désactiver...`)' class='btn btn-danger'><i class='fas fa-unlock'> Désactiver</i></a>"
                    : "<a href='index.php?action=list_u&id=".$user->getId_u()."&statut=".$user->getStatut()."' onclick='return confirm(`Etes-vous sûr de vouloir activer...`)' class='btn btn-success'><i class='fas fa-lock'> Activer</i></a>"
                ?>
              </td>
              <?php } ?>
              
          </tr>
          <?php } ?>
      </tbody>
  </table>
  


<?php 
    $contenu = ob_get_clean();
    require_once('./views/templateAdmin.php');
?>
