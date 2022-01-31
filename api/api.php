<?php

class apiUploadArquivos{

    public function __construct($token)
    {
        $this->token = $token;
    }


    public function apiArchive()
    {
        $header = getallheaders();
        if($header['token']==$this->token){
            $method = $_SERVER['REQUEST_METHOD'];
            switch($method) {
                case 'POST':
                    $path = 'assets/';
                
                    $arquivo = $_FILES['arquivo'];
                    if(move_uploaded_file($arquivo['tmp_name'],$path.$arquivo['name'])){
                        $resposta = json_encode(['Resposta'=> 'Arquivo Inserido com Sucesso']);
                        echo $resposta;
                    }
                    else{
                        $resposta =  json_encode(['Resposta'=> 'Falha ao Inserir Arquivo']);
                        echo $resposta;
                    }
                    break;
                
                case 'DELETE':
                    //Poderia ter usado o método POST com uma segunda opção, mas para treinar os outros fiz com o delete
                    //Apenas é enviado na url arquivos sem "." e sem caracter especial
                    $path = 'assets/';
                    $uri = $_SERVER['REQUEST_URI'];
                    $nome_arquivo = explode('/', $uri);
                    $nome_arquivo = $nome_arquivo[count($nome_arquivo)-1].'.pdf';
                    
                    
                    
                    if(unlink($path.$nome_arquivo)){
                        $resposta =  json_encode(['Resposta'=> 'Arquivo Excluído com Sucesso']);
                        echo $resposta; 
                    }
                    break;

                case 'GET':
                    echo "Método GET";
                    break;

                case 'PUT':
                    echo "Método PUT";
                    break;
                
                default:
                    echo "Sem método";
                    break;

            }

        }
        else{
            $resposta =  json_encode(['Resposta'=> 'Token Incorreto']);
            echo $resposta;
        }
        
    }


}

?>
