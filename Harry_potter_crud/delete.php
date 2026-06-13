<?php
require_once __DIR__ .'.../dao/HARRYDAO.php';

if (isset($_GET['id'])) {
    // Converte para inteiro (segurança)
    $id = (int)$_GET['id'];
    
    // Cria DAO e executa exclusão
    $dao = new HARRYDAO();
    $sucesso = $dao->delete($id);

    if ($sucesso) {
        // Sucesso: redireciona com mensagem via GET (opcional)
        header("Location: index.php?msg=deleted");
    } else {
        // Falha: redireciona com mensagem de erro
        header("Location: index.php?msg=error");
    }
    exit; // Interrompe a execução do script
} else {
    // Se não tem ID, volta para listagem
    header("Location: index.php");
    exit;
}