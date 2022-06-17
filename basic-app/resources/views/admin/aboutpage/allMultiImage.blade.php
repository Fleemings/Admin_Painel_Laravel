@extends('admin.adminMaster')
@section('admin')
    <div class="page-content">
        <div class="content-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Mult Images All</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Serial Number</th>
                                        <th>About Multi Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($allMultiImage as $item)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td><img src="{{ asset($item->multi_image) }}"
                                                    style="width: 60px; height: 60px;"></td>
                                            <td><a href="{{ route('edit.multi.image', $item->id) }}"
                                                    class="btn btn-info sm" title="Edit Data"> <i
                                                        class="fas fa-edit"></i></a> <a href=""
                                                    class="btn btn-danger sm" title="Delete Data" id="#delete"> <i
                                                        class="fas fa-trash-alt"></i></a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div>
    </div>
@endsection
