<?php
require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../model/HARRY.php';

class HARRYDAO
{
  private $pdo;
  public function __construct()
  {
    $this->pdo = Database::getInstance()->getConnection();
  }
  public function create(HARRY $feitico)
  {
    $sql = "INSERT INTO feiticos (nome, tipo, movimento_varinha, efeito, nivel_dificuldade, proibido) VALUES (:nome, :tipo, :movimento_varinha, :efeito, :nivel_dificuldade, :proibido)";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':nome', $feitico->getNome());
    $stmt->bindValue(':tipo', $feitico->getTipo());
    $stmt->bindValue(':movimento_varinha', $feitico->getMovimento_Varinha());
    $stmt->bindValue(':efeito', $feitico->getEfeito());
    $stmt->bindValue(':nivel_dificuldade', $feitico->getNivel_Dificuldade());
    $stmt->bindValue(':proibido', $feitico->getProibido());

    // Executa a query no banco
    $stmt->execute();

    // Retorna o ID gerado automaticamente pelo MySQL
    return $this->pdo->lastInsertId();
  }
public function readAll()
{
    $sql = "SELECT * FROM feiticos ORDER BY id";
    $stmt = $this->pdo->query($sql);

    $lista = [];
    while ($row = $stmt->fetch()) {
        $feiticos = new HARRY(
            $row['id'],
            $row['nome'],
            $row['tipo'],
            $row['movimento_varinha'],
            $row['efeito'],
            $row['nivel_dificuldade'],
            $row['proibido'],
        );
        $lista[] = $feiticos;
    }
    return $lista;
}

public function readById($id)
{
    $sql = "SELECT * FROM feiticos WHERE id = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();

    if ($row = $stmt->fetch()) {
        return new HARRY(
            $row['id'],
            $row['nome'],
            $row['tipo'],
            $row['movimento_varinha'],
            $row['efeito'],
            $row['nivel_dificuldade'],
            $row['proibido'],
        );
    }
    return null;
}
  public function update(HARRY $feitico)
  {
    $sql = "UPDATE feiticos SET nome = :nome, tipo = :tipo, movimento_varinha = :movimento_varinha, efeito = :efeito, nivel_dificuldade = :nivel_dificuldade, proibido = :proibido WHERE id = :id";

    $stmt = $this->pdo->prepare($sql);

    // Vincula todos os valores, incluindo o ID para o WHERE
    $stmt->bindValue(':id', $feitico->getId(), PDO::PARAM_INT);
    $stmt->bindValue(':nome', $feitico->getNome());
    $stmt->bindValue(':tipo', $feitico->getTipo());
    $stmt->bindValue(':movimento_varinha', $feitico->getMovimento_Varinha());
    $stmt->bindValue(':efeito', $feitico->getEfeito());
    $stmt->bindValue(':nivel_dificuldade', $feitico->getNivel_Dificuldade());
    $stmt->bindValue(':proibido', $feitico->getProibido());

    // execute() retorna true em caso de sucesso, false em falha
    return $stmt->execute();
  }
  public function delete($id)
  {
    $sql = "DELETE FROM feiticos WHERE id = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);

    return $stmt->execute();
  }
}
//CREATE - READ_BY_ID - READ_ALL- UPDADE - DELETE
