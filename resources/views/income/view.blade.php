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
                    <h6 class="m-0 font-weight-bold text-primary">Income Recording</h6>

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
                                    <th>Date</th>
                                    <th style="text-align: center">Amount</th>
                                    <th>Description</th>
                                    <th>Category</th>
                                    <th>Wallet</th>
                                    <th style="text-align: center">Aksi</th>
                                </tr>
                            </thead>
                            <tfoot class="thead-dark">
                                <tr>
                                <th>Date</th>
                                <th style="text-align: center">Amount</th>
                                <th>Description</th>
                                <th>Category</th>
                                <th>Wallet</th>
                                <th style="text-align: center">Aksi</th>
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
            var url3 = "{{url('income/destroy/')}}";
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
            <h5 class="modal-title" id="labelmodalubah">Ubah Data Income</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
            </button>
        </div>

        <div class="modal-body">
            <!-- Form untuk input -->
            <form action="#" class="formubahincome" method="post">
            @csrf
            <input type="hidden" id="idincomehidden" name="idincomehidden" value="">
            <input type="hidden" id="tipeproses" name="tipeproses" value="">

                <div class="mb-6 row">
                    <label for="nomerlabel" class="col-sm-4 col-form-label">Date</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="date" name="date" placeholder="Masukkan Tanggal, cth: 2023-04-22">
                        <div class="invalid-feedback errordate"></div>
                    </div>
                </div>
                <div class="mb-6 row">
                    <label for="hargalabel" class="col-sm-4 col-form-label">Amount</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="amount" name="amount" placeholder="Masukkan Jumlah, cth: 100000">
                        <div class="invalid-feedback erroramount"></div>
                    </div>
                </div>
                <div class="mb-6 row">
                    <label for="lantailabel" class="col-sm-4 col-form-label">Description</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="description" name="description" placeholder="Masukkan Deskripsi, cth: Uang Bulanan">
                        <div class="invalid-feedback errordescription"></div>
                    </div>
                </div>
                <div class="mb-6 row">
                    <label for="lantailabel" class="col-sm-4 col-form-label">Category</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="category" name="category" placeholder="Masukkan Category, cth: Bulanan">
                        <div class="invalid-feedback errorcategory">
                            <div class="bg-white py-5 collapse-inner rounded">
                            </div>
                        </div>
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
              // merubah label menjadi Tambah Data income
              $('#labelmodalubah').html('Tambah Data Income');
            //   url = "{{url('income')}}";
			  url  = "{{ route('income.store') }}";
              $('.formubahincome').attr('action',url);

              // kosongkan isi dari input form
              $('#date').val('');
              $('#amount').val('');
              $('#description').val('');
              $('#category').val('');
              $('#wallet').val('');
              $('#idincomehidden').val('');
              $('#tipeproses').val('tambah'); //untuk identifikasi di controller apakah tambah atau update


                var data = {
                    'date': $('.date').val(),
                    'amount': $('.amount').val(),
                    'description': $('.description').val(),
                    'category': $('.category').val(),
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
                    // url: "{{url('income')}}",
					url: "{{ route('income.store') }}",
                    data: data,
                    dataType: "json",
                    success: function (response) {
                        console.log(response);
                        if (response.status == 400) {
                            if(response.errors.date){
                                $('#date').removeClass('is-valid').addClass('is-invalid');
                                $('.errordate').html(response.errors.date);
                            }else{
                                $('#date').removeClass('is-invalid').addClass('is-valid');
                                $('.errordate').html();
                            }

                            if(response.errors.amount){
                                $('#amount').removeClass('is-valid').addClass('is-invalid');
                                $('.erroramount').html(response.errors.amount);
                            }else{
                                $('#amount').removeClass('is-invalid').addClass('is-valid');
                                $('.erroramount').html();
                            }

                            if(response.errors.description){
                                $('#description').removeClass('is-valid').addClass('is-invalid');
                                $('.errordescription').html(response.errors.description);
                            }else{
                                $('#description').removeClass('is-valid').removeClass('is-invalid').addClass('is-valid');
                                $('.errordescription').html();
                            }

                            if(response.errors.category){
                                $('#category').removeClass('is-valid').addClass('is-invalid');
                                $('.errorcategory').html(response.errors.category);
                            }else{
                                $('#category').removeClass('is-valid').removeClass('is-invalid').addClass('is-valid');
                                $('.errorcategory').html();
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
                            dataincome(); //refresh data Pengeluaran
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

        $('#labelmodalubah').html('Ubah Data Income');
        url = "{{ route('income.store') }}";
        $('.formubahincome').attr('action',url);
        $('#idincomehidden').val(id);
        $('#tipeproses').val('ubah');
        $('#ubahModal').modal('show');

        var url3 = "{{url('income/edit/')}}";
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
                    // console.log(response.income.tanggal);
                    $('#date').val(response.income.date);
                    $('#amount').val(response.income.amount);
                    $('#description').val(response.income.description);
                    $('#category').val(response.income.category);
                    $('#wallet').val(response.income.wallet);
                    $('#idincomehidden').val(id)

                    // pastikan form is-invalid dikembalikan ke valid
                    $('#date').removeClass('is-invalid').addClass('is-valid');;
                    $('.errordate').html();
                    $('#amount').removeClass('is-invalid').addClass('is-valid');;
                    $('.erroramount').html();
                    $('#description').removeClass('is-invalid').addClass('is-valid');;
                    $('.errordescription').html();
                    $('#category').removeClass('is-invalid').addClass('is-valid');;
                    $('.errorcategory').html();
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
        function dataincome(){
            $.ajax(
                {
                    type: "GET",
                    url: "{{url('income/fetchincome')}}",
                    dataType: "json",
                    success: function (response) {
                        // console.log(response);
                        $('tbody').html("");
                        $.each(response.income, function (key, item) {
                            $('tbody').append('<tr>\
                                <td>' + item.date + '</td>\
                                <td style="text-align: center">' + item.amount + '</td>\
                                <td>' + item.description + '</td>\
                                <td>' + item.category + '</td>\
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
            dataincome();
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
                $('.formubahincome').submit(function(e)
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
                                            if(response.errors.date){
                                                $('#date').removeClass('is-valid').addClass('is-invalid');
                                                $('.errordate').html(response.errors.date);
                                            }else{
                                                $('#name').removeClass('is-invalid').addClass('is-valid');;
                                                $('.errorname').html();
                                            }

                                            if(response.errors.amount){
                                                $('#amount').removeClass('is-valid').addClass('is-invalid');
                                                $('.erroramount').html(response.errors.amount);
                                            }else{
                                                $('#amount').removeClass('is-invalid').addClass('is-valid');;
                                                $('.erroramount').html();
                                            }

                                            if(response.errors.description){
                                                $('#description').removeClass('is-valid').addClass('is-invalid');
                                                $('.errordescription').html(response.errors.description);
                                            }else{
                                                $('#description').removeClass('is-invalid').addClass('is-valid');;
                                                $('.errordescription').html();
                                            }

                                            if(response.errors.category){
                                                $('#category').removeClass('is-valid').addClass('is-invalid');
                                                $('.errorcategory').html(response.errors.category);
                                            }else{
                                                $('#category').removeClass('is-invalid').addClass('is-valid');;
                                                $('.errorcategory').html();
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
                                            dataincome(); //refresh data income

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