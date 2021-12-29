function search(){
    xhr = new XMLHttpRequest();
    if (xhr==null){
        alert('Probleem met het aanmaken van een XMLHttpRequest.');
    } else {
        var url="./includes/productSearch.php?t=" + new Date().getTime();
        var searchData=$("#search").val();
        xhr.onreadystatechange=showProducts;
        xhr.open("POST",url,true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send(`search=${searchData}`);
    }
}

function showProducts(){
    if (xhr.readyState == 4 && xhr.status == 200){
        document.getElementById("products").innerHTML = xhr.responseText;
    }
}

$().ready(() => {
    search();
    $("#search").keyup(search);
})