</div>


<div class="panel-footer" style="background-color: #ffffff">

    <span style="color: #f20000"><i class="fa fa-heart"></i></span>
    <span style="margin-left: 10px; color: #487cff;"><i class="fa fa-comment-o"></i> 5</span>

    <div class="pull-right">

        <spam style="margin-right: 10px;">{{$mention->created_at->diffForHumans()}}</spam>

        @if($mention->data['type'] == 'text')
            <i class="fa fa-align-justify"></i>
        @elseif($mention->data['type'] == 'link')
            <i class="fa fa-external-link"></i>
        @elseif($mention->data['type'] == 'photo')
            <i class="fa fa-picture-o"></i>
        @elseif($mention->data['type'] == 'video')
            <i class="fa fa-youtube-play"></i>
        @endif

    </div>

</div>
</div>