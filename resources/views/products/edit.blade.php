@extends('templates.master')

@section('content')
    <div class="section-header">
        <h1>{{ $product->name }}</h1>
        <div class="section-header-breadcrumb">
            <a href="{{ url()->previous() }}" class="btn btn-primary"><i class="fas fa-chevron-left"></i> Back</a>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="row" style="display: none">
                                <div class="form-group col-6">
                                    <label for="ready">Ready</label>
                                    <input type="text" name="ready" id="ready" value="{{ $ready }}" class="form-control @error('ready') is-invalid @enderror" readonly>
                                    @error('ready')
                                        <div class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" value="{{ $product->name }}" class="form-control @error('name') is-invalid @enderror" readonly>
                                    @error('name')
                                        <div class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="weight">Weight</label>
                                    <input type="number" name="weight" id="weight" value="{{ $product->warehouses[0]->weight }}" class="form-control @error('weight') is-invalid @enderror" readonly>
                                    @error('weight')
                                        <div class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="price">Price</label>
                                    <input type="number" name="price" id="price" value="{{ $product->warehouses[0]->price }}" class="form-control @error('price') is-invalid @enderror">
                                    @error('price')
                                        <div class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="discount">Discount</label>
                                    <input type="number" name="discount" id="discount" value="{{ $product->warehouses[0]->discount }}" class="form-control @error('discount') is-invalid @enderror">
                                    @error('discount')
                                        <div class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-12">
                                    <label for="content">Descriptions</label>
                                    <div class="col-12">
                                        <textarea class="summernote-simple" name="content" id="content" value="{{ $product->content ? $product->content : '' }}">
                                            {{ $product->content ? $product->content : '' }}
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="image">Image</label>
                                    <input type="file" name="image" id="image" class="form-control" onchange="readURLImage(this)">
                                    <div class="image-area mt-4"><img id="imageResultFront" src="{{ asset($product->image) }}" alt="{{ $product->image }}" class="img-fluid rounded shadow-sm mx-auto d-block"></div>
                                </div>
                            </div>
                            <div class="card-footer text-right mr-n3">
                                <a href="{{ url()->previous() }}" class="btn btn-secondary text-dark">Cancel</a>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        function readURLImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#imageResultFront')
                        .attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endpush