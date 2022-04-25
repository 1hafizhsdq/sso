@extends('main.app')

@push('css')
@endpush

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Ubah Username / Password</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="col-12 col-sm-12">
                <div class="card card-primary card-outline card-outline-tabs">
                    <div class="card-header p-0 border-bottom-0">
                        <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill"
                                    href="#custom-tabs-four-home" role="tab"
                                    aria-controls="custom-tabs-four-home" aria-selected="true">Username</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill"
                                    href="#custom-tabs-four-profile" role="tab"
                                    aria-controls="custom-tabs-four-profile" aria-selected="false">Password</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-four-tabContent">
                            <div class="tab-pane fade active show" id="custom-tabs-four-home" role="tabpanel"
                                aria-labelledby="custom-tabs-four-home-tab">
                                <form method="post" action="{{ (session()->get('user')['nip'] == "admin") ? route('edit-username-admin') : route('edit-username') }}" id="form-username" class="col-lg-6 col-sm-12">
                                    @csrf
                                    <input type="hidden" name="userid" id="userid" value="{{ $username->id }}">
                                    <div class="form-group">
                                        <label for="username_lama">Username Lama</label>
                                        <input type="text" class="form-control" id="username_lama" name="username_lama" value="{{ $username->username }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="username_baru">Username Baru</label>
                                        <input type="text" class="form-control" id="username_baru" name="username_baru">
                                    </div>
                                    <button type="submit" id="sv-username" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel"
                                aria-labelledby="custom-tabs-four-profile-tab">
                                <form method="post" action="{{ (session()->get('user')['nip'] == "admin") ? route('edit-password-admin') : route('edit-password') }}" id="form-password" class="col-lg-6 col-sm-12">
                                    @csrf
                                    <input type="hidden" name="userid" id="userid" value="{{ $username->id }}">
                                    <div class="form-group">
                                        <label for="password_lama">Password Lama</label>
                                        <input type="password" class="form-control" id="password_lama" name="password_lama">
                                    </div>
                                    <div class="form-group">
                                        <label for="password_baru">Password Baru</label>
                                        <input type="password" class="form-control" id="password_baru" name="password_baru">
                                    </div>
                                    <div class="form-group">
                                        <label for="re_password_baru">Ulangi Password Baru</label>
                                        <input type="password" class="form-control" id="re_password_baru" name="re_password_baru">
                                    </div>
                                    <button type="submit" id="sv-password" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection

@push('script')
{{-- <script>
    $('#sv-username').click(function() {
        var b = $(this),
            i = b.find('i'),
            cls = i.attr('class'),
            url = '',
            method = '';

        var form = $('#form-username'),
            data = form.serializeArray();
        
            url = "{{route('store-username')}}";
            method = 'POST';

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: url,
            method: method,
            data: data,
            beforeSend: function() {
                b.attr('disabled', 'disabled');
                i.removeClass().addClass('fa fa-spin fa-circle-o-notch');
            },
            success: function(result) {
                if (result.success) {
                    toastr['success'](result.success);
                    $('#username_lama').val(result.username);
                    $('#username_baru').val('');
                } else {
                    $.each(result.errors, function(key, value) {
                        toastr['error'](value);
                    });
                }
                b.removeAttr('disabled');
                i.removeClass().addClass(cls);

            },
            error: function() {
                b.removeAttr('disabled');
                i.removeClass().addClass(cls);
                
            }
        });
    });
    
    $('#sv-password').click(function() {
        var b = $(this),
            i = b.find('i'),
            cls = i.attr('class'),
            url = '',
            method = '';

        var form = $('#form-password'),
            data = form.serializeArray();
        
            url = "{{route('store-password')}}";
            method = 'POST';

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: url,
            method: method,
            data: data,
            beforeSend: function() {
                b.attr('disabled', 'disabled');
                i.removeClass().addClass('fa fa-spin fa-circle-o-notch');
            },
            success: function(result) {
                if (result.success) {
                    toastr['success'](result.success);
                    $('#password_lama').val('');
                    $('#password_baru').val('');
                    $('#re_password_baru').val('');
                } else {
                    $.each(result.errors, function(key, value) {
                        toastr['error'](value);
                    });
                }
                b.removeAttr('disabled');
                i.removeClass().addClass(cls);

            },
            error: function() {
                b.removeAttr('disabled');
                i.removeClass().addClass(cls);
                
            }
        });
    });
</script> --}}
@endpush