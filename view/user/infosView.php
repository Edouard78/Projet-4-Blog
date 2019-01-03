<?php ob_start(); ?>

<h3> Mes Infos </h3>

	<?php
	while ($data = $userInfos->fetch())
	{
		?>
				<p><strong>Login : </strong><?= $data['login'] ?></p>
				<p><strong>Email : </strong><?= $data['email'] ?></p>
			
			<?php
		}
		$userInfos->closeCursor();
		?>




	<?php $content = ob_get_clean(); ?>

<?php



require '/../template.php';
?>