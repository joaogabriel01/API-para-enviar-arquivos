<?php

require ('api.php');

function chamaAPI(){
    $token = '123456789987654321';
    $API = new apiUploadArquivos($token);
    $API->apiArchive();

}

chamaAPI();