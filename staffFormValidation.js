function validate() {
    var errors = 0;
    
    //form fields
    var staffName = document.getElementById("staffName").value;
    var staffDOB = document.getElementById("staffDOB").value;
    var staffMale = document.getElementById("genderMale");
    var staffFemale = document.getElementById("genderFemale");
    var staffPhone = document.getElementById("staffPhone").value;
    var staffEmail = document.getElementById("staffEmail").value;
    var staffRole = document.getElementById("staffRole").value;
    
    //error texts
    var staffNameError = document.getElementById("staffNameError");
    var staffDOBError = document.getElementById("staffDOBError");
    var staffGenderError = document.getElementById("staffGenderError");
    var staffPhoneError = document.getElementById("staffPhoneError");
    var staffEmailError = document.getElementById("staffEmailError");
    var staffRoleError = document.getElementById("staffRoleError");
    
    if (staffName == "") {
        errors += 1;
        staffNameError.innerHTML = "Please Enter Staff Name";
    } else {
        staffNameError.innerHTML = "";
    }
    
    if (staffDOB == "") {
        errors += 1;
        staffDOBError.innerHTML = "Please Select Staff Date of Birth";
    } else {
        staffDOBError.innerHTML = "";
    }
    
    if (!staffMale.checked && !staffFemale.checked) {
        errors += 1;
        staffGenderError.innerHTML = "Please Select Staff Gender";
    } else {
        staffGenderError.innerHTML = "";
    }
    
    if (staffPhone == "") {
        errors += 1;
        staffPhoneError.innerHTML = "Please Enter Staff Phone Number";
    } else {
        staffPhoneError.innerHTML = "";
    }
    
    if (staffEmail == "") {
        errors += 1;
        staffEmailError.innerHTML = "Please Enter Staff Email";
    } else {
        staffEmailError.innerHTML = "";
    }
    
    if (staffRole == "") {
        errors += 1;
        staffRoleError.innerHTML = "Please Select Staff Role";
    } else {
        staffRoleError.innerHTML = "";
    }
    
    if (errors == 0) {
		return true;
    } else {
        return false;
    }
}