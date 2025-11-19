<?php
$pdo = new PDO('sqlite:'.__DIR__.'/../../../database/app.sqlite');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
return $pdo;
