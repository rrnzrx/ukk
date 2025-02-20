@extends('layouts.main')

@section('content')
    {{-- Edit --}}
    <div class="modal fade" id="editStudentModal" tabindex="-1" aria-labelledby="editStudentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered edit-modal">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="edit-form-container">
                        <h5 class="mb-4">Edit</h5>
                        <form>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="nisInput" class="form-label">NIS</label>
                                    <input type="text" class="form-control" id="nisInput" value="242166" readonly>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="nameInput" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="nameInput"
                                        value="Adrian Kanjeng Prasetyo">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="classSelect" class="form-label">Kelas</label>
                                    <select class="form-select" id="classSelect">
                                        <option value="1A" selected>Kelas</option>
                                        <option value="1B">1A</option>
                                        <option value="2A">1B</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="genderSelect" class="form-label">Jenis Kelamin</label>
                                    <select class="form-select" id="genderSelect">
                                        <option value="Laki-laki" selected>Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <label for="addressInput" class="form-label">Alamat</label>
                                    <textarea class="form-control" id="addressInput" rows="3">Jl. Jolotundo IV</textarea>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn-cancel" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn-save">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
