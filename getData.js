//Developed by: Almira Putri Sandy - 100082480
/*global console, window, XMLHttpRequest, ActiveXObject, document, Chart*/
/* eslint-disable no-console */

//create new XMLHttpRequest
function createRequest() {
    var xHRObject = false;
    if (window.XMLHttpRequest)
        xHRObject = new XMLHttpRequest();
    else if (window.ActiveXObject)
        xHRObject = new ActiveXObject("Microsoft.XMLHTTP");

    return xHRObject;
}

var xhrResp = createRequest();



function getData() {
    var year = document.getElementById("year");
    var selectedYear = year.options[year.selectedIndex].value;
    
    var ctx = document.getElementById('myChart');
    var sunsilkQty = {};
    var sunsilkQtyArray = [];
    var ubermanQty = {};
    var ubermanQtyArray = [];
    var x = 0;

    xhrResp.open("GET", "item_sales_data.php", true);
    xhrResp.onreadystatechange = function () {
        if ((xhrResp.readyState == 4) && (xhrResp.status == 200)) {
            var resp = JSON.parse(xhrResp.responseText);
            console.log(resp);
            for (x = 0; x <12; x++) {
                sunsilkQty[x] = 0;
                ubermanQty[x] = 0;
                for (var i = 0; i < resp.length; i++) {
                    if (resp[i].itemName == "Sunsilk Hair Dye") {
                        if (resp[i].month == x+1 && resp[i].year == selectedYear) {
                            sunsilkQty[x] = parseInt(resp[i].qty);
                        }
                    }
                    
                    if (resp[i].itemName == "UBERMAN Hair Gel") {
                        if (resp[i].month == x+1 && resp[i].year == selectedYear) {
                            ubermanQty[x] = parseInt(resp[i].qty);
                        }
                    }
                }
                sunsilkQtyArray.push(sunsilkQty[x]);
                ubermanQtyArray.push(ubermanQty[x]);
            }

            console.log(ubermanQty);
            console.log(sunsilkQty);
            console.log(sunsilkQtyArray.length);
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    datasets: [{
                            label: 'Sunsilk Hair Dye',
                            borderColor: 'rgba(255, 0, 0, 0.5)',
                            backgroundColor: 'transparent',
                            data: sunsilkQtyArray
            },
                        {
                            label: 'UBERMAN Hair Gel',
                            borderColor: 'rgba(0, 0, 255, 0.5)',
                            backgroundColor: 'transparent',
                            data: ubermanQtyArray

            }],
                    
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                }]
                    }
                }
            });
            
        }
    }

    xhrResp.send(null);
}
