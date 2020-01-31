<div class="row">
    <div class="col-md">
        <h1 class="h3 mb-4">
            <a class="ml-1 btn btn-secondary addProfile" href="#" data-toggle="modal" data-target="#modalForm"><i class="fa fa-plus-circle"></i> Add</a>
            <span class="float-right">Profiles</span>
        </h1>
        <?= $this->session->flashdata('msg'); ?>
        <div class="table-responsive">
            <table id="dataTable" class="table table-striped table-bordered dt-responsive nowrap mt-3">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Shared User</th>
                        <th>Rate Limit</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    foreach ($user_profile as $profile) { ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= ucwords($profile['name']); ?></td>
                            <td><?= $profile['shared_users']; ?></td>
                            <td><?php if ($profile['rate_limit']) {
                                    echo ucwords($profile['rate_limit']);
                                } else {
                                    echo 'Unlimited';
                                } ?></td>
                            <td>
                                <a class="btn btn-warning btn-sm editProfile" href="#" data-toggle="modal" data-target="#modalForm" data-id="<?= $profile['id']; ?>"><i class="fa fa-edit"></i></a>
                                <?php if ($profile['name'] != 'default') { ?>
                                    <a class="btn btn-danger btn-sm" href="<?= base_url('hotspot/user_profile_delete/' . urlencode($profile['id'])); ?>" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i></a>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="modalFormLabel" aria-hidden="true">
    <form action="<?= base_url('hotspot/user_profile_add') ?>" method="post">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title" id="modalFormLabel">ADD PROFILE</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input class="form-control" type="text" name="name" id="name" required>
                    </div>
                    <div class="form-group">
                        <label for="pool">Address Pool</label>
                        <select name="pool" id="pool" class="form-control" required>
                            <option value="">---</option>
                            <?php foreach ($ip_pool as $pool) { ?>
                                <option value="<?= $pool['name']; ?>"><?= ucwords($pool['name']); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="shared">Shared Users</label>
                        <input class="form-control" type="number" name="shared" id="shared" required value="1">
                    </div>
                    <div class="form-group">
                        <label for="limit">Rate Limit (Up/Down)</label>
                        <input class="form-control" type="text" name="limit" id="limit" placeholder="512K/1M">
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