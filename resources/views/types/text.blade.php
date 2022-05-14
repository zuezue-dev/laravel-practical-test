@component('base', compact('question'))
    <input type="text" name="{{ $question->key }}" id="{{ $question->key }}" class="form-control"
           value="{{ $value ?? old($question->key) }}">
@endcomponent