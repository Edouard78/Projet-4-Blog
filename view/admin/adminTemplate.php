<!DOCTYPE html>
<html>
   <head>
        <meta charset="utf-8" />
        <title>Page d'amnistration</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" >
        <link rel="stylesheet" type="text/css" href="public/css/style.css" >
   </head>
   <body>
   	<div class="container">
   	<header>
   		<h1>Blog De Jean</h1>
   		<div class= "subtitleBlock">
   		<div class = "subtitle"><h3>Ecrivain</h3></div>
   		<div class = "logo"><img src="plume.png" /></div>
   	</div>
   	</header>
   
   	<div class="nav">
      <?php require_once('/../nav.php'); ?>
    </div>
   	<div class = "row">
   	    <div class="navbar navbar-default">
            <ul class="nav navbar-nav">
                <li class="active"> <a href="index.php?action=postsAdmin">Articles</a> </li>
                <li> <a href="index.php?action=commentsAdmin">Commentaires</a> </li>
            </ul>
         </div>
        <div class="contentPage">
            <?php echo $content ?>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
   </body>
</html>
