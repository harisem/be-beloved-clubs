@extends('templates.master')

@section('content')
    <div class="section-header">
        <h1>Slider Management</h1>
        <div class="section-header-breadcrumb">
            <a href="{{ url()->previous() }}" class="btn btn-primary"><i class="fas fa-chevron-left"></i> Back</a>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Upload Slider</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('sliders.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="image">Image</label>
                                    <input type="file" name="image" id="image" class="form-control" onchange="readURL(this)">
                                    <div class="image-area mt-4"><img id="imageResult" class="img-fluid rounded shadow-sm mx-auto d-block"></div>
                                </div>
                            </div>
                            <div class="card-footer pl-0">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h4>Sliders</h4>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped table-md">
                                <tr>
                                    <th>#</th>
                                    <th>Link</th>
                                    <th>Action</th>
                                </tr>
                                @foreach ($sliders as $slider)
                                <tr>
                                    <td>{{ $sliders->firstItem() + $loop->iteration - 1 }}</td>
                                    <td>{{ $slider->name }}</td>
                                    <td>{{ $slider->weight }}</td>
                                    <td>{{ $slider->price }}</td>
                                    <td>
                                        <a href="{{ route('sliders.edit', $slider->id) }}" class="btn btn-sm btn-secondary" role="button">Detail</a>
                                        <button type="button" href="{{ route('sliders.destroy', $slider->id) }}" class="btn btn-sm btn-warning" onclick="event.preventDefault(); document.getElementById('delete-slider-{{ $slider->id }}').submit();">
                                            Delete
                                        </button>
                                        <form action="{{ route('sliders.destroy', $slider->id) }}" method="POST" id="delete-slider-{{ $slider->id }}" style="display: none">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                                    @endforeach
                            </table>
                        </div>
                    </div>
                    <div class="card-footer text-right text-white-all">
                        <nav class="d-inline-block">
                            <ul class="pagination mb-0">
                                {{ $sliders->links() }}
                            </ul>
                        </nav>
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
    </script>
@endpush