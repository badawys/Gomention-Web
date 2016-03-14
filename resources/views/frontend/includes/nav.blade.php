    <nav class="navbar navbar-inverse navbar-fixed-top custom-navbar">
		<div class="container">

			<div class="navbar-header" style="left:0; width: 100%; position: absolute;">

                <button style="margin-left: 10px;" type="button" class="navbar-toggle" data-toggle="offcanvas" data-target="#myNavmenu" data-canvas="false">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <ul class="nav navbar-nav navbar-left hidden-xs">
                    <li data-toggle="offcanvas" data-target="#myNavmenu" data-canvas="false"><a href="#" ><i class="fa fa-bars"></i></a></li>
                    <li><a href="{!!url('/')!!}"><i class="fa fa-home"></i>  Home</a></li>
                </ul>

				<div class="navbar-brand" style="width: 100%; margin-top: -50px;" >
                    <a style="width: 20px;" href="{!!url('/')!!}">
                        <img style=" padding-left: 10px; display: block; margin: 0 auto; height: 25px;" alt="Brand" src="{!!asset('img/frontend/logo.jpg')!!}">
                    </a>
                </div>
			</div>

			<div class="" >

				<ul class="nav navbar-nav navbar-right">
					@if (Auth::guest())
						<li>{!! link_to('auth/login', 'Login') !!}</li>
						<li>{!! link_to('auth/register', 'Register') !!}</li>
					@else
                        <li class="hidden-xs"><a href="#" ><i class="fa fa-filter"></i></a></li>
                        <li class="hidden-xs"><a href="#" data-toggle="modal" data-target="#myModal"> <i class="fa fa-plus-circle"></i></a></li>
                        <li class=""><a href="#"><i class="fa fa-bell"></i></a></li>
                        <li class="hidden-xs"><a href="#"><i class="fa fa-cog"></i></a></li>
					@endif
				</ul>
			</div>
		</div>
	</nav>

    {{--<nav id="myNavmenu" class="navmenu navmenu-default navmenu-fixed-left offcanvas" role="navigation">--}}
        {{--<ul class="nav navmenu-nav">--}}
            {{--@if (Auth::guest())--}}
                {{--<li>{!! link_to('auth/login', 'Login') !!}</li>--}}
                {{--<li>{!! link_to('auth/register', 'Register') !!}</li>--}}
            {{--@else--}}
                {{--<li>{!! link_to('dashboard', 'Dashboard') !!}</li>--}}
                {{--<li>{!! link_to_route('profile.show', 'Show Profile' , Auth::user()->id) !!}</li>--}}
                {{--<li>{!! link_to('auth/password/change', 'Change Password') !!}</li>--}}
                {{--@permission('view_admin_link')--}}
                {{--<li role="presentation" class="divider"></li>--}}
                {{-- This can also be @role('Administrator') instead --}}
                {{--<li>{!! link_to_route('backend.dashboard', 'Administration') !!}</li>--}}
                {{--<li>{!! link_to_route('Logs', 'Logs') !!}</li>--}}
                {{--@endpermission--}}
                {{--<li role="presentation" class="divider"></li>--}}
                {{--<li>{!! link_to('auth/logout', 'Logout') !!}</li>--}}
            {{--@endif--}}
        {{--</ul>--}}
    {{--</nav>--}}

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

    <script>
        $('#myNavmenu').on("show.bs.offcanvas", function() {
            var overlay = $('<div id="overlay"> </div>');
            overlay.appendTo(document.body);
        });
        $('#myNavmenu').on("hide.bs.offcanvas", function() {
            $("#overlay").remove();
        });
    </script>