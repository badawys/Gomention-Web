@extends('frontend.layouts.master')

@section('after-styles-end')
    <script src="http://cdnjs.cloudflare.com/ajax/libs/masonry/3.3.0/masonry.pkgd.js"></script>
@endsection

@section('content')
    <div class="row">

        <div class="col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
            <div id="container" class="row">
            @foreach($mentions as $mention)
                <div class="item col-md-4 col-sm-6 col-xs-12">
                    @if($mention->data['type'] == 'text')
                        @include('frontend.user.mention.cards.text', ['mention' => $mention])
                    @elseif($mention->data['type'] == 'link')
                        @include('frontend.user.mention.cards.link', ['mention' => $mention])
                    @elseif($mention->data['type'] == 'photo')
                        @include('frontend.user.mention.cards.photo', ['mention' => $mention])
                    @elseif($mention->data['type'] == 'video')
                        @include('frontend.user.mention.cards.video', ['mention' => $mention])
                    @endif
                </div>
            @endforeach
            </div>

            {{--<div id="container" class="row">--}}

                {{--<div class="item col-md-4 col-sm-6 col-xs-12">--}}
                    {{--<div class="panel panel-default" style="height: 250px;">--}}
                        {{--<div class="panel-heading">Mention</div>--}}

                        {{--<div class="panel-body"></div>--}}
                    {{--</div>--}}
                {{--</div>--}}

                {{--<div class="item col-md-4 col-sm-6 col-xs-12">--}}
                    {{--<div class=" panel panel-default" style="height: 200px;">--}}
                        {{--<div class="panel-heading">Mention</div>--}}

                        {{--<div class="panel-body"></div>--}}
                    {{--</div>--}}
                {{--</div>--}}

                {{--<div class="item col-md-4 col-sm-6 col-xs-12">--}}
                    {{--<div class=" panel panel-default" style="height: 270px;">--}}
                        {{--<div class="panel-heading">Mention</div>--}}

                        {{--<div class="panel-body"></div>--}}
                    {{--</div>--}}
                {{--</div>--}}

                {{--<div class="item col-md-4 col-sm-6 col-xs-12">--}}
                    {{--<div class=" panel panel-default" style="height: 195px;">--}}
                        {{--<div class="panel-heading">Mention</div>--}}

                        {{--<div class="panel-body"></div>--}}
                    {{--</div>--}}
                {{--</div>--}}

                {{--<div class="item col-md-4 col-sm-6 col-xs-12">--}}
                    {{--<div class=" panel panel-default" style="height: 180px;">--}}
                        {{--<div class="panel-heading">Mention</div>--}}

                        {{--<div class="panel-body"></div>--}}
                    {{--</div>--}}
                {{--</div>--}}

                {{--<div class="item col-md-4 col-sm-6 col-xs-12">--}}
                    {{--<div class=" panel panel-default" style="height: 220px;">--}}
                        {{--<div class="panel-heading">Mention</div>--}}

                        {{--<div class="panel-body"></div>--}}
                    {{--</div>--}}
                {{--</div>--}}

                {{--<div class="item col-md-4 col-sm-6 col-xs-12">--}}
                    {{--<div class=" panel panel-default" style="height: 152px;">--}}
                        {{--<div class="panel-heading">Mention</div>--}}

                        {{--<div class="panel-body"></div>--}}
                    {{--</div>--}}
                {{--</div>--}}

                {{--<div class="item col-md-4 col-sm-6 col-xs-12">--}}
                    {{--<div class=" panel panel-default" style="height: 160px;">--}}
                        {{--<div class="panel-heading">Mention</div>--}}

                        {{--<div class="panel-body"></div>--}}
                    {{--</div>--}}
                {{--</div>--}}

                {{--<div class="item col-md-4 col-sm-6 col-xs-12">--}}
                    {{--<div class=" panel panel-default" style="height: 135px;">--}}
                        {{--<div class="panel-heading">Mention</div>--}}

                        {{--<div class="panel-body"></div>--}}
                    {{--</div>--}}
                {{--</div>--}}

                {{--<div class="item col-md-4 col-sm-6 col-xs-12">--}}
                    {{--<div class=" panel panel-default" style="height: 140px;">--}}
                        {{--<div class="panel-heading">Mention</div>--}}

                        {{--<div class="panel-body"></div>--}}
                    {{--</div>--}}
                {{--</div>--}}

                {{--<div class="item col-md-4 col-sm-6 col-xs-12">--}}
                    {{--<div class=" panel panel-default" style="height: 190px;">--}}
                        {{--<div class="panel-heading">Mention</div>--}}

                        {{--<div class="panel-body"></div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}

        </div><!-- col-md-10 -->

    </div><!-- row -->
@endsection

@section('after-scripts-end')
    <script>
        var container = document.querySelector('#container');
        var msnry = new Masonry( container, {
            columnWidth: '.item',
            itemSelector: '.item',
            transitionDuration: 0
        });
    </script>
@endsection
