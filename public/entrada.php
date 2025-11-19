<form method="post">
  <label>Placa:</label>
  <input name="plate" required>
  <label>Tipo:</label>
  <select name="type">
    <option value="carro">Carro</option>
    <option value="moto">Moto</option>
    <option value="caminhao">Caminhão</option>
  </select>
  <button type="submit">Registrar Entrada</button>
</form>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $parkingSrv->registerEntry($_POST['plate'], $_POST['type']);
    echo "<p>Entrada registrada!</p>";
}
?>
<a href="?p=saida">Ir para Saída</a> | <a href="?p=relatorio">Relatório</a>
