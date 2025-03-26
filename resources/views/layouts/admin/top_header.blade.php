<header class="header">
	<div class="toggle-btns">
		<a id="toggle-sidebar" href="#">
			<i class="icon-list"></i>
		</a>
		<a id="pin-sidebar" href="#">
			<i class="icon-list"></i>
		</a>
	</div>
	<div class="header-items">

		<!-- Header actions start -->
		<ul class="header-actions">
			<li class="dropdown">
				<a href="#" id="userSettings" class="user-settings" data-toggle="dropdown" aria-haspopup="true">
					<span class="user-name">{{ Auth::user()->name ??'' }}</span>
					<span class="avatar">
						<img src="{{ URL::to( Auth::user()->image != null ? '/uploads/user_image/' . Auth::user()->image : 'assets/admin/img/user-default.png') }}" alt="avatar">
						<span class="status busy"></span>
					</span>
				</a>
				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="userSettings">
					<div class="header-profile-actions">
						<div class="header-user-profile">
							<div class="header-user">
								<img src="{{ URL::to( Auth::user()->image != null ? '/uploads/user_image/' . Auth::user()->image : 'assets/admin/img/user-default.png') }}" alt="avatar">
							</div>
							<h5>{{ Auth::user()->name ??'' }}</h5>
							<p>Admin</p>
						</div>
						<a href="{{ route('profile.show') }}"><i class="icon-user1"></i> My Profile</a>
						<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
						<i class="icon-log-out1"></i> Sign Out
						</a>

						<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
							@csrf
						</form>
					</div>
				</div>
			</li>
		</ul>
		<!-- Header actions end -->
	</div>
</header>

<div class="page-header">
	<ol class="breadcrumb">
		@foreach(getBreadcrumbs() as $breadcrumb)
            @if($loop->last)
                <li class="breadcrumb-item active" aria-current="page">{{ $breadcrumb['label'] }}</li>
            @else
                <li class="breadcrumb-item"><a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['label'] }}</a></li>
            @endif
        @endforeach
	</ol>
</div>