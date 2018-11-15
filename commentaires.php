<meta charset="utf-8" />
<?php

$bdd = new PDO('mysql:host=127.0.0.1;dbname=projetsio1;charset=utf8','root','');
if(isset($_GET['id']) AND !empty($_GET['id'])) {
   $getid = htmlspecialchars($_GET['id']);
   $projetsio1 = $bdd->prepare('SELECT * FROM site WHERE id = ?');
   $projetsio1->execute(array($getid));
   $projetsio1 = $site->fetch();

   
   if(isset($_POST['postercommentaire'])) {
      if(isset($_POST['pseudo'],$_POST['commentaire']) AND !empty($_POST['pseudo']) AND !empty($_POST['commentaire'])) {
         $pseudo = htmlspecialchars($_POST['pseudo']);
         $commentaire = htmlspecialchars($_POST['commentaire']);
         $insert = $bdd->prepare('INSERT INTO commentaires (pseudo,commentaire) VALUES (?,?)');
         $ins->execute(array($pseudo,$commentaire,$getid));
         $c_message = "Votre commenaire a bien été posté !";

        
       } else {
         $c_message = "Erreur:Tous les champs doivent être complétés";
         } 
       }
      $commentaires = $bdd->prepare('SELECT * FROM commentaires WHERE id_articles = ?');
      $commentaires->execute(array($getid));  
             
}
?>  
<br/>
<h2>Voici l'espace commentaire, vous pouvez nous poser des questions !</h2>
<h3>Commentaires:</h3>
<form method="POST">
   <input type="text" name="pseudo" placeholder="Pseudo"/><br/>
   <textarea name="commentaire" placeholder="Ecrivez votre commentaire..."></textarea><br/>
   <input type="submit" value="Poster" name="postercommentaire" />
</form>


<?php while($c = $commentaires->fetch()) { ?>
   <b><?= $c['pseudo'] ?>:</b> <?= $c['commentaire'] ?><br />
<?php } ?>

<?php if(isset($c_erreur)) { echo $c_message; } ?>

<?php } ?>
<?php
}
?>
