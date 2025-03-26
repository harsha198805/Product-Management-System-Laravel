<nav id="sidebar" class="sidebar-wrapper">

	<!-- Sidebar brand start  -->
	<div class="sidebar-brand">
		<a href="{{ route('admin.dashboard') }}" class="logo">
			<img src="{{ URL::to('assets/admin/img/logo.png') }}" alt="System" />
		</a>
	</div>
	<!-- Sidebar brand end  -->

	<!-- Sidebar content start -->
	<div class="sidebar-content">

		<!-- sidebar menu start -->
		<div class="sidebar-menu">
    <ul>
        <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard') }}">
                <i class="icon-devices_other"></i>
                <span class="menu-text">Dashboard</span>
            </a>
        </li>
        <li class="{{ request()->routeIs('categories.index') ? 'active' : '' }}">
            <a href="{{ route('categories.index') }}">
                <i class="icon-grid"></i>
                <span class="menu-text">Category</span>
            </a>
        </li>
        <li class="{{ request()->routeIs('products.index') ? 'active' : '' }}">
            <a href="{{ route('products.index') }}">
                <i class="icon-box"></i>
                <span class="menu-text">Products</span>
            </a>
        </li>
        <li class="{{ request()->routeIs('blogs.index') ? 'active' : '' }}">
            <a href="{{ route('blogs.index') }}">
                <i class="icon-question_answer"></i>
                <span class="menu-text">Blogs</span>
            </a>
        </li>
        <li class="{{ request()->routeIs('profile.show') ? 'active' : '' }}">
            <a href="{{ route('profile.show') }}">
                <i class="icon-user1"></i>
                <span class="menu-text">User Profile</span>
            </a>
        </li>
        <li>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="icon-log-out1"></i>
                <span class="menu-text">Sign Out</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
    </ul>
</div>
		<!-- sidebar menu end -->

	</div>
	<!-- Sidebar content end -->

</nav>