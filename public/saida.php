<form method="post">
  <label>Placa:</label>
  <input name="plate" required>
  <button type="submit">Registrar Saída</button>
</form>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $valor = $parkingSrv->registerExit($_POST['plate']);
        echo "<p>Saída registrada! Valor: R$ " . number_format($valor,2,',','.') . "</p>";
    } catch (\Exception $ex) {
        echo "<p>Erro: {$ex->getMessage()}</p>";
    }
}
?>
<a href="?p=entrada">Ir para Entrada</a> | <a href="?p=relatorio">Relatório</a>
