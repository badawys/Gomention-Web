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
                    @include('frontend.user.mention.cards.includes.header', ['mention' => $mention])
                    @if($mention->data['type'] == 'text')
                        @include('frontend.user.mention.cards.text', ['mention' => $mention])
                    @elseif($mention->data['type'] == 'link')
                        @include('frontend.user.mention.cards.link', ['mention' => $mention])
                    @elseif($mention->data['type'] == 'photo')
                        @include('frontend.user.mention.cards.photo', ['mention' => $mention])
                    @elseif($mention->data['type'] == 'video')
                        @include('frontend.user.mention.cards.video', ['mention' => $mention])
                    @endif
                    @include('frontend.user.mention.cards.includes.footer', ['mention' => $mention])
                </div>
            @endforeach
            </div>

        </div><!-- col-md-10 -->

    </div><!-- row -->
@endsection

@section('after-scripts-end')


    <script>
        docReady( function() {
            var container = document.querySelector('#container');
            var msnry = new Masonry(container, {
                columnWidth: '.item',
                itemSelector: '.item',
                transitionDuration: 0
            });
        });
    </script>
@endsection
