<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit() {
        $usuario = Auth::user();

        $argumentos = array();
        $argumentos['usuario'] = $usuario;

        return view('perfil.edit', $argumentos);
    }

    public function update(Request $request, $id) {
        $usuario = User::find($id);
        if ($usuario) {
            $usuario->name = $request->input('nombre');
            if($request->hasFile('foto')) {
                $archivo = $request->file('foto');
                $nombreArchivo = 'p' . $usuario->id . 
                    time() . $archivo->getClientOriginalName();
                $archivo->
                    storeAs('public',$nombreArchivo);
                $usuario->foto = $nombreArchivo;
            }
            if ($request->input('password') && $request->input('password') != '') {
                $usuario->password = bcrypt($request->input('password'));
            }
            if($usuario->save()) {
                return redirect()->route('perfil.edit')->
                    with('exito','Perfil actualizado');
            }
        }
        return redirect()->route('perfil.edit')->
            with('error','No se pudo actualizar usuario');
    }
}
