
function agregarMateria(a,m) {
        
  $.ajax({
   type: "POST",
   url: 'ajax.php',
   data:{accion:a,materia:m},
   success:function(html) {
     alert(html);
     window.location.reload();
   }

  });
  
}

function guardarHorario(h,i) {
  $.ajax({
    type: "POST",
    url: 'ajax-horarios.php',
    data: { horario: h,id:i },
    success: function (html) {
      alert(html);
    }
  });
}

function eliminarHorario(i){
  $.ajax({
    type: "POST",
    url: 'ajax-borrar-horario.php',
    data:{id:i},
    success:function(html) {
      alert(html);
      window.location.reload();
    }
 
   });
}
