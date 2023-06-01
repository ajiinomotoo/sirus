<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed " dir="ltr" data-theme="theme-default"
    data-assets-path="/assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Sirus-Slide</title>

    <meta name="description"
        content="Most Powerful &amp; Comprehensive Bootstrap 5 HTML Admin Dashboard Template built for developers!" />
    <meta name="keywords" content="dashboard, bootstrap 5 dashboard, bootstrap 5 design, bootstrap 5">

    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Canonical SEO -->
    <link rel="canonical" href="https://themeselection.com/products/sneat-bootstrap-html-admin-template/">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet">

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="/assets/vendor/fonts/boxicons.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">

    <!-- Core CSS -->
    <link rel="stylesheet" href="/assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="/assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <link rel="stylesheet" href="/assets/toastr/toastr.min.css">

    {{-- SweetAlert --}}
    <link rel="stylesheet" href="/assets/css/sweetalert2.min.css">


    {{-- Jquery Step --}}
    <link rel="stylesheet" href="/assets/css/jquery-steps.css">

    {{-- Select2 --}}
    <link href="/assets/css/select2.min.css" rel="stylesheet" />

    {{-- Autocomplete --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="/assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="/assets/js/config.js"></script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async="async" src="https://www.googletagmanager.com/gtag/js?id=GA_MEASUREMENT_ID"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'GA_MEASUREMENT_ID');
    </script>
    <!-- Custom notification for demo -->
    <!-- beautify ignore:end -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

    <!-- Layout wrapper -->
    <div class="layout-wrapper">
        <div class="container-fluid">
            <div class="bgcard card col-lg-12 my-5">
                <h1 style="text-align: center" class="my-4">SIRUS - SLIDE</h1>

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="step-app" id="form-slide">
                            {{-- Bar Header --}}
                            <ul class="step-steps">
                                <li data-step-target="step1">Step 1</li>
                                <li data-step-target="step2">Step 2</li>
                                <li data-step-target="step3">Step 3</li>
                            </ul>
                            <div class="step-content">

                                {{-- Step 1 --}}
                                <div class="step-tab-panel" data-step="step1">
                                    <div class="card-body">
                                        <form id="rjForm" name="rjForm">
                                            <div class="row">
                                                {{-- Reg No. --}}
                                                <div class="mb-3">
                                                    <label class="form-label" for="reg_no">No. Registrasi :</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i
                                                                class="fa-solid fa-hospital"></i></span>
                                                        <input type="text" class="form-control" id="reg_no"
                                                            name="reg_no" placeholder="Masukkan No. Registrasi">
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                {{-- Step 2 --}}
                                <div class="step-tab-panel" data-step="step2">
                                    <div class="card-body">
                                        <form id="rjForm2" name="rjForm2">
                                            <div class="row mb-5">
                                                {{-- No. Rawat Jalan --}}
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label" for="rj_no_step2">No. Rawat Jalan
                                                        :</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i class="fa-solid fa-id-card"
                                                                disabled></i></span>
                                                        <input type="text" class="form-control" id="rj_no_step2"
                                                            name="rj_no_step2" placeholder="Masukkan No. Rawat Jalan"
                                                            readonly value="{{ $noRj }}">
                                                    </div>
                                                </div>
                                                {{-- RJ Date --}}
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label" for="rj_date_step2">Tanggal Masuk
                                                        :</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i class="fa-solid fa-id-card"
                                                                disabled></i></span>
                                                        <input type="datetime-local" class="form-control"
                                                            id="rj_date_step2" name="rj_date_step2"
                                                            placeholder="01/01/2023" value="{{ $autodate }}"
                                                            readonly>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row">
                                                {{-- Form Kiri --}}
                                                <div class="group-form-kiri col-lg-6">
                                                    {{-- Reg No. --}}
                                                    <div class="mb-3">
                                                        <label class="form-label" for="reg_no_step2">No.
                                                            Registrasi</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text"><i
                                                                    class="fa-solid fa-hospital"></i></span>
                                                            <input type="text" class="form-control"
                                                                id="reg_no_step2" name="reg_no_step2"
                                                                placeholder="Masukkan No. Registrasi" readonly>
                                                        </div>
                                                    </div>

                                                    {{-- Reg Nama. --}}
                                                    <div class="mb-3">
                                                        <label class="form-label" for="reg_name">Nama :</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text"><i
                                                                    class="fa-solid fa-hospital"></i></span>
                                                            <input type="text" class="form-control"
                                                                id="reg_name_step2" name="reg_name"
                                                                placeholder="Masukkan Nama" disabled>
                                                        </div>
                                                    </div>
                                                    {{-- Phone --}}
                                                    <div class="mb-3">
                                                        <label class="form-label" for="phone">Telepon :</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text"><i
                                                                    class="fa-solid fa-id-card"></i></span>
                                                            <input type="text" class="form-control"
                                                                id="phone_step2" name="phone"
                                                                placeholder="Masukkan Nomor Telepon" disabled>
                                                        </div>
                                                    </div>

                                                    {{-- Alamat --}}
                                                    <div class="mb-3">
                                                        <label for="address" class="form-label">Alamat :</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text"><i
                                                                    class="fa-solid fa-id-card"></i></span>
                                                            <textarea class="form-control" placeholder="Masukkan Alamat" spellcheck="false" id="address_step2" name="address"
                                                                rows="3" style="height: 126px" disabled></textarea>
                                                        </div>
                                                    </div>


                                                </div>
                                                {{-- Form Kanan --}}
                                                <div class="group-form-kanan col-lg-6">
                                                    {{-- Poli --}}
                                                    <div class="mb-3">
                                                        <label class="form-label" for="poli_id_step2">Poli :</label>
                                                        <select class="form-select select2-poli" name="poli_id_step2"
                                                            id="poli_id_step2" style="width:100%;">
                                                            <option value="" disabled selected>Pilih Poli
                                                            </option>
                                                            @foreach ($polis as $poli)
                                                                <option value="{{ $poli->poli_id }}">
                                                                    {{ $poli->poli_desc }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    {{-- Dokter --}}
                                                    <div class="mb-3">
                                                        <label class="form-label" for="dr_id_step2">Dokter :</label>
                                                        <select class="form-select select2-dokter" name="dr_id_step2"
                                                            id="dr_id_step2" style="width:100%;">
                                                            <option value="" disabled selected>Pilih Dokter
                                                            </option>
                                                            @foreach ($doctors as $dokter)
                                                                <option value="{{ $dokter->dr_id }}">
                                                                    {{ $dokter->dr_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    {{-- Klaim --}}
                                                    <div class="mb-3">
                                                        <label class="form-label" for="klaim_id_step2">Klaim :</label>
                                                        <select class="form-select select2-klaim"
                                                            name="klaim_id_step2" id="klaim_id_step2"
                                                            style="width:100%;">
                                                            <option value="" disabled selected>Pilih Klaim
                                                            </option>
                                                            @foreach ($klaims as $klaim)
                                                                <option value="{{ $klaim->klaim_id }}">
                                                                    {{ $klaim->klaim_desc }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>


                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                {{-- Step 3 --}}
                                <div class="step-tab-panel" data-step="step3">
                                    <div class="card-body">
                                        <form id="rjForm3" name="rjForm3">
                                            <div class="row mb-5">
                                                {{-- No. Rawat Jalan --}}
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label" for="rj_no_step3">No. Rawat Jalan
                                                        :</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i class="fa-solid fa-id-card"
                                                                disabled></i></span>
                                                        <input type="text" class="form-control" id="rj_no_step3"
                                                            name="rj_no_step3" placeholder="Input No. Rawat Jalan"
                                                            readonly value="{{ $noRj }}">
                                                    </div>
                                                </div>
                                                {{-- RJ Date --}}
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label" for="rj_date_step3">Tanggal Masuk
                                                        :</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i class="fa-solid fa-id-card"
                                                                disabled></i></span>
                                                        <input type="datetime-local" class="form-control"
                                                            id="rj_date_step3" name="rj_date_step3"
                                                            placeholder="01/01/2023" value="{{ $autodate }}"
                                                            readonly>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row">
                                                {{-- Form Kiri --}}
                                                <div class="group-form-kiri col-lg-6">
                                                    {{-- Reg No. --}}
                                                    <div class="mb-3">
                                                        <label class="form-label" for="reg_no_step3">No. Registrasi
                                                            :</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text"><i
                                                                    class="fa-solid fa-hospital"></i></span>
                                                            <input type="text" class="form-control"
                                                                id="reg_no_step3" name="reg_no_step3"
                                                                placeholder="Masukkan Nomor Registrasi" readonly>
                                                        </div>
                                                    </div>

                                                    {{-- Reg Nama. --}}
                                                    <div class="mb-3">
                                                        <label class="form-label" for="reg_name">Nama :</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text"><i
                                                                    class="fa-solid fa-hospital"></i></span>
                                                            <input type="text" class="form-control"
                                                                id="reg_name_step3" name="reg_name"
                                                                placeholder="Input Reg Nama" disabled>
                                                        </div>
                                                    </div>
                                                    {{-- Phone --}}
                                                    <div class="mb-3">
                                                        <label class="form-label" for="phone">Telepon :</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text"><i
                                                                    class="fa-solid fa-id-card"></i></span>
                                                            <input type="text" class="form-control"
                                                                id="phone_step3" name="phone"
                                                                placeholder="Masukkan Nomor Telepon" disabled>
                                                        </div>
                                                    </div>

                                                    {{-- Alamat --}}
                                                    <div class="mb-3">
                                                        <label for="address" class="form-label">Alamat :</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text"><i
                                                                    class="fa-solid fa-id-card"></i></span>
                                                            <textarea class="form-control" placeholder="Masukkan Alamat" spellcheck="false" id="address_step3" name="address"
                                                                rows="3" style="height: 126px" disabled></textarea>
                                                        </div>
                                                    </div>


                                                </div>
                                                {{-- Form Kanan --}}
                                                <div class="group-form-kanan col-lg-6">
                                                    {{-- Poli --}}
                                                    <div class="mb-3">
                                                        <label class="form-label" for="poli_id_step3">Poli :</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text"><i
                                                                    class="fa-solid fa-id-card"></i></span>
                                                            <input type="text" class="form-control"
                                                                id="poli_id_step3" name="poli_id_step3" hidden>
                                                            <input type="text" class="form-control"
                                                                id="poli_desc_step3" name="poli_desc_step3" readonly>
                                                        </div>
                                                    </div>

                                                    {{-- Dokter --}}
                                                    <div class="mb-3">
                                                        <label class="form-label" for="dr_id_step3">Dokter :</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text"><i
                                                                    class="fa-solid fa-id-card"></i></span>
                                                            <input type="text" class="form-control"
                                                                id="dr_id_step3" name="dr_id_step3" hidden>
                                                            <input type="text" class="form-control"
                                                                id="dr_name_step3" name="dr_name_step3" readonly>
                                                        </div>
                                                    </div>

                                                    {{-- Klaim --}}
                                                    <div class="mb-3">
                                                        <label class="form-label" for="klaim_id_step3">Klaim
                                                            :</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text"><i
                                                                    class="fa-solid fa-id-card"></i></span>
                                                            <input type="text" class="form-control"
                                                                id="klaim_id_step3" name="klaim_id_step3" hidden>
                                                            <input type="text" class="form-control"
                                                                id="klaim_desc_step3" name="klaim_desc_step3"
                                                                readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>
                            <div class="step-footer">
                                <button data-step-action="prev" class="step-btn">Previous</button>

                                <button data-step-action="next" id="next-error" class="step-btn">Next</button>

                                <input id="myMethod" name="myMethod" type="hidden" value="create">
                                <button type="submit" data-step-action="finish" class="step-btn"
                                    id="saveBtn">Finish</button>
                            </div>
                        </div>
                    </div>
                    <!-- / Content -->
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- Card -->

        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>

    </div>
    <!-- / Layout wrapper -->

    {{-- Local JS --}}
    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="/assets/vendor/libs/popper/popper.js"></script>
    <script src="/assets/vendor/js/bootstrap.js"></script>
    <script src="/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="/assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Main JS -->
    <script src="/assets/js/main.js"></script>

    {{-- Toast --}}
    <script src="/assets/toastr/toastr.min.js"></script>

    {{-- SweetAlert --}}
    <script src="/assets/js/sweetalert2.min.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <script src="/assets/js/jquerystep/jquery-steps.js"></script>

    {{-- Select2 JS --}}
    <script src="/assets/js/select2.min.js"></script>

    {{-- Jquery UI (Autocomplete) --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <!-- End Core JS -->

    {{-- Text JS --}}

    {{-- Function Step & Validation --}}
    <script type="text/javascript">
        $(function() {
            // Function Step
            $('#form-slide').steps({
                onFinish: function() {
                    alert('complete');
                }
            });
        });
        // EndFunction Step
    </script>

    {{-- Funtion Steps, Autocomplete, Insert --}}
    <script type="text/javascript">
        $(function() {

            // Function Select2
            $(".select2-poli").select2({});
            $(".select2-dokter").select2({});
            $(".select2-klaim").select2({});
            // EndFunction Select2


            // Function AutoComplete
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
                    $('#reg_no_step2').val(ui.item.value);
                    $('#reg_name_step2').val(ui.item.reg_name);
                    $('#phone_step2').val(ui.item.phone);
                    $('#address_step2').val(ui.item.address);
                    $('#reg_no_step3').val(ui.item.value);
                    $('#reg_name_step3').val(ui.item.reg_name);
                    $('#phone_step3').val(ui.item.phone);
                    $('#address_step3').val(ui.item.address);
                }
            });
            // EndFunction AutoComplete

            // Function Autofill Select
            $('#poli_id_step2').on('change', function(e) {
                $('#poli_id_step2').select2({
                    // ...
                    templateSelection: function(data, container) {
                        // Add custom attributes to the <option> tag for the selected option
                        $(data.element).attr('data-custom-attribute', data.customValue);
                        $('#poli_desc_step3').val(data.text.trim());
                        $('#poli_id_step3').val(data.id);
                        return data.text;

                    }
                });

                // Retrieve custom attribute value of the first selected element
                $('#poli_id_step2').find(':selected').data('custom-attribute');
            });

            $('#dr_id_step2').on('change', function(e) {
                $('#dr_id_step2').select2({
                    // ...
                    templateSelection: function(data, container) {
                        // Add custom attributes to the <option> tag for the selected option
                        $(data.element).attr('data-custom-attribute', data.customValue);
                        $('#dr_name_step3').val(data.text.trim());
                        $('#dr_id_step3').val(data.id);
                        return data.text;

                    }
                });

                // Retrieve custom attribute value of the first selected element
                $('#dr_id_step2').find(':selected').data('custom-attribute');
            });

            $('#klaim_id_step2').on('change', function(e) {
                $('#klaim_id_step2').select2({
                    // ...
                    templateSelection: function(data, container) {
                        // Add custom attributes to the <option> tag for the selected option
                        $(data.element).attr('data-custom-attribute', data.customValue);
                        $('#klaim_desc_step3').val(data.text.trim());
                        $('#klaim_id_step3').val(data.id);
                        return data.text;

                    }
                });

                // Retrieve custom attribute value of the first selected element
                $('#klaim_id_step2').find(':selected').data('custom-attribute');
            });
            // EndFunction Autofill Select


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#saveBtn').click(function() {
                $(this).html('Finish');

                $.ajax({
                    data: $('#rjForm3').serialize(),
                    url: "{{ route('rjslide.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {
                        toastr.success(JSON.stringify(data.success));
                        $('#rjForm3').trigger("reset");
                        $('#myMethod').val("create");
                    },
                    error: function(data) {
                        /* // if error before insert data */
                        console.log('Error:', data);
                        const myobj = JSON.parse(data.responseText);
                        console.log(myobj.errors);
                        $('#saveBtn').html('Finish');
                    }
                });
            });


        });
    </script>
</body>

</html>
