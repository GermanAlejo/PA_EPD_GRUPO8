var ganador = ["2", "12", "19", "35", "44", "45"];
var premios = ["0", "0", "0", "90", "3000", "150000", "1000000"];

function comprobardiv(div) {

    var childs = div.childNodes;
    var numAciertos = 0;

    for (var i = 0; i < childs.length; i++) {
        if (childs[i].nodeName == "INPUT" && childs[i].value == ganador[i]) {
            numAciertos++;
        }

        if (i == childs.length) {
            var span = childs[i];
        }
    }

    pintaAciertos(span, numAciertos);
}

function pintaAciertos(span, numAciertos) {

    var premio;

    switch (numAciertos) {

        case 3:
            premio = ganador[3];
            break;
        case 4:
            premio = ganador[4];
            break;
        case 5:
            premio = ganador[5];
            break;
        case 6:
            premio = ganador[6];
            break;
        default :
            premio = ganador[0];
            break;
    }

    span.textContent = "Tiene " + numAciertos + " y su premio es de " + premio + "€";

    return span;

}

function comprobar() {

    var allComb = document.getElementById("combinaciones").childNodes;

    for (var i = 0; i < allCom.length; i++) {
        comprobardiv(allComb[i]);
    }
}

function checkInput(input) {

    var aux = input.value;
    if (!isNaN(aux)) {

    }
}

function agregarCombinacion() {

    var parent = document.getElementById(combinaciones);
    var newDiv = document.createElement("div");
    var idNum = parent.id;
    idNum = idNum.slice(idNum - length - 1)
    idNum = parseInt(idNum) + 1;
    var newId = "combinacion" + idNum;
    idNum++;
    newDiv.setAttribute("id", newId);

    for (var i = 0; i < 7; i++) {

        if (i != 6) {

            var newInput = document.createElement("input");
            newInput.setAttribute("type", "text");
            newInput.setAttribute("size", "5");
            newInput.setAttribute("class", "numPrimitiva");
            newInput.setAttribute("onkeyup", "validad(this)");

            newDiv.appendChild(newInput);
        } else {
            var newSpan = document.createElement("span");
            newDiv.appendChild(newSpan);
        }
    }
    
    
}
