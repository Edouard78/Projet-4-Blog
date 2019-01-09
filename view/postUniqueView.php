<?php
ob_start();
$postData = $post->fetch();
?>
<div class="card">
<div class="card-header">
    <h3 class="panel-title"><?php
echo htmlspecialchars($postData['title']) ?>
<em class="float-right"><?php
if ($postData['creationDateFr'] != $postData['updatingDateFr'])
  {
?>
  Mise à jour par 
  <?php
  echo htmlspecialchars($postData['author']) ?>&#44; le 
  <?php
  echo $postData['updatingDateFr']; 
  }
else{
?>
Posté par 
  <?php
  echo htmlspecialchars($postData['author']) ?>&#44; le 
  <?php
  echo $postData['creationDateFr'];
}
?>
</em></h3>
  </div>
  <div class="card-body"><?php
echo nl2br(html_entity_decode($postData['content'])) ?></div>
</div>
<br/>
<?php

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
<h3>Commentaires</h3>
<?php

while ($commentsData = $comments->fetch())
	{
?>

<div class="card">
<div class="card-body"><p><strong><?php
	echo nl2br(htmlspecialchars($commentsData['author'])) ?></strong> <em>le <?php
	echo nl2br(htmlspecialchars($commentsData['creationDateFr'])) ?></em></p>
  <?php
	echo nl2br(htmlspecialchars($commentsData['comment'])) ?></div>
  <div class="card-footer"><?php
	if (isset($_SESSION['login']))
		{ ?><a href="index.php?action=reportComment&amp;commentId=<?php
		echo $commentsData['id'] ?>&amp;postId=<?php
		echo $commentsData['postId'] ?>">Signaler</a><?php
		if (isset($_GET['reportError']) && isset($_GET['commentId']))
			{
			if ($_GET['reportError'] == 1 && $commentsData['id'] == $_GET['commentId'])
				{
?>
      <p style="color:red;">Vous avez déjà signalé ce commentaire.</p>
      <?php
				}
			}
		  else
		if (isset($_GET['reportSuccess']) && isset($_GET['commentId']))
			{
			if ($_GET['reportSuccess'] == 1 && $commentsData['id'] == $_GET['commentId'])
				{
?>
      <p style="color:green;">Ce commentaire à bien été signalé.</p>
      <?php
				}
			}
		}

?>
   </div>
</div>
<?php
	}
?>

 <h3>Ajouter un commentaire<h3>
 <?php
if (isset($_SESSION['login']))
	{
?>
<form method = "post" action = "index.php?action=addComment&postId=<?php
	echo $postData['id'] ?>">
    Auteur : <input type="text" name="author">
    Contenu <textarea name="comment"></textarea>

    <button>Ajouter</button>
</form>
<?php
  }
  else{
    ?>
    <p>Vous devez être connecter pour ajouter un commentaire</p>
    <?php
  }

$content = ob_get_clean();
require ('view/template.php')

?>
