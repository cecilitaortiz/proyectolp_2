<?php
namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class FoundationController extends Controller
{
    public function index(): JsonResponse
    {
        $file = resource_path('data/foundations.json');

        if (!file_exists($file)) {
            // Ejemplo mínimo
            $foundations = [
                ['id'=>1, 'name'=>'Fundación Verde', 'description'=>'Proyectos de reforestación', 'url'=>'https://fundacionverde.example'],
                ['id'=>2, 'name'=>'Océanos Limpios', 'description'=>'Limpieza de playas y educación', 'url'=>'https://oceanos.example'],
            ];
        } else {
            $foundations = json_decode(file_get_contents($file), true);
        }

        return response()->json(['status'=>'success','data'=>$foundations]);
    }
}
