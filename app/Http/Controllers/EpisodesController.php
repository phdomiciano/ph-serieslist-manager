<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\EpisodeFormRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Season;
use App\Models\Serie;
use App\Models\Episode;

class EpisodesController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $season = Season::find($request->id);
        $this->usersAutenticator->owner($season);
        $serie = $season->serie;
        return view("episodes.create", compact('season','serie'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EpisodeFormRequest $request)
    {
        $season = Season::find($request->season_id);
        $this->usersAutenticator->owner($season);
        $episode = $season->episodes()->create([
            'number' => $request->number,
            'name' => $request->name
        ]);
        $request->session()->flash('alerts',[['style' => 'success', 'text' => 'Episode "'.$episode->number.'" included in Season "'.$season->number.'" with success!']]);
        return redirect()->route('series.show', ['id' => $season->serie_id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    //public function edit($id)
    public function edit(Request $request)
    {
        $episode = Episode::find($request->id);
        $this->usersAutenticator->owner($episode);
        $season = $episode->season;
        $serie = $season->serie;
        return view("episodes.create", compact('episode','season','serie'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(EpisodeFormRequest $request)
    {
        $episode = Episode::find($request->episode_id);
        $this->usersAutenticator->owner($episode);
        $episode->number = $request->number;
        $episode->name = $request->name;
        $episode->save();
        $request->session()->flash('alerts',[['style' => 'success', 'text' => 'Episode "'.$episode->number.'" of Season "'.$episode->season->number.'" edited with success!']]);
        return redirect()->route('series.show',['id' => $episode->season->serie_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $episode = Episode::find($request->id);
        $this->usersAutenticator->owner($episode);
        Episode::destroy($request->id);
        $request->session()->flash('alerts',[['style' => 'info', 'text' => 'Episode deleted with success!']]);
        return to_route('series.show', ['id' => $request->serie_id]); 
    }
}
