<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Controle Estacionamento</title>
</head>
<body>
    <h1>Registrar Entrada de Veículo</h1>
    <form method="post" action="registrar_entrada.php">
        <label>Placa: <input name="placa" type="text" required></label><br>
        <label>Tipo: 
            <select name="tipo" required>
                <option value="carro">Carro</option>
                <option value="moto">Moto</option>
                <option value="caminhao">Caminhão</option>
            </select>
        </label><br>
        <button type="submit">Registrar Entrada</button>
    </form>
</body>
</html>
