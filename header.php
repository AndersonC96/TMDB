<?php
    error_reporting(E_ERROR | E_PARSE);
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  </head>
  <body class="bg-dark text-light">
    <nav class="navbar navbar-expand-lg navbar navbar-light" style="background-color: #e3f2fd;">
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="popular.php">Filmes populares</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="now-playing.php">Filmes do momento</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="upcoming.php">Em breve</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="tv-series.php">Séries</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="tv-today.php">Séries (Hoje)</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="tv-seriesPopular.php">Séries populares</a>
          </li>
        </ul>
      </div>
      <form class="d-flex" action="search.php" method="get">
        <input class="form-control me-2" type="text" name="search" placeholder="Digite o título aqui" required>
        <select name="channel" required>
          <option value="movie" selected="selected">Filme</option>
          <option value="tv">Série</option>
        </select>
        <button class="btn btn-outline-success" type="submit">Pesquisar</button>
      </form>
    </nav>
    <div class="container p-4">