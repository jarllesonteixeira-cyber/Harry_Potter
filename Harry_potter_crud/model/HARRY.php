<?php 
class HARRY{

private ?int $id;

private ?string $nome;

private ?string $tipo;

private ?string $movimento_varinha;

private ?string $efeito;

private ?string $nivel_dificuldade;

private ?bool $proibido;
/** 
 * @param int|null $id
 * @param string|null $nome
 * @param string|null $tipo
 * @param string|null $movimento_varinha
 * @param string|null $efeito
 * @param string|null $nivel_dificuldade
 * @param boolean|null $proibido
*/

 public function __construct(
   ?int $id = null,
   ?string $nome = null,
   ?string $tipo = null,
   ?string $movimento_varinha = null,
   ?string $efeito = null,
   ?string $nivel_dificuldade = null,
   ?bool $proibido = null,
) {
    $this->id = $id;
    $this->nome = $nome;
    $this->tipo = $tipo;
    $this->movimento_varinha = $movimento_varinha;
    $this->efeito = $efeito;
    $this->nivel_dificuldade = $nivel_dificuldade;
    $this->proibido = $proibido;
}

// Getters

public function getId(): ?int 
{
   return $this->id; 
}

public function getNome(): ?string
{
   return $this->nome; 
}

public function getTipo(): ?string
{
   return $this->tipo; 
}

public function getMovimento_Varinha(): ?string
{
   return $this->movimento_varinha; 
}

public function getEfeito(): ?string
{
   return $this->efeito; 
}

public function getNivel_Dificuldade(): ?string
{
   return $this->nivel_dificuldade; 
}

public function getProibido(): ?int
{
   return $this->proibido; 
}

// Setters 

public function setId($id): void
{
   $this->id = $id; 
}

public function setNome($nome): void
{
   $this->nome = $nome; 
}

public function setTipo($tipo): void
{
    $this->tipo = $tipo; }

public function setMovimento_Varinha($movimento_varinha): void
{
    $this->movimento_varinha = $movimento_varinha; 
}

public function setEfeito($efeito): void
{
    $this->efeito = $efeito;
}

public function setNivel_Dificuldade($nivel_dificuldade): void
{
    $this->nivel_dificuldade = $nivel_dificuldade;
}

public function setProibido($proibido): void
{
    $this->proibido = $proibido;
}

}