<?php

require ('api.php');

function chamaAPI(){
    $API = new api();
    $API->saveArchive();

}

chamaAPI();