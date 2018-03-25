@if ($candidates->isNotEmpty())

    <h4>{{ trans('title.stock-preview') }}</h4>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>{{ trans('label.product') }}</th>
                <th>{{ trans('label.quantity') }}</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($user->products as $entry)
            <?php var_dump($entry->name); var_dump($entry->pivot->quantity); var_dump($entry->pivot->optimal_quantity); ?>
            @if ($entry->pivot->quantity - $entry->pivot->optimal_quantity < 0)
            <tr>
                <td>{{ $entry->name }}</td>
                <td>{{ $entry->pivot->quantity }}</td>
            </tr>
            @endif
        @endforeach
        </tbody>
    </table>

@endif
