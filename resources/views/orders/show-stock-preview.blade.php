@if ($candidates->isNotEmpty())

    <h4>{{ trans('title.stock-preview') }}</h4>

    @foreach ($user->products->chunk(2) as $chunk)
        <div class="row">
            @foreach ($chunk as $entry)
                <div class="col-md-6 col-xs-12">
                    <p>
                        <span class="label label-{{ ($entry->pivot->optimal_quantity - $entry->pivot->quantity < 0) ? 'success' : 'warning' }}">{{ $entry->pivot->quantity }}</span>
                        {{ $entry->name }}
                    </p>
                </div>
            @endforeach
        </div>
    @endforeach

@endif
