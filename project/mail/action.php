<?php

  $to  = 'ekonomikal@mail.ru';//'zakaz@rezplitki.ru';

  $thm = 'Заказ rezplitki.ru';

  $html = '
  <html>
      <head>
          <title>Заказ rezplitki.ru</title>
      </head>
      <body>
          <p>' . $_POST['description'] . ':</p>
          <ul>';
            
  if( !empty( $_POST['name'] ) )
    $html .= '<li>Имя: ' . $_POST['name'] . '</li>';
  if( !empty( $_POST['phone'] ) )
    $html .= '<li>Телефон: ' . $_POST['phone'] . '</li>';
  if( !empty( $_POST['email'] ) )
    $html .= '<li>Почта: ' . $_POST['email'] . '</li>';
  if( !empty( $_POST['contact'] ) )
    $html .= '<li>Контакты: ' . $_POST['contact'] . '</li>';
  if( !empty( $_POST['query'] ) )
    $html .= '<li>Комментарий: ' . $_POST['query'] . '</li>';

  $html .= '</ul>
      </body>
  </html>';
  
  if (!empty($_FILES['draft_plan']['tmp_name'])) 
  {  
    $path = $_FILES['draft_plan']['tmp_name'];
    $filename = $_FILES['draft_plan']['name'];
    $fp = fopen($path,"r"); 
    if (!$fp) 
    { 
      //print "Файл $path не может быть прочитан"; 
      //exit(); 
    }
    $file = fread($fp, filesize($path)); 
    fclose($fp); 
    $boundary = "--".md5(uniqid(time())); // генерируем разделитель 
    $headers  = "MIME-Version: 1.0\n";
    $headers .= "From: <zakaz@rezplitki.ru>\r\n";
    $headers .= "Bcc: zakaz@rezplitki.ru\r\n";
    $headers .="Content-Type: multipart/mixed; boundary=\"".$boundary."\"\n";
    $multipart .= "--".$boundary."\n"; 
    $multipart .= "Content-Type: text/html; charset=UTF-8\n"; 
    $multipart .= "Content-Transfer-Encoding: Quot-Printed\n\n"; 
    $multipart .= $html."\n\n"; 
    $message_part = "--".$boundary."\n"; 
    $message_part .= "Content-Type: application/octet-stream\n"; 
    $message_part .= "Content-Transfer-Encoding: base64\n"; 
    $message_part .= "Content-Disposition: attachment; filename = \"".$filename."\"\n\n"; 
    $message_part .= chunk_split(base64_encode($file))."\n"; 
    $multipart .= $message_part."--".$boundary."--\n"; 
    if(mail($to, $thm, $multipart, $headers)) 
    {
      echo json_encode( array( 'answer' => true) );
      //echo "К сожалению, письмо не отправлено"; 
      //exit();
    }else{
      echo json_encode( array( 'answer' => false ) );}
  }else{
    $headers  = "MIME-Version: 1.0\n";
    $headers .= "From: <zakaz@rezplitki.ru>\r\n";
    $headers .= "Bcc: zakaz@rezplitki.ru\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\n";
    if( mail($to, $thm, $html, $headers) ){
      echo json_encode( array( 'answer' => true ) );
    }else{
      echo json_encode( array( 'answer' => false ) );}
  }

?>