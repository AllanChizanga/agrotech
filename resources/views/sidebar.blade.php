  <!-- Sidebar Start -->
  <style>
      :root {
          --primary-red: #e63946;
          --primary-green: #43aa8b;
          --primary-orange: #ffb703;
          --light-red: #ffe5e9;
          --light-green: #e6f9f2;
          --light-orange: #fff7e0;
          --deep-red: #b5172e;
          --deep-green: #27736a;
          --deep-orange: #fb8500;
          --white: #fff;
          --gray: #f8f9fa;
          --border-radius: 1.5rem;
      }

      .left-sidebar {
          background: linear-gradient(135deg, var(--light-green) 0%, var(--light-orange) 100%);
          min-height: 100vh;
          box-shadow: 2px 0 24px 0 rgba(230, 57, 70, 0.08);
          border-right: 4px solid var(--primary-orange);
          padding-top: 0;
      }

      .brand-logo {
          background: linear-gradient(90deg, var(--primary-red) 0%, var(--primary-orange) 100%);
          padding: 1.5rem 1.5rem 1rem 1.5rem;
          border-radius: 0 0 var(--border-radius) var(--border-radius);
          box-shadow: 0 2px 12px 0 rgba(230, 57, 70, 0.10);
      }

      .brand-logo .logo-img img {
          height: 48px;
          filter: drop-shadow(0 2px 8px var(--primary-orange));
      }

      .close-btn {
          color: var(--white);
          background: var(--primary-red);
          border-radius: 50%;
          width: 36px;
          height: 36px;
          display: flex;
          align-items: center;
          justify-content: center;
          transition: background 0.2s;
      }

      .close-btn:hover {
          background: var(--primary-orange);
      }

      .sidebar-nav {
          margin-top: 2rem;
      }

      #sidebarnav {
          padding: 0 1rem;
      }

      .nav-small-cap {
          color: var(--primary-green);
          font-weight: 700;
          font-size: 1.1rem;
          margin-bottom: 1.5rem;
          display: flex;
          align-items: center;
          gap: 0.5rem;
          letter-spacing: 1px;
      }

      .nav-small-cap-icon {
          color: var(--primary-orange);
          font-size: 1.5rem;
      }

      .sidebar-item {
          margin-bottom: 0.4rem;
      }

      .sidebar-link {
          display: flex;
          align-items: center;
          gap: 0.85rem;
          padding: 0.6rem 0.9rem;
          border-radius: 2rem;
          color: var(--deep-green);
          font-weight: 600;
          font-size: 1.05rem;
          background: var(--white);
          transition: background 0.2s, color 0.2s, box-shadow 0.2s;
          box-shadow: 0 1px 4px 0 rgba(67, 170, 139, 0.06);
          border: 2px solid transparent;
      }

      .sidebar-link:hover,
      .sidebar-link.active {
          background: linear-gradient(90deg, var(--primary-green) 0%, var(--primary-orange) 100%);
          color: var(--white) !important;
          box-shadow: 0 4px 16px 0 rgba(255, 183, 3, 0.10);
          border: 2px solid var(--primary-orange);
      }

      .sidebar-link i {
          font-size: 1.3rem;
          color: var(--primary-orange);
          background: var(--light-orange);
          border-radius: 50%;
          padding: 0.4rem;
          margin-right: 0.4rem;
          transition: background 0.2s, color 0.2s;
      }

      .sidebar-link:hover i,
      .sidebar-link.active i {
          color: var(--white);
          background: var(--primary-red);
      }

      .hide-menu {
          flex: 1;
          font-size: 1.08rem;
          letter-spacing: 0.5px;
      }

      @media (max-width: 991.98px) {
          .left-sidebar {
              min-width: 220px;
              max-width: 90vw;
          }

          .brand-logo {
              padding: 1rem 1rem 0.7rem 1rem;
          }

          .sidebar-link {
              font-size: 1rem;
              padding: 0.5rem 0.7rem;
          }
      }

      @media (max-width: 600px) {
          .left-sidebar {
              min-width: 100vw;
              border-radius: 0;
          }

          .brand-logo {
              border-radius: 0;
          }
      }
  </style>
  <aside class="left-sidebar">
      <div>
          <div class="brand-logo d-flex align-items-center justify-content-between">
              <a href="./index.html" class="text-nowrap logo-img">
                  <img src="assets/images/logos/logo.png" alt="Logo" />
              </a>
              <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                  <i class="ti ti-x fs-6"></i>
              </div>
          </div>
          <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
              <ul id="sidebarnav">
                  <li class="nav-small-cap">
                      <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon"></iconify-icon>
                      <span class="hide-menu">Home</span>
                  </li>
                  <li class="sidebar-item">
                      <a class="sidebar-link{{ request()->routeIs('data-collectors') ? ' active' : '' }}"
                          href="{{ route('data-collectors') }}" aria-expanded="false">
                          <i class="ti ti-atom"></i>
                          <span class="hide-menu">Data Collectors</span>
                      </a>
                  </li>
                  <li class="sidebar-item">
                      <a class="sidebar-link" href="{{ route('questionnaires') }}" aria-expanded="false">
                          <i class="ti ti-aperture"></i>
                          <span class="hide-menu">Questionnaires</span>
                      </a>
                  </li>
                  <li class="sidebar-item">
                      <a class="sidebar-link" href="{{ route('respondents') }}" aria-expanded="false">
                          <i class="ti ti-users"></i>
                          <span class="hide-menu">Respondents</span>
                      </a>
                  </li>
                  <li class="sidebar-item">
                      <a class="sidebar-link" href="{{ route('reports') }}" aria-expanded="false">
                          <i class="ti ti-chart-bar"></i>
                          <span class="hide-menu">Data Reports</span>
                      </a>
                  </li>
              </ul>
          </nav>
      </div>
  </aside>
  <!-- Sidebar End -->
