<?php
    session_start();
    require "funciones.php";
    if(!isLogin()){
        header('location: login.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!--<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">-->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

<?php
    titulo_header();
    ?>

    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    <link href="vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <link href="build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <?php
            menu_lateral_v2();
        ?>

        <div class="top_nav">
          <?
            navBar()
          ?>
        </div>
        
        <style>
            .recuadro1{
                background: #0dabe2;
                color: white; 
                padding:0.5%; 
                text-align: center;
                border-radius: 10px; 
                margin-bottom: 1%
            }
            </style>
        
        <div class="right_col" role="main">
            <div class="page-title">
              <div class="title_left">
                <h3>Panel de control de donaciones</h3>
              </div>
              </div>
          <div class="x_content" style="float:none" >
              <!--
              <pre>
                  <?
                  print_r($_SESSION)
                  ?>
              </pre>
              -->
          <div class="">
            <div class="row top_tiles">
                
                <div class="col-md-12 col-xs-12"> <div class="recuadro1">Donaciones </div> </div>
                
              <div class="animated flipInY col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon" style="position: absolute; right: 53px; top: 22px; z-index: 1;">
                     <!-- <i class="fa fa-caret-square-o-right"></i> -->
                     <img src="images/causasA.jpeg" width="60" />
                    </div>
                  <div class="count">100</div>
                  <h3>Causas activas</h3>
                </div>
              </div>
             
              <div class="animated flipInY col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon" style="position: absolute; right: 53px; top: 22px; z-index: 1;">
                      <!-- <i class="fa fa-comments-o"></i> -->
                     <img src="images/bene.jpeg" width="60" />
                      
                      </div>
                  <div class="count">500</div>
                  <h3>Beneficiarios</h3>
                </div>
              </div>
              
              <div class="animated flipInY col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon" style="position: absolute; right: 53px; top: 22px; z-index: 1;">
                      <!-- <i class="fa fa-sort-amount-desc"></i> -->
                     <img src="images/kits.jpeg" width="60" />
                      </div>
                  <div class="count">100.50</div>
                  <h3>Kg de Alimentos</h3>
                </div>
              </div>
              
              <div class="animated flipInY col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon" style="position: absolute; right: 53px; top: 22px; z-index: 1;">
                      <!-- <i class="fa fa-check-square-o"></i> -->
                      
                     <img src="images/dinero.jpeg" width="60" />
                      </div>
                  <div class="count">$900.000</div>
                  <h3>Dinero recaudado</h3>
                </div>
              </div>
              
            </div>


            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <div class="recuadro1">
                        Recaudaciones
                    </div>
                </div>
            </div>    
            
            <div class="row">
                <div class="col-md-6">
                    <div class="x_panel" style="height: auto;">
                      <div class="x_title">
                        <h2>Causas activas</h2>
                        <div class="clearfix"></div>
                      </div>
                      <div class="x_content" >
                        <div id="echart_pie" style="height: 350px; -webkit-tap-highlight-color: transparent; user-select: none; position: relative; background-color: transparent;" _echarts_instance_="ec_1614032070210"><div style="position: relative; overflow: hidden; width: 485px; height: 350px; cursor: default;"><canvas width="485" height="350" data-zr-dom-id="zr_0" style="position: absolute; left: 0px; top: 0px; width: 485px; height: 350px; user-select: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></canvas></div><div></div></div>
                      </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="x_panel" style="height: auto;">
                      <div class="x_title">
                        <h2>Recaudaci&oacute;n por tipo</h2>
                        <div class="clearfix"></div>
                      </div>
                      <div class="x_content" >
                        <div id="echart_pie_dupli1" style="height: 350px; -webkit-tap-highlight-color: transparent; user-select: none; position: relative; background-color: transparent;" _echarts_instance_="ec_1614032070210"><div style="position: relative; overflow: hidden; width: 485px; height: 350px; cursor: default;"><canvas width="485" height="350" data-zr-dom-id="zr_0" style="position: absolute; left: 0px; top: 0px; width: 485px; height: 350px; user-select: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></canvas></div><div></div></div>
                          </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Recaudaciones por meses</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div id="graph_bar" style="width: 100%; height: 280px; ">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <div class="recuadro1">
                        DONANTES
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-4 col-xs">
                    <div class="x_panel" style="height: auto;">
                  <div class="x_title">
                    <h2>Donantes</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content" >
                    <div id="echart_pie_dupli2" style="height: 350px; -webkit-tap-highlight-color: transparent; user-select: none; position: relative; background-color: transparent;" _echarts_instance_="ec_1614032070210"><div style="position: relative; overflow: hidden; width: 485px; height: 350px; cursor: default;"><canvas width="485" height="350" data-zr-dom-id="zr_0" style="position: absolute; left: 0px; top: 0px; width: 485px; height: 350px; user-select: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></canvas></div><div></div></div>
                  </div>
                </div>
                </div>
                
                <div class="col-md-4">
                    <div class="x_panel">
                        <div class="x_title">
                            <strong>Ranking de donantes por monto de dinero</strong>
                        </div>
                        <div class="x_content">
                            <table  class="table">
                                <thead>
                                    <tr>
                                        <th>
                                            Nombre del donante
                                        </th>
                                        <th>
                                            Cantidad ($)
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div style="display:flex">
                                                <img style="width: 50%;" src="images/partners/partner-1.png" />
                                            
                                                <span style="align-self: center;margin-left: 15px;" >TIA S.A.</span>
                                            </div>
                                        </td>
                                        <td style="vertical-align:middle;">
                                            <span>$ 120.30</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="display:flex">
                                                <img style="width: 50%;" src="images/partners/partner-2.png" class="img-fluid" />
                                            
                                                <span style="align-self: center;margin-left: 15px;" >SUPERMAXI</span>
                                            </div>
                                        </td>
                                        <td style="vertical-align:middle;">
                                            <span>$ 1720.30</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="display:flex">
                                                <img style="width: 50%;" src="images/partners/partner-3.png" class="img-fluid" />
                                            
                                                <span style="align-self: center;margin-left: 15px;" >TELCONET</span>
                                            </div>
                                            
                                        </td>
                                        <td style="vertical-align:middle;">
                                            <span>$ 520.30</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="display:flex">
                                                <img style="width: 50%;" src="images/partners/partner-4.png" class="img-fluid" />
                                            
                                                <span style="align-self: center;margin-left: 15px;" >LA GANGA</span>
                                            </div>
                                            
                                        </td>
                                        <td style="vertical-align:middle;">
                                            <span>$ 1'700.30</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="display:flex">
                                                <img style="width: 50%;" src="images/partners/partner-5.png" class="img-fluid" />
                                            
                                                <span style="align-self: center;margin-left: 15px;" >AMBIANSA</span>
                                            </div>
                                            
                                        </td>
                                        <td style="vertical-align:middle;">
                                            <span>$ 720.30</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="display:flex">
                                                <img style="width: 50%;" src="images/partners/partner-6.png" class="img-fluid" />
                                            
                                                <span style="align-self: center;margin-left: 15px;" >MACROGRAM</span>
                                            </div>
                                            
                                        </td>
                                        <td style="vertical-align:middle;">
                                            <span>$ 320.30</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="x_panel">
                        <div class="x_title">
                            <strong>Ranking de donantes por producto</strong>
                        </div>
                        <div class="x_content">
                            <table  class="table">
                                <thead>
                                    <tr>
                                        <th>
                                            Nombre del donante
                                        </th>
                                        <th>
                                            Tipo de producto
                                        </th>
                                        <th>
                                            Cantidad
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div style="display:flex">
                                                <img src="http://t0.gstatic.com/images?q=tbn:ANd9GcTyfylqfyOcKQW1NkjrtAbdVib1cvUdvb7y8Gzr0Mhkbew2TuOF-JQ3FlwzZyZU" style="width: 50px;height: 50px;" class="img-circle img-responsive" />
                                            
                                                <span style="align-self: center;margin-left: 15px;" >Juan L&oacute;pez</span>
                                            </div>
                                        </td>
                                        <td>
                                            <span>Kits de alimentos</span>
                                        </td>
                                        <td style="vertical-align:middle;">
                                            <span>200</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="display:flex">
                                                <img src="images/partners/sofia.png" class="img-circle img-responsive" style="width: 50px;height: 50px;" />
                                            
                                                <span style="align-self: center;margin-left: 15px;" >Sofia Reyes</span>
                                            </div>
                                        </td>
                                        <td style="vertical-align:middle;">
                                            <span>Tablets</span>
                                        </td>
                                        <td style="vertical-align:middle;">
                                            <span>200</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="display:flex">
                                                <img src="data:image/jpeg;base64,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" class="img-circle img-responsive" style="width: 50px;height: 50px;" />
                                            
                                                <span style="align-self: center;margin-left: 15px;" >Alexis Zambrano</span>
                                            </div>
                                            
                                        </td>
                                        <td style="vertical-align:middle;">
                                            Bicicletas
                                        </td>
                                        <td style="vertical-align:middle;">
                                            <span>100</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <div class="recuadro1">
                        BENEFICIARIOS
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="x_panel" style="height: auto;">
                      <div class="x_title">
                        <h2>Beneficiarios</h2>
                        <div class="clearfix"></div>
                      </div>
                      <div class="x_content" >
                        <div id="echart_LUGARES" style="height: 350px; -webkit-tap-highlight-color: transparent; user-select: none; position: relative; background-color: transparent;" _echarts_instance_="ec_1614032070210"><div style="position: relative; overflow: hidden; width: 485px; height: 350px; cursor: default;"><canvas width="485" height="350" data-zr-dom-id="zr_0" style="position: absolute; left: 0px; top: 0px; width: 485px; height: 350px; user-select: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></canvas></div><div></div></div>
                          </div>
                    </div>
                </div>
                <div class="col-md-6  text-center">
                    <h2>Mapa de calor de beneficiarios</h2>
                    <img src="images/mapa.PNG" class="img-thumbnail" />
                </div>
            </div>
            
             <div class="row">
                <div class="col-md-12 col-xs-12">
                    <div class="recuadro1">
                        CENTROS DE ACOPIO
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    <div class="x_panel">
                        <div class="x_title">
                            Centros de acopio
                        </div>
                        <div class="x_content text-center">
                            <img src="images/google-maps.jpeg" class="img-fluid img-thumbnail" />
                        </div>
                    </div>
                </div>
            </div>

          </div>
        </div>

        <!-- footer content -->
        <!--<footer>-->
        <!--  <div class="pull-right">-->
        <!--    Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>-->
        <!--  </div>-->
        <!--  <div class="clearfix"></div>-->
        <!--</footer>-->
        <!-- /footer content -->
      </div>
      </div>
    </div>

    <!-- jQuery -->
    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <!--<script src="vendors/Chart.js/dist/Chart.min.js"></script>-->
    <!-- jQuery Sparklines -->
    <!--<script src="vendors/jquery-sparkline/dist/jquery.sparkline.min.js"></script>-->
    <!-- Flot -->
    <!--<script src="vendors/Flot/jquery.flot.js"></script>-->
    <!--<script src="vendors/Flot/jquery.flot.pie.js"></script>-->
    <!--<script src="vendors/Flot/jquery.flot.time.js"></script>-->
    <!--<script src="vendors/Flot/jquery.flot.stack.js"></script>-->
    <!--<script src="vendors/Flot/jquery.flot.resize.js"></script>-->
    <!-- Flot plugins -->
    <!--<script src="vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>-->
    <!--<script src="vendors/flot-spline/js/jquery.flot.spline.min.js"></script>-->
    <!--<script src="vendors/flot.curvedlines/curvedLines.js"></script>-->
    <!-- DateJS -->
    <!--<script src="vendors/DateJS/build/date.js"></script>-->
    <!-- bootstrap-daterangepicker -->
    <!--<script src="vendors/moment/min/moment.min.js"></script>-->
    <!--<script src="vendors/bootstrap-daterangepicker/daterangepicker.js"></script>-->
    
     <!-- ECharts -->
    <script src="vendors/echarts/dist/echarts.min.js"></script>
    <!--<script src="vendors/echarts/map/js/world.js"></script>-->
    
        <!-- morris.js -->
    <script src="vendors/raphael/raphael.min.js"></script>
    <script src="vendors/morris.js/morris.min.js"></script>
    
    <!-- Custom Theme Scripts -->
    <script src="build/js/custom.js"></script>
    
    <!-- SWEET-ALERT -->
    <script type="text/javascript" language="javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.7/dist/sweetalert2.all.min.js"></script>
    
    
    <!-- JS SCRIPT APP -->
    <script type="text/javascript" language="javascript" src="js/cambiarContrasena.js" ></script>
    
  </body>
</html>