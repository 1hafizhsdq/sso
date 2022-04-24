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
                        <h1 class="m-0">Dashboard Admin Pengelola</h1>
                    </div>
                </div>
            </div>
        </div>
    
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box shadow-none">
                            <span class="info-box-icon bg-info"><i class="fab fa-safari"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Aplikasi</span>
                                <a href="/aplikasi" class="info-box-number">Masuk Ke Aplikasi</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box shadow-sm">
                            <span class="info-box-icon bg-success"><i class="fas fa-users"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Pegawai</span>
                                <a class="info-box-number">Masuk Ke Aplikasi</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box shadow">
                            <span class="info-box-icon bg-warning"><i class="fas fa-user-cog"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">User Admin</span>
                                <a class="info-box-number">Masuk Ke User Admin</a>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box shadow-lg">
                            <span class="info-box-icon bg-danger"><i class="far fa-star"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Shadows</span>
                                <span class="info-box-number">Large</span>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </section>
    </div>
@endsection