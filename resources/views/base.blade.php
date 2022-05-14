<div class="form-group">
    <label style="font-size:1.1rem" class="mb-2" for="{{ $question->key }}">{{ $question->content }}</label>
    {{ $slot }}
    @if($errors->has($question->key))
        <div class="text-danger mt-2">{{ $errors->first($question->key) }}</div>
    @endif 
</div>

