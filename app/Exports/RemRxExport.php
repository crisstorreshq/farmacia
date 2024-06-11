<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use DB;

class RemRxExport implements FromView, ShouldAutoSize, WithEvents, WithColumnWidths
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
            'C' => 40,
        ];
    }

    public function registerEvents(): array
    {
        $styleArray = [
            'font' => [
                'bold' => true,
                ],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
                    'rotation' => 90,
                    'startColor' => [
                        'argb' => 'FFA0A0A0',
                    ],
                    'endColor' => [
                        'argb' => 'FFFFFFFF',
                    ],
                ],
            ];

        return [
            AfterSheet::class => function(AfterSheet $event) use ($styleArray) {
                $event->sheet->getStyle('A1:I1')->applyFromArray($styleArray);
            },
        ];
    }

    public function view(): View
    {
        $data = DB::table('BD_PPV.dbo.REM_Rayos_3 as rx')
        ->join('BD_ENTI_CORPORATIVA.dbo.PRE_Prestacion as pre', 'rx.PRE_PRE_Codigo', '=', 'pre.PRE_PRE_Codigo')
        ->join('BD_PPV.dbo.unidades_rx as uni', 'uni.id', '=', 'rx.servicio')
        ->join('BD_ENTI_CORPORATIVA.dbo.PAC_Paciente as pac', function ($join) {
            $join->on('pac.PAC_PAC_Numero', '=', 'rx.PAC_PAC_Numero')
            ->where('pac.PAC_PAC_Prevision', '=', 'F');
        })
        ->join('BD_PPV.dbo.Ambito as a', 'a.id', '=', 'uni.ambito_id')
        ->selectRaw("
            DAY(rx.fecha_derivacion) AS DIA,
            rx.PRE_PRE_Codigo as CODIGO,
            pre.PRE_PRE_Descripcio as DESCRIPCION,
            CAST ( uni.nombre AS VARCHAR (100) ) as UNIDAD,
            SUM(cantidad_examen) AS CANTIDAD_EXAMEN,
            count(pac.PAC_PAC_Prevision) as BENEFICIARIOS,
            count(cantidad_examen) - count(pac.PAC_PAC_Prevision) AS NO_BENEFICIARIOS,
            count(cantidad_examen) AS TOTAL,
            a.nombre as AMBITO
        ")
        ->whereBetween('fecha_derivacion', [$this->fin, $this->fter])
        ->groupBy(DB::raw("
            rx.PRE_PRE_Codigo, 
            CAST(rx.servicio AS VARCHAR(100)), 
            rx.fecha_derivacion, 
            pre.PRE_PRE_Descripcio, 
            CAST(uni.nombre AS VARCHAR(100)), 
            a.nombre
            "))
        ->orderBy('DIA', 'ASC')
        ->get();

        return view('excel.rx', compact('data'));
    }
}