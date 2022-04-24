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
                        <h5 class="card-title">Form Aplikasi</h5>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form action={{ ($status == 0) ? route('aplikasi.store') : route('aplikasi.update', $data->id) }} method="post" enctype="multipart/form-data">
                                    @csrf
                                    @if($status == 1)
                                        @method('PUT')
                                    @endif
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="nama_aplikasi">Nama Aplikasi</label>
                                            <input type="text" class="form-control" name="nama_aplikasi" id="nama_aplikasi" placeholder="Masukkan nama aplikasi" value="{{ ($status == 1) ? $data->nama_aplikasi : "" }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="rote_aplikasi">Route Aplikasi</label>
                                            <input type="text" class="form-control" name="route_aplikasi" id="rote_aplikasi" placeholder="Masukkan route aplikasi" value="{{ ($status == 1) ? $data->route_aplikasi : "" }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="icon_aplikasi">File input</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="icon_aplikasi" id="icon_aplikasi">
                                                    <label class="custom-file-label" for="icon_aplikasi">Choose file</label>
                                                </div>
                                            </div>
                                            <small class="text-danger">Perhatian : Tipe file : jpg,jpeg,png. Max size : 2mb</small>
                                            <img style="{{ ($status == 0) ? "display:none;" : "display:block;" }}" width="100px" height="100px" id="preview" src="{{ ($status == 1) ? ("\icon_aplikasi/".$data->icon_aplikasi) : "#" }}" alt="your image" />
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
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
        
            reader.onload = function(e) {
                $('#preview').css('display', 'block');
                $('#preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
        
    $("#icon_aplikasi").change(function() {
        readURL(this);
    });
</script>
@endpush

@endsection