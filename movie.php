<?php
  include "conf/info.php";
  $id_movie = $_GET['id'];// pega o valor do input
  include_once "api/api_movie_id.php";
  include_once "api/api_movie_video_id.php";
  include_once "api/api_movie_similar.php";
  include_once "api/api_movie_recommendations.php";
  $title = "$movie_id->original_title";
  include_once "header.php";
?>
<?php
  if(isset($_GET['id'])){// pega o valor do input
    $id_movie = $_GET['id'];
?>
<h1 class="m-2 text-center"><a style="color: #0dcaf0"><?php echo $movie_id->original_title ?></a> | <a style="color: #0dcaf0"><?php echo $movie_id->title ?></a></h1>
<?php
  echo "<h5 class='m-2 text-center'>".$movie_id->tagline."</h5>";
?>
<img class="rounded mx-auto d-block" src="<?php echo $imgurl_2 ?><?php echo $movie_id->poster_path ?> ">
<p class="m-2 text-center"><b style="color: #20c997">Gêneros</b>:
  <?php
    $genres = $movie_id->genres;
    $last_genre = end($genres); // obtem o último elemento do array
    foreach($genres as $g){
      echo '<span>' . $g->name . '</span>';
      if($g !== $last_genre){
        echo ', '; // adiciona vírgula somente se não for o último gênero
      }
    }
  ?>
</p>
<p class="m-2 text-center"><b style="color: #20c997">Sinopse</b>: <?php echo $movie_id->overview ?></p>
<p class="m-2 text-center"><b style="color: #20c997">Duração</b>: <?php echo $movie_id->runtime ?> Minutos</p>
<p class="m-2 text-center"><b style="color: #20c997">Idiomas</b>: 
  <?php
    foreach($movie_id->spoken_languages as $l){
      $languages .= $l->english_name . ', ';
    }
    echo substr($languages, 0, -2);
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
      $companies .= $pc->name.", ";
    }
    echo substr($companies, 0, -2);
  ?>
</p>
<p class="m-2 text-center"><b style="color: #20c997">Países de produção</b>:
  <?php
    foreach($movie_id->production_countries as $pco){
      $country .= $pco->name.", ";
    }
    echo substr($country, 0, -2);
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
      echo '<a href="'.$movie_id->homepage.'" style="text-decoration:none">Clique aqui</a>';
    }
  ?>
</p>
<p class="m-2 text-center"><b style="color: #20c997">IMDB</b>: 
  <a href="https://www.imdb.com/title/<?php echo $movie_id->imdb_id; ?>" target="_blank" style="text-decoration: none;">
    Clique aqui
  </a>
</p>
<p class="m-2 text-center"><b style="color: #20c997">Streaming</b>: 
  <?php
    $id_movie = $_GET['id'];
    $apikey = "80b747723113ce82af58357242c61035";
    $url = "http://api.themoviedb.org/3/movie/".$id_movie."/watch/providers?api_key=" . $apikey . "&language=pt-BR";
    $response = file_get_contents($url);
    $data = json_decode($response);
    if($BR_providers = $data->results->BR->flatrate == null){
      echo "Não disponível";
    }else{
      $BR_providers = $data->results->BR->flatrate;
      $provider_names = array();
      foreach($BR_providers as $provider){
        array_push($provider_names, $provider->provider_name);
      }
      echo implode(", ", $provider_names);
    }
  ?>
</p>
<p class="m-2 text-center"><b style="color: #20c997">Compra</b>: 
  <?php
    $id_movie = $_GET['id'];
    $apikey = "80b747723113ce82af58357242c61035";
    $url = "http://api.themoviedb.org/3/movie/".$id_movie."/watch/providers?api_key=" . $apikey . "&language=pt-BR";
    $response = file_get_contents($url);
    $data = json_decode($response);
    if($BR_providers = $data->results->BR->buy == null){
      echo "Não disponível";
    }else{
      $BR_providers = $data->results->BR->buy;
      $provider_names = array();
      foreach($BR_providers as $provider){
        array_push($provider_names, $provider->provider_name);
      }
      echo implode(", ", $provider_names);
    }
  ?>
</p>
<p class="m-2 text-center"><b style="color: #20c997">Aluguel</b>: 
  <?php
    $id_movie = $_GET['id'];
    $apikey = "80b747723113ce82af58357242c61035";
    $url = "http://api.themoviedb.org/3/movie/".$id_movie."/watch/providers?api_key=" . $apikey . "&language=pt-BR";
    $response = file_get_contents($url);
    $data = json_decode($response);
    if($BR_providers = $data->results->BR->rent == null){
      echo "Não disponível";
    }else{
      $BR_providers = $data->results->BR->rent;
      $provider_names = array();
      foreach($BR_providers as $provider){
        array_push($provider_names, $provider->provider_name);
      }
      echo implode(", ", $provider_names);
    }
  ?>
</p>
<br>
<h3 class="m-2 text-center" style="color: #d63384">Trailers</h3>
<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <?php
      foreach($movie_video_id->results as $video){
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
<h3 class="m-2 text-center" style="color: #d63384">Filmes similares</h3>
<ul>
  <?php
    $count = 4;
    $output="";
    echo '<div class="row row-cols-1 row-cols-md-3 g-4">';
    foreach($movie_similar_id->results as $sim){
      $output.='<div class="col">
                  <div class="card h-100">
                    <img src="http://image.tmdb.org/t/p/w300'.$sim->backdrop_path.'" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title" style="color: #0dcaf0">'.$sim->title.'</h5>
                      <p class="card-text text-break" style="color: black">'.$sim->overview.'</p>
                      <a href="movie.php?id='.$sim->id.'" class="btn btn-primary">Detalhes</a>
                    </div>
                    <div class="card-footer">
                      <span class="badge bg-primary">'.$sim->vote_average.'</span>
                      <small class="text-muted">Data de lançamento: '.date("d/m/Y", strtotime($sim->release_date)).'</b></small>
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
<br>
<h3 class="m-2 text-center" style="color: #d63384">Recomendações</h3>
<ul>
  <?php
    $count = 4;
    $output="";
    echo '<div class="row row-cols-1 row-cols-md-3 g-4">';
    foreach($movie_recommendations_id->results as $rec){
      $output.='<div class="col">
                  <div class="card h-100">
                    <img src="http://image.tmdb.org/t/p/w300'.$rec->backdrop_path.'" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title" style="color: #0dcaf0">'.$rec->title.'</h5>
                      <p class="card-text text-break" style="color: black">'.$rec->overview.'</p>
                      <a href="movie.php?id='.$rec->id.'" class="btn btn-primary">Detalhes</a>
                    </div>
                    <div class="card-footer">
                      <span class="badge bg-primary">'.$rec->vote_average.'</span>
                      <small class="text-muted">Data de lançamento: '.date("d/m/Y", strtotime($rec->release_date)).'</b></small>
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
  include_once "footer.php";
?>