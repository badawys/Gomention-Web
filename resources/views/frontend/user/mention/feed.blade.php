@extends('frontend.layouts.master')

@section('content')
    <div class="row">

        <div class="col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
            <div id="container" class="row">
            @foreach($mentions as $mention)
                <div class="item col-md-4 col-sm-6 col-xs-12">
                    @include('frontend.user.mention.cards.includes.header', ['mention' => $mention])
                    @if($mention->type == 'text')
                        @include('frontend.user.mention.cards.text', ['mention' => $mention])
                    @elseif($mention->type == 'link')
                        @include('frontend.user.mention.cards.link', ['mention' => $mention])
                    @elseif($mention->type == 'photo' )
                        @include('frontend.user.mention.cards.photo', ['mention' => $mention])
                    @elseif($mention->type == 'video' )
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

    <script src="http://cdnjs.cloudflare.com/ajax/libs/masonry/3.3.0/masonry.pkgd.js"></script>

    <script>
        $(window).on('load', function(){
            $('#container').masonry({
                // options
                columnWidth: '.item',
                itemSelector: '.item',
                isAnimated: true
            });
        });
    </script>
@endsection
