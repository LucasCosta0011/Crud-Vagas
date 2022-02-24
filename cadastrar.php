<?php
    // Para chamar as classes
    require __DIR__.'/vendor/autoload.php';

    // echo "<pre>"; print_r($_POST); echo "</pre>";

    // Chamando a Classe
    use \App\Entity\Vaga;

    // Validação do POST
    if(isset($_POST['titulo'], $_POST['descricao'], $_POST['ativo'])){
      // Matar o código um teste para saber se está entrando na condição
      //die('cadastrar.php');

      // Criando uma nova Instância
      $obVaga = new Vaga;
      $obVaga->titulo = $_POST['titulo'];
      $obVaga->descricao = $_POST['descricao'];

      // É possível implementar se chegou o valor (s/n), aumentar o nível de segurança
      $obVaga->ativo = $_POST['ativo'];

      $obVaga->cadastrar();

      // Classe instânciada
      //echo "<pre>"; print_r($obVaga); echo "</pre>"; exit;

      header('location: index.php?status=success');
      // sempre que tiver um alteração de cabeçalho dessa forma, coloca um exit no final
      // para impedir a execução do restante da página
      exit;



    }

    include __DIR__.'/includes/header.php';
    include __DIR__.'/includes/formulario.php';
    include __DIR__.'/includes/footer.php';

?>