<div>

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

        .reports-container {
            max-width: 900px;
            margin: 2.5rem auto 0 auto;
            background: linear-gradient(120deg, var(--light-green) 0%, var(--light-orange) 100%);
            border-radius: var(--border-radius);
            box-shadow: 0 4px 32px 0 rgba(230, 57, 70, 0.10), 0 1.5px 4px 0 rgba(67, 170, 139, 0.08);
            padding: 2.5rem 2.5rem 2rem 2.5rem;
            position: relative;
            overflow: hidden;
        }

        .reports-header {
            display: flex;
            align-items: center;
            gap: 1.2rem;
            margin-bottom: 2.2rem;
        }

        .reports-header-icon {
            background: linear-gradient(135deg, var(--primary-red) 0%, var(--primary-orange) 100%);
            color: var(--white);
            border-radius: 1rem;
            padding: 0.7rem 1.1rem;
            font-size: 2.2rem;
            box-shadow: 0 2px 12px 0 rgba(255, 183, 3, 0.13);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .reports-title {
            font-size: 2.1rem;
            font-weight: 900;
            color: var(--deep-red);
            letter-spacing: 1.5px;
            text-shadow: 0 2px 12px rgba(230, 57, 70, 0.10);
            margin: 0;
        }

        .reports-subtitle {
            font-size: 1.1rem;
            color: var(--deep-green);
            margin-top: 0.2rem;
            margin-bottom: 1.5rem;
            font-weight: 500;
        }

        .reports-actions {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .action-btn {
            background: linear-gradient(90deg, var(--primary-green) 0%, var(--primary-orange) 100%);
            color: var(--white);
            border: none;
            border-radius: 1.2rem;
            padding: 0.7rem 1.6rem;
            font-size: 1.08rem;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 2px 8px 0 rgba(67, 170, 139, 0.10);
            transition: background 0.2s, color 0.2s, box-shadow 0.2s;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .action-btn.export {
            background: linear-gradient(90deg, var(--primary-orange) 0%, var(--light-orange) 100%);
            color: var(--deep-orange);
        }

        .action-btn.refresh {
            background: linear-gradient(90deg, var(--primary-red) 0%, var(--light-red) 100%);
            color: var(--deep-red);
        }

        .reports-table-container {
            background: var(--white);
            border-radius: 1.2rem;
            box-shadow: 0 2px 12px 0 rgba(67, 170, 139, 0.07);
            padding: 1.5rem 1.2rem;
            overflow-x: auto;
        }

        .reports-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .reports-table th, .reports-table td {
            padding: 0.85rem 1.1rem;
            text-align: left;
        }

        .reports-table th {
            background: linear-gradient(90deg, var(--light-green) 0%, var(--light-orange) 100%);
            color: var(--deep-green);
            font-weight: 800;
            font-size: 1.05rem;
            border-top-left-radius: 0.7rem;
            border-top-right-radius: 0.7rem;
        }

        .reports-table tr:not(:last-child) td {
            border-bottom: 1px solid var(--gray);
        }

        .reports-table td {
            font-size: 1rem;
            color: var(--deep-red);
        }

        .status-badge {
            display: inline-block;
            padding: 0.3rem 0.9rem;
            border-radius: 1rem;
            font-size: 0.97rem;
            font-weight: 700;
            letter-spacing: 0.5px;
        }
        .status-complete {
            background: var(--light-green);
            color: var(--primary-green);
        }
        .status-pending {
            background: var(--light-orange);
            color: var(--primary-orange);
        }
        .status-rejected {
            background: var(--light-red);
            color: var(--primary-red);
        }

        @media (max-width: 600px) {
            .reports-container {
                padding: 1.2rem 0.5rem 1rem 0.5rem;
            }
            .reports-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.7rem;
            }
            .reports-title {
                font-size: 1.3rem;
            }
            .reports-table th, .reports-table td {
                padding: 0.5rem 0.4rem;
                font-size: 0.95rem;
            }
        }
    </style>

    <div class="reports-container">
        <div class="reports-header">
            <div class="reports-header-icon">
                <i class="ti ti-chart-bar"></i>
            </div>
            <div>
                <h1 class="reports-title">Responses Management</h1>
                <div class="reports-subtitle">
                    View, analyze, and manage all collected responses in a beautiful, color-rich dashboard.
                </div>
            </div>
        </div>
        <div class="reports-actions">
            <button class="action-btn export">
                <i class="ti ti-download"></i>
                Export Data
            </button>
            <button class="action-btn refresh">
                <i class="ti ti-refresh"></i>
                Refresh
            </button>
        </div>
        <div class="reports-table-container">
            <table class="reports-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Respondent</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Score</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Example rows, replace with dynamic data as needed -->
                    <tr>
                        <td>1</td>
                        <td>Jane Doe</td>
                        <td>2024-06-01</td>
                        <td><span class="status-badge status-complete">Complete</span></td>
                        <td>92%</td>
                        <td>
                            <button class="action-btn" style="padding:0.3rem 1rem;font-size:0.95rem;">
                                <i class="ti ti-eye"></i> View
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>John Smith</td>
                        <td>2024-06-02</td>
                        <td><span class="status-badge status-pending">Pending</span></td>
                        <td>--</td>
                        <td>
                            <button class="action-btn" style="padding:0.3rem 1rem;font-size:0.95rem;">
                                <i class="ti ti-eye"></i> View
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Mary Johnson</td>
                        <td>2024-06-03</td>
                        <td><span class="status-badge status-rejected">Rejected</span></td>
                        <td>--</td>
                        <td>
                            <button class="action-btn" style="padding:0.3rem 1rem;font-size:0.95rem;">
                                <i class="ti ti-eye"></i> View
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
