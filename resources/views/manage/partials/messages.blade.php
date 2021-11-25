@if(session()->has('error'))
<div class="alert alert-danger" role="alert">
    <div class="container">
        <strong><i class="fas fa-exclamation-triangle"></i></strong> {{ session()->get('error') }}
    </div>
</div>
@endif
{{-- @if(session()->has('errors'))
@foreach ($errors->all() as $error)
<div class="alert alert-danger" role="alert">
    <div class="container">
        <strong><i class="fas fa-exclamation-triangle"></i></strong> {{ $error }}
    </div>
</div>
@endforeach
@endif --}}
@if(session()->has('success'))
<div class="alert alert-success" role="alert">
    <div class="container">
        <strong><i class="fas fa-check-circle"></i></strong> {{ session()->get('success') }}
    </div>
</div>
@endif