<h2>Relatório</h2>
<table border="1">
<tr><th>Tipo</th><th>Quantidade</th><th>Faturamento</th></tr>
<?php
$data = $reportSrv->totalsByType();
foreach ($data as $row) {
    echo "<tr><td>{$row['type']}</td><td>{$row['count']}</td><td>R$ " . number_format($row['revenue'],2,',','.') . "</td></tr>";
}
?>
</table>
<a href="?p=entrada">Ir para Entrada</a> | <a href="?p=saida">Saída</a>
