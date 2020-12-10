<?php

namespace App\Http\Controllers;

use App\Repositories\TeamRepository;
use App\Team;
use App\User;
use Illuminate\Http\Request;
use TJGazel\Toastr\Facades\Toastr;

class TeamController extends Controller
{

    private $teamRepository;

    public function __construct(TeamRepository $teamRepository)
    {
        $this->middleware('can:is-admin');
        $this->teamRepository = $teamRepository;
    }

    public function index()
    {
        return view('teams.index', [
            'teams' => $this->teamRepository->getTeam(),
        ]);
    }

    public function update(Request $request, Team $team)
    {

        $teamUpdate = $team->update($request->except(['_token', '_method']));

        if ($teamUpdate) {
            Toastr::success("Equipe alterada com sucesso!");
        } else {
            Toastr::error("Não foi possível realizar as alterações", "Error");
        }

        return redirect()->route('team.index');
    }
}
