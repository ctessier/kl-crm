@if (session('success'))
<div class="callout callout-success">
    {{ session('success') }}
</div>
@endif

@if (session('status'))
    <div class="callout callout-success">
        {{ session('status') }}
    </div>
@endif
