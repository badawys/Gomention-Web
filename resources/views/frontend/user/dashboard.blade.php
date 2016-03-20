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
                                            <a href="#" data-toggle="modal" data-target="#myModal" class="btn btn-success btn-xs">Add Mention Button</a>
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

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add mention button to your browser</h4>
                </div>
                <div class="modal-body">
                    <p>
                        To mention your friends, you need to drag "MENTION" button to your browser's bookmarks bar. Jsut that easy, drag it and Gomention ;)
                    </p>
                    <a type="button" class="btn btn-primary" style="margin: 0 auto; display: block; width: 150px;" href="javascript: ((function() {    if (window.location.protocol != 'http:' && window.location.protocol != 'https:') {        alert('This page cannot be mentioned.');        return;    }    var url = 'http://alpha-tests.gomention.com/mention-this?url=' + encodeURIComponent(window.location.href);    window.open(url,'Mention This','width=420, height=470');})())">Mention</a>
                    <ul style="font-size: 10px;margin-top: 40px;padding-top: 10px;border-top: 1px solid #ddd;">
                        <li>
                            To show your bookmarks bar: click (Ctrl+Shift+B) in most browsers.
                        </li>
                        <li>
                            To show your bookmarks bar in firefox:
                            <ul style="list-style: decimal; font-size: 9px;">
                                <li>
                                    Click the menu button and choose Customize.
                                </li>
                                <li>
                                    Click the Show / Hide Toolbars dropdown menu at the bottom of the screen and choose the items you want to display.
                                </li>
                                <li>
                                    Click the green Exit Customize button.
                                </li>
                            </ul>
                        </li>
                        <li>
                            Tested in: (Chrome 47+) (Firefox 42+)
                        </li><li>
                            Microsoft Edge is not supported.
                        </li>
                    </ul>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
@endsection