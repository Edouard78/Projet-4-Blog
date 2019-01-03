
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

$data = $post->fetch();

 ?>

<form method="post" action="./index.php?action=updatePost&amp;id=<?php echo $_GET['id'] ?>">
  <legend>Modifier un article</legend>
  <div class="form-group">
							<label for="title">Auteur</label><input type="text" class="form-control" name="author" value="<?php echo $data['author'] ?>">
              <div class="form-group">
							<label for="title">Titre</label><input type="text" class="form-control" name="title" value="<?php echo $data['title'] ?>">
              <div class="form-group">
							<label for="title">Contenu</label><textarea id="textarea" class="tinymce" name="content" rows="8"><?php echo $data['content'] ?></textarea>
 
    <button type="submit" class="btn btn-default">Modifier</button>
</form>

<?php $content = ob_get_clean();

require 'view/admin/adminTemplate.php';
?>
