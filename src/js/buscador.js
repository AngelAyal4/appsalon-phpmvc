document.addEventListener('DOMContentLoaded', function() {
    iniciarApp();
});

function iniciarApp(){
    buscarPorFecha();
}

function buscarPorFecha(){

    //Esto coloca la fecha seleccionada en la barra de direccion para poder tomarla con PHP y hacer la consulta
    const fechaInput = document.querySelector('#fecha');
    fechaInput.addEventListener('input', function (e){
        const fechaSeleccionada = e.target.value;

        window.location = `?fecha=${fechaSeleccionada}`;
    })
}