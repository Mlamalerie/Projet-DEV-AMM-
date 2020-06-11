<?php
session_start();

$_SESSION['ici_index_bool'] = false;

// si une connection est détecter : (ta rien a faire ici mec)
$okconnectey = false;
if(isset($_SESSION['user_id']) || isset($_SESSION['user_pseudo'])  ) {
    print_r($_SESSION);
    $okconnectey = true;
} else{
    echo "Pas de connexion";
}
?>



<!DOCTYPE html>
<html lang="fr">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <?php
        require_once('assets/skeleton/headLinkCSS.html');
        ?>
        <link rel="stylesheet" type="text/css" href="assets/css/navbar.css">


        <link rel="stylesheet" type="text/css" href="assets/css/dashboard.css">
        <link rel="stylesheet" type="text/css" href="assets/css/dashboard.css">
        <link rel="stylesheet" type="text/css" href="assets/js/chart.js/Chart.css">
        <link rel="stylesheet" type="text/css" href="assets/js/chart.js/Chart.min.css">
       
        <title>Dash BOard</title>
    </head>
    <body id="page-top">
        <!--   *************************************************************  -->
        <!--   ************************** NAVBAR  **************************  -->
        <?php
        //require_once('assets/skeleton/navbar.php');
        ?>

        <br>

        <section class="dashboard-counts no-padding-bottom bg-success">
            <div class="container-fluid">
                <div class="row bg-white has-shadow">
                    <!-- Item -->
                    <div class="col-xl-3 col-sm-6">
                        <div class="item d-flex align-items-center justify-content-center ">
                            <div class="icon bg-dark"><i class="icon-user"></i></div>
                            <div class="title"><span>New Followers</span>
                                <div class="progress">
                                    <div role="progressbar" style="width: 25%; height: 4px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-violet"></div>
                                </div>
                            </div>
                            <div class="number"><strong>25</strong></div>
                        </div>
                    </div>
                    <!-- Item -->
                    <div class="col-xl-3 col-sm-6">
                        <div class="item d-flex align-items-center justify-content-center">
                            <div class="icon bg-red"><i class="icon-padnote"></i></div>
                            <div class="title"><span>Likes</span>
                                <div class="progress">
                                    <div role="progressbar" style="width: 70%; height: 4px;" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-red"></div>
                                </div>
                            </div>
                            <div class="number"><strong>70</strong></div>
                        </div>
                    </div>
                    <!-- Item -->
                    <div class="col-xl-3 col-sm-6">
                        <div class="item d-flex align-items-center justify-content-center">
                            <div class="icon bg-green"><i class="icon-bill"></i></div>
                            <div class="title"><span>Ventes nets</span>
                                <div class="progress">
                                    <div role="progressbar" style="width: 40%; height: 4px;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-green"></div>
                                </div>
                            </div>
                            <div class="number"><strong>40</strong></div>
                        </div>
                    </div>
                    <!-- Item -->
                    <div class="col-xl-3 col-sm-6">
                        <div class="item d-flex align-items-center justify-content-center">
                            <div class="icon bg-orange"><i class="icon-check"></i></div>
                            <div class="title"><span>Open<br>Cases</span>
                                <div class="progress">
                                    <div role="progressbar" style="width: 50%; height: 4px;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-orange"></div>
                                </div>
                            </div>
                            <div class="number"><strong>50</strong></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

       <section class="dashboard-header">
            <div class="container-fluid">
              <div class="row">
                <!-- Statistics -->
                <div class="statistics col-lg-3 col-12">
                  <div class="statistic d-flex align-items-center bg-white shadow-sm">
                    <div class="icon bg-dark"><i class="fa fa-tasks"></i></div>
                    <div class="text"><strong>234</strong><br><small>Applications</small></div>
                  </div>
                  <div class="statistic d-flex align-items-center bg-white shadow-sm">
                    <div class="icon bg-dark"><i class="fa fa-calendar-o"></i></div>
                    <div class="text"><strong>152</strong><br><small>Interviews</small></div>
                  </div>
                  <div class="statistic d-flex align-items-center bg-white shadow-sm">
                    <div class="icon bg-dark"><i class="fa fa-paper-plane-o"></i></div>
                    <div class="text"><strong>147</strong><br><small>Forwards</small></div>
                  </div>
                </div>
                <!-- Line Chart            -->
                
                <div class="col-lg-4">
                  <div class="overdue card">
                    <div class="card-close">
                      <div class="dropdown">
                        <button type="button" id="closeCard3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
                        <div aria-labelledby="closeCard3" class="dropdown-menu dropdown-menu-right has-shadow" style="display: none;">
                        <a href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Close</a>
                        <a href="#" class="dropdown-item edit"> <i class="fa fa-gear"></i>Edit</a></div>
                      </div>
                      
                    </div>
                    <div class="card-body">
                      <h3>Total Overdue</h3><small>Lorem ipsum dolor sit amet.</small>
                      <div class="number text-center">$20,000</div>
                      <div class="chart"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                        <canvas id="lineChart1" width="287" height="142" class="chartjs-render-monitor" style="display: block; width: 287px; height: 142px;">                               </canvas>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
       
        <?php
        require_once('assets/skeleton/endLinkScripts.php');
        ?>
    



    </body>
</html>