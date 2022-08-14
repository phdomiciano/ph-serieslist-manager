<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SeasonFormRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Season;
use App\Models\Serie;

class SeasonsController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $serie = Serie::find($request->id);
        $this->usersAutenticator->owner($serie);
        return view("seasons.create", compact('serie'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SeasonFormRequest $request)
    {
        $serie = Serie::find($request->serie_id);
        $this->usersAutenticator->owner($serie);
        $season = $serie->seasons()->create([
            'number' => $request->number,
            'name' => $request->name
        ]);
        $request->session()->flash('alerts',[['style' => 'success', 'text' => '"'.$season->name.'" included with success!']]);
        return redirect()->route('series.show', ['id' => $serie->id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $season = Season::find($request->id);
        $this->usersAutenticator->owner($season);
        $serie = $season->serie;
        return view("seasons.create", compact('season','serie'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(SeasonFormRequest $request)
    {
        $season = Season::find($request->season_id);
        $this->usersAutenticator->owner($season);
        $season->number = $request->number;
        $season->name = $request->name;
        $season->save();
        $request->session()->flash('alerts',[['style' => 'success', 'text' => '"'.$season->name.'" edited with success!']]);
        return redirect()->route('series.show',['id' => $season->serie->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $season = Season::find($request->id);
        $this->usersAutenticator->owner($season);
        Season::destroy($request->id);
        $request->session()->flash('alerts',[['style' => 'info', 'text' => 'Season deleted with success!']]);
        return to_route('series.show', ['id' => $request->serie_id]); 
    }
}
