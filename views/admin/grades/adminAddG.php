<?php ob_start();?>

 <div class="container">
     <div class="row">
         <div class="col-6 offset-3">
         <h1 class="display-6 text-center text-secondary text-decoration-underline">Ajout d'un Grade:</h1>
             <form action="<?php $_SERVER['PHP_SELF'];?>" method="post">
                
                 <label for="grade">Grade</label>
                 <input type="text" id="grade" name="grade" class="form-control" placeholder="Entrez un Grade">
                <button type="submit" class="btn btn-secondary  col-12 mt-2" name="soumis">Ajouter</button>
                </form>
         </div>
     </div>
 </div>
<?php 
    $contenu = ob_get_clean();
    require_once('./views/templateAdmin.php');
?>