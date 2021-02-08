<?php

namespace App\Http\Controllers;

use App\Repositories\TeamRepository;
use App\Repositories\UserRepository;
use App\Team;
use App\User;
use Illuminate\Http\Request;
use TJGazel\Toastr\Facades\Toastr;

class TeamController extends Controller
{

    private $teamRepository;
    private $userRepository;

    public function __construct(TeamRepository $teamRepository, UserRepository $userRepository)
    {
        $this->middleware('can:is-admin');
        $this->teamRepository = $teamRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('teams.index', [
            'teams' => $this->teamRepository->getTeam(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $realtors = $this->userRepository->getRealtors()->where('profile', '!=', 'supervisor');

        return view('teams.create', [
            'realtors' => $realtors
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $team = Team::create([
            'name' => $request->name,
            'store' => $request->store
        ]);

        if ($team) {
            $user = User::find($request->supervisor);
            $user->team_id = $team->id;
            $user->profile = 'supervisor';

            if ($user->save()) {
                Toastr::success("Nova equipe cadastrada com sucesso!", "Nova equipe criada.");
            }

        } else {
            Toastr::error("Não foi possível cadastrar a nova equipe. Tente novamente.", "Error");
        }

        return redirect()->route('team.index');

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $team = Team::findOrFail($id);
        $teamUpdate = $team->update($request->except(['_token', '_method']));

        if ($teamUpdate) {
            Toastr::success("Equipe alterada com sucesso!");
        } else {
            Toastr::error("Não foi possível realizar as alterações", "Error");
        }

        return redirect()->route('team.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hasUser = User::where('team_id', $id)->count();

        if (!$hasUser) {
            $team = Team::find($id);
            if ($team->delete()) {
                Toastr::success("Equipe <b>$team->name</b> excluída com sucesso!");
            } else {
                Toastr::error("Não foi possível excluir a equipe. Tente novamente.", "Error");
            }
        } else {
            Toastr::error("Não é possível exluir uma equipe que não esteja vazia.", "Error");
        }

        return redirect()->route('team.index');
    }
}
