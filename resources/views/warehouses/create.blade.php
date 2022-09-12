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
                        <form method="POST" action="{{ route('warehouses.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror">
                                    @error('name')
                                        <div class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-3">
                                    <label for="weight">Weight (gr)</label>
                                    <input type="number" name="weight" id="weight" value="{{ old('weight') }}" class="form-control @error('weight') is-invalid @enderror">
                                    @error('weight')
                                        <div class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-3">
                                    <label for="color">Color</label>
                                    <input type="text" name="color" id="color" value="{{ old('color') }}" class="form-control @error('color') is-invalid @enderror">
                                    @error('color')
                                        <div class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="frontImg">Front Image</label>
                                    <input type="file" name="frontImg" id="frontImg" class="form-control @error('frontImg') is-invalid @enderror" onchange="readURLFront(this)">
                                    @error('frontImg')
                                        <div class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <div class="image-area mt-4"><img id="imageResultFront" src="#" alt="" class="img-fluid rounded shadow-sm mx-auto d-block"></div>
                                </div>
                                <div class="form-group col-6">
                                    <label for="backImg">Back Image</label>
                                    <input type="file" name="backImg" id="backImg" class="form-control @error('backImg') is-invalid @enderror" onchange="readURLBack(this)">
                                    @error('backImg')
                                        <div class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <div class="image-area mt-4"><img id="imageResultBack" src="#" alt="" class="img-fluid rounded shadow-sm mx-auto d-block"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label>Size</label>
                                    <select id="size" name="size[]" class="form-control select2 @error('size') is-invalid @enderror" multiple="">
                                        <option value="s">S</option>
                                        <option value="m">M</option>
                                        <option value="l">L</option>
                                        <option value="xl">XL</option>
                                    </select>
                                    @error('size')
                                        <div class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label>Stock</label>
                                    <input type="text" name="stock" id="stock" class="form-control @error('stock') is-invalid @enderror" data-role="tagsinput">
                                    @error('stock')
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

@push('cdns')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css"/>
@endpush

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
    <script>
        $("#stock").tagsinput({
            tagClass: 'badge badge-info'
        });
        $(".bootstrap-tagsinput").addClass("form-control");
    </script>
    <script type="text/javascript">
        function readURLFront(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#imageResultFront')
                        .attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
        
        function readURLBack(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#imageResultBack')
                        .attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endpush