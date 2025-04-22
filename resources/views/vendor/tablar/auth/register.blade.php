@extends('tablar::page')

@section('title', 'Register User')

@section('content')
    <div class="container-xl">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Create New User') }}</div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form action="{{ route('admin.users.store') }}" method="post" autocomplete="off" novalidate>
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                       placeholder="Enter name" value="{{ old('name') }}" required>
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email address</label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                       placeholder="Enter email" value="{{ old('email') }}" required>
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <div class="input-group input-group-flat">
                                    <input type="password" name="password"
                                           class="form-control @error('password') is-invalid @enderror" placeholder="Password"
                                           autocomplete="new-password" required>
                                    <span class="input-group-text">
                                        <a href="#" class="link-secondary" title="Show password" data-bs-toggle="tooltip"
                                           onclick="togglePasswordVisibility(this)">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                 stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <circle cx="12" cy="12" r="2"/>
                                                <path d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7"/>
                                            </svg>
                                        </a>
                                    </span>
                                    @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Confirm Password</label>
                                <div class="input-group input-group-flat">
                                    <input type="password" name="password_confirmation"
                                           class="form-control @error('password_confirmation') is-invalid @enderror"
                                           placeholder="Confirm Password" autocomplete="new-password" required>
                                    <span class="input-group-text">
                                        <a href="#" class="link-secondary" title="Show password" data-bs-toggle="tooltip"
                                           onclick="togglePasswordVisibility(this)">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                 stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <circle cx="12" cy="12" r="2"/>
                                                <path d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7"/>
                                            </svg>
                                        </a>
                                    </span>
                                    @error('password_confirmation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="rol" class="form-label">{{ __('User Role') }}</label>
                                <select id="rol" class="form-control @error('rol') is-invalid @enderror" name="rol" required>
                                    <option value="administrador">{{ __('Administrator') }}</option>
                                    <option value="empleado" {{ old('rol') == 'empleado' ? 'selected' : '' }}>{{ __('Employee') }}
                                    </option>
                                </select>
                                @error('rol')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-footer">
                                <button type="submit" class="btn btn-primary w-100">{{ __('Create User') }}</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center text-muted mt-3">
                        <a href="{{ route('admin.users.index') }}" tabindex="-1">{{ __('Back to User List') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function togglePasswordVisibility(element) {
            const input = element.parentNode.previousElementSibling;
            const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
            input.setAttribute('type', type);
            element.querySelector('svg').classList.toggle('text-muted');
        }
    </script>
@endsection