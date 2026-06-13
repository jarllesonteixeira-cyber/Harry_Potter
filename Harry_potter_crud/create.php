<?php
require_once __DIR__ . '/dao/HARRYDAO.php';

$mensagem = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome               = $_POST['nome'] ?? '';
    $tipo               = $_POST['tipo'] ?? '';
    $movimento_varinha  = $_POST['movimento_varinha'] ?? '';
    $efeito             = $_POST['efeito'] ?? '';
    $nivel_dificuldade  = $_POST['nivel_dificuldade'] ?? '';
    $proibido           = isset($_POST['proibido']) ? (bool)$_POST['proibido'] : false;

    $feiticos = new HARRY(null, $nome, $tipo, $movimento_varinha, $efeito, $nivel_dificuldade, $proibido);

    $dao = new HARRYDAO();
    $id  = $dao->create($feiticos);

    if ($id) { $mensagem = "Feitiço registrado com sucesso! ID: $id"; }
    else      { $mensagem = "Erro ao registrar o feitiço. Tente novamente."; }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Grimório de Feitiços</title>
  <link rel="stylesheet" href="css/feitico.css">
</head>
<body>

  <div class="hp-card">

    <header class="hp-header">
      <span class="hp-crest">⚡</span>
      <h1 class="hp-title">Grimório de Feitiços</h1>
      <p class="hp-subtitle">Ministério da Magia — Registro de Encantamentos</p>
    </header>

    <hr class="hp-divider">

    <?php if ($mensagem): ?>
      <div class="hp-alert">
        <?= htmlspecialchars($mensagem) ?>
      </div>
    <?php endif; ?>

    <form method="post">
      <div class="hp-grid">

        <div class="hp-field full">
          <label class="hp-label" for="nome">Nome do Feitiço</label>
          <input class="hp-input" type="text" id="nome" name="nome" placeholder="Ex: Expelliarmus" required>
        </div>

        <div class="hp-field">
          <label class="hp-label" for="tipo">Tipo</label>
          <select class="hp-select" id="tipo" name="tipo" required>
            <option value="">-- Selecione --</option>
            <option value="Encantamento">Encantamento</option>
            <option value="Maldição">Maldição</option>
            <option value="Contrafeitiço">Contrafeitiço</option>
            <option value="Transformação">Transformação</option>
            <option value="Feitiço de Cura">Feitiço de Cura</option>
          </select>
        </div>

        <div class="hp-field">
          <label class="hp-label" for="nivel_dificuldade">Dificuldade</label>
          <select class="hp-select" id="nivel_dificuldade" name="nivel_dificuldade" required>
            <option value="">-- Selecione --</option>
            <option value="Fácil">Fácil</option>
            <option value="Médio">Médio</option>
            <option value="Difícil">Difícil</option>
            <option value="Muito Difícil">Muito Difícil</option>
          </select>
        </div>

        <div class="hp-field full">
          <label class="hp-label" for="movimento_varinha">Movimento da Varinha</label>
          <input class="hp-input" type="text" id="movimento_varinha" name="movimento_varinha" placeholder="Descreva o gesto...">
        </div>

        <div class="hp-field full">
          <label class="hp-label" for="efeito">Efeito</label>
          <input class="hp-input" type="text" id="efeito" name="efeito" placeholder="Descreva o efeito do feitiço...">
        </div>

        <div class="hp-field">
          <label class="hp-label" for="proibido">
            Proibido
            <span class="hp-forbidden-badge">Imperdoável</span>
          </label>
          <select class="hp-select" id="proibido" name="proibido" required>
            <option value="">-- Selecione --</option>
            <option value="1">Sim</option>
            <option value="0">Não</option>
          </select>
        </div>

      </div>

      <div class="hp-actions">
        <button class="hp-btn-save" type="submit">✦ Registrar Feitiço</button>
        <a class="hp-btn-cancel" href="index.php">Cancelar</a>
      </div>
    </form>

  </div>

</body>
</html>