<?php

require '../../config/config.php';

$con = conecta();

?>
<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">

<title>Hierarquia</title>

<!-- Bootstrap core CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

<!-- Tab Icon -->
<link rel="icon" href="images/threebars.png" sizes="16x16">

<!-- Custom CSS -->
<link rel="stylesheet" type="text/css" href="../../css/index.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</head>
    
    <body>
    <?php 
    $id = $_GET['id'];
    $res = mysqli_query($con, "SELECT * FROM empresario WHERE id = $id");
    foreach ($res as $orc) { 
      
      $nomepai = $orc['nome'];
       
    }?>
    <h1 style="padding-top:30px; padding-bottom: 30px;">Rede de <?= $nomepai?></h1>
  <div style="padding-left: 30%">
    <?php
    function hierarquia($nome, $padding){ ?>
      <?php 
      $con = conecta();
        $res = mysqli_query($con, "SELECT * FROM empresario WHERE paiempresario = '$nome'");
        $padding+=10;
        foreach ($res as $orc) { ?>
          <p style="padding-left: <?= $padding?>%;"><?php echo ($orc['nome'])?></p>
          <?php
          $nome = $orc['nome'];
          hierarquia($nome, $padding);
          ?>        
        <?php } ?>
    <?php } ?>
    <?php 
    $padding = 0;
    $id = $_GET['id'];
    $res = mysqli_query($con, "SELECT * FROM empresario WHERE id = $id");
    ?>
    <?php foreach ($res as $orc) { ?>      
      <p style="padding-left: <?= $padding?>%;"><?php echo ($orc['nome'])?></p>  
      <?php
      $nomepai = $orc['nome'];
      ?>  
    <?php } ?>
      
    <?php 
        $res = mysqli_query($con, "SELECT * FROM empresario WHERE paiempresario = '$nomepai'");

        $padding+=10;
        foreach ($res as $orc) { ?>
          <p style="padding-left: <?= $padding?>%;"><?php echo ($orc['nome'])?></p>
          <?php
          $nomepai = $orc['nome'];
          hierarquia($nomepai,$padding);
          ?>        
        <?php } ?>
    </div>
    <div style="padding-top: 40px; text-align:center;">
    <a style="background-color: #32B3D7;;" class="btn" href="../../index.php"><i class="fa fa-trash"></i>Voltar</a>
    </div>
  
  </body>

</html>