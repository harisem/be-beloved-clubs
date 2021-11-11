@extends('templates.master')

@section('content')
    <div class="section-header">
        <h1>Edit {{ $catalog->name }}</h1>
        <div class="section-header-breadcrumb">
            <a href="{{ url()->previous() }}" class="btn btn-primary"><i class="fas fa-chevron-left"></i> Back</a>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('catalogs.update', $catalog->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="products">Select Product</label>
                                    <select class="form-control select2" name="products[]" id="products" multiple>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}" @if ($product->catalog_id != null) selected="selected" @endif>{{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-6">
                                    <label for="name">Title</label>
                                    <input type="text" name="name" id="name" value="{{ $catalog->name }}" class="form-control @error('name') is-invalid @enderror">
                                    @error('name')
                                        <div class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-12 mb-n1">
                                    <label for="content">Descriptions</label>
                                    <div class="col-12">
                                        <textarea class="summernote-simple" name="content" id="content">{{ $catalog->content }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-12">
                                    <label for="img">Image</label>
                                    <input type="file" name="img" id="img" class="form-control" onchange="readURL(this)">
                                    <div class="image-area m-2"><img id="imageResult" src="{{ asset('storage/catalogs/' . $catalog->image) }}" alt="{{ $catalog->image }}" class="img-fluid rounded shadow-sm mx-auto d-block" style="width: 40rem"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-12">
                                    <label for="photoshoots">Photoshoots</label>
                                    <input type="file" name="photoshoots[]" id="photoshoots" class="form-control" onchange="previewImage(this)" multiple>
                                    <div class="row">
                                        <div class="col-12 mt-2" id="imageArea">
                                        </div>
                                        <div class="col-12 mt-2">
                                            <label>Current Photoshoots</label>
                                            <div class="d-flex justify-content-around">
                                                @foreach ($catalog->photoshoots as $photoshoot)
                                                    <img class="img-fluid rounded shadow-sm m-2" src="{{ $photoshoot->image }}" alt="{{ $photoshoot->image }}" style="width: 16rem">
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
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
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#imageResult')
                        .attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
        
        function previewImage(input) {
            var data = $(input)[0].files;
            var countElement = $('#preview').length;

            if (countElement === 0) {
                var html = `
                <label>New Photoshoots</label>
                <div class="d-flex justify-content-around" id="preview"></div>
                `;
                $('#imageArea').append(html);
            }

            $.each(data, function (index, file) {
                if (/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)) {
                    var fRead = new FileReader();
                    fRead.onload = (function (file) {
                        return function (e) {
                            
                            // var lbl = $('<label>New Photoshoots</label>');
                            // var div = $('<div></div>').addClass('d-flex justify-content-between').attr('id', 'preview');
                            var img = $('<img/>').addClass('img-fluid rounded shadow-sm m-2').css('width', '16rem').attr('src', e.target.result);
                            
                            $('#preview').append(img);
                        };
                    })(file);
                    fRead.readAsDataURL(file);
                }
            });
        }
    </script>
@endpush