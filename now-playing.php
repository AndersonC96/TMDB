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
<?php
  echo '<div class="row row-cols-1 row-cols-md-3 g-4">';
  foreach($nowplaying->results as $p){
    echo '<div class="col">
            <div class="card h-100">
              <img src="http://image.tmdb.org/t/p/w500'. $p->backdrop_path . '" class="card-img-top" alt="'.$p->original_title.'">
              <div class="card-body">
                <h5 class="card-title" style="color: #0dcaf0">'. $p->original_title . ' | ' . $p->title .' ('. substr($p->release_date, 0, 4) . ')'.'</h5>
                <p class="card-text text-break" style="color: black">'.$p->overview.'</p>
                <a href="movie.php?id='.$p->id.'" class="btn btn-primary">Detalhes</a>
              </div>
              <div class="card-footer">
                <span class="badge bg-primary">'.$p->vote_average.'</span>
                <small class="text-muted">Data de lançamento: '.date("d/m/Y", strtotime($p->release_date)).'</b></small>
              </div>
            </div>
          </div>';
  }
  echo '</div>';
?>
<?php
  include_once "footer.php";
?>