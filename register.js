function validateForm() {
    var name = document.forms["register"]["sname"].value;
    
    var email = document.forms["register"]["email"].value;
   
    var password = document.forms["register"]["password"].value;
    var cpassword = document.forms["register"]["cpassword"].value;
    
    
    var nameReg = /^(?=.*[a-z])(?=.*[A-Z]).{3,}$/;
    
    var emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;

    var passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$/;
    var cpasswordRegex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$/;
   
    

    if (!nameReg.test(name)) {
        alert("Name must contain atleast one uppercase and lowercase");
        document.register.name.focus();
        return false;
    }
    if (!emailRegex.test(email)) {
        alert("Email must contains email format");
        document.register.email.focus();
        return false;
    }
    
   
    if (!passwordRegex.test(password)) {
        alert("Password should contain atleast one uppercase and lowercases");
        document.register.password.focus();
        return false;
    }
    if (!cpasswordRegex.test(cpassword)) {
        alert("Password should contain atleast one uppercase and lowercases");
        document.register.password.focus();
        return false;
    }
    
    
    return true;
    }