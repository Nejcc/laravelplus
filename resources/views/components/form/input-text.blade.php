<div>
    <label class="form-label">{{ __($label) }}</label>
    <input type="email" class="form-control @error($name) is-invalid @enderror"
           placeholder="{{ ucfirst(strtolower(__('Enter your :label', ['label' => $label]))) }}"
           name="{{ $name }}"
           value="{{ old($name) ?? $value }}"
           {{ ($is_required === true) ? 'required' : '' }}
{{--           autocomplete="email"--}}
{{--           autofocus--}}
    >
    @error('email')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
