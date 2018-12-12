
//this function ask user for input and returns the strin with the values and operations to do
function getCadena() {
    var cadOp = prompt("Introduzca la cadena deseada junto con las operaciones desadas separadas por ';'\n\
                        \nLas operaciones son: sub(ini, fin) cat(cadena) rep(buscar, reemplazar)");
    return cadOp;
}

//this function scan the cad from the user and returns an array with the results
function scanCad(cad) {

    var cadArray = cad.split(";");
    var numOp = cadArray.length - 1;//number of operations
    var ops = [cadArray[0]];//add first elem to new array
    var aux;
    var s, x1, x2;
    
    //goes thru all operations
    for(var i = 1; i<=numOp;i++){
        aux = cadArray[i];
        s = aux.split("(");//to know the operation
        
        if(s[0] === "sub"){
            
            s = s[1].substr(0,s[1].length-1);
            s = s.split(",");//get the indexs
            
            x1 = parseInt(s[0]);
            x2 = parseInt(s[1]);
            
            ops[i] = sub(x1,x2,ops[i-1]);//call to the operation
            
            console.log(ops[i]);
            
        }else if(s[0] === "cat"){
            
            s = s[1].substr(0,s[1].length-1);//get the string to concatenate
            ops[i] = cat(ops[i-1],s);
                        console.log(ops[i]);

        }else if(s[0] === "rep"){
            
            s = s[1].substr(0,s[1].length-1);
            s = s.split(",");//get the parameters
            
            ops[i] = rep(s[0],s[1],ops[i-1]);
                        console.log(ops[i]);

        }
    }

    return ops;
}

//returns substring from ini to fin
function sub(ini, fin, cad) {
    console.log(ini);
    console.log(fin);
    console.log(cad);
    //need to pare the string to ints
    ini = parseInt(ini)-1;
    fin = parseInt(fin);
    
    var res = cad.slice(ini, fin);
    
    return res;


}

//this function add the the string cadena to the main string
function cat(cadOrig, cadena) {

    return cadOrig.concat(cadena);

}


//this function will replace the string buscar with reemplazar
function rep(buscar, reemplazar, cad) {

    var cadArray = Array.from(cad);
    
    for(var i=0;i<cad.length;i++){
        
        if(cadArray[i] === buscar){
            cadArray[i] = reemplazar;
        }
    }
    
    return cadArray.join("");

   // return cad.replace(buscar, reemplazar);

}