document.getElementById("nform").onsubmit = function(){
    
    var message = "";
    var serviceName = document.getElementById("serviceName").value;
    var serviceCharge = document.getElementById("serviceCharge").value;
    
    if(serviceName == "" || serviceName == null)
    {
        alert("Service name cannot be empty");
        return false;
    }
    else
    {

        if(serviceCharge == "" || serviceCharge == null || serviceCharge == 0)
        {
			return confirm("Are you sure with the fields?\nService charge is set at 0 or not filled.");
        }
        else
        {
            return confirm("Confirm form submission?");
        }
    }
}
