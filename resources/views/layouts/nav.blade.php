<div class="container-fluid shadow-lg header">
    <div class="container">
        <div class="p-3 d-flex justify-content-between">
            <h1 class="text-center"><a href="{{ route('home') }}" class="h3 text-white text-decoration-none">Book Review App</a></h1>
            <div class="d-flex gap-5 align-items-center navigation">
                @if (Auth::check())
                    <a href="{{ route('account.showProfile') }}" class="text-white">My Account</a>
                @else    
                <a href="{{ route('account.showLogin') }}" class="text-white">Login</a>
                <a href="{{ route('account.showRegister') }}" class="text-white ps-2">Register</a>
                @endif
            </div>
        </div>
    </div>
</div>