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
                <a class="sidebar-link" href="{{ route('staff.books.index') }}">
                    <i data-feather="book"></i> Daftar Buku
                </a>
            </li>
        </ul>
    </div>
</nav>
