<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use App\Models\PrestaKine;

class MedFisicaA28 implements FromView, WithColumnWidths
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
            'A' => 60,
            'T' => 15,
            'U' => 15,
            'V' => 15,
            'W' => 15,
            'X' => 15,
        ];
    }

    public function view(): View
    {
        $datos = PrestaKine::with('paciente')
        ->whereBetween('fecha_ingreso', [$this->fin, $this->fter])
        ->whereNotIn('servicio', [27])
        ->get();

        $filtroEgresos = function ($datos, $id_egreso) {
            return $datos->filter(function ($dato) use ($id_egreso) {
                return $dato->id_egreso === $id_egreso;
            })->groupBy('PAC_PAC_Numero')->map(function ($dato) {
                return $dato->first();
            });
        };

        $filtroDerivacion = function ($datos, $id_derivacion) {
            return $datos->filter(function ($dato) use ($id_derivacion) {
                return $dato->id_derivacion === $id_derivacion;
            })->groupBy('PAC_PAC_Numero')->map(function ($dato) {
                return $dato->first();
            });
        };
        
        $contarServicios = function ($datosFiltrados) {
            $result = [
                'abierta' => $datosFiltrados->filter(function ($dato) {
                    return $dato->servicio === 43;
                })->count(),
                'upc' => $datosFiltrados->filter(function ($dato) {
                    return in_array($dato->servicio, [49, 50, 56, 58, 59]);
                })->count(),
                'cerrado_basico_medio' => $datosFiltrados->filter(function ($dato) {
                    return in_array($dato->servicio, [30, 31, 32, 41, 52, 62, 54]);
                })->count(),
            ];
            $result['totalTipoAtencion'] = $result['abierta'] + $result['upc'] + $result['cerrado_basico_medio'];
            return $result;
        };

        $data = [
            'egresoAlta' => $this->egresoPorEdad($datos, 1),
            'egresoAbandono' => $this->egresoPorEdad($datos, 2),
            'egresoFallecimiento' => $this->egresoPorEdad($datos, 3),
            'egresoAcvAps' => $this->egresoPorEdad($datos, 9),
            'egresoOtro' => $this->egresoPorEdad($datos, 4),
            'evInicialKine' => $this->generatePrestaData($datos, 1),
            'evInicialTO' => $this->generatePrestaData($datos, 52),
            'evInicialFono' => $this->generatePrestaData($datos, 75),
            'evInterKine' => $this->generatePrestaData($datos, 2),
            'evInterTO' => $this->generatePrestaData($datos, 53),
            'evInterFono' => $this->generatePrestaData($datos, 76),
            'RehabKine' => $this->generatePrestaData($datos, 142),
            'RehabTO' => $this->generatePrestaData($datos, 144),
            'RehabFono' => $this->generatePrestaData($datos, 143),
            'derivHosp' => $this->derivacionTotal($datos, 5),
            'derivAmbu' => $this->derivacionTotal($datos, 6),
            'deriAps' => $this->derivacionTotal($datos, 7),
            'deriConv' => $this->derivacionTotal($datos, 8),
        ];

        $data['egresoTipoAtencionAlta'] = $contarServicios($filtroEgresos($datos, 1));
        $data['egresoTipoAtencionAbandono'] = $contarServicios($filtroEgresos($datos, 2));
        $data['egresoTipoAtencionFallecimiento'] = $contarServicios($filtroEgresos($datos, 3));
        $data['egresoTipoAtencionAcvAps'] = $contarServicios($filtroEgresos($datos, 9));
        $data['egresoTipoAtencionOtro'] = $contarServicios($filtroEgresos($datos, 4));

        $prestaciones = [
            'fisioterapia' => [38, 39, 40, 41, 42, 43, 135, 136, 44, 119],
            'actividad física' => [45],
            'ejercicios terapéuticos' => [4, 19],
            'intervención en actividades de la vida diaria, básicas, instrumentales y avanzadas' => [62],
            'habilitación y rehabilitación educacional' => [],
            'actividades terapéuticas' => [64],
            'integración sensorial' => [65],
            'tratamiento compresivo' => [56],
            'habilitación y rehabilitación socio-laboral' => [],
            'adaptación del hogar' => [],
            'confección órtesis y/o adaptaciones' => [61],
            'reparación de órtesis y/o adaptaciones' => [69],
            'confección de prótesis' => [],
            'reparación de prótesis' => [],
            'estimulación cognitiva' => [60, 82],
            'rehabilitación de la voz, habla y/o lenguaje' => [84],
            'rehabilitación de la deglución' => [78],
            'rehabilitación vestibular' => [],
            'educación a usuario/a, cuidador/a y/o familia' => [127, 128, 129, 113],
            'atención psicoterapéutica' => [],
            'orientación y movilidad' => [148],
            'estimulación sensorial' => [137],
            'terapia respiratoria y funcional pulmonar' => [3, 12, 13, 147],
            'rehabilitación auditiva individual' => [],
            'rehabilitación auditiva grupal' => []
        ];
        
        $data['actividades'] = array_map(function ($prestacion) use ($datos) {
            return $datos->filter(function ($dato) use ($prestacion) {
                return in_array($dato->prestacion, $prestacion);
            })->count();
        }, $prestaciones);

        $prestaxTipoAten = [
            1 => 'evInicialKineTipoAtencion',
            52 => 'evInicialTOTipoAtencion',
            75 => 'evInicialFonoTipoAtencion',
            2 => 'evIntermediaKineTipoAtencion',
            53 => 'evIntermediaTOTipoAtencion',
            76 => 'evIntermediaFonoTipoAtencion',
            142 => 'rehabKineTipoAtencion',
            144 => 'rehabTOTipoAtencion',
            143 => 'rehabFonoTipoAtencion'
        ];
        
        $servTipoAten = [
            'abierta' => ['servicio' => 43],
            'upc' => ['servicio' => [49, 50, 56, 58, 59]],
            'cerrado_basico_medio' => ['servicio' => [30, 31, 32, 41, 52, 62, 54]]
        ];
        
        foreach ($prestaxTipoAten as $prestacion => $prestacionKey) {
            $datosFiltrados = $datos->filter(function($dato) use ($prestacion) {
                return $dato->prestacion === $prestacion;
            });
        
            foreach ($servTipoAten as $tipo => $filtro) {
                $data[$prestacionKey][$tipo] = $datosFiltrados->filter(function($dato) use ($filtro) {
                    if (is_array($filtro['servicio'])) {
                        return in_array($dato->servicio, $filtro['servicio']);
                    } else {
                        return $dato->servicio === $filtro['servicio'];
                    }
                })->count();
            }
        }

        $data['actividades']['total'] = array_sum($data['actividades']);

        return view('excel.medFisicaA28', compact('data'));
    }

    function obtenerConteosPorEdad($datos, $id_egreso) 
    {
        return $datos->filter(function ($dato) use ($id_egreso) {
                return $dato->id_egreso === $id_egreso;
            })
            ->groupBy('PAC_PAC_Numero')
            ->map(function ($dato) {
                return $dato->first();
            })
            ->map(function ($item) {
                return $item->paciente->edad_paciente;
            })
            ->groupBy(function ($edad) {
                if ($edad <= 3) {
                    return '0-3';
                } elseif ($edad <= 9) {
                    return '5-9';
                } elseif ($edad <= 14) {
                    return '10-14';
                } elseif ($edad <= 19) {
                    return '15-19';
                } elseif ($edad <= 24) {
                    return '20-24';
                } elseif ($edad <= 29) {
                    return '25-29';
                } elseif ($edad <= 34) {
                    return '30-34';
                } elseif ($edad <= 39) {
                    return '35-39';
                } elseif ($edad <= 44) {
                    return '40-44';
                } elseif ($edad <= 49) {
                    return '45-49';
                } elseif ($edad <= 54) {
                    return '50-54';
                } elseif ($edad <= 59) {
                    return '55-59';
                } elseif ($edad <= 64) {
                    return '60-64';
                } elseif ($edad <= 69) {
                    return '65-69';
                } elseif ($edad <= 74) {
                    return '70-74';
                } elseif ($edad <= 79) {
                    return '75-79';
                } else {
                    return '80-max';
                }
            })
            ->map(function ($grupo) {
                return $grupo->count();
            })
            ->toArray();
    }

    public function egresoPorEdad($datos, $id_egreso)
    {
        $filteredData = $datos->filter(function ($dato) use ($id_egreso) {
            return $dato->id_egreso === $id_egreso;
        })->groupBy('PAC_PAC_Numero')->map(function ($dato) {
            return $dato->first();
        });

        $ageRanges = [
            '0-3', '5-9', '10-14', '15-19', '20-24', '25-29', '30-34', '35-39', '40-44',
            '45-49', '50-54', '55-59', '60-64', '65-69', '70-74', '75-79', '80-max'
        ];

        $ageData = [];

        foreach ($ageRanges as $range) {
            $ageData[$range] = $filteredData->filter(function ($item) use ($range) {
                $ageRangeArray = explode('-', $range);
                $minAge = intval($ageRangeArray[0]);
                $maxAge = $ageRangeArray[1] === 'max' ? PHP_INT_MAX : intval($ageRangeArray[1]);
                return $item->paciente->edad_paciente >= $minAge && $item->paciente->edad_paciente <= $maxAge;
            })->count();
        }

        $ageData['total'] = $filteredData->count();

        return $ageData;
    }

    public function derivacionTotal($datos, $id_egreso)
    {
        $filteredData = $datos->filter(function ($dato) use ($id_egreso) {
            return $dato->id_derivacion === $id_egreso;
        })->groupBy('PAC_PAC_Numero')->map(function ($dato) {
            return $dato->first();
        });

        return $filteredData->count();
    }

    public function generatePrestaData($datos, $prestacion)
    {
        $filteredData = $datos->filter(function ($dato) use ($prestacion) {
            return $dato->prestacion === $prestacion;
        });

        $ageRanges = [
            '0-3', '5-9', '10-14', '15-19', '20-24', '25-29', '30-34', '35-39', '40-44',
            '45-49', '50-54', '55-59', '60-64', '65-69', '70-74', '75-79', '80-max'
        ];

        $ageData = [];

        foreach ($ageRanges as $range) {
            $ageData[$range] = $filteredData->filter(function ($item) use ($range) {
                $ageRangeArray = explode('-', $range);
                $minAge = intval($ageRangeArray[0]);
                $maxAge = $ageRangeArray[1] === 'max' ? PHP_INT_MAX : intval($ageRangeArray[1]);
                return $item->paciente->edad_paciente >= $minAge && $item->paciente->edad_paciente <= $maxAge;
            })->count();
        }

        $ageData['total'] = $filteredData->count();

        return $ageData;
    }
}