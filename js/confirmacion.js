/*Cuadro de confirmacion para actualizar*/
function confirmacion(){
    var respuesta = confirm("¿Quieres actualuizar los datos?");
    if (respuesta == true) {
        return true;
    } else {
        return false;
    }
}