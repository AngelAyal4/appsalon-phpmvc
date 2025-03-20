let paso=1;const cita={id:"",nombre:"",fecha:"",hora:"",servicios:[]};function iniciarApp(){mostrarSeccion(),tabs(),botonesPaginador(),consultarAPI(),idCliente(),nombreCliente(),selecionarFecha(),selecionarHora(),mostrarResumen()}function mostrarSeccion(){const e=document.querySelector(".mostrar");e&&e.classList.remove("mostrar");const t=`#paso-${paso}`;document.querySelector(t).classList.add("mostrar");const o=document.querySelector(".tabs .actual");o&&o.classList.remove("actual");document.querySelector(`[data-paso="${paso}"]`).classList.add("actual")}function tabs(){document.querySelectorAll(".tabs button").forEach((e=>{e.addEventListener("click",(function(e){paso=parseInt(e.target.dataset.paso),mostrarSeccion(),botonesPaginador(),3===paso&&mostrarResumen()}))}))}function botonesPaginador(){const e=document.querySelector("#siguiente"),t=document.querySelector("#anterior");e&&e.addEventListener("click",(function(){paso<3&&(paso++,mostrarSeccion(),actualizarPaginador())})),t&&t.addEventListener("click",(function(){paso>1&&(paso--,mostrarSeccion(),actualizarPaginador())})),actualizarPaginador()}function actualizarPaginador(){const e=document.querySelector("#siguiente"),t=document.querySelector("#anterior");1===paso?t.classList.add("ocultar"):t.classList.remove("ocultar"),3===paso?(e.classList.add("ocultar"),3===paso&&mostrarResumen()):e.classList.remove("ocultar")}async function consultarAPI(){try{const e=`${location.origin}/api/servicios`,t=await fetch(e);mostrarServicios(await t.json())}catch(e){console.log(e)}}function mostrarServicios(e){e.forEach((e=>{const{id:t,nombre:o,precio:a}=e,n=document.createElement("P");n.classList.add("nombre-servicio"),n.textContent=o;const c=document.createElement("P");c.classList.add("precio-servicio"),c.textContent=`$ ${a}`;const r=document.createElement("DIV");r.classList.add("servicio"),r.dataset.idServicio=t,r.onclick=function(){seleccionarServicio(e)},r.appendChild(n),r.appendChild(c),document.querySelector("#servicios").appendChild(r)}))}function seleccionarServicio(e){const{id:t}=e,{servicios:o}=cita,a=document.querySelector(`[data-id-servicio="${e.id}"]`);o.some((e=>e.id===t))?(cita.servicios=o.filter((e=>e.id!==t)),a.classList.remove("seleccionado")):(cita.servicios=[...o,e],a.classList.add("seleccionado"))}function idCliente(){cita.id=document.querySelector("#id").value}function nombreCliente(){cita.nombre=document.querySelector("#nombre").value}function selecionarFecha(){const e=document.querySelector("#fecha");e.addEventListener("input",(function(t){const o=new Date(t.target.value).getUTCDay();[0,6].includes(o)?(t.preventDefault(),t.target.value="",mostrarAlerta("No se puede seleccionar fin de semana","error",".formulario")):cita.fecha=e.value}))}function selecionarHora(){const e=document.querySelector("#hora");e.addEventListener("input",(function(t){const o=t.target.value,a=o.split(":");a[0]<10||a[0]>18?(mostrarAlerta("Hora no valida","error",".formulario"),setTimeout((()=>{e.value=""}),3e3)):cita.hora=o}))}function mostrarAlerta(e,t,o,a=!0){const n=document.querySelector(".alerta");n&&n.remove();const c=document.createElement("DIV");c.textContent=e,c.classList.add("alerta"),c.classList.add(t);document.querySelector(o).appendChild(c),a&&setTimeout((()=>{c.remove()}),3e3)}function mostrarResumen(){const e=document.querySelector(".contenido-resumen");for(;e.firstChild;)e.removeChild(e.firstChild);if(Object.values(cita).includes("")||0===cita.servicios.length)return void mostrarAlerta("Faltan datos de servicios, hora o fecha","error",".contenido-resumen",!1);const{nombre:t,fecha:o,hora:a,servicios:n}=cita,c=document.createElement("H3");c.textContent="Resumen de los servicios seleccionados",e.appendChild(c),n.forEach((t=>{const{id:o,precio:a,nombre:n}=t,c=document.createElement("DIV");c.classList.add("contenedor-servicio");const r=document.createElement("P");r.textContent=n;const i=document.createElement("P");i.innerHTML=`<span>Precio: </span> $${a}`,c.appendChild(r),c.appendChild(i),e.appendChild(c)}));const r=document.createElement("H3");r.textContent="Resumen de cliente y cita",e.appendChild(r);const i=document.createElement("P");i.innerHTML=`<span>Nombre: </span> ${t}`;const s=new Date(o),d=s.getMonth(),l=s.getDate()+2,u=s.getFullYear(),m=new Date(Date.UTC(u,d,l)).toLocaleDateString("es-AR",{weekday:"long",year:"numeric",month:"long",day:"numeric"}),p=document.createElement("P");p.innerHTML=`<span>Fecha: </span> ${m}`;const v=document.createElement("P");v.innerHTML=`<span>Hora: </span> ${a} Horas`;const f=document.createElement("BUTTON");f.classList.add("boton"),f.textContent="Reservar Cita",f.onclick=reservarCita,e.appendChild(i),e.appendChild(p),e.appendChild(v),e.appendChild(f)}async function reservarCita(){const{nombre:e,fecha:t,hora:o,servicios:a,id:n}=cita,c=a.map((e=>e.id)),r=new FormData;r.append("fecha",t),r.append("hora",o),r.append("usuarioId",n),r.append("servicios",c);try{const e=`${location.origin}/api/citas`;console.log(e);const t=await fetch(e,{method:"POST",body:r}),o=await t.json();console.log(o),o.resultado&&Swal.fire({icon:"success",title:"Tu cita fue agendada correctamente",showConfirmButton:!0,button:"OK"}).then((()=>{setTimeout((()=>{window.location.reload()}))}))}catch(e){Swal.fire({icon:"error",title:"Error",text:"Hubo un error al guardar la cita"})}}document.addEventListener("DOMContentLoaded",(function(){iniciarApp()}));