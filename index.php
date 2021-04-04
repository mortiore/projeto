<?php

require 'config/config.php';
require_once 'api/api.php';
require_once 'config/configkey.php';

    $con = conecta();

    $res = mysqli_query($con, 'SELECT * FROM empresario ORDER BY horario');

    
$api = new API(API_KEY);

$estado = $api->requestestado('');

$municipio = $api->requestmunicipios('');

$date = date_create("",timezone_open('America/Sao_Paulo'));

?>
<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">

<title>Dashboard</title>

<!-- Bootstrap core CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

<!-- Tab Icon -->
<link rel="icon" href="images/threebars.png" sizes="16x16">

<!-- Custom CSS -->
<link rel="stylesheet" type="text/css" href="css/index.css">   
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  

<script type="text/javascript">
    $(document).ready(function(){
     $('.celular').mask("(99) 9 9999-9999");
});
</script>

</head>
    
    <body>


        <h1 style="padding-top:30px; padding-bottom: 30px;">Cadastro de Empresários</h1>

        <div class="row">
            <div  style="padding-top: 30px;" class="container login col-md-6">
              
                  <form method="post" action="php/empresario/cadastra.php">

                    <div style="padding-bottom: 40px;" class="input-group">
                        <p>Nome Completo:&emsp;</p>
                        <input id="txtUsuario" runat="server" type="text" class="form-control" name="nome" placeholder=""  required/>
                    
                        <p style="padding-left:15px;" class="preto">Celular:&emsp;</p>
                        <input id="txtUsuario" type="text" class="form-control celular" placeholder="" id="celular" name="celular" required/>
                    </div>

                    <div style="padding-bottom: 40px;" class="input-group">
                        
                        <p class="preto">Cidade:&emsp;</p>
                        <select id="inputEstado" style="border-radius:100px" runat="server" type="text" class="form-control" name="cidade" placeholder="" required="">
                        <option value="0">Escolher ...</option>
                        <?php for($i=0; $i<(count($municipio)); $i++){ ?>                             

                            <option value = "<?php echo($municipio[$i]['nome'])?> / <?php echo($municipio[$i]['microrregiao']['mesorregiao']['UF']['sigla']) ?>">
                                <?php echo($municipio[$i]['nome']) ?>
                            </option>
                                          
                        <?php } ?>
                        </select>


                        <p style="padding-left:15px;" class="preto">Estado:&emsp;</p>
                        <select id="mySelect" style="border-radius:100px" runat="server" type="text" class="form-control" name="estado" placeholder="" required="">
                        <option>Escolher...</option>
                        <?php for($i=0; $i<(count($estado)); $i++){ ?>  

                        <option>
                            <?php echo ($estado[$i]['nome']); ?>                                        
                        </option>
                                     
                        <?php } ?>
                        </select> 

                    </div>

                    <div style="padding-bottom: 40px;" class="input-group">
                    <p class="preto">Pai empresarial:&emsp;</p>
                        <select style="border-radius:100px" runat="server" type="text" class="form-control" name="paiempresario" placeholder="">
                        <option selected></option>
                        <?php foreach ($res as $orc) { ?>
                        <option value= "<?php echo ($orc['nome'])?>"><?php echo ($orc['nome'])?></option>
                        <?php } ?>
                        </select>
                    </div>

                    <div>
                        <input id="btnlogin" style="color:#36404A; background-color:#32B3D7" name="horario" class="btn btn-xm btn-block btn-entrar" type="submit" value=Enviar onclick="return Login()" />
                    </div>

                  </form>
            </div>
            <div style="padding-top: 40px; padding-bottom: 40px;" class="container login col-md-8"><table class="center">
            <thead>
                <tr>
                    <th><input type="text" class="form-control" placeholder="Nome Completo" disabled></th>
                    <th><input type="text" class="form-control" placeholder="Celular" disabled></th>
                    <th><input type="text" class="form-control" placeholder="Cidade/UF" disabled></th>
                    <th><input type="text" class="form-control" placeholder="Cadastrado em" disabled></th>
                    <th><input type="text" class="form-control" placeholder="Pai Empresarial" disabled></th>
                    <th><input type="text" class="form-control" placeholder="Rede" disabled></th>
                    <th><input type="text" class="form-control" placeholder="" disabled></th>
                </tr>
            </thead>
            <tbody>

                <?php foreach ($res as $orc) { ?>
                    
                    <tr>
                        
                        <td><?php echo $orc['nome']; ?></td>
                        <td><?php echo $orc['celular']; ?></td>
                        <td><?php echo $orc['cidade'];?></td>
                        <td><?php 
                        $data = new Datetime($orc['horario']);                                
                        echo $data->format('d/m/Y H:i');
                        ?></td>
                        <td><?php echo $orc['paiempresario'];?></td>
                        
                        <td><a class="btn btn-danger" href="php/empresario/hierarquia.php?id=<?= $orc['id']; ?>"><i class="fa fa-trash"></i>Ver Rede</a></td>
                        <td><a class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir o registro de <?= $orc['nome']; ?>?')" href="php/empresario/exclui.php?id=<?= $orc['id']; ?>">Excluir</a></td>
                        
                    </tr>
                    <?php } ?>            

                </tbody>
            
            </table></div>
        </div>
    </body>
    
</html>