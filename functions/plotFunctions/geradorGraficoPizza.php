<?php
    require './phplot.php';
    require '../functionsBd.php';
    
    // $_GET["id"] -> Permite utilizar o identificador do projeto/doações para plotar o gráfico
    $queryDoacoes = consultaDoacaoPorIdProjeto($_GET['id']);
    
    $totalPublico = 0;
    $totalGestorProjeto = 0;
    $totalAcademico = 0;
    
    while($dadosDoacoes = mysql_fetch_array($queryDoacoes))
    {
        $queryAutorDoacao = procuraAutor($dadosDoacoes['idUsr']);
        $dadosAutorDoacao = mysql_fetch_array($queryAutorDoacao);
        
        if($dadosAutorDoacao['tipo'] == "Financiador Publico")
            $totalPublico += $dadosDoacoes['valor'];
        if($dadosAutorDoacao['tipo'] == "Gestor de Projetos")
            $totalGestorProjeto += $dadosDoacoes['valor'];
        if($dadosAutorDoacao['tipo'] == "Financiador Academico")
            $totalAcademico += $dadosDoacoes['valor'];
        
    }
    
    $data = array(
        array('Financiador Publico', $totalPublico),
        array('Gestor de Projetos', $totalGestorProjeto),
        array('Financiador Academico', $totalAcademico)
        );
    $plot = new PHPlot();
    $plot->SetDataType('text-data-single');
    $plot->SetDataValues($data);
    $plot->SetPlotType("pie");
    $plot->SetDataColors(array('red', 'green', 'blue'));
    $plot->SetTitle('Grafico de Doacoes por Financiador');
    
    # Build a legend from our data array.
    # Each call to SetLegend makes one line as "label: value".
    foreach ($data as $row)
      $plot->SetLegend(implode(': R$', $row));
    # Place the legend in the upper left corner:
    $plot->SetLegendPixels(0, 25);
    
    $plot->DrawGraph();
?>