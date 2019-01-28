
<div class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
 
<a class="navbar-brand" href="#">Jean</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="collapsibleNavbar">

  <ul class="navbar-nav">
    <li class="nav-item"> <a class="nav-link" href="index.php?action=home">Accueil</a> </li>
    <li class="nav-item"> <a class="nav-link" href="#">A propos</a> </li>
  </ul>
  <ul class="navbar-nav ml-auto">
  	<?php if (isset($_SESSION['login']) && isset($_SESSION['admin']))
  	{ ?>
    <li class="nav-item"><a class="nav-link" href="index.php?action=disconnect">Deconnexion</a></li>
    <?php
  		if($_SESSION['admin'] == TRUE){ ?>
  		<li class="nav-item"><a class="nav-link" href="index.php?action=adminPage">Espace Admin</a></li>
  		<?php
         }
      else if($_SESSION['admin'] == FALSE)
      { ?>
          <li class="nav-item"><a class="nav-link" href="index.php?action=userPage">Espace Utilisateur</a></li>
          <?php
    }
  }
  	else
  	{ 
  		?>
  	 <li class="nav-item"><a class="nav-link" data-toggle="modal" data-backdrop="false" href="#connexion">Connection</a></li>
  	 <?php
  	}
 ?>
  	</ul>

  </div>
  </div>




<div class="modal fade" id="connexion">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Connexion</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
              <form action="index.php?action=connexion" method="post">
                <div class="form-group">
                  <label for="login">Nom d'utilisateur</label>
                  <input type="text" class="form-control" name ="login" id="login" placeholder="Tapez votre nom d'utilisateur">
                </div>
                <div class="form-group">
                  <label for="password">Mot de passe</label>
                  <input type="password" class="form-control" name ="password" id="password" placeholder="Tapez votre mot de passe">
                </div>
                <button type="submit" class="btn btn-default">Se connecter</button>
                <a href="index.php?action=subscribePage" class="pull-right">S'inscrire</a>
              </form>
            </div>
        </div>
</div>
</div>
