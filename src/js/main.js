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
        }
    );
    // console.log("Datei send");

}

// function berechnet() {
//     let rowId = $(event.currentTarget).data("datum");
//     let row = $('#' + rowId);
//
// }
function createTable(result, month, year) {
    // console.log(result);
    let data = JSON.parse(result);
    //console.log(data);
    let controlData = false; // default - new monat
    let akzept = false; //kontrolieren akzept

    // kontroll exist data in Db and accept
    if (data.length != 0) {
        controlData = true;
        (data[0]['akzeptiert'] == '1') ? akzept = true : '';//kontrolieren akzept
    }
    //building a table by month
    // let head = ["Datum", "Tag", "kommenZeit", "gehenZeit", "pause", "sollStunde", "ISTStunde",
    //     "Saldo", "abwesungsGrund", "GesamtSaldo", "Akzept"];

    let headText = ["Datum", "Wochentag", "kommen Zeit", "gehen Zeit", "pause", "soll Stunde", "IST Stunde",
        "Saldo", "abwesungs Grund", "Gesamt Saldo", "Akzept"];

    //building a table by month V1

    let body = document.body,
        table = document.createElement("table");
    $('table').empty(); //remove table, if had
    //  document.body.innerHTML = "";
    let styleTable = 'background-color: #F5F5CA; width: 100%; text-align: center; ';
    table.className = 'table table-bordered border-secondary caption-top align-center';

    table.style = styleTable;
    table.setAttribute('border', '2px');

    let row = table.insertRow();

    // create head table
    for (let i = 0; i < headText.length; i++) {
        let cell = row.insertCell();
        cell.innerHTML = headText[i];
        cell.setAttribute('border', '2px');
    }
    //make array Day in this month
    let endMonth = new Date(year, month, 0).getDate(); // number day in this month
    let nowDay = new Date(year, month, 1).getDate(); // 1 day
    let arrDays = new Array();
    for (let i = 1; i <= endMonth; i++) {
        // make format yyyy-mm-dd
        let dd = nowDay;
        dd < 10 ? dd = '0' + dd : '';  //add 0, if day < 10
        let mm = month;
        mm < 10 ? mm = '0' + mm : '';
        let day = year + "-" + mm + "-" + dd;
        //an attempt to output the day to an array. It turned out a lot of data
        // console.log(day);
        arrDays [i] = day;
        nowDay++;
    }


    let disabled = akzept ? "disabled" : '';
    let styles = akzept ? "background-color: darkseagreen; color: green;" : "background-color:  #efe1c8; font-weight: bold; color: red;";
    //  try highlight line

    // $( "#target" ).click(function() {
    //     styles = 'background-color: olive;';
    // });
    let dayToday;
    let head = new Array();
    let usersArbeitsModel = data[0]['AM_ID'];

    //draw  table from days for this month
    for (let i = 1; i < arrDays.length; i++) {
        row = table.insertRow();  // ellement array day - row
        row.id = arrDays[i];
        for (let j = 1; j <= headText.length; j++) {   // element head  - cell
            let cell = row.insertCell();
            let text = '';
            head [j] = (headText[j - 1]).replace(/ /g, '');
            cell.className = head[j];
            switch (j) {
                case 1:
                    text = arrDays[i];
                    break;
                case 2: // wochentag per date
                    let days = ['Sonntag', 'Montag', 'Dienstag', 'Mittwoch', 'Donnerstag', 'Freitag', 'Samstag'];
                    let dat = new Date(arrDays[i]); //

                    text = days[dat.getDay()];

                    // if Sa-So come next row
                    dayToday = text;

                    if (text == 'Sonntag' || text == 'Samstag') {
                        j = headText.length;
                    }

                    break;
                case 3: // kommen Zeit
                    text = '<input data-id="kommenZeit" data-datum="' + arrDays[i] + '" type="time" name="$str" style= "' + styles + '" value= "00:00" onkeydown="handleInput(this)" onblur="saveDay()"' + disabled + '>';


                    break;
                case 4: // gehenZeit
                    text = '<input data-id="gehenZeit" data-datum="' + arrDays[i] + '" type="time" name="$str" style= "' + styles + '" value= "00:00" onkeydown="handleInput(this)" onblur="saveDay()"' + disabled + '>';
                    break;
                case 5: //pause
                    text = '<input data-id="pause" data-datum="' + arrDays[i] + '" type="time" name="$str" style= "' + styles + '" value= "00:30" onkeydown="handleInput(this)" onblur="saveDay()"' + disabled + '>';

                    break;
                case 6: //soll Stunde
// в зависимости от модели работы и дня // depending on working model and day
                    // arbeitModel1 = 20; arbeitModel2 = 37,5; arbeitModel3 = 40;

                    if (usersArbeitsModel == 2 && dayToday == 'Freitag') {
                        text = "05:30";
                    } else if (usersArbeitsModel == 1) {
                        text = "04:00"
                    } else {
                        text = "08:00"
                    }
                    ;
                    break;

                case
                9
                :// anwesung Grung wenn gibt's


                    text =
                        '<select style="width: 90%" data-datum="' + arrDays[i] + '"name="abwendungsGrund" onchange="saveDay()">' +
                        ' <option value=" " selected> </option>' +
                        '<option style ="text-align: center" value="krank">krank</option>' +
                        '<option style ="text-align: center" value="Urlaub">Urlaub</option>'

                    ;
                    break;

                case
                11
                :// akzeptirt
                    (controlData) ? text = 'noch nicht' : text = 'akzeptiert';
                    break;


            }

            cell.innerHTML = text;
        }
    }
    body.appendChild(table);
    // window.setTimeout(setData, 2000, data, headText, head);
    setData(data, headText, head);  // Add data from the database

}


function setData(data, headText, head) {
    let saldo = 0;
    let sollStunde;
    for (let i = 0; i < data.length; i++) {
        let rowId = data[i]['Datum'];
        let kommenZeit = 0, gehenZeit = 0, pause = 0, istArbeitsZeit = 0, sollStunde = 0;
        // let nowDay = new Date(rowId);
        for (let j = 3; j < headText.length; j++) {
            let daySaldo = 0;
            $('#' + rowId + ' [data-id="' + head[j] + '"]').val(data[i][head[j]]);
// console.log('#' + rowId + ' [data-id="' + head[j] + '"]');

            switch (j) {
                case 3 : //kommen Zeit

                    let strk = new Date(rowId + ' ' + data[i][head[j]]); //.split('-');
                    // console.log(rowId + ' ' + data[i][head[j]]);
                    kommenZeit = strk.getTime() / 1000 / 60; // time in min
                    // console.log("kommenZeit: " + kommenZeit);
                    break;
                case 4: //gehenZeit
                    let strg = new Date(rowId + ' ' + data[i][head[j]]); //.split('-');
                    gehenZeit = strg.getTime() / 1000 / 60; // time in min

                    // console.log("gehenZeit: " + gehenZeit);
                    //console.log(rowId + ' ' + data[i][head[j]] + ' gleich gehen zeit' + gehenZeit); //gehen Zeit in min
                    break;
                case 5: //pause
                    let strp = new Date(rowId + ' ' + data[i][head[j]]);
                    pause = strp.getMinutes();
                    // console.log("pause: " + pause);
                    //console.log(rowId + ' ' + data[i][head[j]] + ' gleich  pause' + pause);
                    // console.log(gehenZeit);
                    break;
                case 6: //soll Stunde
                    let strS = $('#' + rowId + " ." + [head[j]]).html();
                    strS = new Date(rowId + ' ' + strS);

                    sollStunde = strS.getHours() * 60 + strS.getMinutes();  // по кол-ву часов и минут, получаем общее кол-во минут

                    // console.log(strS);
                    // console.log(sollStunde);


                    break;
                case 7: // IST Stunde

                    //calculates work time
                    if (data[i]["abwesungsGrund_Id"] == "2" || data[i]["abwesungsGrund_Id"] == "3") {
                        istArbeitsZeit = sollStunde;
                    } else {
                        istArbeitsZeit = (gehenZeit - kommenZeit) - pause;
                    }


                    let strI = timeToString(istArbeitsZeit);

                    $('#' + rowId + ' .' + head[j]).text(strI).val();
                    break;
                case 8: //calculates  to display Saldo

                    daySaldo = istArbeitsZeit - sollStunde;  // saldo every day
                    let strSaldo = timeToString(daySaldo);
                    saldo += daySaldo;
                    if (data[i]["abwesungsGrund_Id"] == "2" || data[i]["abwesungsGrund_Id"] == "3") {
                        daySaldo = 0;
                    }
                    $('#' + rowId + ' .' + head[j]).text(strSaldo).val();
                    break;
                case 9: //abwesung Grund // расчитывается в зависимости от значения AM_ID
                    if (head[j] == "abwesungsGrund" && data[i]["abwesungsGrund_Id"] == "2") {
                        $('#' + rowId + ' select ').val("krank");

                    } else if (head[j] == "abwesungsGrund" && data[i]["abwesungsGrund_Id"] == "3") {
                        $('#' + rowId + ' select ').val("Urlaub");

                    }
                    break;
                case 10:

                    // console.log(saldo);

                    let strGS = timeToString(saldo)
                    $('#' + rowId + ' .' + head[j]).text(strGS).val();
                    break;
            }
        }

    }

} //end function setData
function timeToString(timeInMin) {
    //calculates the time to display
    let str;
    let zeit = Math.abs(timeInMin);
    let stunde = (zeit / 60 | 0);


    let minute = (zeit % 60);

    console.log(zeit);
    if (stunde >= 0 && stunde < 10) {
        stunde = '0' + stunde
    }

    if (minute >= 0 && minute < 10) {
        minute = '0' + minute
    }

    if (timeInMin < 0) {
        str = ('-' + stunde + ':' + minute);
        // str.style += 'color: red;'
    } else {
        str = (stunde + ':' + minute);
    }

    return str;
}
