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
                <div class="card text-center mr-3" style="width: 18rem;">
                    <div class="card-body">
                        <div class="row text-center"><h5 class="card-title"><b>{{ $apk->nama_aplikasi }}</b></h5></div>
                        <div class="row"><img src="{{ asset('icon_aplikasi') }}/{{ $apk->icon_aplikasi }}" alt="{{ $apk->nama_aplikasi }}" class="brand-image img-circle elevation-3" width="100px" height="100px"></div>
                        <div class="row"><a href="#" class="btn btn-primary">Akses</a></div>
                    </div>
                </div>
                @endforeach
                <div class="col-md-3">
                    </div>
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