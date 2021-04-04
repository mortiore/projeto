<?php

class API {
  private $key   = null;
  private $error = false;
  function __construct($key = null){
    if(!empty($key)) $this->key = $key;
  }
  /*Aqui o $endpoint é o nome da refeição que será procurada*/ 
  function requestmunicipios( $endpoint = '', $params = array() ) {
  $url = "https://servicodados.ibge.gov.br/api/v" . $this->key ."/localidades/municipios?orderBy=nome";  

    if( is_array($params) ) {
    foreach ($params as $key => $value){
      if (empty($value)) continue;
        $url .= $key . '=' . urlencode ($value) . '&';
        }
        $response = @file_get_contents($url);
        $this->error = false;
    return json_decode($response, true);
  }else{
    $this->error = true;
    return false;
  }
}
  
  function requestestado( $endpoint = '', $params = array() ){
  $url = "https://servicodados.ibge.gov.br/api/v" . $this->key ."/localidades/estados?orderBy=nome"; 
  
      if( is_array($params) ) {
      foreach ($params as $key => $value){
        if (empty($value)) continue;
          $url .= $key . '=' . urlencode ($value) . '&';
          }
          $response = @file_get_contents($url);
          $this->error = false;
      return json_decode($response, true);
    }else{
      $this->error = true;
      return false;
    }
  }
}
?>