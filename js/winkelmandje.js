function berekenTotaal(){
    let totaal = 0;
    let totaalAantal = 0;

    $(".aantalItems").each(function(){
        totaal += $(this).attr("data-bs-prijs") * $(this).val();
        totaalAantal += parseInt($(this).val());
    })

    $("#totaal0").html(totaal.toFixed(2));
    $("#totaal1").html(totaal.toFixed(2));
    $("#totaalAantal").html(totaalAantal);
}

$().ready(() => {
    $(".aantalItems").each(function(){
        let textField = $(this).attr("data-bs-textField");
        let nieuwePrijs = ($(this).attr("data-bs-prijs") * $(this).val()).toFixed(2);
        $(`#${textField}`).html(nieuwePrijs);

        $(this).on("input", function(el){
            let textField = $(this).attr("data-bs-textField");
            let nieuwePrijs = ($(this).attr("data-bs-prijs") * $(this).val()).toFixed(2);
            $(`#${textField}`).html(nieuwePrijs);
            berekenTotaal();
        })
    })

    berekenTotaal();
});