<div class="sidebar" data-color="purple" data-image="{{ asset('img/sidebar-1.jpg') }}">
	<!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

        Tip 2: you can also add an image using data-image tag
    -->

	<div class="logo">
		<a href="{{ url('/') }}" class="simple-text">
			<img src="{{ asset('img/logo-small.png') }}" class="img-responsive" width="230">
		</a>
	</div>

	<div class="sidebar-wrapper">
        <ul class="nav">
            <li class="
            @if (Route::current()->uri == 'home')
            active
            @endif
            ">
                <a href="{{ route('home') }}">
                    <i class="material-icons">dashboard</i>
                    <p>Dashboard</p>
                </a>
            </li>
<!--
            <li class="
            @if (Route::current()->uri == 'user')
            active
            @endif
            ">
                <a href="{{ route('user.list') }}">
                    <i class="fa fa-users"></i>
                    <p>Users</p>
                </a>
            </li>
 -->


            <li class="
            @if (Route::current()->uri == 'gallery')
            active
            @endif
            ">
                <a href="{{ route('gallery.list') }}">
                    <i class="fa fa-image"></i>
                    <p>@lang('sidebar.gallery')</p>
                </a>
            </li>

            <li class="
            @if (Route::current()->uri == 'user')
            active
            @endif
            ">
                <a href="{{ route('user.list') }}">
                    <i class="fa fa-calendar"></i>
                    <p>@lang('sidebar.content_schedule')</p>
                </a>
            </li>

            <li class="
            @if (Route::current()->uri == 'user')
            active
            @endif
            ">
                <a href="{{ route('user.list') }}">
                    <i class="fa fa-hourglass-half"></i>
                    <p>@lang('sidebar.shalat_time')</p>
                </a>
            </li>

            <li class="
            @if (Route::current()->uri == 'user')
            active
            @endif
            ">
                <a href="{{ route('user.list') }}">
                    <i class="fa fa-balance-scale"></i>
                    <p>@lang('sidebar.financial_report')</p>
                </a>
            </li>

            <li class="
            @if (Route::current()->uri == 'user')
            active
            @endif
            ">
                <a href="{{ route('user.list') }}">
                    <i class="fa fa-bullhorn"></i>
                    <p>@lang('sidebar.friday_info')</p>
                </a>
            </li>

            <li class="
            @if (Route::current()->uri == 'user')
            active
            @endif
            ">
                <a href="{{ route('user.list') }}">
                    <i class="fa fa-text-width"></i>
                    <p>@lang('sidebar.running_text')</p>
                </a>
            </li>

        </ul>
	</div>
</div>
