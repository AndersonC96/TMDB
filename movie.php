<?php
  include "conf/info.php";
  $id_movie = $_GET['id'];
  include_once "api/api_movie_id.php";
  include_once "api/api_movie_video_id.php";
  include_once "api/api_movie_similar.php";
  $title = "$movie_id->original_title";
  include_once "header.php";
?>
<?php
  if(isset($_GET['id'])){
    $id_movie = $_GET['id'];
?>
<h1 class="m-2 text-center"><a style="color: #0dcaf0"><?php echo $movie_id->original_title ?></a> | <a style="color: #0dcaf0"><?php echo $movie_id->title ?></a></h1>
<?php
  echo "<h5 class='m-2 text-center'>".$movie_id->tagline."</h5>";
?>
<img class="rounded mx-auto d-block" src="<?php echo $imgurl_2 ?><?php echo $movie_id->poster_path ?> ">
<p class="m-2 text-center"><b style="color: #20c997">Gêneros</b>: 
  <?php
    foreach($movie_id->genres as $g){
      echo '<span>' . $g->name . ','. '</span> ';
    }
  ?>
</p>
<p class="m-2 text-center"><b style="color: #20c997">Sinopse</b>: <?php echo $movie_id->overview ?></p>
<p class="m-2 text-center"><b style="color: #20c997">Duração</b>: <?php echo $movie_id->runtime ?> Minutos</p>
<p class="m-2 text-center"><b style="color: #20c997">Idiomas</b>: 
  <?php
    foreach($movie_id->spoken_languages as $l){
      echo '<span>' . $l->english_name . ','. '</span> ';
    }
  ?>
</p>
<p class="m-2 text-center"><b style="color: #20c997">Status</b>: 
  <?php
    if($movie_id->status == "Released"){
      echo "Lançado";
    }else{
      echo "Em breve";
    }
  ?>
</p>
<p class="m-2 text-center"><b style="color: #20c997">Lançamento</b>: <?php $rel = date('d/m/Y', strtotime($movie_id->release_date)); echo $rel ?>
<p class="m-2 text-center"><b style="color: #20c997">Produtoras</b>: 
  <?php
    foreach($movie_id->production_companies as $pc){
      echo $pc->name.", ";
    }
  ?>
</p>
<p class="m-2 text-center"><b style="color: #20c997">Países de produção</b>:
  <?php
    foreach($movie_id->production_countries as $pco){
      echo $pco->name. ", ";
    }
  ?>
</p>
<p class="m-2 text-center"><b style="color: #20c997">Orçamento</b>: 
  <?php
    if($movie_id->budget == 0){
      echo "Não disponível";
  }else{
    echo '$ ' . number_format($movie_id->budget, 0, ',', '.');
  }
  ?>
</p>
<p class="m-2 text-center"><b style="color: #20c997">Bilheteria</b>: 
  <?php
    if($movie_id->revenue == 0){
        echo "Não disponível";
    }else{
      echo '$ ' . number_format($movie_id->revenue, 0, ',', '.');
    }
  ?>
</p>
<p class="m-2 text-center"><b style="color: #20c997">Site</b>: 
  <?php
    if($movie_id->homepage == ""){
      echo "Não disponível";
    }else{
      echo '<a href="'.$movie_id->homepage.'"  style="text-decoration:none">'.$movie_id->homepage.'</a>';
    }
  ?>
</p>
<br>
<h3 class="m-2 text-center" style="color: #d63384">Trailers</h3>
<?php
  foreach($movie_video_id->results as $video){
    echo '<iframe width="560" height="315" src="'."https://www.youtube.com/embed/".$video->key.'" frameborder="0" allowfullscreen class="rounded"></iframe> ';
  }
?>
<br>
<h3 class="m-2 text-center" style="color: #d63384">Filmes similares</h3>
<ul>
  <?php
    $count = 4;
    $output="";
    foreach($movie_similar_id->results as $sim){
      $output.='<div class="card text-white bg-dark mb-3" style="width: 18rem;" class="m-2 text-center">
                  <img src="http://image.tmdb.org/t/p/w300'.$sim->backdrop_path.'" class="card-img-top" alt="Poster">
                  <div class="card-body">
                    <h5 class="card-title" style="color: #0dcaf0">'.$sim->title.'</h5>
                    <p class="card-text">'.$sim->overview.'</p>
                    <a href="movie.php?id='.$sim->id.'" class="btn btn-primary">Detalhes</a>
                  </div>
                  <div class="card-footer">
                    <small class="text-muted">Data de lançamento: '.date("d/m/Y", strtotime($sim->release_date)).'</b></small>
                  </div>
                </div>';
      if($count <=0){
        break;
        $count--;
      }
    }
    echo $output;
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