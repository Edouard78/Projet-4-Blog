

<?php ob_start(); ?>
<h3>Articles</h3>
		<a href="index.php?action=addPostPage" class="btn btn-primary">
		Ajouter un article
		</a>
		<br>
		<div class="table-responsive">
<table class="table table-bordered table-striped table-condensed">
	<thead>
		<tr>
			<th>Date de creation</th>
			<th>Article</th>
			<th>Auteur</th>
			<th>Résumé</th>
			<th>Modifier</th>
			<th>Supprimer</th>
		</tr>
	</thead>
	<?php
	while ($data = $posts->fetch())
	{
		?>
		<tbody>

			<tr>
				<td><?= $data['creationDateFr'] ?></td>
				<td><?= htmlspecialchars($data['title']) ?></td>
				<td><?= htmlspecialchars($data['author']) ?></td>
				<td><?= htmlspecialchars($data['contentResume']) ?></td>
				<td> <a href="index.php?action=updatePostDirection&amp;id=<?= $data['id'] ?>" class="btn btn-secondary">
					</span> Modifier
				</a>
				<td> 
					<a href="index.php?action=deletePost&amp;id=<?= $data['id'] ?>" class="btn btn-dark">
						 Supprimer 
					</a></td>
				</tr>

			</tbody>
			<?php
		}
		$posts->closeCursor();
		?>

	</table>
</div>


	<?php $content = ob_get_clean(); ?>

	<?php



	require 'view/admin/adminTemplate.php';
	?>
