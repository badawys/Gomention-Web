@extends('frontend.layouts.master-small')

@section('content')

    <div class="row-fluid">

        <div class="col-xs-12 col-lg-12 col-md-12 col-sm-12">


            @foreach($mentionTypes as $type)
                @if($type == 'link')
                    <a href="{{route('mention.this.settings',[$type, $id])}}" class="btn btn-primary btn-block" style="margin-bottom: 15px;">Link</a>
                @endif

                @if($type == 'photo')
                    <a href="{{route('mention.this.settings',[$type, $id])}}" class="btn btn-primary btn-block" style="margin-bottom: 15px;">Photo</a>
                @endif

                @if($type == 'video')
                    <a href="{{route('mention.this.settings',[$type, $id])}}" class="btn btn-primary btn-block" style="margin-bottom: 15px;">Video</a>
                @endif

                @if($type == 'article')
                    <a href="{{route('mention.this.settings',[$type, $id])}}" class="btn btn-primary btn-block" style="margin-bottom: 15px;" >Article</a>
                @endif
            @endforeach

        </div>
    </div>

@endsection
