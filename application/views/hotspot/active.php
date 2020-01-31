<div class="row">
    <div class="col-md">
        <h1 class="h3 mb-4">Active</h1>
        <?= $this->session->flashdata('msg'); ?>
        <div class="table-responsive">
            <table id="dataTable" class="table table-striped table-bordered dt-responsive nowrap mt-3">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Server</th>
                        <th>Username</th>
                        <th>IP Address</th>
                        <th>Mac Address</th>
                        <th>Uptime</th>
                        <th>Bytes In</th>
                        <th>Bytes Out</th>
                        <th>Time Left</th>
                        <th>Kick</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    if (isset($active)) {
                        foreach ($active as $online) { ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?php if ($online['server']) {
                                        echo ucwords($online['server']);
                                    } else {
                                        echo 'All';
                                    } ?></td>
                                <td><?= $online['user']; ?></td>
                                <td><?= $online['address']; ?></td>
                                <td><?= $online['mac_address']; ?></td>
                                <td><?= $this->utils->formatDTM($online['uptime']); ?></td>
                                <td><?= $this->utils->formatBytes($online['bytes_in'], 2); ?></td>
                                <td><?= $this->utils->formatBytes($online['bytes_out'], 2); ?></td>
                                <td><?= $this->utils->formatDTM($online['session_time_left']); ?></td>
                                <td>
                                    <a class="btn btn-danger btn-sm" href="<?= base_url('hotspot/active_delete/' . urlencode($online['id'])); ?>" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php }
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>