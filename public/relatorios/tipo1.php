<?php

require_once '../../vendor/autoload.php';
require_once '../config/BancoDados.php';
require_once 'funcoes_relatorio.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;

$titulo = $_POST['titulo'];
$tipo = $_POST['relatorio'];
$id = $_POST['id'];

switch ($tipo ) {
    case 0:
        $query = "SELECT u.nome as advisor, h.* FROM usuarios u 
            JOIN historico h on u.id = h.usuario_id 
            where h.usuario_id = {$id} order by h.celular";
        break;
    
    case 'value':
        $query = "SELECT u.nome as advisor, h.* FROM usuarios u 
            JOIN historico h on u.id = h.usuario_id 
            order by h.celular";
        break;
    
    default:
        http_response_code(301);
        echo json_encode("Houve um erro, reporte o erro ao administrador da plataforma.<br><strong>Código de referência Rel.01 </strong>");
        break;
}

$banco = new BancoDados;
$conexao = $banco->conexao();
$char_set = $conexao->prepare("set names utf8");
$char_set->execute();

if(isset($query)){

    $resultado = $conexao->prepare($query);
    $resultado->execute();
    $caminho = "../file/";

    $planilha = criarCabecalhoGeral();
    
    $comecoDeInsercao=4;
    $result = $resultado->fetchAll() ;
    foreach($result as $key){
        //var_dump($result);
        $planilha->getActiveSheet()->setCellValue('a'.$comecoDeInsercao,$key['celular']);
        $planilha->getActiveSheet()->setCellValue('b'.$comecoDeInsercao,$key['advisor']);
        switch ($key['tipo_atividade']) {
            
            case 'PV':
                $atividade = $key['status_atividade'];
                $planilha = primeiraVisita($comecoDeInsercao,$key['status_atividade'],$planilha);
                break;
            
            case 'SV':
                $atividade = $key['status_atividade'];
                $planilha = segundaVisita($comecoDeInsercao,$key['status_atividade'],$planilha);
                break;
            
            case 'VR':
                $atividade = $key['status_atividade'];
                $planilha = visitaRelacionamento($comecoDeInsercao,$key['status_atividade'],$planilha);
                break;
            
            case 'LIG':
                $atividade = $key['status_atividade'];
                $planilha = ligacao($comecoDeInsercao,$key['status_atividade'],$planilha);
                break;

            default:
                break;
        }
        $planilha->getActiveSheet()->setCellValue('c'.$comecoDeInsercao,$key['criacao']);
        $planilha->getActiveSheet()->setCellValue('d'.$comecoDeInsercao,$key['alteracao']);
        $comecoDeInsercao++;
    }

    $planilha->getActiveSheet()->getStyle('A1:D'.$comecoDeInsercao)->getAlignment()->setHorizontal('center');

    foreach(range('A','D') as $columnID) {
        $planilha->getActiveSheet()->getColumnDimension($columnID)
            ->setAutoSize(true);
    }

    $escrever = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($planilha, "Xlsx");
    $escrever->save("../../storage/app/{$titulo}.xlsx"); //nome final do arquivo

    header('Content-Type: application/download');
    header('Content-Disposition: attachment; filename="file.xlsx"');
    echo json_encode(array(
        "planilha"=>"{$titulo}.xlsx"
    ));
}
?>