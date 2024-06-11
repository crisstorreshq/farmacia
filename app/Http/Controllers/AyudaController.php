<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Especialidades;
use App\Models\SubEspecia;
use App\Models\SerServicios;
use App\Models\PREPreSERSer;
use App\Models\Lugares;
use App\Models\SERLugSERSer;
use App\Models\SERSubSERPro;
use App\Models\Profesional;
use App\Models\ServiciosSome;
use App\Models\SEREspSERPro;
use App\Models\SERProSERPre;

class AyudaController extends Controller
{
    public function getEspecialidades()
    {
        return Especialidades::selectRaw("rtrim(ltrim(SER_ESP_Codigo)) as codigo, rtrim(ltrim(SER_ESP_Codigo))+' - '+SER_ESP_Descripcio as descripcion")->where("SER_ESP_Vigencia", "S")->get();
    }

    public function getSubEspe($espe, Request $request)
    {
        return SubEspecia::selectRaw("ltrim(rtrim(SER_SUB_Codigo)) as codigo, SER_SUB_Descripcio as descripcion, SER_SUB_Vigencia, SER_ESP_Codigo")
        ->whereRaw("ltrim(rtrim(SER_ESP_Codigo)) = '$espe'")
        ->orderBy('SER_SUB_Codigo', 'asc')
        ->get();
    }

    public function addSubEspe(Request $req)
    {
        $data = new SubEspecia;
        $data->SER_SUB_Codigo = $req['subCod'];
        $data->SER_SUB_Descripcio = $req['nombre'];
        $data->SER_SUB_Vigencia = $req['vigencia'];
        $data->SER_ESP_Codigo = $req['espCod'];
        $data->save();

        $ser = new SerServicios;
        $ser->SER_SER_Codigo = $req['subCod'];
        $ser->SER_SER_Descripcio = $req['nombre'];
        $ser->SER_SER_CodigEspec = $req['espCod'];
        $ser->SER_SER_CodSubEspe = $req['subCod'];
        $ser->SER_SER_Vigencia = 'S';
        $ser->SER_SER_Dotacion = 0;
        $ser->SER_SER_Realiza = '00';
        $ser->SER_SER_Intervalo = 0;
        $ser->SER_SER_Grupo = 0;
        $ser->SER_SER_NroPacientes = 0;
        $ser->SER_SER_NroControl = 0;
        $ser->SER_SER_NroNuevos = 0;
        $ser->SER_SER_Ambito = '01';
        $ser->SER_SER_TiempoDifer = 30;
        $ser->SER_SER_TiempoAsignaHora = 3;
        $ser->SER_SER_TipoHora = 'N';
        $ser->SER_SER_UsaFicha = 'S';
        $ser->SER_SER_UsaSesiones = 'N';
        $ser->SER_SER_Especialidad = NULL;
        $ser->SER_SER_TipoPedAdulto = 'A';
        $ser->SER_SER_Ifl = NULL;
        $ser->SER_SER_Codigo_IEH = NULL;
        $ser->SER_SER_Estado = NULL;
        $ser->SER_ESP_Tipo = 'Aa';
        $ser->SERV = 12;
        $ser->SER_ESP_PrestMinsal = NULL;
        $ser->SER_SER_Sinonimo = $req['nombre'];
        $ser->SER_EsComite = 0;
        $ser->SER_SER_NivelCuidado = NULL;
        $ser->SER_PermiteMultiplesCitas = 0;
        $ser->save();

        $lugar = new PREPreSERSer;
        $lugar->PRE_PRE_Codigo = '0101102';
        $lugar->SER_SER_Codigo = $req['subCod'];
        $lugar->REL_PRE_SER_Cantidad = 1;
        $lugar->REL_PRE_SER_Cr = '00';
        $lugar->save();

        $some = ServiciosSome::updateOrCreate(
            ['SER_SER_Codigo' => $req['subCod']]
        );

        return response("Sub Especialidad guardada con éxito", 200);
    }

    public function updateSubEspe($id, Request $req)
    {
        $codigo = trim($req['codigo']);
        $descri = trim($req['descripcion']);
        $vigencia = trim($req['SER_SUB_Vigencia']);
        $espcod = trim($req['SER_ESP_Codigo']);

        $data = SubEspecia::find($id);
        // $data->SER_SUB_Codigo = $codigo;
        $data->SER_SUB_Descripcio = $descri;
        $data->SER_SUB_Vigencia = $vigencia;
        // $data->SER_ESP_Codigo = $espcod;
        $data->save();

        $dat = SerServicios::find($id);
        // $dat->SER_SER_Codigo = $codigo;
        $dat->SER_SER_Descripcio = $descri;
        // $dat->SER_SER_CodigEspec = $espcod;
        // $dat->SER_SER_CodSubEspe = $codigo;
        $dat->SER_SER_Vigencia = $vigencia;
        $dat->SER_SER_Sinonimo = $descri;
        $dat->save();

        // $lugar = PREPreSERSer::find($id);
        // $lugar->SER_SER_Codigo = $codigo;
        // $lugar->save();

        // $some = ServiciosSome::find($id);
        // $some->SER_SER_Codigo = $codigo;
        // $some->save();

        return response("Sub Especialidad Actualizada con éxito", 200);
    }

    public function getLugares()
    {
        return Lugares::selectRaw("ltrim(rtrim(SER_LUG_Codigo)) as ide, SER_LUG_Descripcio as name")->where('SER_LUG_Vigencia', 'S')->get();
    }

    public function getLugar($codSubEsp)
    {
        return SERLugSERSer::selectRaw("ltrim(rtrim(SER_LUG_Codigo)) as cod_lugar, ltrim(rtrim(SER_SER_Codigo)) as sub_esp")->where('SER_SER_Codigo', $codSubEsp)->get();
    }

    public function getProfesxSub($sub)
    {
        return SERSubSERPro::with('profesional')->where([['SER_SUB_Codigo', $sub], ['NET_Vigencia', 'V']])->get();
    }

    public function addProfe(Request $req)
    {
        Profesional::updateOrCreate(
            ['SER_PRO_Rut' => $req['rut'], 'SER_PRO_Procedencia' => 'INTERNO'],
            ['SER_PRO_Tipo' => '0001', 'SER_PRO_ApellPater' => strtoupper($req['paterno']), 'SER_PRO_ApellMater' => strtoupper($req['materno']), 'SER_PRO_Nombres' => strtoupper($req['nombres']), 'SER_PRO_Estado' => '0001', 'Farmacia' => 'SI', 'SER_PRO_Agenda' => 'S', ]
        );

        SERSubSERPro::updateOrCreate(
            ['SER_PRO_Rut' => $req['rut'], 'SER_SUB_Codigo' => $req['subEsp'], 'SER_ESP_Codigo' => $req['espe']],
            ['NET_Vigencia' => 'V']
        );

        SEREspSERPro::firstOrCreate([
            'SER_ESP_Codigo' => $req['espe'],
            'SER_PRO_Rut' => $req['rut']
        ]);

        SERProSERPre::updateOrCreate(
            ['PRE_PRE_Codigo'=> '0101102', 'SER_PRO_Rut' => $req['rut']],
            ['SER_ESP_Codigo' => null, 'SER_SUB_Codigo' => null]
        );

        return response("Profesional Asociado con éxito", 200);
    }

    public function updateLugar(Request $req)
    {
        if ($req['bool']) 
        {
            $lugar = new SERLugSERSer();
            $lugar->SER_LUG_Codigo = $req['lugar'];
            $lugar->SER_SER_Codigo = $req['sub_esp'];
            $lugar->SER_LUG_TipoLugar = 1;
            $lugar->save();
            return response("Lugar Asociado con éxito", 200);
        } 
            else 
        {
            SERLugSERSer::where([['SER_LUG_Codigo', $req['lugar']],['SER_SER_Codigo', $req['sub_esp']]])->delete();
            return response("Lugar Eliminado con éxito", 200);
        }
    }

    public function deleteProfe(Request $req)
    {
        SERSubSERPro::where([['SER_SUB_Codigo', $req['sub_esp']], ['SER_ESP_Codigo', $req['espe']], ['SER_PRO_Rut', $req['rut_pro']]])->delete();
        return response("Profesional Eliminado con éxito", 200);
    }
}