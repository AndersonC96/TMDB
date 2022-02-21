<?php
	$input=$_GET['search'];// pega o valor do input
	$channel=$_GET['channel'];
	$search=$input;
	include_once "conf/info.php";// inclui o arquivo de configuração
	$title = 'Resultados para '.$input;// titulo da pagina
	include_once "header.php";// inclui o cabeçalho
	include_once "api/api_search.php";// inclui o arquivo de configuração
?>
<h3>Resultados para: <em><?php echo $input?></em></h3>
<ul>
	<?php
		if($channel=="movie"){// se o canal for movie
			echo '<div class="row row-cols-1 row-cols-md-3 g-4">';// inicia a div row
			foreach($search->results as $results){// foreach para cada resultado
				$title 		= $results->title;// titulo do filme
				$id 		= $results->id;// id do filme
				$release	= $results->release_date;// data de lançamento
				if(!empty($release) && !is_null($release)){// se a data de lançamento não for vazia
					$tempyear 	= explode("-", $release);// separa a data de lançamento em ano e mês
					$year 		= $tempyear[0];// ano
					if(!is_null($year)){// se o ano não for nulo
						$title = $title.' ('.$year.')';// adiciona o ano ao titulo
					}
				}
				$backdrop 	= $results->backdrop_path;// backdrop do filme
				if(empty($backdrop) && is_null($backdrop)){// se o backdrop não for vazio
					$backdrop =  dirname($_SERVER['PHP_SELF']).'/image/no-gambar.jpg';// adiciona a imagem de não existir backdrop
				}else{
					$backdrop = 'http://image.tmdb.org/t/p/w300'.$backdrop;// adiciona o link do backdrop
				}
				echo '<div class="col">
						<div class="card h-100">
							<img src="'.$backdrop.'" class="card-img-top" alt="Poster">
							<div class="card-body">
								<h5 class="card-title" style="color: #0dcaf0">'. $results->original_title . ' | '. $title .'</h5>
								<p class="card-text text-break" style="color: black">'.$results->overview.'</p>
								<a href="movie.php?id='.$results->id.'" class="btn btn-primary">Detalhes</a>
							</div>
							<div class="card-footer">
								<span class="badge bg-primary">'.$results->vote_average.'</span>
								<small class="text-muted">Data de lançamento: '.date("d/m/Y", strtotime($results->release_date)).'</b></small>
							</div>
						</div>
					</div>';
			}
		}elseif($channel=="tv"){// se o canal for tv
			echo '<div class="row row-cols-1 row-cols-md-3 g-4">';// inicia a div row
			foreach($search->results as $results){// foreach para cada resultado
				$title 		= $results->original_name;// titulo da serie
				$id 		= $results->id;// id da serie
				$release	= $results->first_air_date;// data de lançamento
				if(!empty($release) && !is_null($release)){// se a data de lançamento não for vazia
					$tempyear 	= explode("-", $release);// separa a data de lançamento em ano e mês
					$year 		= $tempyear[0];// ano
					if(!is_null($year)){// se o ano não for nulo
						$title = $title.' ('.$year.')';// adiciona o ano ao titulo
					}
				}
				$backdrop 	= $results->backdrop_path;// backdrop da serie
				if(empty($backdrop) && is_null($backdrop)){// se o backdrop não for vazio
					$backdrop = $pathloc.'image/no-backdrop.png';// adiciona a imagem de não existir backdrop
				}else{// se o backdrop não for vazio
					$backdrop = 'http://image.tmdb.org/t/p/w300'.$backdrop;// adiciona o link do backdrop
				}
				echo '<div class="col">
						<div class="card h-100">
							<img src="'.$backdrop.'" class="card-img-top" alt="'.$results->original_name.'">
							<div class="card-body">
								<h5 class="card-title" style="color: #0dcaf0">'.$results->name.' | ' .$title.'</h5>
								<p class="card-text text-break" style="color: black">'.$results->overview.'</p>
								<a href="tvshow.php?id='.$results->id.'" class="btn btn-primary">Detalhes</a>
							</div>
							<div class="card-footer">
								<span class="badge bg-primary">'.$results->vote_average.'</span>
								<small class="text-muted">Estreia: '.date("d/m/Y", strtotime($results->first_air_date)).'</b></small>
							</div>
						</div>
					</div>';
			}
		}
		echo '</div>';
	?>
</ul>
<?php
	include_once('footer.php');// inclui o footer
?>
