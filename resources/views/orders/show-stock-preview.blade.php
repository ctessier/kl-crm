<h4>{{ trans('title.stock-preview') }}</h4>

@foreach ($user->getStock()->products->chunk(2) as $chunk)
    <div class="row">
        @foreach ($chunk as $entry)
            <div class="col-md-6 col-xs-12">
                <p>
                    <span class="label label-{{ ($entry->optimalQuantity - $entry->quantity < 0) ? 'success' : (($entry->optimalQuantity - $entry->quantity == 0) ? 'warning' : 'danger') }}">{{ $entry->quantity }}/{{ $entry->optimalQuantity }}</span>
                    {{ $entry->getProduct()->name }}
                </p>
            </div>
        @endforeach
    </div>
@endforeach
