let paso = 1;

const cita = {
    id: '',
    nombre: '',
    fecha: '',
    hora: '',
    servicios: [] //Array de servicios
};

document.addEventListener('DOMContentLoaded', function () {
    iniciarApp();
});

function iniciarApp(){
    mostrarSeccion(); //Muestra la seccion de paso actual
    tabs();
    botonesPaginador(); //Agrega o quita los botones del paginador
    consultarAPI(); //Consulta la API en el backend de php

    idCliente();
    nombreCliente(); //Almacena el nombre del cliente al objeto de cita
    selecionarFecha(); //Almacena la fecha de la cita al objeto de cita
    selecionarHora(); //Almacena la hora de la cita al objeto de cita

    mostrarResumen(); //Muestra el resumen de la cita
}

function mostrarSeccion(){

    //Ocultar la seccion anterior
    const seccionAnterior = document.querySelector('.mostrar');
    if(seccionAnterior){
        seccionAnterior.classList.remove('mostrar');
    }

    //Seleccionar la seccion con el paso...
    const pasoSelector = `#paso-${paso}`;
    const seccion = document.querySelector(pasoSelector);
    seccion.classList.add('mostrar');

    //Quitar la clase de actual en el tab anterior
    const tabAnterior = document.querySelector('.tabs .actual');
    if(tabAnterior){
        tabAnterior.classList.remove('actual');
    }

    //Resalta el tab acutal
    const tab = document.querySelector(`[data-paso="${paso}"]`);
    tab.classList.add('actual');

}

function tabs(){
    const botones  = document.querySelectorAll('.tabs button'); //AddeventListener no funciona con querySelectorAll

    botones.forEach( boton => {
        boton.addEventListener('click', function(e){ 
            paso = parseInt(e.target.dataset.paso);
            mostrarSeccion();   
            botonesPaginador();

            if(paso ===3){//Muestra el resumen de la cita cuando se llama el paginador del paso 3
            mostrarResumen(); 
            }
        })
    })    
     
}7

function botonesPaginador() {
    const paginaSiguiente = document.querySelector('#siguiente');
    const paginaAnterior = document.querySelector('#anterior');

    // Asegurar que los botones existen antes de agregar eventos
    if (paginaSiguiente) {
        paginaSiguiente.addEventListener('click', function () {
            if (paso < 3) {
                paso++;
                mostrarSeccion();
                actualizarPaginador();
            }
        });
    }

    if (paginaAnterior) {
        paginaAnterior.addEventListener('click', function () {
            if (paso > 1) {
                paso--;
                mostrarSeccion();
                actualizarPaginador();
            }
        });
    }

    actualizarPaginador();
}

function actualizarPaginador() {
    const paginaSiguiente = document.querySelector('#siguiente');
    const paginaAnterior = document.querySelector('#anterior');

    if (paso === 1) {
        paginaAnterior.classList.add('ocultar');
    } else {
        paginaAnterior.classList.remove('ocultar');
    }

    if (paso === 3) {
        paginaSiguiente.classList.add('ocultar');
        if(paso ===3){//Muestra el resumen de la cita cuando se llama el paginador del paso 3
            mostrarResumen(); 
            }
    } else {
        paginaSiguiente.classList.remove('ocultar');
    }
}

//Consumimos la API de servicios /api/servicios
async function consultarAPI(){
    try{
        const url = `${location.origin}/api/servicios`
        const resultado = await fetch(url);
        const servicios = await resultado.json();
        mostrarServicios(servicios);
    }catch(error){
        console.log(error);
    }
}

function mostrarServicios(servicios){
    servicios.forEach(servicio => {
        const{ id, nombre, precio } = servicio;

        const nombreServicio = document.createElement('P');
        nombreServicio.classList.add('nombre-servicio');
        nombreServicio.textContent = nombre;

        const precioServicio = document.createElement('P');
        precioServicio.classList.add('precio-servicio');
        precioServicio.textContent = `$ ${precio}`;

        //Div contenedor de servicio
        const servicioDiv = document.createElement('DIV');
        servicioDiv.classList.add('servicio');
        servicioDiv.dataset.idServicio = id;
        servicioDiv.onclick = function(){
            seleccionarServicio(servicio);
        }

        //Mostrar servicios en el html
        servicioDiv.appendChild(nombreServicio);
        servicioDiv.appendChild(precioServicio);    

        document.querySelector('#servicios').appendChild(servicioDiv);

    });

}

function seleccionarServicio(servicio){
    const {id} = servicio;
    const {servicios} = cita;
    const divServicio = document.querySelector(`[data-id-servicio="${servicio.id}"]`);
    // Comprombar si el servicio ya esta seleccionado
    if(servicios.some(agregado => agregado.id === id)){
        cita.servicios = servicios.filter(agregado => agregado.id !== id);
        divServicio.classList.remove('seleccionado');
    }else{
        cita.servicios = [...servicios, servicio];
        divServicio.classList.add('seleccionado');
    }
    //console.log(cita); 
}

function idCliente(){
    cita.id = document.querySelector('#id').value;
}

function nombreCliente(){
    cita.nombre = document.querySelector('#nombre').value;
}

function selecionarFecha(){
    const inputFecha = document.querySelector('#fecha');
    inputFecha.addEventListener('input', function(e){
        const dia = new Date(e.target.value).getUTCDay();
        if([0, 6].includes(dia)){
            e.preventDefault();
            e.target.value = '';
            mostrarAlerta('No se puede seleccionar fin de semana', 'error', '.formulario');
        }else{
            cita.fecha = inputFecha.value;
        }
    })
}

function selecionarHora(){
    const inputHora = document.querySelector('#hora');
    inputHora.addEventListener('input', function(e){
        const horaCita = e.target.value;
        const hora = horaCita.split(':');
        if(hora[0] < 10 || hora[0] > 18){
            mostrarAlerta('Hora no valida', 'error', '.formulario');
            setTimeout(() => {
                inputHora.value = '';
            }, 3000);
        }else{
            cita.hora = horaCita;
        }
    })
}

function mostrarAlerta(mensaje, tipo, elemento, desaparece = true){

    //Previene que se genere mas de una alerta
    const alertaPrevia = document.querySelector('.alerta');
    if(alertaPrevia){
        alertaPrevia.remove();
    }

    const alerta = document.createElement('DIV');
    alerta.textContent = mensaje;
    alerta.classList.add('alerta');
    alerta.classList.add(tipo);

    const referencia = document.querySelector(elemento);
    referencia.appendChild(alerta);

    //Eliminar la alerta despues de 3 segundos
    if (desaparece){
        setTimeout(() => {
            alerta.remove();
        }, 3000);
    }
    
    
    
}

function mostrarResumen(){
    const resumen = document.querySelector('.contenido-resumen');
    

    //Limpiar el contenido previo

    while(resumen.firstChild){
        resumen.removeChild(resumen.firstChild);
    }

    if (Object.values(cita).includes('') || cita.servicios.length === 0) {
        mostrarAlerta('Faltan datos de servicios, hora o fecha', 'error', '.contenido-resumen', false);
        return;
    }

    //Formatear el div de resumen
    const {nombre, fecha, hora, servicios} = cita;

    //Heading para servicios en resumen
    const headingServicios = document.createElement('H3');
    headingServicios.textContent = 'Resumen de los servicios seleccionados';
    resumen.appendChild(headingServicios);

    //Iterando y mostrando los servicios
    servicios.forEach(servicio=>{

        const {id, precio, nombre} = servicio
        const contenedorServicio = document.createElement('DIV');
        contenedorServicio.classList.add('contenedor-servicio');

        const textoServicio =  document.createElement('P');
        textoServicio.textContent = nombre;

        const precioServicio =  document.createElement('P');
        precioServicio.innerHTML = `<span>Precio: </span> $${precio}`

        contenedorServicio.appendChild(textoServicio);
        contenedorServicio.appendChild(precioServicio);

        resumen.appendChild(contenedorServicio);
    })

    //Heading para info del cliente
    const headingSCita = document.createElement('H3');
    headingSCita.textContent = 'Resumen de cliente y cita';
    resumen.appendChild(headingSCita);

    const nombreCliente = document.createElement('P');
    nombreCliente.innerHTML = `<span>Nombre: </span> ${nombre}`


    //Formatear la fecha en español
    //Por cada vez que se use un nuevo "new Date" la fecha se desfasa 1 dia asi que hay que sumar en la variable de dia la cantidad de dias de desfase
    const fechaObj = new Date(fecha);
    const mes = fechaObj.getMonth();
    const dia = fechaObj.getDate() + 2; 
    const year = fechaObj.getFullYear();

    const fechaUTC = new Date(Date.UTC(year,mes,dia));

    const opciones = {weekday: 'long', year: 'numeric', month:'long', day:'numeric' }
    
    const fechaFormateada = fechaUTC.toLocaleDateString('es-AR', opciones);

    const fechaCita = document.createElement('P');
    fechaCita.innerHTML = `<span>Fecha: </span> ${fechaFormateada}`

    const horaCita = document.createElement('P');
    horaCita.innerHTML = `<span>Hora: </span> ${hora} Horas`

    //Boton para crear una cita
    const botonReservar = document.createElement('BUTTON');
    botonReservar.classList.add('boton');
    botonReservar.textContent = 'Reservar Cita';
    botonReservar.onclick = reservarCita;

    resumen.appendChild(nombreCliente);
    resumen.appendChild(fechaCita);
    resumen.appendChild(horaCita);

    resumen.appendChild(botonReservar);

}

async function reservarCita(){
    const { nombre, fecha, hora, servicios, id } = cita

    const idServicios = servicios.map(servicio=> servicio.id) //El map a diferencia del foreach este no solo itera sino que tambien busca coincidencia para de volver el resultado buscado

    const datos = new FormData();
    
    datos.append('fecha', fecha);
    datos.append('hora', hora );
    datos.append('usuarioId', id);
    datos.append('servicios', idServicios);

    //Peticion hacia la api.
    try {
        const url = `${location.origin}/api/citas`
        console.log(url);
        const respuesta = await fetch(url, {
            method: 'POST',
            body: datos
        });

        const resultado = await respuesta.json();
        //console.log(resultado);
        
        if(resultado.resultado) {
            Swal.fire({
                icon: "success",
                title: "Tu cita fue agendada correctamente",
                showConfirmButton: true,
                button: 'OK'
              }).then( () => {
                setTimeout(() => {
                    window.location.reload();
                });
            })
        }
    } catch (error) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Hubo un error al guardar la cita'
        })
    }

    //console.log([...datos]); Sirve para poder ver por consola lo que estamos enviando por medio de FormData
}
