<?php
	$to  = 'zakaz@rezplitki.ru';

	$subject = 'Заказ rezplitki.ru';

	$message = '
	<html>
	    <head>
	        <title>Заказ rezplitki.ru</title>
	    </head>
	    <body>
	        <p>Заказ на накладную ступень (простая):</p>
          <ul>
            <li>Имя: ' . $_POST['custom_U459'] . '</li>
            <li>Телефон: ' . $_POST['custom_U453'] . '</li>
            <li>Почта: ' . $_POST['custom_U480'] . '</li>
            <li>Пожелание по заказу: ' . $_POST['custom_U484'] . '</li>
          </ul>
	    </body>
	</html>';
	if ( (is_array($_FILE)) && (!empty($_FILE0)) ){
    	foreach($_FILE as $filename => $filecontent){
       		$message .= "\r\n
                Content-Type: application/octet-stream;name=\"".$filename."\"\r\n
                Content-Transfer-Encoding:base64\r\n
                Content-Disposition:attachment;filename=\"".$filename."\"\r\n\r\n
                ".chunk_split(base64_encode($filecontent));
    	}
    	$message .= "12345";
 	}
//	$message .= "Content-Disposition: attachment; filename = \"".$path."\"\n\n";

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