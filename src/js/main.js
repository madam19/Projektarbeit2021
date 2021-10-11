// fängt "enter" ab und startet "blur" event
function handleInput(element) {
    if (event.keyCode === 13) {
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




function saveDay() {
    let rowId = $(event.currentTarget).data("datum");
    let row = $('#' + rowId);
    // console.log(row);

    let kommenZeit = row.find(".kommenZeit input").val();
    let gehenZeit = row.find(".gehenZeit input").val();
    let pause = row.find(".pause input").val();
    let abwesungsGrund = row.find("select").val();
    let AB_ID = 1;


// kontroll "AbwesungsGrund"
    if (abwesungsGrund == "Urlaub") {
        AB_ID = 3;
        kommenZeit = "08:00:00";
        gehenZeit = "16:30:00";
        pause = "00:30:00";
    } else if (abwesungsGrund == "krank") {
        AB_ID = 2;
        kommenZeit = "08:00:00";
        gehenZeit = "16:30:00";
        pause = "00:30:00";
    }


    $.post(
        "../php/sendZeit.php",
        {
            kommenZeit: kommenZeit,
            gehenZeit: gehenZeit,
            datum: rowId,
            pause: pause,
            abwesungsGrundID: AB_ID


        },
        function handleResult(result) {
            console.log(result);
            // console.log('erforgreich');
         }
    );
    // console.log("Datei send");

}
function berechnet() {
    let rowId = $(event.currentTarget).data("datum");
    let row = $('#' + rowId);

}