<x-layout title="Season of '{{ $serie->name }}'">
    <form name="createSeason" method="post" @if(isset($season)) action="{{ route('seasons.update') }}" @else action="{{ route('seasons.store') }}" @endif >
        @csrf
        <ul class="list-group">
            <li class="list-group-item">
            <div class="form-group">
                <label for="name">Number</label>
                <input type="text" class="form-control mb-2" id="number" placeholder="Number of season" name="number" @isset($season) value="{{$season->number}}" @endisset >
                <label for="descricao">Name</label>
                <input type="text" class="form-control mb-2" id="name" placeholder="Name of season" name="name" @isset($season) value="{{$season->name}}" @endisset >
                @isset($serie)
                    <input type="hidden" id="serie_id" name="serie_id" value="{{$serie->id}}">
                @endisset
                @isset($season)
                    <input type="hidden" id="season_id" name="season_id" value="{{$season->id}}">
                @endisset
            </div>
            </li>
        </ul>
        <br />
        <a href="{{ route('series.show',$serie->id) }}" class="btn btn-secondary">Back</a>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</x-layout>

