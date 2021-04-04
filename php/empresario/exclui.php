<?php 

require '../../config/config.php';

$con = conecta();

$id = $_GET['id'];

$delete = "DELETE FROM empresario WHERE id = $id";

$res = mysqli_query ($con, $delete);

echo ("<script>alert('Empresário deletado com sucesso!'); location.href = '../../index.php';</script>");

?>