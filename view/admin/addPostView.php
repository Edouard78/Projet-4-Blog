
<?php ob_start();


if (isset($_GET['errors']))
{
	if ($_GET['errors'] == 1)
	{
?>
<div class="alert alert-danger">
    <strong>Un ou plusieurs champs n'ont pas été remplie<strong>
</div>
<?php
	}
}
?>

<form action="index.php?action=addPost" method="post">
<legend>Ajouter un article</legend>
						<div class="form-group">
							<label for="title">Titre</label>
							<input type="text" class="form-control" name ="title" id="title" placeholder="Titre de l'article">
						</div>
						<div class="form-group">
							<label for="author">Auteur</label>
							<input type="text" class="form-control" name ="author" id="author" placeholder="Auteur">
						</div>
						<div class="form-group">
							<label for="content">Contenu</label>
							<textarea class="tinymce" name="content" id="content" placeholder="Contenu" rows="8"></textarea> 
						</div>
						<button type="submit" class="btn btn-default">Ajouter</button>
					</form>

<?php $content = ob_get_clean();

require 'view/admin/adminTemplate.php';
?>