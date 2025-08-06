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

        .respondents-container {
            max-width: 900px;
            margin: 2.5rem auto 0 auto;
            background: linear-gradient(120deg, var(--light-green) 0%, var(--light-orange) 100%);
            border-radius: var(--border-radius);
            box-shadow: 0 4px 32px 0 rgba(230, 57, 70, 0.10), 0 1.5px 4px 0 rgba(67, 170, 139, 0.08);
            padding: 2.5rem 2.5rem 2rem 2.5rem;
            position: relative;
            overflow: hidden;
        }

        .respondents-header {
            display: flex;
            align-items: center;
            gap: 1.2rem;
            margin-bottom: 2.2rem;
        }

        .respondents-header-icon {
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

        .respondents-title {
            font-size: 2.1rem;
            font-weight: 900;
            color: var(--deep-red);
            letter-spacing: 1.5px;
            text-shadow: 0 2px 12px rgba(230, 57, 70, 0.10);
            margin: 0;
        }

        .respondents-subtitle {
            font-size: 1.1rem;
            color: var(--deep-green);
            margin-top: 0.2rem;
            margin-bottom: 1.5rem;
            font-weight: 500;
        }

        .respondents-actions {
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

        .action-btn.add {
            background: linear-gradient(90deg, var(--primary-green) 0%, var(--light-green) 100%);
            color: var(--deep-green);
        }

        .action-btn.export {
            background: linear-gradient(90deg, var(--primary-orange) 0%, var(--light-orange) 100%);
            color: var(--deep-orange);
        }

        .action-btn:hover {
            background: linear-gradient(90deg, var(--primary-red) 0%, var(--primary-orange) 100%);
            color: var(--white);
            box-shadow: 0 4px 16px 0 rgba(230, 57, 70, 0.13);
        }

        .respondents-table-section {
            background: var(--white);
            border-radius: 1.2rem;
            box-shadow: 0 2px 12px 0 rgba(67, 170, 139, 0.07);
            padding: 2rem 1.5rem 1.5rem 1.5rem;
        }

        .respondents-table-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--primary-red);
            margin-bottom: 1.2rem;
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }

        .respondents-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 0.7rem;
        }

        .respondents-table th {
            background: var(--light-orange);
            color: var(--deep-orange);
            font-weight: 800;
            padding: 0.85rem 0.7rem;
            border-radius: 0.7rem 0.7rem 0 0;
            font-size: 1.05rem;
            text-align: left;
        }

        .respondents-table td {
            background: var(--light-red);
            color: var(--deep-red);
            padding: 0.85rem 0.7rem;
            border-radius: 0 0 0.7rem 0.7rem;
            font-size: 1.01rem;
            vertical-align: middle;
        }

        .respondents-table tr {
            box-shadow: 0 1px 6px 0 rgba(230, 57, 70, 0.07);
        }

        .status-badge {
            display: inline-block;
            padding: 0.35em 1em;
            border-radius: 1em;
            font-size: 0.98em;
            font-weight: 700;
        }

        .status-active {
            background: var(--light-green);
            color: var(--primary-green);
        }

        .status-inactive {
            background: var(--light-red);
            color: var(--primary-red);
        }

        .status-pending {
            background: var(--light-orange);
            color: var(--primary-orange);
        }

        .table-action-btn {
            border: none;
            background: none;
            cursor: pointer;
            font-size: 1.05rem;
            font-weight: 700;
            padding: 0.3rem 0.7rem;
            border-radius: 0.7rem;
            transition: background 0.2s, color 0.2s;
            margin-right: 0.3rem;
        }

        .table-action-btn.edit {
            color: var(--primary-green);
        }

        .table-action-btn.edit:hover {
            background: var(--light-green);
            color: var(--deep-green);
        }

        .table-action-btn.delete {
            color: var(--primary-red);
        }

        .table-action-btn.delete:hover {
            background: var(--light-red);
            color: var(--deep-red);
        }

        .table-action-btn.view {
            color: var(--primary-orange);
        }

        .table-action-btn.view:hover {
            background: var(--light-orange);
            color: var(--deep-orange);
        }

        @media (max-width: 700px) {
            .respondents-container {
                padding: 1.2rem 0.5rem 1rem 0.5rem;
            }

            .respondents-table-section {
                padding: 1rem 0.2rem 0.7rem 0.2rem;
            }

            .respondents-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.7rem;
            }

            .respondents-title {
                font-size: 1.3rem;
            }
        }
    </style>

    <div class="respondents-container">
        <div class="respondents-header">
            <div class="respondents-header-icon">
                <i class="ti ti-users"></i>
            </div>
            <div>
                <div class="respondents-title">Respondents Management</div>
                <div class="respondents-subtitle">
                    Manage, view, and organize all respondents efficiently. Use the actions to edit, view, or remove
                    respondents.
                </div>
            </div>
        </div>

        <div class="respondents-actions">
            <button class="action-btn add">
                <i class="ti ti-user-plus"></i> Add Respondent
            </button>
            <button class="action-btn export">
                <i class="ti ti-download"></i> Export List
            </button>
        </div>

        <div class="respondents-table-section">
            <div class="respondents-table-title">
                <i class="ti ti-list-details"></i> Existing Respondents
            </div>
            <table class="respondents-table">
                <thead>
                    <tr>
                        <th style="width: 28%;">Name</th>
                        <th style="width: 22%;">Email</th>
                        <th style="width: 18%;">Status</th>
                        <th style="width: 18%;">Registered</th>
                        <th style="width: 14%;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Jane Doe</td>
                        <td>jane.doe@email.com</td>
                        <td>
                            <span class="status-badge status-active">Active</span>
                        </td>
                        <td>2024-06-01</td>
                        <td>
                            <button class="table-action-btn view"><i class="ti ti-eye"></i></button>
                            <button class="table-action-btn edit"><i class="ti ti-edit"></i></button>
                            <button class="table-action-btn delete"><i class="ti ti-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>John Smith</td>
                        <td>john.smith@email.com</td>
                        <td>
                            <span class="status-badge status-pending">Pending</span>
                        </td>
                        <td>2024-05-28</td>
                        <td>
                            <button class="table-action-btn view"><i class="ti ti-eye"></i></button>
                            <button class="table-action-btn edit"><i class="ti ti-edit"></i></button>
                            <button class="table-action-btn delete"><i class="ti ti-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>Maria Garcia</td>
                        <td>maria.garcia@email.com</td>
                        <td>
                            <span class="status-badge status-inactive">Inactive</span>
                        </td>
                        <td>2024-04-15</td>
                        <td>
                            <button class="table-action-btn view"><i class="ti ti-eye"></i></button>
                            <button class="table-action-btn edit"><i class="ti ti-edit"></i></button>
                            <button class="table-action-btn delete"><i class="ti ti-trash"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- You may need to include Tabler Icons or similar for the .ti classes -->
    </div>
</div>
