<div class="row">
    <div class="col-md">
        <h1 class="h3 mb-4">Hosts</h1>
        <?= $this->session->flashdata('msg'); ?>
        <div class="table-responsive">
            <table id="dataTable" class="table table-striped table-bordered dt-responsive nowrap mt-3">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Server</th>
                        <th>Mac Address</th>
                        <th>IP Address</th>
                        <th>To Address</th>
                        <th>Comment</th>
                        <th>Kick</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    if (isset($host)) {
                        foreach ($host as $online) { ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?php if ($online['server']) {
                                        echo ucwords($online['server']);
                                    } else {
                                        echo 'all';
                                    } ?></td>
                                <td><?= $online['mac_address']; ?></td>
                                <td><?= $online['address']; ?></td>
                                <td><?= $online['to_address']; ?></td>
                                <td><?php if ($online['comment']) {
                                        echo ucwords($online['comment']);
                                    } else {
                                        echo '-';
                                    } ?></td>
                                <td>
                                    <a class="btn btn-danger btn-sm" href="<?= base_url('hotspot/host_delete/' . urlencode($online['id'])); ?>" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php }
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>