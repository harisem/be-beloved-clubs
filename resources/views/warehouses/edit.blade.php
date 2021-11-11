@extends('templates.master')

@section('content')
    <div class="section-header">
        <h1>Edit {{ $warehouse->name }}</h1>
        <div class="section-header-breadcrumb">
            <a href="{{ url()->previous() }}" class="btn btn-primary"><i class="fas fa-chevron-left"></i> Back</a>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('warehouses.update', $warehouse->id) }}">
                            @csrf
                            @method('PATCH')
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" value="{{ $warehouse->name }}" class="form-control @error('name') is-invalid @enderror">
                                    @error('name')
                                        <div class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="email">Weight (gr)</label>
                                    <input type="email" name="email" id="email" value="{{ $warehouse->weight }}" class="form-control @error('email') is-invalid @enderror">
                                    @error('email')
                                        <div class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-4">
                                    <label for="production">Production</label>
                                    <input type="number" name="production" id="production" value="{{ $warehouse->production }}" class="form-control @error('production') is-invalid @enderror" @if ($warehouse->production == null) placeholder="0" @endif>
                                    @error('production')
                                        <div class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-4">
                                    <label for="ready">Ready</label>
                                    <input type="number" name="ready" id="ready" value="{{ $warehouse->ready }}" class="form-control @error('ready') is-invalid @enderror" @if ($warehouse->ready == null) placeholder="0" @endif>
                                    @error('ready')
                                        <div class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-4">
                                    <label for="delivered">Delivered</label>
                                    <input type="number" name="delivered" id="delivered" value="{{ $warehouse->delivered }}" class="form-control @error('delivered') is-invalid @enderror" @if ($warehouse->delivered == null) placeholder="0" @endif>
                                    @error('delivered')
                                        <div class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer text-right mr-n3">
                                <a href="{{ url()->previous() }}" class="btn btn-secondary text-dark">Cancel</a>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection