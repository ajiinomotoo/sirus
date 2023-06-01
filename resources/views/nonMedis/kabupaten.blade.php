@extends('layouts.main')

@section('linkhead')
    <link rel="stylesheet" href="/assets/css/datatables/datatables.min.css">
    <link href="/assets/css/select2.min.css" rel="stylesheet" />
    <link rel="prefetch">
@endsection

@section('container')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Non-Medis/</span> Kabupaten</h4>

    <div class="row">
        <!-- Form Data -->
        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Form Kabupaten</h5>
                </div>
                <div class="card-body">
                    <form id="kabForm" name="kabForm">

                        <div class="mb-3">
                            <label class="form-label" for="kab_id">ID Kabupaten :</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-id-card"></i></span>
                                <input type="text" class="form-control" id="kab_id" name="kab_id"
                                    placeholder="Input ID Kabupaten">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="kab_name">Kabupaten Name :</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-regular fa-building"></i></span>
                                <input type="text" class="form-control" id="kab_name" name="kab_name"
                                    placeholder="Input Kabupaten Name">
                            </div>
                        </div>

                        {{-- Kecamatan --}}
                        <div class="mb-3">
                            <label class="form-label" for="prop_id">Provinsi :</label>
                            <select class="select2-propinsi" name="prop_id" id="prop_id" style="width: 100%">
                                <option value="" disabled selected>Pilih Provinsi</option>
                                @foreach ($props as $prop)
                                    <option value="{{ $prop->prop_id }}">{{ $prop->prop_name }}</option>
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
                        <table class="table hover row-border stripe" id="kabupaten-datatable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Kota/Kabupaten</th>
                                    <th>Provinsi</th>
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
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="/assets/js/datatables/datatables.min.js"></script>

    {{-- Select2 JS --}}
    <script src="/assets/js/select2.min.js"></script>

    {{-- Page JS --}}
    <script src="/assets/js/form-basic-inputs.js"></script>

    <script type="text/javascript">
        $(function() {
            $('.select2-propinsi').select2({
                placeholder: "Pilih Provinsi"
            });
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var table = $('#kabupaten-datatable').DataTable({
                columnDefs: [{
                    targets: 3,
                    className: 'dt-center'
                }],
                processing: true,
                serverSide: true,
                ajax: "{{ route('kabupaten.index') }}",
                columns: [{
                        data: 'kab_id',
                        name: 'kab_id'
                    },
                    {
                        data: 'kab_name',
                        name: 'kab_name'
                    },
                    {
                        data: 'prop.prop_name',
                        name: 'prop.prop_name'
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
                    data: $('#kabForm').serialize(),
                    url: "{{ route('kabupaten.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {


                        // const myobj = JSON.parse(data.responseText);
                        // alert(JSON.stringify(data.success));
                        /* // Normalize and remove element and class is-invalid */
                        $('input').removeClass("is-invalid");
                        $('.invalid-feedback.d-block').remove();
                        toastr.success(JSON.stringify(data.success));
                        $('#kabForm').trigger("reset");
                        $('.select2-propinsi').val(null).trigger('change');
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

            $('body').on('click', '.editKab', function() {
                var kab_id = $(this).data('id');
                // alert(kasir_id);
                $.get("{{ route('kabupaten.index') }}" + '/' + kab_id + '/edit', function(data) {
                    $('#modelHeading').html("Edit Kab");
                    $('#myMethod').val("edit");
                    $('#saveBtn').html('Ubah');
                    $('#kab_id').val(data.kab_id);
                    $('#kab_id').val(data.kab_id);
                    $('#prop_id').val(data.prop_id);
                    $('#prop_id').val(data.prop_id).trigger('change');
                })
            });

            $('body').on('click', '.deleteKab', function() {

                var kab_id = $(this).data("id");
                if (confirm("Are you sure want to delete!") == true) {

                    $.ajax({
                        type: "DELETE",
                        url: "{{ route('kabupaten.store') }}" + '/' + kab_id,
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
