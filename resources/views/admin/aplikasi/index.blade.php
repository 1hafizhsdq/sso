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
                        <h5 class="card-title">Aplikasi</h5>
        
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nama Aplikasi</th>
                                            <th>Route</th>
                                            <th width="13%" align="center"><a href="/aplikasi/create" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Tambah</a></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($aplikasi as $apk)
                                            <tr>
                                                <td>{{ $apk->nama_aplikasi }}</td>
                                                <td>{{ $apk->route_aplikasi }}</td>
                                                <td align="center">
                                                    <form action="{{ route('aplikasi.destroy', $apk->id) }}" method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <a href="aplikasi/{{ $apk->id }}/edit" class="btn btn-sm btn-warning"><i class="fas fa-pencil-alt"></i></a>
                                                        <a type="submit" onclick="confirm('Apakah anda yakin akan menghapus data ini!')" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
        $(function () {
            $('#example1').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endpush

@endsection