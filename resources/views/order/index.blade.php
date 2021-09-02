@extends('layouts.main-admin')

@section('title', 'Pemesanan')

@section('content')
            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <h1 class="h3 mb-2 text-gray-800">Pemesanan</h1>

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 10%" style="vertical-align: middle">Tanggal Pemesanan</th>
                                        <th class="text-center" style="width: 15%" style="vertical-align: middle">Produk</th>
                                        <th class="text-center" style="width: 15%" style="vertical-align: middle">Harga</th>
                                        <th class="text-center" style="width: 15%" style="vertical-align: middle">Nama Pemesan</th>
                                        <th class="text-center" style="width: 15%" style="vertical-align: middle">Perusahaan</th>
                                        <th class="text-center" style="width: 15%" style="vertical-align: middle">Alamat</th>
                                        <th class="text-center" style="width: 15%" style="vertical-align: middle">Nomor Telepon</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order as $item)
                                        <tr>
                                            <td class="text-center" style="vertical-align: middle">{{date_format($item->created_at, 'd-m-Y H:i:s')}}</td>
                                            <td class="text-center" style="vertical-align: middle">{{$item->produk->nama}}</td>
                                            <td class="text-center" style="vertical-align: middle">{{$item->produk->harga_produk}}</td>
                                            <td class="text-center" style="vertical-align: middle">{{$item->nama_pemesan}}</td>
                                            <td class="text-center" style="vertical-align: middle">{{$item->perusahaan}}</td>
                                            <td class="text-center" style="vertical-align: middle">{{$item->alamat}}</td>
                                            <td class="text-center" style="vertical-align: middle">{{$item->no_telepon}}</td>
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
@endsection
