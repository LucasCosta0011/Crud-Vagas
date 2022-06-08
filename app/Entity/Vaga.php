<?php

namespace App\Entity;

// Definindo a dependência
use \App\Db\DataBase;
use \PDO;

class Vaga{

  /*
   * Identificador único da vaga
   * @var integer 
   */
  public $id;

   /*
   * Título da vaga
   * @var string
   */
  public $titulo;

   /*
   * Descrição da vaga (pode conter html)
   * @var integer 
   */
  public $descricao;

   /*
   * Define se a vaga está ativa
   * @var integer (s/n)
   */
  public $ativo;

   /*
   * Data de publicação da vaga
   * Mesmo sendo timestemp, no momento que lermos ela do banco, ela saí como string
   * @var integer 
   */
  public $data;

   /*
   * Método responsável por cadastrar uma nova vaga
   * @return boolean 
   */
  public function cadastrar(){
    // Definir a Data
    // Data em formato americano
    $this->data = date('Y-m-d H:m:s');

    // Inserir a Vaga no Banco
    $obDataBase = new DataBase('vagas');
    // Vai ser a query builder, vai montar uma sql de insert e executar na tabela vagas
    // O ID da vaga vai ser igual ao resultado do insert
    // se o insert for sucesso vou exibir um id, se não cai numa exception
    $this->id = $obDataBase->insert([
                        'titulo'    => $this->titulo,
                        'descricao' => $this->descricao,
                        'ativo'     => $this->ativo,
                        'data'      => $this->data
                        ]);
    // Debug na instância
    //echo "<pre>"; print_r($this); echo "</pre>"; exit;
    
    // Retornar Sucesso
    return true;
  }
  /**
   * Método responsável por atualizar a vaga no banco
   * @return boolean
   */
  public function atualizar(){
    return (new DataBase('vagas'))->update('id = '.$this->id, [
                                                                'titulo' => $this->titulo,
                                                                'descricao' => $this->descricao,
                                                                'ativo' => $this->ativo,
                                                                'data' => $this->data
                                                              ]);
  }
  /**
   * Método responsável por obter as vagas do banco de dados
   * @param string $where 
   * @param string $order
   * @param string $limit
   * @return array 
   */
  public static function getVagas($where = null, $order = null, $limit = null){
    // Retorna uma instância de PDOStatement
    return (new DataBase('vagas'))->select($where, $order, $limit)
    // O PDOStatement tem um método fetchAll
    // Todo o retorno vai ser transformado em um array
    // Primeiro parâmetro o tipo de array retornado
    // Segundo parâmetro o tipo de objeto
    // no caso uma instância da própria classe
                                  ->fetchAll(PDO::FETCH_CLASS, self::class);

  }
  /**
   * Método responsável por buscar uma vaga com base em seu ID
   * @param integer
   * @return Vaga
   */
  public static function getVaga($id){
    return (new DataBase('vagas'))->select('id = '.$id)
    // O PDOStatement tem um método fetch
    // todo o retorno é transformado em dado unitário
    // Passamos a classe que queremos instânciar como parâmetro
                                  ->fetchObject(self::class);
  }
  /**
   * Método responsável por excluir a vaga do banco
   * @return boolean
   */
  public function excluir(){
    return (new DataBase('vagas'))->delete('id = '.$this->id);
  }
}