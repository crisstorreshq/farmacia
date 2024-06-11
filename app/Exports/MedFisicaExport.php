<?php

namespace App\Exports;

use DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use App\Models\UnidadKine;
use App\Models\ConveniosMedFisica;
use App\Models\IngresosMedFisica;
use Carbon\Carbon;

class MedFisicaExport implements FromView, ShouldAutoSize, WithEvents, WithColumnWidths
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
            'B' => 50,
            'J' => 50,
            'L' => 50,
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
                $event->sheet->getStyle('A1:S1')->applyFromArray($styleArray);
            },
        ];
    }

    public function view(): View
    {
        $data = DB::table('BD_PPV.dbo.Prestaciones_Kine_New as pk')
        ->leftJoin('BD_ENTI_CORPORATIVA.dbo.Segu_Usuarios as us', 'us.Segu_Usr_Cuenta','=','pk.digitador')
        ->leftJoin('BD_ENTI_CORPORATIVA.dbo.PAC_Carpeta as car', 'car.PAC_PAC_Numero','=','pk.PAC_PAC_Numero')
        ->leftJoin('BD_ENTI_CORPORATIVA.dbo.PAC_Paciente as pa', 'pk.PAC_PAC_Numero','=','pa.PAC_PAC_Numero')
        ->leftJoin('BD_ENTI_CORPORATIVA.dbo.TAB_Nacionalidad as na', 'na.NAC_Ide','=','pa.NAC_Ide')
        ->join('BD_PPV.dbo.Presta_Med_Fisica as pm', 'pm.id', '=', 'pk.prestacion')
        ->whereBetween('pk.fecha_ingreso', [$this->fin, $this->fter])
        ->selectRaw("us.Segu_Usr_Nombre+' '+us.Segu_Usr_ApellidoPaterno+' '+us.Segu_Usr_ApellidoMaterno as nombre_profesional, pk.diagnostico, car.PAC_CAR_NumerFicha, pa.PAC_PAC_Rut, rtrim(ltrim(pa.PAC_PAC_Sexo)) as sexo, case (pa.PAC_PAC_Prevision) when 'F' then 'Fonasa' when 'P' then 'Particular' when 'C' then 'Convenio' else 'No Informado' end+' '+ pa.PAC_PAC_TipoBenef as prevision, (cast(datediff(dd,pa.PAC_PAC_FechaNacim,GETDATE()) / 365.25 as int)) as edad, na.NAC_Descripcion, pk.tipo, pm.descripcion, pm.codigo, pk.referencia, pk.num_prestacion, pk.fecha_ingreso, pk.fecha_alta, pk.servicio, pk.covid, pk.id_convenio, pk.id_ingreso")
        ->get();

        foreach ($data as $d) {
            switch ($d->tipo) {
                case 'ing':
                    $d->tipo = 'INGRESO';
                    break;
                case 'ing_p':
                    $d->tipo = 'INGRESO PTI';
                    break;
                case 'rei':
                    $d->tipo = 'REINGRESO';
                    break;
                case 'cont':
                    $d->tipo = 'CONTROL';
                    break;
            }

            switch ($d->covid) {
                case 'pos':
                    $d->covid = 'POSITIVO';
                    break;
                case 'neg':
                    $d->covid = 'NEGATIVO';
                    break;
                case 'sos':
                    $d->covid = 'SOSPECHA';
                    break;
            }
            $d->referencia = UnidadKine::where('id', $d->referencia)->first()->nombre;
            $d->servicio = UnidadKine::where('id', $d->servicio)->first()->nombre;
            $d->fecha_ingreso = Carbon::parse($d->fecha_ingreso)->format('Y-m-d');
            $d->fecha_alta ? $d->fecha_alta = Carbon::parse($d->fecha_alta)->format('Y-m-d') : '-';
            $d->id_convenio ? $d->id_convenio = ConveniosMedFisica::where('id', $d->id_convenio)->first()->name  : '-';
            $d->id_ingreso ? $d->id_ingreso = IngresosMedFisica::where('id', $d->id_ingreso)->first()->name  : '-';
        }

        return view('excel.medFisica', compact('data'));
    }
}