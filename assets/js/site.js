$(document).ready(function(){

   
  
   
   $('#valitseTyontekijat').click(function(){
       event.preventDefault();
       $('#valitut option').prop('selected', true);
   });
   
   $('.suunniteltava').hover(function(){
      var id = "D"+this.id;
      
      $('#'+id).show(); 
   });
   
   $('.suunniteltava').mouseleave(function(){
      var id = "D"+this.id;
      $('#'+id).hide(); 
   });
   
   $('#kaikki').change(function(){
      var check = this.checked;
      if(check){
          $('#kaikkiPatevyydet input').prop('checked',true);
      }else{
          $('#kaikkiPatevyydet input').prop('checked',false);
      }
   });

});
