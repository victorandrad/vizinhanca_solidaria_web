<?php

namespace App\Http\Controllers;

use App\Mail\RegistroUsuarioMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class NovoMoradorController extends Controller
{
    use FirebaseConnection;


    /**
     * NovoMoradorController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('novomorador')->with([
            'nomes' => Auth::user()->nome
        ]);
    }

    public function add(Request $request)
    {

        $nome = $request->input('nome');
        $email = $request->input('email');
        $celular = $request->input('celular');
        $cep = $request->input('cep');
        $endereco = $request->input('endereco');
        $bairro = $request->input('bairro');
        $numero = $request->input('numero');
        $complemento = $request->input('complemento');
        $cidade = $request->input('cidade');
        $uf = $request->input('uf');

        $auto_password = $this->generateRandomString(6);

        $uid_new_user = $this->firebase()->getAuth()->createUserWithEmailAndPassword($email, $auto_password)->uid;

        $database = $this->firebase()->getDatabase();
        $db = $database->getReference('usuario')->getChild($uid_new_user);

        $db->set([
            "bairro" => $bairro,
            "celular" => $celular,
            "cep" => $cep,
            "cidade" => $cidade,
            "complemento" => $complemento,
            "endereco" => $endereco,
            "estado" => $uf,
            "nome" => $nome,
            "numero" => $numero,
            "token_firebase" => ''
        ]);

        $this->sendMail($nome, $email, $auto_password);

        return view('novomorador');

    }

    function sendMail($nome, $email, $senha)
    {
        Mail::send(new RegistroUsuarioMail($nome, $email, $senha));
    }

    function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
