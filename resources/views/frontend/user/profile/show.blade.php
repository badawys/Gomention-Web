@extends('frontend.layouts.master')

@section('content')
    <div class="row">

        <div class="col-md-10 col-md-offset-1">

            <div class="panel panel-default">
                <div class="panel-heading">{!! $user->name !!} Profile</div>

                <div class="panel-body">
                    <div role="tabpanel">

                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Basic Information</a></li>
                        </ul>

                        <div class="tab-content">

                            <div role="tabpanel" class="tab-pane active" id="profile">
                                <table class="table table-striped table-hover table-bordered dashboard-table">
                                    <tr>
                                        <th>Full Name</th>
                                        <td>{!! $user->name !!}</td>
                                    </tr>
                                    <tr>
                                        <th>E-mail</th>
                                        <td>{!! $user->email !!}</td>
                                    </tr>
                                    <tr>
                                        <th>Created At</th>
                                        <td>{!! $user->created_at->diffForHumans() !!}</td>
                                    </tr>
                                    <tr>
                                        <th>Bio</th>
                                        <td>{!! $user->bio !!}</td>
                                    </tr>
                                    @if (Auth::user()->id != $user->id)
                                        <tr>
                                            <th>Actions</th>
                                            <td>
                                                @if ($isFriend)
                                                    <a href="{!!route('RemoveFriend', $user->id)!!}" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Friends</a>
                                                @elseif (!$isAccepted)
                                                    <a href="{!!route('RemoveFriend', $user->id)!!}" class="btn btn-warning btn-xs">Friend Request Sent</a>
                                                @elseif (!$isRequest)
                                                    <a href="{!!route('AcceptFriend', $user->id)!!}" class="btn btn-success btn-xs">Confirm Friend Request</a>
                                                    <a href="{!!route('DeclineFriend', $user->id)!!}" class="btn btn-danger btn-xs">Remove</a>
                                                @else
                                                    <a href="{!!route('AddFriend', $user->id)!!}" class="btn btn-primary btn-xs">Add Friend</a>
                                                @endif

                                            </td>
                                        </tr>
                                    @endif
                                </table>
                            </div><!--tab panel profile-->

                        </div><!--tab content-->

                    </div><!--tab panel-->

                </div><!--panel body-->

            </div><!-- panel -->

        </div><!-- col-md-10 -->

    </div><!-- row -->
@endsection