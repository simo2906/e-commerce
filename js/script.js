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

function cambiaImmagine(id) {
    var immagine = document.getElementById(id);
    if (immagine.src.match("./img/hearth.png")) {
        immagine.src = "./img/hearth_black.png";
    } else {
        immagine.src = "./img/hearth.png";
    }
}

function valida_insertAd(){
    if(!document.insertAd_form.productPrice.value.test("/[1-9]\d*(?:\.\d{2})/")){
        alert("Il prezzo non è numerico");
        return false;
    }
    return true;
}

function previewImage(previewId, inputId) {
    var preview = document.getElementById(previewId);
    var file = document.getElementById(inputId).files[0];
    var reader = new FileReader();
  
    reader.onloadend = function() {
      preview.style.backgroundImage = 'url("' + reader.result + '")';
    };
  
    if (file) {
      preview.innerHTML = null;
      reader.readAsDataURL(file);
    } else {
      preview.style.backgroundImage = null;
      preview.innerHTML = '<img class="photo-icon" src="./img/camera.png">'
    }
  }
  