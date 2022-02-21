<?php
  include "conf/info.php";
  $title="Bem-vindo ao $sitename | $tagline";
  include_once "header.php";
?>
<h1 class="m-2 text-center">Filmes melhores avaliados</h1>
<?php
  include_once "api/api_toprated.php";
  foreach($toprated->results as $p){
    echo '<div class="row row-cols-1 row-cols-md-3 g-4">
            <div class="col">
              <div class="card style=width: 18rem text-center text-dark h-100">
                <img src="http://image.tmdb.org/t/p/w500'. $p->backdrop_path . '" class="card-img-top" alt="'.$p->original_title.'">
                <div class="card-body">
                <a href="movie.php?id=' . $p->id . '" style="text-decoration:none"><h5 class="card-title">'. $p->original_title . ' ('. substr($p->release_date, 0, 4) . ')'.'</h5></a>
                </div>
              </div>
            </div>
          </div><br>';
  }
?>
<?php
  include_once "footer.php";
?>