<nav id="sidebar" class="sidebar">
    <div class="sidebar-content">

        <a class="sidebar-brand" href="{{ route('dashboard') }}">
            Perpustakaan Kata Aksara
        </a>

        <ul class="sidebar-nav">

            <li class="sidebar-item active">
                <a class="sidebar-link" href="{{ route('dashboard') }}">
                    <i class="bi bi-book me-2"></i>
                    Koleksi Buku
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('login') }}">
                    <i class="bi bi-box-arrow-in-right me-2"></i>
                    Login
                </a>
            </li>

            <li class="sidebar-header">
                Tentang
            </li>

            <li class="sidebar-item">
                <span class="sidebar-link text-muted">
                    <i class="bi bi-info-circle me-2"></i>
                    Sistem Perpustakaan Kata Aksara Versi 1.0 <br>
                    Merupakan Hasil Final Project Dari Kelompok 2 Mata Kuliah Bengkel Pemrograman Framework Politeknik Caltex Riau Kelas 2 TI E
                </span>
            </li>

        </ul>

    </div>
</nav>
