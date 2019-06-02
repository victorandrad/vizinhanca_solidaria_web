<?php

namespace App\Http\Controllers;

use App\Entities\Tutor;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    use FirebaseConnection;
    /**
     * @var Tutor
     */
    private $tutor;

    /**
     * Create a new controller instance.
     *
     * @param Tutor $tutor
     */
    public function __construct(Tutor $tutor)
    {
        $this->middleware('auth');
        $this->tutor = $tutor;
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {

        $conta_usuarios = $this->firebase()->getDatabase()->getReference('usuario')->getSnapshot()->numChildren();
        $usuarios = $this->firebase()->getDatabase()->getReference('usuario');

        $array = array();
        $array_oc = array();

        for ($i = 0; $i < $conta_usuarios; $i++) {
            array_push($array, $usuarios->getChild($usuarios->getChildKeys()[$i])->getValue());
        }

        $oc_resolvidas = 0;
        $oc_n_resolvidas = 0;

        $conta_ocorrencias = $this->firebase()->getDatabase()->getReference('notificacao')->getSnapshot()->numChildren();
        $ocorrencias = $this->firebase()->getDatabase()->getReference('notificacao');
        for ($i = 0; $i < $conta_ocorrencias; $i++) {
            array_push($array_oc, $ocorrencias->getChild($ocorrencias->getChildKeys()[$i])->getValue());
            $data_oc = $ocorrencias->getChild($ocorrencias->getChildKeys()[$i])->getValue();
            if ($data_oc['atendimento'] == true) {
                $oc_resolvidas += 1;
            }
            if ($data_oc['atendimento'] == false) {
                $oc_n_resolvidas += 1;
            }
        }

        return view('home')->with([
            'usuarios_cadastrados' => $conta_usuarios,
            'usuarios' => $array,
            'ocorrencias' => $array_oc,
            'nomes' => Auth::user()->nome,
            'total_ocorrencias' => $conta_ocorrencias,
            'total_nao_resolvidas' => $oc_n_resolvidas,
            'total_resolvidas' => $oc_resolvidas
        ]);

    }
}
