
@extends('common')
@section('content')
<div class="container">
    <ul>
    @foreach ($merchants as $merchant)
        <li>{{ $merchant->Name }}</li>
    @endforeach
    </ul>
</div>

{!! $merchants->render() !!}
@endsection
