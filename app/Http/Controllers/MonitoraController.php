<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MonitoraController extends Controller
{
    use FirebaseConnection;

    public function index()
    {
        return view('monitora');
    }

    public function detalhes(Request $request)
    {

        $id = $request->input('key-ocorrencia');

        $ocorrencia = $this->firebase()->getDatabase()->getReference('notificacao/')->getChild($id)->getValue();

        return view('detalhe-monitora')->with([
            'remetente' => $ocorrencia['remetente'],
            'data_hora' => $ocorrencia['data_hora'],
            'mensagem' => $ocorrencia['mensagem'],
            'atendimento' => $ocorrencia['atendimento'],
        ]);

    }

}
