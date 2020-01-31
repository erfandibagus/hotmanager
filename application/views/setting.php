<div class="row">
    <div class="col-md">
        <?= $this->session->flashdata('msg'); ?>
        <?php if (isset($setting)) { ?>
            <form action="<?= base_url('mikrotik/update_setting'); ?>" method="post">
            <?php } else { ?>
                <form action="" method="post">
                <?php } ?>
                <div class="form-group">
                    <label for="hotspot">Hotspot Name</label>
                    <input class="form-control" type="text" name="hotspot" id="hotspot" <?php if ($setting['hotspot']) {
                                                                                            echo 'value="' . $setting['hotspot'] . '"';
                                                                                        } ?> required>
                </div>
                <div class="form-group">
                    <label for="dnsname">DNS Name</label>
                    <input class="form-control" type="text" name="dnsname" id="dnsname" <?php if ($setting['dnsname']) {
                                                                                            echo 'value="' . $setting['dnsname'] . '"';
                                                                                        } ?> required>
                </div>
                <?php if (isset($setting)) { ?>
                    <button class="btn btn-dark" type="submit">Update</button>
                <?php } else { ?>
                    <button class="btn btn-dark" type="submit">Save</button>
                <?php } ?>
            </form>
    </div>
</div>