<!DOCTYPE html>
<html>

<head>
	<title>Informações detalhadas</title>
	<link rel="stylesheet" href="css/stylepage2.css">
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<!-- CSS Bootstrap -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous"> <!-- JavaScript Bundle with Popper -->
</head>

<header class="navbar">
	<a class="logolink" href="index.php"><img class="logo" src="imagens/logotipo2.png" alt="Instituto Ferderal Goiano - Campus Ceres"></a>
	<nav class="navp">
		<ul class="navUnlist">
		</ul>
	</nav>
</header>

<body>
	<?php
	include "conexao.php";

	$dt_inicio = $_GET["datainicio"];
	$dt_fim = $_GET["datafim"];
	$sensor = $_GET["sensor"];

	$sql = "SELECT DISTINCT nome FROM central c INNER JOIN sensores s ON s.central_id = c.id_central where c.id_central =" . $sensor . ";";
	$result = mysqli_query($conn, $sql);
	$linha = mysqli_fetch_array($result);
	$nome = $linha['nome'];



	$sql = "SELECT s.*, c.* FROM sensores s JOIN central c ON s.central_id = c.id_central and s.id = (SELECT max(id) FROM sensores WHERE sensores.central_id = c.id_central);";
	$resultado = mysqli_query($conn, $sql);
	while ($linha = mysqli_fetch_array($resultado)) {
		$dsensor1 = $linha['sensor1'];
		$dsensor2 = $linha['sensor2'];
		$dsensor3 = $linha['sensor3'];
		$dsensor4 = $linha['sensor4'];
		$dtemperatura = $linha['temperatura'];
		$dumidade = $linha['umidade'];
	}
	?>
	<div class="bg">
		<!--Inicio do Painel 1-->
		<div class="conteiner">
			<div class="widget">
				<div class="left">
					<h3 class="titulot">Sensor 1</h3>
				</div>
				<div class="right">
					<img class="solo-icon" src="imagens/senssolo.png" alt="">
				</div>
				<div class="bottom">
					<div class="motion">
						<h5><?php echo $dsensor1 ?></h5>
					</div>
				</div>
			</div>
		</div>
		<!--Final do Painel 2-->
		<!--Inicio Painel 2-->
		<div class="conteiner2">
			<div class="widget">
				<div class="left">
					<h3 class="titulot">Sensor 2</h3>
				</div>
				<div class="right">
					<img class="solo-icon" src="imagens/senssolo.png" alt="">
				</div>
				<div class="bottom">
					<div class="motion">
						<h5><?php echo $dsensor2 ?></h5>
					</div>
				</div>
			</div>
		</div>
		<!--Final do Painel 2-->
		<!--Inicio Painel 3-->
		<div class="conteiner3">
			<div class="widget">
				<div class="left">
					<h3 class="titulot">Sensor 3</h3>
				</div>
				<div class="right">
					<img class="solo-icon" src="imagens/senssolo.png" alt="">
				</div>
				<div class="bottom">
					<div class="motion">
						<h5><?php echo $dsensor3 ?></h5>
					</div>
				</div>
			</div>
		</div>
		<!--Final do Painel 3-->
		<!--Inicio Painel 4-->
		<div class="conteiner4">
			<div class="widget">
				<div class="left">
					<h3 class="titulot">Sensor 4</h3>
				</div>
				<div class="right">
					<img class="solo-icon" src="imagens/senssolo.png" alt="">
				</div>
				<div class="bottom">
					<div class="motion">
						<h5 style="color: white;"><?php echo $dsensor4 ?></h5>
					</div>
				</div>
			</div>
		</div>
		<!--Final do Painel 4-->
	</div>
	<!--Painel Climatico Temperatura -->

	<div class="bg2">
		<div class="conteinerClima">
			<div class="widgetClima">
				<div class="leftClima">
					<h3>Temperatura: </h3>
				</div>
				<div class="rightClima">
					<img class="logoClima" src="imagens/term.png" alt="">
					<span style="color: white;"><?php echo $dtemperatura ?> C°</span>
				</div>
			</div>
		</div>

		<!--Fim do Painel Climatico-->
		<!--Painel Climatico Temperatura -->

		<div class="conteinerUmi">
			<div class="widgetClima">
				<div class="leftClima">
					<h3>Umidade:</h3>
				</div>
				<div class="rightClima">
					<img class="logoClima" src="imagens/umi.png" alt="">
					<span style="color: white;"><?php echo $dumidade ?>%</span>
				</div>
			</div>
		</div>
	</div>

	<!--Fim do Painel Climatico-->

			<form action="http://localhost/Agricultura4ponto0/testeisset.php?" method="GET">
			Sensor 1: <input type="checkbox" name="sensor1" value="1"><br>
			Sensor 2: <input type="checkbox" name="sensor2" value="1"><br>
			Sensor 3: <input type="checkbox" name="sensor3" value="1"><br>
			Sensor 4: <input type="checkbox" name="sensor4" value="1"><br>
			Data Inicio: <input type="date" name="datainicio"><br>
			Data Fim: <input type="date" name="datafim"><br>

			<input type="submit" value="enviar"><br>

		</form>

		<?php
			include "conexao.php";
  		
         $sensor= 1;

      if (isset($_GET["datainicio"]) && isset($_GET["datafim"])){
			   $dt_inicio = $_GET["datainicio"];
         $dt_fim = $_GET["datafim"];
      }
      else{
         $dt_inicio = '';
         $dt_fim = '';
      }

      if (isset($_GET["sensor1"]) || isset($_GET["sensor2"]) || isset($_GET["sensor3"]) || isset($_GET["sensor4"]) ){
        
        if(isset($_GET["sensor1"])){

    			$sensor1= $_GET["sensor1"];

        }
        else{
          $sensor1='0';        
        }

        if(isset($_GET["sensor2"])){

          $sensor2= $_GET["sensor2"];

        }
        else{
          $sensor2='0';        
        }

        if(isset($_GET["sensor3"])){

          $sensor3= $_GET["sensor3"];

        }
        else{
          $sensor3='0';        
        }

        if(isset($_GET["sensor4"])){

          $sensor4= $_GET["sensor4"];

        }
        else{
          $sensor4='0';        
        }
      }
      else{
          $sensor1 = '1';
          $sensor2 = '1';
          $sensor3 = '1';
          $sensor4 = '1';
      }

		?>
    <script type="text/javascript">

        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
          var data = google.visualization.arrayToDataTable([
            ['Ano' 
            <?php if($sensor1 == '1'){echo ", 'Sensor 1'";}else{}?>
            <?php if($sensor2 == '1'){echo ", 'Sensor 2'";}else{}?>
            <?php if($sensor3 == '1'){echo ", 'Sensor 3'";}else{}?>
            <?php if($sensor4 == '1'){echo ", 'Sensor 4'";}else{}?>

            ],

            <?php
           
            	if($dt_inicio != "" and $dt_fim != "" ){

          			$dsql = 'SELECT s.sensor1, s.sensor2, s.sensor3, s.sensor4, DATE_FORMAT(s.DT,"%d") as dia, DATE_FORMAT(s.DT,"%m") as mes, DATE_FORMAT(s.DT,"%y") as ano, DATE_FORMAT(s.DT,"%H") as hora, DATE_FORMAT(s.DT,"%i") as minuto ,c.nome FROM sensores s INNER JOIN central c  on s.central_id = c.id_central where c.id_central ='.$sensor.' AND s.DT>"'.$dt_inicio.' 00:00:00" AND s.DT<"'.$dt_fim.' 23:59:59" ;';
            	}
            	elseif($dt_inicio == "" and $dt_fim == ""){

      					$dsql = 'SELECT s.sensor1, s.sensor2, s.sensor3, s.sensor4, DATE_FORMAT(s.DT,"%d") as dia, DATE_FORMAT(s.DT,"%m") as mes, DATE_FORMAT(s.DT,"%y") as ano, DATE_FORMAT(s.DT,"%H") as hora, DATE_FORMAT(s.DT,"%i") as minuto ,c.nome FROM sensores s INNER JOIN central c  on s.central_id = c.id_central where c.id_central ='.$sensor.';';
            	}
            	elseif($dt_inicio != "" and $dt_fim == ""){
            		$dsql = 'SELECT s.sensor1, s.sensor2, s.sensor3, s.sensor4, DATE_FORMAT(s.DT,"%d") as dia, DATE_FORMAT(s.DT,"%m") as mes, DATE_FORMAT(s.DT,"%y") as ano, DATE_FORMAT(s.DT,"%H") as hora, DATE_FORMAT(s.DT,"%i") as minuto ,c.nome FROM sensores s INNER JOIN central c  on s.central_id = c.id_central where c.id_central ='.$sensor.' AND s.DT>"'.$dt_inicio.' 00:00:00";';
            	}	
            	else{
            		$dsql = 'SELECT s.sensor1, s.sensor2, s.sensor3, s.sensor4, DATE_FORMAT(s.DT,"%d") as dia, DATE_FORMAT(s.DT,"%m") as mes, DATE_FORMAT(s.DT,"%y") as ano, DATE_FORMAT(s.DT,"%H") as hora, DATE_FORMAT(s.DT,"%i") as minuto ,c.nome FROM sensores s INNER JOIN central c  on s.central_id = c.id_central where c.id_central ='.$sensor.' AND s.DT<"'.$dt_fim.' 23:59:59" ;';
            	}


            $resultado = mysqli_query($conn, $dsql);
            while ($linha = mysqli_fetch_array($resultado)){
            	if($sensor1 == '1'){$dsensor1 = $linha['sensor1'];}else{}
            	if($sensor2 == '1'){$dsensor2 = $linha['sensor2'];}else{}
            	if($sensor3 == '1'){$dsensor3 = $linha['sensor3'];}else{}
            	if($sensor4 == '1'){$dsensor4 = $linha['sensor4'];}else{}
			?>
              	['20/04'  
              	<?php 
              		if($sensor1 == '1'){echo ",". $dsensor1; }else{}
              		if($sensor2 == '1'){echo ",". $dsensor2; }else{}
              		if($sensor3 == '1'){echo ",". $dsensor3; }else{}
              		if($sensor4 == '1'){echo ",". $dsensor4; }else{}
              	?> ],
        <?php
            	
            }
          	
       	?>
          		]);

          var options = {
            title: 'Grafico de Sensores',
            curveType: 'function',
            legend: { position: 'bottom' }
          };

          var chart = new google.visualization.LineChart(document.getElementById('graficosensor2'));

          chart.draw(data, options);
        }
        
      </script>
	  <!--Grafíco 2 --> <div id="graficosensor2" style="width: 90vh; height: 500px"></div>
	<center>
		<div>
			<table border="0" class="tabela">
				<tr>
					<th colspan="15">
						<center><?php echo $nome;  ?></center>
					</th>
				</tr>

				<tr>
					<td>Sensor 1</td>
					<td>Sensor 2</td>
					<td>Sensor 3</td>
					<td>Sensor 4</td>
					<td>Temperatura</td>
					<td>Umidade</td>
					<td>Dia</td>
					<td>Mes</td>
					<td>ano</td>
					<td>Horas</td>
					<td>Minutos</td>
					<td>Status1</td>
					<td>Status2</td>
					<td>Status3</td>
					<td>Status4</td>

				</tr>
				<?php

				$dt_inicio = $_GET["datainicio"];
				$dt_fim = $_GET["datafim"];



				if ($dt_inicio != "" and $dt_fim != "") {
					$sql = 'SELECT s.id, s.sensor1, s.sensor2, s.sensor3, s.sensor4, s.temperatura, s.umidade, s.status1, s.status2, s.status3, s.status4, DATE_FORMAT(s.DT,"%d") as dia, DATE_FORMAT(s.DT,"%m") as mes, DATE_FORMAT(s.DT,"%y") as ano, DATE_FORMAT(s.DT,"%H") as hora, DATE_FORMAT(s.DT,"%i") as minuto ,c.nome FROM sensores s INNER JOIN central c  on s.central_id = c.id_central where c.id_central =' . $sensor . ' AND s.DT>"' . $dt_inicio . ' 00:00:00" AND s.DT<"' . $dt_fim . ' 23:59:59" ;';
				} elseif ($dt_inicio == "" and $dt_fim == "") {
					$sql = 'SELECT s.id, s.sensor1, s.sensor2, s.sensor3, s.sensor4, s.temperatura, s.umidade, s.status1, s.status2, s.status3, s.status4, DATE_FORMAT(s.DT,"%d") as dia, DATE_FORMAT(s.DT,"%m") as mes, DATE_FORMAT(s.DT,"%y") as ano, DATE_FORMAT(s.DT,"%H") as hora, DATE_FORMAT(s.DT,"%i") as minuto ,c.nome FROM sensores s INNER JOIN central c  on s.central_id = c.id_central where c.id_central =' . $sensor . ';';
				} elseif ($dt_inicio != "" and $dt_fim == "") {
					$sql = 'SELECT s.id, s.sensor1, s.sensor2, s.sensor3, s.sensor4, s.temperatura, s.umidade, s.status1, s.status2, s.status3, s.status4, DATE_FORMAT(s.DT,"%d") as dia, DATE_FORMAT(s.DT,"%m") as mes, DATE_FORMAT(s.DT,"%y") as ano, DATE_FORMAT(s.DT,"%H") as hora, DATE_FORMAT(s.DT,"%i") as minuto ,c.nome FROM sensores s INNER JOIN central c  on s.central_id = c.id_central where c.id_central =' . $sensor . ' AND s.DT>"' . $dt_inicio . ' 00:00:00";';
				} else {
					$sql = 'SELECT s.id, s.sensor1, s.sensor2, s.sensor3, s.sensor4, s.temperatura, s.umidade, s.status1, s.status2, s.status3, s.status4, DATE_FORMAT(s.DT,"%d") as dia, DATE_FORMAT(s.DT,"%m") as mes, DATE_FORMAT(s.DT,"%y") as ano, DATE_FORMAT(s.DT,"%H") as hora, DATE_FORMAT(s.DT,"%i") as minuto ,c.nome FROM sensores s INNER JOIN central c  on s.central_id = c.id_central where c.id_central =' . $sensor . ' AND s.DT<"' . $dt_fim . ' 23:59:59" ;';
				}

				$resultado = mysqli_query($conn, $sql);
				while ($linha = mysqli_fetch_array($resultado)) {
					$id = $linha['id'];
					$sensor1 = $linha['sensor1'];
					$sensor2 = $linha['sensor2'];
					$sensor3 = $linha['sensor3'];
					$sensor4 = $linha['sensor4'];
					$temperatura = $linha['temperatura'];
					$umidade = $linha['umidade'];
					$nome = $linha['nome'];
					$dia = $linha['dia'];
					$mes = $linha['mes'];
					$ano = $linha['ano'];
					$hora = $linha['hora'];
					$minuto = $linha['minuto'];
					$status1 = $linha['status1'];
					$status2 = $linha['status2'];
					$status3 = $linha['status3'];
					$status4 = $linha['status4'];
				?>

					<tr>
						<td><?php echo $sensor1;  ?></td>
						<td><?php echo $sensor2;  ?></td>
						<td><?php echo $sensor3;  ?></td>
						<td><?php echo $sensor4;  ?></td>
						<td><?php echo $temperatura;  ?></td>
						<td><?php echo $umidade;  ?></td>

						<td><?php echo $dia;  ?></td>
						<td><?php echo $mes;  ?></td>
						<td><?php echo $ano;  ?></td>
						<td><?php echo $hora;  ?></td>
						<td><?php echo $minuto;  ?></td>
						<td><?php echo $status1;  ?></td>
						<td><?php echo $status2;  ?></td>
						<td><?php echo $status3;  ?></td>
						<td><?php echo $status4;  ?></td>
					<?php } ?>
					</tr>
			</table>
		</div>
	</center>


</body>

</html>