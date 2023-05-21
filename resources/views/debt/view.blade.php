@extends('layoutbootstrap')

@section('konten')
<!-- Begin Page Content -->

@if(isset($status_hapus))
        <script>
            Swal.fire({
                title: 'Berhasil!',
                text: 'Hapus Data Berhasil',
                icon: 'success',
                confirmButtonText: 'Ok'
            });
        </script>
@endif

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Selamat Datang {{ Auth::user()->name }}</h1>
        
    </div>

    

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-12 col-sm-12">
            <div class="card shadow mb-4">

                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Debt Recording</h6>

                     <!-- Tombol Tambah Data -->
                     <a href="#" class="btn btn-primary btn-icon-split btn-sm tampilmodaltambah" data-toogle="modal" data-target="#ubahModal">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="text">Tambah Data</span>
                    </a>

                </div>
                <!-- Card Body -->
                <div class="card-body">
                        <div class="chart-area" hidden>
                            <canvas id="myAreaChart"></canvas>
                        </div>
                    <!-- Awal Dari Tabel -->
                    <div class="table-responsive">
                        <!-- Untuk tempat menaruh tabel -->
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th style="text-align: center">Amount</th>
                                    <th>Date</th>
                                    <th>Target_date</th>
                                    <th>Wallet</th>
                                    <th style="text-align: center">Aksi</th>
                                </tr>
                            </thead>
                            <tfoot class="thead-dark">
                            
                                <tr>
                                    <th>Total</th>
                                    <th></th>
                                    <th style="text-align: center">Rp. 350000</th>
                                    <th></th>
                                    <th></th>
                                    <th><b></b></th>
                                    <th style="text-align: center"></th>
                                </tr>
                                
                            </tfoot>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    <!-- Akhir Dari Tabel -->
                </div>
            </div>
        </div>


    </div>


    <!-- /.container-fluid -->
</div>
<!-- End of Main Content -->

<!-- Modal Delete -->
    <script>
        function deleteConfirm(e){
            var tomboldelete = document.getElementById('btn-delete')
            id = e.getAttribute('data-id');

            // const str = 'Hello' + id + 'World';
            var url3 = "{{url('debt/destroy/')}}";
            var url4 = url3.concat("/",id);
            // console.log(url4);

            // console.log(id);
            tomboldelete.setAttribute("href", url4); //akan meload controller delete

            var pesan = "Data dengan ID <b>"
            var pesan2 = " </b>akan dihapus"
            var res = id;
            document.getElementById("xid").innerHTML = pesan.concat(res,pesan2);

            var myModal = new bootstrap.Modal(document.getElementById('deleteModal'), {  keyboard: false });

            myModal.show();

        }
    </script>
    <!-- Logout Delete Confirmation-->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" id="xid"></div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a id="btn-delete" class="btn btn-danger" href="#">Hapus</a>

            </div>
            </div>
        </div>
    </div>
<!-- Akhir Modal Delete -->

<!-- Ubah dan Tambah Data Menggunakan Modal -->
<div class="modal fade" id="ubahModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="labelmodalubah">Ubah Data Debt</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
            </button>
        </div>

        <div class="modal-body">
            <!-- Form untuk input -->
            <form action="#" class="formubahdebt" method="post">
            @csrf
            <input type="hidden" id="iddebthidden" name="iddebthidden" value="">
            <input type="hidden" id="tipeproses" name="tipeproses" value="">

                <div class="mb-6 row">
                    <label for="nomerlabel" class="col-sm-4 col-form-label">Name</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan Nama Peminjam Uang, cth: Sintya">
                        <div class="invalid-feedback errorname"></div>
                    </div>
                </div>
                <div class="mb-6 row">
                    <label for="lantailabel" class="col-sm-4 col-form-label">Description</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="description" name="description" placeholder="Masukkan Deskripsi Meminjam, cth: Keperluan Harian">
                        <div class="invalid-feedback errordescription"></div>
                    </div>
                </div>
                <div class="mb-6 row">
                    <label for="hargalabel" class="col-sm-4 col-form-label">Amount</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="amount" name="amount" placeholder="Masukkan Jumlah  , cth: 100000">
                        <div class="invalid-feedback erroramount"></div>
                    </div>
                </div>
                <div class="mb-6 row">
                    <label for="lantailabel" class="col-sm-4 col-form-label">Date</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="date" name="date" placeholder="Masukkan Tanggal Meminjam, cth: 27/04/2023">
                        <div class="invalid-feedback errordate"></div>
                    </div>
                </div>
                <div class="mb-6 row">
                    <label for="lantailabel" class="col-sm-4 col-form-label">Target Date</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="target_date" name="target_date" placeholder="Masukkan Tanggal Membayar, cth:  01/05/2023">
                        <div class="invalid-feedback errortarget_date"></div>
                    </div>
                </div>
                <div class="mb-6 row">
                    <label for="lantailabel" class="col-sm-4 col-form-label">Wallet</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="wallet" name="wallet" placeholder="Masukkan Jenis Wallet, cth: Bank/Cash">
                        <div class="invalid-feedback errorwallet">
                            <div class="bg-white py-2 collapse-inner rounded">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
            <button type="submit" class="btn btn-primary btnsimpan">Simpan</button>
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!-- Akhir Ubah dan Tambah Data Menggunakan Modal -->

<!-- Jquery Proses Ubah / Tambah Data -->
<!-- Modal Tambah Pop Up versi 2 -->

<!-- Ketika tombol dengan elemen id tampilmodaltambah ditekan -->
<script>
      $(function(){
            $('.tampilmodaltambah').on('click', function(){
              // merubah label menjadi Tambah Data debt
              $('#labelmodalubah').html('Tambah Data Debt');
            //   url = "{{url('debt')}}";
			  url  = "{{ route('debt.store') }}";
              $('.formubahdebt').attr('action',url);

              // kosongkan isi dari input form
              $('#name').val('');
              $('#description').val('');
              $('#amount').val('');
              $('#date').val('');
              $('#target_date').val('');
              $('#wallet').val('');
              $('#iddebthidden').val('');
              $('#tipeproses').val('tambah'); //untuk identifikasi di controller apakah tambah atau update


                var data = {
                    'name': $('.name').val(),
                    'description': $('.description').val(),
                    'amount': $('.amount').val(),
                    'date': $('.date').val(),
                    'target_date': $('.target_date').val(),
                    'wallet': $('.wallet').val(),
                }

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

              $('#ubahModal').modal('show');

            //   const id = $(this).data('id');
              $.ajax(
                {

                    type: "post", //isinya put untuk update dan post untuk insert
                    // url: "{{url('debt')}}",
					url: "{{ route('debt.store') }}",
                    data: data,
                    dataType: "json",
                    success: function (response) {
                        console.log(response);
                        if (response.status == 400) {
                            if(response.errors.name){
                                $('#name').removeClass('is-valid').addClass('is-invalid');
                                $('.errorname').html(response.errors.name);
                            }else{
                                $('#name').removeClass('is-invalid').addClass('is-valid');
                                $('.errorname').html();
                            }

                            if(response.errors.description){
                                $('#description').removeClass('is-valid').addClass('is-invalid');
                                $('.errordescription').html(response.errors.description);
                            }else{
                                $('#description').removeClass('is-valid').removeClass('is-invalid').addClass('is-valid');
                                $('.errordescription').html();
                            }

                            if(response.errors.amount){
                                $('#amount').removeClass('is-valid').addClass('is-invalid');
                                $('.erroramount').html(response.errors.amount);
                            }else{
                                $('#amount').removeClass('is-invalid').addClass('is-valid');
                                $('.erroramount').html();
                            }

                            if(response.errors.date){
                                $('#date').removeClass('is-valid').addClass('is-invalid');
                                $('.errordate').html(response.errors.date);
                            }else{
                                $('#date').removeClass('is-invalid').addClass('is-valid');
                                $('.errordate').html();
                            }

                            if(response.errors.target_date){
                                $('#target_date').removeClass('is-valid').addClass('is-invalid');
                                $('.errortarget_date').html(response.errors.target_date);
                            }else{
                                $('#target_date').removeClass('is-valid').removeClass('is-invalid').addClass('is-valid');
                                $('.errortarget_date').html();
                            }

                            if(response.errors.wallet){
                                $('#wallet').removeClass('is-valid').addClass('is-invalid');
                                $('.errorwallet').html(response.errors.wallet);
                            }else{
                                $('#wallet').removeClass('is-invalid').addClass('is-valid');
                                $('.errorwallet').html();
                            }


                        } else {

                            // munculkan pesan sukses
                            Swal.fire({
                                title: 'Berhasil!',
                                text: response.sukses,
                                icon: 'success',
                                confirmButtonText: 'Ok'
                            });

                            // kosongkan form
                            $('#ubahModal').modal('hide');
                            datadebt(); //refresh data Pengeluaran
                        }
                    }

                }
              );

            });
          });
</script>
<!-- Akhir Jquery Proses Ubah / Tambah Data -->

<!-- Ketika tombol dengan elemen class bernama  editbtn ditekan -->
<script>
      function updateConfirm(e){
        id = e.getAttribute('data-id');

        $('#labelmodalubah').html('Ubah Data Debt');
        url = "{{ route('debt.store') }}";
        $('.formubahdebt').attr('action',url);
        $('#iddebthidden').val(id);
        $('#tipeproses').val('ubah');
        $('#ubahModal').modal('show');

        var url3 = "{{url('debt/edit/')}}";
        var url4 = url3.concat("/",id);

        $.ajax({
            type: "GET",
            url: url4,
            success: function (response) {
                if (response.status == 404) {
                    // beri alert kalau gagal
                    Swal.fire({
                        title: 'Gagal!',
                        text: response.message,
                        icon: 'warning',
                        confirmButtonText: 'Ok'
                    });

                    $('#ubahModal').modal('hide');
                } else {
                    // console.log(response.debt.tanggal);
                    $('#name').val(response.debt.name);
                    $('#description').val(response.debt.description);
                    $('#amount').val(response.debt.amount);
                    $('#date').val(response.debt.date);
                    $('#target_date').val(response.debt.target_date);
                    $('#wallet').val(response.debt.wallet);
                    $('#iddebthidden').val(id)

                    // pastikan form is-invalid dikembalikan ke valid
                    $('#name').removeClass('is-invalid').addClass('is-valid');;
                    $('.errorname').html();
                    $('#description').removeClass('is-invalid').addClass('is-valid');;
                    $('.errordescription').html();
                    $('#amount').removeClass('is-invalid').addClass('is-valid');;
                    $('.erroramount').html();
                    $('#date').removeClass('is-invalid').addClass('is-valid');;
                    $('.errordate').html();
                    $('#target_date').removeClass('is-invalid').addClass('is-valid');;
                    $('.errortarget_date').html();
                    $('#wallet').removeClass('is-invalid').addClass('is-valid');;
                    $('.errorwallet').html();
                }
            }
        });
      }
</script>
<!-- Akhir Ketika tombol dengan elemen class bernama  editbtn ditekan -->

<!-- Proses mengisi data pada tabel -->
<script>
        function datadebt(){
            $.ajax(
                {
                    type: "GET",
                    url: "{{url('debt/fetchdebt')}}",
                    dataType: "json",
                    success: function (response) {
                        // console.log(response);
                        $('tbody').html("");
                        $.each(response.debt, function (key, item) {
                            $('tbody').append('<tr>\
                                <td>' + item.name + '</td>\
                                <td>' + item.description + '</td>\
                                <td style="text-align: center">' + item.amount + '</td>\
                                <td>' + item.date + '</td>\
                                <td>' + item.target_date + '</td>\
                                <td>' + item.wallet + '</td>\
                                <td style="text-align: center"><a onclick="updateConfirm(this); return false;" href="#" value="' + item.id + '" data-id="' + item.id + '" class="btn btn-success btn-circle editbtn"><i class="fas fa-check"></i></a>\
                                <a onclick="deleteConfirm(this); return false;" href="#" value="' + item.id + '" data-id="' + item.id + '" class="btn btn-danger btn-circle deletebtn"><i class="fas fa-trash"></i></button></td>\
                            \</tr>');
                        });
                    }
                }
            )
        }

    </script>
    <script>
        $(document).ready(function(){
            datadebt();
            }
        );
    </script>
<!-- Akhir mengisi data pada tabel -->

<!-- Ketika tombol submit di form ditekan -->
<script>

        // definisikan tipe method yang berbeda
        // untuk update=>put (pembedanga adalah inner html pada labelmodalubah berisi Ubah Data Pengeluaran)
        // sedangkan untuk input=>post nilai inner html pada labelmodalubah berisi Tambah Data Pengeluaran


        $(document).ready(function()
            {
                $('.formubahdebt').submit(function(e)
                    {
                        e.preventDefault();
                            $.ajax(
                                {
                                    type: "post", //isinya post untuk insert dan put untuk delete
                                    url: $(this).attr('action'),
                                    data: $(this).serialize(),
                                    dataType: "json",
                                    success: function (response){
                                        // console.log('kssss');
                                        // jika responsenya adalah error
                                        if (response.status == 400) {
                                            if(response.errors.name){
                                                $('#name').removeClass('is-valid').addClass('is-invalid');
                                                $('.errorname').html(response.errors.name);
                                            }else{
                                                $('#name').removeClass('is-invalid').addClass('is-valid');;
                                                $('.errorname').html();
                                            }

                                            if(response.errors.description){
                                                $('#description').removeClass('is-valid').addClass('is-invalid');
                                                $('.errordescription').html(response.errors.description);
                                            }else{
                                                $('#description').removeClass('is-invalid').addClass('is-valid');;
                                                $('.errordescription').html();
                                            }

                                            if(response.errors.amount){
                                                $('#amount').removeClass('is-valid').addClass('is-invalid');
                                                $('.erroramount').html(response.errors.amount);
                                            }else{
                                                $('#amount').removeClass('is-invalid').addClass('is-valid');;
                                                $('.erroramount').html();
                                            }

                                            if(response.errors.date){
                                                $('#date').removeClass('is-valid').addClass('is-invalid');
                                                $('.errordate').html(response.errors.date);
                                            }else{
                                                $('#date').removeClass('is-invalid').addClass('is-valid');;
                                                $('.errordate').html();
                                            }

                                            if(response.errors.target_date){
                                                $('#target_date').removeClass('is-valid').addClass('is-invalid');
                                                $('.errortarget_date').html(response.errors.target_date);
                                            }else{
                                                $('#target_date').removeClass('is-invalid').addClass('is-valid');;
                                                $('.errortarget_date').html();
                                            }

                                            if(response.errors.wallet){
                                                $('#wallet').removeClass('is-valid').addClass('is-invalid');
                                                $('.errorwallet').html(response.errors.wallet);
                                            }else{
                                                $('#wallet').removeClass('is-invalid').addClass('is-valid');;
                                                $('.errorwallet').html();
                                            }

                                        }
                                        else{
                                            // munculkan pesan sukses
                                            Swal.fire({
                                                title: 'Berhasil!',
                                                text: response.sukses,
                                                icon: 'success',
                                                confirmButtonText: 'Ok'
                                            });

                                            // kosongkan form
                                            $('#ubahModal').modal('hide');
                                            datadebt(); //refresh data debt

                                        }
                                    },
                                    error: function(xhr, ajaxOptions, thrownError){
                                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                                    }
                                }
                            );
                            return false;
                    }
                );
            }
        );
</script>
<!-- Akhir ketika tombol submit di form ditekan -->


@endsection