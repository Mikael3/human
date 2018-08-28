$(document).ready(function(){
    $.ajax({
        type: "POST",
        url:"personnage.php",

    })
    .done(function() {
        
        // alert( "success" );
      })
      .fail(function() {
        // alert( "error" );
      })
     

})