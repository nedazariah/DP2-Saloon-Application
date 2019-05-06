//Developed by: Almira Putri Sandy - 100082480
/*global console, window, XMLHttpRequest, ActiveXObject*/
/* eslint-disable no-console */

//create new XMLHttpRequest
function createRequest(){
	var xHRObject = false;
	if(window.XMLHttpRequest)
		xHRObject = new XMLHttpRequest();
	else if(window.ActiveXObject)
		xHRObject = new ActiveXObject("Microsoft.XMLHTTP");
	
	return xHRObject;
}

var xhrResp = createRequest();

function getData(){
    xhrResp.open("GET","item_sales_data.php",true);
    xhrResp.onreadystatechange = function(){
        if((xhrResp.readyState == 4) && (xhrResp.status == 200)){
            var resp = xhrResp.response;
            console.log(resp);
        }
    }
    xhrResp.send(null);
}