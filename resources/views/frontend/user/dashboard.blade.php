@extends('frontend.layouts.master')

@section('content')
	<div class="row">

		<div class="col-md-10 col-md-offset-1">

			<div class="panel panel-default">
				<div class="panel-heading">Dashboard</div>

				<div class="panel-body">
					<div role="tabpanel">

                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">My Information</a></li>
                            <li role="presentation" ><a href="#friends" aria-controls="friends" role="tab" data-toggle="tab">My Friends</a></li>
                            <li role="presentation" ><a href="#requests" aria-controls="requests" role="tab" data-toggle="tab">Friends Requests <span class="badge">{!! count($requests) !!}</span></a></li>
                        </ul>

                        <div class="tab-content">

                            <div role="tabpanel" class="tab-pane active" id="profile">
                                <table class="table table-striped table-hover table-bordered dashboard-table">
                                    <tr>
                                        <th>Name</th>
                                        <td>{!! $user->name !!}</td>
                                    </tr>
                                    <tr>
                                        <th>E-mail</th>
                                        <td>{!! $user->email !!}</td>
                                    </tr>
                                    <tr>
                                        <th>Created At</th>
                                        <td>{!! $user->created_at !!} ({!! $user->created_at->diffForHumans() !!})</td>
                                    </tr>
                                    <tr>
                                        <th>Last Updated</th>
                                        <td>{!! $user->updated_at !!} ({!! $user->updated_at->diffForHumans() !!})</td>
                                    </tr>
                                    <tr>
                                        <th>Actions</th>
                                        <td>
                                            <a href="{!!route('profile.show', $user->id)!!}" class="btn btn-primary btn-xs">View Profile</a>
                                            <a href="{!!route('profile.edit', $user->id)!!}" class="btn btn-primary btn-xs">Edit Information</a>
                                            <a href="{!!url('auth/password/change')!!}" class="btn btn-warning btn-xs">Change Password</a>
                                        </td>
                                    </tr>
                                </table>
                            </div><!--tab panel profile-->

                            <div role="tabpanel" class="tab-pane" id="friends">
                                <table class="table table-striped table-hover table-bordered dashboard-table">
                                    <th>Name</th>
                                    <th>Friends since</th>
                                    <th>Actions</th>
                                    @foreach($friends as $friend)
                                        <tr>
                                            <td><a href="{!!route('profile.show', $friend->id)!!}"> {!! $friend->name !!} </a></td>
                                            <td>{!! $friend->pivot->created_at->diffForHumans() !!}</td>
                                            <td><a href="{!!route('RemoveFriend', $friend->id)!!}" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Remove</a></td>
                                        </tr>

                                    @endforeach
                                </table>
                            </div><!--tab panel friends-->

                            <div role="tabpanel" class="tab-pane" id="requests">
                                <table class="table table-striped table-hover table-bordered dashboard-table">
                                    <th>Name</th>
                                    <th>Sent since</th>
                                    <th>Actions</th>
                                    @foreach($requests as $request)
                                        <tr>
                                            <td><a href="{!!route('profile.show', $request->id)!!}"> {!! $request->name !!} </a></td>
                                            <td>{!! $request->pivot->created_at->diffForHumans() !!}</td>
                                            <td>
                                                <a href="{!!route('AcceptFriend', $request->id)!!}" class="btn btn-success btn-xs">Confirm Friend Request</a>
                                                <a href="{!!route('DeclineFriend', $request->id)!!}" class="btn btn-danger btn-xs">Remove</a>
                                            </td>
                                        </tr>

                                    @endforeach
                                </table>
                            </div><!--tab panel friends-->

                      </div><!--tab content-->

                    </div><!--tab panel-->

				</div><!--panel body-->

			</div><!-- panel -->

		</div><!-- col-md-10 -->

	</div><!-- row -->
@endsection