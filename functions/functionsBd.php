<?php

include '../../functions/conexaoBd.php';

/* ----------------------------------------------------------------------
 *                    FUNÇÕES DE INSERÇÃO
 * ---------------------------------------------------------------------- */

function cadastrarUsuario($tipo, $cpf, $nome, $email, $senha, $cep, $rua, $numero, $bairro, $cidade, $estado, $categoria, $dataNasc)
{
    $res = "INSERT INTO usuario (tipo, cpf, nome, email, senha, cep, rua, numero, bairro, cidade, estado, categoria, dataNasc)"
            . " VALUES ('$tipo', '$cpf', '$nome', '$email', '$senha', '$cep', '$rua', '$numero', '$bairro', '$cidade', '$estado',"
            . " '$categoria', '$dataNasc')";

    if (mysql_query($res))
    {
        echo "<script> alert('Usuário cadastrado com sucesso!'); "
        . "window.location='../projetoAprovado/projetosAprovados.php';</script>";
    } else
    {
        echo "<script> alert('Erro no cadastro do usuario!');"
        . " window.location='cadastrarUsuario.php';</script>";
    }
}

function cadastrarEditalOrcamento($nome, $dataPublicacao, $dataTermino, $valTotal, $valMin, $valMAx, $cotaAluno, $cotaProf, $cotaServ, $tmp_name, $location)
{

    if (($cotaAluno + $cotaProf + $cotaServ) != 1)
    {
        echo "<script> alert('Erro no cadastro das cotas do Edital de Orçamento!');"
        . " window.location='cadastrarEditalCota.php';</script>";
    } else
    {
        // Pega QTD de usuários
        $SQL = mysql_query("SELECT COUNT(*) FROM usuario WHERE tipo = 'Financiador Academico'");
        $qtdAluno = mysql_result($SQL, 0);
        $SQL = mysql_query("SELECT COUNT(*) FROM usuario WHERE tipo = 'Gestor de Projetos'");
        $qtdProfessor = mysql_fetch_array($SQL);
        $SQL = mysql_query("SELECT COUNT(*) FROM usuario WHERE tipo = 'Financiador Academico'");
        $qtdServ = mysql_fetch_array($SQL);

        // Realiza contas
        $valTotalAluno = $valTotal * $cotaAluno;
        $valTotalProfessor = $valTotal * $cotaProf;
        $valTotalServ = $valTotal * $cotaServ;

        if ($qtdAluno[0] != 0)
            $valIndAluno = $valTotalAluno / $qtdAluno[0];
        else
            $valIndAluno = 0;

        if ($qtdProfessor[0] != 0)
            $valIndProfessor = $valTotalProfessor / $qtdProfessor[0];
        else
            $valIndAluno = 0;

        if ($qtdServ[0] != 0)
            $valIndServ = $valTotalServ / $qtdServ[0];
        else
            $valIndAluno = 0;

        // ATUALIZAR FUNÇÃO
        $res = "INSERT INTO editalorcamento (nome, dataPublicacao, dataTermino, valTotal, valMin, valMax, arquivo, cotaAluno, cotaProfessor, cotaServ, "
                . "qtdAluno, qtdProfessor, qtdServ, "
                . "valTotalAluno, valTotalProfessor, valTotalServ,"
                . "valIndAluno, valIndProfessor, valIndServ) VALUES "
                . "('$nome', '$dataPublicacao', '$dataTermino', '$valTotal', '$valMin', '$valMax', '$arquivo', "
                . "'$cotaAluno', '$cotaProf', '$cotaServ', "
                . "'[$qtdAluno[0]', '$qtdProfessor[0]', '$qtdServ[0]', "
                . "'$valTotalAluno', '$valTotalProfessor', '$valTotalServ',"
                . "'$valIndAluno', '$valIndProfessor', '$valIndServ')";

        if (mysql_query($res))
        {
            move_uploaded_file($tmp_name, $location);
            echo "<script> confirm('Edital de Orçamento cadastrado com sucesso!'); "
            . "window.location='../editalOrcamento/infoEditalOrcamento.php';</script>";
        } else
        {
            echo "<script> alert('Erro no cadastro do Edital de Orçamento!');"
            . " window.location='../editalOrcamento/infoEditalOrcamento.php';</script>";
        }
    }
}

function cadastrarProjetoCandidato($categoria, $titulo, $location, $descricao, $duracao, $dataInicio, $status, $valTotal, $autor, $resumo, $tmp_name)
{
    $res = null;

    $res = "INSERT INTO projeto (categoria, titulo, imagem, descricao, duracao, dataInicio, status, valorTotal, autor, resumo)"
            . " VALUES ('$categoria', '$titulo', '$location', '$descricao',"
            . "'$duracao', '$dataInicio', '$status', '$valTotal', '$autor', '$resumo')";

    if (mysql_query($res))
    {
        move_uploaded_file($tmp_name, $location);

        echo "<script> alert('Projeto Candidato cadastrado com sucesso!'); "
        . "window.location='../../pages/projetoAprovado/projetosAprovados.php';</script>";
    } else
    {
        echo "<script> alert('Erro no cadastro de Projeto Candidato!');"
        . " window.location='../../pages/projetoCandidato/cadastrarProjetoCandidato.php';</script>";
    }
}

function cadastraDoacao($idProjeto, $idAutor, $valor, $forma, $data)
{

    $queryAutor = procuraAutor($idAutor);
    $dadoAutor = mysql_fetch_array($queryAutor);

    $queryProjeto = consultaProjetoPorId($idProjeto);
    $dadoProjeto = mysql_fetch_array($queryProjeto);
    $saldoProjeto = $dadoProjeto['valArrecadado'] + $valor;

    $regDoacao = "INSERT INTO doacoes (idProjeto, idUsr, valor, formaPgto, data)"
            . " VALUES ('$idProjeto', '$idAutor', '$valor', '$forma', '$data')";

    $atualizaSaldoProjeto = "UPDATE projeto SET valArrecadado = '" . $saldoProjeto . "' WHERE id = '" . $idProjeto . "'";

    if (mysql_query($regDoacao) && (mysql_query($atualizaSaldoProjeto)))
    {
        echo "<script> confirm('Doação realizada com sucesso!'); "
        . "window.location='../../pages/projetoAprovado/projetosAprovados.php';</script>";
    } else
    {
        echo "<script> alert('Erro na doação!'); "
        . "window.location='../../pages/projetoAprovado/projetosAprovados.php';</script>";
    }
}

function cadastrarCriterio($categoria, $criterio, $descricao, $status, $peso)
{
    $res = "INSERT INTO criterios (categoria, criterio, descricao, status, peso)"
            . " VALUES ('$categoria', '$criterio', '$descricao', '$status', '$peso')";


    if (mysql_query($res))
    {
        echo "<script> confirm('Critério cadastrado com sucesso!'); "
        . "window.location='../../pages/criterios/infoCriterios.php';</script>";
    } else
    {
        echo "<script> alert('Erro no cadastro do Critério!'); "
        . "window.location='../../pages/criterios/infoCriterios.php';</script>";
    }
}

function cadastraRepasse($idProjeto, $valor, $necessidade, $data, $status)
{
    $res = "INSERT INTO repassefinanceiro (idProjeto, valor, necessidade, date, status)"
            . " VALUES ('$idProjeto', '$valor', '$necessidade', '$data', '$status')";


    if (mysql_query($res))
    {
        echo "<script> confirm('Repasse realizada com sucesso!'); "
        . "window.location='../../pages/projetoCandidato/infoProjetosCandidatos.php';</script>";
    } else
    {
        echo "<script> alert('Erro no cadastro do Repasse!'); "
        . "window.location='../../pages/projetoCandidato/infoProjetosCandidatos.php';</script>";
    }
}

function cadastrarRecompensa($idProjeto, $descricao, $valMin, $valMax, $limite)
{
    $res = "INSERT INTO recompensa (idProjeto, descricao, valMin, valMax, limite)"
            . " VALUES ('$idProjeto', '$descricao', '$valMin', '$valMax', '$limite')";


    if (mysql_query($res))
    {
        echo "<script> confirm('Recompensa cadastrada com sucesso!'); "
        . "window.location='../../pages/projetoAprovado/projetosAprovados.php';</script>";
    } else
    {
        echo "<script> alert('Erro no cadastro da recompensa!'); "
        . "window.location='../../pages/projetoAprovado/projetosAprovados.php';</script>";
    }
}

/* ----------------------------------------------------------------------
 *                    FUNÇÕES DE ATUALIZAÇÃO
 * ---------------------------------------------------------------------- */

function alterarUsuario($cpf, $nome, $email, $senha, $cep, $rua, $bairro, $cidade, $estado)
{
    $res = null;

    if ($nome != null && $email != null && $senha != null && $cep != null && $rua != null && $bairro != null && $cidade != null && $estado != null)
    // ATUALIZAR FUNÇÃO
        $res = "UPDATE usuario SET nome = '" . $nome . "', email = '" . $email . "', senha = '" . $senha . "', cep = '" . $cep . "', "
                . "rua = '" . $rua . "', bairro = '" . $bairro . "', cidade = '" . $cidade . "', estado = '" . $estado . "' "
                . "WHERE cpf = '" . $cpf . "'";

    if (mysql_query($res))
    {
        echo "<script> alert('Usuario atualizado com sucesso!'); "
        . "window.location='../../pages/projetoAprovado/projetosAprovados.php';</script>";
    } else
    {
        echo "<script> alert('Erro na atualização!'); "
        . "window.location='../../pages/usuario/alterarUsuario.php';</script>";
    }
}

function desativaUsuario($cpf)
{
    $res = "UPDATE usuario SET status = 'desativo'"
            . "WHERE cpf = '" . $cpf . "'";

    if (mysql_query($res))
    {
        echo "<script> alert('Usuario desativado com sucesso!'); "
        . "window.location='../../pages/projetoAprovado/projetosAprovados.php';</script>";
    } else
    {
        echo "<script> alert('Erro na desativação!'); "
        . "window.location='../../pages/usuario/alterarUsuario.php';</script>";
    }
}

function ativaCriterio($id)
{
    $res = "UPDATE criterios SET status = 'ativado'"
            . "WHERE id = '" . $id . "'";

    if (mysql_query($res))
    {
        echo "<script> confirm('Criterio ativado com sucesso!'); "
        . "window.location='../../pages/criterios/infoCriterios.php';</script>";
    } else
    {
        echo "<script> alert('Erro na ativação!'); "
        . "window.location='../../pages/criterios/infoCriterios.php';</script>";
    }
}

function desativaCriterio($id)
{
    $res = "UPDATE criterios SET status = 'desativado'"
            . "WHERE id = '" . $id . "'";

    if (mysql_query($res))
    {
        echo "<script> confirm('Criterio desativado com sucesso!'); "
        . "window.location='../../pages/criterios/infoCriterios.php';</script>";
    } else
    {
        echo "<script> alert('Erro na desativação!'); "
        . "window.location='../../pages/criterios/infoCriterios.php';</script>";
    }
}

function alterarProjeto($id, $titulo, $categoria, $valorTotal, $resumo, $descricao, $duracao)
{
    $res = null;

    if ($id != null && $titulo != null && $categoria != null && $valorTotal != null && $resumo != null && $descricao != null && $duracao != null)
    // ATUALIZAR FUNÇÃO
        $res = "UPDATE projeto SET titulo = '" . $titulo . "', categoria = '" . $categoria . "', valorTotal = '" . $valorTotal . "', resumo = '" . $resumo . "', "
                . "descricao = '" . $descricao . "', duracao = '" . $duracao . "' "
                . "WHERE id = '" . $id . "'";

    if (mysql_query($res))
    {
        echo "<script> alert('Projeto atualizado com sucesso!'); "
        . "window.location='../../pages/projetoCandidato/infoProjetosCandidatos.php';</script>";
    } else
    {
        echo "<script> alert('Erro na atualização!'); "
        . "window.location='../../pages/projetoCandidato/infoProjetosCandidatos.php';</script>";
    }
}

function ativaUsuario($cpf)
{
    $res = "UPDATE usuario SET status = 'ativo'"
            . "WHERE cpf = '" . $cpf . "'";

    if (mysql_query($res))
    {
        echo "<script> alert('Usuario ativado com sucesso!'); "
        . "window.location='../../pages/usuario/alterarUsuario.php';</script>";
    } else
    {
        echo "<script> alert('Erro na desativação!'); "
        . "window.location='../../pages/usuario/alterarUsuario.php';</script>";
    }
}

function alterarCriterio($id, $criterio, $peso)
{
    $res = "UPDATE criterios SET criterio = '" . $criterio . "', peso = '" . $peso . "' "
            . "WHERE id = '" . $id . "'";

    if (mysql_query($res))
    {
        echo "<script> confirm('Critério alterado com sucesso!'); "
        . "window.location='../../pages/criterios/infoCriterios.php';</script>";
    } else
    {
        echo "<script> alert('Erro na alteração!'); "
        . "window.location='../../pages/criterios/infoCriterios.php';</script>";
    }
}

function alterarRepasse($id, $valor, $date)
{
    $res = "UPDATE repassefinanceiro SET valor = '" . $valor . "', date = '" . $date . "' "
            . "WHERE id = '" . $id . "'";

    if (mysql_query($res))
    {
        echo "<script> confirm('Repasse Financeiro alterado com sucesso!'); "
        . "window.location='../../pages/projetoCandidato/infoProjetosCandidatos.php';</script>";
    } else
    {
        echo "<script> alert('Erro na alteração!'); "
        . "window.location='../../pages/projetoCandidato/infoProjetosCandidatos.php';</script>";
    }
}

function finalizarProjetoAprovado($id)
{
    $res = "UPDATE projeto SET status = 'concluido' WHERE id = '" . $id . "'";

    if (mysql_query($res))
    {
        echo "<script> confirm('Projeto Concluido com sucesso!'); "
        . "window.location='../../pages/projetoCandidato/infoProjetosCandidatos.php';</script>";
    } else
    {
        echo "<script> alert('Erro na conclusão do projeto!'); "
        . "window.location='../../pages/projetoCandidato/infoProjetosCandidatos.php';</script>";
    }
}

function alterarEditalOrcamento($id, $nome, $dataPublicacao, $dataTermino, $valTotal, $valMin, $valMax, $cotaAluno, $cotaProf, $cotaServ)
{

    if (($cotaAluno + $cotaProf + $cotaServ) != 1)
    {
        echo "<script> alert('Erro no cadastro das cotas do Edital de Orçamento!');"
        . " window.location='cadastrarEditalCota.php';</script>";
    } else
    {
        // Pega QTD de usuários
        $SQL = mysql_query("SELECT COUNT(*) FROM usuario WHERE tipo = 'Financiador Academico'");
        $qtdAluno = mysql_result($SQL, 0);
        $SQL = mysql_query("SELECT COUNT(*) FROM usuario WHERE tipo = 'Gestor de Projetos'");
        $qtdProfessor = mysql_fetch_array($SQL);
        $SQL = mysql_query("SELECT COUNT(*) FROM usuario WHERE tipo = 'Financiador Academico'");
        $qtdServ = mysql_fetch_array($SQL);

        // Realiza contas
        $valTotalAluno = $valTotal * $cotaAluno;
        $valTotalProfessor = $valTotal * $cotaProf;
        $valTotalServ = $valTotal * $cotaServ;

        if ($qtdAluno[0] != 0)
            $valIndAluno = $valTotalAluno / $qtdAluno[0];
        else
            $valIndAluno = 0;

        if ($qtdProfessor[0] != 0)
            $valIndProfessor = $valTotalProfessor / $qtdProfessor[0];
        else
            $valIndAluno = 0;

        if ($qtdServ[0] != 0)
            $valIndServ = $valTotalServ / $qtdServ[0];
        else
            $valIndAluno = 0;

        // ATUALIZAR FUNÇÃO
        $res = "UPDATE editalorcamento SET nome = '" . $nome . "', dataPublicacao = '" . $dataPublicacao . "', dataTermino = '" . $dataTermino . "', "
                . "valTotal = '" . $valTotal . "', valMin = '" . $valMin . "', valMax = '" . $valMax . "', cotaAluno = '" . $cotaAluno . "', "
                . "cotaProfessor = '" . $cotaProf . "', cotaServ = '" . $cotaServ . "', qtdAluno = '" . $qtdAluno[0] . "', qtdProfessor = '" . $qtdProfessor[0] . "', "
                . "qtdServ = '" . $qtdServ[0] . "', valTotalAluno = '" . $valTotalAluno . "', "
                . "valTotalProfessor = '" . $valTotalProfessor . "', valTotalServ = '" . $valTotalServ . "', "
                . "valIndAluno = '" . $valIndAluno . "', valIndProfessor = '" . $valIndProfessor . "', valIndServ = '" . $valIndServ . "' WHERE id = '" . $id . "'";

        if (mysql_query($res))
        {
            echo "<script> confirm('Edital de Orçamento atualizado com sucesso!'); "
            . "window.location='../editalOrcamento/infoEditalOrcamento.php';</script>";
        } else
        {
            echo "<script> alert('Erro na atualização do Edital de Orçamento!');"
            . " window.location='../editalOrcamento/infoEditalOrcamento.php';</script>";
        }
    }
}

/* ----------------------------------------------------------------------
 *                    FUNÇÕES DE CONSULTA
 * ---------------------------------------------------------------------- */

function consultaEditalOrcamento()
{
    RETURN mysql_query("SELECT * FROM editalorcamento ORDER BY nome");
}

function consultaQtdApoiadores($id)
{
    RETURN mysql_query("SELECT COUNT(*) FROM doacoes WHERE idProjeto = '" . $id . "'");
}

function consultaCotaFinanciameno()
{
    RETURN mysql_query("SELECT * FROM editalorcamento");
}

function consultaCotaFinanciamenoPorId($id)
{
    RETURN mysql_query("SELECT * FROM editalorcamento WHERE id = $id");
}

function consultaCriterios()
{
    RETURN mysql_query("SELECT * FROM criterios");
}

function consultaCriterioPorId($id)
{
    RETURN mysql_query("SELECT * FROM criterios WHERE id = '" . $id . "'");
}

function consultaCriterioPorCategoria($categoria)
{
    RETURN mysql_query("SELECT * FROM criterios WHERE categoria = '" . $categoria . "' AND status = 'ativado'");
}

function consultaProjeto($status)
{
    RETURN mysql_query("SELECT * FROM projeto WHERE status = '" . $status . "' ORDER BY dataInicio DESC LIMIT 4");
}

function consultaTodosProjetos($status)
{
    RETURN mysql_query("SELECT * FROM projeto WHERE status = '" . $status . "'");
}

function consultaProjetosPorCategoria($categoria)
{
    RETURN mysql_query("SELECT * FROM projeto WHERE status = 'aprovado' and categoria = '" . $categoria . "'");
}

function consultaProjetoPorCategoria($cpf)
{
    $query = consultaUsuarioPorCPF($cpf);
    $dados = mysql_fetch_array($query);
    RETURN mysql_query("SELECT * FROM projeto WHERE categoria = '" . $dados['categoria'] . "'");
}

function consultaProjetoPorId($id)
{
    RETURN mysql_query("SELECT * FROM projeto WHERE id = '" . $id . "'");
}

function consultaProjetoPorAutor($autor)
{
    RETURN mysql_query(("SELECT * FROM projeto WHERE autor = '" . $autor . "'"));
}

function procuraDoacaoPorCPF($cpf)
{
    RETURN mysql_query("SELECT * FROM doacoes WHERE idUsr = '" . $cpf . "'");
}

function procuraAutor($autor)
{
    RETURN mysql_query("SELECT * FROM usuario WHERE cpf = '" . $autor . "'");
}

function consultaDoacaoPorIdProjeto($id)
{
    RETURN mysql_query("SELECT * FROM doacoes WHERE idProjeto = '" . $id . "'");
}

function traduzTipoAutor($tipo)
{
    if ($tipo == 'gestorProjeto')
        RETURN "Gestor de Projetos";
    else if ($tipo == 'aluno')
        RETURN "Aluno";
    else if ($tipo == 'tecnico')
        RETURN "Técnico Administrativo";
}

function consultaUsuario()
{
    RETURN mysql_query("SELECT * FROM usuario ORDER BY nome");
}

function consultaUsuarioPorCPF($cpf)
{
    RETURN mysql_query("SELECT * FROM usuario WHERE cpf = '$cpf'");
}

function procuraProjetoAtivodeAtor($cpf)
{
    $query = mysql_query("SELECT * FROM projeto WHERE autor = '" . $cpf . "' AND status <> 'concluido'");
    if (mysql_fetch_array($query))
        return 0;
    else
        return 1;
}

function consultaAvaliacaoPorId($id)
{
    RETURN mysql_query("SELECT * FROM avaliacao WHERE idProjeto = '$id'");
}

function consultaRepassePorIdProjeto($idProjeto)
{
    RETURN mysql_query("SELECT * FROM repassefinanceiro WHERE idProjeto = '$idProjeto'");
}

function consultaRecompensaPorIdProjeto($idProjeto)
{
    RETURN mysql_query("SELECT * FROM recompensa WHERE idProjeto = '$idProjeto'");
}

function consultaRepassePorId($id)
{
    RETURN mysql_query("SELECT * FROM repassefinanceiro WHERE id = '$id'");
}

/* ----------------------------------------------------------------------
 *                            AVALIAR PROJETO
 * ---------------------------------------------------------------------- */

function avaliarProjetoCandidato($idProj, $cpfAvaliador, $criterios, $notaFinal, $descricao)
{
    if ((int) $notaFinal >= 6)
    {
        $query = consultaProjetoPorId($idProj);
        $dados = mysql_fetch_array($query);
        date_default_timezone_set('America/Sao_Paulo');
        $dataInicio = date('Y-m-d');
        $duracao = $dados['duracao'];
        $dataFim = new DateTime($dataInicio);
        $dataFim->add(new DateInterval('P' . $duracao . 'D'));
        $dataFinal = $dataFim->format('Y-m-d');

        $sqlProjeto = "UPDATE projeto SET status='aprovado', dataFim='$dataFinal' WHERE id='$idProj'";
    } else if ((int) $notaFinal < 6)
    {
        $sqlProjeto = "UPDATE projeto SET status='reprovado' WHERE id='$idProj'";
    }

    $sqlAvaliacao = "INSERT INTO avaliacao (idProjeto, cpfAval, criterios, notaFinal, descricao) "
            . "VALUES ('$idProj', '$cpfAvaliador', '$criterios', '$notaFinal', '$descricao')";

    if (mysql_query($sqlProjeto) && mysql_query($sqlAvaliacao))
    {
        echo "<script> confirm('Projeto Avaliado Com Sucesso!'); "
        . "window.location='../../pages/projetoCandidato/infoProjetosCandidatos.php';</script>";
    } else
    {
        echo "<script> alert('Erro na avaliaçao!'); "
        . "window.location='../../pages/projetoCandidato/avaliarProjetoCandidato.php';</script>";
    }
}

function requisitarRevisao($id)
{
    $res = "UPDATE projeto SET status = 'revisar' WHERE id = '$id'";

    if (mysql_query($res))
    {
        echo "<script> confirm('Revisão Requisitada com sucesso!'); "
        . "window.location='../../pages/projetoCandidato/infoProjetosCandidatos.php';</script>";
    } else
    {
        echo "<script> alert('Erro na requisição!'); "
        . "window.location='../../pages/projetoCandidato/infoProjetosCandidatos.php';</script>";
    }
}

function revisarProjetoCandidato($id, $notaFinal, $descricao)
{
    if ((int) $notaFinal >= 6)
    {
        $query = consultaProjetoPorId($id);
        $dados = mysql_fetch_array($query);

        $sqlProjeto = "UPDATE projeto SET status='aprovado' WHERE id='$id'";
    } else if ((int) $notaFinal < 6)
    {
        $sqlProjeto = "UPDATE projeto SET status='reprovado' WHERE id='$id'";
    }

    $sqlAvaliacao = "UPDATE avaliacao SET notaFinal = '$notaFinal', descricao = '$descricao' "
            . "WHERE idProjeto = '$id'";

    if (mysql_query($sqlProjeto) && mysql_query($sqlAvaliacao))
    {
        echo "<script> confirm('Revisão Confirmada com sucesso!'); "
        . "window.location='../../pages/projetoCandidato/infoProjetosCandidatos.php';</script>";
    } else
    {
        echo "<script> alert('Erro na revisão!'); "
        . "window.location='../../pages/projetoCandidato/infoProjetosCandidatos.php';</script>";
    }
}

/* ----------------------------------------------------------------------
 *                                 EXCLUSÕES
 * ---------------------------------------------------------------------- */

function excluirProjetoCandidato($id)
{
    $res = "DELETE FROM projeto WHERE id = '" . $id . "'";

    if (mysql_query($res))
    {
        echo "<script> alert('Projeto Excluido com sucesso!'); "
        . "window.location='../../pages/projetoCandidato/infoProjetosCandidatos.php';</script>";
    } else
    {
        echo "<script> alert('Erro na exclusão!'); "
        . "window.location='../../pages / projetoCandidato / infoProjetosCandidatos . php';</script>";
    }
}

?>
