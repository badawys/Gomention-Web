@extends('frontend.layouts.master')

@section('content')
    <div class="row">

        <div class="col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
            <div id="container" class="row">
                <ul class="mentions-list">
                    @foreach($mentions as $mention)
                        <li class="item col-md-4 col-sm-6 col-xs-12" style="list-style: none;   ">
                            @include('frontend.user.mention.cards.includes.header', ['mention' => $mention])

                            @if(isset($mention->data['text']) && $mention->data['text'] != '')
                                <div class="mentionText">
                                    <p>{{($mention->data['text'])}}</p>
                                </div>
                            @endif

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
                        </li>
                    @endforeach
                </ul>

            </div>

            {!! $mentions->render() !!}

        </div><!-- col-md-10 -->

    </div><!-- row -->
@endsection

@section('after-scripts-end')

    <script src="http://cdnjs.cloudflare.com/ajax/libs/masonry/3.3.0/masonry.pkgd.js"></script>
    <script src="{!!asset('js/jquery.jscroll.min.js')!!}"></script>

    <script>

        //Hide pagination
        $('ul.pagination:visible:first').hide();

        $(window).on('load', function(){

            $('#container').masonry({
                // options
                columnWidth: '.item',
                itemSelector: '.item',
                isAnimated: true
            });

            $('.mentions-list').infinitescroll({
                navSelector  : ".pagination",
                nextSelector : ".pagination li.active + li > a",
                itemSelector : ".item",
                debug        : false

            },function(arrayOfNewElems){

                $('#container')
                        .append(arrayOfNewElems)
                        .masonry('appended',arrayOfNewElems)
                        .masonry();
            });

        });
    </script>
@endsection
