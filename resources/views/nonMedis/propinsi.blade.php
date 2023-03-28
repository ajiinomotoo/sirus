@extends('layouts.main')


@section('container')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Non-Medis/</span> Provinsi</h4>

    <div class="row">
        <!-- Form Data -->
        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Form Provinsi</h5>
                </div>
                <div class="card-body">
                    <form id="propForm" name="propForm">
                        <div class="mb-3">
                            <label class="form-label" for="prop_id">ID Provinsi :</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class='bx bx-id-card'></i></span>
                                <input type="text" class="form-control" id="prop_id" name="prop_id"
                                    placeholder="Input ID Provinsi">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="prop_name">Provinsi Name :</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-user"></i></span>
                                <input type="text" class="form-control" id="prop_name" name="prop_name"
                                    placeholder="Input Provinsi Name">
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
                <h5 class="card-header">Provinsi Data</h5>
                <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <table class="table table-bordered propinsi-datatable">
                            <thead>
                                <tr>
                                    <th width="1%">ID</th>
                                    <th width="50%">Name</th>
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
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

    <script type="text/javascript">
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var table = $('.propinsi-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('propinsi.index') }}",
                columns: [{
                        data: 'prop_id',
                        name: 'prop_id'
                    },
                    {
                        data: 'prop_name',
                        name: 'prop_name'
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
                    data: $('#propForm').serialize(),
                    url: "{{ route('propinsi.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {


                        // const myobj = JSON.parse(data.responseText);
                        // alert(JSON.stringify(data.success));
                        /* // Normalize and remove element and class is-invalid */
                        $('input').removeClass("is-invalid");
                        $('.invalid-feedback.d-block').remove();
                        toastr.success(JSON.stringify(data.success));
                        $('#propForm').trigger("reset");
                        table.draw();
                        $('#myMethod').val("edit");

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

            $('body').on('click', '.editProp', function() {
                var prop_id = $(this).data('id');
                // alert(kasir_id);
                $.get("{{ route('propinsi.index') }}" + '/' + prop_id + '/edit', function(data) {
                    $('#modelHeading').html("Edit Prop");
                    $('#myMethod').val("edit");
                    $('#saveBtn').html('Ubah');
                    $('#prop_id').val(data.prop_id);
                    $('#prop_name').val(data.prop_name);

                })
            });

            $('body').on('click', '.deleteProp', function() {

                var prop_id = $(this).data("id");
                if (confirm("Are You sure want to delete!") == true) {

                    $.ajax({
                        type: "DELETE",
                        url: "{{ route('propinsi.store') }}" + '/' + prop_id,
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
