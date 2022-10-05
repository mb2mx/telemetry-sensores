   //$(document).ready(function(){



     //-------------------------------------------------------------------------------------------------
     google.charts.load('current', {
        'packages': ['gauge']
    });
    google.charts.setOnLoadCallback(drawLinePressureAirChart);
     //-------------------------------------------------------------------------------------------------
     function drawLinePressureAirChart() {
        //guage starting values
        var data = google.visualization.arrayToDataTable([
            ['Label', 'Value'],
            ['CLP', 0],
            
        ]);
        //NNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN
        var options = {
            width: 350, height: 250,
            greenFrom: 00,
            greenTo: 25,
           
            yellowFrom: 25,
            yellowTo: 75, 
            
            redFrom: 75,
            redTo: 100,
         
            minorTicks: 5
        };
        
        //NNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN
        var chart = new google.visualization.Gauge(document.getElementById('chart_lpa'));
        chart.draw(data, options);
        //NNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN



        //NNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN
        function refreshData() {
            client = JSON.parse(window.localStorage.getItem('username'));

            $.ajax({
                url: 'php/index.php/sensores/gauge',
                // use value from select element
               // data: 'cdClient=' + $("#cdClient").val(),
                data: 'cdClient='+client.code ,

                dataType: 'json',
                success: function(responseText) {
                    //______________________________________________________________

                    let hasElementMax= responseText.filter( vendor => vendor['code'] === 'S-CLP' && vendor['type_calc'] === 'MAX'  )
                    let dateRegister = hasElementMax[0].created_at;

                    document.getElementById('lpaDateMax').innerHTML =  moment(dateRegister).format('MM/DD/YYYY HH:mm A')                        ;
                    document.getElementById("footerLpa").style.display = 'block';

                    let dataPLAMax = 0;
 
                    if(hasElementMax){
                        dataPLAMax = hasElementMax[0].max;
                    } 
                    var var_pla_max = parseFloat(dataPLAMax).toFixed(2)
                    //console.log(var_temperature);
                    // use response from php for data table
                    //______________________________________________________________
                    //guage starting values
                    var data = google.visualization.arrayToDataTable([
                        ['Label', 'Value'],
                        ['LPA', eval(var_pla_max)],
                    ]);
                    //______________________________________________________________
                    //var chart = new google.visualization.Gauge(document.getElementById('chart_temperature'));
                    chart.draw(data, options);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(errorThrown + ': ' + textStatus);
                }
            });
        }
        //NNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN
        //refreshData();

        setInterval(refreshData, 1000);
    }
    //-------------------------------------------------------------------------------------------------


        //-------------------------------------------------------------------------------------------------
        google.charts.load('current', {
            'packages': ['gauge']
        });
        google.charts.setOnLoadCallback(drawTemperatureChart);
        //-------------------------------------------------------------------------------------------------
        function drawTemperatureChart() {
            //guage starting values
            var data = google.visualization.arrayToDataTable([
                ['Label', 'Value'],
                ['Max Temp', 0],

            ]);
            //NNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN
            var options = {
                width: 350, height: 250,
              
                greenFrom: 00,
                greenTo: 23,

                yellowFrom: 23,
                yellowTo: 30,

                redFrom: 30,
                redTo: 100,
               
                minorTicks: 20,
                majorTicks: ['0 °C', '100 °C']

            };
            //NNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN
            var chart = new google.visualization.Gauge(document.getElementById('chart_temperature'));
            chart.draw(data, options);
            //NNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN



            //NNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN
            function refreshData() {

                client = JSON.parse(window.localStorage.getItem('username'));

                $.ajax({
                    url: 'php/index.php/sensores/gauge',
                    // use value from select element
                    // data: 'cdClient=' + $("#cdClient").val(),
                    data: 'cdClient='+client.code ,
                    dataType: 'json',
                    success: function(responseText) {
                        //______________________________________________________________
                        let hasElementMax= responseText.filter( vendor => vendor['code'] === 'S-TEMP' && vendor['type_calc'] === 'MAX'  )
                        let dateRegister = hasElementMax[0].created_at;

                        document.getElementById('tempDateMax').innerHTML =  moment(dateRegister).format('MM/DD/YYYY HH:mm A')                        ;
                        document.getElementById("footerTemp").style.display = 'block';

                        let dataTemperatureMax = 0;
 
                        if(hasElementMax){
                            dataTemperatureMax = hasElementMax[0].max;
                        } 
                        var var_temperature_max = parseFloat(dataTemperatureMax).toFixed(2)
 
                        //console.log(var_temperature);
                        // use response from php for data table
                        //______________________________________________________________
                        //guage starting values
                        var data = google.visualization.arrayToDataTable([
                            ['Label', 'Value'],
                            ['Max Temp', eval(var_temperature_max)],
                        ]);
                        //______________________________________________________________
                        //var chart = new google.visualization.Gauge(document.getElementById('chart_temperature'));
                        chart.draw(data, options);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(errorThrown + ': ' + textStatus);
                    }
                });
            }
            //NNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN
            //refreshData();

            setInterval(refreshData, 1000);
        }
        //-------------------------------------------------------------------------------------------------


        //-------------------------------------------------------------------------------------------------
        google.charts.load('current', {
            'packages': ['gauge']
        });
        google.charts.setOnLoadCallback(drawHumidityChart);
        //-------------------------------------------------------------------------------------------------
        function drawHumidityChart() {
            //guage starting values
            var data = google.visualization.arrayToDataTable([
                ['Label', 'Value'],
                ['Max Hum', 0],
               // ['Min Hum', 0],

            ]);
            //NNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN
            var options = {
                width: 350, height: 250,
                greenFrom: 30,
                greenTo: 60,
                yellowFrom: 60,
                yellowTo: 80,
                redFrom: 80,
                redTo: 100,
                minorTicks: 20,
                min: 30,
                max: 100,
                majorTicks: ['30', '100']

            };
            
            var options2 = {
                width: 350, height: 250,             
                redFrom: 00,
                redTo: 10,
                yellowFrom: 10,
                yellowTo: 30,
                greenFrom: 30,
                greenTo: 50,
                minorTicks: 20,
                min: 00,
                max: 50,
                majorTicks: ['0', '50']

            };
            
            //NNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN
            var chart = new google.visualization.Gauge(document.getElementById('chart_humidity'));
            chart.draw(data, options);

            var chart2 = new google.visualization.Gauge(document.getElementById('chart_humidity2'));
            chart2.draw(data, options2);
            //NNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN


            //NNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN
            function refreshData() {
                client = JSON.parse(window.localStorage.getItem('username'));

                $.ajax({
                    url: 'php/index.php/sensores/gauge',
                    // use value from select element
                    // data: 'cdClient=' + $("#cdClient").val(),
                    data: 'cdClient='+client.code ,
                    dataType: 'json',
                    success: function(responseText) {
                        //______________________________________________________________

                        let hasElementMax= responseText.filter( vendor => vendor['code'] === 'S-HUM' && vendor['type_calc'] === 'MAX'  )
                        let hasElementMin = responseText.filter( vendor => vendor['code'] === 'S-HUM' && vendor['type_calc'] === 'MIN'  )
                        
                        let dateRegisterMax = hasElementMax[0].created_at;
                        let dateRegisterMin = hasElementMin[0].created_at;

                        document.getElementById('humidityDateMax').innerHTML =  moment(dateRegisterMax).format('MM/DD/YYYY HH:mm A')                        ;
                        document.getElementById('humidityDateMin').innerHTML =  moment(dateRegisterMin).format('MM/DD/YYYY HH:mm A')                        ;
                        document.getElementById("footerHum").style.display = 'block';

 
                        let dataaHumidityMax = 0;
                        let dataaHumidityMin = 0;

                        if(hasElementMax){
                            dataaHumidityMax = hasElementMax[0].max;
                        }
                        if(hasElementMin){
                            dataaHumidityMin = hasElementMin[0].max;
                        }


                        var var_humidity_max = parseFloat(dataaHumidityMax).toFixed(2)
                        var var_humidity_min = parseFloat(dataaHumidityMin).toFixed(2)
                        //console.log(var_temperature);
                        // use response from php for data table
                        //______________________________________________________________
                        //guage starting values
                        var data = google.visualization.arrayToDataTable([
                            ['Label', 'Value'],
                            ['Max Hum', eval(var_humidity_max)],
                         ]);

                         var data2 = google.visualization.arrayToDataTable([
                            ['Label', 'Value'],
                             ['Min Hum', eval(var_humidity_min)],

                         ]);
                        //______________________________________________________________
                        //var chart = new google.visualization.Gauge(document.getElementById('chart_temperature'));
                        chart.draw(data, options);
                        chart2.draw(data2, options2);

                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(errorThrown + ': ' + textStatus);
                    }
                });
            }
            //NNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN
            //refreshData();

            setInterval(refreshData, 1000);
        }
        //-------------------------------------------------------------------------------------------------

        //});



// $(window).resize(function() {
//     drawTemperatureChart();
//     drawLinePressureAirChart();
//     drawHumidityChart();
// });

        