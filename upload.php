<?php
    $texto = "";  
    $status = 500;
    $extensoes_permitidas = ['.png', '.jpg', '.pdf'];
    if ($_SERVER['REQUEST_METHOD']==='POST' && isset($_FILES['file'])) {
        $file = $_FILES['file'];
        $name = strip_tags($_POST['name']);
        $extensao = ".".explode(".", basename($file['name']))[count(explode(".", basename($file['name'])))-1];
        
        if (in_array($extensao, $extensoes_permitidas)){
            $targetDir = 'uploads/';
            $targetFile = $targetDir.$name.$extensao;
            if (move_uploaded_file($file['tmp_name'], $targetFile)) {
                $status = 200;
                $texto = 'Arquivo enviado com sucesso!';
            } else {
                $texto = 'Ocorreu um erro ao enviar o arquivo.';
            }
        }else{
            $texto = "O arquivo não possui uma de nossas extensões permitidas (".implode($extensoes_permitidas).")";
        }
    }else{
        $texto = "Uso da função inapropriada!";
    }   
    echo json_encode(['status'=>$status, "texto"=>$texto]);
?>