<?php
 
// inclui o arquivo de inicialização
require 'init.php';
 
// resgata variáveis do formulário
$usuario = isset($_POST['user']) ? $_POST['user'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
 
if (empty($usuario) || empty($password))
{
    echo "CRIAR AQUI UMA TELA PARA 'ENTRAR COM LOGIN E SENHA' ";
    exit;
}
 
// cria o hash da senha
$passwordHash = make_hash($password);
 
$PDO = db_connect();
 
$sql = "SELECT id, name FROM users WHERE user = :user AND password = :password";
$stmt = $PDO->prepare($sql);
 
$stmt->bindParam(':user', $usuario);
$stmt->bindParam(':password', $passwordHash);
 
$stmt->execute();
 
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
 
if (count($users) <= 0)
{
    echo "CRIAR AQUI UMA TELA PARA 'INFORMAR EMAIL/LOGIN E SENHA' incorreto";
    exit;
}
 
// pega o primeiro usuário
$user = $users[0];
 
session_start();
$_SESSION['logged_in'] = true;
$_SESSION['user_id'] = $user['id'];
$_SESSION['user_name'] = $user['name'];
$_SESSION["senha"] = $user['password'];
 
header('Location: inicio.php');
