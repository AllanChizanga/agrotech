<div>
    <!-- Styles (kept from your design) -->
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

        .page-grid {
            display: grid;
            grid-template-columns: 320px 1fr;
            gap: 1rem;
            align-items: start;
        }

        .panel {
            background: var(--white);
            border-radius: 0.75rem;
            box-shadow: 0 6px 24px rgba(0,0,0,0.06);
            padding: 1rem;
        }

        .sets-list .set-item {
            padding: 0.65rem;
            border-radius: 0.5rem;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: .5rem;
        }

        .set-item.selected { background: #f0f8ff; border-left: 4px solid var(--primary-green); }
        .set-item:hover { background: #fbfbfb; }

        .form-item {
            display:flex;
            justify-content:space-between;
            align-items:center;
            padding: .6rem;
            border-radius: .5rem;
            background: #fafafa;
            margin-bottom: .5rem;
        }

        .btn { padding: .5rem .9rem; border-radius: .5rem; border: none; cursor:pointer; }
        .btn-primary { background: linear-gradient(90deg,var(--primary-green),var(--primary-orange)); color: white; }
        .btn-danger { background: var(--primary-red); color: white; }
        .btn-ghost { background: transparent; border: 1px solid #eee; }

        .muted { color:#666; font-size:.9rem; }

        .flex { display:flex; gap:.5rem; align-items:center; }

        .search { width:100%; padding:.5rem; border-radius:.45rem; border:1px solid #eee; }
    </style>

   <div class="page-grid">

    <!-- LEFT: Survey Sets -->
    <div class="panel sets-list" style="height:400px; overflow-y:auto;">
        <div class="flex" style="justify-content:space-between; margin-bottom:.75rem;">
            <div>
                <h3 style="margin:0">Survey Sets</h3>
                <div class="muted" style="font-size:.85rem">Create and manage sets</div>
            </div>
            <div>
                <button class="btn btn-primary" wire:click="openCreateSetModal">New Set</button>
            </div>
        </div>

        <div style="margin-bottom:.6rem;">
            <input placeholder="Search sets..." class="search" wire:model.debounce.300ms="searchSet">
        </div>

        <div>
            @forelse($surveySets as $set)
                <div class="set-item {{ $selectedSetId === $set->id ? 'selected' : '' }}"
                     wire:click="selectSet({{ $set->id }})">
                    <div>
                        <div style="font-weight:700;">{{ $set->title }}</div>
                        <div class="muted" style="font-size:.85rem;">{{ Str::limit($set->description, 80) }}</div>
                    </div>

                    <div style="text-align:right; min-width:90px;">
                        <div class="muted" style="font-size:.85rem;">
                            {{ $progress[$set->id]['completed'] ?? 0 }} / {{ $progress[$set->id]['total'] ?? 0 }}
                        </div>
                        <div style="margin-top:.35rem;">
                            <button class="btn btn-ghost" wire:click.stop="editSet({{ $set->id }})">Edit</button>
                            <button class="btn" style="background:#ffeef0;color:var(--primary-red)" wire:click.stop="deleteSet({{ $set->id }})">Del</button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="muted">No sets found.</div>
            @endforelse
        </div>
    </div>

    <!-- RIGHT: Forms & Questions for selected set -->
    <div class="panel" style="height:400px; overflow-y:auto;">
        <div class="flex" style="justify-content:space-between;">
            <div>
                <h3 style="margin:0">
                    @if($selectedSetId)
                        {{ $surveySets->firstWhere('id', $selectedSetId)->title ?? 'Selected Set' }}
                    @else
                        Select a Set
                    @endif
                </h3>
                <div class="muted" style="font-size:.9rem;">
                    Manage forms inside the selected set. Drag to reorder.
                </div>
            </div>

            <div class="flex">
                <input placeholder="Search forms..." class="search" wire:model.debounce.300ms="searchForm" style="width:240px;"/>
                <!-- <button class="btn btn-primary" wire:click="openAttachFormModal" @if(!$selectedSetId) disabled @endif>Attach Form</button> -->
                <!-- <button class="btn btn-ghost" wire:click="$refresh">Refresh</button> -->
            </div>
        </div>

        <hr style="margin:.8rem 0; border:none; border-top:1px solid #eee;">

        @if(!$selectedSetId)
            <div class="muted">Pick a set on the left to see / manage forms.</div>
        @else
            <div id="sortable-{{ $selectedSetId }}">
                @if($setForms->count())
                    @foreach($setForms as $form)
                        <div class="form-item" data-id="{{ $form->id }}">
                            <div class="flex" style="align-items:center;">
                                <span style="cursor:grab; margin-right:.6rem;">☰</span>
                                <div>
                                    <div style="font-weight:700;">{{ $form->title }}</div>
                                    <div class="muted">{{ Str::limit($form->description, 90) }}</div>
                                </div>
                            </div>

                            <div class="flex">
                                <button class="btn btn-ghost" wire:click="addQuestions({{ $form->id }})">Questions</button>
                                <button class="btn" style="background:#ff6b6b;color:#fff;" wire:click="detachForm({{ $form->id }})">Detach</button>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="muted">No forms attached to this set yet.</div>
                @endif
            </div>
        @endif
    </div>
</div>


    <!-- MODALS: create/edit set, attach forms, create/edit form -->
    <!-- Create Set Modal -->
    <div class="modal fade" id="createSetModal" tabindex="-1" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: .75rem;">
                <div class="modal-header" style="background: linear-gradient(90deg,var(--primary-orange),var(--primary-red)); color:white;">
                    <h5 class="modal-title">Create Survey Set</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="saveSet">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input wire:model.defer="setTitle" class="form-control" required />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea wire:model.defer="setDescription" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Create Set</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Set Modal -->
    <div class="modal fade" id="editSetModal" tabindex="-1" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: .75rem;">
                <div class="modal-header" style="background: linear-gradient(90deg,var(--primary-orange),var(--primary-red)); color:white;">
                    <h5 class="modal-title">Edit Survey Set</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="updateSet">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input wire:model.defer="editingSetTitle" class="form-control" required />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea wire:model.defer="editingSetDescription" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update Set</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Attach Forms Modal -->
    <div class="modal fade" id="attachFormsModal" tabindex="-1" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content" style="border-radius: .75rem;">
                <div class="modal-header" style="background: linear-gradient(90deg,var(--primary-green),var(--primary-orange)); color:white;">
                    <h5 class="modal-title">Attach Forms to Set</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="muted mb-2">Select forms to attach to the set</div>
                    <div style="max-height:380px; overflow:auto;">
                        @foreach($forms as $f)
                            <div class="form-check" style="margin-bottom:.45rem;">
                                <input class="form-check-input" type="checkbox"  value="{{ $f->id }}" id="attach-{{ $f->id }}">
                                <label class="form-check-label" for="attach-{{ $f->id }}">
                                    <strong>{{ $f->title }}</strong> - <span class="muted">{{ Str::limit($f->description, 80) }}</span>
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" id="attachSelectedBtn">Attach Selected</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Existing Edit Form Modal  -->
    <div class="modal fade" id="editFormModal" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content" style="border-radius: 1.25rem;">
                <div class="modal-header"
                    style="background: linear-gradient(90deg, var(--primary-orange) 0%, var(--primary-red) 100%); color: var(--white); border-radius: 1.25rem 1.25rem 0 0;">
                    <h5 class="modal-title" id="editFormModalLabel">
                        <i class="ti ti-edit"></i> Edit Survey
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
                            <option value="" selected >Select status</option>
                                <option value="published">Published</option>
                                <option value="draft">Draft</option>
                                <option value="archived">Archived</option>
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
    <hr style="margin:1rem 0; border:none; border-top:1px solid #eee;">

    <!-- ===========================
        ALL FORMS TABLE
    =========================== -->
    <div class="panel">
        <div class="flex" style="justify-content:space-between; margin-bottom:.5rem;">
            <h3 style="margin:0">All Forms</h3>
            <button class="btn btn-primary" wire:click="openCreateFormModal">Add New Form</button>
        </div>

        <table class="table" style="width:100%; border-collapse:collapse;">
            <thead>
                <tr style="text-align:left; border-bottom:1px solid #eee;">
                    <th>Title</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($forms as $f)
                    <tr>
                        <td>{{ $f->title }}</td>
                        <td>{{ Str::limit($f->description, 80) }}</td>
                        <td>{{ $f->category }}</td>
                        <td>{{ $f->status ?? 'Active' }}</td>
                        <td class="flex" style="gap:.5rem;">
                            <button class="btn btn-primary btn-sm" title="Add Question" wire:click="addQuestions([{{ $f->id }}])">+</button>
                            <button class="btn btn-ghost btn-sm" wire:click="edit({{ $f->id }})">Edit</button>
                            <button class="btn btn-danger btn-sm" wire:click="delete({{ $f->id }})">Delete</button>
                            
                            @if($selectedSetId)
                                <button class="btn btn-primary btn-sm" wire:click="attachForms([{{ $f->id }}])">Attach</button>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="muted">No forms found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <!-- ===========================
        CREATE FORM MODAL
    =========================== -->
    <div class="modal fade" id="createFormModal" tabindex="-1" wire:ignore.self>
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content" style="border-radius: 1.25rem;">
                <div class="modal-header"
                    style="background: linear-gradient(90deg, var(--primary-orange) 0%, var(--primary-red) 100%); color: var(--white);">
                    <h5 class="modal-title">Create New Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        style="filter: invert(1);"></button>
                </div>
                <form wire:submit.prevent="save">
                    <div class="modal-body" style="padding: 2rem;">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Title</label>
                            <input type="text" class="form-control" wire:model.defer="title" required>
                            @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Description</label>
                            <textarea class="form-control" wire:model.defer="description" rows="3" required></textarea>
                            @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Category</label>
                            <input type="text" class="form-control" wire:model.defer="category" required>
                            @error('category') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="modal-footer" style="border-top:none;">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius: 2rem;">Cancel</button>
                        <button type="submit" class="btn btn-primary" style="border-radius: 2rem;">Create Form</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ===========================
        MODAL EVENT HANDLERS JS
    =========================== -->
    <script>
        document.addEventListener('open-create-form-modal', function () {
            var modal = new bootstrap.Modal(document.getElementById('createFormModal'));
            modal.show();
        });

        document.addEventListener('form-saved', function () {
            var modalEl = document.getElementById('createFormModal');
            if (modalEl) bootstrap.Modal.getOrCreateInstance(modalEl).hide();
        });
        document.addEventListener('open-edit-form-modal', function () {
            var modal = new bootstrap.Modal(document.getElementById('editFormModal'));
            modal.show();
        });

        document.addEventListener('form-updated', function () {
            const modalEl = document.getElementById('editFormModal');
            if (modalEl) bootstrap.Modal.getOrCreateInstance(modalEl).hide();
        });

    </script>


    <!-- Livewire events and JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js" integrity="" crossorigin="anonymous"></script>

    <script>
        // Modal control via Livewire events
        document.addEventListener('open-create-set-modal', function () {
            var modal = new bootstrap.Modal(document.getElementById('createSetModal'));
            modal.show();
        });
        document.addEventListener('set-saved', function () {
            var modalEl = document.getElementById('createSetModal');
            if (modalEl) bootstrap.Modal.getOrCreateInstance(modalEl).hide();
        });

        document.addEventListener('open-edit-set-modal', function () {
            var modal = new bootstrap.Modal(document.getElementById('editSetModal'));
            modal.show();
        });
        document.addEventListener('set-updated', function () {
            var modalEl = document.getElementById('editSetModal');
            if (modalEl) bootstrap.Modal.getOrCreateInstance(modalEl).hide();
        });

        document.addEventListener('open-attach-modal', function () {
            var modal = new bootstrap.Modal(document.getElementById('attachFormsModal'));
            modal.show();
        });

        document.addEventListener('forms-attached', function () {
            var modalEl = document.getElementById('attachFormsModal');
            if (modalEl) bootstrap.Modal.getOrCreateInstance(modalEl).hide();
        });

        // Attach selected forms button — collects checked checkboxes and calls Livewire.attachForms
        document.getElementById('attachSelectedBtn')?.addEventListener('click', function (e) {
            e.preventDefault();
            const checks = Array.from(document.querySelectorAll('#attachFormsModal input[type=checkbox]:checked'));
            const ids = checks.map(c => parseInt(c.value));
            if (ids.length === 0) {
                alert('Select at least one form to attach');
                return;
            }
            Livewire.emit('attachForms', ids);
            // Also call the component method directly
            Livewire.find(document.querySelector('[wire\\:id]')?.getAttribute('wire:id'))?.call('attachForms', ids);
        });

        // Initialize Sortable for current selected set area. Re-init on Livewire update.
        function initSortableForSelectedSet() {
            const selectedSetContainer = document.querySelector('[id^="sortable-"]');
            if (!selectedSetContainer) return;

            // destroy existing (if any) by using a stored reference
            if (selectedSetContainer.sortableInstance) {
                selectedSetContainer.sortableInstance.destroy();
            }

            selectedSetContainer.sortableInstance = Sortable.create(selectedSetContainer, {
                handle: 'span[style*="cursor:grab"]',
                animation: 150,
                onEnd: function (evt) {
                    // gather ordered ids
                    const ordered = Array.from(selectedSetContainer.querySelectorAll('[data-id]')).map(el => parseInt(el.getAttribute('data-id')));
                    // send to Livewire
                    const setId = selectedSetContainer.id.replace('sortable-', '');
                    Livewire.emit('reorderForms', ordered, parseInt(setId));
                }
            });
        }

        // Run on DOM ready
        document.addEventListener('DOMContentLoaded', function () {
            initSortableForSelectedSet();
        });
        document.addEventListener('open-create-form-modal', function () {
            var modal = new bootstrap.Modal(document.getElementById('createFormModal'));
            modal.show();
        });

        // Re-init after Livewire updates
        document.addEventListener('livewire:update', function () {
            initSortableForSelectedSet();
        });

        // Wire up custom event handlers from Livewire to close modals on success
        document.addEventListener('set-saved', function () {
            const el = document.getElementById('createSetModal');
            if (el) bootstrap.Modal.getOrCreateInstance(el).hide();
        });
        document.addEventListener('forms-attached', function () {
            const el = document.getElementById('attachFormsModal');
            if (el) bootstrap.Modal.getOrCreateInstance(el).hide();
        });

    </script>
</div>
