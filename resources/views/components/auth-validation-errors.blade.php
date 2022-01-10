@props(['errors'])

@if ($errors->any())
<div {{ $attributes }}>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {{ __('Whoops! Something went wrong.') }}
    </div>

    <ul class="alert alert-warning alert-dismissible fade show" role="alert">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif