@extends('layoutbootstrap')

@section('konten')

    <!-- Content Row -->

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-12 col-sm-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Akun</h6>
                    
                    <!-- Tombol Tambah Data -->
                    <a href="#" class="btn btn-primary btn-icon-split btn-sm">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="text">Tambah Data</span>
                    </a>
                    <!-- Akghir Tombol Tambah Data -->

                </div>
                <!-- Card Body -->
                <div class="card-body">
                        <div class="chart-area" hidden>
                            <canvas id="myAreaChart"></canvas>
                        </div>

                    <!-- Display Error jika ada error -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <!-- Akhir Display Error -->

                    <!-- Awal Dari Input Form -->
                    <form action="{{ route('akun.store') }}" method="post">
                        @csrf
                        <div class="mb-3"><label for="headerakunlabel">Header Akun</label>
                        <input class="form-control form-control-solid" id="header_akun" name="header_akun" type="text" placeholder="Contoh: 1" value="{{old('header_akun')}}">
                        </div>
                        
                        <div class="mb-3"><label for="kodeakunlabel">Kode Akun</label>
                        <input class="form-control form-control-solid" id="kode_akun" name="kode_akun" type="text" placeholder="Contoh: 111" value="{{old('kode_akun')}}">
                        </div>
          
                        <div class="mb-0"><label for="namaakunlabel">Nama Akun</label>
                            <textarea class="form-control form-control-solid" id="nama_akun" name="nama_akun" rows="3" placeholder="Cth: Kas">{{old('nama_akun')}}</textarea>
                        </div>
                        <br>
                        <!-- untuk tombol simpan -->
                        
                        <input class="col-sm-1 btn btn-success btn-sm" type="submit" value="Simpan">

                        <!-- untuk tombol batal simpan -->
                        <a class="col-sm-1 btn btn-dark  btn-sm" href="{{ url('/akun') }}" role="button">Batal</a>
                        
                    </form>
                    <!-- Akhir Dari Input Form -->
                </div>
            </div>
        </div>

        
    </div>

    
    <!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
@endsection