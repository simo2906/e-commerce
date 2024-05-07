function valida_registrazione(){

    if(document.register.nome.value == ""){
        alert("Inserire un nome");
        return false;
    }

    if(document.register.cognome.value == ""){
        alert("Inserire un cognome");
        return false;
    }

    if(document.register.email.value == ""){
        alert("Inserire un email");
        return false;
    }

    if(document.register.password.value == ""){
        alert("Inserire una password");
        return false;
    }

    if(!document.register.checkbox.checked){
        alert("Accettare i termini di servizio");
        return false;
    }

    return true;
}

function valida_login(){

    if(doument.loginForm.email.value == ""){
        alert("Inserire email");
        return false;
    }

    if(document.loginForm.password.value == ""){
        alert("Inserire password");
        return false;
    }

    return true;
}