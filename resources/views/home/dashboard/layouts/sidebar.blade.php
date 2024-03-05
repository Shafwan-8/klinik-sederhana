<!-- ====================================
    ——— LEFT SIDEBAR WITH OUT FOOTER
===================================== -->
<aside class="left-sidebar bg-sidebar d-print-none">
    <div id="sidebar" class="sidebar sidebar-with-footer">
        <!-- Aplication Brand -->
        <div class="app-brand">
            <a href="/dashboard" title="Klinik Dashboard">
                <img src="{{ asset('img/trika.png') }}" alt="Trika Media Solusindo" height="35" width="37"
                    class="rounded-circle brand-icon" viewBox="0 0 50 50">
                <span class="brand-name text-truncate">Trika Klinik</span>
            </a>
        </div>

            <!-- sidebar menu -->
            <div style="">
                <ul class="nav sidebar-inner" id="sidebar-menu">
                    <li
                        class="has-sub expand {{ $active === 'dashboard' ? 'active' : '' }}">
                        <a class="sidenav-item-link" href="/dashboard"
                            aria-controls="dashboard">
                            <i class="mdi mdi-view-dashboard-outline"></i>
                            <span class="nav-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="{{ $active === 'patient' ? 'active' : '' }}">
                        <a class="sidenav-item-link" href="{{ route('patient.index') }}">
                            <i class="mdi mdi-human-handsdown"></i>
                            <span class="nav-text">Pasien</span>
                        </a>
                    </li>
                    <li class="{{ $active === 'pemeriksaan' ? 'active' : '' }}">
                        <a class="sidenav-item-link" href="{{ route('pemeriksaan.index') }}">
                            <i class="mdi mdi-clipboard-text-outline"></i>
                            <span class="nav-text">Pemeriksaan</span>
                        </a>
                    </li>
                    <li
                        class="has-sub {{ $active === 'laporan' || $active === 'diagnosa' || $active === 'layanan' || $active === 'transaksi' || $active === 'suratDokter' || $active === 'suratSehat' || $active === 'suratButaWarna' ? 'active' : '' }}">
                        <a class="sidenav-item-link" href="" data-toggle="collapse" data-target="#laporan"
                            aria-expanded="false" aria-controls="laporan">
                            <i class="mdi mdi-printer"></i>
                            <span class="nav-text">Laporan</span> <b class="caret"></b>
                        </a>
                        <ul class="collapse {{ $active === 'laporan' || $active === 'diagnosa' || $active === 'layanan' || $active === 'transaksi' || $active === 'suratDokter' || $active === 'suratSehat' || $active === 'suratButaWarna' ? 'show' : '' }}"
                            id="laporan" data-parent="#sidebar-menu">
                            <div class="sub-menu">
                                <li class="{{ $active === 'diagnosa' ? 'active' : '' }}">
                                    <a class="sidenav-item-link" href="{{ route('report.diagnosis') }}">
                                        <span class="nav-text">Diagnosa</span>
                                    </a>
                                </li>
                                <li class="{{ $active === 'layanan' ? 'active' : '' }}">
                                    <a class="sidenav-item-link" href="{{ route('report.service') }}">
                                        <span class="nav-text">Layanan</span>
                                    </a>
                                </li>
                                <li class="{{ $active === 'transaksi' ? 'active' : '' }}">
                                    <a class="sidenav-item-link" href="{{ route('report.transaction') }}">
                                        <span class="nav-text">Jumlah Transaksi</span>
                                    </a>
                                </li>
                                <li
                                    class="has-sub {{ $active === 'suratDokter' || $active === 'suratSehat' || $active === 'suratButaWarna' ? 'active' : '' }}">
                                    <a href="" class="sidenav-item-link" data-toggle="collapse"
                                        data-target="#surat" aria-expanded="false" aria-controls="surat">
                                        <span class="nav-text">Surat</span> <b class="caret"></b>
                                    </a>
                                    <ul class="collapse {{ $active === 'suratDokter' || $active === 'suratSehat' || $active === 'suratButaWarna' ? 'show' : '' }}"
                                        id="surat">
                                        <div class="sub-menu">
                                            <li class="{{ $active === 'suratDokter' ? 'active' : '' }}">
                                                <a href="{{ route('keterangan-dokter.index') }}" class="sidenav-item-link">
                                                    <span class="nav-text">Keterangan Dokter</span">
                                                </a>
                                            </li>
                                            <li class="{{ $active === 'suratSehat' ? 'active' : '' }}">
                                                <a href="{{ route('keterangan-sehat.index') }}" class="sidenav-item-link">
                                                    <span class="nav-text">Keterangan Sehat</span">
                                                </a>
                                            </li>
                                            <li class="{{ $active === 'suratButaWarna' ? 'active' : '' }}">
                                                <a href="{{ route('keterangan-buta-warna.index') }}" class="sidenav-item-link">
                                                    <span class="nav-text">Keterangan Buta Warna</span">
                                                </a>
                                            </li>
                                        </div>
                                    </ul>
                                </li>
                            </div>
                        </ul>
                    </li>
                    <li
                        class="has-sub {{ $active === 'master' || $active === 'icdx' || $active === 'services' ? 'active' : '' }}">
                        <a class="sidenav-item-link" href="" data-toggle="collapse" data-target="#master"
                            aria-expanded="false" aria-controls="master">
                            <i class="mdi mdi-database"></i>
                            <span class="nav-text">Master</span> <b class="caret"></b>
                        </a>
                        <ul class="collapse {{ $active === 'master' || $active === 'icdx' || $active === 'services' || $active === 'pengguna' || $active === 'dokter' ? 'show' : '' }}"
                            id="master" data-parent="#sidebar-menu">
                            <div class="sub-menu">
                                <li class="{{ $active === 'pengguna' ? 'active' : '' }}">
                                    <a class="sidenav-item-link" href="{{ route('pengguna.index') }}">
                                        <span class="nav-text mx-2">Pengguna</span>
                                    </a>
                                </li>
                                <li class="{{ $active === 'dokter' ? 'active' : '' }}">
                                    <a class="sidenav-item-link" href="{{ route('dokter.index') }}">
                                        <span class="nav-text mx-2">Dokter</span>
                                    </a>
                                </li>
                                <li class="{{ $active === 'icdx' ? 'active' : '' }}">
                                    <a class="sidenav-item-link" href="{{ route('icdx.index') }}">
                                        <span class="nav-text mx-2">Icdx</span>
                                    </a>
                                </li>
                                <li class="{{ $active === 'services' ? 'active' : '' }}">
                                    <a class="sidenav-item-link" href="{{ route('layanan.index') }}">
                                        <span class="nav-text mx-2">Layanan</span>
                                    </a>
                                </li>
                            </div>
                        </ul>
                    </li>
                    <li
                        class="has-sub {{ $active === 'graph-diagnosis' || $active === 'graph-service' || $active === 'graph-transaction' ? 'active' : '' }}">
                        <a class="sidenav-item-link" href="" data-toggle="collapse" data-target="#grafik"
                            aria-expanded="true" aria-controls="grafik">
                            <i class="mdi mdi-chart-bar"></i>
                            <span class="nav-text">Grafik</span> <b class="caret"></b>
                        </a>
                        <ul class="collapse {{ $active === 'graph-diagnosis' || $active === 'graph-service' || $active === 'graph-transaction' ? 'show' : '' }}"
                            id="grafik" data-parent="#sidebar-menu">
                            <div class="sub-menu">
                                <li class="{{ $active === 'graph-diagnosis' ? 'active' : '' }}">
                                    <a class="sidenav-item-link" href="{{ route('grafik.diagnosa') }}">
                                        <span class="nav-text mx-2">Diagnosa</span>
                                    </a>
                                </li>
                                <li class="{{ $active === 'graph-service' ? 'active' : '' }}">
                                    <a class="sidenav-item-link" href="{{ route('grafik.layanan') }}">
                                        <span class="nav-text mx-2">Layanan</span>
                                    </a>
                                </li>
                                <li class="{{ $active === 'graph-transaction' ? 'active' : '' }}">
                                    <a class="sidenav-item-link" href="{{ route('grafik.transaksi') }}">
                                        <span class="nav-text mx-2">Jumlah Transaksi</span>
                                    </a>
                                </li>
                            </div>
                        </ul>
                    </li>
                </ul>
            </div>
    </div>
</aside>
