<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
if (!isset($_SESSION['user'])) {
    header('Location:.');
    exit;
}

try {
    $connection = new PDO(
      'mysql:host=localhost;dbname=pokemons',
      'root',
      'FERNANDO',
     
      array(
        PDO::ATTR_PERSISTENT => true,
        PDO::MYSQL_ATTR_INIT_COMMAND => 'set names utf8')
        
    );
} catch(PDOException $e) {
    header('Location:..');
    exit;
}
$resultado = 0;
$url = 'create.php?op=insertpokemon&result=' . $resultado;

if (isset($_POST['name']) && isset($_POST['type']) && isset($_POST['ability']) && isset($_POST['hp']) && isset($_POST['attack'])) {
    $name = trim($_POST['name']);
    $type = $_POST['type'];
    $ability = $_POST['ability'];
    $hp = $_POST['hp'];
    $attack = $_POST['attack'];
  
    $ok = true;

    // Validaciones
    if (strlen($name) < 2 || strlen($name) > 100) {
        $ok = false;
    }
    if (strlen($type) < 3 || strlen($type) > 50) {
        $ok = false;
    }
    if (strlen($ability) < 3 || strlen($ability) > 100) {
        $ok = false;
    }
    if (!(is_numeric($hp) && $hp > 0 && $hp <= 9999)) {
        $ok = false;
    }
    if (!(is_numeric($attack) && $attack > 0 && $attack <= 9999)) {
        $ok = false;
    }
   

    if ($ok) {
        $sql = 'INSERT INTO pokemon (name, type, ability, hp, attack) VALUES (:name, :type, :ability, :hp, :attack)';
        $sentence = $connection->prepare($sql);
        $parameters = [
            'name' => $name,
            'type' => $type,
            'ability' => $ability,
            'hp' => $hp,
            'attack' => $attack,
    
        ];

        foreach ($parameters as $nombreParametro => $valorParametro) {
            $sentence->bindValue($nombreParametro, $valorParametro);
        }

        try {
            $sentence->execute();
            $resultado = $connection->lastInsertId();
            $url = 'index.php?op=insertpokemon&result=' . $resultado;
        } catch (PDOException $e) {
            
            
        }
    }
}


if ($resultado == 0) {
    $_SESSION['old']['name'] = $name;
    $_SESSION['old']['type'] = $type;
    $_SESSION['old']['ability'] = $ability;
    $_SESSION['old']['hp'] = $hp;
    $_SESSION['old']['attack'] = $attack;

}

header('Location: ' . $url);