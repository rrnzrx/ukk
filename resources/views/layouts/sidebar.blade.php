<!-- Sidebar -->
<div class="sidebar" style="width: 280px; height: 1024px; background-color: #DFF0D8;">
    <div class="logo-container text-center py-4">
        <img src="/images/logo.png" alt="" class="logo" style="width: 104px; height: 104px;">
    </div>
    <div class="sidebar-menu px-3">

        <aside class="flex-column mt-4">
            <a href="#" class="nav-link py-3 px-3 mb-2 d-flex align-items-center"
                style="color: #01772B; font-weight: 500; background-color: #DFF0D8; border-radius: 8px;"
                onmouseover="this.style.backgroundColor='#B3DCA3'" onmouseout="this.style.backgroundColor='#DFF0D8'">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" class="me-3"
                    xmlns="http://www.w3.org/2000/svg">

                    <path
                        d="M18 7.16C17.94 7.15 17.87 7.15 17.81 7.16C16.43 7.11 15.33 5.98 15.33 4.58C15.33 3.15 16.48 2 17.91 2C19.34 2 20.49 3.16 20.49 4.58C20.48 5.98 19.38 7.11 18 7.16Z"
                        fill="#01772B" />
                    <path
                        d="M16.97 14.4399C18.34 14.6699 19.85 14.4299 20.91 13.7199C22.32 12.7799 22.32 11.2399 20.91 10.2999C19.84 9.58992 18.31 9.34991 16.94 9.58991"
                        fill="#01772B" />
                    <path
                        d="M5.97001 7.16C6.03001 7.15 6.10001 7.15 6.16001 7.16C7.54001 7.11 8.64001 5.98 8.64001 4.58C8.64001 3.15 7.49001 2 6.06001 2C4.63001 2 3.48001 3.16 3.48001 4.58C3.49001 5.98 4.59001 7.11 5.97001 7.16Z"
                        fill="#01772B" />
                    <path
                        d="M7 14.4399C5.63 14.6699 4.12 14.4299 3.06 13.7199C1.65 12.7799 1.65 11.2399 3.06 10.2999C4.13 9.58992 5.66 9.34991 7.03 9.58991"
                        fill="#01772B" />
                    <path
                        d="M12 14.63C11.94 14.62 11.87 14.62 11.81 14.63C10.43 14.58 9.33002 13.45 9.33002 12.05C9.33002 10.62 10.48 9.46997 11.91 9.46997C13.34 9.46997 14.49 10.63 14.49 12.05C14.48 13.45 13.38 14.59 12 14.63Z"
                        fill="#01772B" />
                    <path
                        d="M9.09 17.7799C7.68 18.7199 7.68 20.2599 9.09 21.1999C10.69 22.2699 13.31 22.2699 14.91 21.1999C16.32 20.2599 16.32 18.7199 14.91 17.7799C13.32 16.7199 10.69 16.7199 9.09 17.7799Z"
                        fill="#01772B" />
                </svg>
                Dashboard</a>
            <a href="{{ route('logout') }}" class="nav-link py-3 px-3 d-flex align-items-center mt-auto"
                style="color: #01772B; font-weight: 500; background-color: #DFF0D8; border-radius: 8px;"
                onmouseover="this.style.backgroundColor='#B3DCA3'" onmouseout="this.style.backgroundColor='#DFF0D8'"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" class="me-3"
                    xmlns="http://www.w3.org/2000/svg">

                    <path
                        d="M8.89999 7.55999C9.20999 3.95999 11.06 2.48999 15.11 2.48999H15.24C19.71 2.48999 21.5 4.27999 21.5 8.74999V15.27C21.5 19.74 19.71 21.53 15.24 21.53H15.11C11.09 21.53 9.23999 20.08 8.90999 16.54"
                        fill="#01772B" fill-opacity="0.5" />
                    <path d="M15 12H3.62" stroke="#01772B" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path d="M5.85 8.6499L2.5 11.9999L5.85 15.3499" stroke="#01772B" stroke-width="1.5"
                        stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                Keluar</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style=" display: none;">
                @csrf
            </form>
        </aside>
        {{-- </div> --}}
