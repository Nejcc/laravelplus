<div>
    @if(!session()->has('main_user_id'))
        @role('super-admin|admin')
        <form action="{{ route('admin.switch-user.login-as') }}" method="post" class="d-flex">
            @csrf
            <select name="switch_user_to" class="form-select ">
                <option selected disabled>{{ __('Switch User') }}</option>
                @foreach($users as $user)
                    @if($user->id != auth()->id())
                        <option
                                value="{{ $user->id }}">{{ ucfirst($user->username ?: $user->email) }}</option>
                    @endif
                @endforeach
            </select>
            <input type="hidden" value="{{ auth()->id() }}" name="main_user_id">
            <button class="btn btn-link border-radius-none">Switch</button>
        </form>
        @endrole
    @else
        <form action="{{ route('switch-user.back') }}" method="post" class="d-flex">
            @csrf
            <input type="hidden" value="{{ session()->has('main_user_id') }}" name="main_user_id">
            <button class="btn btn-btn-dark">Remote logout</button>
        </form>
    @endif
</div>