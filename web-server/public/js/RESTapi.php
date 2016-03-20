<?PHP
  function sendMessage(){
    $content = array(
      "en" => 'Your lecturer has sent you a quiz in lecture!'
      );
    
    $fields = array(
      'app_id' => "f3910626-2f31-44fc-beeb-6bd9fb5103d5",
      'included_segments' => array('All'),
      'contents' => $content
    );
    
    $fields = json_encode($fields);

    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json',
                           'Authorization: Basic ZWY3ZTdmYTEtOWM1OS00MDQxLTk4NWUtNDg2NjVkMDIxMDQ2'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

    $response = curl_exec($ch);
    curl_close($ch);
    
    return $response;
  }
  
  $response = sendMessage();
  $return["allresponses"] = $response;
  $return = json_encode( $return);


?>