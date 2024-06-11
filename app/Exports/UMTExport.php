<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use App\Models\PrestacionesUMT;

class UMTExport implements FromView, ShouldAutoSize, WithEvents, WithColumnWidths
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
            'D' => 40,
            'I' => 20,
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
        $data = PrestacionesUMT::with('prestacion', 'unidad.ambito', 'usuario')
                ->whereBetween('fecha_prestacion', [$this->fin, $this->fter])
                ->get();
        return view('excel.UMT', compact('data'));
    }
}