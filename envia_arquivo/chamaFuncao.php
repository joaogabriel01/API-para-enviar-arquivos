<?php

function recebeUpload(){
    $arquivo = $_FILES['arquivo'];
    move_uploaded_file($arquivo['tmp_name'], "/dados_hd/Projetos/API/envia_arquivo/assets/{$arquivo['name']}");
    return $arquivo;
}

function enviaParaAPI(){
  $arquivo = recebeUpload();
  $ch   = curl_init('http://localhost:8080/');
  
  
  curl_setopt_array($ch, [    
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_POST => true,
      CURLOPT_POSTFIELDS => [          
        'arquivo' => curl_file_create("/dados_hd/Projetos/API/envia_arquivo/assets/{$arquivo['name']}")
      ],
      CURLOPT_HTTPHEADER =>  array('token:123456789987654321')
      
  ]);
  $result = curl_exec($ch);
  
  curl_close($ch);
  return $result;
}

echo enviaParaAPI();

?>
