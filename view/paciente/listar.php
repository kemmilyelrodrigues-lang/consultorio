<?php
use app\paciente;
include('../includes/cabecalho.php');
include('../includes/menu.php');
include('../includes/rodape.php');
App\paciente;
$pacientes = $paciente::listar();
?>
<main class="container">
    <h1>Listar Paciente</h1>
<table>
  <thead>
    <tr>
        <th>NOME</th>
        <th>CPF</th>
        <th>DATA</th>
        <th>TELEFONE</th>
        <th>EMAIL</th>
        <th>Endereço</th>
        <th>CONVÊNIO</th>
        <th>OBSERVAÇOES</th>
        <th>Acões</th>
    </tr>
  </thead>
     <tbody>
<?php
       foreach ($pacientes as $paciente) 
       {
       echo"<tr>
       <td>".$paciente->nome."</td>
       <td>".$paciente->cpf."</td>
       <td>".$paciente->data_nascimento."</td>
       <td>".$paciente->telefone."</td>
       <td>".$paciente->email."</td>
       <td>".$paciente->endereco."</td>
       <td>".$paciente->convenio."</td>
       <td>".$paciente->observacao."</td>
       <td>
       <a href='editar.php?id='".$paciente->id."'>
       <a href='/consultorio/action/action_paciente.php?action=excluir&id=".$paciente->id."'>
       <?td>
       </tr>";
       }
?>
       </tbody>
</table>



    <div class="pb-5"></div>
    </main>