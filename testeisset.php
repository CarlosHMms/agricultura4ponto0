<!DOCTYPE html>
<html>
	<head>
		<title></title>

	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

	</head>
	<body>
<!-- Gráfico -->
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

          var chart = new google.visualization.LineChart(document.getElementById('graficosensor'));

          chart.draw(data, options);
        }
        
      </script>








		<div id="graficosensor" style="width: 900px; height: 500px"></div>

	</body>
</html>