
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