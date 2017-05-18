jQuery(document).foundation();

function setForm(bolEmail, bolQuery, bolDraft, strDescr){

  if( bolEmail ){
  	jQuery('#formModal input[name="email"]').css('display', 'block');
  }else{
    jQuery('#formModal input[name="email"]').css('display', 'none');
  }
      
  if( bolQuery ){
    jQuery('#formModal textarea[name="query"]').css('display', 'block');
  }else{
    jQuery('#formModal textarea[name="query"]').css('display', 'none');
  }
  
  if( bolDraft ){
    jQuery('#formModal input#exampleFileUpload').css('display', 'block');
    jQuery('#formModal label[for="exampleFileUpload"]').css('display', 'block');
  }else{
    jQuery('#formModal input#exampleFileUpload').css('display', 'none');
    jQuery('#formModal label[for="exampleFileUpload"]').css('display', 'none');
  }
  jQuery('#formModal input, #formModal textarea').val('');
  jQuery('#formModal input[type="submit"]').val('Отправить');
  jQuery('#formModal').removeClass('mui-leave', 'mui-leave-active');
  jQuery('#formModal input[name="description"]').val( strDescr );
  jQuery('.newMy').fadeIn(function(){ jQuery('#formModal').fadeIn(); });
}

jQuery(document).ready(function($){
  $('#formModal button.close-button').click(function(){
    $('.newMy').fadeOut();
  });
});