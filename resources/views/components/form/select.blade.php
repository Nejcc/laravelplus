<div>
    <div class="form-group">
        <label for="{{ $name }}">{{ $label }}</label>
        <select class="form-select" id="{{ $name }}" name="{{ $name }}">
            @foreach($options as $optionValue => $optionLabel)
                <option value="{{ $optionValue }}" {{ $optionValue == $value ? 'selected' : '' }} {{ $value ? 'disabled' : '' }}>{{ $optionLabel }}</option>
            @endforeach
        </select>
    </div>
</div>
