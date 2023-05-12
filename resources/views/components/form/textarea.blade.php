<div>
    <div class="mb-3">
        <label for="{{ $name }}" class="form-label">{{ $label }}</label>
        <textarea class="form-control"
                  name="{{ $name }}"
                  id="{{ $name }}"
                  placeholder="{{ $placeholder }}"
                  @if($cols) cols="{{ $cols }}" @endif
                  @if($rows) rows="{{ $rows }}" @endif
                  @if($disabled) disabled @endif
                  @if($style) style="{{ $style }}" @endif>{{ $value }}</textarea>
    </div>
</div>
