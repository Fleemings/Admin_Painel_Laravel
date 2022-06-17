@extends('admin.adminMaster')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h4 class="card-title">Edit Multi Image</h4>

                                <form action="{{ route('update.multi.image') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $imageMulti->id }}">
                                    <div class="row mb-3">
                                        <label for="example-text-input" class="col-sm-2 col-form-label"> Edit Image</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="file" name="multi_image" id="multi_image">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="example-text-input" class="col-sm-2 col-form-label"></label>
                                        <div class="col-sm-10">
                                            <img src="{{ !empty($imageMulti->multi_image) ? url('upload/multiImage/' . $imageMulti->multi_image) : url('upload/no_image.jpg') }}"
                                                alt="Card image cap" id="showImage" class="rounded avatar-lg">
                                        </div>
                                    </div>
                                    <input type="submit" value="Edit Image" class="btn btn-info waves-effect waves-light">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#multi_image').change(function(e) {
                let read = new FileReader();
                read.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                read.readAsDataURL(e.target.files['0']);
            })
        })
    </script>
@endsection
