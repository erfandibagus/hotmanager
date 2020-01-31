<div class="row">
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-6">
                <div class="card text-white bg-info mb-3">
                    <div class="card-body">
                        <h5 class="card-title"><a class="text-white" href="<?= base_url('hotspot/active') ?>"><?php if ($total_active > 1) {
                                                                                                                    echo $total_active . ' Items';
                                                                                                                } else {
                                                                                                                    echo $total_active . ' Item';
                                                                                                                } ?></a></h5>
                        <p class="card-text"><i class="fa fa-laptop mr-1"></i> Hotspot Active</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card text-white bg-success mb-3">
                    <div class="card-body">
                        <h5 class="card-title"><a class="text-white" href="<?= base_url('hotspot/user') ?>"><?php if ($total_users > 1) {
                                                                                                                echo $total_users . ' Items';
                                                                                                            } else {
                                                                                                                echo $total_users . ' Item';
                                                                                                            } ?></a></h5>
                        <p class="card-text"><i class="fa fa-laptop mr-1"></i> Hotspot User</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-body">
                        <h5 class="card-title"><a class="text-white addUser" href="#" data-toggle="modal" data-target="#modalForm"><i class="fa fa-plus-circle"></i> Add</a></h5>
                        <p class="card-text"><i class="fa fa-laptop mr-1"></i> Hotspot User</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card text-white bg-danger mb-3">
                    <div class="card-body">
                        <h5 class="card-title"><a class="text-white addGenerate" href="#" data-toggle="modal" data-target="#modalGenerateForm"><i class="fa fa-plus-circle"></i> Generate</a></h5>
                        <p class="card-text"><i class="fa fa-laptop mr-1"></i> Hotspot User</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md">
                <div class="card text-white bg-dark mb-3">
                    <div class="card-body">
                        <p class="card-text"><i class="fa fa-calendar mr-1"></i> Date Time: <?= date('Y/m/d H:i:s'); ?></p>
                        <p class="card-text"><i class="fa fa-microchip mr-1"></i> Router Uptime: <?= $this->utils->formatDTM($resource[0]['uptime']); ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md">
                <div class="card bg-light d-flex mb-3">
                    <h5 class="card-header bg-dark text-white"><?= strtoupper($resource[0]['platform']); ?> V<?= $resource[0]['version']; ?></h5>
                    <div class="card-body">
                        <p class="card-text"><strong>CPU:</strong> <?= $resource[0]['cpu']; ?> <?= $resource[0]['cpu_count']; ?> x <?= $resource[0]['cpu_frequency']; ?> Mhz</p>
                        <p class="card-text"><strong>Board:</strong> <?= $resource[0]['board_name']; ?></p>
                        <p class="card-text"><strong>Architecture:</strong> <?= $resource[0]['architecture_name']; ?></p>
                        <p class="card-text"><strong>Memory:</strong> <?= $this->utils->formatBytes2($resource[0]['free_memory']); ?>/<?= $this->utils->formatBytes2($resource[0]['total_memory']); ?></p>
                        <p class="card-text"><strong>Storage:</strong> <?= $this->utils->formatBytes2($resource[0]['free_hdd_space']); ?>/<?= $this->utils->formatBytes2($resource[0]['total_hdd_space']); ?></p>
                        <p class="card-text"><strong>Build:</strong> <?= $resource[0]['build_time']; ?></p>
                        <p class="card-text">
                            <a class="btn btn-secondary btn-sm mb-2" href="<?= base_url('mikrotik/reboot'); ?>"><i class="fa fa-undo"></i> Reboot</a>
                            <a class="btn btn-secondary btn-sm mb-2" href="<?= base_url('mikrotik/shutdown'); ?>"><i class="fa fa-power-off"></i> Shutdown</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <h1 class="h3 mb-4">Hotspot Logs</h1>
        <div class="table-responsive">
            <table id="dataTable" class="table table-striped table-bordered dt-responsive nowrap mt-3" style="width:100%">
                <thead class="thead-dark">
                    <tr>
                        <th>Time</th>
                        <th>User (IP Address)</th>
                        <th>Message</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($logs)) {
                        foreach ($logs as $log) {
                            $msg = explode(':', $log['message']);
                            if ($msg[0] == '->') {
                                ?>
                                <tr>
                                    <td><?= $log['time'] ?></td>
                                    <td><?= trim($msg[1]); ?></td>
                                    <td><?= trim($msg[2]); ?></td>
                                </tr>
                            <?php }
                        }
                    } ?>
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
                    <h5 class="modal-title" id="modalGenerateLabel"></h5>
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