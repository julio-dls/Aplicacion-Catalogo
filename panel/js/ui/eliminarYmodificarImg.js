var eliminarYmodificarImg = (function(){

  function inicializar(){
    eliminarImg();
    obtenerIdImagen();
    modificarImg();
    limpiar();
  }

  function eliminarImg(){
    $('.btn-eliminar').on('click', function () {
      $this = $(this);
      var id = $this.attr('data-id');
      $('#modalEliminar').modal();
        $('#btn-aceptar').on('click', function () {
          $.ajax({
               url: "./delete.php",
               type: "GET",
               data: {"id":id}
             });
          $(".modal").modal("hide");
          location.reload(true);
        });
      });
  }

  var idImg;
  function obtenerIdImagen() {
    $('.btn-modificar').on('click', function() {
      $this = $(this);
      idImg = $this.attr('data-id-modificar');
    });
  }

  function modificarImg(){
    $('.modificar').on('click', function(){
      var id = idImg;
      var descripcion = $('#descripcion').val();
      var nombre = $('#nombre').val();
      var nombreIngles = $('#nombre-ingles').val();
      var descripcionIngles = $('#descripcion-ingles').val();
      var categoria =  $('#categoria').val();
      var estacion =  $('#estacion').val();
      var accesorio = $('#accesorios').val();

      var objImg = {
        "id":idImg,
        "nombre":nombre,
        "descripcion":descripcion,
        "nombreIngles":nombreIngles,
        "descripcionIngles":descripcionIngles,
        "categoria":categoria,
        "estacion":estacion,
        "accesorio":accesorio
      };

      $.ajax({
           url: "./delete.php",
           type: "POST",
           data: objImg,
          //  dataType: 'json'
         }).done(function(data) {
           console.log(JSON.stringify(data));
           $(".modal").modal("hide");
           location.reload(true);
         }).fail(function(data) {
           console.log(JSON.stringify(data));
          });
    });
  }

  function limpiar(){
    $('#reset').on('click', function (){
      $('input').val("");
      $('textarea').val("");
      $('#categoria').val("");
      $('#estacion').val("");
      $('#accesorio').val("");
    });
  }
  return {
    inicializar:inicializar
  }
})();

$(document).ready(function(){
  eliminarYmodificarImg.inicializar();
});
