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

        .questionnaire-container {
            max-width: 900px;
            margin: 2.5rem auto 0 auto;
            background: linear-gradient(120deg, var(--light-green) 0%, var(--light-orange) 100%);
            border-radius: var(--border-radius);
            box-shadow: 0 4px 32px 0 rgba(230, 57, 70, 0.10), 0 1.5px 4px 0 rgba(67, 170, 139, 0.08);
            padding: 2.5rem 2.5rem 2rem 2.5rem;
            position: relative;
            overflow: hidden;
        }

        .questionnaire-header {
            display: flex;
            align-items: center;
            gap: 1.2rem;
            margin-bottom: 2.2rem;
        }

        .questionnaire-header-icon {
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

        .questionnaire-title {
            font-size: 2.1rem;
            font-weight: 900;
            color: var(--deep-red);
            letter-spacing: 1.5px;
            text-shadow: 0 2px 12px rgba(230, 57, 70, 0.10);
            margin: 0;
        }

        .questionnaire-subtitle {
            color: var(--primary-green);
            font-size: 1.1rem;
            margin-top: 0.2rem;
            margin-bottom: 1.5rem;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .questionnaire-form-section {
            background: var(--white);
            border-radius: 1.2rem;
            box-shadow: 0 1px 8px 0 rgba(67, 170, 139, 0.08);
            padding: 2rem 1.5rem 1.5rem 1.5rem;
            margin-bottom: 2rem;
        }

        .form-label {
            font-weight: 700;
            color: var(--primary-red);
            margin-bottom: 0.5rem;
            display: block;
            letter-spacing: 0.5px;
        }

        .form-control,
        .form-select {
            width: 100%;
            padding: 0.7rem 1rem;
            border-radius: 0.7rem;
            border: 1.5px solid var(--primary-orange);
            background: var(--light-orange);
            color: var(--deep-red);
            font-size: 1rem;
            margin-bottom: 1.2rem;
            transition: border 0.2s;
        }

        .form-control:focus,
        .form-select:focus {
            border: 2px solid var(--primary-green);
            outline: none;
            background: var(--light-green);
        }

        .questionnaire-actions {
            display: flex;
            gap: 1.2rem;
            margin-top: 1.5rem;
        }

        .btn {
            padding: 0.7rem 2.2rem;
            border-radius: 0.8rem;
            font-weight: 700;
            font-size: 1.1rem;
            border: none;
            cursor: pointer;
            transition: background 0.18s, color 0.18s, box-shadow 0.18s;
            box-shadow: 0 1px 6px 0 rgba(255, 183, 3, 0.10);
        }

        .btn-primary {
            background: linear-gradient(90deg, var(--primary-red) 0%, var(--primary-orange) 100%);
            color: var(--white);
        }

        .btn-primary:hover {
            background: linear-gradient(90deg, var(--deep-red) 0%, var(--deep-orange) 100%);
            color: var(--white);
        }

        .btn-secondary {
            background: var(--primary-green);
            color: var(--white);
        }

        .btn-secondary:hover {
            background: var(--deep-green);
            color: var(--white);
        }

        .questionnaire-list-section {
            background: var(--light-green);
            border-radius: 1.2rem;
            box-shadow: 0 1px 8px 0 rgba(67, 170, 139, 0.08);
            padding: 1.5rem 1.2rem;
        }

        .questionnaire-list-title {
            color: var(--primary-orange);
            font-size: 1.2rem;
            font-weight: 800;
            margin-bottom: 1.2rem;
            letter-spacing: 1px;
        }

        .questionnaire-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 0.7rem;
        }

        .questionnaire-table th {
            background: var(--primary-orange);
            color: var(--white);
            font-weight: 700;
            padding: 0.7rem 1rem;
            border-radius: 0.5rem 0.5rem 0 0;
            text-align: left;
            font-size: 1rem;
            letter-spacing: 0.5px;
        }

        .questionnaire-table td {
            background: var(--white);
            color: var(--deep-red);
            padding: 0.7rem 1rem;
            border-radius: 0 0 0.5rem 0.5rem;
            font-size: 1rem;
            vertical-align: middle;
        }

        .table-action-btn {
            background: var(--primary-green);
            color: var(--white);
            border: none;
            border-radius: 0.5rem;
            padding: 0.4rem 1rem;
            font-size: 1rem;
            margin-right: 0.5rem;
            cursor: pointer;
            transition: background 0.18s;
        }

        .table-action-btn.edit {
            background: var(--primary-orange);
        }

        .table-action-btn.delete {
            background: var(--primary-red);
        }

        .table-action-btn.edit:hover {
            background: var(--deep-orange);
        }

        .table-action-btn.delete:hover {
            background: var(--deep-red);
        }

        @media (max-width: 700px) {
            .questionnaire-container {
                padding: 1.2rem 0.5rem;
            }

            .questionnaire-form-section,
            .questionnaire-list-section {
                padding: 1rem 0.5rem;
            }

            .questionnaire-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }

            .questionnaire-title {
                font-size: 1.3rem;
            }
        }
    </style>

    <div class="questionnaire-container">
        <div class="questionnaire-header">
            <span class="questionnaire-header-icon">
                <i class="ti ti-clipboard-list"></i>
            </span>
            <div>
                <h1 class="questionnaire-title">Questionnaire Form Management</h1>
                <div class="questionnaire-subtitle">
                    Create, edit, and manage your questionnaires with ease.
                </div>
            </div>
        </div>

        <div class="questionnaire-form-section">
            <form wire:submit.prevent="save">

                @if (session()->has('message'))
                    <div class="alert alert-success" style="margin-bottom: 1rem;">
                        {{ session('message') }}
                    </div>
                @endif
                <label class="form-label" for="questionnaire-title">Title</label>
                <input type="text" class="form-control" id="questionnaire-title"
                    placeholder="Enter questionnaire title" wire:model="title">

                @error('title')
                    <div class="alert alert-danger" style="margin-bottom: 1rem;">
                        {{ $message }}
                    </div>
                @enderror

                <label class="form-label" for="questionnaire-description">Description</label>
                <textarea class="form-control" id="questionnaire-description" rows="3" placeholder="Enter description"
                    wire:model="description"></textarea>
                @error('description')
                    <div class="alert alert-danger" style="margin-bottom: 1rem;">
                        {{ $message }}
                    </div>
                @enderror

                <label class="form-label" for="questionnaire-category">Category</label>
                <select class="form-select" id="questionnaire-category" wire:model="category">
                    <option selected disabled>Select category</option>
                    <option>Health</option>
                    <option>Education</option>
                    <option>Environment</option>
                    <option>Other</option>
                </select>
                @error('category')
                    <div class="alert alert-danger" style="margin-bottom: 1rem;">
                        {{ $message }}
                    </div>
                @enderror

                <div class="questionnaire-actions">
                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                        <span wire:loading wire:target="save" class="spinner-border spinner-border-sm me-2"
                            role="status" aria-hidden="true"></span>
                        <i class="ti ti-plus"></i> Add Questionnaire
                    </button>
                    <button type="reset" class="btn btn-secondary">
                        <i class="ti ti-refresh"></i> Reset
                    </button>
                </div>
            </form>
        </div>

        <div class="questionnaire-list-section">
            <div class="questionnaire-list-title">
                <i class="ti ti-list-details"></i> Existing Questionnaires
            </div>
            <table class="questionnaire-table">
                <thead>
                    <tr>
                        <th style="width: 35%;">Title</th>
                        <th style="width: 35%;">Category</th>
                        <th style="width: 20%;">Status</th>
                        <th style="width: 10%;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($forms as $form)
                        <tr>
                            <td>{{ $form->title }}</td>
                            <td>{{ $form->category }}</td>
                            <td>
                                @php
                                    // Example: status logic, adjust as needed
                                    $status = $form->status ?? 'Active';
                                    $statusColor =
                                        $status === 'Active'
                                            ? 'var(--primary-green)'
                                            : ($status === 'Draft'
                                                ? 'var(--primary-orange)'
                                                : 'var(--primary-red)');
                                @endphp
                                <span style="color: {{ $statusColor }}; font-weight: 700;">
                                    {{ ucfirst($status) }}
                                </span>
                            </td>
                            <td>
                                <button class="table-action-btn edit" title="Edit"
                                    wire:click="edit('{{ $form->id }}')"><i class="ti ti-edit"></i></button>
                                <button class="table-action-btn delete" title="Delete"
                                    wire:click="delete('{{ $form->id }}')" wire:confirm="Are you sure"><i
                                        class="ti ti-trash"></i></button>
                                <button class="table-action-btn add-question" title="Add Question"
                                    wire:click="addQuestions('{{ $form->id }}')"><i
                                        class="ti ti-plus"></i></button>
                                {{-- <a href="{{ route('questions', ['id' => $form->id]) }}"
                                    class="table-action-btn add-question" title="View Questions" target="_blank">
                                    <i class="ti ti-list"></i>
                                </a> --}}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" style="text-align: center; color: #888;">No questionnaires found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <!-- You may need to include Tabler Icons or similar for the .ti classes -->


    <!-- Edit Form Modal -->
    <div class="modal fade" id="editFormModal" tabindex="-1" aria-labelledby="editFormModalLabel" aria-hidden="true"
        wire:ignore.self>
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content" style="border-radius: 1.25rem;">
                <div class="modal-header"
                    style="background: linear-gradient(90deg, var(--primary-orange) 0%, var(--primary-red) 100%); color: var(--white); border-radius: 1.25rem 1.25rem 0 0;">
                    <h5 class="modal-title" id="editFormModalLabel">
                        <i class="ti ti-edit"></i> Edit Questionnaire
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        style="filter: invert(1);"></button>
                </div>
                <form wire:submit.prevent="updateForm">
                    <div class="modal-body" style="padding: 2rem;">
                        <input type="hidden" wire:model="editingFormId">
                        <div class="mb-3">
                            <label for="editTitle" class="form-label fw-bold">Title</label>
                            <input type="text" class="form-control" id="editTitle"
                                wire:model.defer="editingFormTitle" required>
                            @error('editingFormTitle')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="editDescription" class="form-label fw-bold">Description</label>
                            <textarea class="form-control" id="editDescription" rows="3" wire:model.defer="editingFormDescription"
                                required></textarea>
                            @error('editingFormDescription')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="editCategory" class="form-label fw-bold">Category</label>
                            <input type="text" class="form-control" id="editCategory"
                                wire:model.defer="editingFormCategory" required>
                            @error('editingFormCategory')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="editStatus" class="form-label fw-bold">Status</label>
                            <select class="form-select" id="editStatus" wire:model.defer="editingFormStatus">
                                <option value="Published">Published</option>
                                <option value="Draft">Draft</option>
                                <option value="Archived">Archived</option>
                            </select>
                            @error('editingFormStatus')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer" style="border-top: none;">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                            style="border-radius: 2rem;">Cancel</button>
                        <button type="submit" class="btn dc-btn" style="border-radius: 2rem;">
                            <i class="ti ti-check me-1"></i> Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('form-saved', function() {
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

            notyf.success('New Form Has Been Created Successfully');
        });


        document.addEventListener('open-edit', function() {
            var modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('editFormModal'));
            modal.show();
        });

        document.addEventListener('form-updated', function() {
            var notyf = new Notyf({
                duration: 5000,
                position: {
                    x: 'right',
                    y: 'top'
                },
                types: [{
                    type: 'success',
                    background: 'linear-gradient(90deg, #43aa8b 0%, #2196f3 100%)',
                    icon: false
                }]
            });

            notyf.success('Form updated successfully');

            // Optionally close the edit modal if open
            var modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('editFormModal'));
            modal.hide();
        });
    </script>
</div>
