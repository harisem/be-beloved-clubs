@extends('templates.master')

@section('content')
    <div class="section-header">
        <h1>Add New Product</h1>
        <div class="section-header-breadcrumb">
            <a href="{{ url()->previous() }}" class="btn btn-primary"><i class="fas fa-chevron-left"></i> Back</a>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="form-group col-4">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror">
                                    @error('name')
                                        <div class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label>Product</label>
                                    <select id="products" name="products[]" class="form-control select2 @error('products') is-invalid @enderror" multiple="">
                                        @foreach ($warehouses as $w)
                                            <option value="{{ $w->id }}">{{ $w->name . ' - ' . $w->color }}</option>
                                        @endforeach
                                    </select>
                                    @error('products')
                                        <div class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-2">
                                    <label for="weight">Weight</label>
                                    <input type="number" name="weight" id="weight" class="form-control @error('weight') is-invalid @enderror">
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
                                    <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror">
                                    @error('price')
                                        <div class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="discount">Discount</label>
                                    <input type="number" name="discount" id="discount" class="form-control @error('discount') is-invalid @enderror">
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
                                        <textarea name="content" id="content" class="summernote-simple @error('content') is-invalid @enderror"></textarea>
                                    </div>
                                    @error('content')
                                        <div class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="image">Image</label>
                                    <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" onchange="readURLImage(this)">
                                    @error('image')
                                        <div class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <div class="image-area mt-4"><img id="imageResult" src="#" alt="" class="img-fluid rounded shadow-sm mx-auto d-block"></div>
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

@push('scripts')
    <script type="text/javascript">
        function readURLImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#imageResult')
                        .attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        // $(function () {
        //     $('#frontImg').on('change', function () {
        //         readURLFront(input);
        //     });
        // });

        // $(function () {
        //     $('#backImg').on('change', function () {
        //         readURLBack(input);
        //     });
        // });
    </script>
@endpush