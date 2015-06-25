<div class="panel panel-default">
    <div class="panel-heading">{!! '<a>'.$mention->data['type'] . '</a>'. ' mention from ' . '<a>'. $mention->by_user->name . '</a> to <a>' . $mention->to_user->name . '</a>' !!}</div>

    <div class="panel-body">
        <img style="max-width: 100%" src="{{$mention->data['url']}}">
    </div>
</div>