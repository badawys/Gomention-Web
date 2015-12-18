@extends('frontend.layouts.master-small')

@section('content')
    <div class="alert alert-danger alert-dismissible" role="alert">
        {!! $error !!}
    </div>
@endsection
