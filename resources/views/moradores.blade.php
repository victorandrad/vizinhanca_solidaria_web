<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Vizinhança Solidária - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
          rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
            Vizinhança Solidária
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="/">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">


    @if(Auth::user()->tipo == 'admin' || Auth::user()->tipo == 'tutor' || Auth::user()->tipo == 'guarda')
        <!-- Heading -->
            <div class="sidebar-heading">
                Moradores
            </div>
    @endif

    @if(Auth::user()->tipo == 'admin' || Auth::user()->tipo == 'tutor')
        <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="/novo-morador" aria-expanded="true">
                    <i class="fas fa-fw fa-user-edit"></i>
                    <span>Adicionar novo</span>
                </a>
            </li>
    @endif

    @if(Auth::user()->tipo == 'admin' || Auth::user()->tipo == 'tutor' || Auth::user()->tipo == 'guarda')
        <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item active">
                <a class="nav-link collapsed" href="/moradores" aria-expanded="true">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Ver todos</span>
                </a>
            </li>
    @endif
    <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Ocorrências
        </div>

    @if(Auth::user()->tipo == 'admin' || Auth::user()->tipo == 'tutor' || Auth::user()->tipo == 'guarda')
        <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="/ocorrencias" aria-expanded="true">
                    <i class="fas fa-fw fa-list"></i>
                    <span>Ver todas</span>
                </a>
            </li>
    @endif

    @if(Auth::user()->tipo == 'admin' || Auth::user()->tipo == 'guarda')
        <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="/monitora" aria-expanded="true">
                    <i class="fas fa-fw fa-eye"></i>
                    <span>Monitorar</span>
                </a>
            </li>
    @endif

    <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{Auth::user()->nome}}</span>
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                             aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Profile
                            </a>
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                Settings
                            </a>
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                Activity Log
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
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

                <!-- Content Row -->
                <div class="row">
                    <div class="col-lg-12 mb-4">

                        <!-- Illustrations -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Todos os moradores</h6>
                            </div>
                            <div class="card-body">
                                <input type="search" class="form-control form-control-user" id="pesquisa" name="pesquisa" placeholder="Pesquisar">
                                <br/>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTableMoradores" width="100%"
                                           cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Telefone</th>
                                            <th>Endereço</th>
                                            <th>Ações</th>
                                        </tr>
                                        </thead>
                                        <tbody id="users_list">
                                        @for($i = 0; $i < $contador; $i++)
                                            <tr>
                                                <td>{{$moradores->getChild($moradores->getChildKeys()[$i])->getValue()['nome']}}</td>
                                                <td>{{$moradores->getChild($moradores->getChildKeys()[$i])->getValue()['celular']}}</td>
                                                <td>{{$moradores->getChild($moradores->getChildKeys()[$i])->getValue()['endereco'] .', ' . $moradores->getChild($moradores->getChildKeys()[$i])->getValue()['numero'].' - '. $moradores->getChild($moradores->getChildKeys()[$i])->getValue()['bairro']}}</td>
                                                <td>
                                                    <button type="button" class="btn btn-danger btn-circle btn-sm"
                                                            data-toggle="modal"
                                                            data-keyuser="{{$moradores->getChildKeys()[$i]}}"
                                                            data-target="#modalDeleta">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endfor
                                        </tbody>
                                    </table>
                                </div>
                            </div>
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
                    <span>Associação de Amigos do Santa Marta &copy; 2019</span>
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
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="login.html">Logout</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalDeleta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Atenção</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form method="POST" action="{{action('MoradoresController@deleteUser')}}">
                @csrf
                <div class="modal-body">
                    <input name="key-user" type="hidden" class="form-control" id="key-user">
                    Tem certeza que deseja excluir esse morador?
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" type="button" data-dismiss="modal">Não</button>
                    <button class="btn btn-success" type="submit">Sim</button>
                </div>
            </form>
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
<script src="js/datatable-moradores.js"></script>

<script type="text/javascript">
    $('#modalDeleta').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('keyuser');

        var modal = $(this);
        modal.find('#key-user').val(id);
    });
</script>

</body>

</html>
