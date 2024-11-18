
/*
$(window).on("scroll", function() {

   if ($(".navbar").offset().top > 40) {
      $(".navbar").addClass("navbar-fixed");
      $(".go-top").show();

   } else {
      $(".navbar").removeClass("navbar-fixed");
      $(".go-top").hide();

   }
})
*/

// Aquí arriba definimos las funciones de JS que necesitemos

// Definimos una función para pintar los servicios después de recuperarlas de nuestra API
function pintarServicios(idContenedor, data, mostrarEstrellaDestacado) {
   setTimeout(() => {
       $(idContenedor).empty();


       for (let i = 0; i < data.length; i++) {
           let servicio = data[i];

           let colorCSS = "#bfbfbf";
           if (servicio.color == "verde") {
               colorCSS = "#6d916a";
           } else if (servicio.color == "amarillo") {
               colorCSS = "#ecc66b";
           } else if (servicio.color == "rojo") {
               colorCSS = "#f28a8a";
           }

           // Solo queremos los primeros 140 caracteres de la descripción, para que no nos descuadre el diseño.
           let descripcionCorta = servicio.descripcion;
           let maxCaracteres = 100;

           if (descripcionCorta.length > maxCaracteres) {
               descripcionCorta = descripcionCorta.substring(0, maxCaracteres) + "...";
           }


           
           // En caso de que tenga ingredientes, le mostramos la cantidad de ingredientes que tiene
           /*
           let cantidadingredientes = "Sin ingredientes";
           if (receta.ingredientes != null && receta.ingredientes.length > 0) {
               cantidadingredientes = receta.ingredientes.length + " ingredientes";
           }
           */

           // Comprobamos si el servicio es destacada, y si es destacada le pintamos la estrellita de DESTACADA
           let imgDestacado = "";
           if (mostrarEstrellaDestacado == true && servicio.destacado != null && (servicio.destacado == 1 || servicio.destacado == "1")) {
               imgDestacada = "<img src='http://localhost/glamourbnc/assets/img/estrella.webp' class='servicioDestacadoImg'>";
           }

           let servicioHTML = `
               <div class="col-3">
                   <div class="card mb-3" style="border-radius: 12px;box-shadow: 1px 1px 3px rgba(0,0,0,0.2);border:4px solid ${ colorCSS }">
                       <div class="row g-0">
                           <div class="col-md-4">
                               <div class="img-fluid contenedor-foto">
                                   <img src="${ servicio.foto }" class="rounded-start foto-card-servicio">
                               </div>
                           </div>
                           <div class="col-md-8">
                               <div class="card-body card-servicio">
                                   <h5 class="card-title">${ servicio.nombre }</h5>
                                   <p class="card-text">${ descripcionCorta }</p>
                                   <p class="card-text duracionServicio">${ servicio.duracion } min.</p>
                                   
                                   ${ imgDestacada }
                                   <a href="http://localhost/glamour/servicio.php?id=${ receta.id }" target="_blank" class="btn btn-primary btn-lg btn-verde">Ver Servicio</a>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
               `;
               //<p class="card-text ingredientesReceta">${ cantidadingredientes }</p>

           $(idContenedor).append(recetaHTML);
       }
   }, 1000);
}


function cargarServiciosDestacadas() {
   $.ajax({
       url: "http://localhost/glamourbcn/api/public/servicios/destacados",
       type: "GET",
       success: function (data) {
           pintarServicios("#contenedor-destacado", data, false);
       },
       error: function (xhr) {
           alert("Error al cargar los servicios destacados.");
       }
   });
}

function cargarTodasLosServicios() {
   $.ajax({
       url: "http://localhost/glamourbcn/api/public/servicios/todos",
       type: "GET",
       success: function (data) {
           pintarRecetas("#contenedor-servicios", data, true);
       },
       error: function (xhr) {
           alert("Error al cargar los servicios destacados.");
           // #TODO: mostrar mensaje de error rojo en la pantalla.
       }
   });
}

$(function () {
   // Aquí cargaríamos los scripts que necesitemos una vez haya cargado la página

   // Cuando pulsamos al botón de Buscar servicio de los filtros, recargamos los servicios de la derecha.
   $("#btnBuscarServicio").click(function () {

       // Lo primero: borramos los servicios que ya tenemos cargadas y mostramos el bloque de "Cargando recetas..."
       $("#contenedor-servicios").empty();

       let cargandoHTML = `
       <div class="cargandoServicios">
           <video autoplay loop muted>
               <source src="assets/img/loading-web.webm" type="video/webm">
           </video>
           <p>Cargando todas los servicios...</p>
       </div>
       `;

       $("#contenedor-servicios").append(cargandoHTML);


       // Hacemos la llamada de AJAX para cargar los datos
       let url = "http://localhost/glamourbcn/api/public/servicios/filtros";

       let nombre = $("#filtroNombre").val(); // Recuperamos con .val() el valor que tenemos en nuestro INPUT
       let dificultad = $("#filtroDificultad").val();
       let duracionMin = $("#filtroDuracionMin").val();
       let duracionMax = $("#filtroDuracionMax").val();

       // Esto es para recuperar el valor de un CHECKBOX
       let destacado = 0;
       if ($("#filtroDestacado").is(":checked")) {
           destacado = 1;
       }

       $.ajax({
           url: url,
           type: "GET",
           data: {
               nombre: nombre,
               dificultad: dificultad,
               duracion_min: duracionMin,
               duracion_max: duracionMax,
               destacado: destacado
           },
           success: function (data) {
               pintarRecetas("#contenedor-servicio", data, true);
           },
           error: function (xhr) {
               alert("Error al cargar los servicios con los filtros.");
               // #TODO: mostrar mensaje de error rojo en la pantalla.
           }
       });
   });

});