<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  </head>
  <body>


    <table border="0" class="tabela">
      <tr>
        <th colspan="15"><center>nome</center></th>
      </tr>

      <tr>
        <td>Sensor 1</td>
        <td>Sensor 2</td>
        <td>Sensor 3</td>
        <td>Sensor 4</td>

      </tr>

        <?php  
          
          include "conexao.php";

          $sensor= $_GET["sensor"];
          $dt_inicio = $_GET["datainicio"];
          $dt_fim = $_GET["datafim"];


        ?>

        
          


    <script type="text/javascript">

        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
          var data = google.visualization.arrayToDataTable([
            ['Ano', 'Sensor 1', 'Sensor 2', 'Sensor 3', 'Sensor 4'],
            <?php

              $dsql = 'SELECT s.sensor1, s.sensor2, s.sensor3, s.sensor4 FROM sensores s INNER JOIN central c  on s.central_id = c.id_central where c.id_central ='.$sensor.';';
          
              $resultado = mysqli_query($conn, $dsql);
                while ($linha = mysqli_fetch_array($resultado)){
                  $dsensor1 = $linha['sensor1'];
                  $dsensor2 = $linha['sensor2'];
                  $dsensor3 = $linha['sensor3'];
                  $dsensor4 = $linha['sensor4'];


              ?>

            ['20/04',  <?php echo $dsensor1;  ?>,      <?php echo $dsensor2;  ?>,      <?php echo $dsensor3;  ?>,      <?php echo $dsensor4;  ?>],

            <?php } ?>

          ]);
  




          var options = {
            title: 'Company Performance',
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
