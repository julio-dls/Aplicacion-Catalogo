var ImagenSeleccionada = (function() {

  function inicializar() {
    obtenerIdImagen();
  }

  function obtenerIdImagen() {
    $('.imangesIndex').on('click', function() {
      $this = $(this);
      var idImagenSeleccionada = $this.attr('data-posicion');
      $("#id-oculto").val("" + idImagenSeleccionada);
    });
  }

  return {
    inicializar: inicializar
  };
})();

$(document).ready(function() {
  ImagenSeleccionada.inicializar();
});
