<?php
    // Para chamar as classes
    require __DIR__.'/vendor/autoload.php';
    // echo "<pre>"; print_r($_POST); echo "</pre>";

    // Chamando a Classe
    use \App\Entity\Vaga;

    // Validação do ID
    if(!isset($_GET['id']) or !is_numeric($_GET['id'])){
      header('location: index.php?status=error');
      exit;
    }

    // Consulta a Vaga
    $obVaga = Vaga::getVaga($_GET['id']);
    //echo "<pre>"; print_r($obVaga); echo "</pre>"; exit;

    // Validação a Vaga
    // Se $obVaga não for uma instância de Vaga
    // Ou seja, se não existir vaga no ID passado
    if(!$obVaga instanceof Vaga){
      header('location: index.php?status=error');
      exit;
    }

    //echo "<pre>"; print_r($obVaga); echo "</pre>"; exit;

    // Validação do POST
    if(isset($_POST['excluir'])){

      $obVaga->excluir();

      // Classe instânciada
      //echo "<pre>"; print_r($obVaga); echo "</pre>"; exit;

      header('location: index.php?status=success');
      // sempre que tiver um alteração de cabeçalho dessa forma, coloca um exit no final
      // para impedir a execução do restante da página
      exit;



    }

    include __DIR__.'/includes/header.php';
    include __DIR__.'/includes/confirmar-exclusao.php';
    include __DIR__.'/includes/footer.php';

?>