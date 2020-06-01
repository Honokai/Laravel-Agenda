<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\This;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Relatorio extends Model
{

    /**
     * Preenche os locais de acordo com o status da atividade
     * @param int $celula
     * @param String $statusAtividade
     * @param Spreadsheet $planilha
     * @return Spreadsheet $planilha
     * @author Emerson 
     */
    public function  scopePrimeiraVisita(int $celula,String $statusAtividade,Spreadsheet $planilha)
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
                return $planilha;
                break;

            case 'OK':
                $planilha->getActiveSheet()->setCellValue('l'.$celula,"1");
                return $planilha;
                break;
            default:
                echo "ERRO";
                break;
        }
    }


    /**
     * Preenche os locais de acordo com o status da atividade
     * @param int $celula
     * @param String $statusAtividade
     * @param Spreadsheet $planilha
     * @return Spreadsheet $planilha
     * @author Emerson 
     */
    public function  scopeSegundaVisita(int $celula,String $statusAtividade,Spreadsheet $planilha)
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
                return $planilha;
                break;

            case 'OK':
                $planilha->getActiveSheet()->setCellValue('t'.$celula,"1");
                return $planilha;
                break;
            default:
                echo "ERRO";
                break;
        }
    }


    /**
     * Preenche os locais de acordo com o status da atividade
     * @param int $celula
     * @param string $statusAtividade
     * @param Spreadsheet $planilha
     * @return Spreadsheet $planilha
     * @author Emerson 
     */
    public function  scopeVisitaRelacionamento(int $celula,String $statusAtividade,Spreadsheet $planilha)
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
                return $planilha;
                break;

            default:
                return $planilha;
                break;
        }
    }

    /**
     * Preenche os locais de acordo com o status da atividade
     * @param int $celula
     * @param string $statusAtividade
     * @param Spreadsheet $planilha
     * @return Spreadsheet
     */
    public function  scopeLigacao(int $celula,String $statusAtividade,Spreadsheet $planilha)
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
                return $planilha;
                break;
            default:
                return $planilha;
                break;
        }
    }

    /* ANF = 002060     ABERTO = 548235   FLW=FFC000    AB=548235   D=D9D9D9 TED=0070C0    X=A88B7B     OK=A88B7B  */ 

    /**
     * Colorir subcabeçalho do relatorio GERAL
     * @param Spreadsheet $planilha
     * @return Spreadsheet $planilha
     * @author Emerson 
     */
    public function  scopeColoracaoSubCabecalho(Spreadsheet $planilha){
        
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

/**
     * Criar o cabeçalho da planilha quando o relatorio solicitado é o geral
     * 
     * @author Emerson
     * @return Spreadsheet
     */
    public static function criarCabecalhoGeral(){
        $relatorio = new Relatorio;
        $planilha = new Spreadsheet();
        $planilha = $relatorio->scopeColoracaoSubCabecalho($planilha);


        /*    alinhamento    */
        $planilha->getActiveSheet()->getStyle('a2:z2')->getAlignment()->setHorizontal('center');  
        $planilha->getActiveSheet()->getStyle('a1:z1')->getAlignment()->setHorizontal('center');
        $planilha->getActiveSheet()->getStyle('a3:z3')->getAlignment()->setHorizontal('center');
        /*  fim alinhamento */

        $planilha->getActiveSheet()->setTitle("Relatorio geral"); //nome da aba
        $planilha->getActiveSheet()->mergeCells('e1:l1')->setCellValue('e1',"PRIMEIRA VISITA");
        $planilha->getActiveSheet()->getStyle('E1')->getFill()->setFillType("solid")->getStartColor()->setARGB('000E2A'); //muda cor do preenchimento
        $planilha->getActiveSheet()->getStyle('e1')->getFont()->getColor()->setARGB('FFFFFF'); //muda cor da fonte
        $planilha->getActiveSheet()->getStyle('e1')->applyFromArray(['font' => ['bold' => true,],]); //muda estilo da fonte
        $planilha->getActiveSheet()->mergeCells('f2:l2')->setCellValue('f2',"FECHADO"); //mescla células

        $planilha->getActiveSheet()->getStyle('a3:z3')->applyFromArray(['font' => ['bold' => true,],]); //muda estilo da fonte
        $planilha->getActiveSheet()->getStyle('e2:t2')->applyFromArray(['font' => ['bold' => true,],]); //muda estilo da fonte

        $planilha->getActiveSheet()->setCellValue('e2',"ABERTO");
        $planilha->getActiveSheet()->setCellValue('a3',"CELULAR");
        $planilha->getActiveSheet()->setCellValue('b3',"ADVISOR");
        $planilha->getActiveSheet()->setCellValue('c3',"DATA DE REGISTRO");
        $planilha->getActiveSheet()->setCellValue('d3',"DATA DE ALTERAÇÃO");
        $planilha->getActiveSheet()->setCellValue('e3',"ABERTO");
        $planilha->getActiveSheet()->setCellValue('f3',"ANF");
        $planilha->getActiveSheet()->setCellValue('g3',"FLW");
        $planilha->getActiveSheet()->setCellValue('h3',"AB");
        $planilha->getActiveSheet()->setCellValue('i3',"TED");
        $planilha->getActiveSheet()->setCellValue('j3',"D");
        $planilha->getActiveSheet()->setCellValue('k3',"X");
        $planilha->getActiveSheet()->setCellValue('l3',"OK");

        $planilha->getActiveSheet()->mergeCells('M1:T1')->setCellValue('M1',"SEGUNDA VISITA");
        $planilha->getActiveSheet()->getStyle('m1')->getFill()->setFillType("solid")->getStartColor()->setARGB('600000');
        $planilha->getActiveSheet()->getStyle('m1')->applyFromArray(['font' => ['bold' => true,],]); //muda estilo da fonte para negrito
        $planilha->getActiveSheet()->getStyle('m1')->getFont()->getColor()->setARGB('FFFFFF'); //muda cor da fonte
        $planilha->getActiveSheet()->mergeCells('N2:T2')->setCellValue('N2',"FECHADO");
        
        

        $planilha->getActiveSheet()->setCellValue('M2',"ABERTO");
        $planilha->getActiveSheet()->setCellValue('M3',"ABERTO");
        $planilha->getActiveSheet()->setCellValue('N3',"ANF");
        $planilha->getActiveSheet()->setCellValue('O3',"FLW");
        $planilha->getActiveSheet()->setCellValue('P3',"AB");
        $planilha->getActiveSheet()->setCellValue('Q3',"TED");
        $planilha->getActiveSheet()->setCellValue('R3',"D");
        $planilha->getActiveSheet()->setCellValue('S3',"X");
        $planilha->getActiveSheet()->setCellValue('T3',"OK");



        $planilha->getActiveSheet()->mergeCells('u1:w1')->setCellValue('u1',"VISITA DE RELACIONAMENTO - VR")
        ->getStyle('u1')->getFill()->setFillType("solid")->getStartColor()->setARGB('A6A6A6');
        $planilha->getActiveSheet()->getStyle('u1:w1')->applyFromArray(['font' => ['bold'=>true,],]);

        $planilha->getActiveSheet()->mergeCells('u2:w2')->getStyle('u2')
        ->getFill()->setFillType("solid")->getStartColor()->setARGB('A6A6A6');

        $planilha->getActiveSheet()->setCellValue('u3',"ABERTO");
        $planilha->getActiveSheet()->setCellValue('v3',"D");
        $planilha->getActiveSheet()->setCellValue('w3',"OK");

        $planilha->getActiveSheet()->mergeCells('x1:z1')->setCellValue('x1',"LIGAÇÃO - LIG")
        ->getStyle('x1')->getFill()->setFillType("solid")->getStartColor()->setARGB('A6A6A6');
        $planilha->getActiveSheet()->getStyle('x1:z1')->applyFromArray(['font' => ['bold'=>true,],]);

        $planilha->getActiveSheet()->mergeCells('x2:z2')->getStyle('x2')
        ->getFill()->setFillType("solid")->getStartColor()->setARGB('A6A6A6');

        $planilha->getActiveSheet()->setCellValue('x3',"ABERTO");
        $planilha->getActiveSheet()->setCellValue('y3',"D");
        $planilha->getActiveSheet()->setCellValue('z3',"OK");



        return $planilha;
}
    

}

