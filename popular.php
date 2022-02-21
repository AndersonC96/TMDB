<?php
  include "conf/info.php";// inclui o arquivo com as configurações
  $title="Filmes populares";// titulo da pagina
  include_once "header.php";// inclui o cabeçalho
?>
<h1>Filmes populares</h1>
<ul>
  <?php
    include_once "api/api_popular.php";// inclui o arquivo com as configurações
    echo '<div class="row row-cols-1 row-cols-md-3 g-4">';// inicia a div row
    foreach ($popular->results as $p){// foreach para cada resultado
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
    echo '</div>';// fecha a div row
  ?>
</ul>
<?php
  include_once "footer.php";// inclui o rodapé
?>