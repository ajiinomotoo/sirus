@extends('layouts.main')

@section('linkhead')
    <link rel="stylesheet" href="/assets/css/datatables/datatables.min.css">
    <link rel="prefetch">
@endsection

@section('container')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Medis/</span> Diagnosa</h4>

    <div class="row">
        <!-- Form Data -->
        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Form Diagnosa</h5>
                </div>
                <div class="card-body">
                    <form id="diagForm" name="diagForm">
                        <div class="mb-3">
                            <label class="form-label" for="diag_id">Diagnosa ID :</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-id-card"></i></span>
                                <input type="text" class="form-control" id="diag_id" name="diag_id"
                                    placeholder="Input Diagnosa ID">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="diag_desc">Diagnosa Description :</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-file-signature"></i></span>
                                <input type="text" class="form-control" id="diag_desc" name="diag_desc"
                                    placeholder="Input Diagnosa Description">
                            </div>
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
                <h5 class="card-header">Diagnosa Data</h5>
                <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <table class="table hover row-border stripe" id="diag-datatable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- <tr>
                                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>Angular
                                                Project</strong></td>
                                        <td>Albert Cook</td>
                                        <td>
                                            <div class="btn-action text-center">
                                                <button class="btn btn-primary btn-sm">Edit</button>
                                                <button class="btn btn-danger btn-sm">Hapus</button>
                                            </div>
                                        </td>
                                    </tr> --}}
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

    {{-- Page JS --}}
    <script src="/assets/js/form-basic-inputs.js"></script>

    <script type="text/javascript">
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var table = $('#diag-datatable').DataTable({
                columnDefs: [{
                    targets: 2,
                    className: 'dt-center'
                }],
                processing: true,
                serverSide: true,
                ajax: "{{ route('mstdiag.index') }}",
                columns: [{
                        data: 'diag_id',
                        name: 'diag_id'
                    },
                    {
                        data: 'diag_desc',
                        name: 'diag_desc'
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
                    data: $('#diagForm').serialize(),
                    url: "{{ route('mstdiag.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {


                        // const myobj = JSON.parse(data.responseText);
                        // alert(JSON.stringify(data.success));
                        /* // Normalize and remove element and class is-invalid */
                        $('input').removeClass("is-invalid");
                        $('.invalid-feedback.d-block').remove();
                        toastr.success(JSON.stringify(data.success));
                        $('#diagForm').trigger("reset");
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

            $('body').on('click', '.editDiag', function() {
                var diag_id = $(this).data('id');
                // alert(kasir_id);
                $.get("{{ route('mstdiag.index') }}" + '/' + diag_id + '/edit', function(data) {
                    $('#modelHeading').html("Edit Diagnosa");
                    $('#myMethod').val("edit");
                    $('#saveBtn').html('Ubah');
                    $('#diag_id').val(data.diag_id);
                    $('#diag_desc').val(data.diag_desc);

                })
            });

            $('body').on('click', '.deleteDiag', function() {

                var diag_id = $(this).data("id");
                if (confirm("Are you sure want to delete!") == true) {

                    $.ajax({
                        type: "DELETE",
                        url: "{{ route('mstdiag.store') }}" + '/' + diag_id,
                        success: function(data) {
                            toastr.success(JSON.stringify(data.success));
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
