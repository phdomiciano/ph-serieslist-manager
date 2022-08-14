<x-layout title="Séries">
    <x-alerts :alerts="$alerts"></x-alerts>
    <form name="formJSON" method="post" action="{{ route('series.json-decode') }}">
        @csrf
        <ul class="list-group">
            <li class="list-group-item">
                <div class="form-group">
                    <h4>Series list in JSON format:</h4>
                    <label for="descricao">
                        {{ $jsonList }}
                        @if(!$jsonList)
                            You don't have any Series yet. Create series and return here. =)
                        @endif
                    </label>
                </div>
            </li>
        </ul>
        <ul class="list-group">
            <li class="list-group-item">
                <div class="form-group">
                    <label for="descricao">Decode test</label>
                    <input type="text" class="form-control mb-2" id="teste_json" name="teste_json" placeholder="Enter a JSON value">
                    <button type="submit" class="btn btn-primary">Decode</button>
                    @if(!is_null($jsonDecode))
                    <label for="descricao"><?php var_dump($jsonDecode); ?></label>
                    @endif
                </div>
            </li>
        </ul>
        <br /><br />
        <a href="{{ route('series.index') }}" class="btn btn-secondary">Back</a>
    </form>
</x-layout>



