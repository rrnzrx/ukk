<!-- Sidebar -->
<aside class="sidebar" style="width: 280px; background-color: #DFF0D8; height: 100vh; position: fixed;">
    <!-- Logo -->
    <div class="logo-container text-center py-4">
        <img src="/images/logo.png" alt="Logo" class="logo" style="width: 104px; height: 104px;">
    </div>

    <!-- Sidebar Menu -->
    <nav class="px-3">
        <!-- Dashboard Link -->
        <a href="#" class="nav-link d-flex align-items-center py-3 px-3 mb-2 rounded" style="color: #01772B; background-color: #DFF0D8;" onmouseover="this.style.backgroundColor='#B3DCA3'" onmouseout="this.style.backgroundColor='#DFF0D8'">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" class="me-3" xmlns="http://www.w3.org/2000/svg">
                <!-- SVG Paths (Keep as is) -->
            </svg>
            Dashboard
        </a>

        <!-- Logout Link -->
        <a href="{{ route('logout') }}" class="nav-link d-flex align-items-center py-3 px-3 rounded mt-auto" style="color: #01772B; background-color: #DFF0D8;" onmouseover="this.style.backgroundColor='#B3DCA3'" onmouseout="this.style.backgroundColor='#DFF0D8'" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" class="me-3" xmlns="http://www.w3.org/2000/svg">
                <!-- SVG Paths (Keep as is) -->
            </svg>
            Keluar
        </a>

        <!-- Logout Form -->
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </nav>
</aside>