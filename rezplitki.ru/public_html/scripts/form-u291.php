<?php
	$to  = 'zakaz@rezplitki.ru';

	$subject = 'Заказ rezplitki.ru';

	$message = '
	<html>
	    <head>
	        <title>Заказ rezplitki.ru</title>
	    </head>
	    <body>
	        <p>Заказ на получение скидки:</p>
          <ul>
            <li>Имя: ' . $_POST['custom_U299'] . '</li>
            <li>Телефон: ' . $_POST['custom_U293'] . '</li>
            <li>Почта: ' . $_POST['custom_U316'] . '</li>
          </ul>
	    </body>
	</html>';

	$headers  = "Content-type: text/html; charset=UTF-8 \r\n";
	$headers .= "From: <zakaz@rezplitki.ru>\r\n";
	$headers .= "Bcc: zakaz@rezplitki.ru\r\n";

	if( mail($to, $subject, $message, $headers) ){
    $answer = array(
      'success'=>true,
      'error'=>'Неизвестный метод запроса сервера'
      );
  }else{
    $answer = array(
      'success'=>false,
      'error'=>'Неизвестный метод запроса сервера'
      );
  }

	echo json_encode( $answer );
?>