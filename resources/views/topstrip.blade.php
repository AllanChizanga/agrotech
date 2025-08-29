    <!-- Fixed Topbar (green-dominant redesign) -->
    <style>
        :root {
            --primary-green: #43aa8b;
            --secondary-green: #388e6c;
            --accent-yellow: #ffb703;
            --accent-light: #e9f7f1;
            --white: #fff;
            --shadow-green: 0 4px 24px 0 rgba(67, 170, 139, 0.10), 0 1.5px 4px 0 rgba(67, 170, 139, 0.08);
        }

        .topbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1030;
            background: linear-gradient(90deg, var(--primary-green) 0%, var(--secondary-green) 100%);
            box-shadow: var(--shadow-green);
            border-bottom: 4px solid var(--accent-yellow);
            padding: 0;
        }

        .topbar .navbar {
            min-height: 64px;
            padding: 0 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .topbar .navbar-brand {
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }

        .topbar .logo-img {
            height: 48px;
            width: 48px;
            background: var(--accent-light);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 8px 0 rgba(67, 170, 139, 0.13);
        }

        .topbar .logo-img img {
            height: 36px;
            width: 36px;
        }

        .topbar .brand-title {
            font-weight: 900;
            letter-spacing: 2px;
            font-size: 2rem;
            color: var(--white);
            text-shadow: 0 2px 12px rgba(67, 170, 139, 0.18);
            margin: 0;
        }

        .topbar .brand-badge {
            background: var(--accent-yellow);
            color: var(--primary-green);
            font-size: 1rem;
            font-weight: 700;
            border-radius: 1rem;
            padding: 0.3rem 1.1rem;
            box-shadow: 0 1px 6px 0 rgba(255, 183, 3, 0.10);
            margin-left: 1.2rem;
            letter-spacing: 1px;
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }

        .topbar .topbar-actions {
            display: flex;
            align-items: center;
            gap: 1.2rem;
        }

        .topbar .topbar-action-btn {
            background: var(--white);
            color: var(--primary-green);
            border: none;
            border-radius: 50%;
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            box-shadow: 0 1px 6px 0 rgba(67, 170, 139, 0.10);
            transition: background 0.18s, color 0.18s;
            cursor: pointer;
        }

        .topbar .topbar-action-btn:hover {
            background: var(--accent-light);
            color: var(--secondary-green);
        }

        @media (max-width: 900px) {
            .topbar .navbar {
                padding: 0 1rem;
            }

            .topbar .brand-title {
                font-size: 1.3rem;
                letter-spacing: 1.2px;
            }

            .topbar .logo-img {
                height: 34px;
                width: 34px;
            }

            .topbar .logo-img img {
                height: 24px;
                width: 24px;
            }

            .topbar .brand-badge {
                font-size: 0.8rem;
                padding: 0.2rem 0.7rem;
                margin-left: 0.6rem;
            }
        }

        body {
            padding-top: 68px;
            /* To prevent content from being hidden under the fixed topbar */
        }
    </style>
    <div class="topbar shadow-sm">
        <div class="navbar">
            <a class="navbar-brand" href="#">
                <span class="logo-img">
                    <img src="{{ asset('assets/images/logos/logo.png') }}" alt="AIRS Logo" class="w-100">
                </span>
                <span class="brand-title">AIRS</span>
                <span class="brand-badge">
                    <i class="ti ti-wind"></i> Data Collection System
                </span>
            </a>
            <div class="topbar-actions">
                <button class="topbar-action-btn" title="Notifications">
                    <i class="ti ti-bell"></i>
                </button>
                <button class="topbar-action-btn" title="Profile">
                    <i class="ti ti-user"></i>
                </button>
            </div>
        </div>
    </div>
