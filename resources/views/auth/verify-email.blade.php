@extends('templates.auth')

@section('content')

    <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            @include('partials.auth-brand')

            <div class="card card-primary mt-n3">
                <div class="card-header"><h4>Verify Email</h4></div>

                <div class="card-body">
                    <p class="text-muted">You need to verify your email address first.</p>
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                Resend Verification Email
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            @include('partials.auth-footer')
        </div>
    </div>
@endsection