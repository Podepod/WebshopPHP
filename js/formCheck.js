function formAlert(){
    var alertDiv = document.getElementById("formAlert");
    alertDiv.innerHTML = `
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle-fill"></i>
            <strong>Vul het formulier juist in.</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    `;
}

function isDate(date) {
    return (new Date(date) !== "Invalid Date") && !isNaN(new Date(date));
}

function checkSignin(form){
    var juist = true;

    var naam = document.getElementById("naam").value;
    var familieNaam = document.getElementById("familieNaam").value;
    var geboortedatum = document.getElementById("geboorte").value;
    var email = document.getElementById("email").value;
    var password1 = document.getElementById("password").value;
    var password2 = document.getElementById("password2").value;
    var straat = document.getElementById("straat").value;
    var nummer = document.getElementById("nummer").value;
    var stad = document.getElementById("stad").value;
    var postcode = document.getElementById("postcode").value;

    // check of namen lang genoeg zijn
    if (naam.length < 2 || familieNaam.length < 2) juist = false;

    // check of de geboortedatum een geldige datum
    if (geboortedatum.length == null || !isDate(geboortedatum)) juist = false;

    // check of email een geldige email is
    if (!(/^[0-9,a-z]+(.[0-9,a-z]+)+@[a-z]+\.[a-z][a-z][a-z]?$/.test(email))) juist = false;

    // check of passwoorden overeen komen
    if (password1.length < 2 || password2.length < 2 || password1 != password2) juist = false;

    // check of de straatnaam lang genoeg is
    if (straat.length < 2) juist = false;

    // check of de straatnummer een nummer met dan mogelijks een letter is
    if (!(/^[0-9]+[a-z]?/i.test(nummer))) juist = false;

    
    // check of de stad lang genoeg is
    if (stad.length < 2) juist = false;

    // check of de postcode een geldige postcode is
    if (!(/^[0-9][0-9][0-9][0-9]$/.test(postcode))) juist = false;
    

    if (!juist){
        formAlert();
    }
    return juist;
}
