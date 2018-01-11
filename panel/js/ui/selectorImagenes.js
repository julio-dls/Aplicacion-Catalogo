var ImagenSeleccionada = (function() {

  function inicializar() {
    obtenerIdImagen();
  }

  function obtenerIdImagen() {
    $('.imangesIndex').on('click', function() {
      $this = $(this);
      var imgSeleccionada = $this.attr('data-posicion');
      $('.id-oculto').attr("value", imgSeleccionada);
      console.log($('.id-oculto').val());
    });
  }

  return {
    inicializar: inicializar
  };
})();

$(document).ready(function() {
  ImagenSeleccionada.inicializar();
});
