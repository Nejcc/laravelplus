<div>
    <div class="form-group">
        <label for="{{ $name }}">{{ $label }}</label>
        <input type="{{ $type }}"
               class="form-control"
               id="{{ $name }}"
               name="{{ $name }}"
               placeholder="{{ $placeholder }}"
               {{ $required ? 'required' : '' }}
               {{ $autofocus ? 'autofocus' : '' }}
               value="{{ $value }}">
    </div>
</div>
