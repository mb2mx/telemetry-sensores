<?php
 
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');
//-------------------------------------------------------------------------------------------
require 'php/gauge/config.php';

$name = json_decode($_COOKIE['client'], true);

$cdClient = $name["code"];
$cdDevice = $name["code_device"];

$sql = "SELECT dr.created_at as created_date, 
sum(case when dr.id_sensor = (select id_sensor from sensor s where code='S-TEMP') then valor  else 0 end) as temperature,
  sum(case when dr.id_sensor = (select id_sensor from sensor s where code='S-HUM') then valor else 0 end) as humidity,
  sum(case when dr.id_sensor = (select id_sensor from sensor s where code='S-CLP') then valor else 0 end) as pla 
 FROM data_report dr  
 inner join sensor s ON s.id_sensor =dr.id_sensor 
 inner  join  device d  on d.id_device =dr.id_device 
 left join client_device cd on cd.id_device  =dr.id_device  
 inner join client c on c.id_client =cd.id_client 
 where c.code ='$cdClient'  and d.code ='$cdDevice'
 AND dr.created_at  >=  DATE_ADD(CURDATE() , INTERVAL -8 hour)
 group by dr.created_at order by dr.created_at desc limit 50";
$result = $db->query($sql);
if (!$result) { {
        echo "Error: " . $sql . "<br>" . $db->error;
    }
}

//-------------------------------------------------------------------------------------------
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Monitor Soportec</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="/assets/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />

    <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
    <script>
        username = JSON.parse(window.localStorage.getItem('username'));
        if (username == null) {
            window.location.href = "login.html";

        }
    </script>
</head>

<body id="page-top">

    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
        <div class="container">

            <a class="navbar-brand" href="#page-top" id="nameClient"></a>
            <button class="navbar-toggler text-uppercase font-weight-bold bg-primary text-white rounded py-1" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="#graficas">Gráfica</a></li>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="#dashboard">Dashboard</a></li>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="#datos">Datos</a></li>
                    <li class="nav-item mx-0 mx-lg-1 pt-2"><a class="btn btn-outline-danger " onclick="logout()">Salir</a></li>

                </ul>
            </div>

        </div>
    </nav>

    <!-- Portfolio Section-->
    <section class="page-section " id="graficas">
        <div class="container">
            <!-- Portfolio Section Heading-->
            <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Gráfica</h2>
            <!-- Icon Divider-->
            <div class="divider-custom">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-icon"><i class="fas fa-star"></i></div>

                <div class="divider-custom-line"></div>
            </div>
            <!-- Portfolio Grid Items-->
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-12 mb-12">
                    <div class="portfolio-item mx-auto" data-bs-toggle="modal" data-bs-target="">

                        <!-- Portfolio Item 1-->
                        <div class="col-md-12 col-lg-12 mb-12">
                            <!-- <canvas id="grafica"></canvas>-->

                            <div>
                                <canvas id="myChart"></canvas>

                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>


    <!-- About Section-->
    <section class="page-section py-0">

        <div class="container">
            <!-- Portfolio Section Heading-->
            <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0" id="dashboard">Dashboard</h2>
            <!-- Icon Divider-->
            <div class="divider-custom">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                <div class="divider-custom-line"></div>
            </div>

            <!-- Portfolio Grid Items-->
            <div class="row justify-content-center">
                <!-- Portfolio Item 1-->
                <div class="col-md-6 col-lg-3 mb-5">

                    <div class="card">
                        <div class="card-body py-1">
                            <div class="card-title py-1 justify-content-center d-flex"><strong> Sensor de LPA</strong></div>
                            <hr style="color:#adadad;" class="my-0">
                            <div class="card-text py-3">
                                <div id="chart_lpa" class="justify-content-center d-flex"></div>
                            </div>
                            <div class="card-footer" id="footerLpa" style="display: none;">
                                <div class="row">
                                    <div class="col-12">Fecha Max LPA: <label id="lpaDateMax"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-5">
                    <div class="card">
                        <div class="card-body py-1">
                            <div class="card-title py-1 justify-content-center d-flex"><strong> Sensor de Temperatura</strong></div>
                            <hr style="color:#adadad;" class="my-0">
                            <div class="card-text py-3">
                                <div id="chart_temperature" class="justify-content-center d-flex"></div>
                            </div>
                            <div class="card-footer" id="footerTemp" style="display: none;">
                                <div class="row">
                                    <div class="col-12">Fecha Máx Temp: <label id="tempDateMax"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-10 col-lg-6 mb-12">
                    <div class="card">
                        <div class="card-body py-1">
                            <div class="card-title py-1 justify-content-center d-flex"><strong> Sensor de Humedad</strong></div>
                            <hr style="color:#adadad;" class="my-0">
                            <div class="card-text py-0">
                                <div class="row">
                                    <div id="chart_humidity" class="col-md-6 col-lg-6 mb-5 justify-content-center d-flex"></div>
                                    <div id="chart_humidity2" class="col-md-6 col-lg-6 mb-5 justify-content-center d-flex"></div>
                                </div>
                            </div>

                            <div class="card-footer" id="footerHum" style="display: none;">
                                <div class="row">
                                    <div class="col-12">Fecha Máx: <label id="humidityDateMax"></div>
                                    <div class="col-12">Fecha Min: <label id="humidityDateMin"></div>

                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section-->
    <section class="page-section py-0">
        <div class="container">
            <!-- Portfolio Section Heading-->
            <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0" id="datos">Datos</h2>
            <!-- Icon Divider-->
            <div class="divider-custom">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                <div class="divider-custom-line"></div>
            </div>
            <!-- Portfolio Grid Items-->
            <div class="row justify-content-center">
                <div class="col-md-4 col-lg-4 mb-12   text-center  mb-0">
                    <div class="portfolio-item mx-auto" data-bs-toggle="modal" data-bs-target="#portfolioModal1">
                        <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                            <div class="portfolio-item-caption-content text-center text-white"><i class="fas fa-plus fa-3x"></i></div>
                        </div>
                        <img class="img-fluid" src="assets/img/portfolio/data-icon.png" alt="..." />
                    </div>

                </div>

            </div>

        </div>
    </section>

    <!-- Copyright Section-->
    <div class="copyright py-4 text-center text-white">
        <div class="container"><small>Copyright &copy;Soportec 2022</small></div>
    </div>
    <!-- Portfolio Modals-->
    <!-- Portfolio Modal 1-->
    <div class="portfolio-modal modal fullscreen-modal fade" id="portfolioModal1" tabindex="-1" aria-labelledby="portfolioModal1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header border-0"><button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button></div>
                <div class="modal-body text-center pb-5">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-12">
                                <!-- Portfolio Modal - Title-->
                                <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0">Registros</h2>
                                <!-- Icon Divider-->
                                <div class="divider-custom">
                                    <div class="divider-custom-line"></div>
                                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                    <div class="divider-custom-line"></div>
                                </div>

                                <!-- Portfolio Modal - Text-->

                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Temperatura</th>
                                                    <th scope="col">Humedad</th>
                                                    <th scope="col">LPA</th>
                                                    <th scope="col">Fecha/hora</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?PHP $i = 1;
                                                while ($row = mysqli_fetch_assoc($result)) { ?>
                                                    <tr>
                                                        <th scope="row"><?php echo $i++; ?></th>
                                                        <td><?PHP echo round($row['temperature'], 3); ?></td>
                                                        <td><?PHP echo round($row['humidity'], 3); ?></td>
                                                        <td><?PHP echo round($row['pla'], 3); ?></td>

                                                        <td><?PHP echo date("Y-m-d h:i A", strtotime($row['created_date'])); ?></td>
                                                    </tr>
                                                <?PHP } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <button class="btn btn-primary" data-bs-dismiss="modal">
                                        <i class="fas fa-xmark fa-fw"></i>
                                        Cerrar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- ---------------------------------------------------------------------------------------- -->

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="js/validSession.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <!-- --------------------------------------------------------------------- -->

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
    <script src="js/script_temperature_gauge.js"></script>
    <script src="js/charts.js"></script>

    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <!-- * *                               SB Forms JS                               * *-->
    <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>

</body>

</html>