<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FavoriteModel;

class FavoriteController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function AllData(){
        $data = FavoriteModel::all();

        if($data->isEmpty()){
            echo json_encode(array(
                "status" => 0,
                "msg" => "Datos no encontrados",
                "data" => []
            ), true);
            return false;

        }
        echo json_encode(array(
            "status" => 1,
            "msg" => "Datos encontrados",
            "data" => $data
        ), true);
    }
    public function store(Request $request){
        $guardado = FavoriteModel::create($request->all());

        if(!$guardado){
            echo json_encode(array(
                "status" => 0,
                "msg" => "El dato no se pudo guardar, recarga la pagina",
            ), true);
            return false;
        }
        echo json_encode(array(
            "status" => 1,
            "msg" => "Datos guardados correctamente",
        ), true);
    }
    public function delete($data)
    {
        $data = FavoriteModel::where('name',$data)->first();
        if ($data == null) {
            return response()->json(['status' => 0,'msg' => "No exite en los favoritos"]);
        }
        $data->delete();
        return response()->json(['status' =>1,'msg' => "recor has been deleteds"]);
    }
}
