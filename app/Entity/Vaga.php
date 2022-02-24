<?php

namespace App\Entity;

// Definindo a dependência
use \App\Db\DataBase;

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

    return true;
    // Retornar Sucesso

  }
}