//NNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN
function refreshData(myLineChart) {
    client = JSON.parse(window.localStorage.getItem('username'));

    $.ajax({
        url: 'php/index.php/sensores/chart',
        data: 'cdClient=' + client.code,
        dataType: 'json',
        success: function (responseText) {

            let arrayLabels = responseText[0][0].labels;
            let dataS = createDataset(responseText[0][0].arraySensor);
            let labelReverse = arrayLabels.reverse();
            let arrayLabelsFormat = labelReverse.map(label => {
                return moment(label).format("HH:mm:ss")
            });

            let ds = [{
                data: dataS['temperature'],
                label: "Temperatura",
                borderColor: "#ba3c57",
                backgroundColor: "#ba3c57",
                borderWidth: 2,
                fill: false
            }, {
                data: dataS['humidity'],
                label: "Humedad",
                borderColor: "#3e95cd",
                backgroundColor: "rgb(62,149,205)",
                borderWidth: 2,
                fill: false
            },
            {
                data: dataS['lpa'],
                label: "LPA",
                borderColor: "#ffb266",
                backgroundColor: "#ffb266",
                borderWidth: 2,
                fill: false
            },
            ];

            myLineChart.data.labels = arrayLabelsFormat;
            myLineChart.data.datasets = ds;
            myLineChart.update();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(errorThrown + ': ' + textStatus);
        }
    });
}

function createDataset(arrayData) {


    let arrayHumidity = arrayData["S-HUM"].map(label => {
        return { "x": moment(label["created_date"]).format("HH:mm:ss"), "y": label["humidity"] }
    });

    let arrayTemp = arrayData["S-TEMP"].map(label => {
        return { "x": moment(label["created_date"]).format("HH:mm:ss"), "y": label["temperature"] }
    });
    let arrayLpa = arrayData["S-CLP"].map(label => {
        return { "x": moment(label["created_date"]).format("HH:mm:ss"), "y": label["pla"] }
    });
    let obj = {};
    obj['humidity'] = arrayHumidity;
    obj['temperature'] = arrayTemp;
    obj['lpa'] = arrayLpa;

    return obj;

}
//NNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN


$(document).ready(function () {
    var ctx = document.getElementById('myChart').getContext('2d');

    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [],
            datasets: [{
                data: [
                ],
                label: "Temperatura",
                borderColor: "#ba3c57",
                backgroundColor: "#ba3c57",
                borderWidth: 2,
                fill: false
            }, {
                data: [
                ],
                label: "Humedad",
                borderColor: "#3e95cd",
                backgroundColor: "rgb(62,149,205)",
                borderWidth: 2,
                fill: false
            },
            {
                data: [
                ],
                label: "LPA",
                borderColor: "#ffb266",
                backgroundColor: "#ffb266",
                borderWidth: 2,
                fill: false
            },
            ]
        },
        options: {
            plugins: {
                title: {
                    display: false,
                    text: 'Temperatura-Humedad-Lpa'
                }
            },
            tension: 0.4,
            animation: {
                duration: 1
            },
            pointRadius: 3.5,
            pointHoverRadius: 6,
            responsive: true,
            maintainAspectRatio: false,

            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        
                    }
                }]
            },
            locale: 'en-US'

        }
    });

    fetchRequestApi(myChart);
})



function fetchRequestApi(myLineChart) {
    client = JSON.parse(window.localStorage.getItem('username'));

    $.ajax({
        url: 'php/index.php/sensores/chart',
        data: 'cdClient=' + client.code,
        dataType: 'json',
        success: function (responseText) {

            let arrayLabels = responseText[0][0].labels;
            let dataS = createDataset(responseText[0][0].arraySensor);
            let labelReverse = arrayLabels.reverse();
            let arrayLabelsFormat = labelReverse.map(label => {
                return moment(label).format("HH:mm:ss")
            });

            let ds = [{
                data: dataS['temperature'],
                label: "Temperatura",
                borderColor: "#ba3c57",
                backgroundColor: "#ba3c57",
                borderWidth: 2,
                fill: false
            }, {
                data: dataS['humidity'],
                label: "Humedad",
                borderColor: "#3e95cd",
                backgroundColor: "rgb(62,149,205)",
                borderWidth: 2,
                fill: false
            },
            {
                data: dataS['lpa'],
                label: "LPA",
                borderColor: "#ffb266",
                backgroundColor: "#ffb266",
                borderWidth: 2,
                fill: false
            },
            ];

            myLineChart.data.labels = arrayLabelsFormat;
            myLineChart.data.datasets = ds;
            myLineChart.update();

            setInterval(function () {
                refreshData(myLineChart);
            }, 10000);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(errorThrown + ': ' + textStatus);
        }
    });

}