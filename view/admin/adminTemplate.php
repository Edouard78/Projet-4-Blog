<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
	<title>Page d'administration</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="Billet simple pour l'Alaska, roman sous plusieurs épisodes, de Jean Forteroche acteur et écrivain ">
    <meta name="keywords" content="billet simple Alaska blog roman jean forteroche ecrivain">
    <meta name="author" content="Jean Forteroche">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="./public/css/style.css">
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'.tinymce' });</script>
</head>

<body>
	<nav>
		<div class="nav">
			<?php require_once( 'view/nav.php'); ?>
		</div>
	</nav>
	<div class="wraper">	

    <div class="container-fluid">
   	<div class = "row">

    <nav class="nav flex-column nav-tabs align-content-center col-md-3">
    <h3>Panel</h3>
 
                <li class="nav-item "> <a class="nav-link " href="index.php?action=postsAdmin">Articles</a> </li>
                <li class="nav-item"> <a class="nav-link" href="index.php?action=commentsAdmin">Commentaires</a> </li>
                <li class="nav-item"> <a class="nav-link" href="index.php?action=usersAdmin">Utilisateurs</a> </li>

</nav>

        <div class="contentPage col-md-9">
            <?php echo $content ?>
        </div>
        
 
</div>
</div>
</div>
	<footer id="footer">
		<div class="jumbotron">
			<div class="container-fluid">
				<div class="footerBlock row">
					<div class="socialMedia col"> <em class="fa fa-facebook"></em>
						<em class="fa fa-twitter"></em>
						<em class="fa fa-skype"></em>
						<em class="fa fa-instagram"></em>
					</div>
					<div class="contact col">
						<h3>Contact :</h3>
						<p>jeanopenclassrooms@gmail.com
							<br/>0660812984</p>
					</div>
				</div>
			</div>
			</div>
	</footer>

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
   </body>
</html>
