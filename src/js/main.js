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


// function sendZeit() {
//
//     var datum = $(event.currentTarget).data("datum");
//     var id = $(event.currentTarget).data("users_ID");
//
//     // holt den wert aus input mit id value
//     let value = $("#kommenZeit").val();
// }

function saveDay() {
    let rowId = $(event.currentTarget).data("datum");
    let row = $('#' + rowId);
    // console.log(row);

    let kommenZeit = row.find(".kommenZeit input").val();
    let gehenZeit = row.find(".gehenZeit input").val();
    let pause = row.find(".pause input").val();
    let abwesungsGrund = row.find("select").val();



    console.log('"' + abwesungsGrund + '"');
    //console.log(gehenZeit);

    $.post(
        "../php/sendZeit.php",
        {
            kommenZeit: kommenZeit,
            gehenZeit: gehenZeit,
            datum: rowId,
            pause: pause,
            abwesungsGrund: abwesungsGrund


        },
        function error(result) {
            console.log(result);
        }
    )

}


/* value = jQuery("#value").val();*/

// ausgabe des wertes in die konsole
// console.log("sending value " + value);
//

// function sendZeit() {
//
//     let datum = $(event.currentTarget).data("datum");
//     let id = $(event.currentTarget).data("users_ID");
//     let key = $("#data-id").val();

//     let value = $("#value").val();
//     $.post(
//         '../php/sendZeit.php',
//         {
//             Datum: datum,
//             user_ID: id,
//             key: key,
//             value: value
//         }

//     )
// }
/* value = jQuery("#value").val();*/

// ausgabe des wertes in die konsole
// console.log("sending value " + value);
//
