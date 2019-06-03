<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OcorrenciasController extends Controller
{
    use FirebaseConnection;

    public function index()
    {
        $array_notificacao = array();
        $array_keys = array();

        $conta_ocorrencia = $this->firebase()->getDatabase()->getReference('notificacao')->getSnapshot()->numChildren();
        $ocorrencia = $this->firebase()->getDatabase()->getReference('notificacao');

        for ($i = 0; $i < $conta_ocorrencia; $i++) {
            array_push($array_notificacao, $ocorrencia->getChild($ocorrencia->getChildKeys()[$i])->getValue());
            array_push($array_keys, ($ocorrencia->getChildKeys()[$i]));

        }

        return view('ocorrencias')->with([
            'id_ocorrencias' => $array_keys,
            'ocorrencias' => $ocorrencia,
            'contador' => $conta_ocorrencia,

        ]);
    }

    public function detalhes(Request $request)
    {

        $id = $request->input('key-ocorrencia');

        $ocorrencia = $this->firebase()->getDatabase()->getReference('notificacao/')->getChild($id)->getValue();

        return view('detalhe-ocorrencia')->with([
            'remetente' => $ocorrencia['remetente'],
            'data_hora' => $ocorrencia['data_hora'],
            'mensagem' => $ocorrencia['mensagem'],
            'atendimento' => $ocorrencia['atendimento'],
        ]);

    }

}
