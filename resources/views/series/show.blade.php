<x-layout title="Series">
    <x-alerts :alerts="$alerts"></x-alerts>
    <div class="d-flex p-2 justify-content-between">
        <div class="d-flex justify-content-start">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">{{ $serie->name }}</h5>
                    <p class="card-text">{{ $serie->description }}</p>
                    <a href="{{ route('series.edit', $serie->id) }}" class="card-link">Edit</a>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-end">
            <div class="card" style="width: 50rem;">
                <div class="card-body">
                    <a href="{{ route('seasons.create', $serie->id) }}" class="btn btn-primary btn-sm mb-4">New season</a>
                    @foreach($seasons as $season)
                        <br />
                        <li class="list-group-item d-flex justify-content-between mb-2"> 
                            <h5 class="card-title">
                                Season {{ $season->number }} 
                                @if(!is_null($season->name))
                                    - {{ $season->name }}
                                @endif
                            </h5>
                            <group>
                                <form action="{{ route('seasons.destroy',[$season->id, $serie->id]) }}" method="post">
                                    @csrf
                                    <a href="{{ route('episodes.create', $season->id) }}" class="btn btn-dark btn-sm">New episode</a>
                                    <a href="{{ route('seasons.edit', $season->id) }}" class="btn btn-dark btn-sm">...</a>
                                    <button type="submit"  class="btn btn-dark btn-sm">
                                        <x-trash-icon></x-trash-icon>
                                    </button>
                                </form>
                            </group>
                        </li>
                        @foreach($season->episodes()->orderBy('number')->get() as $episode)
                            <li class="list-group-item d-flex justify-content-between mb-2"> 
                                Episode {{ $episode->number }} 
                                @if(!is_null($episode->name))
                                    - {{ $episode->name }}
                                @endif
                                <group>
                                    <form action="{{ route('episodes.destroy', [$episode->id, $serie->id]) }}" method="post">
                                        @csrf
                                        <a href="{{ route('episodes.edit', $episode->id) }}" class="btn btn-light btn-sm">...</a>
                                        <button type="submit"  class="btn btn-light btn-sm">
                                            <x-trash-icon></x-trash-icon>
                                        </button>
                                    </form>
                                </group>
                            </li>
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <br />
    <a href="{{ route('series.index') }}" class="btn btn-secondary">Back</a>
</x-layout>