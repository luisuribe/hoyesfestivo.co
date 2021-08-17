<?php 
$db      = new SQLite3('./holidays');
$now     = new DateTime(date('Y-m-d'));
$query   = "SELECT * FROM holidays WHERE holiday_date >= '".$now->format('Y-m-d')."'";
$results = $db->query($query);


function getDayName($date){
  $days = [
    'domingo',
    'lunes',
    'martes',
    'mi&eacute;rcoles',
    'jueves',
    'viernes',
    's&aacute;bado',
    'domingo'
  ]; 
  return $days[date('w', $date)];
}

function getMonthName($date){
  $months = [
    'enero',
    'febrero',
    'marzo',
    'abril',
    'mayo',
    'junio',
    'julio',
    'agosto',
    'septiembre',
    'octubre',
    'noviembre',
    'diciembre'
  ];
  return $months[date('n', $date)-1];
}

function getDayNumber($date){
  return date('j', $date);
}

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>hoyesfestivo.co - todos los festivos de colombia en un solo sitio</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/pricing/">

    
    <!-- Bootstrap core CSS -->
    
    <link href="css/calendar.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    <script type="text/javascript" src="js/calendar.js"></script>

  </head>
  <body>
    
<div class="container py-3">
  <header>
    <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
      <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
        <span class="fs-4">hoyesfestivo.co</span>
      </a>

      <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
        <a class="me-3 py-2 text-dark text-decoration-none" href="#">home</a>
        <a class="me-3 py-2 text-dark text-decoration-none" href="/api">api</a>
      </nav>
    </div>

    <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
      <?php 
      $row = $results->fetchArray() ;
      $holiday_date = new DateTime($row['holiday_date']);
      if ( $now->format('Y-m-d') == $holiday_date->format('Y-m-d') ) {
      ?>
      <h1 class="display-4 fw-normal">SI!</h1>
      <p class="fs-5 text-muted">Hoy ES festivo en Colombia</p>
      <?php } else { ?>
      <h1 class="display-4 fw-normal">NO!</h1>
      <p class="fs-5 text-muted">Hoy no es festivo en Colombia</p>
      <?php } 
      $results->reset() ?> 
    </div>
  </header>

  <main>
    <div class="row row-cols-1 row-cols-md-2 mb-3 text-center">
      <div class="col">
        <div class="card mb-4 rounded-3 shadow-sm">
          <div class="card-header py-3">
            <h4 class="my-0 fw-normal">Pr&oacute;ximos festivos</h4>
          </div>
          <div class="card-body">
            <table class="table table-striped">
              <tbody>
                <?php while ($row = $results->fetchArray()) { 
                $holiday_date = new DateTime($row['holiday_date']);
                $difference = $now->diff($holiday_date);
                ?>
                <tr>
                  <td>
                    <?php echo getMonthName(strtotime($row['holiday_date'])) ?>
                    <?php echo getDayNumber(strtotime($row['holiday_date'])) ?>,&nbsp;
                    <?php echo getDayName(strtotime($row['holiday_date'])) ?>
                    <br>
                    (<?php echo $row['holiday_name'] ?>)
                  </td>
                  <td>
                    <?php if ($difference->days == 1) { ?> (es ma&ntilde;ana!)
                    <?php } else { ?>
                    (faltan <?php echo $difference->days ?> d&iacute;as)
                    <?php } ?>
                  </td>
                </tr>
                <?php } ?>
              </tbody>
            </table>          
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card mb-4 rounded-3 shadow-sm">
          <div class="card-header py-3">
            <h4 class="my-0 fw-normal">Calendario de festivos (solo 2021)</h4>
          </div>
          <div class="card-body">
            <div class="calendar-wrapper">
              <button id="btnPrev" type="button">Atr&acute;s</button>
              <button id="btnNext" type="button">Adelante</button>
              <div id="divCal"></div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </main>

  <footer class="pt-4 my-md-5 pt-md-5 border-top">
    <div class="row">
      <div class="col-12 col-md">
        <small class="d-block mb-3 text-muted">&copy; 2017–2021</small>
      </div>
      <div class="col-6 col-md">
        <h5>Stuff</h5>
        <ul class="list-unstyled text-small">
          <li class="mb-1"><a class="link-secondary text-decoration-none" href="/api">API</a></li>
          <li class="mb-1"><a class="link-secondary text-decoration-none" href="https://github.com/luisuribe/hoyesfestivo.co/issues" target="new">Issues / bugs</a></li>
        </ul>
      </div>
    </div>
  </footer>
</div>


    
  </body>
</html>
