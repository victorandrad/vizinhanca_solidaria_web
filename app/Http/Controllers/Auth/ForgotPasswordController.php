<?php

namespace App\Http\Controllers\Auth;

use App\Entities\Tutor;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;
    /**
     * @var Tutor
     */
    private $tutor;

    /**
     * Create a new controller instance.
     * @param Tutor $tutor
     */
    public function __construct(Tutor $tutor)
    {
        $this->middleware('guest');
        $this->tutor = $tutor;
    }

}
