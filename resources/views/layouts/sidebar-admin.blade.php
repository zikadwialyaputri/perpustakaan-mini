<nav id="sidebar" class="sidebar">
    <div class="sidebar-content">

        <a class="sidebar-brand" href="{{ route('admin.dashboard') }}">
            Perpustakaan Mini
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('admin.dashboard') }}">
                    <i data-feather="home"></i> Dashboard
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('books.index') }}">
                    <i data-feather="book"></i> Kelola Buku
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('admin.categories.index') }}">
                    <i data-feather="layers"></i> Kelola Kategori
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('admin.users.index') }}">
                    <i data-feather="users"></i> Kelola User
                </a>
            </li>
        </ul>

    </div>
</nav>
