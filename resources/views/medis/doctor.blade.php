@extends('layouts.main')

@section('linkhead')
    <link rel="stylesheet" href="/assets/css/datatables/datatables.min.css">
    <link href="/assets/css/select2.min.css" rel="stylesheet" />
    <link rel="prefetch">
@endsection

@section('container')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Medis/</span> Dokter</h4>

    <!-- Form Data -->
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Form Dokter</h5>
            </div>

            <div class="card-body">
                <form id="doctorForm" name="doctorForm">

                    <div class="row">
                        {{-- ID Dokter --}}
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="dr_id">ID Dokter :</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-id-card"></i></span>
                                <input type="text" class="form-control" id="dr_id" name="dr_id"
                                    placeholder="Input ID Dokter">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        {{-- Form Kiri --}}
                        <div class="group-form-kiri col-lg-6">
                            {{-- Nama Dokter --}}
                            <div class="mb-3">
                                <label class="form-label" for="dr_name">Dokter Name :</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa-solid fa-hospital"></i></span>
                                    <input type="text" class="form-control" id="dr_name" name="dr_name"
                                        placeholder="Input Dokter Name">
                                </div>
                            </div>

                            {{-- Alamat --}}
                            <div class="mb-3">
                                <label for="dr_address" class="form-label">Alamat :</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa-solid fa-id-card"></i></span>
                                    <textarea class="form-control" placeholder="Input Alamat" spellcheck="false" id="dr_address" name="dr_address"
                                        rows="3" style="height: 126px"></textarea>
                                </div>
                            </div>

                            {{-- Contribution Status --}}
                            <div class="mb-3">
                                <label class="form-label" for="contribution_status">Contribution Status :</label>
                                <div class="col-sm">
                                    <div class="form-check form-check-inline mt-3">
                                        <input class="form-check-input" type="radio" name="contribution_status"
                                            id="contribution_status1" value="Aktif" checked>
                                        <label class="form-check-label" for="contribution_status1">Aktif</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="contribution_status"
                                            id="contribution_status2" value="Non-Aktif">
                                        <label class="form-check-label" for="contribution_status2">Non-Aktif</label>
                                    </div>
                                </div>
                            </div>

                            {{-- Active Status --}}
                            <div class="mb-5">
                                <label class="form-label" for="active_status">Contribution Status :</label>
                                <div class="col-sm">
                                    <div class="form-check form-check-inline mt-3">
                                        <input class="form-check-input" type="radio" name="active_status"
                                            id="active_status1" value="Aktif" checked>
                                        <label class="form-check-label" for="active_status1">Aktif</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="active_status"
                                            id="active_status2" value="Non-Aktif">
                                        <label class="form-check-label" for="active_status2">Non-Aktif</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Form Kanan --}}
                        <div class="group-form-kanan col-lg-6">
                            {{-- Phone --}}
                            <div class="mb-3">
                                <label class="form-label" for="dr_phone">Phone :</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa-solid fa-id-card"></i></span>
                                    <input type="text" class="form-control" id="dr_phone" name="dr_phone"
                                        placeholder="Input Phone">
                                </div>
                            </div>

                            {{-- Poli --}}
                            <div class="mb-3">
                                <label class="form-label" for="poli_id">Poli :</label>
                                <select class="form-select select2-poli" name="poli_id" id="poli_id">
                                    <option value="" disabled selected>Pilih Poli</option>
                                    @foreach ($polis as $poli)
                                        <option value="{{ $poli->poli_id }}">{{ $poli->poli_desc }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Poli --}}
                            <div class="mb-3">
                                <label class="form-label" for="poli_price">Poli Price :</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa-solid fa-id-card"></i></span>
                                    <input type="text" class="form-control" id="poli_price" name="poli_price"
                                        placeholder="Input Poli Price">
                                </div>
                            </div>

                            {{-- UGD Price --}}
                            <div class="mb-3">
                                <label class="form-label" for="ugd_price">UGD Price :</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa-solid fa-id-card"></i></span>
                                    <input type="text" class="form-control" id="ugd_price" name="ugd_price"
                                        placeholder="Input UGD Price">
                                </div>
                            </div>

                            {{-- Basic Salary --}}
                            <div class="mb-3">
                                <label class="form-label" for="basic_salary">Basic Salary :</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa-solid fa-id-card"></i></span>
                                    <input type="text" class="form-control" id="basic_salary" name="basic_salary"
                                        placeholder="Input UGD Price">
                                </div>
                            </div>

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
    <div class="col-lg-12">

        <div class="card">
            <h5 class="card-header">Dokter Data</h5>
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table class="table hover row-border stripe" id="doctor-datatable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>PHONE</th>
                                <th>POLI</th>
                                <th>HARGA &#40; POLI &#41;</th>
                                <th>HARGA &#40; UGD &#41;</th>
                                <th>HARGA &#40; BASIC &#41;</th>
                                <th>CONTRIBUTION</th>
                                <th>ACTIVE</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- <tr>
                                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>Angular
                                                Project</strong></td>
                                        <td>Albert Cook</td>
                                        <td>
                                            <div class="btn-action text-center">`
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
            $('.select2-poli').select2({
                placeholder: "Pilih Poli"
            });
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var table = $('#doctor-datatable').DataTable({
                columnDefs: [{
                    targets: 9,
                    className: 'dt-center',
                    targets: [4, 5, 6, 7, 8],
                    className: 'dt-body-center'
                }],
                processing: true,
                serverSide: true,
                ajax: "{{ route('doctor.index') }}",
                columns: [{
                        data: 'dr_id',
                        name: 'dr_id'
                    },
                    {
                        data: 'dr_name',
                        name: 'dr_name'
                    },
                    {
                        data: 'dr_phone',
                        name: 'dr_phone'
                    },
                    {
                        data: 'poli_id',
                        name: 'poli_id'
                    },
                    {
                        data: 'poli_price',
                        name: 'poli_price'
                    },
                    {
                        data: 'ugd_price',
                        name: 'ugd_price'
                    },
                    {
                        data: 'basic_salary',
                        name: 'basic_salary'
                    },
                    {
                        data: 'contribution_status',
                        name: 'contribution_status'
                    },
                    {
                        data: 'active_status',
                        name: 'active_status'
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
                    data: $('#doctorForm').serialize(),
                    url: "{{ route('doctor.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {


                        // const myobj = JSON.parse(data.responseText);
                        // alert(JSON.stringify(data.success));
                        /* // Normalize and remove element and class is-invalid */
                        $('input').removeClass("is-invalid");
                        $('.invalid-feedback.d-block').remove();
                        toastr.success(JSON.stringify(data.success));
                        $('#doctorForm').trigger("reset");
                        $('.select2-poli').val(null).trigger('change');
                        // $('#reg_no').val().trigger('change');
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

            $('body').on('click', '.editDoctor', function() {
                var dr_id = $(this).data('id');
                // alert(kasir_id);
                $.get("{{ route('doctor.index') }}" + '/' + dr_id + '/edit', function(data) {
                    $('#modelHeading').html("Edit Doctor");
                    $('#myMethod').val("edit");
                    $('#saveBtn').html('Ubah');
                    $('#dr_id').val(data.dr_id);
                    $('#dr_name').val(data.dr_name);
                    $('#dr_address').val(data.dr_address);
                    $('#dr_phone').val(data.dr_phone);
                    $('#poli_id').val(data.poli_id).trigger('change');
                    $('#poli_price').val(data.poli_price);
                    $('#ugd_price').val(data.ugd_price);
                    $('#basic_salary').val(data.basic_salary);
                    $("input[name=active_status][value=" + data.active_status + "]").prop('checked',
                        true);
                    $("input[name=contribution_status][value=" + data.contribution_status + "]")
                        .prop('checked',
                            true);

                })
            });

            $('body').on('click', '.deleteDoctor', function() {

                var dr_id = $(this).data("id");
                if (confirm("Are you sure want to delete?") == true) {

                    $.ajax({
                        type: "DELETE",
                        url: "{{ route('doctor.store') }}" + '/' + dr_id,
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
