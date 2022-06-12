@extends('admin.adminMaster')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Home Slide page</h4>

                            <form method="POST" action="{{ route('update.slider') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $homeSlide->id }}">
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Title</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="title" id="title" name="title"
                                            value="{{ $homeSlide->title }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Short Title</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" id="email" name="short_title"
                                            value="{{ $homeSlide->short_title }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Video URL</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" id="video_url" name="video_url"
                                            value="{{ $homeSlide->video_url }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Slider Image</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="file" id="home_slide" name="home_slide">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">
                                        <img class="rounded avatar-lg"
                                            src="{{ !empty($homeSlide->home_slide) ? url('upload/homeSlider/' . $homeSlide->home_slide) : url('upload/no_image.jpg') }}"
                                            alt="Card image cap" id="showImg">
                                    </div>
                                </div>
                                <input type="submit" value="Update slide" class="btn btn-info waves-effect waves-light">
                            </form>
                            <!-- end row -->

                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#home_slide').change(function(e) {
                var read = new FileReader();
                read.onload = function(e) {
                    $('#showImg').attr('src', e.target.result);
                }
                read.readAsDataURL(e.target.files['0']);
            })
        })
    </script>
@endsection
