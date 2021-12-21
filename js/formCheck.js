function checkForm(form){
    var elements = form.querySelectorAll("input")

    for (var i = 0, element; element = elements[i++];){
        console.log(element);
        console.log(element.name);
        console.log("========================================================");
    }
    return false
}

