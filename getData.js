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
    var ctx = document.getElementById('myChart').getContext('2d');
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
                for (var i = 0; i < resp.length; i++) {
                    if (resp[i].itemName == "Sunsilk Hair Dye") {
                        if (resp[i].month == x+1) {
                            sunsilkQty[x] = parseInt(resp[i].qty);
                        } 
                        else if(resp[i].month != x){
                            sunsilkQty[x] = 0;
                        }
                    }
                    if (resp[i].itemName == "UBERMAN Hair Gel") {
                        if (resp[i].month == x+1) {
                            ubermanQty[x] = parseInt(resp[i].qty);
                        }
                        else if(resp[i].month != x){
                            ubermanQty[x] = 0;
                        }
                    }
                }
            }

            for (var y = 0; y < 12; y++) {
                sunsilkQtyArray.push(sunsilkQty[y]);
                ubermanQtyArray.push(ubermanQty[y]);
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
