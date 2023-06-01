<div>
    @if(!empty($successMessage))
    <div class="alert alert-success">
       {{ $successMessage }}
    </div>
    @endif
      
    <div class="text-center">
        <!-- progressbar -->
        <ul class="progressbar">
            <li class="{{ $currentStep != 1 ? '' : 'active' }}"><a href="#step-1" type="button">Step 1</a></li>
            <li class="{{ $currentStep != 2 ? '' : 'active' }}"><a href="#step-2" type="button">Step 2</a></li>
            <li class="{{ $currentStep != 3 ? '' : 'active' }}"><a href="#step-3" type="button" disabled="disabled">Step 3</a></li>
        </ul>
    </div>

        {{-- Step 1 --}}
        <div class="row setup-content {{ $currentStep != 1 ? 'displayNone' : '' }}" id="step-1">
            <div class="col-xs-12">
                <div class="col-md-12">

                    <h2> Registrasi</h2>

                    <div class="form-group">
                        <label class="fomr-label" for="reg_no">No. Registrasi :</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-hospital"></i></span>
                            <input type="text" wire:model="reg_no" name="reg_no" class="form-control" id="reg_no" placeholder="Masukkan No. Registrasi">
                            @error('reg_no') <span class="error">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <button class="btn btn-primary nextBtn btn-lg pull-right" wire:click="firstStepSubmit" type="button" >Next</button>
                </div>
            </div>
        </div>

        {{-- Step 2 --}}
        <div class="row setup-content {{ $currentStep != 2 ? 'displayNone' : '' }}" id="step-2">
            <div class="col-xs-12">
                <div class="col-md-12">

                    <h2> Data Pasien</h2>

                    <div class="row mb-5">
                        {{-- No. Rawat Jalan --}}
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="rj_no_step2">No. Rawat Jalan
                                :</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-id-card"
                                        disabled></i></span>
                                <input wire:model="rj_no" type="text" class="form-control" id="rj_no_step2"
                                    name="rj_no_step2" placeholder="Masukkan No. Rawat Jalan" readonly
                                    value="{{ $noRj }}">
                            @error('rj_no_step2') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        {{-- RJ Date --}}
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="rj_date_step2">Tanggal Masuk
                                :</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-id-card"
                                        disabled></i></span>
                                <input wire:model="rj_date" type="datetime-local" class="form-control" id="rj_date_step2"
                                    name="rj_date_step2" placeholder="01/01/2023"
                                    value="{{ $autodate }}" readonly>
                            @error('rj_date_step2') <span class="error">{{ $message }}</span> @enderror
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
                                    <input wire:model="reg_no" type="text" class="form-control" id="reg_no_step2"
                                        name="reg_no_step2" placeholder="Masukkan No. Registrasi"
                                        readonly>
                            @error('reg_no_step2') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            {{-- Reg Nama. --}}
                            <div class="mb-3">
                                <label class="form-label" for="reg_name">Nama :</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i
                                            class="fa-solid fa-hospital"></i></span>
                                    <input type="text" class="form-control" id="reg_name_step2"
                                        name="reg_name" placeholder="Masukkan Nama" disabled>
                            @error('reg_name_step2') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            {{-- Phone --}}
                            <div class="mb-3">
                                <label class="form-label" for="phone">Telepon :</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i
                                            class="fa-solid fa-id-card"></i></span>
                                    <input type="text" class="form-control" id="phone_step2"
                                        name="phone" placeholder="Masukkan Nomor Telepon" disabled>
                            @error('phone_step2') <span class="error">{{ $message }}</span> @enderror
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
                            @error('address_step2') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>


                        </div>
                        {{-- Form Kanan --}}
                        <div class="group-form-kanan col-lg-6">
                            {{-- Poli --}}
                            <div class="mb-3">
                                <label class="form-label" for="poli_id_step2">Poli :</label>
                                <select class="form-select select2-poli" name="poli_id_step2"
                                    id="poli_id_step2" style="width:100%;" wire:model="poli_id">
                                    <option value="" disabled selected>Pilih Poli
                                    </option>
                                    @foreach ($polis as $poli)
                                        <option value="{{ $poli->poli_id }}">
                                            {{ $poli->poli_desc }}</option>
                                    @endforeach
                            @error('poli_id_step2') <span class="error">{{ $message }}</span> @enderror
                                </select>
                            </div>

                            {{-- Dokter --}}
                            <div class="mb-3">
                                <label class="form-label" for="dr_id_step2">Dokter :</label>
                                <select class="form-select select2-dokter" name="dr_id_step2"
                                    id="dr_id_step2" style="width:100%;" wire:model="dr_id">
                                    <option value="" disabled selected>Pilih Dokter
                                    </option>
                                    @foreach ($doctors as $dokter)
                                        <option value="{{ $dokter->dr_id }}">
                                            {{ $dokter->dr_name }}</option>
                                    @endforeach
                                </select>
                            @error('dr_id_step2') <span class="error">{{ $message }}</span> @enderror
                            </div>

                            {{-- Klaim --}}
                            <div class="mb-3">
                                <label class="form-label" for="klaim_id_step2">Klaim :</label>
                                <select class="form-select select2-klaim" name="klaim_id_step2"
                                    id="klaim_id_step2" style="width:100%;" wire:model="klaim_id">
                                    <option value="" disabled selected>Pilih Klaim
                                    </option>
                                    @foreach ($klaims as $klaim)
                                        <option value="{{ $klaim->klaim_id }}">
                                            {{ $klaim->klaim_desc }}</option>
                                    @endforeach
                                </select>
                            @error('klaim_id_step2') <span class="error">{{ $message }}</span> @enderror
                            </div>


                        </div>
                    </div>

                    <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" wire:click="secondStepSubmit">Next</button>
                    <button class="btn btn-danger nextBtn btn-lg pull-right" type="button" wire:click="back(1)">Back</button>
                </div>
            </div>
        </div>

        {{-- Step 3 --}}
        <div class="row setup-content {{ $currentStep != 3 ? 'displayNone' : '' }}" id="step-3">
            <div class="col-xs-12">
                <div class="col-md-12">

                    <h3> Cek Data</h3>

                                                       <div class="row mb-5">
                                        {{-- No. Rawat Jalan --}}
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label" for="rj_no_step3">No. Rawat Jalan
                                                :</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fa-solid fa-id-card"
                                                        disabled></i></span>
                                                <input type="text" class="form-control" id="rj_no_step3"
                                                    name="rj_no_step3" placeholder="Input No. Rawat Jalan" readonly
                                                    value="{{ $noRj }}">
                                            </div>
                                        </div>
                                        {{-- RJ Date --}}
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label" for="rj_date_step3">Tanggal Masuk
                                                :</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fa-solid fa-id-card"
                                                        disabled></i></span>
                                                <input type="datetime-local" class="form-control" id="rj_date_step3"
                                                    name="rj_date_step3" placeholder="01/01/2023"
                                                    value="{{ $autodate }}" readonly>
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
                                                    <input type="text" class="form-control" id="reg_no_step3"
                                                        name="reg_no_step3" placeholder="Masukkan Nomor Registrasi"
                                                        readonly>
                                                </div>
                                            </div>

                                            {{-- Reg Nama. --}}
                                            <div class="mb-3">
                                                <label class="form-label" for="reg_name">Nama :</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i
                                                            class="fa-solid fa-hospital"></i></span>
                                                    <input type="text" class="form-control" id="reg_name_step3"
                                                        name="reg_name" placeholder="Input Reg Nama" disabled>
                                                </div>
                                            </div>
                                            {{-- Phone --}}
                                            <div class="mb-3">
                                                <label class="form-label" for="phone">Telepon :</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i
                                                            class="fa-solid fa-id-card"></i></span>
                                                    <input type="text" class="form-control" id="phone_step3"
                                                        name="phone" placeholder="Masukkan Nomor Telepon" disabled>
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
                                                    <input type="text" class="form-control" id="poli_id_step3"
                                                        name="poli_id_step3" hidden>
                                                    <input type="text" class="form-control" id="poli_desc_step3"
                                                        name="poli_desc_step3" readonly>
                                                </div>
                                            </div>

                                            {{-- Dokter --}}
                                            <div class="mb-3">
                                                <label class="form-label" for="dr_id_step3">Dokter :</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i
                                                            class="fa-solid fa-id-card"></i></span>
                                                    <input type="text" class="form-control" id="dr_id_step3"
                                                        name="dr_id_step3" hidden>
                                                    <input type="text" class="form-control" id="dr_name_step3"
                                                        name="dr_name_step3" readonly>
                                                </div>
                                            </div>

                                            {{-- Klaim --}}
                                            <div class="mb-3">
                                                <label class="form-label" for="klaim_id_step3">Klaim
                                                    :</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i
                                                            class="fa-solid fa-id-card"></i></span>
                                                    <input type="text" class="form-control" id="klaim_id_step3"
                                                        name="klaim_id_step3" hidden>
                                                    <input type="text" class="form-control" id="klaim_desc_step3"
                                                        name="klaim_desc_step3" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                    <button class="btn btn-success btn-lg pull-right" wire:click="submitForm" type="button">Finish!</button>
                    <button class="btn btn-danger nextBtn btn-lg pull-right" type="button" wire:click="back(2)">Back</button>
                </div>
            </div>
        </div>
    </div>