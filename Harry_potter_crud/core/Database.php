<?php
/**
 * Classe Database - Gerencia a conexão PDO (PHP Data Objects)
 * 
 * Padrão Singleton: garante que exista apenas UMA conexão ativa durante toda a execução
 * Isso economiza recursos do servidor
 */

// Inclui o arquivo de configuração para usar as constantes definidas
require_once __DIR__ . '/../config/config.php';

class Database {
    // Atributo estático que armazenará a única instância da classe
    private static $instance = null;
    
    // Atributo que armazenará o objeto PDO (a conexão propriamente dita)
    private $conn;

    /**
     * Construtor privado - impede que alguém crie objetos com 'new Database()'
     * Só pode ser chamado dentro da própria classe
     */
    private function __construct() {
        /**
         * DSN (Data Source Name) - string que descreve a conexão
         * Formato: 'mysql:host=localhost;dbname=crud_bts;charset=utf8mb4'
         */
        $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
        
        /**
         * Opções de configuração do PDO
         * PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
         *   - Em caso de erro, lança uma exceção (try/catch). Muito útil para debugar
         * 
         * PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
         *   - Por padrão, os resultados das consultas vêm como array associativo
         *   - Ex: $row['nome'] ao invés de $row[0]
         * 
         * PDO::ATTR_EMULATE_PREPARES => false
         *   - Usa prepared statements NATIVOS do banco (mais seguros contra SQL injection)
         *   - Também respeita melhor os tipos de dados
         */
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false
        ];

        try {
            // Tenta criar a conexão PDO com o banco de dados
            $this->conn = new PDO($dsn, DB_USER, DB_PASS, $options);
        } catch (PDOException $e) {
            /**
             * Se falhar, exibe mensagem amigável e para a execução
             * Em produção, você logaria o erro e mostraria uma mensagem genérica
             */
            die("Erro de conexão com o banco de dados: " . $e->getMessage());
        }
    }

    /**
     * Método estático público - ponto de acesso à instância única
     * 
     * @return Database - a única instância da classe
     */
    public static function getInstance() {
        // Verifica se a instância ainda não foi criada
        if (self::$instance === null) {
            // Cria a instância (chama o construtor privado)
            self::$instance = new Database();
        }
        // Retorna a instância (já existente ou recém-criada)
        return self::$instance;
    }

    /**
     * Retorna o objeto PDO para ser usado nas consultas
     * 
     * @return PDO - objeto de conexão PDO
     */
    public function getConnection() {
        return $this->conn;
    }
}
?>