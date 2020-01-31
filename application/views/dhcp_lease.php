<div class="row">
    <div class="col-md">
        <h1 class="h3 mb-4">DHCP Leases</h1>
        <?= $this->session->flashdata('msg'); ?>
        <div class="table-responsive">
            <table id="dataTable" class="table table-striped table-bordered dt-responsive nowrap mt-3">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Address</th>
                        <th>Active Address</th>
                        <th>Mac Address</th>
                        <th>Active Mac Address</th>
                        <th>Host Name</th>
                        <th>Server</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    if (isset($dhcp_lease)) {
                        foreach ($dhcp_lease as $dhcp) { ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $dhcp['address']; ?></td>
                                <td><?= $dhcp['active_address']; ?></td>
                                <td><?= $dhcp['mac_address']; ?></td>
                                <td><?= $dhcp['active_mac_address']; ?></td>
                                <td><?= $dhcp['host_name']; ?></td>
                                <td><?= $dhcp['server']; ?></td>
                                <td><?= $dhcp['status']; ?></td>
                            </tr>
                        <?php }
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>