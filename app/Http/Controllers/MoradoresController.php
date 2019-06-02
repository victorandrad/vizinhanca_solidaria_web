<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MoradoresController extends Controller
{
    use FirebaseConnection;

    public function index()
    {

        $array_moradores = array();
        $array_keys = array();

        $conta_moradores = $this->firebase()->getDatabase()->getReference('usuario')->getSnapshot()->numChildren();
        $moradores = $this->firebase()->getDatabase()->getReference('usuario');

        for ($i = 0; $i < $conta_moradores; $i++) {
            array_push($array_moradores, $moradores->getChild($moradores->getChildKeys()[$i])->getValue());
            array_push($array_keys, ($moradores->getChildKeys()[$i]));
        }

        return view('moradores')->with([
            'id_moradores' => $array_keys,
            'moradores' => $moradores,
            'contador' => $conta_moradores,

        ]);
    }

    public function deleteUser(Request $request)
    {
        $keyUser = $request->input('key-user');

        $moradores = $this->firebase()->getDatabase()->getReference('usuario/' . $keyUser);

        $moradores->remove();

        $this->firebase()->getAuth()->deleteUser($keyUser);

    }

}
