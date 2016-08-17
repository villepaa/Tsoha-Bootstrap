$(document).ready(function(){
//  
//   $('form.form_alkupaiva').datetimepicker({
//        format: "dd MM yyyy"
//   });
//   
//   $('form.form_loppupaiva').datetimepicker({
//        format: "dd MM yyyy"
//   });
   
   $('#naytaLomake').click(function(){
       $('.lisays').css('visibility','visible');
   });
   
    $('#piilotaLomake').click(function(){
       $('.lisays').css('visibility','hidden');
   });
   
   $('#valitseTyontekijat').click(function(){
       event.preventDefault();
       $('#valitut option').prop('selected', true);
   });

});
