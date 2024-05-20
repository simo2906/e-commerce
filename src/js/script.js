function valida_registrazione(){

    if(document.register.nome.value == ""){
        alert("Inserire un nome");
        return false;
    }

    if(document.register.cognome.value == ""){
        alert("Inserire un cognome");
        return false;
    }

    if(document.register.telefono.value == ""){
        alert("Inserire numero di telefono");
        return false;
    }

    if(!document.register.telefono.value.match(/^((00|\+)39[\. ]??)??3\d{2}[\. ]??\d{6,7}$/)){
        alert("inserire un numero di telefono valido");
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

function redirectToLogin() {
    window.location.href = "./login/login.php";
}

function cambiaImmagine(elemento) {
    var immagine = elemento;
    var id_prod = immagine.getAttribute('data-id-prod');
    if (immagine.src.match("./img/hearth.png")) {
        $.ajax({
            url: './preferiti/aggiungipreferiti.php',
            type: 'POST',
            data: {id_prod: id_prod},
            success: function(response) { 
                console.log(response);
                immagine.src = "./img/hearth_black.png" 
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });
        
        
    } else {
        $.ajax({
            url: './preferiti/rimuovipreferiti.php',
            type: 'POST',
            data: {id_prod: id_prod}, 
            success:function(response) { 
                console.log(response);
                immagine.src = "./img/hearth.png"
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });
    }
}

function valida_insertAd(){
    if(!document.insertAd_form.productPrice.value.test("/[1-9]\d*(?:\.\d{2})/")){
        alert("Il prezzo non è numerico");
        return false;
    }
    return true;
}

function previewImage(previewId, inputId, id) {
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
      preview.innerHTML = '<b class="photo-icon">' + id + '</b>';
    }
  }


  function valida_annuncio(){

    if(document.insertAd_form.productTitle.value == ""){
        alert("Inserire il titolo dell'articolo");
        return false;
    }

    if(document.insertAd_form.productCategory.value == ""){
        alert("Scegliere la categoria dell'articolo");
        return false;
    }

    if(document.insertAd_form.productPrice.value == ""){
        alert("Inserire il prezzo dell'articolo");
        return false;
    }

    if(document.insertAd_form.productMunicipality.value == ""){
        alert("Inserire la località dell'articolo");
        return false;
    }

    if(document.insertAd_form.fileToUpload1.value == "" ){
        alert("Caricare la prima immagine");
        return false;
    }

    if(document.insertAd_form.productQuantity.value == "" ){
        alert("Caricare quantità del prodotto");
        return false;
    }

    return true;
}


function apriPopup(elemento){
    document.getElementById("transparentDiv").style.display="block";
    document.getElementById("acquistaPopup").style.display = "block";
    document.getElementById("costoOggetto").innerHTML = elemento.getAttribute("data-id-costoArtic") + "€";
    document.getElementById("costoSpedizione").innerHTML =  elemento.getAttribute("data-id-costoSped") + "€";
    document.getElementById("costoTotale").innerHTML = parseInt(elemento.getAttribute("data-id-costoArtic")) + parseInt(elemento.getAttribute("data-id-costoSped")) + "€";
    document.getElementById("acquistaButton").setAttribute("data-id-href", "./successbuy.php?id=" + elemento.getAttribute("data-id-prod"));
}

function chiudiPopup(){
    document.getElementById("transparentDiv").style.display="none";
    document.getElementById("acquistaPopup").style.display = "none";
}

function controllaOrdine(){
    if(!document.getElementById("indirizzoSped").value.match(/^(Via|Viale|Piazza|via|viale|piazza) \w+$/gm)){
        alert("Il campo indirizzo non è valido");
        return false;
    }
    if(!document.getElementById("nCivSped").value.match(/^\d+$/gm)){
        alert("Il campo numero civico non è valido");
        return false;
    }
    if(!document.getElementById("cittaSped").value.match(/^(\w+)+$/gm)){
        alert("Il campo città non è valido");
        return false;
    }
    if(!document.getElementById("provinciaSped").value.match(/^\w{2}$/gm)){
        alert("Il campo provincia non è valido");
        return false;
    }
    if(!document.getElementById("paeseSped").value.match(/^\w+$/gm)){
        alert("Il paese non è valido");
        return false;
    }
    if(!document.getElementById("zipCodeSped").value.match(/^\d{5}$/gm)){
        alert("Il codice postale non è valido");
        return false;
    }
    if(!document.getElementById("numeroCarta").value.match(/^(\d{4}|\d{4} ){4}$/gm)){
        alert("Il numero della carta è sbagliato");
        return false;
    }
    if(!document.getElementById("dataScadenza").value.match(/^\d{2}\/\d{2}$/gm)){
        alert("Data di scadenza non valida");
        return false;
    }
    if(!document.getElementById("nomeTitolare").value.match(/^(\w+|\w+ )+$/gm)){
        alert("Il nome del titolare non è valido");
        return false;
    }
    if(!document.getElementById("CVV").value.match(/^\d{3}|\d{4}$/gm)){
        alert("Il CVV non è valido");
        return false;
    }
    
    window.location.href = document.getElementById("acquistaButton").getAttribute("data-id-href");
    return true;
    
}

