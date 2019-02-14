

<?php ob_start(); ?>
<h3>Commentaires</h3>
<table class="table table-striped table-condensed">
	<thead>
		<tr>
			<th>Date de creation</th>
			<th>Article</th>
			<th>Auteur</th>
			<th>Commentaire</th>
			<th>Signalement</th>
			<th>Supprimer</th>
		</tr>
	</thead>
	<?php
	
	         

	while ($data = $comments->fetch())
	{

		?>
		<tbody>

			<tr>
				<td><?= htmlspecialchars($data['creationDateFr']) ?></td>
				<td><?php echo htmlspecialchars($data['postId']) ?></td>
				<td><?= htmlspecialchars($data['author']) ?></td>
				<td><?= htmlspecialchars($data['comment']) ?></td>
				<td><?= htmlspecialchars($data['reportedTimes']) ?><span class="glyphicon glyphicon-warning-sign"></span></td>

				<td>	<a href="index.php?action=deleteComment&amp;id=<?= $data['id'] ?>" class="btn btn-dark" role="button">
						Supprimer 
					</a></td>
				</tr>

			</tbody>
			<?php

	}

		$comments->closeCursor();

		?>

	</table>


	<?php $content = ob_get_clean(); ?>

	<?php



	require 'view/admin/adminTemplate.php';
	?>
