<?php

class api
{
    public function saveArchive()
    {
        $header = getallheaders();
        if($header['token']=='123456789987654321'){
            $arquivo = $_FILES['arquivo'];
            if(move_uploaded_file($arquivo['tmp_name'],"/dados_hd/Projetos/API/api/assets/{$arquivo['name']}")){
                $resposta = json_encode(['Resposta'=> 'Arquivo Inserido com Sucesso']);
                // echo $resposta;
                return $resposta; 
            }
            else{
                $resposta =  json_encode(['Resposta'=> 'Falha ao Inserir Arquivo']);
                // echo $resposta;
                return $resposta; 
            }
        }
        else{
            $resposta =  json_encode(['Resposta'=> 'Token Incorreto']);
            // echo $resposta;
            return $resposta; 
        }
    }


}

?>
