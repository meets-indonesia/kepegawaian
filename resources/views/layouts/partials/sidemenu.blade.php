  @php
      $settings = ['unit-kerja', 'fakultas', 'jurusan', 'program-studi', 'kelompok-pegawai', 'jenis-pegawai'];

      $referensi = [
          'golongan',
          'struktur',
          'gaji-pokok',
          'jabatan-struktural',
          'jabatan-fungsional',
          'grade',
          'pendidikan',
          'hukuman-disiplin',
          'lokasi-kerja',
          'eselon',
      ];

      $riwayat = ['riwayat-jabatan-struktural', 'riwayat-jabatan-fungsional'];

      $access = ['roles', 'user'];

      $collapseSetting = 'collapse';
      $collapsedSetting = 'collapsed';

      $collapseReferensi = 'collapse';
      $collapsedReferensi = 'collapsed';

      $collapseAccess = 'collapse';
      $collapsedAccess = 'collapsed';

      $collapseSuper = 'collapse';
      $collapsedSuper = 'collapsed';

      $collapseRiwayat = 'collapse';
      $collapsedRiwayat = 'collapsed';

      $namepage = '';

      if (isset($pagename)) {
          $namepage = $pagename;
      }

      if (in_array($namepage, $settings)) {
          $collapseSetting = 'collapse show';
          $collapsedSetting = '';
      }

      if (in_array($namepage, $referensi)) {
          $collapseReferensi = 'collapse show';
          $collapsedReferensi = '';
      }

      if (in_array($namepage, $access)) {
          $collapseAccess = 'collapse show';
          $collapsedAccess = '';
      }

      if (in_array($namepage, $riwayat)) {
          $collapseRiwayat = 'collapse show';
          $collapsedRiwayat = '';
      }

      if (isset($updates) || isset($deletes)) {
          $collapseSuper = 'collapse show';
          $collapsedSuper = '';
      }
  @endphp
  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

      <ul class="sidebar-nav" id="sidebar-nav">

          <li class="nav-item">
              <a class="nav-link {{ $namepage == 'dashboard' ? '' : 'collapsed' }}" href="/dashboard">
                  <i class="bi bi-grid"></i>
                  <span>Dashboard</span>
              </a>
          </li><!-- End Dashboard Nav -->

          <li class="nav-item">
              <a class="nav-link {{ $namepage == 'pegawai' ? '' : 'collapsed' }}" href="/pegawai">
                  <i class="bi bi-person"></i>
                  <span>Pegawai</span>
              </a>
          </li><!-- End Pegawai Page Nav -->

          <li class="nav-item">
              <a class="nav-link {{ $namepage == 'pegawai' ? '' : 'collapsed' }}" href="/hierarki-pegawai">
                  <i class="bi bi-diagram-3"></i>
                  <span>Hierarki Pegawai</span>
              </a>
          </li><!-- End Pegawai Page Nav -->

          <li class="nav-item">
              <a class="nav-link {{ $collapsedSetting }}" data-bs-target="#components-nav" data-bs-toggle="collapse"
                  href="#">
                  <i class="bi bi-menu-button-wide"></i><span>Settings</span><i class="bi bi-chevron-down ms-auto"></i>
              </a>
              <ul id="components-nav" class="nav-content {{ $collapseSetting }} " data-bs-parent="#sidebar-nav">
                  <li>
                      <a class="{{ $namepage == 'fakultas' ? 'active' : '' }}" href="/fakultas">
                          <i class="bi bi-circle"></i><span>Fakultas</span>
                      </a>
                  </li>
                  <li>
                      <a class="{{ $namepage == 'jurusan' ? 'active' : '' }}" href="/jurusan">
                          <i class="bi bi-circle"></i><span>Jurusan</span>
                      </a>
                  </li>
                  <li>
                      <a class="{{ $namepage == 'program-studi' ? 'active' : '' }}" href="/program-studi">
                          <i class="bi bi-circle"></i><span>Program Studi</span>
                      </a>
                  </li>
                  <li>
                      <a class="{{ $namepage == 'kelompok-pegawai' ? 'active' : '' }}" href="/kelompok-pegawai">
                          <i class="bi bi-circle"></i><span>Kelompok Pegawai</span>
                      </a>
                  </li>
                  <li>
                      <a class="{{ $namepage == 'unit-kerja' ? 'active' : '' }}" href="/unit-kerja">
                          <i class="bi bi-circle"></i><span>Unit Kerja</span>
                      </a>
                  </li>
                  <li>
                      <a class="{{ $namepage == 'jenis-pegawai' ? 'active' : '' }}" href="/jenis-pegawai">
                          <i class="bi bi-circle"></i><span>Jenis Pegawai</span>
                      </a>
                  </li>
              </ul>
          </li><!-- End Settings Nav -->

          <li class="nav-item">
              <a class="nav-link {{ $collapsedReferensi }}" data-bs-target="#forms-nav" data-bs-toggle="collapse"
                  href="#">
                  <i class="bi bi-journal-text"></i><span>Referensi</span><i class="bi bi-chevron-down ms-auto"></i>
              </a>
              <ul id="forms-nav" class="nav-content {{ $collapseReferensi }} " data-bs-parent="#sidebar-nav">
                  <li>
                      <a class="{{ $namepage == 'golongan' ? 'active' : '' }}" href="/golongan">
                          <i class="bi bi-circle"></i><span>Golongan</span>
                      </a>
                  </li>
                  <li>
                      <a class="{{ $namepage == 'gaji-pokok' ? 'active' : '' }}" href="/gaji-pokok">
                          <i class="bi bi-circle"></i><span>Gaji Pokok</span>
                      </a>
                  </li>
                  <li>
                      <a class="{{ $namepage == 'eselon' ? 'active' : '' }}" href="/eselon">
                          <i class="bi bi-circle"></i><span>Eselon</span>
                      </a>
                  </li>
                  <li>
                      <a class="{{ $namepage == 'jabatan-struktural' ? 'active' : '' }}" href="/jabatan-struktural">
                          <i class="bi bi-circle"></i><span>Jabatan Struktural</span>
                      </a>
                  </li>
                  <li>
                      <a class="{{ $namepage == 'jabatan-fungsional' ? 'active' : '' }}" href="/jabatan-fungsional">
                          <i class="bi bi-circle"></i><span>Jabatan Fungsional</span>
                      </a>
                  </li>
                  <li>
                      <a class="{{ $namepage == 'pendidikan' ? 'active' : '' }}" href="/pendidikan">
                          <i class="bi bi-circle"></i><span>Pendidikan</span>
                      </a>
                  </li>
                  <li>
                      <a class="{{ $namepage == 'hukuman-disiplin' ? 'active' : '' }}" href="/hukuman-disiplin">
                          <i class="bi bi-circle"></i><span>Hukuman Disiplin</span>
                      </a>
                  </li>
                  <li>
                      <a class="{{ $namepage == 'lokasi-kerja' ? 'active' : '' }}" href="/lokasi-kerja">
                          <i class="bi bi-circle"></i><span>Lokasi Kerja</span>
                      </a>
                  </li>
                  <li>
                      <a class="{{ $namepage == 'grade' ? 'active' : '' }}" href="/grade">
                          <i class="bi bi-circle"></i><span>Grade</span>
                      </a>
                  </li>
                  <li>
                      <a class="{{ $namepage == 'struktur' ? 'active' : '' }}" href="/struktur">
                          <i class="bi bi-circle"></i><span>Struktur</span>
                      </a>
                  </li>
              </ul>
          </li><!-- End Referensi Nav -->

          @if (Auth::user()->role_id == 1)
              <li class="nav-item">
                  <a class="nav-link {{ $collapsedAccess }}" data-bs-target="#charts-nav" data-bs-toggle="collapse"
                      href="#">
                      <i class="bi bi-bar-chart"></i><span>Access Permission</span><i
                          class="bi bi-chevron-down ms-auto"></i>
                  </a>
                  <ul id="charts-nav" class="nav-content {{ $collapseAccess }} " data-bs-parent="#sidebar-nav">
                      <li>
                          <a class="{{ $namepage == 'roles' ? 'active' : '' }}" href="/group-user">
                              <i class="bi bi-circle"></i><span>Roles</span>
                          </a>
                      </li>
                      <li>
                          <a class="{{ $namepage == 'user' ? 'active' : '' }}" href="/user">
                              <i class="bi bi-circle"></i><span>Users</span>
                          </a>
                      </li>
                  </ul>
              </li>
              <li class="nav-item">
                  <a class="nav-link {{ $collapsedSuper }}" data-bs-target="#icons-nav" data-bs-toggle="collapse"
                      href="#">
                      <i class="bi bi-gem"></i><span>Super Admin</span><i class="bi bi-chevron-down ms-auto"></i>
                  </a>
                  <ul id="icons-nav" class="nav-content {{ $collapseSuper }} " data-bs-parent="#sidebar-nav">
                      <li>
                          <a class="{{ isset($updates) == 'pending-updates' ? 'active' : '' }}"
                              href="/pending-updates">
                              <i class="bi bi-circle"></i><span>Pending Updates</span>
                          </a>
                      </li>
                      <li>
                          <a class="{{ isset($deletes) == 'pending-deletes' ? 'active' : '' }}"
                              href="/pending-deletes">
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
