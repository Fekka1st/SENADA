
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-header">Menu</li>
        <li class="nav-item" id="dashboard">
            <a class="nav-link" href={{route('dashboard')}}>
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item" id="data-kerjasama">
            <a class="nav-link" href={{route('kerjasama-lldikti.index')}}>
                <i class="ti-files menu-icon"></i>
                <h5 class="menu-title pt-2">Data Kerja Sama<br>LLDIKTI</h5>
            </a>
        </li>

        {{-- fitur Data Kerja Sama PTS jika diperlukan akan digunakan --}}
        {{-- <li class="nav-item" id="data-pt">
            <a class="nav-link" href="/Data-KerjaSama-pts">
                <i class="ti-bookmark menu-icon"></i>
                <span class="menu-title">Data Kerjasama PTS
                </span>
            </a>
        </li> --}}
        <li class="nav-item" id="kelola-pt">
            <a class="nav-link" href="/kelola-PT">
                <i class="fa-solid fa-graduation-cap"></i>
                <span class="menu-title ml-3">Data Kerja Sama PTS</span>
            </a>
        </li>

        <li class="nav-item" id="kelola-kerma-pemda">
            <a class="nav-link" href="/kelola-kermapemda">
                <i class="fa-solid fa-building-flag"></i>
                <span class="menu-title ml-3">Data Kerja Sama<br>PEMDA</span>
            </a>
        </li>
        <li class="nav-item" id="kerma-pemda-ruang-lingkup">
            <a class="nav-link" href="/kerma-pemda-ruang-lingkup">
                <i class="ti-user menu-icon"></i>
                <span class="menu-title">Data Kerja Sama  <br> PEMDA Ruang Lingkup</span>
            </a>
        </li>
        <li class="nav-item" id="kerma-pemda-pts">
            <a class="nav-link" href="/kelola-kerma-pemda-pts">
                <i class="ti-user menu-icon"></i>
                <span class="menu-title">Data Kerja Sama  <br> PEMDA PTS</span>
            </a>
        </li>

        {{-- Master Data Jika Role 1 Maka Akan Tampil --}}
        @if(Auth()->user()->role == 1)
        <li class="nav-header mt-5">Master Data</li>
        <li class="nav-item" id="kelola-pt">
            <a class="nav-link" href="kelola-jenis-kerjasama">
                <i class="ti-user menu-icon"></i>
                <span class="menu-title">Jenis Kerja Sama</span>
            </a>
        </li>
        <li class="nav-item" id="kelola-pt">
            <a class="nav-link" href="kelola-jenis-mitra">
                <i class="ti-user menu-icon"></i>
                <span class="menu-title">Jenis Mitra</span>
            </a>
        </li>

        <li class="nav-item" id="kelola-pt">
            <a class="nav-link" href="kelola-status-dokument">
                <i class="ti-user menu-icon"></i>
                <span class="menu-title">Status Dokument</span>
            </a>
        </li>
        <li class="nav-item" id="kelola-ruang-lingkup">
            <a class="nav-link" href="kelola-ruang-lingkup">
                <i class="ti-user menu-icon"></i>
                <span class="menu-title">Ruang Lingkup</span>
            </a>
        </li>
        <li class="nav-item" id="manajemen-user">
            <a class="nav-link" href="manajemen-user">
                <i class="ti-user menu-icon"></i>
                <span class="menu-title">Kelola User</span>
            </a>
        </li>
        {{-- <li class="nav-item" id="kelolamaster">
                <a class="nav-link" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                    <i class="ti-user menu-icon"></i>
                    <span class="menu-title">Kelola Data Master</span>
                    <i class="menu-arrow"></i>
                </a>
              <div class="collapse" id="collapseExample">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="kelola-jenis-kerjasama">Jenis Kerja Sama</a></li>
                    <li class="nav-item"><a class="nav-link" href="kelola-jenis-mitra">Jenis Kerja Sama <br> Mitra</a></li>
                    <li class="nav-item"><a class="nav-link" href="kelola-status-dokument">Status Dokument</a></li>
                  </ul>
              </div>
        </li> --}}
        @endif
    </ul>
</nav>

