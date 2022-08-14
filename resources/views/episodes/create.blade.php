<x-layout title="Episode of '{{ $serie->name }}' - Season {{ $season->number }}">
    <form name="createEpisode" method="post" @if(isset($episode)) action="{{ route('episodes.update') }}" @else action="{{ route('episodes.store') }}" @endif >
        @csrf
        <ul class="list-group">
            <li class="list-group-item">
            <div class="form-group">
                <label for="name">Number</label>
                <input type="text" class="form-control mb-2" id="number" placeholder="Number of episode" name="number" @isset($episode) value="{{$episode->number}}" @endisset >
                <label for="descricao">Name</label>
                <input type="text" class="form-control mb-2" id="name" placeholder="Name of episode" name="name" @isset($episode) value="{{$episode->name}}" @endisset >
                @isset($season)
                    <input type="hidden" id="season_id" name="season_id" value="{{$season->id}}">
                @endisset
                @isset($episode)
                    <input type="hidden" id="episode_id" name="episode_id" value="{{$episode->id}}">
                @endisset
            </div>
            </li>
        </ul>
        <br />
        <a href="{{ route('series.show',$serie->id) }}" class="btn btn-secondary">Back</a>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</x-layout>

