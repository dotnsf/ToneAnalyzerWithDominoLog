<?php
require_once( 'credentials.php' );

function getLogs(){
  $xml = file_get_contents( LOG_URL );

  return $xml;
}

function getPI( $body ){
  $url = PI_URL . "/v3/profile?version=2016-10-20";
  $auth = base64_encode( PI_USERNAME . ":" . PI_PASSWORD );
  $opts = array(
    CURLOPT_POST => TRUE,
    CURLOPT_RETURNTRANSFER => TRUE,
    CURLOPT_HTTPHEADER => array(
      'Authorization: Basic ' . $auth,
      'Accept: application/json',
      'Content-Language: ja',
      'Content-Type: text/plain'
    ),
    CURLOPT_POSTFIELDS => $body
  );

  $ch = curl_init( $url );
  curl_setopt_array( $ch, $opts );
  $r = curl_exec( $ch );

  $json = json_decode( $r );

  return $json;
}

function getTA( $body ){
  $url = TA_URL . "/v3/tone?version=2016-05-19";
  $auth = base64_encode( TA_USERNAME . ":" . TA_PASSWORD );
  $opts = array(
    CURLOPT_POST => TRUE,
    CURLOPT_RETURNTRANSFER => TRUE,
    CURLOPT_HTTPHEADER => array(
      'Authorization: Basic ' . $auth,
      'Accept: application/json',
//      'Accept-Language: ja-JP',
      'Content-Type: text/plain'
    ),
    CURLOPT_POSTFIELDS => $body
  );

  $ch = curl_init( $url );
  curl_setopt_array( $ch, $opts );
  $r = curl_exec( $ch );

  $json = json_decode( $r );

  return $json;
}

?>

