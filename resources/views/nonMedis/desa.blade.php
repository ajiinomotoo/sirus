@extends('layouts.main')

@section('linkhead')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <link rel="prefetch">
@endsection

@section('container')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Non-Medis/</span> Desa</h4>

    <div class="row">
        <!-- Form Data -->
        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Form Desa</h5>
                </div>
                <div class="card-body">
                    <form id="desaForm" name="desaForm">

                        <div class="mb-3">
                            <label class="form-label" for="des_id">ID Desa :</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="fa-solid fa-id-card"></i></span>
                                <input type="text" class="form-control" id="des_id" name="des_id"
                                    placeholder="Input ID Desa">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="des_name">Desa Name :</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="fa-regular fa-building"></i></span>
                                <input type="text" class="form-control" id="des_name" name="des_name"
                                    placeholder="Input Desa Name">
                            </div>
                        </div>

                        {{-- Kecamatan --}}
                        <div class="mb-3">
                            <label class="form-label" for="kec_id">Kecamatan :</label>
                            <select class="form-select select2-kecamatan" name="kec_id" id="kec_id">
                                <option value="" disabled selected>Pilih Kecamatan</option>
                                @foreach ($kecs as $kec)
                                    <option value="{{ $kec->kec_id }}">{{ $kec->kec_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <input id="myMethod" name="myMethod" type="hidden" value="create">
                        <button type="submit" class="btn btn-success" id="saveBtn">
                            Simpan</button>
                    </form>
                </div>
            </div>
        </div>


        {{-- Table Data --}}
        <div class="col-lg-8">

            <div class="card">
                <h5 class="card-header">Desa Data</h5>
                <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <table class="table table-hover" id="desa-datatable">
                            <thead>
                                <tr>
                                    <th width="1%">ID</th>
                                    <th width="50%">Name</th>
                                    <th width="50%">Kecamatan</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @foreach ($kotas as $kota)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $kota->kota_name }}</td>
                                        <td>{{ $kota->prov->prov_name }}</td>
                                        <td>
                                            <div class="btn-action text-center">
                                                <button class="btn btn-primary btn-sm">Edit</button>
                                                <button class="btn btn-danger btn-sm">Hapus</button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    </div>
@endsection

@push('scriptbody')
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

    {{-- Select2 JS --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    {{-- Page JS --}}
    <script src="/assets/js/form-basic-inputs.js"></script>

    <script type="text/javascript">
        $(function() {
            $('.select2-kecamatan').select2();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var table = $('#desa-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('desa.index') }}",
                columns: [{
                        data: 'des_id',
                        name: 'des_id'
                    },
                    {
                        data: 'des_name',
                        name: 'des_name'
                    },
                    {
                        data: 'kec.kec_name',
                        name: 'kec.kec_name'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            $('#saveBtn').click(function(e) {
                e.preventDefault();
                $(this).html('Simpan');

                $.ajax({
                    data: $('#desaForm').serialize(),
                    url: "{{ route('desa.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {


                        // const myobj = JSON.parse(data.responseText);
                        // alert(JSON.stringify(data.success));
                        /* // Normalize and remove element and class is-invalid */
                        $('input').removeClass("is-invalid");
                        $('.invalid-feedback.d-block').remove();
                        toastr.success(JSON.stringify(data.success));
                        $('#desaForm').trigger("reset");
                        $('.select2-kecamatan').val(null).trigger('change');
                        table.draw();
                        $('#myMethod').val("create");
                    },
                    error: function(data) {
                        /* // if error before insert data */
                        console.log('Error:', data);
                        const myobj = JSON.parse(data.responseText);
                        console.log(myobj.errors);
                        $('.invalid-feedback.d-block').remove();
                        /* // looping errors add create message */
                        $.each(myobj.errors, function(i) {
                            $.each(myobj.errors[i], function(key, value) {
                                /* // add element and class is-invalid */
                                $('#' + i).addClass("is-invalid");
                                $('#' + i).after(
                                    `<div class="invalid-feedback d-block">${value}</div>`
                                );

                            });
                        });
                        $('#saveBtn').html('Simpan');
                    }
                });
            });

            $('body').on('click', '.editDesa', function() {
                var des_id = $(this).data('id');
                // alert(kasir_id);
                $.get("{{ route('desa.index') }}" + '/' + des_id + '/edit', function(data) {
                    $('#modelHeading').html("Edit Desa");
                    $('#myMethod').val("edit");
                    $('#saveBtn').html('Ubah');
                    $('#des_id').val(data.des_id);
                    $('#des_name').val(data.des_name);
                })
            });

            $('body').on('click', '.deleteDesa', function() {

                var des_id = $(this).data("id");
                if (confirm("Are you sure want to delete?") == true) {

                    $.ajax({
                        type: "DELETE",
                        url: "{{ route('desa.store') }}" + '/' + des_id,
                        success: function(data) {
                            table.draw();
                        },
                        error: function(data) {
                            alert(JSON.stringify(data));
                            console.log('Error:', data);
                        }
                    });
                }
            });

        });
    </script>
@endpush
