<?php
  $mensagem = '';
  if(isset($_GET['status'])){
    switch ($_GET['status']){
      case 'success':
        $mensagem = '<section class="alert alert-success">Ação executada com sucesso!</section>';
        break;
      case 'error':
        $mensagem = '<section class="alert alert-danger">Ação não executada!</section>';
        break;
    }
  }

  // Erros pequenos e grandes problemas
  // href="editar.php?id'.$vaga->id.'"
  // href="editar.php?id='.$vaga->id.'"
  $resultados = '';
  foreach($vagas as $vaga){
    $resultados .= '<tr>
                      <td>'.$vaga->id.'</td>
                      <td>'.$vaga->titulo.'</td>
                      <td>'.$vaga->descricao.'</td>
                      <td>'.($vaga->ativo == 's' ? 'Ativo' : 'Inativo').'</td>
                      <td>'.date('d/m/Y à\s H:i:s', strtotime($vaga->data)).'</td>
                      <td>
                      
                        <a href="editar.php?id='.$vaga->id.'">
                          <buttton type="button" class="btn btn-primary">Editar</button>
                        </a>
                        <a href="excluir.php?id='.$vaga->id.'">
                          <buttton type="button" class="btn btn-danger">Excluir</button>
                        </a>
                      </td>
                    </tr>';
  }

  $resultados = strlen($resultados) ? $resultados : '<tr>
                                                      <td colspan="6" class="text-center">
                                                        Nenhuma vaga encontrada
                                                      </td>
                                                    </tr>';

?>

<main>
  <?=$mensagem?>
  <section>

    <a href="cadastrar.php">
      <button class="btn btn-success">Nova vaga</button>
    </a>

  </section>

  <section>

    <table class="table bg-light mt-3">
      <thead>
        <tr>
          <th>ID</th>
          <th>Título</th>
          <th>Descrição</th>
          <th>Status</th>
          <th>Data</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <?=$resultados?>
      </tbody>

    </table>

  </section>

</main>