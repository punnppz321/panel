<?= $this->extend('Layout/Starter') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-lg-12">
        <div class="alert alert-primary" role="alert">
            
        </div>
        <div class="card shadow-sm">


       
           
            <div class="card-header bg-primary text-black h6 p-3">

           <div class="float-left">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-file-arrow-down-fill"></i>Open Menu
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-start" aria-labelledby="navbarDropdown">
                                    <li>
                
            <li>
                                            <a class="dropdown-item" href="<?= site_url('admin/manage-users') ?>">
                                                <i class="bi bi-people style="color: red"></i> Manage Users
                                            
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="<?= site_url('keys/generate') ?>">
                                                <i class="bi bi-shield-x"></i>  Generate Keys
                                            </a>
                                        </li>
                                        
                                        <li>
                                        <a class="dropdown-item" href="<?= site_url('admin/user/alter') ?>">
                                            <i class="bi bi-trash-fill"></i>Delete Users
                                        </a>
                                    </li>
                
           
            </div>

</div>
            <div class="card-body">
                <!-- <?php if ($user_list) : ?> -->

                <div class="table-responsive">
                    <table id="datatable" class="table table-bordered table-hover text-center" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="row">#</th>
                                <th>Username</th>
                                <th>Fullname</th>
                                <th>Level</th>
                                <th>Saldo</th>
                                <th>Status</th>
                                <th>Uplink</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <!-- <?php endif; ?> -->

            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('css') ?>
<?= link_tag("https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css") ?>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<?= script_tag("https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js") ?>

<?= script_tag("https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js") ?>
<script>
    $(document).ready(function() {
        var table = $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            order: [
                [0, "desc"]
            ],
            ajax: "<?= site_url('admin/api/users') ?>",
            columns: [{
                    data: 'id',
                },
                {
                    data: 'username',
                },
                {
                    data: 'fullname',
                    render: function(data, type, row, meta) {
                        return (row.fullname ? row.fullname : '~');
                    }
                },
                {
                    data: 'level',
                },
                {
                    data: 'saldo',
                    render: function(data, type, row, meta) {
                        var textc = (row.level === 'Admin' ? 'primary' : 'dark');
                        var saldo = (row.level === 'Admin' ? '&mstpos;' : row.saldo);
                        return `<span class="badge text-${textc}">${saldo}</span>`;
                    }
                },
                {
                    data: 'status',
                    name: 'status',
                    render: function(data, type, row, meta) {
                        var act = `<span class="text-success">Active</span>`;
                        var ban = `<span class="text-danger">Banned</span>`;
                        return (row.status == 1 ? act : ban);
                    }
                },
                {
                    data: 'uplink',
                },
                {
                    data: null,
                    render: function(data, type, row, meta) {
                        return `<a href="${window.location.origin}/public/admin/user/${row.id}" class="btn btn-dark btn-sm">EDIT</a> <a href="${window.location.origin}/public/admin/user/singledelete/${row.id}" class="btn btn-dark btn-sm">Delete</a>`; 
                    }
                }
            ]
        });
    });
</script>

<?= $this->endSection() ?>