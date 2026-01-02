<nav id="sidebar" class="sidebar">
    <div class="sidebar-content">

        <a class="sidebar-brand" href="{{ route('staff.dashboard') }}">
            Perpustakaan Mini
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('staff.dashboard') }}">
                    <i data-feather="home"></i> Dashboard
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('books.index') }}">
                    <i data-feather="book"></i> Daftar Buku
                </a>
            </li>
        </ul>
        <div class="mt-auto p-3">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn btn-danger w-100">
                    Logout
                </button>
            </form>
        </div>

    </div>
</nav>
