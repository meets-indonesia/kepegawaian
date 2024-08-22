  @php
    $settings = array('unit-kerja', 'fakultas', 'jurusan', 'program-studi', 'kelompok-pegawai', 'jenis-pegawai');

    $referensi = array('golongan', 'struktur', 'gaji-pokok', 'jabatan-struktural', 'jabatan-fungsional', 'grade', 'pendidikan', 'hukuman-disiplin', 'lokasi-kerja', 'eselon');

    $access = array('roles', 'user');

    $collapseSetting = 'collapse';
    $collapsedSetting = 'collapsed';

    $collapseReferensi = 'collapse';
    $collapsedReferensi = 'collapsed';

    $collapseAccess = 'collapse';
    $collapsedAccess = 'collapsed';

    $namepage = '';

    if(isset($pagename)) {
      $namepage = $pagename;
    }

    if(in_array($namepage, $settings)){
      $collapseSetting = 'collapse show';
      $collapsedSetting = '';
    }

    if(in_array($namepage, $referensi)){
      $collapseReferensi = 'collapse show';
      $collapsedReferensi = '';
    }

    if(in_array($namepage, $access)){
      $collapseAccess = 'collapse show';
      $collapsedAccess = '';
    }
  @endphp
  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="/dashboard">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="/pegawai">
          <i class="bi bi-person"></i>
          <span>Pegawai</span>
        </a>
      </li><!-- End Pegawai Page Nav -->

      <li class="nav-item">
        <a class="nav-link {{$collapsedSetting}}" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Settings</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content {{$collapseSetting}} " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/unit-kerja">
              <i class="bi bi-circle"></i><span>Unit Kerja</span>
            </a>
          </li>
          <li>
            <a href="/fakultas">
              <i class="bi bi-circle"></i><span>Fakultas</span>
            </a>
          </li>
          <li>
            <a href="/jurusan">
              <i class="bi bi-circle"></i><span>Jurusan</span>
            </a>
          </li>
          <li>
            <a href="/program-studi">
              <i class="bi bi-circle"></i><span>Program Studi</span>
            </a>
          </li>
          <li>
            <a href="/kelompok-pegawai">
              <i class="bi bi-circle"></i><span>Kelompok Pegawai</span>
            </a>
          </li>
          <li>
            <a href="/jenis-pegawai">
              <i class="bi bi-circle"></i><span>Jenis Pegawai</span>
            </a>
          </li>
        </ul>
      </li><!-- End Settings Nav -->

      <li class="nav-item">
        <a class="nav-link {{$collapsedReferensi}}" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Referensi</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content {{$collapseReferensi}} " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/golongan">
              <i class="bi bi-circle"></i><span>Golongan</span>
            </a>
          </li>
          <li>
            <a href="/struktur">
              <i class="bi bi-circle"></i><span>Struktur</span>
            </a>
          </li>
          <li>
            <a href="/gaji-pokok">
              <i class="bi bi-circle"></i><span>Gaji Pokok</span>
            </a>
          </li>
          <li>
            <a href="/jabatan-struktural">
              <i class="bi bi-circle"></i><span>Jabatan Struktural</span>
            </a>
          </li>
          <li>
            <a href="/jabatan-fungsional">
              <i class="bi bi-circle"></i><span>Jabatan Fungsional</span>
            </a>
          </li>
          <li>
            <a href="/grade">
              <i class="bi bi-circle"></i><span>Grade</span>
            </a>
          </li>
          <li>
            <a href="/pendidikan">
              <i class="bi bi-circle"></i><span>Pendidikan</span>
            </a>
          </li>
          <li>
            <a href="/hukuman-disiplin">
              <i class="bi bi-circle"></i><span>Hukuman Disiplin</span>
            </a>
          </li>
          <li>
            <a href="/lokasi-kerja">
              <i class="bi bi-circle"></i><span>Lokasi Kerja</span>
            </a>
          </li>
          <li>
            <a href="/eselon">
              <i class="bi bi-circle"></i><span>Eselon</span>
            </a>
          </li>
        </ul>
      </li><!-- End Referensi Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>Usulan Perubahan</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="tables-general.html">
              <i class="bi bi-circle"></i><span>Riwayat Pendidikan</span>
            </a>
          </li>
          <li>
            <a href="tables-data.html">
              <i class="bi bi-circle"></i><span>Riwayat Kepegawaian</span>
            </a>
          </li>
          <li>
            <a href="tables-data.html">
              <i class="bi bi-circle"></i><span>Riwayat Mutasi</span>
            </a>
          </li>
          <li>
            <a href="tables-data.html">
              <i class="bi bi-circle"></i><span>Riwayat Keluarga</span>
            </a>
          </li>
        </ul>
      </li><!-- End Usulan Perubahan Nav -->

      <li class="nav-item">
        <a class="nav-link {{$collapsedAccess}}" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-bar-chart"></i><span>Access Permission</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="charts-nav" class="nav-content {{$collapseAccess}} " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/group-user">
              <i class="bi bi-circle"></i><span>Roles</span>
            </a>
          </li>
          <li>
            <a href="/user">
              <i class="bi bi-circle"></i><span>Users</span>
            </a>
          </li>
        </ul>
      </li>

      @if (Auth::user()->role_id == 1)
        <li class="nav-item">
          <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-gem"></i><span>Super Admin</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
              <a href="/pending-updates">
                <i class="bi bi-circle"></i><span>Pending Updates</span>
              </a>
            </li>
            <li>
              <a href="/pending-deletes">
                <i class="bi bi-circle"></i><span>Pending Deletes</span>
              </a>
            </li>
          </ul>
        </li>
      @endif

      <!-- <li class="nav-heading">Pages</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="users-profile.html">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-faq.html">
          <i class="bi bi-question-circle"></i>
          <span>F.A.Q</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-contact.html">
          <i class="bi bi-envelope"></i>
          <span>Contact</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-register.html">
          <i class="bi bi-card-list"></i>
          <span>Register</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-login.html">
          <i class="bi bi-box-arrow-in-right"></i>
          <span>Login</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-error-404.html">
          <i class="bi bi-dash-circle"></i>
          <span>Error 404</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-blank.html">
          <i class="bi bi-file-earmark"></i>
          <span>Blank</span>
        </a>
      </li> -->

    </ul>

  </aside><!-- End Sidebar-->