<?php
$errors = [];
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Insira um e-mail válido.';
    }
    if (empty($senha)) {
        $errors[] = 'A senha é obrigatória.';
    }

    // Exemplo de validação simples (substituir por consulta ao banco de dados)
    if (empty($errors)) {
        if ($email === 'usuario@hogwarts.edu' && $senha === '123456') {
            $success = true;
        } else {
            $errors[] = 'E-mail ou senha incorretos.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Hogwarts — Login</title>
</head>
<body>

  <h1>⚡ Hogwarts — Login</h1>
  <p><em>Draco dormiens nunquam titillandus</em></p>
  <hr>

  <?php if ($success): ?>
    <p>✅ <strong>Login realizado com sucesso!</strong></p>
    <p>Bem-vindo(a) de volta à Hogwarts!</p>
  <?php else: ?>
    <?php if (!empty($errors)): ?>
      <ul>
        <?php foreach ($errors as $e): ?>
          <li><?= htmlspecialchars($e) ?></li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>

    <form method="POST">
      <p>
        <label for="email">E-mail:</label><br>
        <input type="email" id="email" name="email"
               placeholder="voce@hogwarts.edu"
               value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
      </p>

      <p>
        <label for="senha">Senha:</label><br>
        <input type="password" id="senha" name="senha" placeholder="Digite sua senha">
      </p>

      <button type="submit">Entrar</button>
    </form>

    <p>Não tem uma conta? <a href="create.php">Criar conta</a></p>
  <?php endif; ?>

</body>