<div class="row">
    <div class="col-md">
        <h1 class="h3 mb-4">
            <a class="ml-2 btn btn-secondary addBinding" href="#" data-toggle="modal" data-target="#modalForm"><i class="fa fa-plus-circle"></i> Add</a>
            <span class="float-right">Bindings</span>
        </h1>
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
                        <th>Type</th>
                        <th>Comment</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    if (isset($ip_binding)) {
                        foreach ($ip_binding as $online) { ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?php if ($online['server']) {
                                        echo ucwords($online['server']);
                                    } else {
                                        echo 'All';
                                    } ?></td>
                                <td><?= $online['mac_address']; ?></td>
                                <td><?php if ($online['address']) {
                                        echo $online['address'];
                                    } else {
                                        echo '-';
                                    } ?></td>
                                <td><?php if ($online['to_address']) {
                                        echo $online['to_address'];
                                    } else {
                                        echo '-';
                                    } ?></td>
                                <td><?= ucwords($online['type']); ?></td>
                                <td><?php if ($online['comment']) {
                                        echo ucwords($online['comment']);
                                    } else {
                                        echo '-';
                                    } ?></td>
                                <td>
                                    <a class="btn btn-warning btn-sm editBinding" href="#" data-toggle="modal" data-target="#modalForm" data-id="<?= $online['id']; ?>"><i class="fa fa-edit"></i></a>
                                    <a class="btn btn-danger btn-sm" href="<?= base_url('hotspot/ip_binding_delete/' . urlencode($online['id'])); ?>" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php }
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="modalFormLabel" aria-hidden="true">
    <form action="<?= base_url('hotspot/ip_binding_add') ?>" method="post">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title" id="modalFormLabel">ADD BINDING</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="mac_address">Mac Address</label>
                        <input class="form-control" type="text" name="mac_address" id="mac_address" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input class="form-control" type="text" name="address" id="address">
                    </div>
                    <div class="form-group">
                        <label for="to_address">To Address</label>
                        <input class="form-control" type="text" name="to_address" id="to_address">
                    </div>
                    <div class="form-group">
                        <label for="server">Server</label>
                        <select name="server" id="server" class="form-control" required>
                            <option value="all">All</option>
                            <?php foreach ($servers as $server) { ?>
                                <option value="<?= $server['name']; ?>"><?= ucwords($server['name']); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="type">Type</label>
                        <select name="type" id="type" class="form-control" required>
                            <option value="">---</option>
                            <?php foreach ($type as $tp) { ?>
                                <option value="<?= $tp; ?>"><?= ucwords($tp); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="disabled">Disabled</label>
                        <select name="disabled" id="disabled" class="form-control">
                            <option value="false">No</option>
                            <option value="true">Yes</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="comment">Comment</label>
                        <textarea class="form-control" name="comment" id="comment" rows="5"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-dark">Save</button>
                </div>
            </div>
        </div>
    </form>
</div>