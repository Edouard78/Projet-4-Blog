<?php

require '../../../controller/frontend.php';

?>

<?php ob_start(); ?>

<h1>Ajouter un article</h1>

<form action="addPostView.php" method="post">

	Auteur : <input type="text" name="author" /><br />
  Titre : <input type="text" name="title" /><br />
  Contenu :<br /><textarea name="content"></textarea><br />

	 <input type="submit" value="Ajouter" />
</form>

<?php $content = ob_get_clean(); ?>

<?php

if(isset($_POST['author'])){
	$donnees = array('author' => $_POST['author'] , 'title' => $_POST['title'] , 'content' => $_POST['content']);

  addPost($donnees);

}

require '../../../view/admin/adminTemplate.php';
?>
