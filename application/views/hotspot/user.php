<div class="row">
    <div class="col-md">
        <div class="row mb-4">
            <div class="col-md-6 float-left">
                <div class="row">
                    <div class="col-sm-6">
                        <a class="ml-1 btn btn-secondary addUser" href="#" data-toggle="modal" data-target="#modalForm"><i class="fa fa-plus-circle mr-1"></i> Add</a>
                        <a class="ml-1 btn btn-secondary addGenerate" href="#" data-toggle="modal" data-target="#modalGenerateForm"><i class="fa fa-users mr-1"></i> Generate</a>
                    </div>
                    <div class="col-sm-6">
                        <a class="btn btn-secondary" href="#" onclick="printUser('<?= base_url('printout?by=users'); ?>')"><i class="fas fa-print mr-1"></i> All Users</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <h1 class="h3 mb-4 float-right">Users</h1>
            </div>
        </div>
        <?= $this->session->flashdata('msg'); ?>
        <div class="table-responsive">
            <table id="dataTable" class="table table-striped table-bordered dt-responsive nowrap mt-3" style="width:100%">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Server</th>
                        <th>Username</th>
                        <th>Profile</th>
                        <th>Uptime</th>
                        <th>Bytes In</th>
                        <th>Bytes Out</th>
                        <th>Comment</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    foreach ($users as $user) { ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?php if ($user['server']) {
                                    echo ucwords($user['server']);
                                } else {
                                    echo 'All';
                                } ?></td>
                            <td><?= $user['name']; ?></td>
                            <td><?= ucwords($user['profile']); ?></td>
                            <td><?= $this->utils->formatDTM($user['uptime']); ?></td>
                            <td><?= $this->utils->formatBytes($user['bytes_in'], 2); ?></td>
                            <td><?= $this->utils->formatBytes($user['bytes_out'], 2); ?></td>
                            <td><?php if ($user['comment']) {
                                    echo ucwords($user['comment']);
                                } else {
                                    echo '-';
                                } ?></td>
                            <td>
                                <a class="btn btn-secondary btn-sm" href="#" onclick="printUser('<?= base_url('printout?by=' . urlencode($user['id'])) ?>')"><i class="fas fa-print"></i></a>
                                <a class="btn btn-success btn-sm detailUser" href="#" data-toggle="modal" data-target="#detailModal" data-id="<?= $user['id']; ?>"><i class="fa fa-eye"></i></a>
                                <a class="btn btn-warning btn-sm editUser" href="#" data-toggle="modal" data-target="#modalForm" data-id="<?= $user['id']; ?>"><i class="fa fa-edit"></i></a>
                                <a class="btn btn-danger btn-sm" href="<?= base_url('hotspot/user_delete/' . urlencode($user['id'])); ?>" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="modalFormLabel" aria-hidden="true">
    <form action="<?= base_url('hotspot/user_add') ?>" method="post">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title" id="modalFormLabel">ADD USER</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
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
                        <label for="profile">Profile</label>
                        <select name="profile" id="profile" class="form-control" required>
                            <?php foreach ($user_profile as $profile) { ?>
                                <option value="<?= $profile['name']; ?>"><?= ucwords($profile['name']); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input class="form-control" type="text" name="name" id="name" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input class="form-control" type="text" name="password" id="password" required>
                    </div>
                    <div class="form-group">
                        <label for="disabled">Disabled</label>
                        <select name="disabled" id="disabled" class="form-control">
                            <option value="false">No</option>
                            <option value="true">Yes</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="limit">Limit</label>
                        <small>
                            <p>Format : 30d = 30 days, 12h = 12 hours, 4w3d = 31 days.</p>
                        </small>
                        <input class="form-control" type="text" name="limit" id="limit">
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

<div class="modal fade" id="modalGenerateForm" tabindex="-1" role="dialog" aria-labelledby="modalGenerateLabel" aria-hidden="true">
    <form action="<?= base_url('hotspot/user_generate') ?>" method="post">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title" id="modalGenerateLabel">ADD USER</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="qty">Qty</label>
                        <input class="form-control" type="number" name="qty" id="qty" required>
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
                        <label for="profile">Profile</label>
                        <select name="profile" id="profile" class="form-control" required>
                            <?php foreach ($user_profile as $profile) { ?>
                                <option value="<?= $profile['name']; ?>"><?= ucwords($profile['name']); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="mode">User Mode</label>
                        <select name="mode" id="mode" class="form-control" required>
                            <option value="1">Username = Password</option>
                            <option value="2">Username != Password</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="character">Character</label>
                        <select name="character" id="character" class="form-control" required>
                            <option value="alpha">Alpha</option>
                            <option value="alphalower">Alpha Lower Case</option>
                            <option value="alphaupper">Alpha Upper Case</option>
                            <option value="alnum">Alpha Numeric</option>
                            <option value="alnumlower">Alpha Numeric Lower Case</option>
                            <option value="alnumupper">Alpha Numeric Upper Case</option>
                            <option value="numeric">Numeric</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="length">Character Length</label>
                        <select name="length" id="length" class="form-control" required>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
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
                        <label for="limit">Limit</label>
                        <small>
                            <p>Format : 30d = 30 days, 12h = 12 hours, 4w3d = 31 days.</p>
                        </small>
                        <input class="form-control" type="text" name="limit" id="limit">
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

<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="detailModalLabel">User Detail</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="result"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>