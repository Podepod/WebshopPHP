function checkForm(form){
    var elements = form.querySelectorAll("input")
    var allesIngevuld = true;

    /*
        text
        number
        date
        password
    */

    for (var i = 0, element; element = elements[i++];){
        console.log(element);
        console.log(element.name);
        console.log(element.value);
        console.log(element.type);
        console.log("========================================================");

        // check of er al een .valid of .invalid staat


        if (element.value == "" || element.value == null) {
            element.classList.add("invalid");
            continue;
        }

        switch(element.type){
            case "text":
                break;
            case "number":
                console.log("Numberding");
                break;
            case "date":
                console.log("DateDing");
                break;
            case "password":
                console.log("Passwordding");
                break;
            default:
                console.log("DefaultDing");
        }
    }
    
    // geef de form een .was-validated als die dat nog niet heeft
    form.classList.add("was-validated");
    return false
}

function checkSignin(form){
    if (!checkForm(form)) return false;



}

