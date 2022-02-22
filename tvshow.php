<?php
  $id_tv = $_GET['id'];// id da serie
  include "conf/info.php";// informacoes do site
  include_once "api/api_tv_id.php";// api para obter informacoes da serie
  include_once "api/api_tv_video_id.php";// api para obter videos da serie
  $title = $tv_id->original_name;// titulo da pagina
  include_once "header.php";// header
?>
<?php
  if(isset($_GET['id'])){// se existir o id
    $id_tv = $_GET['id'];// id da serie
    $rel = date('d/m/Y', strtotime($tv_id->last_air_date));// data de ultimo episodio
?>
<h1 class="m-2 text-center" style="color: #0dcaf0"><?php echo $tv_id->name ?></h1>
<?php
  echo "<h5 class='m-2 text-center'>".$tv_id->tagline."</h5>";
?>
<?php
  echo "<h5 class='m-2 text-center'>Primeiro episódio <b>".date('d/m/Y', strtotime($tv_id->first_air_date))."</b> | último episódio <b>".$rel."</b></h5>";
?>
<img class="rounded mx-auto d-block" src="http://image.tmdb.org/t/p/w300<?php echo $tv_id->poster_path ?>"/>
<p class="m-2 text-center"><b style="color: #20c997">Status</b>: <?php echo $tv_id->status ?></p>
<p class="m-2 text-center"><b style="color: #20c997">Gêneros</b>: 
  <?php
    foreach($tv_id->genres as $g){
      $genres .= $g->name . ', ';
    }
    echo substr($genres, 0, -2);
  ?>
</p>
<p class="m-2 text-center"><b style="color: #20c997">Sinopse</b>: <?php echo $tv_id->overview ?></p>
<p class="m-2 text-center"><b style="color: #20c997">Duração do episódio</b>: <?php echo $tv_id->episode_run_time[0] ?> Minutos</p>
<p class="m-2 text-center"><b style="color: #20c997">Criadores</b>: 
  <?php
    foreach($tv_id->created_by as $c){
      $created_by .= $c->name . ', ';
    }
    echo substr($created_by, 0, -2);
  ?>
</p>
<p class="m-2 text-center"><b style="color: #20c997">Idiomas</b>: 
  <?php
    foreach($tv_id->spoken_languages as $sl){
      $spoken_languages .= $sl->english_name . ', ';
    }
    echo substr($spoken_languages, 0, -2);
  ?>
</p>
<p class="m-2 text-center"><b style="color: #20c997">Rede</b>: 
  <?php
    foreach($tv_id->networks as $n){
      $networks .= $n->name . ', ';
    }
    echo substr($networks, 0, -2);
  ?>
</p>
<p class="m-2 text-center"><b style="color: #20c997">Produtoras</b>: 
  <?php
    foreach($tv_id->production_companies as $pc){
      $production_companies .= $pc->name . ', ';
    }
    echo substr($production_companies, 0, -2);
  ?>
</p>
<p class="m-2 text-center"><b style="color: #20c997">Países</b>: 
  <?php
    foreach($tv_id->production_countries as $pco){
      $origin_country .= $pco->name . ', ';
    }
    echo substr($origin_country, 0, -2);
  ?>
</p>
<p class="m-2 text-center"><b style="color: #20c997">Número de temporadas</b>: <?php echo $tv_id->number_of_seasons ?></p>
<p class="m-2 text-center"><b style="color: #20c997">Número de episódios</b>: <?php echo $tv_id->number_of_episodes ?></p>
<p class="m-2 text-center"><b style="color: #20c997">Último episódio</b>: S<?php echo $tv_id->last_episode_to_air->season_number ?>E<?php echo $tv_id->last_episode_to_air->episode_number ?> | <?php echo $tv_id->last_episode_to_air->name ?> | <?php echo $tv_id->last_episode_to_air->overview ?></p>
<p class="m-2 text-center"><b style="color: #20c997">Temporadas</b>: 
  <?php
    echo '<div class="row row-cols-1 row-cols-md-3 g-4">';
    foreach($tv_id->seasons as $s){
      echo '<div class="col">
              <div class="card h-100">
                <img src="http://image.tmdb.org/t/p/w500'. $s->poster_path . '" class="card-img-top" alt="Poster">
              <div class="card-body">
                <h5 class="card-title" style="color: #0dcaf0">'.$s->name.'</h5>
                <p class="card-text text-break" style="color: black"><b style="color: #002A5C">Resumo</b>: '.$s->overview.'</p>
                <p class="card-text text-break" style="color: black"><b style="color: #002A5C">Total de episódios</b>: '.$s->episode_count.'</p>
              </div>
              <div class="card-footer">
                <span class="badge bg-primary">'.$p->vote_average.'</span>
                <small class="text-muted">Data de lançamento: '.date("d/m/Y", strtotime($s->air_date)).'</b></small>
              </div>
            </div>
          </div>';
    }
    echo '</div>';
  ?>
</p>
<p class="m-2 text-center"><b style="color: #20c997">Site</b>: 
  <?php
    if($tv_id->homepage == ""){
      echo "Não disponível";
    }else{
      echo '<a href="'.$tv_id->homepage.'"  style="text-decoration:none">'.$tv_id->homepage.'</a>';
    }
  ?>
</p>
<br>
<h3 class="m-2 text-center" style="color: #d63384">Trailers</h3>
<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <?php
      foreach($tv_video_id->results as $video){
        echo '<div class="carousel-item active"><iframe width="560" height="315" src="'."https://www.youtube.com/embed/".$video->key.'" frameborder="0" allowfullscreen class="rounded d-block w-100"></iframe></div>';
      }
    ?>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Anterior</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Próximo</span>
  </button>
</div>
<br>
<h3 class="m-2 text-center" style="color: #d63384">Séries similares</h3>
<ul>
  <?php
    $count = 4;
    $output="";
    echo '<div class="row row-cols-1 row-cols-md-3 g-4">';
    foreach($tv_id_similar->results as $sim){
      $output.='<div class="col">
                  <div class="card h-100">
                    <img src="http://image.tmdb.org/t/p/w300'.$sim->backdrop_path.'" class="card-img-top" alt="Poster">
                    <div class="card-body">
                    <h5 class="card-title" style="color: #0dcaf0">'.$sim->original_name.' | '.$sim->name.' ('. substr($sim->first_air_date, 0, 4).')'.'</h5>
                      <p class="card-text text-break" style="color: black">'.$sim->overview.'</p>
                      <a href="tvshow.php?id='.$sim->id.'" class="btn btn-primary">Detalhes</a>
                    </div>
                    <div class="card-footer">
                      <small class="text-muted">Data de lançamento: '.date("d/m/Y", strtotime($sim->first_air_date)).'</b></small>
                    </div>
                  </div>
                </div>';
      if($count <=0){
        break;
        $count--;
      }
    }
    echo $output;
    echo '</div>';
  ?>
</ul>
<?php
  }else{
    echo "<h5>Filme não encontrado.</h5>";
  }
?>
    

<?php
  include_once "footer.php";
?>