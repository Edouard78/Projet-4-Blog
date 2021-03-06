<?php
ob_start();

while ($data = $posts->fetch())
	{ ?>
<div class="card">
  <div class="card-header">
  <h5 class="panel-title"><a href="index.php?action=postUnique&amp;id=<?php
	echo $data['id'] ?>"><?php
	echo htmlspecialchars($data['title']) ?></a><em class="float-right"><?php
	if ($data['creationDateFr'] != $data['updatingDateFr'])
		{
?>
    Mise à jour par 
    <?php
		echo htmlspecialchars($data['author']) ?>&#44; le 
    <?php
		echo $data['updatingDateFr']; 
    }
else{
  ?>
  Posté par 
    <?php
		echo htmlspecialchars($data['author']) ?>&#44; le 
    <?php
		echo $data['creationDateFr'];
}
?></em></h5>
  </div>
  <div class="card-body"><p class="card-text"><?php
		echo nl2br(html_entity_decode($data['content'])); ?>
  </div>
</div>
<br/>
<?php
		}

?>
<?php
	if (isset($_GET['page']))
		{
		$nextPageButtonValue = intval($_GET['page']) + 1;
		$prevPageButtonValue = intval($_GET['page']) - 1;
		}
	  else
		{
		$nextPageButtonValue = 2;
		$prevPageButtonValue = 0;
		}

?>
<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
    <li class="page-item">
      <a class="page-link" href="index.php?action=home&amp;page=<?php
	echo $prevPageButtonValue; ?>" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
        <span class="sr-only">Previous</span>
      </a>
    </li>
  
<?php
	for ($i = 1; $i <= $postsListsNb + 1; $i++)
		{
?>
    <li class="page-item"><a class="page-link" href="index.php?action=home&amp;page=<?php
		echo $i; ?>"><?php
		echo $i; ?></a></li>

<?php
		} ?>
    <li class="page-item">
      <a class="page-link" href="index.php?action=home&amp;page=<?php
	echo $nextPageButtonValue; ?>" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
        <span class="sr-only">Next</span>
      </a>
    </li>
  </ul>
</nav>
<?php
	$content = ob_get_clean();
	require ('view/template.php')

?>

