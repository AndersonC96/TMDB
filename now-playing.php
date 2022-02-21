<?php
  include "conf/info.php";
  $title="Filmes do momento";
  include_once "header.php";
?>
<h1><?php echo $title ?></h1>
<?php
  include_once "api/api_now.php";
  $min = date('d/m/Y', strtotime($nowplaying->dates->minimum));
  $max = date('d/m/Y', strtotime($nowplaying->dates->maximum));
  echo "<h5>De <b>". $min . "</b>, até <b>" . $max . "</b></h5>";
?>
<hr>
<?php
  foreach($nowplaying->results as $p){
    echo '<li><a href="movie.php?id=' . $p->id . '"><img src="'.$imgurl_1.''. $p->poster_path . '"><h4>' . $p->original_title . " (" . substr($p->release_date, 0, 4) . ")</h4></a></li>";
  }
?>
<?php
  include_once "footer.php";
?>