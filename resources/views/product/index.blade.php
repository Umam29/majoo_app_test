@extends('layouts.main-admin')

@section('title', 'Produk')

@section('content')
            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <h1 class="h3 mb-2 text-gray-800">Produk</h1>

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

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#addProduct">
                            Tambah Produk
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 15%">Gambar</th>
                                        <th class="text-center" style="width: 15%">Nama</th>
                                        <th class="text-center" style="width: 15%">Harga</th>
                                        <th class="text-center" style="width: 35%">Deskripsi</th>
                                        <th class="text-center" style="width: 10%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($produk as $item)
                                        <tr>
                                            <td class="text-center" style="vertical-align: middle"><img src="{{ asset($item->gambar) }}" class="img-thumbnail" width="100"></td>
                                            <td class="text-center" style="vertical-align: middle">{{$item->nama}}</td>
                                            <td class="text-center" style="vertical-align: middle">{{$item->harga_produk}}</td>
                                            <td class="text-center" style="vertical-align: middle">{{$item->deskripsi}}</td>
                                            <td class="text-center" style="vertical-align: middle">
                                                <button class="btn btn-warning btn-sm btnEdit" data-id="{{$item->id}}" data-nama="{{$item->nama}}" data-harga="{{$item->harga}}" data-deskripsi="{{$item->deskripsi}}"><i class="far fa-edit"></i></button>
                                                <button class="btn btn-danger btn-sm btnDelete" data-id="{{$item->id}}" data-nama="{{$item->nama}}"><i class="far fa-trash-alt"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>2019 &copy; PT Majoo Teknologi Indonesia</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

    <!-- Modal -->
    <div class="modal fade" id="addProduct" tabindex="-1" role="dialog" aria-labelledby="addProductLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="addProductLabel">Produk</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <form action="{{url('admin/product/save')}}" method="post" enctype="multipart/form-data">
            @csrf
                <div class="modal-body">
                        <input type="hidden" name="id_edit" id="id_edit">
                        <div class="form-group">
                            <label for="">Gambar Produk</label>
                            <input type="file" class="form-control" name="gambar">
                        </div>
                        <div class="form-group">
                            <label for="">Nama Produk</label>
                            <input type="text" class="form-control" name="nama" id="nama" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="">Harga</label>
                            <input type="number" step="0.01" class="form-control" name="harga" id="harga" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="">Deskripsi</label>
                            <textarea class="form-control" name="deskripsi" id="deskripsi" cols="30" rows="10"></textarea>
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

    <div class="modal fade" id="deleteProduk" tabindex="-1" role="dialog" aria-labelledby="deleteProdukLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="deleteProdukLabel">Delete</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <form action="{{url('admin/product/delete')}}" method="post">
            @csrf
                <div class="modal-body">
                    <input type="hidden" name="id_delete" id="id_delete">
                    <label for="">Apakah anda yakin menghapus data <span id="nama_produk_delete"></span>?</label>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Hapus</button>
                </div>
            </form>
        </div>
        </div>
    </div>
@endsection

@section('js')
<script type="text/javascript">
    $(".btnDelete").click(function(e){
        e.preventDefault();
        id = $(this).data("id");
        nama = $(this).data("nama");
        $('#id_delete').val(id);
        $('#nama_produk_delete').html(nama);
        $('#deleteProduk').modal('show');
    })

    $(".btnEdit").click(function(e){
        e.preventDefault();
        id = $(this).data("id");
        nama = $(this).data("nama");
        harga = $(this).data("harga");
        deskripsi = $(this).data("deskripsi");
        $('#id_edit').val(id);
        $('#nama').val(nama);
        $('#harga').val(harga);
        $('#deskripsi').html(deskripsi);
        $('#addProduct').modal('show');
    })
</script>
@endsection
