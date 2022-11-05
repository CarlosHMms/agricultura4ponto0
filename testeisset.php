<!DOCTYPE html>
<html>

<head>
  <title></title>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

</head>

<body>
  <link rel="stylesheet" href="css/iframe.css">
  <!-- Gráfico -->
  <form action="http://localhost/Agricultura4ponto0/testeisset.php" method="GET">
    <div class="datas">
      <label>
        <span>Data Inicio </span> <input type="date" name="datainicio">
      </label>
      <label>
        <span>Data Fim </span> <input type="date" name="datafim">
      </label>
    </div>
    <div class="englobe">

      <div class="conteiner">
        <label class="switch">
          <span class="switch-text">Sensor 1 </span>
          <div class="switch-wrapper">
            <input type="checkbox" name="sensor1" value="1"><span class="switch-button"></span>
          </div>
        </label>
      </div>
      <div class="conteiner">
        <label class="switch">
          <span class="switch-text">Sensor 2</span>
          <div class="switch-wrapper">
            <input type="checkbox" name="sensor2" value="1"><span class="switch-button"></span>
          </div>
        </label>
      </div>
      <div class="conteiner">
        <label class="switch">
          <span class="switch-text">Sensor 3</span>
          <div class="switch-wrapper">
            <input type="checkbox" name="sensor3" value="1"><span class="switch-button"></span>
          </div>
        </label>
      </div>
      <div class="conteiner">
        <label class="switch">
          <span class="switch-text">Sensor 4</span>
          <div class="switch-wrapper">
            <input type="checkbox" name="sensor4" value="1"><span class="switch-button"></span>
          </div>
        </label>
      </div>
      <div class="button-submit">
        <label>
          <input type="submit" value="Confirmar"><br>
        </label>
      </div>
    </div>

  </form>

  <?php
  include "conexao.php";

  $sensor = 1;

  if (isset($_GET["datainicio"]) && isset($_GET["datafim"])) {
    $dt_inicio = $_GET["datainicio"];
    $dt_fim = $_GET["datafim"];
  } else {
    $dt_inicio = '';
    $dt_fim = '';
  }

  if (isset($_GET["sensor1"]) || isset($_GET["sensor2"]) || isset($_GET["sensor3"]) || isset($_GET["sensor4"])) {

    if (isset($_GET["sensor1"])) {

      $sensor1 = $_GET["sensor1"];
    } else {
      $sensor1 = '0';
    }

    if (isset($_GET["sensor2"])) {

      $sensor2 = $_GET["sensor2"];
    } else {
      $sensor2 = '0';
    }

    if (isset($_GET["sensor3"])) {

      $sensor3 = $_GET["sensor3"];
    } else {
      $sensor3 = '0';
    }

    if (isset($_GET["sensor4"])) {

      $sensor4 = $_GET["sensor4"];
    } else {
      $sensor4 = '0';
    }
  } else {
    $sensor1 = '1';
    $sensor2 = '1';
    $sensor3 = '1';
    $sensor4 = '1';
  }

  ?>




  <script type="text/javascript">
    google.charts.load('current', {
      'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ['dados'
          <?php if ($sensor1 == '1') {
            echo ", 'Sensor 1'";
          } else {
          } ?>
          <?php if ($sensor2 == '1') {
            echo ", 'Sensor 2'";
          } else {
          } ?>
          <?php if ($sensor3 == '1') {
            echo ", 'Sensor 3'";
          } else {
          } ?>
          <?php if ($sensor4 == '1') {
            echo ", 'Sensor 4'";
          } else {
          } ?>

        ],

        <?php

        if ($dt_inicio != "" and $dt_fim != "") {

          $dsql = 'SELECT s.sensor1, s.sensor2, s.sensor3, s.sensor4, DATE_FORMAT(s.DT,"%d") as dia, DATE_FORMAT(s.DT,"%m") as mes, DATE_FORMAT(s.DT,"%y") as ano, DATE_FORMAT(s.DT,"%H") as hora, DATE_FORMAT(s.DT,"%i") as minuto ,c.nome FROM sensores s INNER JOIN central c  on s.central_id = c.id_central where c.id_central =' . $sensor . ' AND s.DT>"' . $dt_inicio . ' 00:00:00" AND s.DT<"' . $dt_fim . ' 23:59:59" ;';
        } elseif ($dt_inicio == "" and $dt_fim == "") {

          $dsql = 'SELECT s.sensor1, s.sensor2, s.sensor3, s.sensor4, DATE_FORMAT(s.DT,"%d") as dia, DATE_FORMAT(s.DT,"%m") as mes, DATE_FORMAT(s.DT,"%y") as ano, DATE_FORMAT(s.DT,"%H") as hora, DATE_FORMAT(s.DT,"%i") as minuto ,c.nome FROM sensores s INNER JOIN central c  on s.central_id = c.id_central where c.id_central =' . $sensor . ';';
        } elseif ($dt_inicio != "" and $dt_fim == "") {
          $dsql = 'SELECT s.sensor1, s.sensor2, s.sensor3, s.sensor4, DATE_FORMAT(s.DT,"%d") as dia, DATE_FORMAT(s.DT,"%m") as mes, DATE_FORMAT(s.DT,"%y") as ano, DATE_FORMAT(s.DT,"%H") as hora, DATE_FORMAT(s.DT,"%i") as minuto ,c.nome FROM sensores s INNER JOIN central c  on s.central_id = c.id_central where c.id_central =' . $sensor . ' AND s.DT>"' . $dt_inicio . ' 00:00:00";';
        } else {
          $dsql = 'SELECT s.sensor1, s.sensor2, s.sensor3, s.sensor4, DATE_FORMAT(s.DT,"%d") as dia, DATE_FORMAT(s.DT,"%m") as mes, DATE_FORMAT(s.DT,"%y") as ano, DATE_FORMAT(s.DT,"%H") as hora, DATE_FORMAT(s.DT,"%i") as minuto ,c.nome FROM sensores s INNER JOIN central c  on s.central_id = c.id_central where c.id_central =' . $sensor . ' AND s.DT<"' . $dt_fim . ' 23:59:59" ;';
        }


        $resultado = mysqli_query($conn, $dsql);
        while ($linha = mysqli_fetch_array($resultado)) {
          if ($sensor1 == '1') {
            $dsensor1 = $linha['sensor1'];
          } else {
          }
          if ($sensor2 == '1') {
            $dsensor2 = $linha['sensor2'];
          } else {
          }
          if ($sensor3 == '1') {
            $dsensor3 = $linha['sensor3'];
          } else {
          }
          if ($sensor4 == '1') {
            $dsensor4 = $linha['sensor4'];
          } else {
          }
          $dia = $linha['dia'];
          $mes = $linha['mes'];
          $hora = $linha['hora'];
          $minuto = $linha['minuto'];

        ?>['<?php echo $dia . "/" . $mes . " " . $hora . ":" . $minuto; ?>'
            <?php
            if ($sensor1 == '1') {
              echo "," . $dsensor1;
            } else {
            }
            if ($sensor2 == '1') {
              echo "," . $dsensor2;
            } else {
            }
            if ($sensor3 == '1') {
              echo "," . $dsensor3;
            } else {
            }
            if ($sensor4 == '1') {
              echo "," . $dsensor4;
            } else {
            }
            ?>],
        <?php

        }

        ?>
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








  <div id="graficosensor" style="width: 900px; height: 500px"></div>

</body>

</html>