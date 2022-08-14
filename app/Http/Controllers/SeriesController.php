<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SerieFormRequest;
use App\Http\Requests\JsonFormRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Serie;


class SeriesController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $user = Auth::user();
        $series = $user->series()->orderBy('name')->get();
        $alerts = $request->session()->get('alerts');
        return view("series.index",compact('series','alerts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("series.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SerieFormRequest $request)
    {
        $user = Auth::user();
        $serie = new Serie();
        $serie->name = $request->name;
        $serie->description = $request->description;
        $serie->user_id = $user->id;
        $serie->save();

        $request->session()->flash('alerts',[['style' => 'success', 'text' => '"'.$serie->name.'" included with success!']]);
        return redirect()->route('series.index'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $serie = Serie::find($request->id);
        $this->usersAutenticator->owner($serie); // verify if the user is owner of product

        $seasons = $serie->seasons()->orderBy('number')->get();
        $alerts = $request->session()->get('alerts');
        return view("series.show", compact('serie','alerts','seasons'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $serie = Serie::find($request->id);
        $this->usersAutenticator->owner($serie);
        return view("series.create", compact('serie'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SerieFormRequest $request)
    {
        $serie = Serie::find($request->id);
        $this->usersAutenticator->owner($serie);
        $serie->name = $request->name;
        $serie->description = $request->description;
        $serie->save();
        $request->session()->flash('alerts',[['style' => 'success', 'text' => '"'.$serie->name.'" edited with success!']]);
        return redirect()->route('series.index'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $serie = Serie::find($request->id);
        $this->usersAutenticator->owner($serie);
        Serie::destroy($request->id);
        $request->session()->flash('alerts',[['style' => 'info', 'text' => 'Serie deleted with success!']]);
        return to_route('series.index'); 
    }

    public function showJson(Request $request)
    {
        $user = Auth::user();
        $series = $user->series()->orderBy('name')->get();
        $alerts = $request->session()->get('alerts');
        $seriesList = [];
        $contSerie = 0;
        foreach($series as $serie){
            $seriesList[$contSerie]['serie'] = $serie->getColumns();
            $seasons = $serie->seasons;
            $contSeason = 0;
            foreach($seasons as $season){
                $seriesList[$contSerie]['seasons'][$contSeason] = $season->getColumns();
                $episodes = $season->episodes;
                foreach($episodes as $episode){
                    $seriesList[$contSerie]['seasons'][$contSeason]['episodes'][] = $episode->getColumns();
                }
                $contSeason++;
            }
            $contSerie++; 
        }
        $jsonList = "";
        if(count($seriesList) > 0){
            $jsonList = json_encode($seriesList);
        }

        $jsonDecode = $request->session()->get('jsonDecode');

        return view("series.json", compact('jsonList','alerts','jsonDecode')); 
    }

    public function decodeJson(JsonFormRequest $request)
    {
        $jsonDecode = json_decode($request->teste_json);
        if(json_last_error()){
            $request->session()->flash('alerts',[['style' => 'danger', 'text' => 'JSON code is invalid!']]);
            $jsonDecode = null;
        } 
        else {
            $request->session()->flash('alerts',[['style' => 'success', 'text' => 'JSON decode with success!']]);
            $request->session()->flash('jsonDecode',$jsonDecode);
        }
        return to_route('series.json'); 
    }
}
