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

        .reports-table th,
        .reports-table td {
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

            .reports-table th,
            .reports-table td {
                padding: 0.5rem 0.4rem;
                font-size: 0.95rem;
            }
        }
    </style>

    <div class="reports-container">
        <div class="reports-header" style="display: flex; align-items: center; justify-content: space-between;">
            <div style="display: flex; align-items: center;">
                <div class="reports-header-icon">
                    <i class="ti ti-chart-bar"></i>
                </div>
                <div>
                    <h1 class="reports-title">Responses Management</h1>
                    <div class="reports-subtitle">
                        Filter questions by form, then click a question to view all responses.
                    </div>
                </div>
            </div>
            <div>
                <button class="btn btn-success"
                    style="padding: 0.5rem 1.2rem; border-radius: 0.7rem; font-weight: 600; font-size: 1rem;"
                    wire:click="export">
                    <i class="ti ti-download" style="margin-right: 0.5rem;"></i>
                    Export
                </button>
            </div>
        </div>
        <div class="reports-actions">
            <div>
                <!-- Filter by Form -->
                <label for="formSelect" style="font-weight:600;">Form:</label>
                <select id="formSelect" wire:model.live="selectedFormId"
                    style="margin-right:1rem;padding:0.4rem 1rem;border-radius:0.7rem;" wire:change="load_questions">
                    <option value="">Select Form</option>
                    @foreach ($forms as $form)
                        <option value="{{ $form->id }}">{{ $form->title }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <!-- Filter by Question (after form is selected) -->
                <label for="questionSelect" style="font-weight:600;">Question:</label>

                <select id="questionSelect" wire:model.live="selectedQuestionId"
                    style="padding:0.4rem 1rem;border-radius:0.7rem;" wire:change="responses">
                    <option value="">Select Question</option>
                    @foreach ($questions as $question)
                        <option value="{{ $question->id }}">{{ $question->question_text }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="reports-table-container" style="margin-top:2rem;">
            <table class="reports-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Respondent</th>
                        <th>Question</th>
                        <th>Question Type</th>
                        <th>Answer</th>
                        <th>Option</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($responses as $index => $answer)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                @if ($answer->response && $answer->response->respondent)
                                    {{ $answer->response->respondent->fullname ?? 'N/A' }}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>
                                {{ $answer->question->question_text ?? ($selectedQuestion->question_text ?? 'N/A') }}
                            </td>
                            <td>
                                {{ $answer->question->question_type ?? ($selectedQuestion->question_type ?? 'N/A') }}
                            </td>
                            <td>
                                @php
                                    $qType =
                                        $answer->question->question_type ?? ($selectedQuestion->question_type ?? null);
                                    $filePath = !empty($answer->answer_text)
                                        ? asset('storage/' . $answer->answer_text)
                                        : null;
                                @endphp

                                @if (!empty($filePath) && in_array($qType, ['image', 'video', 'document']))
                                    @if ($qType === 'image')
                                        <a href="{{ $filePath }}" target="_blank" download>
                                            <img src="{{ $filePath }}" alt="Image"
                                                style="max-width: 100px; max-height: 100px; border-radius: 6px;">
                                            <br>
                                            Download Image
                                        </a>
                                    @elseif ($qType === 'video')
                                        <a href="{{ $filePath }}" target="_blank" download>
                                            Download Video
                                        </a>
                                    @elseif ($qType === 'document')
                                        <a href="{{ $filePath }}" target="_blank" download>
                                            Download Document
                                        </a>
                                    @else
                                        {{ $answer->answer_text ?? 'N/A' }}
                                    @endif
                                @else
                                    {{ $answer->answer_text ?? 'N/A' }}
                                @endif
                            </td>
                            <td>
                                {{ $answer->option->option_text ?? 'N/A' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align:center;color:var(--deep-green);font-weight:600;">
                                @if (empty($responses))
                                    No responses found for this question.
                                @else
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
