<?php 
require 'function.php';
require 'koneksi.php';
 ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Web LAB IT UAD</title>

    <link rel="stylesheet" type="text/css" href="style.css">
    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-custom sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon ">
                    <i class="fas fa-desktop"></i>
                </div>
                <div class="sidebar-brand-text mx-4">Lab IT UAD</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-database"></i>
                    <span>Stock Barang</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                
            </div>
            <li class="nav-item active">
                <a class="nav-link" href="masuk.php">
                    <i class="fas fa-download"></i>
                    <span>Barang Masuk</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link mb-3" href="keluar.php">
                    <i class="fas fa-upload"></i>
                    <span>Barang Keluar</span></a>
            </li>


            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-custom2 topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <form class="form-inline">
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
                    </form>

                    <!-- Topbar Search -->
                    

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto ">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php
                                $ambilusername = mysqli_query($conn,"select * from login");
                                        $data=mysqli_fetch_array($ambilusername);
                                        $username=$data['username'];
                                ?>
                                <span class="mr-2 d-none d-lg-inline text-white small"><?=$username?></span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                
                                <a class="dropdown-item" href="logout.php" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h2 mb-2 text-gray-900">Stock Barang</h1>
                    <p class="mb-3">Tabel Stock Barang Lab IT UAD</p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                             <button type="button"  class=" d-none py-2 px-3 d-sm-inline-block btn btn-sm bg-custom2 shadow-sm" data-toggle="modal" data-target="#myModal">Tambah Barang</button>
                    <!-- Modal Tambah Barang -->
                      <div class="modal fade" id="myModal">
                        <div class="modal-dialog">
                          <div class="modal-content">
                          
                            <!-- Modal Header -->
                            <div class="modal-header">
                              <h4 class="modal-title">Tambah Barang</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            
                            <!-- Modal body -->
                            <form method="post">
                            <div class="modal-body">
                              <input type="text" name="namabarang" placeholder="Nama Barang" class="form-control" required>
                              <br>
                              <input type="text" name="deskripsi" placeholder="Deskripsi Barang" class="form-control" required>
                              <br>
                              <input type="number" name="stock" class="form-control" placeholder="Stock" required>
                              <br>
                              <button type="submit" name="addnewbarang" class="btn btn-primary">SUBMIT</button>
                              <br>
                            </div>
                            </form>
                            
                          </div>
                        </div>
                      </div>

                    
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                   <tr class="bg-gradient-custom2">
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>Deskripsi</th>
                                    <th>Stock</th>
                                    <th>Opsi</th>
                                    </tr>
                                </thead>
                                    <tbody>
                                        <?php
                                            $i = 1;
                                        $ambilsemuadatastock = mysqli_query($conn,"select * from stock");
                                        while ($data=mysqli_fetch_array($ambilsemuadatastock)) {
                                            $namabarang = $data['namabarang'];
                                            $deskripsi = $data['deskripsi'];
                                            $stock = $data['stock'];
                                            $idb   = $data['idbarang'];

                                        ?>
                                        <tr>
                                            <td><?=$i++;?></td>
                                            <td><?=$namabarang;?></td>
                                            <td><?=$deskripsi;?></td>
                                            <td><?=$stock;?></td>
                                            <td>
                                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?=$idb;?>">
                                                    Edit
                                                </button>
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?=$idb;?>">
                                                    Delete
                                                </button>
                                                <input type="hidden" name="idbarangygmaudihapus" value="<?=$idb;?>">
                                            </td>
                                        </tr>
                                                    <!-- MODAL EDIT-->
                                              <div class="modal fade" id="edit<?=$idb;?>">
                                                <div class="modal-dialog">
                                                  <div class="modal-content">
                                                  
                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                      <h4 class="modal-title">Edit Barang</h4>
                                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    
                                                    <!-- Modal body -->
                                                    <form method="post">
                                                    <div class="modal-body">
                                                      <input type="text" name="namabarang" value="<?=$namabarang;?>" class="form-control" required>
                                                      <br>
                                                      <input type="text" name="deskripsi" value="<?=$deskripsi;?>" class="form-control" required>
                                                      <br>
                                                      <input type="hidden" name="idb" value="<?=$idb;?>">
                                                      <button type="submit" name="updatebarang" class="btn btn-primary">UPDATE</button>
                                                      <br>
                                                    </div>
                                                    </form>
                                                    
                                                  </div>
                                                </div>
                                              </div>

                                                    <!-- MODAL DELETE-->
                                              <div class="modal fade" id="delete<?=$idb;?>">
                                                <div class="modal-dialog">
                                                  <div class="modal-content">
                                                  
                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                      <h4 class="modal-title">Hapus Barang ?</h4>
                                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    
                                                    <!-- Modal body -->
                                                    <form method="post">
                                                    <div class="modal-body">
                                                      Apakah anda yakin ingin menghapus <?=$namabarang;?> ?
                                                      <input type="hidden" name="idb" value="<?=$idb;?>">
                                                      <br>
                                                      <br>
                                                      <button type="submit" name="hapusbarang" class="btn btn-danger">HAPUS</button>
                                                      <br>
                                                    </div>
                                                    </form>
                                                    
                                                  </div>
                                                </div>
                                              </div>
                                        <?php
                                    };
                                        ?> 
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
                        <span>Copyright &copy; nizamelband 2021</span>
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

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Anda ingin keluar?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Pilih Logout jika anda ingin keluar</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

</body>
</html>