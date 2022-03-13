<?php ob_start();?>

 <div class="container">
     <div class="row">
         <div class="col-6 offset-3">
             <form action="<?php $_SERVER['PHP_SELF'];?>" method="post">
                <label for="">Identifiant</label>
                 <input type="text" class="form-control"  value="<?=$grade->getId_g();?>" readonly>
                 <label for="grade">Grade</label>
                 <input type="text" id="grade" name="grade" class="form-control" value="<?=$grade->getNom_g();?>">
                <button type="submit" class="btn btn-warning col-12 mt-2" name="soumis">Modifier</button>
                </form>
         </div>
     </div>
 </div>
<?php 
    $contenu = ob_get_clean();
    require_once('./views/templateAdmin.php');
?>