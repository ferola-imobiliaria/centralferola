<?php

namespace App\Http\Controllers;

use App\Informative;
use App\Scopes\InformativesTeamScope;
use App\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use TJGazel\Toastr\Facades\Toastr;

class InformativeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

//        if (Auth::user()->profile === 'admin') {
//            $informatives = Informative::withoutGlobalScope(InformativesTeamScope::class)->get();
//        } else {
//            $informatives = Informative::all();
//
//            $informativesAdm = Informative::withoutGlobalScope(InformativesTeamScope::class)->get();
//
//            // Adicionando os informativos dos administradores na collection 'informative'
//            foreach ($informativesAdm as $informative) {
//                if ($informative->user->profile == 'admin') {
//
//                    $informatives->push($informative);
//                }
//            }
//        }
        $a = Informative::getAllInformativesUser();


//        return view('informatives.index', [
//            'informatives' => $informatives->sortByDesc('updated_at')
//        ]);

        return view('informatives.index', [
            'informatives' => $a
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!(Auth::user()->profile === 'admin' || Auth::user()->profile === 'supervisor')) {
            abort(403);
        }

        return view('informatives.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!(Auth::user()->profile === 'admin' || Auth::user()->profile === 'supervisor')) {
            abort(403);
        }

        if ($request->file('doc')) {
            $docName = Str::slug(pathinfo($request->file('doc')->getClientOriginalName(), PATHINFO_FILENAME));
            $docExtension = pathinfo($request->file('doc')->getClientOriginalName(), PATHINFO_EXTENSION);
            $doc = $request->file('doc')->storeAs('informatives', $docName . '.' . $docExtension);
        }

        $informative = new Informative();
        $informative->title = $request->title;
        $informative->user_id = Auth::id();
        $informative->content = $request->contentInformative;
        $informative->doc = $doc ?? null;
        $informative->published = ($request->published == 'on' ? 1 : 0);

        if ($informative->save()) {
            Toastr::success('<b>Informativo salvo com sucesso!!!</b>');
        } else {
            Toastr::error('<b>Houve um erro para salvar o informativo =(</b>');
        }

        return redirect()->route('informative.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Informative $informative
     * @return \Illuminate\Http\Response
     */
    public function show(Informative $informative)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Informative $informative
     * @return \Illuminate\Http\Response
     */
    public function edit(Informative $informative)
    {
        if (!(Auth::user()->profile === 'admin' || Auth::user()->profile === 'supervisor')) {
            abort(403);
        }

        return view('informatives.edit', [
            'informative' => $informative
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Informative $informative
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Informative $informative)
    {
        if (!(Auth::user()->profile === 'admin' || Auth::user()->profile === 'supervisor')) {
            abort(403);
        }

        $informative->title = $request->title;
        $informative->content = $request->contentInformative;
        if (!is_null($request->file('doc'))) {
            $docName = Str::slug(pathinfo($request->file('doc')->getClientOriginalName(), PATHINFO_FILENAME));
            $docExtension = pathinfo($request->file('doc')->getClientOriginalName(), PATHINFO_EXTENSION);
            $doc = $request->file('doc')->storeAs('informatives', $docName . '.' . $docExtension);
            $informative->doc = $doc;
        }
        $informative->published = ($request->published == 'on' ? 1 : 0);

        if ($informative->save()) {
            Toastr::success('<b>Informativo atualizado com sucesso!!!</b>');
        } else {
            Toastr::error('<b>Houve um erro para atuaizar o informativo =(</b>');
        }

        return redirect()->route('informative.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Informative $informative
     * @return \Illuminate\Http\Response
     */
    public function destroy(Informative $informative)
    {
        if (!(Auth::user()->profile === 'admin' || Auth::user()->profile === 'supervisor')) {
            abort(403);
        }

        $doc_path = 'storage/' . $informative->doc;

        //Verifica se existe um documento no informativo, caso exista, é removido.
        if (File::exists($doc_path)) {
            File::delete($doc_path);
        }

        if ($informative->delete()) {
            Toastr::success('<b>Informativo excluído com sucesso!!!</b>');
        } else {
            Toastr::error('<b>Falha ao excluir informativo. Tente novamente.</b>');
        }

        return redirect()->route('informative.index');
    }

    /**
     * Display all informatives unpublished.
     */
    public function unpublished()
    {
        if (!(Auth::user()->profile === 'admin' || Auth::user()->profile === 'supervisor')) {
            abort(403);
        }

        $informatives = Informative::where('published', 0)->orderBy('updated_at', 'desc')->get();

        return view('informatives.unpublished', [
            'informatives' => $informatives
        ]);
    }
}
