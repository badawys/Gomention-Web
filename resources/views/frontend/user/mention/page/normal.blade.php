{{--{{dd($mentions)}}--}}

@extends('frontend.layouts.master')

@section('after-styles-end')
    <link href="{!!asset('css/cards.css')!!}" rel='stylesheet' type='text/css'>

    <style type="text/css">
        #ms-scrollbar::-webkit-scrollbar-track {
            background-color: #eeeeee;
        }
        #ms-scrollbar::-webkit-scrollbar {
            width: 7px;
            background-color: #F5F5F5;
        }
        #ms-scrollbar::-webkit-scrollbar-thumb {
            background-color: #CCCCCC;
            -webkit-box-shadow: inset 0 0 0px rgba(0, 0, 0, 0.3);
        }
        .ms-new {
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.16), 0 2px 10px rgba(0, 0, 0, 0.12);
            background-color: #2196f3;
        }
    </style>
@endsection

@section('left-bar')

    <div class="left-bar" style="background-color: #FFFFFF; width: 500px; height: 100%; position: fixed;width: 270px;box-shadow: 0 1px 7px rgba(0, 0, 0, 0.1);margin-top: -26px;">

        <div class="friends-search" style="padding: 10px; padding-top: 20px; padding-bottom: 20px;">

            <form class="search-form" role="search" style="display: block; text-align: center;">
                <div class="input-group">
                    <span class="input-group-addon search-icon"><i class="fa fa-search"></i></span>
                    <input type="text" class="form-control search-box" placeholder="Find Friends...">
                </div>
                <!-- <button type="submit" class="btn btn-default">Submit</button> -->
            </form>

        </div>

        <div class="list-group friends-left-bar" style="margin-top: 20px; border-radius: 0px;">

            @foreach($friends as $friend)

                <a href="{{route('mentions', $friend->id)}}" class="list-group-item {{ set_active('mentions/'.$friend->id) }}">
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


    <div class="row" style="margin-left: 250px;padding: 20px; z-index: 1;">

        <div class="col-md-12" style="display: flex">

            <div class="panel panel-default lv-message" style="flex: 2; margin-right: 15px;">
                <div class="panel-body" style="padding: 0px;">
                    <ul class="lv-body" id="ms-scrollbar" style="overflow:scroll; overflow-x: hidden; height: 400px; list-style: none; padding: 0; padding-top: 20px;">
                        <li class="lv-item media">
                            <div class="lv-avatar pull-left"> <img src="" alt=""> </div>
                            <div class="media-body">
                                <div class="ms-item"> Praesent nec bibendum leo, at tincidunt sem. </div><small class="ms-date"><span class="glyphicon glyphicon-time"></span>&nbsp; 05/10/2015 at 09:00</small> </div>
                        </li>
                        <li class="lv-item media right">
                            <div class="lv-avatar pull-right"> <img src="" alt=""> </div>
                            <div class="media-body">
                                <div class="ms-item"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. </div><small class="ms-date"><span class="glyphicon glyphicon-time"></span>&nbsp; 05/10/2015 at 09:30</small> </div>
                        </li>
                        <li class="lv-item media right">
                            <div class="lv-avatar pull-right"> <img src="" alt=""> </div>
                            <div class="media-body">
                                <div class="ms-item"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. </div><small class="ms-date"><span class="glyphicon glyphicon-time"></span>&nbsp; 05/10/2015 at 09:30</small> </div>
                        </li>
                        <li class="lv-item media right">
                            <div class="lv-avatar pull-right"> <img src="" alt=""> </div>
                            <div class="media-body">
                                <div class="ms-item"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. </div><small class="ms-date"><span class="glyphicon glyphicon-time"></span>&nbsp; 05/10/2015 at 09:30</small> </div>
                        </li>
                        <li class="lv-item media right">
                            <div class="lv-avatar pull-right"> <img src="" alt=""> </div>
                            <div class="media-body">
                                <div class="ms-item"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. </div><small class="ms-date"><span class="glyphicon glyphicon-time"></span>&nbsp; 05/10/2015 at 09:30</small> </div>
                        </li>
                        <li class="lv-item media right">
                            <div class="lv-avatar pull-right"> <img src="" alt=""> </div>
                            <div class="media-body">
                                <div class="ms-item"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. </div><small class="ms-date"><span class="glyphicon glyphicon-time"></span>&nbsp; 05/10/2015 at 09:30</small> </div>
                        </li>
                        <li class="lv-item media right">
                            <div class="lv-avatar pull-right"> <img src="" alt=""> </div>
                            <div class="media-body">
                                <div class="ms-item"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. </div><small class="ms-date"><span class="glyphicon glyphicon-time"></span>&nbsp; 05/10/2015 at 09:30</small> </div>
                        </li>
                        <li class="lv-item media right">
                            <div class="lv-avatar pull-right"> <img src="" alt=""> </div>
                            <div class="media-body">
                                <div class="ms-item"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. </div><small class="ms-date"><span class="glyphicon glyphicon-time"></span>&nbsp; 05/10/2015 at 09:30</small> </div>
                        </li>
                        <li class="lv-item media right">
                            <div class="lv-avatar pull-right"> <img src="" alt=""> </div>
                            <div class="media-body">
                                <div class="ms-item"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. </div><small class="ms-date"><span class="glyphicon glyphicon-time"></span>&nbsp; 05/10/2015 at 09:30</small> </div>
                        </li>
                        <li class="lv-item media">
                            <div class="lv-avatar pull-left"> <img src="" alt=""> </div>
                            <div class="media-body">
                                <div class="ms-item"> Vivamus congue in nisl eleifend vulputate </div><small class="ms-date"><span class="glyphicon glyphicon-time"></span>&nbsp; 20/02/2015 at 09:33</small> </div>
                        </li>
                        <li class="lv-item media right">
                            <div class="lv-avatar pull-right"> <img src="" alt=""> </div>
                            <div class="media-body">
                                <div class="ms-item"> Phasellus maximus dapibus tincidunt </div><small class="ms-date"><span class="glyphicon glyphicon-time"></span>&nbsp; 05/10/2015 at 10:10</small> </div>
                        </li>
                        <li class="lv-item media">
                            <div class="lv-avatar pull-left"> <img src="" alt=""> </div>
                            <div class="media-body">
                                <div class="ms-item"> uspendisse eu turpis ac lectus convallis porttitor. Fusce nisl velit </div><small class="ms-date"><span class="glyphicon glyphicon-time"></span>&nbsp; 05/10/2015 at 10:24</small> </div>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                    <div class="lv-footer ms-reply">
                        <input type="text" style="width: 100%; height: 39px;" placeholder="Write message..."/>
                        <button class=""><span class="glyphicon glyphicon-send"></span>
                        </button>
                    </div>
                </div>
            </div><!-- panel -->

            <div class="panel panel-default" style="flex: 1;">
                <div class="panel-heading">

                    <div class="dropup" style="padding: 10px 15px 10px 15px;">

                        <span>
                            <img class="img-circle" src="{{url($mention->by_user->picture)}}" style="width: 30px; height: 30px; margin-right: 10px;">
                            <a style="color: #2b2b2b; font-size: 12px;">{{$mention->by_user->name}}</a>
                        </span>


                        <span class="btn btn-link pull-right dropdown-toggle" style="padding: 0px; padding-left: 10px; line-height: inherit; margin-left: 5px;" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <i class="fa  fa-ellipsis-v" style="font-size: 15px; color: #a9a9a9"></i>
                        </span>

                        <ul class="dropdown-menu dropdown-menu-left pull-right" style="margin-top: -15px;" aria-labelledby="dropdownMenu1">
                            {{--<li><a href="#"> <i class="fa fa-thumb-tack"></i> Pin</a></li>--}}
                            {{--<li><a href="#"> <i class="fa fa-retweet"></i> Re-mention</a></li>--}}
                            <li><a href={{$mention->data['url']}}" target='_blank'> <i class="fa fa-external-link"></i> Go to URL</a></li>
                            <li role="separator" class="divider"></li>
                            {{--<li><a href="#"> <i class="fa fa-eye-slash"></i> Hide</a></li>--}}
                            <li><a class="delete-mention" style="cursor: pointer;"> <i class="fa fa-trash-o"></i> Delete</a></li>
                        </ul>

                    </div>

                </div>
                 <div class="panel-body">
                     <div class="{{'card-'.$mention->type }}">

                         @if($mention->type == 'text')
                             @include('frontend.user.mention.page.cards.text', ['mention' => $mention])

                         @elseif($mention->type == 'link')
                             @include('frontend.user.mention.page.cards.link', ['mention' => $mention])

                         @elseif($mention->type == 'photo' )
                             @include('frontend.user.mention.page.cards.photo', ['mention' => $mention])

                         @elseif($mention->type == 'video' )
                             @include('frontend.user.mention.page.cards.video', ['mention' => $mention])

                         @elseif($mention->type == 'sound_cloud' )
                             @include('frontend.user.mention.page.cards.sound', ['mention' => $mention])

                         @endif
                     </div>
                </div>
            </div><!-- panel -->

        </div><!-- col-md-10 -->

    </div>

@endsection

@section('after-scripts-end')

    <script>
        $('#ms-scrollbar').scrollTop($('#ms-scrollbar')[0].scrollHeight)
    </script>

@endsection
