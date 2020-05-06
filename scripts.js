
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

function guardarHorario(a, h,num) {
  $.ajax({
    type: "POST",
    url: 'ajax-horarios.php',
    data: { accion: a, horario: h,numero:num },
    success: function (html) {
      alert(html);
    }
  });
}