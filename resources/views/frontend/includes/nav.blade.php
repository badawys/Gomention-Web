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
                        <li class="hidden-xs"><a href="#" data-toggle="modal" data-target="#myModal">Filter   <i class="fa fa-filter"></i></a></li>
                        <li class="hidden-xs"><a href="#"> <i class="fa fa-plus-circle"></i></a></li>
                        <li class=""><a href="#"><i class="fa fa-bell"></i></a></li>
                        <li class="hidden-xs"><a href="#"><i class="fa fa-cog"></i></a></li>
					@endif
				</ul>
			</div>
		</div>
	</nav>

    <nav id="myNavmenu" class="navmenu navmenu-default navmenu-fixed-left offcanvas" role="navigation">
        <ul class="nav navmenu-nav">
            @if (Auth::guest())
                <li>{!! link_to('auth/login', 'Login') !!}</li>
                <li>{!! link_to('auth/register', 'Register') !!}</li>
            @else
                <li>{!! link_to('dashboard', 'Dashboard') !!}</li>
                <li>{!! link_to_route('profile.show', 'Show Profile' , Auth::user()->id) !!}</li>
                <li>{!! link_to('auth/password/change', 'Change Password') !!}</li>
                @permission('view_admin_link')
                <li role="presentation" class="divider"></li>
                {{-- This can also be @role('Administrator') instead --}}
                <li>{!! link_to_route('backend.dashboard', 'Administration') !!}</li>
                <li>{!! link_to_route('Logs', 'Logs') !!}</li>
                @endpermission
                <li role="presentation" class="divider"></li>
                <li>{!! link_to('auth/logout', 'Logout') !!}</li>
            @endif
        </ul>
    </nav>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                </div>
                <div class="modal-body">
                    Test
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
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