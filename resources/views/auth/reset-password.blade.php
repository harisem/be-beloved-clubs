@extends('templates.auth')

@section('content')
    <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            @include('partials.auth-brand')

            <div class="card card-primary">
                <div class="card-header"><h4>Reset Password</h4></div>

                <div class="card-body">
                    <form method="POST" action="{{ url('reset-password') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $request->token }}">
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" aria-describedby="email" value="{{ $request->email }}">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">New Password</label>
                            <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" tabindex="2">
                            @error('password')
                                <div class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">Confirm New Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" tabindex="2">
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                            Reset Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            @include('partials.auth-footer')
        </div>
    </div>
@endsection