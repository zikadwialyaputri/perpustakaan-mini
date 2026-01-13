<nav id="sidebar" class="sidebar">
    <div class="sidebar-content">
        <a class="sidebar-brand" href="{{ route('staff.dashboard') }}">
            Perpustakaan Kata Aksara
        </a>

        <li class="sidebar-item">
            <a class="sidebar-link" href="{{ route('admin.dashboard') }}">
                <i class="bi bi-speedometer2 me-2"></i>
                Dashboard
            </a>
        </li>

        <li class="sidebar-item">
            <a class="sidebar-link" href="{{ route('books.index') }}">
                <i class="bi bi-book me-2"></i>
                Kelola Buku
            </a>
        </li>

        <li class="sidebar-item">
            <a class="sidebar-link" href="{{ route('admin.categories.index') }}">
                <i class="bi bi-tags me-2"></i>
                Kelola Kategori
            </a>
        </li>

        <li class="sidebar-item">
            <a class="sidebar-link" href="{{ route('admin.users.index') }}">
                <i class="bi bi-people me-2"></i>
                Kelola User
            </a>
        </li>

    </div>
</nav>
