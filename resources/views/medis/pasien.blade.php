@extends('layouts.main')

@section('linkhead')
    <link rel="stylesheet" href="/assets/css/datatables/datatables.min.css">
    <link href="/assets/css/select2.min.css" rel="stylesheet" />
    <link rel="prefetch">
@endsection

@section('container')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Medis/</span> Pasien</h4>

    <!-- Form Data -->
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Form Pasien</h5>
            </div>

            <div class="card-body">
                <form id="pasienForm" name="pasienForm" class="needs-validation" novalidate>

                    <div class="row">
                        {{-- ID Pasien --}}
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="reg_no">ID Pasien :</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-id-card" disabled></i></span>
                                <input type="text" class="form-control" id="reg_no" name="reg_no"
                                    placeholder="Input ID Pasien" readonly value="{{ $noRM }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        {{-- Form Kiri --}}
                        <div class="group-form-kiri col-lg-6">
                            {{-- Nama Pasien --}}
                            <div class="mb-3">
                                <label class="form-label" for="reg_name">Pasien Name :</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa-solid fa-hospital"></i></span>
                                    <input type="text" class="form-control" id="reg_name" name="reg_name"
                                        onkeyup="validateName()" placeholder="Input Pasien Name">
                                    <span class="custom-error" id="name-error"></span>

                                </div>
                            </div>

                            {{-- JKN --}}
                            <div class="mb-3">
                                <label class="form-label" for="no_jkn">No. JKN :</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa-solid fa-hospital"></i></span>
                                    <input type="text" class="form-control" id="no_jkn" name="no_jkn"
                                        placeholder="Input No. JKN">
                                </div>
                            </div>

                            {{-- NIK --}}
                            <div class="mb-3">
                                <label class="form-label" for="nik_bpjs">NIK :</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa-solid fa-hospital"></i></span>
                                    <input type="text" class="form-control" id="nik_bpjs" name="nik_bpjs"
                                        placeholder="Input NIK">
                                </div>
                            </div>

                            {{-- Gender --}}
                            <div class="mb-3">
                                <label class="form-label" for="sex">Jenis Kelamin :</label>
                                <div class="col-sm">
                                    <div class="form-check form-check-inline mt-3">
                                        <input class="form-check-input" type="radio" name="sex" id="sex1"
                                            value="L" checked>
                                        <label class="form-check-label" for="sex1">Laki-Laki</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="sex" id="sex2"
                                            value="P">
                                        <label class="form-check-label" for="sex2">Perempuan</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                {{-- Usia --}}
                                <div class="mb-3 col-md-4">
                                    <label class="form-label" for="age">Umur :</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa-solid fa-hospital"></i></span>
                                        <input type="text" class="form-control" id="age" name="age"
                                            placeholder="Umur">
                                    </div>
                                </div>
                                {{-- Gol. Darah --}}
                                <div class="mb-3 col-md-4">
                                    <label class="form-label" for="blood">Gol. Darah :</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa-solid fa-hospital"></i></span>
                                        <select class="form-select" id="blood" name="blood">
                                            <option selected disabled>-</option>
                                            <option value="A">A</option>
                                            <option value="B">B</option>
                                            <option value="AB">AB</option>
                                            <option value="O">O</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            {{-- Tgl. Lahir --}}
                            <div class="mb-3">
                                <label for="birth_date" class="col-md-2 col-form-label">Tgl. Lahir :</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa-solid fa-hospital"></i></span>
                                    <input class="form-control" type="date" value="" id="birth_date"
                                        name="birth_date">
                                </div>
                            </div>

                            {{-- Tempat Lahir --}}
                            <div class="mb-3">
                                <label class="form-label" for="birth_place">Tempat Lahir :</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa-solid fa-hospital"></i></span>
                                    <input type="text" class="form-control" id="birth_place" name="birth_place"
                                        placeholder="Input Tempat Lahir">
                                </div>
                            </div>

                            {{-- Agama --}}
                            <div class="mb-3">
                                <label class="form-label" for="rel_id">Agama :</label>
                                <div class="input-group">
                                    <select class="form-select select2-agama" name="rel_id" id="rel_id"
                                        style="width:100%;">
                                        <option value="" disabled selected>Pilih Agama</option>
                                        @foreach ($rels as $rel)
                                            <option value="{{ $rel->rel_id }}">{{ $rel->rel_desc }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- Pendidikan --}}
                            <div class="mb-3">
                                <label class="form-label" for="edu_id">Pendidikan :</label>
                                <select class="form-select select2-pendidikan" name="edu_id" id="edu_id"
                                    style="width:100%;">
                                    <option value="" disabled selected>Pilih Pendidikan</option>
                                    @foreach ($edus as $edu)
                                        <option value="{{ $edu->edu_id }}">{{ $edu->edu_desc }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Pekerjaan --}}
                            <div class="mb-3">
                                <label class="form-label" for="job_id">Pekerjaan :</label>
                                <select class="form-select select2-pekerjaan" name="job_id" id="job_id"
                                    style="width:100%;">
                                    <option value="" disabled selected>Pilih Pekerjaan</option>
                                    @foreach ($jobs as $job)
                                        <option value="{{ $job->job_id }}">{{ $job->job_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- Form Kanan --}}
                        <div class="group-form-kanan col-lg-6">
                            {{-- Phone --}}
                            <div class="mb-3">
                                <label class="form-label" for="phone">Phone :</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa-solid fa-id-card"></i></span>
                                    <input type="text" class="form-control" id="phone" name="phone"
                                        placeholder="Input Phone">
                                </div>
                            </div>

                            {{-- Alamat --}}
                            <div class="mb-3">
                                <label for="address" class="form-label">Alamat :</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa-solid fa-id-card"></i></span>
                                    <textarea class="form-control" placeholder="Input Address" spellcheck="false" id="address" name="address"
                                        style="height: 125.5px"></textarea>
                                </div>
                            </div>

                            {{-- Desa --}}
                            <div class="mb-3">
                                <label class="form-label" for="des_id">Desa :</label>
                                <select class="form-select select2-desa" name="des_id" id="des_id"
                                    style="width:100%;">
                                    <option value="" disabled selected>Pilih Desa</option>
                                    @foreach ($desas as $desa)
                                        <option value="{{ $desa->des_id }}">{{ $desa->des_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- RT/RW --}}
                            <div class="row mb-1">
                                <div class="mb-2 col-md-5">
                                    <label class="form-label" for="rt">RT :</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa-solid fa-id-card"></i></span>
                                        <input type="text" class="form-control" id="rt" name="rt"
                                            placeholder="Input RT">
                                    </div>
                                </div>
                                <div class="mb-3 col-md-5">
                                    <label class="form-label" for="rw">RW :</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa-solid fa-id-card"></i></span>
                                        <input type="text" class="form-control" id="rw" name="rw"
                                            placeholder="Input RW">
                                    </div>
                                </div>
                            </div>

                            {{-- Kecamatan --}}
                            <div class="mb-3">
                                <label class="form-label" for="kec_id">Kecamatan :</label>
                                <div class="input-group">
                                    <select class="form-select select2-kecamatan" name="kec_id" id="kec_id"
                                        style="width:100%;">
                                        <option value="" disabled selected>Pilih Kecamatan</option>
                                        @foreach ($kecs as $kec)
                                            <option value="{{ $kec->kec_id }}">{{ $kec->kec_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- Kabupaten --}}
                            <div class="mb-3">
                                <label class="form-label" for="kab_id">Kabupaten :</label>
                                <select class="form-select select2-kabupaten" name="kab_id" id="kab_id"
                                    style="width:100%;">
                                    <option value="" disabled selected>Pilih Kecamatan</option>
                                    @foreach ($kabs as $kab)
                                        <option value="{{ $kab->kab_id }}">{{ $kab->kab_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Provinsi --}}
                            <div class="mb-3">
                                <label class="form-label" for="prop_id">Provinsi :</label>
                                <select class="form-select select2-provinsi" name="prop_id" id="prop_id"
                                    style="width:100%;">
                                    <option value="" disabled selected>Pilih Provinsi</option>
                                    @foreach ($props as $prop)
                                        <option value="{{ $prop->prop_id }}">{{ $prop->prop_name }}</option>
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
            <h5 class="card-header">Pasien Data</h5>
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table class="table hover row-border stripe" id="pasien-datatable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>No. JKN</th>
                                <th>NIK</th>
                                <th>Sex</th>
                                <th>Tgl. Lahir</th>
                                <th>Tempat Lahir</th>
                                <th>Phone</th>
                                <th>Alamat</th>
                                <th>Desa</th>
                                <th>Kecamatan</th>
                                <th>Kabupaten</th>
                                <th>Provinsi</th>
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

    {{-- Custom Validation Form --}}
    <script src="/js/customvalidform.js"></script>

    {{-- Page JS --}}
    <script src="/assets/js/form-basic-inputs.js"></script>

    <script type="text/javascript">
        $(function() {
            $('.select2-agama').select2({
                placeholder: "Pilih Agama"
            });
            $('.select2-pendidikan').select2({
                placeholder: "Pilih Pendidikan"
            });
            $('.select2-pekerjaan').select2({
                placeholder: "Pilih Pekerjaan"
            });
            $('.select2-desa').select2({
                placeholder: "Pilih Desa"
            });
            $('.select2-kecamatan').select2({
                placeholder: "Pilih Kecamatan"
            });
            $('.select2-kabupaten').select2({
                placeholder: "Pilih Kabupaten"
            });
            $('.select2-provinsi').select2({
                placeholder: "Pilih Provinsi"
            });
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var table = $('#pasien-datatable').DataTable({
                order: [
                    [0, 'desc']
                ],
                columnDefs: [{
                    targets: 13,
                    className: 'dt-center'
                }],
                processing: true,
                serverSide: true,
                ajax: "{{ route('pasien.index') }}",
                columns: [{
                        data: 'reg_no',
                        name: 'reg_no'
                    },
                    {
                        data: 'reg_name',
                        name: 'reg_name'
                    },
                    {
                        data: 'no_jkn',
                        name: 'no_jkn'
                    },
                    {
                        data: 'nik_bpjs',
                        name: 'nik_bpjs'
                    },
                    {
                        data: 'sex',
                        name: 'sex'
                    },
                    {
                        data: 'birth_date',
                        name: 'birth_date'
                    },
                    {
                        data: 'birth_place',
                        name: 'birth_place'
                    },
                    {
                        data: 'phone',
                        name: 'phone'
                    },
                    {
                        data: 'address',
                        name: 'address'
                    },
                    {
                        data: 'des_id',
                        name: 'des_id'
                    },
                    {
                        data: 'kec_id',
                        name: 'kec_id'
                    },
                    {
                        data: 'kab_id',
                        name: 'kab_id'
                    },
                    {
                        data: 'prop_id',
                        name: 'prop_id'
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
                    data: $('#pasienForm').serialize(),
                    url: "{{ route('pasien.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {

                        $('.select2-agama').val(null).trigger('change');
                        $('.select2-pendidikan').val(null).trigger('change');
                        $('.select2-pekerjaan').val(null).trigger('change');
                        $('.select2-desa').val(null).trigger('change');
                        $('.select2-kecamatan').val(null).trigger('change');
                        $('.select2-kabupaten').val(null).trigger('change');
                        $('.select2-provinsi').val(null).trigger('change');
                        $('input').removeClass("is-invalid");
                        $('textarea').removeClass("is-invalid");
                        $('select').removeClass("is-invalid");
                        $('.invalid-feedback.d-block').remove();
                        toastr.success(JSON.stringify(data.success));
                        $('#pasienForm').trigger("reset");
                        table.draw();
                        $('#myMethod').val("create");

                        $.ajax({
                            data: $('#pasienForm').serialize(),
                            url: "{{ route('pasienRegno') }}",
                            type: "GET",
                            // dataType: 'json',
                            success: function(data) {
                                $('#reg_no').val(data);
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

            $('body').on('click', '.editPasien', function() {
                var reg_no = $(this).data('id');
                // alert(kasir_id);
                $.get("{{ route('pasien.index') }}" + '/' + reg_no + '/edit', function(data) {
                    $('#modelHeading').html("Edit Pasien");
                    $('#myMethod').val("edit");
                    $('#saveBtn').html('Ubah');
                    $('#reg_no').val(data.reg_no);
                    $('#reg_name').val(data.reg_name);
                    $('#no_jkn').val(data.no_jkn);
                    $('#nik_bpjs').val(data.nik_bpjs);
                    $("input[name=sex][value=" + data.sex + "]").prop('checked', true);
                    $('#age').val(data.age);
                    $('#blood').val(data.blood);
                    $('#birth_date').val(data.birth_date);
                    $('#birth_place').val(data.birth_place);
                    $('#rel_id').val(data.rel_id).trigger('change');
                    $('#edu_id').val(data.edu_id).trigger('change');
                    $('#job_id').val(data.job_id).trigger('change');
                    $('#phone').val(data.phone);
                    $('#address').val(data.address);
                    $('#rt').val(data.rt);
                    $('#rw').val(data.rw);
                    $('#des_id').val(data.des_id).trigger('change');
                    $('#kec_id').val(data.kec_id).trigger('change');
                    $('#kab_id').val(data.kab_id).trigger('change');
                    $('#prop_id').val(data.prop_id).trigger('change');
                })
            });
            $('body').on('click', '.deletePasien', function() {
                var reg_no = $(this).data("id");
                if (confirm("Are you sure want to delete?") == true) {
                    $.ajax({
                        type: "DELETE",
                        url: "{{ route('pasien.store') }}" + '/' + reg_no,
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
