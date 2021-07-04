@extends('templates.auth')

@section('content')
    <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            @include('partials.auth-brand')

            <div class="card card-primary">
                <div class="card-header"><h4>Forgot Password</h4></div>

                <div class="card-body">
                    <p class="text-muted">We will send a link to reset your password</p>
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" aria-describedby="email" value="{{ old('email') }}" tabindex="1" required autofocus>
                            @error('email')
                                <div class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                Forgot Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            @include('partials.auth-footer')
        </div>
    </div>
@endsection