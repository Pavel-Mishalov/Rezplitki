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

  $("form").on('submit', function(event){  
      event.preventDefault();
      var that = $(this);
      console.log(that.serialize());
      formData = new FormData(that.get(0));

      jQuery.ajax({
          url: 'mail/action.php',
          type: 'POST',
          contentType: false,
          processData: false,
          data: formData,
          dataType: 'json',
          beforeSend: function(){
            that.append('<p id="beforeSend" style="width: 100%"><span class="primary label" style="width: 100%">Ваш запрос обрабатывается...</span></p>');
          },
          success: function(data){
            setTimeout(function(){

              jQuery('#beforeSend').remove();
              if( data['answer'] ){
                that.append('<p id="successSend" style="width: 100%"><span class="success label" style="width: 100%">Сообщение отправлено</span></p>');
              }else{
                that.append('<p id="successSend" style="width: 100%"><span class="alert label">Просим прошения, но в данный момент мы не можем обработать Ваш запрос</span></p>');
              }
              jQuery('input:not(input[type="hidden"], input[type="submit"]), textarea').val('');

            }, 2000);
            
            setTimeout( function(){ jQuery('#successSend').remove(); }, 10000);
          }
      });
  });

});