@component('base', compact('question'))
    <input type="number" name="{{ $question->key }}" id="{{ $question->key }}" class="form-control">
@endcomponent