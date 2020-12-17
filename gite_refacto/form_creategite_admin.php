<?php
require_once('libraries/database.php');
require_once('libraries/imagedload.php');
$pdo=getPdo();
//gestion des dowload des images
if (!empty($_POST)){
    

   
    
    //importation image_rect1 
    $file_name = $_FILES['image_rect_1']['name'];//atteindre le name 
    $file_type = strrchr($file_name, ".");//pour check .png etc...
    $file_tmp_name = $_FILES['image_rect_1']['tmp_name'];//fichier le chemin tempo
    $file_img= "img/" . $file_name;//var 
    $type_autorisees = array('.jpg','.gif','.png','.jpeg');//fichier que l'on controle
    copy($file_tmp_name,$file_img);//prend dans le dossier tempo pour le placer dans le dossier img
    
    // importation image_rect2 
    $file_name2 = $_FILES['image_rect_2']['name'];//atteindre le name 
    $file_type2 = strrchr($file_name2, ".");//pour check .png etc...
    $file_tmp_name2 = $_FILES['image_rect_2']['tmp_name'];//fichier le chemin tempo
    $file_img2= "img/" . $file_name2;//var 
    $type_autorisees = array('.jpg','.gif','.png','.jpeg');//fichier que l'on controle
    copy($file_tmp_name2,$file_img2);//prend dans le dossier tempo pour le placer dans le dossier img

    // importation image_rect3 
    $file_name3 = $_FILES['image_rect_3']['name'];//atteindre le name 
    $file_type3 = strrchr($file_name3, ".");//pour check .png etc...
    $file_tmp_name3 = $_FILES['image_rect_3']['tmp_name'];//fichier le chemin tempo
    $file_img3= "img/" . $file_name3;//var 
    $type_autorisees = array('.jpg','.gif','.png','.jpeg');//fichier que l'on controle
    copy($file_tmp_name3,$file_img3);//prend dans le dossier tempo pour le placer dans le dossier img
    
    // importation image_carre
    $file_name_carre = $_FILES['image_carre']['name'];//atteindre le name 
    $file_type_carre = strrchr($file_name_carre, ".");//pour check .png etc...
    $file_tmp_name_carre = $_FILES['image_carre']['tmp_name'];//fichier le chemin tempo
    $file_img_carre= "img/" . $file_name_carre;//var 
    $type_autorisees = array('.jpg','.gif','.png','.jpeg');//fichier que l'on controle
    copy($file_tmp_name_carre,$file_img_carre);//prend dans le dossier tempo pour le placer dans le dossier img

  
    $gite = $pdo->prepare(
        
        'INSERT INTO gite (name, image_rect_1, image_rect_2, image_rect_3, localisation, description, spec, nbr_couchage, prix, image_carre, categorie)
        VALUES (:name, :image_rect_1, :image_rect_2, :image_rect_3, :localisation, :description, :spec, :nbr_couchage, :prix, :image_carre, :categorie)'
        );


// binParam str
    $gite->bindParam(':name', $_POST['name'], PDO::PARAM_STR);
    $gite->bindParam(':localisation', $_POST['localisation'], PDO::PARAM_STR);
    $gite->bindParam(':description', $_POST['description'], PDO::PARAM_STR);
    $gite->bindParam(':spec', $_POST['spec'], PDO::PARAM_STR);
    $gite->bindParam(':nbr_couchage', $_POST['nbr_couchage'], PDO::PARAM_INT);
    $gite->bindParam(':prix', $_POST['prix'], PDO::PARAM_INT);
    $gite->bindParam(':categorie', $_POST['categorie'], PDO::PARAM_STR);
   

// bind des de l'image et de la doc : file
    // $gite->bindParam(':image_rect_1', $img , PDO::PARAM_STR);
    $gite->bindParam(':image_rect_1', $file_img , PDO::PARAM_STR);
    $gite->bindParam(':image_rect_2', $file_img2 , PDO::PARAM_STR);
    $gite->bindParam(':image_rect_3', $file_img3 , PDO::PARAM_STR);
    $gite->bindParam(':image_carre', $file_img_carre , PDO::PARAM_STR);
    $gite->execute();
    
}
// var_dump($gite);
include('inc/header.php');
?>
<div class="container formAdmin">
    <form method="POST" enctype="multipart/form-data">
        <div class="flexFormAdmin">
            <div class="col-5">
                <label class="form-label ">Nom</label>
                <input type="text" class="form-control" name="name" > 
                <label class="form-label">Localisation</label>
                <input type="text" class="form-control" name="localisation">
                <label class="form-label">Spécificités</label>
                <input type="text" class="form-control"  name="spec"> 
                <label class="form-label">Nombre de couchages</label>
                <input type="text" class="form-control" name="nbr_couchage">
            </div> 
            <div class="col-5">
                <label class="form-label ">Categorie</label>
                <select class="custom-select mr-sm-2" name="categorie" id="inlineFormCustomSelect">
					<option>Hotel</option>
					<option>Chalet</option>
					<option>Maison</option>
					<option>Prestige</option>
				</select>
                <label class="form-label ">Prix</label>
                <input type="text" class="form-control"  name="prix"> 
                <label class="form-label">Description</label>
                <textarea type="text" class="form-control" name="description"></textarea>
            </div>   
        </div>
            <!-- <div class="flexFormAdmin"> -->
                      <!-- pour la disponiobilité voir plus tard -->
                <!-- <label for="dateFinGar">Date Debut :</label>
                <input type="date" id="dateDebut" name="date_debut" max="2025-12-31">
                <label for="dateFinGar">Date fin :</label>
                <input type="date" id="dateFin" name="date_fin" max="2025-12-31"> -->

            <!-- </div> -->
            <div class="flexFormAdmin downloadFile">
                <div>
                    <label for="exampleFormControlFile1">Image rectangle1</label><br>
                    <input type="file" class="form-control-file" name="image_rect_1"><br>
                    <label for="exampleFormControlFile1">Image rectangle2</label><br>
                    <input type="file" class="form-control-file" name="image_rect_2"><br>
                </div>
                <div>
                    <label for="exampleFormControlFile1">Image rectangle3</label><br>
                    <input type="file" class="form-control-file" name="image_rect_3"><br>
                    <label for="exampleFormControlFile1">Image carre</label><br>
                    <input type="file" class="form-control-file" name="image_carre"><br>
                </div>
            </div> 
            
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<?php
include('inc/footer.php');
?>