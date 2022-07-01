<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Scopes\UserEditScope;
use App\Team;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use TJGazel\Toastr\Facades\Toastr;

class UserController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();

        $teste = User::join('teams', 'teams.id', '=', 'users.team_id')
            ->get('*');

        if ($user->profile === 'admin') {
            $users = User::join('teams', 'teams.id', '=', 'users.team_id')
                ->orderBy('name_short', 'asc')
                ->get('*');
        } else if ($user->profile === 'supervisor') {
            //Pega os times do supervisor
            $supervisorTeam = $user->team;
            $usersTeam = $supervisorTeam->users;

            $users = array();

            foreach ($usersTeam as $user) {
                array_push($users, $user);
            }
        }

        return view('users.index', [
            'users' => $users
        ]);
    }


    /**
     * Formulário para edição de usuário
     * @param User $user
     */
    public function edit(User $user)
    {
        $this->policies($user);

        // Verifica se quem está edita é admin, se for, o select de equipe exibirá todas as equipes
        // Se não for admin, será um supervisor, então, o select só irá exibir as equipes do supervisor logado
        if (Auth::user()->profile === 'admin') {
            $teams = Team::all();
        }

        return view('users.edit', [
            'user' => $user,
            'teams' => $teams ?? null
        ]);
    }


    /**
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserRequest $request, User $user)
    {
        $this->policies($user);

        $user->name = $request->name;
        $user->name_short = $request->name_short;
        $user->email = $request->email;
        $user->cpf = $request->cpf;
        $user->creci = $request->creci;
        $user->phone = $request->phone;
        if (!is_null($request->file('photo'))) {
            $user->photo = $request->file('photo')
                ->storeAs('profiles_pictures', Str::slug($user->name) . '-' .
                    str_replace('.', '', microtime(true)) . '.' .
                    $request->file('photo')->extension());
        }
        $user->team_id = $request->realtor_team == null ? $user->team_id : $request->realtor_team;
        $user->save();

        Toastr::success('Suas informações foram alteradas com sucesso.');

        return redirect()->back();
    }


    /**
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        $this->policies($user);

        if (($user->profile === 'supervisor') && ($user->team->users->count() > 1)) {
            Toastr::error("<b>{$user->name}</b> é supervisor da equipe <b>{$user->team->name}</b>. Para excluí-lo é necessário que a equipe não tenha mais nenhum corretor.",
                null, ['timeOut' => 15000]);
        } else {
            if ($user->delete()) {
                Toastr::success("O usuário <b>{$user->name_short}</b> foi excluído com sucesso");
            }
        }

        return redirect()->route('user.index');
    }


    /**
     * Exibição dos usuários excluídos (que estão na lixeira)
     */
    public function trashed()
    {
        $user = Auth::user();

        if ($user->profile === 'admin') {
            $usersTrashed = User::onlyTrashed()->get();
        } else if ($user->profile === 'supervisor') {
            //Pega os times do supervisor
            $supervisorTeam = $user->team;

            $usersTrashed = array();

            foreach ($supervisorTeam->users()->withTrashed()->get() as $member) {
                if ($member->trashed()) {
                    array_push($usersTrashed, $member);
                }
            }
        }

        return view('users.trash', [
            'usersTrashed' => $usersTrashed
        ]);
    }


    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($uuid)
    {
        $user = User::onlyTrashed()->where('uuid', $uuid)->first();

        $this->policies($user);

        // Verifica se realmente o usuário está na lixeira
        if ($user->trashed()) {
            $user->restore();
            Toastr::success("O usuário <b>{$user->name_short}</b> foi restaurado.");
        } else {
            Toastr::error("A restauração do usuário não pode ser realizada.");
        }

        return redirect()->route('user.trashed');
    }


    /**
     * @param string $uuid
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyPermanently($uuid)
    {
        $user = User::onlyTrashed()->where('uuid', $uuid)->first();

        $this->policies($user);

        if ($user->trashed()) {
            $user->forceDelete();
            Toastr::success("O usuário <b>{$user->name_short}</b> foi excluído permanentemente do sistema.");
        } else {
            Toastr::error("A exclusão definitiva do usuário não pode ser realizada.");
        }

        return redirect()->route('user.trashed');
    }

    public function changePasswordForm()
    {
        return view('auth.passwords.change');
    }

    public function changePassword(Request $request, User $user)
    {
        if (Auth::user()->uuid != $user->uuid) {
            abort(401);
        }

        $current_pass = $request->current_pass;
        $new_pass = $request->new_pass;
        $confirm_pass = $request->check_pass;

        if (!(empty($current_pass) && empty($new_pass) && empty($confirm_pass))) {
            if (Hash::check($current_pass, $user->password) && ($new_pass === $confirm_pass)) {
                $user->password = Hash::make($new_pass);
            } else {
                Toastr::error('A senha atual e/ou a confirmação da nova senha estão incorretos.');
                return redirect()->back();
            }
        }

        if ($user->save()) {
            Toastr::success('Sua senha foi alterada com sucesso.');
        }

        return redirect()->route('user.change.password.form');
    }

    /**
     * @param User $user
     */
    private function policies(User $user): void
    {
        $userLogged = Auth::user();

        if ($userLogged->profile === 'supervisor') {
            if ($userLogged->team->id !== $user->team->id) {
                abort(403);
            }
        } elseif (($userLogged->profile !== 'admin') && ($userLogged->uuid !== $user->uuid)) {
            abort(403);
        }
    }
}
