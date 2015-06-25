</div>


<div class="panel-footer" style="background-color: #ffffff">
    @if($mention->data['type'] == 'text')
        <i class="fa "></i>
    @elseif($mention->data['type'] == 'link')
        <i class="fa "></i>
    @elseif($mention->data['type'] == 'photo')
        <i class="fa fa-picture-o"></i>
    @elseif($mention->data['type'] == 'video')
        <i class="fa "></i>
    @endif

    <div class="pull-right">
        {{$mention->created_at->diffForHumans()}}
    </div>

</div>
</div>