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

        .question-container {
            max-width: 900px;
            margin: 2.5rem auto 0 auto;
            background: linear-gradient(120deg, var(--light-green) 0%, var(--light-orange) 100%);
            border-radius: var(--border-radius);
            box-shadow: 0 4px 32px 0 rgba(230, 57, 70, 0.10), 0 1.5px 4px 0 rgba(67, 170, 139, 0.08);
            padding: 2.5rem 2.5rem 2rem 2.5rem;
            position: relative;
            overflow: hidden;
        }

        .question-header {
            display: flex;
            align-items: center;
            gap: 1.2rem;
            margin-bottom: 2.2rem;
        }

        .question-header-icon {
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

        .question-title {
            font-size: 2.1rem;
            font-weight: 900;
            color: var(--deep-red);
            letter-spacing: 1.5px;
            text-shadow: 0 2px 12px rgba(230, 57, 70, 0.10);
            margin: 0;
        }

        .question-subtitle {
            color: var(--primary-green);
            font-size: 1.1rem;
            margin-top: 0.2rem;
            margin-bottom: 1.5rem;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .question-form-section {
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

        .question-actions {
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

        .question-list-section {
            background: var(--light-green);
            border-radius: 1.2rem;
            box-shadow: 0 1px 8px 0 rgba(67, 170, 139, 0.08);
            padding: 1.5rem 1.2rem;
        }

        .question-list-title {
            color: var(--primary-orange);
            font-size: 1.2rem;
            font-weight: 800;
            margin-bottom: 1.2rem;
            letter-spacing: 1px;
        }

        .question-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 0.7rem;
        }

        .question-table th {
            background: var(--primary-orange);
            color: var(--white);
            font-weight: 700;
            padding: 0.7rem 1rem;
            border-radius: 0.5rem 0.5rem 0 0;
            text-align: left;
            font-size: 1rem;
            letter-spacing: 0.5px;
        }

        .question-table td {
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
            .question-container {
                padding: 1.2rem 0.5rem;
            }

            .question-form-section,
            .question-list-section {
                padding: 1rem 0.5rem;
            }

            .question-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }

            .question-title {
                font-size: 1.3rem;
            }
        }
    </style>

    <div class="question-container">
        <div class="question-header">
            <span class="question-header-icon">
                <i class="ti ti-list"></i>
            </span>
            <div>
                {{-- <h1 class="question-title">Questionnaire Questions</h1> --}}
                <h1 class="question-title">{{ $form_title }}</h1>

                <div class="question-subtitle">
                    Add, edit, and manage questions for this questionnaire.
                </div>
            </div>
        </div>



        <div class="question-form-section">

            <form wire:submit.prevent="saveQuestion">



                @if (session()->has('message'))
                    <div class="alert alert-success" style="margin-bottom: 1rem;">
                        {{ session('message') }}
                    </div>
                @endif

                <label class="form-label" for="question-text">Question Text</label>
                <input type="text" class="form-control" id="question-text" placeholder="Enter question"
                    wire:model.defer="question_text">

                @error('question_text')
                    <div class="alert alert-danger" style="margin-bottom: 1rem;">
                        {{ $message }}
                    </div>
                @enderror

                <label class="form-label" for="question-order">Question Order</label>
                <input type="number" class="form-control" id="question-order" placeholder="Enter order"
                    wire:model.defer="question_order" min="1">

                @error('question_order')
                    <div class="alert alert-danger" style="margin-bottom: 1rem;">
                        {{ $message }}
                    </div>
                @enderror

                <label class="form-label" for="question-type">Question Type</label>
                <select class="form-select" id="question-type" wire:model.live="question_type"
                    wire:change="questionTypeChanged">
                    <option selected disabled>Select type</option>
                    @foreach ($questionTypes as $type)
                        <option value="{{ $type->name }}">{{ ucfirst($type->name) }}</option>
                    @endforeach
                </select>
                @error('question_type')
                    <div class="alert alert-danger" style="margin-bottom: 1rem;">
                        {{ $message }}
                    </div>
                @enderror

                @if (in_array($question_type, ['multiple-choice', 'dropdown', 'checkbox']))
                    {{-- @if (1) --}}
                    <div
                        style="
                            background: #f9fff9;
                            border-radius: 1rem;
                            box-shadow: 0 4px 16px 0 rgba(76,175,80,0.13), 0 2px 8px 0 rgba(0,0,0,0.06);
                            padding: 1.2rem 1.5rem 1.2rem 1.5rem;
                            margin-bottom: 1.5rem;
                            border: 1.5px solid #e0f2e9;
                        ">

                        <label class="form-label" for="question-options">
                            Options
                            <button wire:click.prevent="increaseOptionCounter" type="button"
                                class="btn btn-sm btn-outline-primary ms-2">
                                <i class="ti ti-plus"></i>
                            </button>
                        </label>
                        <div class="option-inputs-wrapper"
                            style="display: flex; flex-wrap: wrap; gap: 0.5rem; margin-bottom: 1rem;">
                            @for ($i = 0; $i < $optionCounter; $i++)
                                <input type="text" class="option-input-box" id="option-{{ $i }}"
                                    placeholder="Option {{ $i + 1 }}"
                                    wire:model.defer="options.{{ $i }}"
                                    style="
                                        width: 160px;
                                        font-size: 0.95rem;
                                        padding: 0.3rem 0.7rem;
                                        border-radius: 0.5rem;
                                        border: 1.5px solid #4caf50;
                                        background: #f8fff8;
                                        box-shadow: 0 2px 8px 0 rgba(76,175,80,0.10), 0 1.5px 4px 0 rgba(0,0,0,0.04);
                                        margin-bottom: 0;
                                        outline: none;
                                        transition: box-shadow 0.2s, border-color 0.2s;
                                    "
                                    onfocus="this.style.boxShadow='0 0 0 2px #4caf50, 0 2px 8px 0 rgba(76,175,80,0.10)'; this.style.borderColor='#388e3c';"
                                    onblur="this.style.boxShadow='0 2px 8px 0 rgba(76,175,80,0.10), 0 1.5px 4px 0 rgba(0,0,0,0.04)'; this.style.borderColor='#4caf50';">
                            @endfor
                        </div>
                        @error('options')
                            <div class="alert alert-danger" style="margin-bottom: 1rem;">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                @endif

                <label class="form-label" for="depends-on-question">Depends On Question</label>
                <select class="form-select" id="depends-on-question" wire:model.defer="depends_on_question">
                    <option value="" selected>None</option>
                    @foreach ($questions as $q)
                        <option value="{{ $q->question_text }}">{{ $q->question_text }}</option>
                    @endforeach
                </select>
                @error('depends_on_question')
                    <div class="alert alert-danger" style="margin-bottom: 1rem;">
                        {{ $message }}
                    </div>
                @enderror

                <label class="form-label" for="depends-on-answer">Depends On Answer</label>
                <input type="text" class="form-control" id="depends-on-answer" placeholder="Enter answer (optional)"
                    wire:model.defer="depends_on_answer">
                @error('depends_on_answer')
                    <div class="alert alert-danger" style="margin-bottom: 1rem;">
                        {{ $message }}
                    </div>
                @enderror

                <div class="form-check" style="margin-bottom: 1.2rem;">
                    <input class="form-check-input" type="checkbox" id="is-required" wire:model.defer="is_required">
                    <label class="form-check-label" for="is-required"
                        style="color: var(--primary-green); font-weight: 600;">
                        Required
                    </label>
                </div>

                <div class="question-actions">
                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                        <span wire:loading wire:target="saveQuestion" class="spinner-border spinner-border-sm me-2"
                            role="status" aria-hidden="true"></span>
                        <i class="ti ti-plus"></i> Add Question
                    </button>
                    <button type="reset" class="btn btn-secondary">
                        <i class="ti ti-refresh"></i> Reset
                    </button>
                </div>
            </form>
        </div>

        <div class="question-list-section">
            <div class="question-list-title">
                <i class="ti ti-list-details"></i> Existing Questions
            </div>
            <table class="question-table">
                <thead>
                    <tr>
                        <th style="width: 40%;">Question</th>
                        <th style="width: 20%;">Type</th>
                        <th style="width: 15%;">Required</th>
                        <th style="width: 15%;">Order</th>
                        <th style="width: 10%;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($questions as $question)
                        <tr>
                            <td>{{ $question->question_text }}</td>
                            <td style="text-transform: capitalize;">
                                <span style="cursor: pointer;" wire:click="openOptions('{{ $question->id }}')"
                                    class="text-decoration-underline">
                                    {{ $question->question_type }}
                                </span>
                            </td>
                            <td>
                                @if ($question->is_required)
                                    <span style="color: var(--primary-green); font-weight: 700;">Yes</span>
                                @else
                                    <span style="color: var(--primary-red); font-weight: 700;">No</span>
                                @endif
                            </td>
                            <td>{{ $question->question_order ?? '-' }}</td>
                            <td>
                                <button class="table-action-btn edit" title="Edit"
                                    wire:click="editQuestion('{{ $question->id }}')"><i
                                        class="ti ti-edit"></i></button>
                                <button class="table-action-btn delete" title="Delete"
                                    wire:click="deleteQuestion('{{ $question->id }}')"
                                    wire:confirm="Are you sure?"><i class="ti ti-trash"></i></button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center; color: #888;">No questions found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <!-- You may need to include Tabler Icons or similar for the .ti classes -->

    <!-- Edit Question Modal (optional, similar to questionnaire edit modal) -->
    <div class="modal fade" id="editQuestionModal" tabindex="-1" aria-labelledby="editQuestionModalLabel"
        aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content" style="border-radius: 1.25rem;">
                <div class="modal-header"
                    style="background: linear-gradient(90deg, var(--primary-orange) 0%, var(--primary-red) 100%); color: var(--white); border-radius: 1.25rem 1.25rem 0 0;">
                    <h5 class="modal-title" id="editQuestionModalLabel">
                        <i class="ti ti-edit"></i> Edit Question
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        style="filter: invert(1);"></button>
                </div>
                <form wire:submit.prevent="updateQuestion">
                    <div class="modal-body" style="padding: 2rem;">
                        <input type="hidden" wire:model="editingQuestionId">
                        <div class="mb-3">
                            <label for="editQuestionText" class="form-label fw-bold">Question Text</label>
                            <input type="text" class="form-control" id="editQuestionText"
                                wire:model.defer="editingQuestionText" required>
                            @error('editingQuestionText')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="editQuestionType" class="form-label fw-bold">Question Type</label>
                            <select class="form-select" id="editQuestionType" wire:model.defer="editingQuestionType"
                                required>
                                <option value="text">Text</option>
                                <option value="textarea">Paragraph</option>
                                <option value="radio">Single Choice</option>
                                <option value="checkbox">Multiple Choice</option>
                                <option value="number">Number</option>
                                <option value="date">Date</option>
                            </select>
                            @error('editingQuestionType')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="editIsRequired"
                                wire:model.defer="editingIsRequired">
                            <label class="form-check-label" for="editIsRequired"
                                style="color: var(--primary-green); font-weight: 600;">
                                Required
                            </label>
                        </div>
                        <div class="mb-3">
                            <label for="editQuestionOrder" class="form-label fw-bold">Order</label>
                            <input type="number" class="form-control" id="editQuestionOrder"
                                wire:model.defer="editingQuestionOrder" min="1">
                            @error('editingQuestionOrder')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer" style="border-top: none;">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                            style="border-radius: 2rem;">Cancel</button>
                        <button type="submit" class="btn btn-primary" style="border-radius: 2rem;">
                            <i class="ti ti-check me-1"></i> Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Modal to display options inside options array -->
    <div wire:ignore.self class="modal fade" id="optionsModal" tabindex="-1" aria-labelledby="optionsModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="border-bottom: none;">
                    <h5 class="modal-title fw-bold" id="optionsModalLabel">Question Options</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if (count($options_edited) > 0)
                        <ul class="list-group">
                            @foreach ($options_edited as $option)
                                <li class="list-group-item d-flex align-items-center">
                                    <i class="bi bi-dot text-primary me-2"></i>
                                    <span class="fw-semibold">{{ $option->option_text }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-muted">No options available for this question.</p>
                    @endif
                </div>
                <div class="modal-footer" style="border-top: none;">

                </div>
            </div>
        </div>
    </div>

    <!-- Modal to edit question -->
    <div wire:ignore.self class="modal fade" id="editQuestionModal" tabindex="-1"
        aria-labelledby="editQuestionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="border-bottom: none;">
                    <h5 class="modal-title fw-bold" id="editQuestionModalLabel">Edit Question</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="updateQuestion">

                    @if (session()->has('message'))
                        <div class="alert alert-success" style="margin-bottom: 1rem;">
                            {{ session('message') }}
                        </div>
                    @endif

                    <label class="form-label" for="editingQuestionText">Question Text</label>
                    <input type="text" class="form-control" id="editingQuestionText" placeholder="Enter question"
                        wire:model.defer="editingQuestionText">

                    @error('editingQuestionText')
                        <div class="alert alert-danger" style="margin-bottom: 1rem;">
                            {{ $message }}
                        </div>
                    @enderror

                    <label class="form-label" for="editingQuestionOrder">Question Order</label>
                    <input type="number" class="form-control" id="editingQuestionOrder" placeholder="Enter order"
                        wire:model.defer="editingQuestionOrder" min="1">

                    @error('editingQuestionOrder')
                        <div class="alert alert-danger" style="margin-bottom: 1rem;">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="question-actions">
                        <button type="submit" class="btn btn-primary" wire:loading.attr="disabled"
                            style="border-radius: 2rem;">
                            <span wire:loading wire:target="updateQuestion"
                                class="spinner-border spinner-border-sm me-2" role="status"
                                aria-hidden="true"></span>
                            <i class="ti ti-check me-1"></i> Update
                        </button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                            style="border-radius: 2rem;">
                            <i class="ti ti-refresh"></i> Cancel
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script>
        // Listen for Livewire event to open the options modal
        window.addEventListener('open-options-modal', function() {
            var optionsModal = new bootstrap.Modal(document.getElementById('optionsModal'));
            optionsModal.show();
        });

        // Handle the open-options-modal event to show the options modal
        window.addEventListener('open-options-modal', function() {
            var optionsModal = new bootstrap.Modal(document.getElementById('optionsModal'));
            optionsModal.show();
        });
    </script>

    <script>
        document.addEventListener('question-saved', function() {
            var notyf = new Notyf({
                duration: 5000,
                position: {
                    x: 'right',
                    y: 'top'
                }
            });
            notyf.success('Question saved successfully!');
        });

        window.addEventListener('question-saved', function() {
            var notyf = new Notyf({
                duration: 5000,
                position: {
                    x: 'right',
                    y: 'top'
                }
            });
            notyf.success('Question saved successfully!');
        });

        document.addEventListener('question-deleted', function() {
            var notyf = new Notyf({
                duration: 5000,
                position: {
                    x: 'right',
                    y: 'top'
                }
            });
            notyf.success('Question deleted successfully!');
        });

        window.addEventListener('question-deleted', function() {
            var notyf = new Notyf({
                duration: 5000,
                position: {
                    x: 'right',
                    y: 'top'
                }
            });
            notyf.success('Question deleted successfully!');
        });

        document.addEventListener('open-edit-qtn-modal', function() {
            var editModal = new bootstrap.Modal(document.getElementById('editQuestionModal'));
            editModal.show();
        });
        document.addEventListener('close-edit-modal', function() {
            var editModal = bootstrap.Modal.getInstance(document.getElementById('editQuestionModal'));
            if (editModal) {
                editModal.hide();
            }
        });
    </script>
</div>
