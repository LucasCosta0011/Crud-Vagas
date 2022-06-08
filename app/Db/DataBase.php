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
  /**
   * Método responsável por executar queries dentro do Banco de Dados
   * @param string
   * @param array
   * @return PDOStatement
   * 
   */
  // Se não tiver as binds, não preciso passar os params
  // Os $params são os valores que vão substituir os $binds 
  public function execute($query, $params = []){
    try{
      // Isso já executa a ação e deixa o banco certo
      $statement = $this->connection->prepare($query);
      $statement->execute($params);
      // É do $statement que pegamos os dados que vem do banco para fazer um select
      return $statement;
    }catch(PDOException $e){
      die('ERROR: '.$e->getMessage());
    }
  }

  /**
   * Método responsável por inserir dados no banco
   * @param array $values [ field => value]
   * @return integer ID inserido
   */
  public function insert($values){
    // query comum
    //$query = 'INSERT INTO vagas (titulo, descricao, ativo, data) VALUES ("teste", "teste2", "n", "2022-02-24 08:22:00")';

    // Dados da Query
    // Posso passar direto, mas para mais organização vou passar aqui em cima
    $fields = array_keys($values);
    // $fields ficou com as chaves e o $values com os valores
    //echo "<pre>"; print_r($fields); echo "</pre>"; exit;
    
    // Pegamos um array vazio e passamos o número de posições X
    // Se ele não tiver X posições cria novas posições com padrões específicos
    // Preciso de um array com o mesmo número de posições do $fields e se não tiver
    // quero que as posições novas sejam interrogações.
    $binds = array_pad([], count($fields), '?');
    //echo "<pre>"; print_r($binds); echo "</pre>"; exit;


    // Monta a Query
    // No momento da execução dessa query o PDO faz uma validação se os dados são seguros para inserir no banco
    // tudo que for dinamico na query podemos passar assim:
    // implode () concatena todos os dados dentro do array com um separador no caso a vírgula
    $query = 'INSERT INTO '.$this->table.' ('.implode(',',$fields).') VALUES ('.implode(',',$binds).')';
    //echo $query; exit;

    // Executa o insert
    $this->execute($query, array_values($values));

    // Retorna o ID inserido
    return $this->connection->lastInsertId();

  }
  /**
   * Método responsável por executar uma consulta no banco
   * @param string $where
   * @param string $order
   * @param string $limit
   * @return PDOStatement
   */
  public function select($where = null, $order = null, $limit = null, $fields = '*'){
    // DADOS DA QUERY
    //Se tiver dados faz alguma coisa, se não faz outra
    $where = strlen($where) ? 'WHERE '.$where : '';
    $order = strlen($order) ? 'ORDER BY '.$order : '';
    $limit = strlen($limit) ? 'LIMIT '.$limit : '';
    $query = 'SELECT '.$fields.' FROM '.$this->table.' '.$where.' '.$order.' '.$limit.'';

    //EXECUTA A QUERY
    return $this->execute($query);
  }
  /**
   * Método responsável por executar atualizações no banco de dados
   * @param string $where
   * @param array $values [ field => $value ]
   * @return boolean
   */
  public function update($where, $values){
    //DADOS DA QUERY
    $fields = array_keys($values);

    // Exemplo de UPDATE estático
    //$query = "UPDATE vagas SET titulo="titulo", descricao="descricao", ativo="ativo", data="data" WHERE id = 1";

    // MONTA A QUERY
    // Exemplo de UPDATE Dinâmico
    $query = 'UPDATE '.$this->table.' SET '.implode('=?,',$fields).'=? WHERE '.$where;
    //echo $query;
    //exit;

    // EXECUTAR A A QUERY
    $this->execute($query, array_values($values));

    // RETORNA SUCESSO
    return true;
  }

  /**
   * Método responsável por excluir dados do banco
   * @param string $where
   * @return boolean
   */
  public function delete($where){
    // MONTA A QUERY
    $query = 'DELETE FROM '.$this->table.' WHERE '.$where;

    // EXECUTA A QUERY
    $this->execute($query);

    // RETORNA SUCESSO
    return true;
  }
  
}

?>