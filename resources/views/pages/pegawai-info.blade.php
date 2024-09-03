<div class="card" style="width: 100%;">
    <div class="card-body">
        <div class="mb-4"></div>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Data Pegawai</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Posisi</button>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                <div class="d-flex">
                    <h5 class="card-title">Data pegawai</h5>
                    @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                        <button class="ms-auto my-auto btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{$pegawai->id}}"><i class="bi bi-pencil-square"></i></button>  
                    @endif
                </div>
                <div class="d-flex">
                    <div class="w-25">
                        <img src="/assets/img/pegawai-prof-pic.png" alt="profile pic" class="w-100">
                    </div>
                    <div class="ms-5">
                        <h6 class="card-subtitle mb-2 text-body-secondary"><span class="fw-bold">Nama : </span> {{$pegawai->name}}</h6>
                        <br>
                        <h6 class="card-subtitle mb-2 text-body-secondary"><span class="fw-bold">NIP : </span> {{$pegawai->nip}}</h6>
                        <br>
                        <h6 class="card-subtitle mb-2 text-body-secondary"><span class="fw-bold">Email : </span> {{$pegawai->email}}</h6>
                        <br>
                        <h6 class="card-subtitle mb-2 text-body-secondary"><span class="fw-bold">Unit Kerja : </span> {{$pegawai->unit_kerja->name}}</h6>
                        <br>
                        <h6 class="card-subtitle mb-2 text-body-secondary"><span class="fw-bold">Jurusan : </span> {{$pegawai->jurusan->name}}</h6>
                        <br>
                        <h6 class="card-subtitle mb-2 text-body-secondary"><span class="fw-bold">Program Studi : </span> {{$pegawai->prodi->name}}</h6>
                        <br>
                        <h6 class="card-subtitle mb-2 text-body-secondary"><span class="fw-bold">Grade : </span> {{$pegawai->grade->name}}</h6>
                        <br>
                        <h6 class="card-subtitle mb-2 text-body-secondary"><span class="fw-bold">Golongan : </span> {{$pegawai->golongan->name}}</h6>
                        <br>
                        <h6 class="card-subtitle mb-2 text-body-secondary"><span class="fw-bold">Kelompok Pegawai : </span> {{$pegawai->kelompok_pegawai->name}}</h6>
                        <br>
                        <h6 class="card-subtitle mb-2 text-body-secondary"><span class="fw-bold">Jenis Pegawai : </span> {{$pegawai->jenis_pegawai->name}}</h6>
                        <br>
                        <h6 class="card-subtitle mb-2 text-body-secondary"><span class="fw-bold">Pendidikan : </span> {{$pegawai->pendidikan->name}}</h6>
                        <br>
                        <h6 class="card-subtitle mb-2 text-body-secondary"><span class="fw-bold">Jabatan Struktural : </span> {{$pegawai->jabatan_struktural->name}}</h6>
                        <br>
                        <h6 class="card-subtitle mb-2 text-body-secondary"><span class="fw-bold">Jabatan Fungsional : </span> {{$pegawai->jabatan_fungsional->name}}</h6>
                        <br>
                        <h6 class="card-subtitle mb-2 text-body-secondary"><span class="fw-bold">Terhitung Mulai Tanggal PNS : </span> {{$pegawai->tamat_pns ?? '-'}}</h6>
                        <br>
                        <h6 class="card-subtitle mb-2 text-body-secondary"><span class="fw-bold">Terhitung Mulai Tanggal CPNS : </span> {{$pegawai->tamat_cpns ?? '-'}}</h6>

                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                <table class="table table-striped mt-3">
                    <tr>
                        <td>Nama Posisi</td>
                        <td>{{$posisi->posisi->posisi ?? "-"}}</td>
                    </tr>
                    <tr>
                        <td>Unit Kerja</td>
                        <td>{{$posisi->unitKerja->name ?? "-"}}</td>
                    </tr>
                    <tr>
                        <td>Jurusan</td>
                        <td>{{$posisi->jurusan->name ?? "-"}}</td>
                    </tr>
                    <tr>
                        <td>Prodi</td>
                        <td>{{$posisi->prodi->name ?? "-"}}</td>
                    </tr>
                    <tr class="table-info">
                        <td class="fw-bold">Atasan</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Nama Posisi</td>
                        <td>{{$posisi->atasan->posisi->posisi ?? "-"}}</td>
                    </tr>
                    <tr>
                        <td>Unit Kerja</td>
                        <td>{{$posisi->atasan->unitKerja->name ?? "-"}}</td>
                    </tr>
                    <tr>
                        <td>Jurusan</td>
                        <td>{{$posisi->atasan->jurusan->name ?? "-"}}</td>
                    </tr>
                    <tr>
                        <td>Prodi</td>
                        <td>{{$posisi->atasan->prodi->name ?? "-"}}</td>
                    </tr>
                </table>
            </div>

        </div>
    
    </div>
</div>