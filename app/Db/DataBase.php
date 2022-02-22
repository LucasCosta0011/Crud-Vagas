<?php
  // Ponte entre o sistema e o banco de dados utilizando PDO
  // Uma classe vai abstrair a escrita de sql
  // Vai escrever a sql sozinha, só passa os dados e ela executa no banco

namespace App\Db;

// Definindo PDO como uma dependência da Classe

use PDOException;
use \PDO;

class DataBase{

/*
* Host de conexão com o Banco de Dados
* @var integer 
*/
  const HOST = 'localhost';

/*
* Nome do Banco de Dados
* @var integer 
*/
  const NAME = 'crud';

/*
* Usuário do Banco de Dados
* @var integer 
*/
  const USER = 'root';

/* 
*Senha do Banco de Dados
* @var integer 
*/
  const PASS = '';

/*
* Nome da Tabela a ser Manipulada
* @var integer 
*/
  private $table;

/*
* Instância de PDO, um grupo de classes que vão ajudar a conectar com o Banco de Dados
* Facilita a Portabilidade de Banco de Dados 
* Instância de Conexão com o Banco de Dados
* @var PDO 
*/
  private $connection;

/*
* Posso não passar o parâmetro, caso não queira trabalhar com manipulação de tabela
* Define a Tabela e instância a conexão
* @var string $table 
*/
  public function __construct($table = null){
    // Caso defina algum valor, ele já vai definir na classe
    $this->table = $table;

    // Criar um método para criar a conexão
    $this->setConnection();
  }

/*
* Método responsável por criar uma conexão com o Banco de Dados
* @var integer 
*/
  private function setConnection(){
    // Vai definir uma instância de PDO

    try{
      // Posso colocar outras config, por exemplo, a porta do banco.
      $this->connection = new PDO('mysql:host='.self::HOST.';dbname='.self::NAME,self::USER,self::PASS);

      // Sempre que houver algum erro na query ele vai travar o sistema
      // Connection agr é uma instância de PDO
      // setAttribute tem dois parâmetros
      // O Atributo que queremos alterar 
      // E o Valor que esse Atributo vai receber
      $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){
      // Expondo os erros do banco para o cliente
      // Retirar quando acabar o Desenvolvimento
      // Aconselhavel enviar uma mensagem mais amigável para o usuário
      // E gravar a mensagem do erro real no log
      // Para que esse dado fique disponível apenas internamente
      die('ERROR: '.$e->getMessage());
    }

  }
}

?>