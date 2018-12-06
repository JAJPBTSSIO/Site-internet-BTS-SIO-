<html>

<link href="commentaires.css" rel="stylesheet" media="all" type="text/css"> 

<meta charset="utf-8" />
<meta http-equiv="refresh" content="commentaires.php">
<?php
$bdd = new PDO('mysql:host=127.0.0.1;dbname=projetsio1;charset=utf8','root','');



   

   
   
if(isset($_POST['postercommentaire'])) {
   if(isset($_POST['pseudo'],$_POST['commentaire']) AND !empty($_POST['pseudo']) AND !empty($_POST['commentaire'])) {
   $pseudo = htmlspecialchars($_POST['pseudo']);
   $commentaire = htmlspecialchars($_POST['commentaire']);
   $insert = $bdd->prepare('INSERT INTO commentaires (pseudo,commentaire) VALUES (?,?)');
   $insert->execute(array($pseudo,$commentaire));
   $c_message = "Votre commenaire a bien été posté !";
   echo $c_message;
   $commentaires = $bdd->prepare('SELECT * FROM commentaires ');
   $commentaires->execute(array($_POST['pseudo'],$_POST['commentaire']));
   $c = $commentaires->fetch();}
        
   else {
   $c_message = "Erreur : Tous les champs doivent être complétés ! ";
   echo $c_message; } 
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

<?php if(isset($c_erreur)){echo $c_erreur;} ?>
<?php while($c = $commentaires->fetch()) { ?>
   <b><?= $c['pseudo'] ?>:</b> <?= $c['commentaire'] ?><br />
<?php } ?>

</html>





