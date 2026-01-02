<nav id="sidebar" class="sidebar">
    <div class="sidebar-content">

        <a class="sidebar-brand" href="{{ route('dashboard') }}">
            Perpustakaan Mini
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-item active">
                <a class="sidebar-link" href="{{ route('dashboard') }}">
                    <i data-feather="book-open"></i>
                    <span>Koleksi Buku</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('login') }}">
                    <i data-feather="log-in"></i>
                    <span>Login</span>
                </a>
            </li>

            <li class="sidebar-header">Tentang</li>

            <li class="sidebar-item">
                <span class="sidebar-link text-muted">
                    Sistem Perpustakaan Mini<br>
                    Versi 1.0
                </span>
            </li>
        </ul>

    </div>
</nav>
