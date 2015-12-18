</div>


<div class="panel-footer" style="background-color: #ffffff">

    <span style="color: #f20000"><i class="fa fa-heart-o"></i></span>
    <span style="margin-left: 10px; color: #487cff;"><i class="fa fa-comment-o"></i> 0</span>
    {{--<span style="margin-left: 10px; color: #1f62f2"><i class="fa fa-check"></i> Seen</span>--}}

    <div class="pull-right">

        <spam style="margin-right: 10px;">{{$mention->created_at->diffForHumans()}}</spam>

        @if($mention->type == 'text')
            <i class="fa fa-align-justify"></i>
        @elseif($mention->type == 'link')
            <i class="fa fa-external-link"></i>
        @elseif($mention->type == 'photo')
            <i class="fa fa-picture-o"></i>
        @elseif($mention->type == 'video')
            <i class="fa fa-youtube-play"></i>
        @endif

    </div>

</div>
</div>