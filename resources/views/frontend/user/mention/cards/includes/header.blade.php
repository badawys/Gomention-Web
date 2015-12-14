<div class="panel panel-default">

    @if($mention->by_user->id == Auth::user()->id)
        <div class="panel-heading">
            <div class="row" style="margin: 0px; line-height: 60px;">
                <div class="dropdown">
                    <span>
                        <img class="img-circle" src="{{asset('img/frontend/ahmad.jpg')}}" style="width: 60px; height: 60px; margin-right: 10px;">
                    </span>

                    <span>
                        <span>
                             <a>You ‎‎</a> <span style="color: #a9a9a9">▶</span> <a>{{$mention->to_user->name}}</a>
                        </span>
                    </span>

                    <span class="btn btn-link pull-right dropdown-toggle" style="padding: 0px; line-height: inherit;" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <i class="fa  fa-ellipsis-v" style="font-size: 20px; color: #a9a9a9"></i>
                    </span>
                    <ul class="dropdown-menu dropdown-menu-right" style="margin-top: -15px;" aria-labelledby="dropdownMenu1">
                        <li><a href="#"> <i class="fa fa-thumb-tack"></i> Pin</a></li>
                        <li><a href="#"> <i class="fa fa-retweet"></i> Re-mention</a></li>
                        <li><a href="#"> <i class="fa fa-external-link"></i> Go to URL</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#"> <i class="fa fa-eye-slash"></i> Hide</a></li>
                        <li><a href="#"> <i class="fa fa-trash-o"></i> Delete</a></li>
                    </ul>
                </div>
            </div>
        </div>
    @else
        <div class="panel-heading">
            <a>{{$mention->by_user->name}}</a>
        </div>
    @endif


    <div class="panel-body {{'card-'.$mention->type }}">