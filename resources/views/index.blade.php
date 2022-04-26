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
                <div class="col-sm-9">
                    <h1 class="m-0">Halo, <b>{{ session()->get('user')['nama'] }}</b></h1>
                    <p>{{ session()->get('user')['nip'] }}</p>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                @foreach ($aplikasi as $apk)
                <div class="col-md-3">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img style="height: 100px" class="profile-user-img img-fluid img-circle" src="{{ asset('icon_aplikasi') }}/{{ $apk->icon_aplikasi }}"
                                    alt="User profile picture">
                            </div>
                            <h3 class="profile-username text-center">{{ $apk->nama_aplikasi }}</h3>
                            <hr>
                            <a target="_blank" href="//{{ $apk->route_aplikasi }}" class="btn btn-primary btn-block"><b>Akses</b></a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
</div>
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