<?= $this->extend('Layout/Starter') ?>

<?= $this->section('content') ?>

<div class="row justify-content-center">
    <div class="row">
        <div class="col-lg-12">
            <?= $this->include('Layout/msgStatus') ?>
        </div>
        <div class="col-lg-12">
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white">
                    <div class="row">
                        <div class="col pt-1">
                           <strong> Keys Registered </strong>
                            
                            
                        </div>
                        <div class="col text-end">

                        <div class="float-right">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-file-arrow-down-fill"></i>Open Menu
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-start" aria-labelledby="navbarDropdown">
                                 <div class="card-header bg-light text-black h6 p-3">
                                     
                                     
                                        <li>
                                            <a class="dropdown-item" href="<?= site_url('keyz/generates') ?>">
                                                <i class="bi bi-file-plus-fill"></i>&nbsp; <button type="button" class="btn btn-secondary">Generate</button>
                                            
                                            </a>
                                           
                                        </li>
                                         <br>
                                        <li>
                                            <a class="dropdown-item" href="<?= site_url('keyz/alter') ?>">
                                                <i class="bi bi-shield-x"></i>&nbsp; <button class="btn btn-secondary">Delete Expired</button>
                                            
                                            </a>
                                        </li>
                                         <br>
                                        <li>
                                        <a class="dropdown-item" href="<?= site_url('keyz/deleteAll')  ?>">
                                            <i class="bi bi-trash-fill"></i>&nbsp;  <button class="btn btn-secondary">Delete All</button>
                                        </a>
                                    </li>
                                     <br>
                                    <li>
                                        <a class="dropdown-item" href="<?= site_url('keyz/start')  ?>">
                                            <i class="bi bi-backspace-reverse-fill"></i> &nbsp; <button class="btn btn-secondary">Delete Not Used</button>
                                        </a>
                                    </li>
                                     <br>
                                     </li>
                                    
                                    <a class="dropdown-item" href="<?= site_url('keyz/resetAll') ?>">
                                          <i class="bi bi-bootstrap-reboot"></i>&nbsp; <button class="btn btn-secondary">Reset All Key</button>
                                      </a>
                                  </li>
                                
                                    <li>
                                        <a class="dropdown-item" href="<?= site_url('keyz/download/all')  ?>">
                                            <i class="bi bi-download"></i> &nbsp;<button class="btn btn-secondary">Download All Key </button>
                                        </a>
                                    </li>
                                    
                                 
                                    
                                </ul>
                            </li>
                        </ul>
                    </div>
                       
                        </div>
                    </div>
                </div>
                
                <div class="card-body">
                    <?php if ($keyzlistz) : ?>
                        <div class="table-responsive">
                            <table id="datatable" class="table table-bordered table-hover text-center" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Game</th>
                                        <th>User Keys</th>
                                        <th>Devices</th>
                                        <th>Duration</th>
                                        <th>Expired</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    <?php else : ?>
                        <p class="text-center">Nothing keys to show</p>
                    <?php endif; ?>
                </div>
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
            ajax: "<?= site_url('keyz/api') ?>",
            columns: [{
                    data: 'id',
                    name: 'id_keyz'
                },
                {
                    data: 'game',
                },
                {
                    data: 'user_key',
                    render: function(data, type, row, meta) {
                        var is_valid = (row.status == 'Active') ? "text-success" : "text-danger";
                        return `<span class="${is_valid} ">${(row.user_key ? row.user_key : '&mdash;')}</span> `;
                    }
                },
                {
                    data: 'devices',
                    render: function(data, type, row, meta) {
                        var totalDevice = (row.devices ? row.devices : 0);
                        return `<span id="devMax-${row.user_key}">${totalDevice}/${row.max_devices}</span>`;
                    }
                },
                {
                    data: 'duration',
                    render: function(data, type, row, meta) {
                        return row.duration;
                    }
                },
                {
                    data: 'expired',
                    name: 'expired_date',
                    render: function(data, type, row, meta) {
                        return row.expired ? `<span class="badge text-dark">${row.expired}</span>` : '(not started yet)';
                    }
                },
                {
                    data: null,
                    render: function(data, type, row, meta) {
                        var btnReset = `<button class="btn btn-outline-warning btn-sm" onclick="resetUserKeyz('${row.user_key}')"
                        data-bs-toggle="tooltip" data-bs-placement="left" title="Reset key?"><i class="bi bi-bootstrap-reboot"></i></button>`;
                        
                        var btnEdits = `<a href="${window.location.origin}/keyz/${row.id}" class="btn btn-outline-dark btn-sm"
                        data-bs-toggle="tooltip" data-bs-placement="left" title="Edit key information?"><i class="bi bi-gear"></i></a>`;
                        
                        
                        var btnDelete = `<button class="btn btn-outline-danger btn-sm" onclick="deleteKeyz('${row.user_key}')"
                        data-bs-toggle="tooltip" data-bs-placement="left" title="Delete Key?"><i class="bi bi-trash"></i></button>`;
                        
                        
                        return `<div class="d-grid gap-2 d-md-block">${btnReset} ${btnEdits} ${btnDelete}</div>`;
                    }
                }
            ]
        });

        $("#blur-out").click(function() {
            if ($(".keyBlur").hasClass("key-sensi")) {
                $(".keyBlur").removeClass("key-sensi");
                $("#blur-out").html(`<i class="bi bi-eye"></i>`);
            } else {
                $(".keyBlur").addClass("key-sensi");
                $("#blur-out").html(`<i class="bi bi-eye-slash"></i>`);
            }
        });
    });

function deleteKeyz(keyz) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete'
        }).then((result) => {
            if (result.isConfirmed) {
                Toast.fire({
                    icon: 'info',
                    title: 'Please wait...'
                })

                var base_url = window.location.origin;
                var api_url = `${base_url}/keyz/delete`;
                $.getJSON(api_url, {
                        userkey: keyz,
                        delete: 1
                    },
                    function(data, textStatus, jqXHR) {
                        if (textStatus == 'success') {
                            if (data.registered) {
                                if (data.delete) {
                                    $(`#devMax-${keyz}`).html(`0/${data.devices_max}`);
                                    Swal.fire(
                                        'Deleted!',
                                        'Key has been deleted Successfully.',
                                        'success'
                                    )
                                } else {
                                    Swal.fire(
                                        'Failed!',
                                        data.devices_total ? "You don't have any access to this user." : "Only Admin can delete the user.",
                                        data.devices_total ? 'error' : 'error'
                                        
                                    )
                                }
                            } else {
                                Swal.fire(
                                    'Failed!',
                                    "User key no longer exists.",
                                    'error'
                                )
                            }
                        }
                    }
                );
            }
        });
    }
    function resetUserKeyz(keyz) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, reset'
        }).then((result) => {
            if (result.isConfirmed) {
                Toast.fire({
                    icon: 'info',
                    title: 'Please wait...'
                })

                var base_url = window.location.origin;
                var api_url = `${base_url}/keyz/reset`;
                $.getJSON(api_url, {
                        userkey: keyz,
                        reset: 1
                    },
                    function(data, textStatus, jqXHR) {
                        if (textStatus == 'success') {
                            if (data.registered) {
                                if (data.reset) {
                                    $(`#devMax-${keyz}`).html(`0/${data.devices_max}`);
                                    Swal.fire(
                                        'Reset!',
                                        'Your device key has been reset.',
                                        'success'
                                    )
                                } else {
                                    Swal.fire(
                                        'Failed!',
                                        data.devices_total ? "You don't have any access to this user." : "User key devices already reset.",
                                        data.devices_total ? 'error' : 'warning'
                                    )
                                }
                            } else {
                                Swal.fire(
                                    'Failed!',
                                    "User key no longer exists.",
                                    'error'
                                )
                            }
                        }
                    }
                );
            }
        });
    }
</script>

<?= $this->endSection() ?>