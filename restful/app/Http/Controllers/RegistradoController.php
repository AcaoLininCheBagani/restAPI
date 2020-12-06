<?php

namespace App\Http\Controllers;

use App\Registrado;
use Illuminate\Http\Request;

class RegistradoController extends Controller
{
    public function index()
    {
        $record = Registrado::all();

        return response()->json($record);
    }
    public function create(Request $request)
    {
        $record = new Registrado;
        $record->name = $request->name;
        $record->address = $request->address;
        $record->save();

        return response()->json([
            'status' => true,
            'message' =>'Created Successfully!'
        ]);
    }
}
