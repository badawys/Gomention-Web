<div class="panel panel-default">
    <div class="panel-heading">{!! '<a>'.$mention->data['type'] . '</a>'. ' mention from ' . '<a>'. $mention->by_user->name . '</a> to <a>' . $mention->to_user->name . '</a>' !!}</div>

    <div class="panel-body">
        <div class="embed-responsive embed-responsive-16by9">
            <iframe class="embed-responsive-item" src="{{$mention->data['src']}}"></iframe>
        </div>

    </div>
</div>