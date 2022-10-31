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
			<li class="navLi"><a href="#"><img class="navA" src="imagens/facelogo.png"></a></li>
			<li class="navLi"><a href="#"><img class="navA" src="imagens/instalogo.png"></a></li>
			<li class="navLi"><a href="#"><img class="navA" src="imagens/zaplogo.png"></a></li>
			<li class="navLi"><a href="#"><img class="navA" src="imagens/ttlogo.png"></a></li>
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
	<!--Inicio do Painel -->
	<div class="bg"></div>
	<div class="conteiner">
		<div class="widget">
			<div class="left">
				<h3 class="titulot">Sensor 1</h3>
			</div>
			<div class="right">
				<img class="umi-icon" src="imagens/umi.png" alt="">
			</div>
			<div class="bottom">				
				<div>
					<h5><?php echo $dsensor1 ?></h5>
				</div>
			</div>
		</div>
	</div>

	<!--Final do Painel -->

	<script type="text/javascript">
		google.charts.load('current', {
			'packages': ['corechart']
		});
		google.charts.setOnLoadCallback(drawChart);

		function drawChart() {
			var data = google.visualization.arrayToDataTable([
				['Ano', 'Sensor 1', 'Sensor 2', 'Sensor 3', 'Sensor 4'],
				<?php

				$dsql = 'SELECT s.sensor1, s.sensor2, s.sensor3, s.sensor4 FROM sensores s INNER JOIN central c  on s.central_id = c.id_central where c.id_central =' . $sensor . ';';

				$resultado = mysqli_query($conn, $dsql);
				while ($linha = mysqli_fetch_array($resultado)) {
					$dsensor1 = $linha['sensor1'];
					$dsensor2 = $linha['sensor2'];
					$dsensor3 = $linha['sensor3'];
					$dsensor4 = $linha['sensor4'];


				?>

					['20/04', <?php echo $dsensor1;  ?>, <?php echo $dsensor2;  ?>, <?php echo $dsensor3;  ?>, <?php echo $dsensor4;  ?>],

				<?php } ?>

			]);





			var options = {
				title: 'Grafico de Sensores',
				curveType: 'function',
				legend: {
					position: 'bottom'
				}
			};

			var chart = new google.visualization.LineChart(document.getElementById('graficosensor'));

			chart.draw(data, options);
		}
	</script>

	<br><br>
	<!--Grafíco 1 -->
	<div id="graficosensor" style="width: 900px; height: 500px"></div>
	<!--Grafíco 1 -->
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