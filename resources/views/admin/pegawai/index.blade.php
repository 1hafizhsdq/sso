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
                        <h5 class="card-title">Pegawai</h5>
    
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <select class="form-control select2" style="width: 70%; mt-3" name="skpd" id="skpd">
                                    <option value="">-- Pilih SKPD --</option>
                                    @foreach ($skpd as $opd)
                                    <option value="{{ $opd->id }}">{{ $opd->nama }}</option>
                                    @endforeach
                                </select>
                                <br>
                                <div class="row-lg-12">
                                    <table id="datatable" class="table table-bordered table-striped dataTable dtr-inline datatable">
                                        <thead class="text-center">
                                            <tr>
                                                <th>#</th>
                                                <th>NIP</th>
                                                <th>Jabatan</th>
                                                <th>Kode Jabatan</th>
                                                <th>Nama Pegawai</th>
                                                <th>Reset</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('script')
    <script src="{{ asset('adminlte') }}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('adminlte') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('adminlte') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('adminlte') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <!-- Select2 -->
    <script src="{{ asset('adminlte') }}/plugins/select2/js/select2.full.min.js"></script>
    <script>
        $('.select2').select2({
            theme: 'bootstrap4'
        })
    </script>
    <script>
        $(document).ready(function() {
            $('#skpd').change(function(){
                var skpd = $(this).val();
                
                $('#datatable').DataTable({
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: 'pns-skpd/' + skpd,
                    },
                    columns: [
                        { data: 'DT_RowIndex', class: 'text-center'},
                        { data: 'nip'},
                        { data: 'nama_jabatan'},
                        { data: 'kode_jabatan'},
                        { data: 'nama'},
                        { data: 'aksi', class: 'text-center'}
                    ],
                    destroy: true,
                }).on('click','#reset',function(){
                    // var nip = $(this).data('id');
                    
                    // $.ajax({
                    //     url : 'reset-pegawai/' + nip,
                    //     type: 'GET',
                    //     success:function(result){
                        
                    //     }
                    // });
                });
            })
        });
    </script>
@endpush