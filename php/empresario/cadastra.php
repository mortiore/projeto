<?php

require '../../config/config.php';
  
     
    $nome = trim ($_POST['nome']);
    $celular = trim ($_POST['celular']);
    $cidade = trim ($_POST['cidade']);
    $paiempresario = trim ($_POST['paiempresario']);

    date_default_timezone_set('America/Sao_Paulo');
    $date = date_create()->format('Y/m/d H:i');

    $con = conecta();

    $res = mysqli_query($con, "SELECT celular FROM empresario where celular = '$celular'");
    $count = $res->num_rows;
    
    if($count == 0){
        echo"<script language='javascript' type='text/javascript'>
        alert('Empresário cadastrado com sucesso!');window.location
        .href='../../index.php';</script>";

        $insert = "INSERT into empresario (nome, celular, cidade, paiempresario, horario) VALUES ('$nome', '$celular', '$cidade', '$paiempresario', '$date')";

        $res = mysqli_query ($con, $insert);

     } else if($count == 1) {
        echo"<script language='javascript' type='text/javascript'>
        alert('Já existe uma pessoa cadastrada com esse Celular');window.location
        .href='../../index.php';</script>";
     }

    

    
?>