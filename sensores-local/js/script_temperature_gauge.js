
    //-------------------------------------------------------------------------------------------------
    google.charts.load('current', {
        'packages': ['gauge']
    });



    function genericRefreshData() {
        client = JSON.parse(window.localStorage.getItem('username'));
        var optionsPressure = initDrawLineLpaChart(false);
        var optionsTemperature = initDrawTemperatureChart(false);
        var optCompHumedity = initDrawHumidityChart(false);


        $.ajax({
           
            url: 'php/index.php/sensores/gauge',
            data: 'cdClient=' + client.code,
            dataType: 'json',
            success: function (responseRequest) {
                reDrawLineLpaChart(responseRequest, optionsPressure);
                reDrawTemperatureChart(responseRequest, optionsTemperature);
                reDrawHumidityChart(responseRequest, optCompHumedity);

            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(errorThrown + ': ' + textStatus);
            }
        });
    }

  
    //NNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN

    function initDrawLineLpaChart(isInitPaint) {
        //guage starting values
        var data = google.visualization.arrayToDataTable([
            ['Label', 'Value'],
            ['CLP', 0],

        ]);
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

        if (isInitPaint) {
            var chart = new google.visualization.Gauge(document.getElementById('chart_lpa'));
            chart.draw(data, options);
        }

        return options;
    }

    //-------------------------------------------------------------------------------------------------

    function reDrawLineLpaChart(dataResponse, options) {
        let hasElementMax = dataResponse.filter(vendor => vendor['code'] === 'S-CLP' && vendor['type_calc'] === 'MAX')
        let dateRegister = hasElementMax[0].created_at;

        document.getElementById('lpaDateMax').innerHTML = moment(dateRegister).format('MM/DD/YYYY HH:mm A');
        document.getElementById("footerLpa").style.display = 'block';

        let dataPLAMax = 0;

        if (hasElementMax) {
            dataPLAMax = hasElementMax[0].max;
        }
        var var_pla_max = parseFloat(dataPLAMax).toFixed(2);
        var data = google.visualization.arrayToDataTable([
            ['Label', 'Value'],
            ['LPA', eval(var_pla_max)],
        ]);
        var chart = new google.visualization.Gauge(document.getElementById('chart_lpa'));
        chart.draw(data, options);
    }
    //NNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN

    //NNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN

    function initDrawTemperatureChart(isInitPaint) {
        //guage starting values
        var data = google.visualization.arrayToDataTable([
            ['Label', 'Value'],
            ['Max Temp', 0],

        ]);
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

        if (isInitPaint) {
            var chart = new google.visualization.Gauge(document.getElementById('chart_temperature'));
            chart.draw(data, options);
        }

        return options;
    }

    //-------------------------------------------------------------------------------------------------

    function reDrawTemperatureChart(dataResponse, options) {

        let hasElementMax = dataResponse.filter(vendor => vendor['code'] === 'S-TEMP' && vendor['type_calc'] === 'MAX')
        let dateRegister = hasElementMax[0].created_at;

        document.getElementById('tempDateMax').innerHTML = moment(dateRegister).format('MM/DD/YYYY HH:mm A');
        document.getElementById("footerTemp").style.display = 'block';

        let dataTemperatureMax = 0;

        if (hasElementMax) {
            dataTemperatureMax = hasElementMax[0].max;
        }
        var var_temperature_max = parseFloat(dataTemperatureMax).toFixed(2)


        var data = google.visualization.arrayToDataTable([
            ['Label', 'Value'],
            ['Max Temp', eval(var_temperature_max)],
        ]);

        var chart = new google.visualization.Gauge(document.getElementById('chart_temperature'));
        chart.draw(data, options);

    }

    //NNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN

    //NNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN

    function initDrawHumidityChart(isInitPaint) {

        var data = google.visualization.arrayToDataTable([
            ['Label', 'Value'],
            ['Max Hum', 0],
        ]);

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
        if (isInitPaint) {

            var chart = new google.visualization.Gauge(document.getElementById('chart_humidity'));
            chart.draw(data, options);

            var chart2 = new google.visualization.Gauge(document.getElementById('chart_humidity2'));
            chart2.draw(data, options2);

        }
        var optionsCompositive = {
            opt1: options,
            opt2: options2
        }
        return optionsCompositive;
    }

    //-------------------------------------------------------------------------------------------------

    function reDrawHumidityChart(dataResponse, options) {

        let hasElementMax = dataResponse.filter(vendor => vendor['code'] === 'S-HUM' && vendor['type_calc'] === 'MAX')
        let hasElementMin = dataResponse.filter(vendor => vendor['code'] === 'S-HUM' && vendor['type_calc'] === 'MIN')

        let dateRegisterMax = hasElementMax[0].created_at;
        let dateRegisterMin = hasElementMin[0].created_at;

        document.getElementById('humidityDateMax').innerHTML = moment(dateRegisterMax).format('MM/DD/YYYY HH:mm A');
        document.getElementById('humidityDateMin').innerHTML = moment(dateRegisterMin).format('MM/DD/YYYY HH:mm A');
        document.getElementById("footerHum").style.display = 'block';


        let dataaHumidityMax = 0;
        let dataaHumidityMin = 0;

        if (hasElementMax) {
            dataaHumidityMax = hasElementMax[0].max;
        }
        if (hasElementMin) {
            dataaHumidityMin = hasElementMin[0].max;
        }


        var var_humidity_max = parseFloat(dataaHumidityMax).toFixed(2)
        var var_humidity_min = parseFloat(dataaHumidityMin).toFixed(2)

        var data = google.visualization.arrayToDataTable([
            ['Label', 'Value'],
            ['Max Hum', eval(var_humidity_max)],
        ]);

        var data2 = google.visualization.arrayToDataTable([
            ['Label', 'Value'],
            ['Min Hum', eval(var_humidity_min)],

        ]);

        var chart = new google.visualization.Gauge(document.getElementById('chart_humidity'));

        var chart2 = new google.visualization.Gauge(document.getElementById('chart_humidity2'));
        chart.draw(data, options.opt1);
        chart2.draw(data2, options.opt2);
    }

    //NNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN


//NNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN

 
    window.onload = function () {
        initDrawLineLpaChart(true);
        initDrawTemperatureChart(true);
        initDrawHumidityChart(true);

        genericRefreshData();
        setInterval(function () {
            genericRefreshData();
        }, 10000);
    
    
    };
 