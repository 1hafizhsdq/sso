@extends('main.app')

{{-- @section('title', $title) --}}

@push('css')
@endpush

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"></h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Form User Admin</h5>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form action={{ ($status == 0) ? route('useradmin.store') : route('useradmin.update', $data->id) }} method="post" enctype="multipart/form-data">
                                    @csrf
                                    @if($status == 1)
                                        @method('PUT')
                                    @endif
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="name">Nama <small class="text-danger">*</small></label>
                                            <input type="text" class="form-control" name="name" id="name" placeholder="Masukkan nama" value="{{ ($status == 1) ? $data->name : "" }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="username">Username <small class="text-danger">*</small></label>
                                            <input type="text" class="form-control" name="username" id="username" placeholder="Masukkan username" value="{{ ($status == 1) ? $data->username : "" }}">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@push('script')

@endpush

@endsection