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
                    <th>Question</th>
                    <th>Type</th>
                    <th>Respondent</th>
                    <th>Answer</th>
                    <th>Option (if any)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reports as $question)
                    @foreach ($question->answers as $answer)
                        <tr>
                            <td>{{ $question->question_text }}</td>
                            <td>{{ $question->question_type ?? 'N/A' }}</td>
                            <td>
                                @if ($answer->response && $answer->response->respondent)
                                    {{ $answer->response->respondent->fullname ?? 'N/A' }}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>{{ $answer->answer_text ?? 'N/A' }}</td>
                            <td>
                                @if ($answer->option)
                                    {{ $answer->option->option_text }}
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    @endif
</div>
