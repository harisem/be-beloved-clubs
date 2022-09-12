@extends('templates.master')

@section('content')
    <div class="section-header">
        <h1>{{ $order->invoice }}</h1>
        <div class="section-header-breadcrumb">
            <a href="{{ url()->previous() }}" class="btn btn-primary"><i class="fas fa-chevron-left"></i> Back</a>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    @foreach ($order->orders as $o)
                        <div class="card-body">
                            <form action="#">
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" id="name" value="{{ $o->warehouses->name }}" class="form-control @error('name') is-invalid @enderror" readonly>
                                        @error('name')
                                            <div class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-2">
                                        <label for="quantity">Quantity</label>
                                        <input type="number" name="quantity" id="quantity" value="{{ $o->quantity }}" class="form-control @error('quantity') is-invalid @enderror" readonly>
                                        @error('quantity')
                                            <div class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-2">
                                        <label for="size">Size</label>
                                        <input type="text" name="size" id="size" value="{{ $o->warehouses->size }}" class="form-control @error('size') is-invalid @enderror" readonly>
                                        @error('size')
                                            <div class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-2">
                                        <label for="color">Color</label>
                                        <input type="text" name="color" id="color" value="{{ $o->warehouses->color }}" class="form-control @error('color') is-invalid @enderror" readonly>
                                        @error('color')
                                            <div class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                {{-- <div class="card-footer text-right mr-n3">
                                    <a href="{{ url()->previous() }}" class="btn btn-secondary text-dark">Cancel</a>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div> --}}
                            </form>
                        </div>
                        <hr @if($loop->last) style="display: none" @endif>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection