<?php
//-------------------------------------------------------------------------------------------
require 'config.php';

$db;
$sql = "SELECT dr.created_at as created_date, sum(case when dr.id_sensor = (select id_sensor from sensor s where code='S-TEMP') then valor  else 0 end) as temperature";
$sql .= ", sum(case when dr.id_sensor = (select id_sensor from sensor s where code='S-HUM') then valor else 0 end) as humidity";
$sql .= ", sum(case when dr.id_sensor = (select id_sensor from sensor s where code='S-LPA') then valor else 0 end) as pla";
$sql .= " FROM data_report dr  where dr.id_device = 1 AND dr.created_at  >= CURDATE() group by dr.created_at order by dr.created_at desc  ";
$result = $db->query($sql);
if (!$result) { {
        echo "Error: " . $sql . "<br>" . $db->error;
    }
}


//$rows = $result->fetch_assoc();
//$rows = $result -> fetch_all(MYSQLI_ASSOC);

//$row = get_temperature();
//print_r($row);

//header('Content-Type: application/json');
//echo json_encode($rows);
//-------------------------------------------------------------------------------------------
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Monitoreo de sensores</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>

</head>

<body id="page-top">

    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand" href="#page-top">Monitoreo de sensores</a>
            <button class="navbar-toggler text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">

                <ul class="navbar-nav ms-auto">
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="#portfolio">Dashboard</a></li>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="#datos">Datos</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Portfolio Section-->
    <section class="page-section portfolio" id="portfolio">

        <div class="container">
            <!-- Portfolio Section Heading-->
            <!-- Icon Divider-->
            <div class="divider-custom">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                <div class="divider-custom-line"></div>
            </div>

            <div class="row col-md-12 col-lg-12 mb-12">
                <div class="col-md-4 col-lg-4 mb-12">
                    <div class=" mx-auto">
                        <div id="chart_temperature" class=" "></div>
                    </div>
                </div>
                <div class="col-md-4 col-lg-4 mb-12">
                    <div class=" mx-auto">
                        <div id="chart_humidity"></div>
                    </div>
                </div>
                <div class="col-md-4 col-lg-4 mb-12">
                    <div class=" mx-auto">

                         <div id="chart_lpa"></div>

                    </div>

                </div>
            </div>
 

        </div>

        <div class="container">
            <!-- Portfolio Grid Items-->
            <div class="row justify-content-center">

                <!-- Portfolio Item 1-->
                <div class="col-md-4 col-lg-10 mb-5">
                    <canvas id="grafica"></canvas>
                </div>

            </div>
        </div>

    </section>

    <!-- Portfolio Section-->
    <section class="page-section portfolio" id="datos">
        <div class="container">
            <!-- Portfolio Section Heading-->
            <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Datos</h2>
            <!-- Icon Divider-->
            <div class="divider-custom">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                <div class="divider-custom-line"></div>
            </div>
            <!-- Portfolio Grid Items-->
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-12 mb-5">
                    <div class=" mx-auto" data-bs-toggle="modal" data-bs-target="#portfolioModal1">
                        <div class="-caption d-flex align-items-center justify-content-center h-100 w-100">
                            <div class="-caption-content text-center text-white"><i class="fas fa-plus fa-3x"></i></div>
                        </div>
                        <img class="img-fluid" src="assets/img/portfolio/data-icon.png" alt="..." />
                    </div>

                </div>
            </div>
        </div>
    </section>


    <!-- Copyright Section-->
    <div class="copyright py-4 text-center text-white">
        <div class="container"><small>Copyright &copy; Your Website 2022</small></div>
    </div>
    <!-- Portfolio Modals-->
    <!-- Portfolio Modal 1-->
    <div class="portfolio-modal modal fade" id="portfolioModal1" tabindex="-1" aria-labelledby="portfolioModal1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header border-0"><button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button></div>
                <div class="modal-body text-center pb-5">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
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
                                                    <th scope="col">Fecha/hora</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?PHP $i = 1;
                                                while ($row = mysqli_fetch_assoc($result)) { ?>
                                                    <tr>
                                                        <th scope="row"><?php echo $i++; ?></th>
                                                        <td><?PHP echo $row['temperature']; ?></td>
                                                        <td><?PHP echo $row['humidity']; ?></td>
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


    <script>
        const etiquetas = ["Enero", "Febrero", "Marzo", "Abril"];
        const datosVentas = [5000, 1500, 8000, 5102];
        // Obtener una referencia al elemento canvas del DOM
        const $grafica = document.querySelector("#grafica");

        // Podemos tener varios conjuntos de datos. Comencemos con uno
        const datosVentas2020 = {
            label: "Ventas por mes",
            // Pasar los datos igualmente desde PHP
            data: datosVentas,
            backgroundColor: 'rgba(54, 162, 235, 0.2)', // Color de fondo
            borderColor: 'rgba(54, 162, 235, 1)', // Color del borde
            borderWidth: 1, // Ancho del borde
        };
        new Chart($grafica, {
            type: 'line', // Tipo de gráfica
            data: {
                labels: etiquetas,
                datasets: [
                    datosVentas2020,
                    // Aquí más datos...
                ]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }],
                },
            }
        });
    </script>
    <!-- ---------------------------------------------------------------------------------------- -->



    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script>

    </script>
    <!-- --------------------------------------------------------------------- -->

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
    <script src="js/script_temperature_gauge.js"></script>

    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <!-- * *                               SB Forms JS                               * *-->
    <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>


</body>

</html>