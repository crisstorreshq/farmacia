<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class ListaEspera extends Controller
{
    public function index(Request $req)
    {
        $data = DB::table('PCA_Agenda as a')
        ->select(
            'a.PCA_AGE_CodigServi',
            'a.PCA_AGE_FechaCitac',
            'a.PCA_AGE_HoraCitac',
            'pac.PAC_PAC_Rut',
            'c.PAC_CAR_NumerFicha',
            DB::raw("pac.PAC_PAC_Nombre +' '+ pac.PAC_PAC_ApellPater +' '+ pac.PAC_PAC_ApellMater as nombre_paciente"),
            DB::raw("(SELECT top 1 SER_PRO_Nombres + ' ' + SER_PRO_ApellPater + ' ' + SER_PRO_ApellMater FROM SER_Profesiona WHERE SER_PRO_Rut = a.PCA_AGE_CodigProfe AND SER_PRO_Estado = '0001' AND SER_PRO_Procedencia = 'INTERNO') as nombre_profesional"),
            'a.PCA_AGE_DescripicionDiag',
            'PCA_AGE_CodigRecep',
            DB::raw("su.Segu_Usr_Nombre +' '+ su.Segu_Usr_ApellidoPaterno +' '+ su.Segu_Usr_ApellidoMaterno as nombre_quienda"),
        )
        ->leftJoin('PAC_Paciente as pac', 'pac.PAC_PAC_Numero', '=', 'a.PCA_AGE_NumerPacie')
        ->leftJoin('PAC_Carpeta as c', 'c.PAC_PAC_Numero', '=', 'pac.PAC_PAC_Numero')
        ->leftJoin('Segu_Usuarios as su', 'su.Segu_Usr_Cuenta', '=', 'a.PCA_AGE_CodigRecep')
        ->where('a.PCA_AGE_CodigServi', $req->codigo)
        ->orderBy('a.PCA_AGE_FechaCitac')
        ->get();

        $eventos = [];

        foreach ($data as $registro) {
            // Formatea la fecha y hora explícitamente
            $fechaCitac = date('Y-m-d', strtotime($registro->PCA_AGE_FechaCitac));
            $horaCitac = date('H:i:s', strtotime($registro->PCA_AGE_HoraCitac));

            $horaFin = date('Y-m-d H:i:s', strtotime("$fechaCitac $horaCitac +15 minutes"));
        
            $evento = [
                'id' => uniqid(), // Genera un ID único para cada evento
                'title' => $registro->nombre_paciente,
                'start' => date('Y-m-d\TH:i:s', strtotime("$fechaCitac $horaCitac")),
                'end' => date('Y-m-d\TH:i:s', strtotime($horaFin)),
                'descripcion' => $registro->PCA_AGE_DescripicionDiag,
                'profesional' => $registro->nombre_profesional,
                'quien_da' => $registro->PCA_AGE_CodigRecep,
                'nombre_quien_da' => $registro->nombre_quienda
                // Puedes añadir más propiedades aquí si lo deseas
            ];
        
            array_push($eventos, $evento);
        }
        
        return $eventos;
    }

    public function show($id)
    {
        if ($id !== null && $id !== 'null') {
            $fecha = Carbon::createFromFormat('Y-m', $id);
        } else {
            $fecha = Carbon::now();
        }
        
        $primerDia = $fecha->startOfMonth()->format('Y-m-d');
        $ultimoDia = $fecha->endOfMonth()->format('Y-m-d');

        $arrayEsp = ['0056-02', '0057-03', 'POL-LEE', 'POL-ILE', 'POL-LEM', 'POL-OLE', 'POL-LEP', 'POL-FLE', 'POL-RLE', 'POL-LEO', '0004-04', '0063-01', '0063-01', '0001-27', '0064-02', '0010-02', '0039-03', '0012-07', '0014-12', '0002-22', '0002-23', '0003-13', '0008-05', '0001-50', '0005-05', '0016-07'];

        $especialidades = array(
            array('id' => '0056-02', 'name' => 'BRONCOPULMONAR LE'),
            array('id' => '0057-03', 'name' => 'CARDIOLOGIA LE'),
            array('id' => 'POL-LEE', 'name' => 'DENTAL ENDODONCIA LE'),
            array('id' => 'POL-ILE', 'name' => 'DENTAL IMPLANTOLOGIA LE'),
            array('id' => 'POL-LEM', 'name' => 'DENTAL MAXILOFASCIAL LE'),
            array('id' => 'POL-OLE', 'name' => 'DENTAL ORTODONCIA LE'),
            array('id' => 'POL-LEP', 'name' => 'DENTAL PERIODONCIA LE'),
            array('id' => 'POL-FLE', 'name' => 'DENTAL REHAB ORAL FIJA LE'),
            array('id' => 'POL-RLE', 'name' => 'DENTAL REHAB ORAL REMOV LE'),
            array('id' => 'POL-LEO', 'name' => 'DENTAL ODONTOPEDIATRIA LE'),
            array('id' => '0004-04', 'name' => 'DERMATOLOGIA LE'),
            array('id' => '0063-01', 'name' => 'ENDOCRINOLOGIA LE'),
            array('id' => '0063-01', 'name' => 'GASTROENTEROLOGÍA ADULTO LE'),
            array('id' => '0001-27', 'name' => 'MEDICINA LE'),
            array('id' => '0064-02', 'name' => 'NEFROLOGIA LE'),
            array('id' => '0010-02', 'name' => 'NEU-NEUROLOGIA LE'),
            array('id' => '0039-03', 'name' => 'NEUROCIRUGIA LE'),
            array('id' => '0012-07', 'name' => 'OFTALMOLOGÍA LE'),
            array('id' => '0014-12', 'name' => 'OTORRINO LE'),
            array('id' => '0002-22', 'name' => 'PED-NEUROLOGIA LE'),
            array('id' => '0002-23', 'name' => 'PED-PEDIATRIA GENERAL LE'),
            array('id' => '0003-13', 'name' => 'POLI CIRUGIA GENERAL LE'),
            array('id' => '0008-05', 'name' => 'POLI GINECOLOGIA LE'),
            array('id' => '0001-50', 'name' => 'REUMATOLOGIA LE'),
            array('id' => '0005-05', 'name' => 'TRAUMATOLOGIA LE'),
            array('id' => '0016-07', 'name' => 'UROLOGIA LE')
        );

        $data = DB::table('PCA_Agenda')
        ->select(
            'PCA_AGE_CodigServi',
            'PCA_AGE_FechaCitac',
            DB::raw('COUNT(*) as total_citas'),
            DB::raw('SUM(CASE WHEN PCA_AGE_NumerPacie = \'0.0\' THEN 1 ELSE 0 END) as cantidad_citas_cero'),
            DB::raw('SUM(CASE WHEN PCA_AGE_NumerPacie <> \'0.0\' THEN 1 ELSE 0 END) as cantidad_citas')
        )
        ->whereBetween('PCA_AGE_FechaCitac', [$primerDia, $ultimoDia])
        ->whereIn('PCA_AGE_CodigServi', $arrayEsp)
        ->groupBy('PCA_AGE_CodigServi', 'PCA_AGE_FechaCitac')
        ->orderBy('PCA_AGE_FechaCitac')
        ->orderBy('PCA_AGE_CodigServi')
        ->get();

        foreach ($data as &$item) {
            foreach ($especialidades as $especialidad) {
                if ($especialidad['id'] === $item->PCA_AGE_CodigServi) {
                    $item->especialidadName = $especialidad['name'];
                    $item->id = uniqid();
                    break;
                }
            }
        }

        return $data;
    }
}