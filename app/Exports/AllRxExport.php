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

class AllRxExport implements FromView, ShouldAutoSize, WithEvents, WithColumnWidths
{
    use Exportable;

    public function __construct(string $inicio, $termino)
    {
        $this->inicio = $inicio;
        $this->termino = $termino;
    }

    public function columnWidths(): array
    {
        return [
            'G' => 50,
            'I' => 50,
            'J' => 50,
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
                $event->sheet->getStyle('A1:N1')->applyFromArray($styleArray);
            },
        ];
    }

    public function view(): View
    {
        $data = DB::table('BD_PPV.dbo.REM_Rayos_3 as rx')
        ->join('BD_PPV.dbo.Prestaciones_Rx as pre', 'rx.PRE_PRE_Codigo', '=', 'pre.codigo')
        ->join('BD_PPV.dbo.unidades_rx as uni', 'uni.id', '=', 'rx.servicio')
        ->join('BD_ENTI_CORPORATIVA.dbo.PAC_Paciente as pac', function ($join) {
            $join->on('pac.PAC_PAC_Numero', '=', 'rx.PAC_PAC_Numero')
            ->where('pac.PAC_PAC_Prevision', '=', 'F');
        })
        ->join('BD_PPV.dbo.Ambito as a', 'a.id', '=', 'uni.ambito_id')
        ->join('BD_ENTI_CORPORATIVA.dbo.Segu_Usuarios as us', 'us.Segu_Usr_RUT', '=', 'rx.tm_responsable')
        ->selectRaw("
            pac.PAC_PAC_Rut,
            pac.PAC_PAC_Nombre + ' ' + pac.PAC_PAC_ApellPater + ' ' + pac.PAC_PAC_ApellMater as nombre_pac,
            pac.PAC_PAC_Sexo,
            pac.PAC_PAC_Prevision,
            pac.PAC_PAC_TipoBenef,
            pre.codigo,
            pre.nombre,
            pre.tipo,
            rx.detalle,
            rx.diagnostico,
            uni.nombre as servicio,
            a.nombre as ambito,
            us.Segu_Usr_Nombre + ' ' + us.Segu_Usr_ApellidoPaterno + ' ' + us.Segu_Usr_ApellidoMaterno as TM,
            CASE
            	WHEN rx.medico_realiza = 'itms' THEN 'ITMS'
            	WHEN rx.medico_realiza = '18243987-8' THEN 'SEBASTIAN GARCES ABURTO'
            	WHEN rx.medico_realiza = '48184830-K' THEN 'KERLY BANOUT ABELLO'
            	WHEN rx.medico_realiza = '12401154-K' THEN 'CRISTIAN CIFUENTES GARAY'
            	WHEN rx.medico_realiza = '12209322-0' THEN 'ROGER FERNANDEZ TORRES'
            	WHEN rx.medico_realiza = 'operativo' THEN 'OPERATIVO'
                WHEN rx.medico_realiza = '18633570-8' THEN 'JOAQUÍN ARACENA ARAVENA'
            	ELSE ''
            END 
            as radiologo,
            rx.cantidad_examen
        ")
        ->whereBetween('fecha_derivacion', [$this->inicio, $this->termino])
        ->get();

        return view('excel.rxAll', compact('data'));
        //ok
    }
}