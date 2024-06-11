<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use DB;

class ReportePatologia implements WithHeadings,ShouldAutoSize, WithEvents, FromView, WithColumnWidths
{
    use Exportable;

    public function __construct(String $fin, $fter)
    {
        $this->fin = $fin;
        $this->fter = $fter;
    }

    public function columnWidths(): array
    {
        return [
            'H' => 60,
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
                $event->sheet->getStyle('A1:J1')->applyFromArray($styleArray);
            },
        ];
    }

    public function headings(): array
    {
        return [
            'Fecha de Prestacion',
            'Nombre Paciente',
            'Sexo Paciente',
            'Prevision Paciente',
            'Tipo Beneficio',
            'Edad Paciente',
            'Código Prestacion',
            'Descripción Prestación',
            'Servicio',
            'Ámbito'
        ];
    }

    public function view(): View
    {
        $fin = $this->fin;
        $fter = $this->fter;

        $data = DB::table('BD_PPV.dbo.Prestaciones_Patologia as pp')
            ->leftJoin("BD_ENTI_CORPORATIVA.dbo.PAC_Paciente as pac", "pac.PAC_PAC_Numero", "=", "pp.PAC_PAC_Numero")
            ->join("BD_PPV.dbo.Presta_Med_Fisica as pre", "pre.id", "=", "pp.prestacion_id")
            ->join("BD_PPV.dbo.unidades_patologia as uni", "uni.id", "=", "pp.servicio_id")
            ->join("BD_PPV.dbo.Ambito as am", "am.id", "=", "uni.ambito_id")
            ->selectRaw("pp.fecha_prestacion, pac.PAC_PAC_Nombre+' '+pac.PAC_PAC_ApellPater+' '+pac.PAC_PAC_ApellMater as nombre_paciente, pac.PAC_PAC_Sexo, pac.PAC_PAC_Prevision, pac.PAC_PAC_TipoBenef, (cast(datediff(dd,PAC_PAC_FechaNacim,GETDATE()) / 365.25 as int)) as Edad, pre.codigo, pre.descripcion, uni.nombre as servicio, am.nombre as ambito")
            ->whereRaw("pp.vigente = 1 and fecha_prestacion between '$fin' and '$fter'")
            ->orderBy("fecha_prestacion", "asc")
            ->get();

        
        return view('excel.patologia', compact('data'));
    }
}