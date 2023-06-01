@extends('layouts.main')

@section('linkhead')
    <link href="/assets/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
    <link rel="stylesheet" href="/assets/css/datatables/datatables.min.css">
    <link rel="prefetch">
@endsection

@section('container')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Medis/</span> Rawat Jalan</h4>

    <!-- Form Data -->
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Form Rawat Jalan</h5>
            </div>

            <div class="card-body">
                <form id="rjForm" name="rjForm">

                    <div class="row mb-5">
                        {{-- No. Rawat Jalan --}}
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="rj_no">No. Rawat Jalan :</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-id-card" disabled></i></span>
                                <input type="text" class="form-control" id="rj_no" name="rj_no"
                                    placeholder="Input No. Rawat Jalan" readonly value="{{ $noRj }}">
                            </div>
                        </div>
                        {{-- RJ Date --}}
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="rj_date">Tgl. :</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-id-card" disabled></i></span>
                                <input type="datetime-local" class="form-control" id="rj_date" name="rj_date"
                                    placeholder="Input Tgl." value="{{ $autodate }}">
                            </div>
                        </div>
                        {{-- No. Antri --}}
                        <div class="mb-3 col-md-2">
                            <label class="form-label" for="no_antrian">No. Antri :</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-id-card" disabled></i></span>
                                <input type="text" class="form-control" id="no_antrian" name="no_antrian"
                                    placeholder="No. Antri">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        {{-- Form Kiri --}}
                        <div class="group-form-kiri col-lg-6">
                            {{-- Reg No. --}}
                            <div class="mb-3">
                                <label class="form-label" for="reg_no">Reg No. :</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa-solid fa-hospital"></i></span>
                                    <input type="text" class="form-control" id="reg_no" name="reg_no"
                                        placeholder="Input Reg No.">
                                </div>
                            </div>

                            {{-- Reg Nama. --}}
                            <div class="mb-3">
                                <label class="form-label" for="reg_name">Reg Nama :</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa-solid fa-hospital"></i></span>
                                    <input type="text" class="form-control" id="reg_name" name="reg_name"
                                        placeholder="Input Reg Nama" disabled>
                                </div>
                            </div>
                            {{-- Phone --}}
                            <div class="mb-3">
                                <label class="form-label" for="phone">Phone :</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa-solid fa-id-card"></i></span>
                                    <input type="text" class="form-control" id="phone" name="phone"
                                        placeholder="Input Phone" disabled>
                                </div>
                            </div>

                            {{-- Alamat --}}
                            <div class="mb-3">
                                <label for="address" class="form-label">Alamat :</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa-solid fa-id-card"></i></span>
                                    <textarea class="form-control" placeholder="Input Address" spellcheck="false" id="address" name="address"
                                        rows="3" style="height: 126px" disabled></textarea>
                                </div>
                            </div>


                        </div>
                        {{-- Form Kanan --}}
                        <div class="group-form-kanan col-lg-6">
                            {{-- Poli --}}
                            <div class="mb-3">
                                <label class="form-label" for="poli_id">Poli :</label>
                                <select class="form-select select2-poli" name="poli_id" id="poli_id"
                                    style="width:100%;">
                                    <option value="" disabled selected>Pilih Poli</option>
                                    @foreach ($polis as $poli)
                                        <option value="{{ $poli->poli_id }}">{{ $poli->poli_desc }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Dokter --}}
                            <div class="mb-3">
                                <label class="form-label" for="dr_id">Dokter :</label>
                                <select class="form-select select2-dokter" name="dr_id" id="dr_id"
                                    style="width:100%;">
                                    <option value="" disabled selected>Pilih Dokter</option>
                                    @foreach ($doctors as $dokter)
                                        <option value="{{ $dokter->dr_id }}">{{ $dokter->dr_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Klaim --}}
                            <div class="mb-3">
                                <label class="form-label" for="klaim_id">Klaim :</label>
                                <select class="form-select select2-klaim" name="klaim_id" id="klaim_id"
                                    style="width:100%;">
                                    <option value="" disabled selected>Pilih Klaim</option>
                                    @foreach ($klaims as $klaim)
                                        <option value="{{ $klaim->klaim_id }}">{{ $klaim->klaim_desc }}</option>
                                    @endforeach
                                </select>
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
            <h5 class="card-header">Rawat Jalan Data</h5>
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table class="table hover row-border stripe" id="rj-datatable">
                        <thead>
                            <tr>
                                <th>RJ NO.</th>
                                <th>RJ DATE.</th>
                                <th>REG NAME</th>
                                <th>POLI</th>
                                <th>NO. ANTRIAN</th>
                                <th>DOKTER</th>
                                <th>KLAIM</th>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    {{-- Page JS --}}
    <script src="/assets/js/form-basic-inputs.js"></script>

    <script type="text/javascript">
        $(function() {
            $('#reg_no').autocomplete({
                minLength: 2,
                source: function(request, response) {
                    $.ajax({
                        url: "{{ route('getRegno') }}",
                        type: "GET",
                        dataType: "json",
                        data: {
                            search: request.term
                        },
                        success: function(data) {
                            response($.map(data, function(item) {
                                return {
                                    label: item.reg_no + ' / ' + item.nik_bpjs +
                                        ' / ' + item.reg_name,
                                    value: item.reg_no,
                                    reg_name: item.reg_name,
                                    phone: item.phone,
                                    address: item.address
                                };
                            }));
                        },
                        error: function(xhr, textStatus, errorThrown) {
                            if (xhr.status == 404) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Data Not Found!'
                                })
                            } else {
                                alert('An error occurred: ' + errorThrown);
                            }
                        },
                    });
                },
                select: function(event, ui) {
                    $('#reg_no').val(ui.item.value);
                    $('#reg_name').val(ui.item.reg_name);
                    $('#phone').val(ui.item.phone);
                    $('#address').val(ui.item.address);
                }
            });

            $('.select2-poli').select2({
                placeholder: "Pilih Poli"
            });
            $('.select2-dokter').select2({
                placeholder: "Pilih Dokter"
            });
            $('.select2-klaim').select2({
                placeholder: "Pilih Klaim"
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var table = $('#rj-datatable').DataTable({
                order: [
                    [0, 'desc']
                ],
                columnDefs: [{
                    targets: 7,
                    className: 'dt-center'
                }],
                processing: true,
                serverSide: true,
                ajax: "{{ route('rawatjalan.index') }}",
                columns: [{
                        data: 'rj_no',
                        name: 'rj_no'
                    },
                    {
                        data: 'rj_date',
                        name: 'rj_date'
                    },
                    {
                        data: 'reg_no',
                        name: 'reg_no'
                    },
                    {
                        data: 'poli_id',
                        name: 'poli_id'
                    },
                    {
                        data: 'no_antrian',
                        name: 'no_antrian'
                    },
                    {
                        data: 'dr_id',
                        name: 'dr_id'
                    },
                    {
                        data: 'klaim_id',
                        name: 'klaim_id'
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
                    data: $('#rjForm').serialize(),
                    url: "{{ route('rawatjalan.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {
                        $('.select2-poli').val(null).trigger('change');
                        $('.select2-dokter').val(null).trigger('change');
                        $('.select2-klaim').val(null).trigger('change');
                        $('input').removeClass("is-invalid");
                        $('textarea').removeClass("is-invalid");
                        $('select').removeClass("is-invalid");
                        $('.invalid-feedback.d-block').remove();
                        toastr.success(JSON.stringify(data.success));
                        $('#rjForm').trigger("reset");
                        table.draw();
                        $('#myMethod').val("create");

                        $.ajax({
                            data: $('#rjForm').serialize(),
                            url: "{{ route('rawatjalanRjno') }}",
                            type: "GET",
                            // dataType: 'json',
                            success: function(data) {
                                $('#rj_no').val(data);
                            },
                            error: function(data) {
                                /* // if error before insert data */
                                console.log('Error:', data.responseText);
                            }
                        });
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

            $('body').on('click', '.editRj', function() {
                var rj_no = $(this).data('id');
                // alert(kasir_id);
                $.get("{{ route('pasien.index') }}" + '/' + rj_no + '/edit', function(data) {
                    $('#modelHeading').html("Edit rawatJalan");
                    $('#myMethod').val("edit");
                    $('#saveBtn').html('Ubah');
                    $('#rj_no').val(data.rj_no);
                    $('#rj_date').val(data.rj_date);
                    $('#reg_no').val(data.reg_no);
                    $('#poli_id').val(data.poli_id);
                    $('#no_antri').val(data.no_antri);
                    $('#dr_id').val(data.dr_id);
                    $('#klaim_id').val(data.klaim_id);
                })
            });
            $('body').on('click', '.deleteRj', function() {
                var rj_no = $(this).data("id");
                if (confirm("Are you sure want to delete?") == true) {
                    $.ajax({
                        type: "DELETE",
                        url: "{{ route('rawatjalan.store') }}" + '/' + rj_no,
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
