<x-layout title="Series">
    <form name="createSerie" method="post" @if(isset($serie)) action="{{ route('series.update') }}" @else action="{{ route('series.store') }}" @endif >
        @csrf
        <ul class="list-group">
            <li class="list-group-item">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control mb-2" id="name" placeholder="Name of serie" name="name" @isset($serie) value="{{$serie->name}}" @endisset >
                <label for="descricao">Description</label>
                <input type="text" class="form-control mb-2" id="description" placeholder="Description of serie" name="description" @isset($serie) value="{{$serie->description}}" @endisset >
                @isset($serie)
                    <input type="hidden" id="id" name="id" value="{{$serie->id}}">
                @endisset
            </div>
            </li>
        </ul>
        <br />
        <a href="{{ route('series.index') }}" class="btn btn-secondary">Back</a>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</x-layout>

