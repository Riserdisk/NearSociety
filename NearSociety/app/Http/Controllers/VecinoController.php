<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use illuminate\Support\facades\Auth;
class VecinoController extends Controller
{
    public function index()
    {
        return view('vecinos.index');
    }

    public function create()
    {
        return view('vecinos.create');
    }

    public function show($vecino)
    {
        return view('vecinos.show', ['vecino' => $vecino]);
    }

    public function showLogin()
    {
        return view('login.vecino');
    }

    public function login(Request $request){
        $credentials = $request->only('email','password');
        if(Auth::attempt($credentials)) {
            //Autenticacion exitosa
            return redirect() ->intended(route('MainPage.NS_Home'));
        }
        //Autenticacion fallida
        return back() ->withErrors(['message' => 'Credenciales incorrectas, intente de nuevo.']);
    }
}
