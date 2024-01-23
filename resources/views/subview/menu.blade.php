<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link {{ request()->is('/', 'home') ? '' : 'collapsed' }}" href="{{ route('home') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        @auth
            <li class="nav-heading">Menu Utama</li>
            @if (auth()->user()->level === 'admin')
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('user') ? '' : 'collapsed' }}" href="{{ route('user.index') }}">
                        <i class="bi bi-person"></i>
                        <span>User</span>
                    </a>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('record') ? '' : 'collapsed' }}" href="{{ route('record.index') }}">
                        <i class="bi bi-journal-medical"></i>
                        <span>Pemeriksaan</span>
                    </a>
                </li><!-- End Pemeriksaan Page Nav -->

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('drug') ? '' : 'collapsed' }}" href="{{ route('drug.index') }}">
                        <i class="bi bi-archive"></i>
                        <span>Obat</span>
                    </a>
                </li><!-- End Obat Page Nav -->

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('retrieval') ? '' : 'collapsed' }}"
                        href="{{ route('retrieval.index') }}">
                        <i class="bi bi-journal-medical"></i>
                        <span>Pengambilan Obat</span>
                    </a>
                </li><!-- End Pengambilan Obat Page Nav -->

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('room') ? '' : 'collapsed' }}" href="{{ route('room.index') }}">
                        <i class="bi bi-clipboard"></i>
                        <span>Pasien di Uks</span>
                    </a>
                </li><!-- End Pasien di Uks Page Nav -->
            @endif
        @endauth
        <!-- End User Page Nav -->


    </ul>
</aside>
