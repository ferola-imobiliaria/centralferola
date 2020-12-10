<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use TJGazel\Toastr\Facades\Toastr;

class ChangePasswordController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('auth.passwords.change_first_access');
    }

    public function changePassword(Request $request)
    {
        $validatedData = $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if (!(Hash::check($request->get('current_password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()
                ->withErrors("Sua senha atual não corresponde à senha que você forneceu. Por favor, tente novamente.");
        }

        if (strcmp($request->get('current_password'), $request->get('password')) == 0) {
            //Current password and new password are same
            return redirect()->back()
                ->withErrors("Nova senha não pode ser igual à senha atual. Escolha uma senha diferente.");
        }

        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->password);
        $user->password_change = 0;

        if ($user->save()) {
            Toastr::success('No seu próximo acesso utilize a nova senha.', 'Senha alterada com sucesso!', [
                'timeOut' => 10000
            ]);
            return redirect()->route('home');
        } else {
            Toastr::error('Senha não pôde ser alterada. Tente novamente');
            return redirect()->back();
        }
    }
}
