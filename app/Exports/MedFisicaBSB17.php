<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use App\Models\PrestaKine;

class MedFisicaBSB17 implements FromView, WithColumnWidths
{
    use Exportable;

    public function __construct(string $fin, $fter)
    {
        $this->fin = $fin;
        $this->fter = $fter;
    }

    public function columnWidths(): array
    {
        return [
            'B' => 60,
            'C' => 18,
            'D' => 18,
            'E' => 18,
            'F' => 18,
            'G' => 18,
            'H' => 18,
            'I' => 18,
            'J' => 18,
        ];
    }

    public function view(): View
    {
        $datos = PrestaKine::with('paciente')->whereBetween('fecha_ingreso', [$this->fin, $this->fter])->whereNotIn('servicio', [27])->get(); 

        $data = array();

        $d0306082 = $datos->filter(function ($dato) {
            return $dato->prestacion === 125;
        }); 

        $data['0306082']['mai'] = $d0306082->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "F";
        })->count();

        $data['0306082']['mle'] = $d0306082->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "C";
        })->count();

        $data['0306082']['no beneficiarios'] = $d0306082->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "I" || trim($item->paciente->PAC_PAC_Prevision) === "P" ;
        })->count();

        $data['0306082']['total'] = $d0306082->count();

        $data['0306082']['cerrado'] = $d0306082->filter(function ($item){
            return $item->servicios->id_ambito === 2;
        })->count();

        $data['0306082']['abierto'] = $d0306082->filter(function ($item){
            return $item->servicios->id_ambito === 1;
        })->count();

        $data['0306082']['emergencia'] = $d0306082->filter(function ($item){
            return $item->servicios->id_ambito === 3;
        })->count();



        $d0601101 = $datos->filter(function ($dato) {
            return $dato->prestacion === 1 ||  $dato->prestacion === 2;
        }); // 221

        $data['0601101']['mai'] = $d0601101->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "F";
        })->count();

        $data['0601101']['mle'] = $d0601101->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "C";
        })->count();

        $data['0601101']['no beneficiarios'] = $d0601101->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "I" || trim($item->paciente->PAC_PAC_Prevision) === "P" ;
        })->count();

        $data['0601101']['total'] = $d0601101->count();

        $data['0601101']['cerrado'] = $d0601101->filter(function ($item){
            return $item->servicios->id_ambito === 2;
        })->count();

        $data['0601101']['abierto'] = $d0601101->filter(function ($item){
            return $item->servicios->id_ambito === 1;
        })->count();

        $data['0601101']['emergencia'] = $d0601101->filter(function ($item){
            return $item->servicios->id_ambito === 3;
        })->count();



        $d0601103 = $datos->filter(function ($dato) {
            return ($dato->prestacion) === 142 && ($dato->servicio === 30 || $dato->servicio === 31 || $dato->servicio === 32 || $dato->servicio === 52 || $dato->servicio === 35);
        }); // hospitalizados 93

        $data['0601103']['mai'] = $d0601103->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "F";
        })->count();

        $data['0601103']['mle'] = $d0601103->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "C";
        })->count();

        $data['0601103']['no beneficiarios'] = $d0601103->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "I" || trim($item->paciente->PAC_PAC_Prevision) === "P" ;
        })->count();

        $data['0601103']['total'] = $d0601103->count();

        $data['0601103']['cerrado'] = $d0601103->filter(function ($item){
            return $item->servicios->id_ambito === 2;
        })->count();

        $data['0601103']['abierto'] = $d0601103->filter(function ($item){
            return $item->servicios->id_ambito === 1;
        })->count();

        $data['0601103']['emergencia'] = $d0601103->filter(function ($item){
            return $item->servicios->id_ambito === 3;
        })->count();



        $d0601104 = $datos->filter(function ($dato) {
            return $dato->prestacion === 142 && ($dato->servicio === 49 || $dato->servicio === 51 || $dato->servicio === 50 || $dato->servicio === 56 || $dato->servicio === 58 || $dato->servicio === 59);
        }); // upca 82

        $data['0601104']['mai'] = $d0601104->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "F";
        })->count();

        $data['0601104']['mle'] = $d0601104->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "C";
        })->count();

        $data['0601104']['no beneficiarios'] = $d0601104->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "I" || trim($item->paciente->PAC_PAC_Prevision) === "P" ;
        })->count();

        $data['0601104']['total'] = $d0601104->count();

        $data['0601104']['cerrado'] = $d0601104->filter(function ($item){
            return $item->servicios->id_ambito === 2;
        })->count();

        $data['0601104']['abierto'] = $d0601104->filter(function ($item){
            return $item->servicios->id_ambito === 1;
        })->count();

        $data['0601104']['emergencia'] = $d0601104->filter(function ($item){
            return $item->servicios->id_ambito === 3;
        })->count();



        $d0601105 = $datos->filter(function ($dato) {
            return $dato->prestacion === 142 && $dato->servicio === 43;
        }); // ambulatorio 158

        $data['0601105']['mai'] = $d0601105->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "F";
        })->count();

        $data['0601105']['mle'] = $d0601105->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "C";
        })->count();

        $data['0601105']['no beneficiarios'] = $d0601105->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "I" || trim($item->paciente->PAC_PAC_Prevision) === "P" ;
        })->count();

        $data['0601105']['total'] = $d0601105->count();

        $data['0601105']['cerrado'] = $d0601105->filter(function ($item){
            return $item->servicios->id_ambito === 2;
        })->count();

        $data['0601105']['abierto'] = $d0601105->filter(function ($item){
            return $item->servicios->id_ambito === 1;
        })->count();

        $data['0601105']['emergencia'] = $d0601105->filter(function ($item){
            return $item->servicios->id_ambito === 3;
        })->count();



        $d0602001 = $datos->filter(function ($dato) {
            return $dato->prestacion === 52 || $dato->prestacion === 53 || $dato->prestacion === 144;
        }); // 65

        $data['0602001']['mai'] = $d0602001->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "F";
        })->count();

        $data['0602001']['mle'] = $d0602001->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "C";
        })->count();

        $data['0602001']['no beneficiarios'] = $d0602001->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "I" || trim($item->paciente->PAC_PAC_Prevision) === "P" ;
        })->count();

        $data['0602001']['total'] = $d0602001->count();

        $data['0602001']['cerrado'] = $d0602001->filter(function ($item){
            return $item->servicios->id_ambito === 2;
        })->count();

        $data['0602001']['abierto'] = $d0602001->filter(function ($item){
            return $item->servicios->id_ambito === 1;
        })->count();

        $data['0602001']['emergencia'] = $d0602001->filter(function ($item){
            return $item->servicios->id_ambito === 3;
        })->count();



        $d0602002 = $datos->filter(function ($dato) {
            return $dato->prestacion === 61 || $dato->prestacion === 51 || $dato->prestacion === 146;
        }); // 4

        $data['0602002']['mai'] = $d0602002->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "F";
        })->count();

        $data['0602002']['mle'] = $d0602002->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "C";
        })->count();

        $data['0602002']['no beneficiarios'] = $d0602002->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "I" || trim($item->paciente->PAC_PAC_Prevision) === "P" ;
        })->count();

        $data['0602002']['total'] = $d0602002->count();

        $data['0602002']['cerrado'] = $d0602002->filter(function ($item){
            return $item->servicios->id_ambito === 2;
        })->count();

        $data['0602002']['abierto'] = $d0602002->filter(function ($item){
            return $item->servicios->id_ambito === 1;
        })->count();

        $data['0602002']['emergencia'] = $d0602002->filter(function ($item){
            return $item->servicios->id_ambito === 3;
        })->count();



        $d0602003 = $datos->filter(function ($dato) {
            return $dato->prestacion === 62;
        });

        $data['0602003']['mai'] = $d0602003->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "F";
        })->count();

        $data['0602003']['mle'] = $d0602003->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "C";
        })->count();

        $data['0602003']['no beneficiarios'] = $d0602003->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "I" || trim($item->paciente->PAC_PAC_Prevision) === "P" ;
        })->count();

        $data['0602003']['total'] = $d0602003->count();

        $data['0602003']['cerrado'] = $d0602003->filter(function ($item){
            return $item->servicios->id_ambito === 2;
        })->count();

        $data['0602003']['abierto'] = $d0602003->filter(function ($item){
            return $item->servicios->id_ambito === 1;
        })->count();

        $data['0602003']['emergencia'] = $d0602003->filter(function ($item){
            return $item->servicios->id_ambito === 3;
        })->count();



        $d0601001 = $datos->filter(function ($dato) {
            return $dato->prestacion === 61 || $dato->prestacion === 51;
        });

        $data['0601001']['mai'] = $d0601001->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "F";
        })->count();

        $data['0601001']['mle'] = $d0601001->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "C";
        })->count();

        $data['0601001']['no beneficiarios'] = $d0601001->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "I" || trim($item->paciente->PAC_PAC_Prevision) === "P" ;
        })->count();

        $data['0601001']['total'] = $d0601001->count();

        $data['0601001']['cerrado'] = $d0601001->filter(function ($item){
            return $item->servicios->id_ambito === 2;
        })->count();

        $data['0601001']['abierto'] = $d0601001->filter(function ($item){
            return $item->servicios->id_ambito === 1;
        })->count();

        $data['0601001']['emergencia'] = $d0601001->filter(function ($item){
            return $item->servicios->id_ambito === 3;
        })->count();



        $d0601005 = $datos->filter(function ($dato) {
            return $dato->prestacion === 38;
        }); // 8

        $data['0601005']['mai'] = $d0601005->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "F";
        })->count();

        $data['0601005']['mle'] = $d0601005->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "C";
        })->count();

        $data['0601005']['no beneficiarios'] = $d0601005->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "I" || trim($item->paciente->PAC_PAC_Prevision) === "P" ;
        })->count();

        $data['0601005']['total'] = $d0601005->count();

        $data['0601005']['cerrado'] = $d0601005->filter(function ($item){
            return $item->servicios->id_ambito === 2;
        })->count();

        $data['0601005']['abierto'] = $d0601005->filter(function ($item){
            return $item->servicios->id_ambito === 1;
        })->count();

        $data['0601005']['emergencia'] = $d0601005->filter(function ($item){
            return $item->servicios->id_ambito === 3;
        })->count();



        $d0601007 = $datos->filter(function ($dato) {
            return $dato->prestacion === 39;
        });

        $data['0601007']['mai'] = $d0601007->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "F";
        })->count();

        $data['0601007']['mle'] = $d0601007->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "C";
        })->count();

        $data['0601007']['no beneficiarios'] = $d0601007->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "I" || trim($item->paciente->PAC_PAC_Prevision) === "P" ;
        })->count();

        $data['0601007']['total'] = $d0601007->count();

        $data['0601007']['cerrado'] = $d0601007->filter(function ($item){
            return $item->servicios->id_ambito === 2;
        })->count();

        $data['0601007']['abierto'] = $d0601007->filter(function ($item){
            return $item->servicios->id_ambito === 1;
        })->count();

        $data['0601007']['emergencia'] = $d0601007->filter(function ($item){
            return $item->servicios->id_ambito === 3;
        })->count();



        $d0601008 = $datos->filter(function ($dato) {
            return $dato->prestacion === 40;
        });

        $data['0601008']['mai'] = $d0601008->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "F";
        })->count();

        $data['0601008']['mle'] = $d0601008->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "C";
        })->count();

        $data['0601008']['no beneficiarios'] = $d0601008->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "I" || trim($item->paciente->PAC_PAC_Prevision) === "P" ;
        })->count();

        $data['0601008']['total'] = $d0601008->count();

        $data['0601008']['cerrado'] = $d0601008->filter(function ($item){
            return $item->servicios->id_ambito === 2;
        })->count();

        $data['0601008']['abierto'] = $d0601008->filter(function ($item){
            return $item->servicios->id_ambito === 1;
        })->count();

        $data['0601008']['emergencia'] = $d0601008->filter(function ($item){
            return $item->servicios->id_ambito === 3;
        })->count();



        $d0601009 = $datos->filter(function ($dato) {
            return $dato->prestacion === 41;
        });

        $data['0601009']['mai'] = $d0601009->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "F";
        })->count();

        $data['0601009']['mle'] = $d0601009->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "C";
        })->count();

        $data['0601009']['no beneficiarios'] = $d0601009->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "I" || trim($item->paciente->PAC_PAC_Prevision) === "P" ;
        })->count();

        $data['0601009']['total'] = $d0601009->count();

        $data['0601009']['cerrado'] = $d0601009->filter(function ($item){
            return $item->servicios->id_ambito === 2;
        })->count();

        $data['0601009']['abierto'] = $d0601009->filter(function ($item){
            return $item->servicios->id_ambito === 1;
        })->count();

        $data['0601009']['emergencia'] = $d0601009->filter(function ($item){
            return $item->servicios->id_ambito === 3;
        })->count();



        $d0601011 = $datos->filter(function ($dato) {
            return $dato->prestacion === 42 || $dato->prestacion === 113;
        });

        $data['0601011']['mai'] = $d0601011->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "F";
        })->count();

        $data['0601011']['mle'] = $d0601011->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "C";
        })->count();

        $data['0601011']['no beneficiarios'] = $d0601011->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "I" || trim($item->paciente->PAC_PAC_Prevision) === "P" ;
        })->count();

        $data['0601011']['total'] = $d0601011->count();

        $data['0601011']['cerrado'] = $d0601011->filter(function ($item){
            return $item->servicios->id_ambito === 2;
        })->count();

        $data['0601011']['abierto'] = $d0601011->filter(function ($item){
            return $item->servicios->id_ambito === 1;
        })->count();

        $data['0601011']['emergencia'] = $d0601011->filter(function ($item){
            return $item->servicios->id_ambito === 3;
        })->count();



        $d0601012 = $datos->filter(function ($dato) {
            return $dato->prestacion === 43;
        });

        $data['0601012']['mai'] = $d0601012->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "F";
        })->count();

        $data['0601012']['mle'] = $d0601012->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "C";
        })->count();

        $data['0601012']['no beneficiarios'] = $d0601012->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "I" || trim($item->paciente->PAC_PAC_Prevision) === "P" ;
        })->count();

        $data['0601012']['total'] = $d0601012->count();

        $data['0601012']['cerrado'] = $d0601012->filter(function ($item){
            return $item->servicios->id_ambito === 2;
        })->count();

        $data['0601012']['abierto'] = $d0601012->filter(function ($item){
            return $item->servicios->id_ambito === 1;
        })->count();

        $data['0601012']['emergencia'] = $d0601012->filter(function ($item){
            return $item->servicios->id_ambito === 3;
        })->count();



        $d0601013 = $datos->filter(function ($dato) {
            return $dato->prestacion === 44;
        });

        $data['0601013']['mai'] = $d0601013->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "F";
        })->count();

        $data['0601013']['mle'] = $d0601013->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "C";
        })->count();

        $data['0601013']['no beneficiarios'] = $d0601013->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "I" || trim($item->paciente->PAC_PAC_Prevision) === "P" ;
        })->count();

        $data['0601013']['total'] = $d0601013->count();

        $data['0601013']['cerrado'] = $d0601013->filter(function ($item){
            return $item->servicios->id_ambito === 2;
        })->count();

        $data['0601013']['abierto'] = $d0601013->filter(function ($item){
            return $item->servicios->id_ambito === 1;
        })->count();

        $data['0601013']['emergencia'] = $d0601013->filter(function ($item){
            return $item->servicios->id_ambito === 3;
        })->count();



        $d0601015 = $datos->filter(function ($dato) {
            return $dato->prestacion === 128;
        });

        $data['0601015']['mai'] = $d0601015->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "F";
        })->count();

        $data['0601015']['mle'] = $d0601015->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "C";
        })->count();

        $data['0601015']['no beneficiarios'] = $d0601015->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "I" || trim($item->paciente->PAC_PAC_Prevision) === "P" ;
        })->count();

        $data['0601015']['total'] = $d0601015->count();

        $data['0601015']['cerrado'] = $d0601015->filter(function ($item){
            return $item->servicios->id_ambito === 2;
        })->count();

        $data['0601015']['abierto'] = $d0601015->filter(function ($item){
            return $item->servicios->id_ambito === 1;
        })->count();

        $data['0601015']['emergencia'] = $d0601015->filter(function ($item){
            return $item->servicios->id_ambito === 3;
        })->count();



        $d0601016 = $datos->filter(function ($dato) {
            return $dato->prestacion === 129;
        });

        $data['0601016']['mai'] = $d0601016->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "F";
        })->count();

        $data['0601016']['mle'] = $d0601016->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "C";
        })->count();

        $data['0601016']['no beneficiarios'] = $d0601016->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "I" || trim($item->paciente->PAC_PAC_Prevision) === "P" ;
        })->count();

        $data['0601016']['total'] = $d0601016->count();

        $data['0601016']['cerrado'] = $d0601016->filter(function ($item){
            return $item->servicios->id_ambito === 2;
        })->count();

        $data['0601016']['abierto'] = $d0601016->filter(function ($item){
            return $item->servicios->id_ambito === 1;
        })->count();

        $data['0601016']['emergencia'] = $d0601016->filter(function ($item){
            return $item->servicios->id_ambito === 3;
        })->count();



        $d0601017 = $datos->filter(function ($dato) {
            return $dato->prestacion === 3;
        });

        $data['0601017']['mai'] = $d0601017->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "F";
        })->count();

        $data['0601017']['mle'] = $d0601017->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "C";
        })->count();

        $data['0601017']['no beneficiarios'] = $d0601017->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "I" || trim($item->paciente->PAC_PAC_Prevision) === "P" ;
        })->count();

        $data['0601017']['total'] = $d0601017->count();

        $data['0601017']['cerrado'] = $d0601017->filter(function ($item){
            return $item->servicios->id_ambito === 2;
        })->count();

        $data['0601017']['abierto'] = $d0601017->filter(function ($item){
            return $item->servicios->id_ambito === 1;
        })->count();

        $data['0601017']['emergencia'] = $d0601017->filter(function ($item){
            return $item->servicios->id_ambito === 3;
        })->count();



        $d0601028 = $datos->filter(function ($dato) {
            return $dato->prestacion === 123;
        });

        $data['0601028']['mai'] = $d0601028->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "F";
        })->count();

        $data['0601028']['mle'] = $d0601028->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "C";
        })->count();

        $data['0601028']['no beneficiarios'] = $d0601028->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "I" || trim($item->paciente->PAC_PAC_Prevision) === "P" ;
        })->count();

        $data['0601028']['total'] = $d0601028->count();

        $data['0601028']['cerrado'] = $d0601028->filter(function ($item){
            return $item->servicios->id_ambito === 2;
        })->count();

        $data['0601028']['abierto'] = $d0601028->filter(function ($item){
            return $item->servicios->id_ambito === 1;
        })->count();

        $data['0601028']['emergencia'] = $d0601028->filter(function ($item){
            return $item->servicios->id_ambito === 3;
        })->count();



        $d0601018 = $datos->filter(function ($dato) {
            return $dato->prestacion === 31 || $dato->prestacion === 45;
        });

        $data['0601018']['mai'] = $d0601018->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "F";
        })->count();

        $data['0601018']['mle'] = $d0601018->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "C";
        })->count();

        $data['0601018']['no beneficiarios'] = $d0601018->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "I" || trim($item->paciente->PAC_PAC_Prevision) === "P" ;
        })->count();

        $data['0601018']['total'] = $d0601018->count();

        $data['0601018']['cerrado'] = $d0601018->filter(function ($item){
            return $item->servicios->id_ambito === 2;
        })->count();

        $data['0601018']['abierto'] = $d0601018->filter(function ($item){
            return $item->servicios->id_ambito === 1;
        })->count();

        $data['0601018']['emergencia'] = $d0601018->filter(function ($item){
            return $item->servicios->id_ambito === 3;
        })->count();



        $d0601019 = $datos->filter(function ($dato) {
            return $dato->prestacion === 51;
        });

        $data['0601019']['mai'] = $d0601019->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "F";
        })->count();

        $data['0601019']['mle'] = $d0601019->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "C";
        })->count();

        $data['0601019']['no beneficiarios'] = $d0601019->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "I" || trim($item->paciente->PAC_PAC_Prevision) === "P" ;
        })->count();

        $data['0601019']['total'] = $d0601019->count();

        $data['0601019']['cerrado'] = $d0601019->filter(function ($item){
            return $item->servicios->id_ambito === 2;
        })->count();

        $data['0601019']['abierto'] = $d0601019->filter(function ($item){
            return $item->servicios->id_ambito === 1;
        })->count();

        $data['0601019']['emergencia'] = $d0601019->filter(function ($item){
            return $item->servicios->id_ambito === 3;
        })->count();



        $d0601020 = $datos->filter(function ($dato) {
            return $dato->prestacion === 72 || $dato->prestacion === 109;
        });

        $data['0601020']['mai'] = $d0601020->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "F";
        })->count();

        $data['0601020']['mle'] = $d0601020->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "C";
        })->count();

        $data['0601020']['no beneficiarios'] = $d0601020->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "I" || trim($item->paciente->PAC_PAC_Prevision) === "P" ;
        })->count();

        $data['0601020']['total'] = $d0601020->count();

        $data['0601020']['cerrado'] = $d0601020->filter(function ($item){
            return $item->servicios->id_ambito === 2;
        })->count();

        $data['0601020']['abierto'] = $d0601020->filter(function ($item){
            return $item->servicios->id_ambito === 1;
        })->count();

        $data['0601020']['emergencia'] = $d0601020->filter(function ($item){
            return $item->servicios->id_ambito === 3;
        })->count();



        $d0601022 = $datos->filter(function ($dato) {
            return $dato->prestacion === 46;
        });

        $data['0601022']['mai'] = $d0601022->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "F";
        })->count();

        $data['0601022']['mle'] = $d0601022->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "C";
        })->count();

        $data['0601022']['no beneficiarios'] = $d0601022->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "I" || trim($item->paciente->PAC_PAC_Prevision) === "P" ;
        })->count();

        $data['0601022']['total'] = $d0601022->count();

        $data['0601022']['cerrado'] = $d0601022->filter(function ($item){
            return $item->servicios->id_ambito === 2;
        })->count();

        $data['0601022']['abierto'] = $d0601022->filter(function ($item){
            return $item->servicios->id_ambito === 1;
        })->count();

        $data['0601022']['emergencia'] = $d0601022->filter(function ($item){
            return $item->servicios->id_ambito === 3;
        })->count();



        $d0601024 = $datos->filter(function ($dato) {
            return $dato->prestacion === 4 || $dato->prestacion === 19;
        });

        $data['0601024']['mai'] = $d0601024->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "F";
        })->count();

        $data['0601024']['mle'] = $d0601024->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "C";
        })->count();

        $data['0601024']['no beneficiarios'] = $d0601024->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "I" || trim($item->paciente->PAC_PAC_Prevision) === "P" ;
        })->count();

        $data['0601024']['total'] = $d0601024->count();

        $data['0601024']['cerrado'] = $d0601024->filter(function ($item){
            return $item->servicios->id_ambito === 2;
        })->count();

        $data['0601024']['abierto'] = $d0601024->filter(function ($item){
            return $item->servicios->id_ambito === 1;
        })->count();

        $data['0601024']['emergencia'] = $d0601024->filter(function ($item){
            return $item->servicios->id_ambito === 3;
        })->count();



        $d0601025 = $datos->filter(function ($dato) {
            return $dato->prestacion === 5;
        });

        $data['0601025']['mai'] = $d0601025->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "F";
        })->count();

        $data['0601025']['mle'] = $d0601025->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "C";
        })->count();

        $data['0601025']['no beneficiarios'] = $d0601025->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "I" || trim($item->paciente->PAC_PAC_Prevision) === "P" ;
        })->count();

        $data['0601025']['total'] = $d0601025->count();

        $data['0601025']['cerrado'] = $d0601025->filter(function ($item){
            return $item->servicios->id_ambito === 2;
        })->count();

        $data['0601025']['abierto'] = $d0601025->filter(function ($item){
            return $item->servicios->id_ambito === 1;
        })->count();

        $data['0601025']['emergencia'] = $d0601025->filter(function ($item){
            return $item->servicios->id_ambito === 3;
        })->count();



        $d0601030 = $datos->filter(function ($dato) {
            return $dato->prestacion === 6;
        });

        $data['0601030']['mai'] = $d0601030->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "F";
        })->count();

        $data['0601030']['mle'] = $d0601030->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "C";
        })->count();

        $data['0601030']['no beneficiarios'] = $d0601030->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "I" || trim($item->paciente->PAC_PAC_Prevision) === "P" ;
        })->count();

        $data['0601030']['total'] = $d0601030->count();

        $data['0601030']['cerrado'] = $d0601030->filter(function ($item){
            return $item->servicios->id_ambito === 2;
        })->count();

        $data['0601030']['abierto'] = $d0601030->filter(function ($item){
            return $item->servicios->id_ambito === 1;
        })->count();

        $data['0601030']['emergencia'] = $d0601030->filter(function ($item){
            return $item->servicios->id_ambito === 3;
        })->count();



        $d0601031 = $datos->filter(function ($dato) {
            return $dato->prestacion === 7;
        });

        $data['0601031']['mai'] = $d0601031->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "F";
        })->count();

        $data['0601031']['mle'] = $d0601031->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "C";
        })->count();

        $data['0601031']['no beneficiarios'] = $d0601031->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "I" || trim($item->paciente->PAC_PAC_Prevision) === "P" ;
        })->count();

        $data['0601031']['total'] = $d0601031->count();

        $data['0601031']['cerrado'] = $d0601031->filter(function ($item){
            return $item->servicios->id_ambito === 2;
        })->count();

        $data['0601031']['abierto'] = $d0601031->filter(function ($item){
            return $item->servicios->id_ambito === 1;
        })->count();

        $data['0601031']['emergencia'] = $d0601031->filter(function ($item){
            return $item->servicios->id_ambito === 3;
        })->count();



        $d0601181 = $datos->filter(function ($dato) {
            return $dato->prestacion === 34;
        });

        $data['0601181']['mai'] = $d0601181->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "F";
        })->count();

        $data['0601181']['mle'] = $d0601181->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "C";
        })->count();

        $data['0601181']['no beneficiarios'] = $d0601181->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "I" || trim($item->paciente->PAC_PAC_Prevision) === "P" ;
        })->count();

        $data['0601181']['total'] = $d0601181->count();

        $data['0601181']['cerrado'] = $d0601181->filter(function ($item){
            return $item->servicios->id_ambito === 2;
        })->count();

        $data['0601181']['abierto'] = $d0601181->filter(function ($item){
            return $item->servicios->id_ambito === 1;
        })->count();

        $data['0601181']['emergencia'] = $d0601181->filter(function ($item){
            return $item->servicios->id_ambito === 3;
        })->count();



        $d0102503 = $datos->filter(function ($dato) {
            return $dato->prestacion === 78;
        });

        $data['0102503']['mai'] = $d0102503->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "F";
        })->count();

        $data['0102503']['mle'] = $d0102503->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "C";
        })->count();

        $data['0102503']['no beneficiarios'] = $d0102503->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "I" || trim($item->paciente->PAC_PAC_Prevision) === "P" ;
        })->count();

        $data['0102503']['total'] = $d0102503->count();

        $data['0102503']['cerrado'] = $d0102503->filter(function ($item){
            return $item->servicios->id_ambito === 2;
        })->count();

        $data['0102503']['abierto'] = $d0102503->filter(function ($item){
            return $item->servicios->id_ambito === 1;
        })->count();

        $data['0102503']['emergencia'] = $d0102503->filter(function ($item){
            return $item->servicios->id_ambito === 3;
        })->count();



        $d0102504 = $datos->filter(function ($dato) {
            return $dato->prestacion === 80;
        });

        $data['0102504']['mai'] = $d0102504->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "F";
        })->count();

        $data['0102504']['mle'] = $d0102504->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "C";
        })->count();

        $data['0102504']['no beneficiarios'] = $d0102504->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "I" || trim($item->paciente->PAC_PAC_Prevision) === "P" ;
        })->count();

        $data['0102504']['total'] = $d0102504->count();

        $data['0102504']['cerrado'] = $d0102504->filter(function ($item){
            return $item->servicios->id_ambito === 2;
        })->count();

        $data['0102504']['abierto'] = $d0102504->filter(function ($item){
            return $item->servicios->id_ambito === 1;
        })->count();

        $data['0102504']['emergencia'] = $d0102504->filter(function ($item){
            return $item->servicios->id_ambito === 3;
        })->count();



        $d0102505 = $datos->filter(function ($dato) {
            return $dato->prestacion === 77;
        });

        $data['0102505']['mai'] = $d0102505->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "F";
        })->count();

        $data['0102505']['mle'] = $d0102505->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "C";
        })->count();

        $data['0102505']['no beneficiarios'] = $d0102505->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "I" || trim($item->paciente->PAC_PAC_Prevision) === "P" ;
        })->count();

        $data['0102505']['total'] = $d0102505->count();

        $data['0102505']['cerrado'] = $d0102505->filter(function ($item){
            return $item->servicios->id_ambito === 2;
        })->count();

        $data['0102505']['abierto'] = $d0102505->filter(function ($item){
            return $item->servicios->id_ambito === 1;
        })->count();

        $data['0102505']['emergencia'] = $d0102505->filter(function ($item){
            return $item->servicios->id_ambito === 3;
        })->count();



        $d0102506 = $datos->filter(function ($dato) {
            return $dato->prestacion === 82 || $dato->prestacion === 60;
        });

        $data['0102506']['mai'] = $d0102506->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "F";
        })->count();

        $data['0102506']['mle'] = $d0102506->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "C";
        })->count();

        $data['0102506']['no beneficiarios'] = $d0102506->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "I" || trim($item->paciente->PAC_PAC_Prevision) === "P" ;
        })->count();

        $data['0102506']['total'] = $d0102506->count();

        $data['0102506']['cerrado'] = $d0102506->filter(function ($item){
            return $item->servicios->id_ambito === 2;
        })->count();

        $data['0102506']['abierto'] = $d0102506->filter(function ($item){
            return $item->servicios->id_ambito === 1;
        })->count();

        $data['0102506']['emergencia'] = $d0102506->filter(function ($item){
            return $item->servicios->id_ambito === 3;
        })->count();



        $d01010922 = $datos->filter(function ($dato) {
            return $dato->prestacion === 18;
        });

        $data['01010922']['mai'] = $d01010922->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "F";
        })->count();

        $data['01010922']['mle'] = $d01010922->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "C";
        })->count();

        $data['01010922']['no beneficiarios'] = $d01010922->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "I" || trim($item->paciente->PAC_PAC_Prevision) === "P" ;
        })->count();

        $data['01010922']['total'] = $d01010922->count();

        $data['01010922']['cerrado'] = $d01010922->filter(function ($item){
            return $item->servicios->id_ambito === 2;
        })->count();

        $data['01010922']['abierto'] = $d01010922->filter(function ($item){
            return $item->servicios->id_ambito === 1;
        })->count();

        $data['01010922']['emergencia'] = $d01010922->filter(function ($item){
            return $item->servicios->id_ambito === 3;
        })->count();



        $d01010924 = $datos->filter(function ($dato) {
            return $dato->prestacion === 125;
        });

        $data['01010924']['mai'] = $d01010924->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "F";
        })->count();

        $data['01010924']['mle'] = $d01010924->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "C";
        })->count();

        $data['01010924']['no beneficiarios'] = $d01010924->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "I" || trim($item->paciente->PAC_PAC_Prevision) === "P" ;
        })->count();

        $data['01010924']['total'] = $d01010924->count();

        $data['01010924']['cerrado'] = $d01010924->filter(function ($item){
            return $item->servicios->id_ambito === 2;
        })->count();

        $data['01010924']['abierto'] = $d01010924->filter(function ($item){
            return $item->servicios->id_ambito === 1;
        })->count();

        $data['01010924']['emergencia'] = $d01010924->filter(function ($item){
            return $item->servicios->id_ambito === 3;
        })->count();



        $d01010925 = $datos->filter(function ($dato) {
            return $dato->prestacion === 126;
        });

        $data['01010925']['mai'] = $d01010925->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "F";
        })->count();

        $data['01010925']['mle'] = $d01010925->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "C";
        })->count();

        $data['01010925']['no beneficiarios'] = $d01010925->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "I" || trim($item->paciente->PAC_PAC_Prevision) === "P" ;
        })->count();

        $data['01010925']['total'] = $d01010925->count();

        $data['01010925']['cerrado'] = $d01010925->filter(function ($item){
            return $item->servicios->id_ambito === 2;
        })->count();

        $data['01010925']['abierto'] = $d01010925->filter(function ($item){
            return $item->servicios->id_ambito === 1;
        })->count();

        $data['01010925']['emergencia'] = $d01010925->filter(function ($item){
            return $item->servicios->id_ambito === 3;
        })->count();



        $d01010926 = $datos->filter(function ($dato) {
            return $dato->prestacion === 127;
        });

        $data['01010926']['mai'] = $d01010926->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "F";
        })->count();

        $data['01010926']['mle'] = $d01010926->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "C";
        })->count();

        $data['01010926']['no beneficiarios'] = $d01010926->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "I" || trim($item->paciente->PAC_PAC_Prevision) === "P" ;
        })->count();

        $data['01010926']['total'] = $d01010926->count();

        $data['01010926']['cerrado'] = $d01010926->filter(function ($item){
            return $item->servicios->id_ambito === 2;
        })->count();

        $data['01010926']['abierto'] = $d01010926->filter(function ($item){
            return $item->servicios->id_ambito === 1;
        })->count();

        $data['01010926']['emergencia'] = $d01010926->filter(function ($item){
            return $item->servicios->id_ambito === 3;
        })->count();



        $d01010927 = $datos->filter(function ($dato) {
            return $dato->prestacion === 61;
        });

        $data['01010927']['mai'] = $d01010927->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "F";
        })->count();

        $data['01010927']['mle'] = $d01010927->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "C";
        })->count();

        $data['01010927']['no beneficiarios'] = $d01010927->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "I" || trim($item->paciente->PAC_PAC_Prevision) === "P" ;
        })->count();

        $data['01010927']['total'] = $d01010927->count();

        $data['01010927']['cerrado'] = $d01010927->filter(function ($item){
            return $item->servicios->id_ambito === 2;
        })->count();

        $data['01010927']['abierto'] = $d01010927->filter(function ($item){
            return $item->servicios->id_ambito === 1;
        })->count();

        $data['01010927']['emergencia'] = $d01010927->filter(function ($item){
            return $item->servicios->id_ambito === 3;
        })->count();



        $d01010932 = $datos->filter(function ($dato) {
            return $dato->prestacion === 65 || $dato->prestacion === 130;
        });

        $data['01010932']['mai'] = $d01010932->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "F";
        })->count();

        $data['01010932']['mle'] = $d01010932->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "C";
        })->count();

        $data['01010932']['no beneficiarios'] = $d01010932->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "I" || trim($item->paciente->PAC_PAC_Prevision) === "P" ;
        })->count();

        $data['01010932']['total'] = $d01010932->count();

        $data['01010932']['cerrado'] = $d01010932->filter(function ($item){
            return $item->servicios->id_ambito === 2;
        })->count();

        $data['01010932']['abierto'] = $d01010932->filter(function ($item){
            return $item->servicios->id_ambito === 1;
        })->count();

        $data['01010932']['emergencia'] = $d01010932->filter(function ($item){
            return $item->servicios->id_ambito === 3;
        })->count();



        $d01010933 = $datos->filter(function ($dato) {
            return $dato->prestacion === 78;
        });

        $data['01010933']['mai'] = $d01010933->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "F";
        })->count();

        $data['01010933']['mle'] = $d01010933->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "C";
        })->count();

        $data['01010933']['no beneficiarios'] = $d01010933->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "I" || trim($item->paciente->PAC_PAC_Prevision) === "P" ;
        })->count();

        $data['01010933']['total'] = $d01010933->count();

        $data['01010933']['cerrado'] = $d01010933->filter(function ($item){
            return $item->servicios->id_ambito === 2;
        })->count();

        $data['01010933']['abierto'] = $d01010933->filter(function ($item){
            return $item->servicios->id_ambito === 1;
        })->count();

        $data['01010933']['emergencia'] = $d01010933->filter(function ($item){
            return $item->servicios->id_ambito === 3;
        })->count();



        $d01010934 = $datos->filter(function ($dato) {
            return $dato->prestacion === 80;
        });

        $data['01010934']['mai'] = $d01010934->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "F";
        })->count();

        $data['01010934']['mle'] = $d01010934->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "C";
        })->count();

        $data['01010934']['no beneficiarios'] = $d01010934->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "I" || trim($item->paciente->PAC_PAC_Prevision) === "P" ;
        })->count();

        $data['01010934']['total'] = $d01010934->count();

        $data['01010934']['cerrado'] = $d01010934->filter(function ($item){
            return $item->servicios->id_ambito === 2;
        })->count();

        $data['01010934']['abierto'] = $d01010934->filter(function ($item){
            return $item->servicios->id_ambito === 1;
        })->count();

        $data['01010934']['emergencia'] = $d01010934->filter(function ($item){
            return $item->servicios->id_ambito === 3;
        })->count();



        $d0601023 = $datos->filter(function ($dato) {
            return $dato->prestacion === 142;
        });

        $data['0601023']['mai'] = $d0601023->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "F";
        })->count();

        $data['0601023']['mle'] = $d0601023->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "C";
        })->count();

        $data['0601023']['no beneficiarios'] = $d0601023->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "I" || trim($item->paciente->PAC_PAC_Prevision) === "P" ;
        })->count();

        $data['0601023']['total'] = $d0601023->count();

        $data['0601023']['cerrado'] = $d0601023->filter(function ($item){
            return $item->servicios->id_ambito === 2;
        })->count();

        $data['0601023']['abierto'] = $d0601023->filter(function ($item){
            return $item->servicios->id_ambito === 1;
        })->count();

        $data['0601023']['emergencia'] = $d0601023->filter(function ($item){
            return $item->servicios->id_ambito === 3;
        })->count();



        $d0601171 = $datos->filter(function ($dato) {
            return $dato->prestacion === 143;
        });

        $data['0601171']['mai'] = $d0601171->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "F";
        })->count();

        $data['0601171']['mle'] = $d0601171->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "C";
        })->count();

        $data['0601171']['no beneficiarios'] = $d0601171->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "I" || trim($item->paciente->PAC_PAC_Prevision) === "P" ;
        })->count();

        $data['0601171']['total'] = $d0601171->count();

        $data['0601171']['cerrado'] = $d0601171->filter(function ($item){
            return $item->servicios->id_ambito === 2;
        })->count();

        $data['0601171']['abierto'] = $d0601171->filter(function ($item){
            return $item->servicios->id_ambito === 1;
        })->count();

        $data['0601171']['emergencia'] = $d0601171->filter(function ($item){
            return $item->servicios->id_ambito === 3;
        })->count();



        $d0102501 = $datos->filter(function ($dato) {
            return $dato->prestacion === 14;
        });

        $data['0102501']['mai'] = $d0102501->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "F";
        })->count();

        $data['0102501']['mle'] = $d0102501->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "C";
        })->count();

        $data['0102501']['no beneficiarios'] = $d0102501->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "I" || trim($item->paciente->PAC_PAC_Prevision) === "P" ;
        })->count();

        $data['0102501']['total'] = $d0102501->count();

        $data['0102501']['cerrado'] = $d0102501->filter(function ($item){
            return $item->servicios->id_ambito === 2;
        })->count();

        $data['0102501']['abierto'] = $d0102501->filter(function ($item){
            return $item->servicios->id_ambito === 1;
        })->count();

        $data['0102501']['emergencia'] = $d0102501->filter(function ($item){
            return $item->servicios->id_ambito === 3;
        })->count();



        $d01010928 = $datos->filter(function ($dato) {
            return $dato->prestacion === 52 || $dato->prestacion === 53 || $dato->prestacion === 64 || $dato->prestacion === 144;
        });

        $data['01010928']['mai'] = $d01010928->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "F";
        })->count();

        $data['01010928']['mle'] = $d01010928->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "C";
        })->count();

        $data['01010928']['no beneficiarios'] = $d01010928->filter(function ($item){
            return trim($item->paciente->PAC_PAC_Prevision) === "I" || trim($item->paciente->PAC_PAC_Prevision) === "P" ;
        })->count();

        $data['01010928']['total'] = $d01010928->count();

        $data['01010928']['cerrado'] = $d01010928->filter(function ($item){
            return $item->servicios->id_ambito === 2;
        })->count();

        $data['01010928']['abierto'] = $d01010928->filter(function ($item){
            return $item->servicios->id_ambito === 1;
        })->count();

        $data['01010928']['emergencia'] = $d01010928->filter(function ($item){
            return $item->servicios->id_ambito === 3;
        })->count();

        return view('excel.medFisicaBsb17', compact('data'));
    }
}