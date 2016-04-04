{{--</div>--}}


{{--<div class="panel-footer" style="background-color: #ffffff">--}}

    <div style="padding: 5px 15px 5px 15px; border-bottom: 1px solid #ddd; height: 34px;">

        @if($mention->to_user->id == Auth::user()->id || ($mention->by_user->id == Auth::user()->id && !$mention->likes->isEmpty()))
            <span
                    class="mention-like {{$mention->by_user->id == Auth::user()->id ? ' ': 'likeToggle'}} {{!$mention->likes->isEmpty()? 'liked ': ' '}}"
                    data-toggle="tooltip" data-placement="top" title="{{!$mention->likes->isEmpty() && $mention->by_user->id == Auth::user()->id ?  $mention->to_user->name . ' likes this!' : ''}}">
                <i class="fa fa-heart"></i>
            </span>
        @endif

		<span href="http://localhost/gomention-web/public/test/ajax" class="mention-comment" style="color: #cacaca;">
			<i class="fa fa-comment"><span style="margin-left: 10px; font-size: 10px;" class="badge">0</span></i>
		</span>

        <span class="pull-right" style="margin-left: 10px;">
            @if($mention->type == 'text')
                <i class="fa fa-align-justify"></i>
            @elseif($mention->type == 'link')
                <i class="fa fa-external-link"></i>
            @elseif($mention->type == 'photo')
                <i class="fa fa-picture-o"></i>
            @elseif($mention->type == 'video')
                <i class="fa fa-youtube-play"></i>
            @endif
        </span>

        <span class="pull-right" style="margin-right:0px; font-size:11px;">{{$mention->created_at->diffForHumans()}}</span>

    </div>



    {{--<span style="margin-left: 10px; color: #1f62f2"><i class="fa fa-check"></i> Seen</span>--}}

    <div class="dropup" style="padding: 10px 15px 10px 15px; {{$mention->by_user->id == Auth::user()->id ? 'background-color: #f6f6f6;' : ''}}">

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

{{--</div>--}}
{{--</div>--}}
