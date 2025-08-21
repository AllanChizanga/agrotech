<div>
    <h2>Questionnaire Report</h2>
    @if (isset($questionnaire))
        <h3>Title: {{ $questionnaire->title ?? 'N/A' }}</h3>
        <p>Description: {{ $questionnaire->description ?? 'N/A' }}</p>
    @endif
    @if ($reports->isEmpty())
        <p>No questions found for this questionnaire.</p>
    @else
        <table border="1" cellpadding="5" cellspacing="0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Question</th>
                    <th>Answer</th>
                    <th>Option (if any)</th>
                    <th>Type</th>
                    <th>Respondent Name</th>
                    <th>National ID</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Country</th>
                    <th>City</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                @php $rowIndex = 1; @endphp
                @foreach ($reports as $question)
                    @foreach ($question->answers as $answer)
                        <tr>
                            <td>{{ $rowIndex++ }}</td>
                            <td>{{ $question->question_text }}</td>
                            <td>{{ $answer->answer_text ?? 'N/A' }}</td>
                            <td>
                                @if ($answer->option)
                                    {{ $answer->option->option_text }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{ $question->question_type ?? 'N/A' }}</td>
                            @php
                                $respondent =
                                    $answer->response && $answer->response->respondent
                                        ? $answer->response->respondent
                                        : null;
                            @endphp
                            <td>{{ $respondent->fullname ?? 'N/A' }}</td>
                            <td>{{ $respondent->national_id ?? 'N/A' }}</td>
                            <td>{{ $respondent->phone ?? 'N/A' }}</td>
                            <td>{{ $respondent->address ?? 'N/A' }}</td>
                            <td>{{ $respondent->country ?? 'N/A' }}</td>
                            <td>{{ $respondent->city ?? 'N/A' }}</td>
                            <td>{{ $respondent->email ?? 'N/A' }}</td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    @endif
</div>
