<div class="row">
    <div class="col-md">
        <h1 class="h3 mb-4">Cookies</h1>
        <?= $this->session->flashdata('msg'); ?>
        <div class="table-responsive">
            <table id="dataTable" class="table table-striped table-bordered dt-responsive nowrap mt-3">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Username</th>
                        <th>Mac Address</th>
                        <th>Expires In</th>
                        <th>Mac Cookie</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    if (isset($cookie)) {
                        foreach ($cookie as $cook) { ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $cook['user']; ?></td>
                                <td><?= $cook['mac_address']; ?></td>
                                <td><?= $this->utils->formatDTM($cook['expires_in']); ?></td>
                                <td><?php if ($cook['mac_cookie'] == 'false') {
                                        echo '-';
                                    } else {
                                        echo $cook['mac_cookie'];
                                    } ?></td>
                                <td>
                                    <a class="btn btn-danger btn-sm" href="<?= base_url('hotspot/cookie_delete/' . urlencode($cook['id'])); ?>" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php }
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>