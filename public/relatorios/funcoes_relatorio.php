<?php 

use PhpOffice\PhpSpreadsheet\Spreadsheet;

/**
 * 
 * @param int $celula
 * @param String $statusAtividade
 * @param Spreadsheet $planilha
 * @return Spreadsheet $planilha
 * @author Emerson 
 */
function primeiraVisita(int $celula,String $statusAtividade,Spreadsheet $planilha)
{
    /* E4   L*/ 
    switch ($statusAtividade) {
        case 'Aberto':
            $planilha->getActiveSheet()->setCellValue('e'.$celula,"1");
            return $planilha;
            break;

        case 'ANF':
            $planilha->getActiveSheet()->setCellValue('f'.$celula,"1");
            return $planilha;
            break;
        
        case 'FLW':
            $planilha->getActiveSheet()->setCellValue('g'.$celula,"1");
            return $planilha;
            break;
        
        case 'AB':
            $planilha->getActiveSheet()->setCellValue('h'.$celula,"1");
            return $planilha;
            break;
        
        case 'TED':
            $planilha->getActiveSheet()->setCellValue('i'.$celula,"1");
            return $planilha;
            break;
        
        case 'D':
            $planilha->getActiveSheet()->setCellValue('j'.$celula,"1");
            return $planilha;
            break;
        
        case 'X':
            $planilha->getActiveSheet()->setCellValue('k'.$celula,"1");
            break;

        case 'OK':
            $planilha->getActiveSheet()->setCellValue('l'.$celula,"1");
            break;
        default:
            echo "ERRO";
            break;
    }
}


/**
 * 
 * @param int $celula
 * @param String $statusAtividade
 * @param Spreadsheet $planilha
 * @return Spreadsheet $planilha
 * @author Emerson 
 */
function segundaVisita(int $celula,String $statusAtividade,Spreadsheet $planilha)
{
    /* M4   T*/ 
    switch ($statusAtividade) {
        case 'Aberto':
            $planilha->getActiveSheet()->setCellValue('m'.$celula,"1");
            return $planilha;
            break;

        case 'ANF':
            $planilha->getActiveSheet()->setCellValue('n'.$celula,"1");
            return $planilha;
            break;
        
        case 'FLW':
            $planilha->getActiveSheet()->setCellValue('o'.$celula,"1");
            return $planilha;
            break;
        
        case 'AB':
            $planilha->getActiveSheet()->setCellValue('p'.$celula,"1");
            return $planilha;
            break;
        
        case 'TED':
            $planilha->getActiveSheet()->setCellValue('q'.$celula,"1");
            return $planilha;
            break;
        
        case 'D':
            $planilha->getActiveSheet()->setCellValue('r'.$celula,"1");
            return $planilha;
            break;
        
        case 'X':
            $planilha->getActiveSheet()->setCellValue('s'.$celula,"1");
            break;

        case 'OK':
            $planilha->getActiveSheet()->setCellValue('t'.$celula,"1");
            break;
        default:
            echo "ERRO";
            break;
    }
}


/**
 * 
 * @param int $celula
 * @param String $statusAtividade
 * @param Spreadsheet $planilha
 * @return Spreadsheet $planilha
 * @author Emerson 
 */
function visitaRelacionamento(int $celula,String $statusAtividade,Spreadsheet $planilha)
{
    /* M4   T*/ 
    switch ($statusAtividade) {
        case 'Aberto':
            $planilha->getActiveSheet()->setCellValue('u'.$celula,"1");
            return $planilha;
            break;
        
        case 'D':
            $planilha->getActiveSheet()->setCellValue('v'.$celula,"1");
            return $planilha;
            break;

        case 'OK':
            $planilha->getActiveSheet()->setCellValue('w'.$celula,"1");
            break;
        default:
            echo "ERRO";
            break;
    }
}

function ligacao(int $celula,String $statusAtividade,Spreadsheet $planilha)
{
    /* M4   T*/ 
    switch ($statusAtividade) {
        case 'Aberto':
            $planilha->getActiveSheet()->setCellValue('x'.$celula,"1");
            return $planilha;
            break;
        
        case 'D':
            $planilha->getActiveSheet()->setCellValue('y'.$celula,"1");
            return $planilha;
            break;

        case 'OK':
            $planilha->getActiveSheet()->setCellValue('z'.$celula,"1");
            break;
        default:
            echo "ERRO";
            break;
    }
}

/* ANF = 002060     ABERTO = 548235   FLW=FFC000    AB=548235   D=D9D9D9 TED=0070C0    X=A88B7B     OK=A88B7B  */ 

/**
 * Colorir subcabeçalho
 * @param Spreadsheet $planilha
 * @return Spreadsheet $planilha
 * @author Emerson 
 */
function coloracaoSubCabecalho(Spreadsheet $planilha){
    
    $planilha->getActiveSheet()->getStyle('E3')->getFill()->setFillType("solid")->getStartColor()->setARGB('548235');
    $planilha->getActiveSheet()->getStyle('F3')->getFill()->setFillType("solid")->getStartColor()->setARGB('002060');
    $planilha->getActiveSheet()->getStyle('G3')->getFill()->setFillType("solid")->getStartColor()->setARGB('FFC000');
    $planilha->getActiveSheet()->getStyle('H3')->getFill()->setFillType("solid")->getStartColor()->setARGB('548235');
    $planilha->getActiveSheet()->getStyle('I3')->getFill()->setFillType("solid")->getStartColor()->setARGB('0070C0');
    $planilha->getActiveSheet()->getStyle('J3')->getFill()->setFillType("solid")->getStartColor()->setARGB('D9D9D9');
    $planilha->getActiveSheet()->getStyle('K3')->getFill()->setFillType("solid")->getStartColor()->setARGB('A88B7B');
    $planilha->getActiveSheet()->getStyle('L3')->getFill()->setFillType("solid")->getStartColor()->setARGB('A88B7B');
    
    $planilha->getActiveSheet()->getStyle('M3')->getFill()->setFillType("solid")->getStartColor()->setARGB('548235');
    $planilha->getActiveSheet()->getStyle('N3')->getFill()->setFillType("solid")->getStartColor()->setARGB('002060');
    $planilha->getActiveSheet()->getStyle('O3')->getFill()->setFillType("solid")->getStartColor()->setARGB('FFC000');
    $planilha->getActiveSheet()->getStyle('P3')->getFill()->setFillType("solid")->getStartColor()->setARGB('548235');
    $planilha->getActiveSheet()->getStyle('Q3')->getFill()->setFillType("solid")->getStartColor()->setARGB('0070C0');
    $planilha->getActiveSheet()->getStyle('R3')->getFill()->setFillType("solid")->getStartColor()->setARGB('D9D9D9');
    $planilha->getActiveSheet()->getStyle('S3')->getFill()->setFillType("solid")->getStartColor()->setARGB('A88B7B');
    $planilha->getActiveSheet()->getStyle('T3')->getFill()->setFillType("solid")->getStartColor()->setARGB('A88B7B');

    $planilha->getActiveSheet()->getStyle('U3')->getFill()->setFillType("solid")->getStartColor()->setARGB('548235');
    $planilha->getActiveSheet()->getStyle('V3')->getFill()->setFillType("solid")->getStartColor()->setARGB('D9D9D9');
    $planilha->getActiveSheet()->getStyle('W3')->getFill()->setFillType("solid")->getStartColor()->setARGB('A88B7B');

    
    $planilha->getActiveSheet()->getStyle('X3')->getFill()->setFillType("solid")->getStartColor()->setARGB('548235');
    $planilha->getActiveSheet()->getStyle('Y3')->getFill()->setFillType("solid")->getStartColor()->setARGB('D9D9D9');
    $planilha->getActiveSheet()->getStyle('Z3')->getFill()->setFillType("solid")->getStartColor()->setARGB('A88B7B');

    return $planilha;
}

?>