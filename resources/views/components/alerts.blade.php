@isset($alerts)
    @foreach($alerts as $alert)
        <div class="alert alert-{{ $alert['style'] }}" role="alert">
            {{ $alert['text'] }}
        </div>
    @endforeach
@endisset