<?php
  include "conf/info.php";
  $title="Séries";
  include_once "header.php";
?>
<?php
  include_once "api/api_tv.php";
?>
<h3>Séries em exibição</h3>
<?php
  echo '<div class="row row-cols-1 row-cols-md-3 g-4">';
  foreach($tv_onair->results as $tp){// para cada série em exibição
    echo '<div class="col">
            <div class="card h-100">
              <img src="http://image.tmdb.org/t/p/w500'. $tp->backdrop_path . '" class="card-img-top" alt="'.$tp->name.'">
              <div class="card-body">
                <h5 class="card-title" style="color: #0dcaf0">'. $tp->original_name . ' | ' . $tp->name .' ('. substr($tp->first_air_date, 0, 4) . ')'.'</h5>
                <p class="card-text text-break" style="color: black">'.$tp->overview.'</p>
                <a href="tvshow.php?id='.$tp->id.'" class="btn btn-primary">Detalhes</a>
              </div>
              <div class="card-footer">
                <span class="badge bg-primary">'.$tp->vote_average.'</span>
                <small class="text-muted">Data de lançamento: '.date("d/m/Y", strtotime($tp->first_air_date)).'</b></small>
              </div>
            </div>
          </div>';
  }
  echo '</div>';
?>
<br>
<h3>Séries com as melhores avaliações</h3>
<ul>
  <?php
    echo '<div class="row row-cols-1 row-cols-md-3 g-4">';
    foreach($tv_top->results as $tt){
      echo '<div class="col">
            <div class="card h-100">
              <img src="http://image.tmdb.org/t/p/w500'. $tt->backdrop_path . '" class="card-img-top" alt="'.$tt->name.'">
              <div class="card-body">
                <h5 class="card-title" style="color: #0dcaf0">'. $tt->original_name . ' | ' . $tt->name .' ('. substr($tt->first_air_date, 0, 4) . ')'.'</h5>
                <p class="card-text text-break" style="color: black">'.$tt->overview.'</p>
                <a href="tvshow.php?id='.$tt->id.'" class="btn btn-primary">Detalhes</a>
              </div>
              <div class="card-footer">
                <span class="badge bg-primary">'.$tt->vote_average.'</span>
                <small class="text-muted">Data de lançamento: '.date("d/m/Y", strtotime($tt->first_air_date)).'</b></small>
              </div>
            </div>
          </div>';
    }
    echo '</div>';
  ?>
</ul>
</div>
</div>
<?php
  include_once "footer.php";
?>