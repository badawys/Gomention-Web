{{--{{dd($mentions)}}--}}

@extends('frontend.layouts.master')

@section('after-styles-end')
    <link href="{!!asset('css/cards.css')!!}" rel='stylesheet' type='text/css'>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" rel='stylesheet' type='text/css'>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" rel='stylesheet' type='text/css'>
@endsection

@section('left-bar')

    <div style="background-color: #FFFFFF; width: 500px; height: 100%; position: fixed;width: 270px;box-shadow: 0 1px 7px rgba(0, 0, 0, 0.1);margin-top: -26px;">

        <div class="friends-search" style="padding: 10px; padding-top: 20px; padding-bottom: 20px;">

            <form class="search-form" role="search" style="display: block; text-align: center;">
                <div class="input-group">
                    <span class="input-group-addon search-icon"><i class="fa fa-search"></i></span>
                    <input type="text" class="form-control search-box" placeholder="Find Friends...">
                </div>
                <!-- <button type="submit" class="btn btn-default">Submit</button> -->
            </form>

        </div>

        <div class="list-group" style="margin-top: 20px; border-radius: 0px;">

            @foreach($friends as $friend)

                <a href="{{route('mentions', $friend->id)}}" class="list-group-item {{ set_active($friend->id) }}">
                    <div class="sidebar-item">
                        <div class="sidebar-item-pic">
                            <span>
                                <img class="img-circle" src="{{url($friend->picture)}}" style="width: 40px; height: 40px; margin-right: 10px;">
                            </span>
                        </div>

                        <div class="sidebar-item-info">
                            <span>
                                {{$friend->name}}
                            </span>
                        </div>
                    </div>
                </a>

            @endforeach
        </div>

    </div>

@endsection

@section('content')

    @if (isset($mentions))

        <div class="row" style="margin-left: 250px; padding: 20px; padding-left: 100px; padding-right: 100px; z-index: 1; padding-top: 0px; margin-top: -26px;">

            <div class="sidebar-item" style="background-color: #fff; border-radius: none; box-shadow: 0 1.5px 15px rgba(0, 0, 0, 0.1);">
                <div class="sidebar-item-pic">
                    <span>
                        <img class="img-circle" src="{{url($selected->picture)}}" style="width: 40px; height: 40px; margin-right: 10px;">
                    </span>
                </div>

                <div class="sidebar-item-info" style="border: none; padding-right: 30px;">
                    <span>
                        {{$selected->name}}
                    </span>
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            All Mentions <span class="caret"></span>
                        </button>
                        {{--<ul class="dropdown-menu">--}}
                            {{--<li><a href="#">Action</a></li>--}}
                            {{--<li><a href="#">Another action</a></li>--}}
                            {{--<li><a href="#">Something else here</a></li>--}}
                            {{--<li role="separator" class="divider"></li>--}}
                            {{--<li><a href="#">Separated link</a></li>--}}
                        {{--</ul>--}}
                    </div>
                </div>
            </div>
        </div>

        <div class="row" style="margin-left: 250px;">
            <div class="col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
                <div class="row">
                    @if(!$mentions->isEmpty())
                        <div id="container" style="display: none;">
                            <ul class="mentions-list">
                                @foreach($mentions as $mention)
                                    <li id="{{$mention->id}}" class="item col-md-4 col-sm-6 col-xs-12" style="list-style: none;   ">
                                        {{--@include('frontend.user.mention.cards.includes.header', ['mention' => $mention])--}}

                                        <div class="panel panel-default">
                                            <div class="panel-body {{'card-body-'.$mention->type }}">
                                                <div class="{{'card-'.$mention->type }}">

                                                    @if($mention->type == 'text')
                                                        @include('frontend.user.mention.cards.text', ['mention' => $mention])

                                                    @elseif($mention->type == 'link')
                                                        @include('frontend.user.mention.cards.link', ['mention' => $mention])

                                                    @elseif($mention->type == 'photo' )
                                                        @include('frontend.user.mention.cards.photo', ['mention' => $mention])

                                                    @elseif($mention->type == 'video' )
                                                        @include('frontend.user.mention.cards.video', ['mention' => $mention])

                                                    @elseif($mention->type == 'sound_cloud' )
                                                        @include('frontend.user.mention.cards.sound', ['mention' => $mention])

                                                    @endif
                                                </div>

                                                @if(isset($mention->data['text']) && $mention->data['text'] != '')
                                                    <div class="mentionText text-{{$mention->type}}">
                                                        <p dir="auto" style="text-align: justify;">{{($mention->data['text'])}}</p>
                                                    </div>
                                                @endif

                                            </div>

                                            <div class="panel-footer" style="background-color: #ffffff; padding: 0; border: none;">

                                                @include('frontend.user.mention.cards.includes.footer', ['mention' => $mention])

                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>

                        </div>

                    @else

                        <div class="row" >

                            <div class="col-md-12">

                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        No mentions to display!
                                    </div>

                                    <div class="panel-body">
                                        Start mentioning {{$selected->name}} to see something here !
                                    </div>
                                </div><!-- panel -->

                            </div><!-- col-md-10 -->

                    @endif

                </div>

                {!! $mentions->render() !!}

            </div><!-- col-md-10 -->

        </div><!-- row -->

        <div class="modal fade" id="delModel" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Delete Mention</h4>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure?</p>
                    </div>
                    <div class="modal-footer">
                        <button id="closeDelete" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button id="doDelete" type="button" class="btn btn-primary">Delete</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

    @else

        <div class="row" style="margin-left: 250px; padding: 20px; padding-left: 100px; padding-right: 100px; z-index: 1; padding-top: 0px; margin-top: -26px;">

            <div class="col-md-10 col-md-offset-1">

                <div class="panel panel-default">
                     <div class="panel-body">
                            Select friend from left sidebar to show mentions!
                    </div>
                </div><!-- panel -->

            </div><!-- col-md-10 -->

    @endif

@endsection

@section('after-scripts-end')

    <script src="https://npmcdn.com/masonry-layout@4.0/dist/masonry.pkgd.min.js"></script>
    <script src="{!!asset('js/imagesloaded.pkgd.min.js')!!}"></script>
    <script src="{!!asset('js/jquery.jscroll.min.js')!!}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.pack.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/autosize.js/3.0.15/autosize.min.js"></script>
    <script src="{!!asset('js/feed.js')!!}"></script>

@endsection
