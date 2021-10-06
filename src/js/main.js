

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
            // ausgabe des wertes in die konsole
        console.log("sending value " + value);

    }
    function getWeekDay(date) {
        let days = ['Sontag', 'Montag', 'Dienstag', 'Mittwoch', 'Donnerstag', 'Freitag', 'Samstag'];

        return days[date.getDay()];
    }


    function sendZeit() {

        var datum = $(event.currentTarget).data("datum");
        var id = $(event.currentTarget).data("users_ID");

        // holt den wert aus input mit id value
        let value = $("#value").val();


        /* value = jQuery("#value").val();*/

        // ausgabe des wertes in die konsole
        // console.log("sending value " + value);
    //
    }