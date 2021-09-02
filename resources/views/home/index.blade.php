@extends('layouts.main')

@section('title', 'Home')

@section('css')
@endsection

@section('content')
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light topbar mb-4 static-top shadow" style="background-color: black">

                    <div class="input-group">
                        <h2 class="mr-2 d-none d-lg-inline" style="color: white; font-weight: bold">Majoo Teknologi Indonesia</h2>
                    </div>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Produk</h1>
                    </div>

                    @if(session('errors'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            Something it's wrong:
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            @if (count($errors) > 1)
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @else
                                <div class="alert alert-danger">
                                    {{ $errors[0] }}
                                </div>
                            @endif
                        </div>
                    @endif

                    @if (Session::has('success'))
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            {{ Session::get('success') }}
                        </div>
                    @endif

                    <div class="row">
                        @foreach ($produk as $item)
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card h-100">
                                    <div class="text-center">
                                        <img class="card-img-top" src="{{asset($item->gambar)}}">
                                    </div>
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title text-center">{{$item->nama}}</h5>
                                        <h4 class="card-title text-center">{{$item->harga_produk}}</h4>
                                        <p class="card-text text-center">{{$item->deskripsi}}</p>
                                    <div class="text-center mt-auto">
                                        <button class="btn btn-primary btnBeli" data-id="{{$item->id}}" data-nama="{{$item->nama}}" data-harga="{{$item->harga_produk}}">Beli</button>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer" style="margin-top: 5%; background-color: rgba(0, 0, 0, 0.05);">
                <div class="container">
                    <div class="copyright text-center" style="color: black; font-size: 12pt;">
                        <span>2019 &copy; PT Majoo Teknologi Indonesia</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Modal -->
    <div class="modal fade" id="pemesanan" tabindex="-1" role="dialog" aria-labelledby="pemesananLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="pemesananLabel">Pemesanan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <form action="{{url('pemesanan')}}" method="post">
            @csrf
                <div class="modal-body">
                        <input type="hidden" name="id_produk" id="id_produk">
                        <div class="form-group">
                            <label for="">Nama Produk</label>
                            <input type="text" class="form-control" name="nama_produk" id="nama_produk" autocomplete="off" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Harga</label>
                            <input type="text" class="form-control" name="harga" id="harga" autocomplete="off" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Nama Lengkap</label>
                            <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="">Perusahaan</label>
                            <input type="text" class="form-control" name="perusahaan" id="perusahaan" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="">Nomor Telepon</label>
                            <input type="text" class="form-control" name="nomor_telepon" id="nomor_telepon" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="">Alamat</label>
                            <input type="text" class="form-control" name="alamat" id="alamat" autocomplete="off">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
        </div>
    </div>
@endsection

@section('js')
<script type="text/javascript">
    $(".btnBeli").click(function(e){
        e.preventDefault();
        var id = $(this).data("id");
        var nama = $(this).data("nama");
        var harga = $(this).data("harga");
        $('#id_produk').val(id);
        $('#nama_produk').val(nama);
        $('#harga').val(harga);
        $('#pemesanan').modal('show');
    });
</script>
@endsection

