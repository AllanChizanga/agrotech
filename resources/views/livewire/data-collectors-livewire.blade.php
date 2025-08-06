<div>
    <style>
        /* Beautiful Red, Green, Orange Theme */
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
            --border-radius: 1.25rem;
        }

        .dc-card {
            background: var(--white);
            border-radius: var(--border-radius);
            box-shadow: 0 4px 24px 0 rgba(230, 57, 70, 0.08), 0 1.5px 4px 0 rgba(67, 170, 139, 0.08);
            border: none;
        }

        .dc-header {
            background: linear-gradient(90deg, var(--primary-red) 0%, var(--primary-orange) 100%);
            color: var(--white);
            border-radius: var(--border-radius) var(--border-radius) 0 0;
            padding: 1.5rem 2rem;
        }

        .dc-title {
            font-weight: 800;
            letter-spacing: 1px;
            font-size: 2rem;
        }

        .dc-btn {
            background: linear-gradient(90deg, var(--primary-green) 0%, var(--primary-orange) 100%);
            color: var(--white);
            border: none;
            border-radius: 2rem;
            font-weight: 600;
            padding: 0.6rem 1.8rem;
            transition: background 0.2s;
        }

        .dc-btn:hover {
            background: linear-gradient(90deg, var(--primary-orange) 0%, var(--primary-green) 100%);
            color: var(--white);
        }

        .dc-table th {
            background: var(--light-orange);
            color: var(--deep-orange);
            font-weight: 700;
            border: none;
        }

        .dc-table td {
            background: var(--white);
            border: none;
        }

        .dc-avatar {
            background: linear-gradient(135deg, var(--primary-green) 0%, var(--primary-orange) 100%);
            color: var(--white);
            font-weight: 700;
            font-size: 1.2rem;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            margin-right: 0.75rem;
            box-shadow: 0 2px 8px 0 rgba(67, 170, 139, 0.10);
        }

        .dc-action-btn {
            border-radius: 50%;
            width: 36px;
            height: 36px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            border: none;
            margin: 0 0.2rem;
            transition: background 0.2s;
        }

        .dc-action-btn.edit {
            background: var(--light-green);
            color: var(--deep-green);
        }

        .dc-action-btn.edit:hover {
            background: var(--primary-green);
            color: var(--white);
        }

        .dc-action-btn.delete {
            background: var(--light-red);
            color: var(--deep-red);
        }

        .dc-action-btn.delete:hover {
            background: var(--primary-red);
            color: var(--white);
        }

        .dc-alert-success {
            background: var(--light-green);
            color: var(--deep-green);
            border-left: 6px solid var(--primary-green);
        }

        .dc-alert-error {
            background: var(--light-red);
            color: var(--deep-red);
            border-left: 6px solid var(--primary-red);
        }

        .modal-content {
            border-radius: var(--border-radius);
            border: none;
        }

        .modal-header {
            background: linear-gradient(90deg, var(--primary-orange) 0%, var(--primary-red) 100%);
            color: var(--white);
            border-radius: var(--border-radius) var(--border-radius) 0 0;
        }

        .modal-footer {
            background: var(--gray);
            border-radius: 0 0 var(--border-radius) var(--border-radius);
        }

        .form-label {
            color: var(--primary-green);
            font-weight: 600;
        }

        .form-control:focus {
            border-color: var(--primary-orange);
            box-shadow: 0 0 0 0.2rem rgba(255, 183, 3, 0.15);
        }

        .text-danger {
            color: var(--primary-red) !important;
        }

        .text-muted {
            color: #bdbdbd !important;
        }

        @media (max-width: 600px) {

            .dc-header,
            .modal-header {
                padding: 1rem;
            }

            .dc-title {
                font-size: 1.3rem;
            }
        }
    </style>

    <div class="mb-4">
        <div class="dc-header">
            <h2 class="dc-title mb-0">Data Collector Management</h2>
        </div>
    </div>

    <!-- Button trigger modal -->
    <button type="button" class="dc-btn mb-3" data-bs-toggle="modal" data-bs-target="#createDataCollectorModal">
        <i class="ti ti-user-plus me-2"></i> Create Data Collector
    </button>

    @if (session()->has('success'))
        <div class="alert dc-alert-success alert-dismissible fade show mt-3" role="alert">
            <strong><i class="ti ti-check-circle me-1"></i></strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert dc-alert-error alert-dismissible fade show mt-3" role="alert">
            <strong><i class="ti ti-alert-triangle me-1"></i></strong> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Create Data Collector Modal -->
    <div class="modal fade" id="createDataCollectorModal" tabindex="-1" aria-labelledby="createDataCollectorModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createDataCollectorModalLabel">
                        <i class="ti ti-user-plus me-2"></i> Create Data Collector
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="createDataCollector">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="collectorName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="collectorName" name="name"
                                placeholder="Enter name" wire:model.defer="name">
                            @error('name')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="collectorEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="collectorEmail" name="email"
                                placeholder="Enter email" wire:model.defer="email">
                            @error('email')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="collectorPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="collectorPassword" name="password"
                                placeholder="Enter password" wire:model.defer="password">
                            @error('password')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-between">
                        <button type="button" class="dc-btn" style="background:var(--light-red);color:var(--deep-red);"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="dc-btn"><i class="ti ti-plus me-1"></i> Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Data Collectors Table -->
    <div class="card dc-card mt-4">
        <div class="card-header dc-header">
            <h5 class="mb-0"><i class="ti ti-users me-2"></i> Data Collectors</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table dc-table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th scope="col" class="ps-4">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($dataCollectors as $index => $collector)
                            <tr>
                                <td class="ps-4" style="font-weight:600;color:var(--primary-orange);">
                                    {{ $index + 1 }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="dc-avatar">
                                            {{ strtoupper(substr($collector->name, 0, 1)) }}
                                        </div>
                                        <span style="font-weight:600;">{{ $collector->name }}</span>
                                    </div>
                                </td>
                                <td style="font-weight:500;">{{ $collector->email }}</td>
                                <td class="text-center">
                                    <button type="button" class="dc-action-btn edit me-1" title="Edit"
                                        wire:click="edit('{{ $collector->id }}')">
                                        <i class="ti ti-pencil"></i>
                                    </button>
                                    <button type="button" class="dc-action-btn delete" title="Delete"
                                        wire:click="delete('{{ $collector->id }}')" wire:confirm="Are You Sure">
                                        <i class="ti ti-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted" style="font-size:1.1rem;">
                                    <i class="ti ti-info-circle me-2"></i> No data collectors found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Edit Data Collector Modal -->
    <div class="modal fade" id="editDataCollectorModal" tabindex="-1" aria-labelledby="editDataCollectorModalLabel"
        aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <form wire:submit.prevent="updateDataCollector">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editDataCollectorModalLabel">
                            <i class="ti ti-user-edit me-2"></i> Edit Data Collector
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" wire:model="edit_id">
                        <div class="mb-3">
                            <label for="editName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="editName" wire:model.defer="edit_name"
                                required>
                            @error('edit_name')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="editEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="editEmail" wire:model.defer="edit_email"
                                required>
                            @error('edit_email')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="editPassword" class="form-label">Password <small class="text-muted">(Leave
                                    blank to keep current password)</small></label>
                            <input type="password" class="form-control" id="editPassword"
                                wire:model.defer="edit_password">
                            @error('edit_password')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-between">
                        <button type="button" class="dc-btn"
                            style="background:var(--light-red);color:var(--deep-red);"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="dc-btn"><i class="ti ti-check me-1"></i> Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('data-collector-created', function() {
            var modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('createDataCollectorModal'));
            modal.hide();

            var notyf = new Notyf({
                duration: 5000,
                position: {
                    x: 'right',
                    y: 'top'
                },
                types: [{
                    type: 'success',
                    background: 'linear-gradient(90deg, #43aa8b 0%, #ffb703 100%)',
                    icon: false
                }]
            });

            notyf.success('New Data Collector Successfully Created');
        });

        document.addEventListener('data-collector-deleted', function() {
            var notyf = new Notyf({
                duration: 5000,
                position: {
                    x: 'right',
                    y: 'top'
                },
                types: [{
                    type: 'success',
                    background: 'linear-gradient(90deg, #e63946 0%, #ffb703 100%)',
                    icon: false
                }]
            });

            notyf.success('Data Collector deleted successfully');
        });

        document.addEventListener('open-edit-data-collector-modal', function() {
            var modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('editDataCollectorModal'));
            modal.show();
        });

        document.addEventListener('data-collector-updated', function() {
            var modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('editDataCollectorModal'));
            modal.hide();

            var notyf = new Notyf({
                duration: 5000,
                position: {
                    x: 'right',
                    y: 'top'
                },
                types: [{
                    type: 'success',
                    background: 'linear-gradient(90deg, #43aa8b 0%, #ffb703 100%)',
                    icon: false
                }]
            });

            notyf.success('Data Collector updated successfully');
        });
    </script>
</div>
