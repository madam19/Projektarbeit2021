

    // fängt "enter" ab und startet "blur" event
    function handleInput(element){
    if(event.keyCode === 13){
    console.log("enter was pressed");
    element.blur();
}
}

    // bei "blur" sende den wert an das php script
    function sendValue(){

    // holt den wert aus input mit id value
    var value = $("#value").val();
    /* value = jQuery("#value").val();*/

    // ausgabe des wertes in die konsole
    console.log("sending value " + value);

    // das php script liegt hier
    let url = "/php/mydata.php";

    // jquery post an das php script
    $.post(
    url,
{
    a: value
},
//     function(returnedData){
//     console.log(returnedData);
//     $("body").append($("<p> "+ value + returnedData + "</p>"));
// }
    );
}
