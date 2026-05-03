<nav style="background:#222; padding:10px; color:white;">
    <div style="display:flex; justify-content:space-between;">
        
        <div>
            <a href="/dashboard" style="color:white; text-decoration:none; font-weight:bold;">
                Dashboard
            </a>
        </div>

        <div>
            {{ Auth::user()->name }}

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" style="background:red; color:white; border:none; padding:5px 10px;">
                     Logout
                </button>
            </form>
        </div>

    </div>
</nav>