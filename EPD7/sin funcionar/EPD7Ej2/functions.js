function toFixed(cad1, cad2, dec) {

}

function check2(num){
    alert(num);
}

function compruebaCad(cad) {
    var isOk = false;
    var i = 0;

    while (!isOk || i < cad.length) {
        if (cad.charCodeAt(i) === '.') {
            isOk = true;
        }
        i++;
    }

    return isOk;
}

function fillZeros(cad, dec) {

    var encontrado = false;
    var i = 0;
    var pos;
    var numDec = cad.length - (Math.trunc(cad)).length;

    if (numDec < dec) {

        for (var i = 0; i < dec; i++) {
            
            if(i === cad.length){
                cad += '0';
            }    
            
           /* if (encontrado) {
                cad.replaceAt(i, '0');
            }*/

        }
    }
    
    return cad;
}

String.prototype.replaceAt = function (index, replacement) {
    return this.substr(0, index) + replacement + this.substr(index + replacement.length);
}


