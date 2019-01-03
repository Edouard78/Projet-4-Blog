
<?php ob_start(); ?>
<h3>Utilisateur</h3>
<table class="table table-bordered table-striped table-condensed">
	<thead>
		<tr>

			<th>Utilisateur</th>
			<th>Email</th>
			<th>Status</th>
            <th>Mettre à jour</th>
			<th>Supprimer</th>
		</tr>
	</thead>
	<?php

	while ($data = $users->fetch())
	{
        if ($data['admin'] == 1){
            $opposite = 0;
            $oppositeText = 'User';
            $value = 1;
            $text = 'Admin';

        } else {
            $opposite = 1; 
            $oppositeText ='Admin';
            $text = 'User';
            $value = 0;
        }


		?>
  
		<tbody>

			<tr>

				<td><?php echo $data['login']; ?></td>
				<td><?= $data['email'] ?></td>
                <form method="post" action="index.php?action=updateUser&amp;id=<?= $data['id'] ?>">
				<td><select name="admin">
            
  <option value="<?= $value ?>" selected><?= $text ?></option> 
  
  <option value="<?= $opposite ?>"><?= $oppositeText ?></option></select>
  </td>
  <td><button class="btn btn-secondary" type="submit">
					Mettre à jour</button>
                    </td>
				</form>
		
                <td> <a href="index.php?action=deleteUser&amp;id=<?= $data['id'] ?>" class="btn btn-dark">
					 Supprimer
				</a>
				<td>  
                 
				</tr>

			</tbody>
			<?php

	}

		?>

	</table>


	<?php $content = ob_get_clean(); ?>

	<?php



	require 'view/admin/adminTemplate.php';
	?>
