<?php
session_start();
if ($_SERVER['SERVER_PORT'] == 443) {
    header('Location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
    exit();
  }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Política de Segurança da Informação</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Política de Segurança da Informação</h1>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Seção</th>
                    <th>Conteúdo</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1. Política de Segurança da Informação</td>
                    <td>Esta Política de Segurança da Informação estabelece as diretrizes, normas e procedimentos para garantir a proteção adequada dos dados e informações na Clínica Odontológica Sorriso Bonito e Dente Saudável. Reconhecemos que a segurança da informação é crucial para preservar a confidencialidade, integridade e disponibilidade dos recursos de informação e, portanto, é essencial para o sucesso e reputação da clínica.</td>
                </tr>
                <tr>
                    <td>2. Objetivos</td>
                    <td>
                        <ul>
                            <li>Garantir a confidencialidade, integridade e disponibilidade dos dados e informações da clínica.</li>
                            <li>Proteger os ativos de informação contra acessos não autorizados, modificações indevidas, divulgação não autorizada e perda.</li>
                            <li>Cumprir com as leis e regulamentos pertinentes relacionados à segurança da informação.</li>
                            <li>Promover a conscientização e responsabilidade dos colaboradores em relação à segurança da informação.</li>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td>3. Diretrizes</td>
                    <td>
                        <h5>3.1. Acesso e Controle de Informações</h5>
                        <ul>
                            <li>Todos os colaboradores terão acesso apenas às informações necessárias para desempenhar suas funções.</li>
                            <li>O acesso a informações confidenciais será restrito e controlado por meio de políticas de acesso baseadas em funções.</li>
                            <li>Senhas seguras e práticas de autenticação de dois fatores serão implementadas para garantir a autenticidade dos usuários.</li>
                        </ul>

                        <h5>3.2. Proteção de Dados</h5>
                        <ul>
                            <li>Todos os dados serão classificados de acordo com seu nível de sensibilidade, e medidas de proteção apropriadas serão aplicadas com base nessa classificação.</li>
                            <li>Serão implementadas medidas de segurança técnica, como criptografia e firewalls, para proteger os dados contra acesso não autorizado.</li>
                        </ul>

                        <h5>3.3. Conscientização e Treinamento</h5>
                        <ul>
                            <li>Todos os colaboradores serão submetidos a treinamentos regulares sobre segurança da informação para garantir a conscientização e o cumprimento das políticas estabelecidas.</li>
                            <li>Procedimentos de resposta a incidentes serão estabelecidos e comunicados a todos os colaboradores, para garantir uma resposta eficaz em caso de violação de segurança.</li>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td>4. Sanções</td>
                    <td>
                        <h5>4.1. Advertência Verbal</h5>
                        <p>Em caso de violação leve ou primeira infração, o colaborador será sujeito a uma advertência verbal, onde será explicada a natureza da violação e suas consequências no caso de repetições futuras.</p>

                        <h5>4.2. Advertência Escrita</h5>
                        <p>Se a violação persistir após uma advertência verbal ou se a gravidade da infração exigir, o colaborador será notificado por escrito, registrando a violação e as medidas corretivas necessárias.</p>

                        <h5>4.3. Suspensão Temporária</h5>
                        <p>Em casos de violações graves ou repetidas, o colaborador poderá ser suspenso temporariamente de suas funções, com perda temporária de acesso aos sistemas e recursos de informação da clínica.</p>

                        <h5>4.4. Demissão</h5>
                        <p>Em situações extremas, como violações graves de segurança da informação, negligência repetida ou intenção maliciosa, a demissão do colaborador será considerada, conforme estabelecido nas políticas de recursos humanos da clínica.</p>

                        <h5>4.5. Responsabilidade Legal</h5>
                        <p>Além das sanções internas, os colaboradores podem estar sujeitos a ações legais e responsabilização civil caso suas ações resultem em danos à clínica, aos pacientes ou a terceiros.</p>
                    </td>
                </tr>
                <tr>
                    <td>5. Cumprimento e Revisão</td>
                    <td>Esta política será revisada regularmente para garantir sua eficácia contínua e sua conformidade com as melhores práticas e regulamentos aplicáveis. Todos os colaboradores são responsáveis por cumprir esta política e estão sujeitos a medidas disciplinares em caso de violação.</td>
                </tr>
            </tbody>
        </table>
        <a href="index.php" class="btn btn-light mt-3">Voltar</a>
    </div>

  
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
