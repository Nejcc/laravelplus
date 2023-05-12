<div>
    <div class="input-group input-group-flat ">
        <input type="password" class="form-control @error($name) is-invalid @enderror"
               placeholder="{{ __('Your :password', ['password' => $label]) }}"
               name="{{ $name }}"
               required
               autocomplete="current-password"
        >

        <span class="input-group-text @error('password') is-invalid @enderror">
              <a href="#" class="link-secondary" title="Show password" data-bs-toggle="tooltip">
                    <i class="ti ti-eye"></i>
              </a>
        </span>
    </div>
</div>
