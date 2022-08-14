<?php

$dataBasePath = __DIR__ . "/database/database.sqlite";
$pdo = New PDO("sqlite:".$dataBasePath);

//$pdo->exec('create table IF NOT EXISTS student (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name TEXT);');

// $pdo->exec('create table IF NOT EXISTS phone (
//                 id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, 
//                 student_id INTEGER DEFAULT NULL, 
//                 number TEXT,
//                 FOREIGN KEY(student_id) REFERENCES student(id)
//             );');

// $pdo->exec('create table IF NOT EXISTS course (
//                 id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, 
//                 name TEXT NOT NULL
//             );');

// $pdo->exec('create table IF NOT EXISTS student_course (
//                 student_id INTEGER NOT NULL REFERENCES student(id) ON UPDATE CASCADE ON DELETE CASCADE,
//                 course_id INTEGER NOT NULL REFERENCES course(id) ON UPDATE CASCADE ON DELETE CASCADE, 
//                 PRIMARY KEY (student_id, course_id)
//             );');


// $pdo->exec('DROP TABLE student_course');

echo "Tabelas existentes<br /><br />";
$query = $pdo->query('SELECT name FROM sqlite_schema WHERE type="table" ORDER BY name');
$resultados = $query->fetchAll(PDO::FETCH_ASSOC); // PDO::FETCH_ASSOC tras resultados somente com um tipo de index, se tirar isso ele tras duas vezes cada resultado
$studentsList = [];
foreach($resultados as $res){
    echo "<br />Table: ".$res['name']."<br />";
}
echo "<br />";

// $senha = "12345678";
// $novoUsuario = ["teste@gmail.com", password_hash($senha, PASSWORD_ARGON2ID)];
// if($pdo->exec("INSERT INTO usuarios (email, senha) VALUES ('".$novoUsuario[0]."', '".$novoUsuario[1]."')")){
//     echo "<br />Usuário cadastrado! Login: ".$novoUsuario[0]." / Senha: ".$novoUsuario[1]."<br />";
// }



// echo "Phones existentes\n";
// $query = $pdo->query("select * from phone;");
// $resultados = $query->fetchAll(PDO::FETCH_ASSOC);
// $studentsList = [];
// foreach($resultados as $res){
//     echo "ID: ".$res['id']." / STUDENT ID: ".$res['student_id']." / NUMBER: ".$res['number'].PHP_EOL;
// }
// echo PHP_EOL;
