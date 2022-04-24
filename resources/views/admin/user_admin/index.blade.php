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
                        <h5 class="card-title">User Admin</h5>
        
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
                                            <th>Nama Admin</th>
                                            <th>Username</th>
                                            <th width="13%" align="center"><a href="/useradmin/create" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Tambah</a></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($userAdmin as $apk)
                                            <tr>
                                                <td>{{ $apk->username }}</td>
                                                <td>{{ $apk->name }}</td>
                                                <td align="center">
                                                    <form action="{{ route('useradmin.destroy', $apk->id) }}" method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <a href="useradmin/{{ $apk->id }}/edit" class="btn btn-sm btn-warning"><i class="fas fa-pencil-alt"></i></a>
                                                        <button type="submit" onclick="confirm('Apakah anda yakin akan menghapus data ini!')" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
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