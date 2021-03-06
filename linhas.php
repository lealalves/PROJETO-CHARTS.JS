<?php 

include 'conexao.php';


$query = mysqli_query($con,"select * from gastos");

?>


<!DOCTYPE html>
<!--
    Copyright (c) 2012-2016 Adobe Systems Incorporated. All rights reserved.

    Licensed to the Apache Software Foundation (ASF) under one
    or more contributor license agreements.  See the NOTICE file
    distributed with this work for additional information
    regarding copyright ownership.  The ASF licenses this file
    to you under the Apache License, Version 2.0 (the
    "License"); you may not use this file except in compliance
    with the License.  You may obtain a copy of the License at

    http://www.apache.org/licenses/LICENSE-2.0

    Unless required by applicable law or agreed to in writing,
    software distributed under the License is distributed on an
    "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY
     KIND, either express or implied.  See the License for the
    specific language governing permissions and limitations
    under the License.
-->
<html>

<head>
    <meta charset="utf-8" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="msapplication-tap-highlight" content="no" />
    <meta name="viewport"
        content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width" />
    <!-- This is a wide open CSP declaration. To lock this down for production, see below. -->

    <!-- Good default declaration
    * gap: is required only on iOS (when using UIWebView) and is needed for JS->native communication
    * https://ssl.gstatic.com is required only on Android and is needed for TalkBack to function properly
    * Disables use of eval() and inline scripts in order to mitigate risk of XSS vulnerabilities. To change this:
        * Enable inline JS: add 'unsafe-inline' to default-src
        * Enable eval(): add 'unsafe-eval' to default-src
    * Create your own at http://cspisawesome.com
    -->
    <!-- <meta http-equiv="Content-Security-Policy" content="default-src 'self' data: gap: 'unsafe-inline' https://ssl.gstatic.com; style-src 'self' 'unsafe-inline'; media-src *" /> -->



    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


    <link rel="stylesheet" type="text/css" href="fontawesome-free-5.12.0-web/css/all.css" />
    <link rel="stylesheet" type="text/css" href="css/fontawesome/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="mobileui/style.css">
    <link rel="stylesheet" type="text/css" href="css/index.css" />
    <link rel="stylesheet" type="text/css" href="css/estilo.css" />
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
    <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
    <title>Gr??ficos</title>
    <script>
        google.charts.load('current', { 'packages': ['corechart'] });
        function desenhargrafico() {

            var tabela = new google.visualization.DataTable()           
            tabela.addColumn('string', 'categorias')
            tabela.addColumn('number', 'valores')
            tabela.addRows([
                <?php 
                    while($resul = mysqli_fetch_assoc($query)){               
                ?>               
                <?php echo '["' .$resul['marca'] . '",' . $resul['vendas'] . '],'?>
                <?php };?>
            ]);
            var opcoes = {
                'title': 'Marcas de carros mais vendidas 2021',
                'height': 300,
                'width': 400,
            };
            var grafico = new google.visualization.LineChart(document.getElementById('grafico'))
            grafico.draw(tabela, opcoes)
        }

        google.charts.setOnLoadCallback(desenhargrafico)


    </script>

</head>

<body>
    <div data-role="page">
        <ul class="menubar">
            <li><a href="index.php"><i class="fas fa-chart-pie"></i></a></li>
            <li><a href="donut.php"><i class="fas fa-dot-circle"></i></a></li>
            <li><a href="colunas.php"><i class="fas fa-align-right"></i></a></li>
            <li><a href="barras.php"><i class="fas fa-chart-bar"></i></a></li>
            <li><a href="linhas.php"><i class="fas fa-chart-line"></i></a></li>
            <li><a href="area.php"><i class="fas fa-chart-area"></i></a></li>
        </ul>

        <div data-role="header">
            <h1>Gr??fico Linhas</h1>
        </div>


        <div id="grafico"></div>
    </div>
</body>

</html>