<x-layout title="Series">
    <x-alerts :alerts="$alerts"></x-alerts>
    <a class="btn btn-primary btn-lg mb-2 btn-sm" href="{{ route('series.create') }}" role="button">New serie</a>
    <a class="btn btn-info btn-lg mb-2 btn-sm" href="{{ route('series.json') }}" role="button">Show JSON</a>
    <ul class="list-group">
        @foreach($series as $serie)
            <li class="list-group-item d-flex justify-content-between">
            <a href="{{ route('series.show', $serie->id) }}" class="alert-link" style="text-decoration:none" role="alert" >
                {{$serie->name}} 
                @isset($serie->seasons)
                    | {{ $serie->seasons->count() }} Seasons
                @endisset
            </a>
                <group>
                    <form action="{{ route('series.destroy',$serie->id) }}" method="post">
                        @csrf
                        <a href="{{ route('series.edit', $serie->id) }}" class="btn btn-primary btn-sm">Edit</a>
                        <button type="submit"  class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </group>
            </li>
        @endforeach
    </ul>
    <br />
</x-layout>

