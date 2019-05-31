<!DOCTYPE html>
<html>
<head>
  <title>Home</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
     <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>





    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
<?php
session_start();
  define('DB_SERVER', 'localhost');
  define('DB_USERNAME', 'root');
  define('DB_PASSWORD', '');
  define('DB_DATABASE', 'cadastro_tcc');
  $db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD,DB_DATABASE);

  $query = mysqli_query($db, "SELECT date_format(data,'%d/%m/%Y') data, peso, glicemia FROM acompanhamento WHERE RM =".$_SESSION['RM']);
  $graph = "['Data avaliação', 'Peso KG', 'Glicemia mmlo/l']";
  while($row = mysqli_fetch_array($query)){
    if ($graph<> "") $graph = $graph.",\n";    
  $graph=$graph.'['."'".$row['data']."'".', '.$row['peso'].', '.$row['glicemia']."]";
  }
  mysqli_close($db);
?>

      function drawChart() {
        var data = google.visualization.arrayToDataTable([<?php echo $graph; ?>]);

        var options = {
          title: 'Acompanhe seus dados',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>

     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

<?php
  $db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

  $query = mysqli_query($db, "SELECT date_format(data,'%d/%m/%Y') data, pressao_sis, pressao_dis FROM acompanhamento WHERE RM =".$_SESSION['RM']);


  $graph = "['Data', 'Pressão Sistólica', 'Pressão Diastólica']";
  while($row = mysqli_fetch_array($query)){
    if ($graph<> "") $graph = $graph.",\n";    
  $graph=$graph.'['."'".$row['data']."'".', '.$row['pressao_sis'].', '.$row['pressao_dis']."]";
  }
  mysqli_close($db);

?>

      function drawChart() {
        var data = google.visualization.arrayToDataTable([<?php echo $graph; ?>]);
      

        var options = {
          chart: {
            title: 'Pressão Arterial',
            subtitle: 'Acompanhamento da pressão aferida nos encontros com a enfermagem.',}
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>


</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Health Care</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Pagina Inicial <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Serviços</a>
      </li>
       <li class="nav-item">
        <a class="nav-link" href="#">Sobre</a>
         <li class="nav-item">
        <a class="nav-link" href="#">Contato</a>
      </li>
      </li>
         <li>
            <a href="destroy_session.php" class="btn btn-danger btn-sm active" role="button" aria-pressed="true">Sair</a>

         </li>   
      </li>
     
    </ul>
      </div>
</nav>



<div id="curve_chart" class="col-6"></div>
<div id="columnchart_material" class="col-6" style="width: 800px; height: 500px;"></div>


</body>
</html>