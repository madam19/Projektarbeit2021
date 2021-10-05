

    // fängt "enter" ab und startet "blur" event
    function handleInput(element){
    if(event.keyCode === 13){
    console.log("enter was pressed");
    element.blur();
    }
    }

    // bei "blur" sende den wert an das php script
    function sendValue() {

        // holt den wert aus input mit id value
        let value = $("#month").val();


        /* value = jQuery("#value").val();*/

        // ausgabe des wertes in die konsole
        console.log("sending value " + value);

    }
