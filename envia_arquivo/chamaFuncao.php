<?php

class chamaFuncao{

  public function __construct($url_api,$token){
    $this->url_api = $url_api;
    $this->token = $token;
    $this->path = 'assets/';

  }

  public function recebeUpload(){
    $arquivo = $_FILES['arquivo'];
    // var_dump( $this->path.$arquivo['name']);die;
    move_uploaded_file($arquivo['tmp_name'], $this->path.$arquivo['name']);
    return $arquivo['name'];
  }

  public function enviaParaAPI(){
    $arquivo = $this->recebeUpload();
    
    $ch   = curl_init($this->url_api);

    curl_setopt_array($ch, [    
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => [          
          'arquivo' => curl_file_create($this->path.$arquivo)
        ],
        CURLOPT_HTTPHEADER =>  array("token:{$this->token}")
        
    ]);
    // var_dump($path.$arquivo);die;
    $result = curl_exec($ch);


    
    curl_close($ch);
    echo $result;
  }
}

$url_api = 'http://localhost/UploadArquivos/api/';
$token = '123456789987654321';
$enviaArquivo = new chamaFuncao($url_api,$token);
$enviaArquivo->enviaParaAPI();

?>
