html <style> .navbar-brand img { height: 100px; } @media (max-width: 991.98px)
 { .navbar-brand img { height: 70px; } } .navbar-nav .nav-item { margin: 0 10px; } 
 .navbar-nav { align-items: center; } .form-inline { align-items: center; } 
 .navbar-brand { display: flex; align-items: center; } </style><header class="header">

    <nav class="nav-container navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid d-flex flex-wrap align-items-center">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('assets/images/logo.png') }}" alt="UBuy & Sell Logo">
            </a>

            @if (request()->routeIs('marketplace.index'))
                <form class="form-inline my-2 my-lg-0 mx-auto" action="{{ route('marketplace.index') }}" method="GET">
                    <input class="form-control mr-sm-2" style="width:160px;height:30px;" type="search" name="search"
                        placeholder="Search..." value="{{ request('search') }}">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit" style="height:30px;">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            @endif

            @auth
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item notification-container">
                        <a class="nav-link" href="#" onclick="toggleNotifications(); return false;">
                            <i class="fas fa-bell" style="font-size: 20px; color: #800000;"></i>
                        </a>
                        <div id="notification-dropdown" class="notification-dropdown" style="display:none; position:absolute; right:0; top:30px; width:300px; background:#800000; color:#fff; border-radius:5px; padding:10px; z-index:10;"></div>
                    </li>
                </ul>
            @endauth

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    @auth
                        @if (auth()->user()->isAdmin())
                            <li class="nav-item"><a class="btn-register" href="{{ route('admin.dashboard') }}">Admin Panel</a></li>
                        @else
                            <li class="nav-item"><a class="btn-register" href="{{ route('profile.show') }}">Profile</a></li>
                        @endif
                        <li class="nav-item"><a class="btn-register" href="{{ route('marketplace.index') }}">Marketplace</a></li>
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn-login" style="border:0;background:none;">Logout</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item"><a class="btn-register" href="{{ route('login') }}">Login</a></li>
                        <li class="nav-item"><a class="btn-login" href="{{ route('register') }}">Register</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
</header>

<script>
    function toggleNotifications() {
        const dropdown = document.getElementById('notification-dropdown');
        if (!dropdown) return;
        if (dropdown.style.display === 'none' || dropdown.style.display === '') {
            fetch('{{ route('notifications.index') }}')
                .then(response => response.json())
                .then(data => {
                    dropdown.innerHTML = '';
                    if (!data.length) {
                        dropdown.innerHTML = '<p>No notifications yet.</p>';
                    }
                    data.forEach(n => {
                        const p = document.createElement('p');
                        p.textContent = n.message || '';
                        dropdown.appendChild(p);
                    });
                    dropdown.style.display = 'block';
                })
                .catch(() => { dropdown.innerHTML = '<p>Could not load notifications.</p>'; dropdown.style.display = 'block'; });
        } else {
            dropdown.style.display = 'none';
        }
    }
</script>
