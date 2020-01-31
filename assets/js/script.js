function printUser(url) {
    window.open(url, '_blank').print();
    win.focus();
}

const host = base_url();

function base_url() {
    var pathparts = location.pathname.split('/');
    if (location.host == 'localhost' || location.host == 'localhost:8888') {
        var url = location.origin + '/' + pathparts[1].trim('/');
    } else {
        var url = location.origin;
    }
    return url;
}

// User Edit
$(function () {
    $('.addUser').on('click', function () {
        $('#modalFormLabel').html('Add User');
        $('.modal-footer button[type=submit]').html('Add');
        $('#id').val('');
        $('#server').val('all');
        $('#profile').val('default');
        $('#name').val('');
        $('#password').val('');
        $('#disabled').val('false');
        $('#limit').val('1h');
        $('#comment').val('');
    });

    $('.addGenerate').on('click', function () {
        $('#modalGenerateLabel').html('Generate Users');
        $('.modal-footer button[type=submit]').html('Generate');
        $('.modal-body #qty').val('1');
        $('.modal-body #server').val('all');
        $('.modal-body #profile').val('default');
        $('.modal-body #mode').val('1');
        $('.modal-body #character').val('alnum');
        $('.modal-body #length').val('6');
        $('.modal-body #disabled').val('false');
        $('.modal-body #limit').val('1h');
        $('.modal-body #comment').val('');
    });

    $('.editUser').on('click', function () {
        const id = $(this).data('id');
        $('#modalFormLabel').html('Edit User');
        $('.modal-footer button[type=submit]').html('Update');
        $('.modal form').attr('action', host + '/hotspot/user_update');
        $.ajax({
            url: host + '/hotspot/user_detail',
            data: {
                id: id
            },
            method: 'post',
            dataType: 'json',
            success: function (response) {
                $('#id').val(response[0].id);
                if (response[0].server) {
                    $('#server').val(response[0].server);
                } else {
                    $('#server').val('all');
                }
                $('#profile').val(response[0].profile);
                $('#name').val(response[0].name);
                $('#password').val(response[0].password);
                $('#disabled').val(response[0].disabled);
                $('#limit').val(response[0].limit_uptime);
                $('#comment').val(response[0].comment);
            }
        });
    });

    $('.detailUser').on('click', function () {
        function ucwords(str) {
            return (str + '').replace(/^([a-z])|\s+([a-z])/g, function ($1) {
                return $1.toUpperCase();
            });
        }
        const id = $(this).data('id');
        $.ajax({
            url: host + '/hotspot/user_detail',
            data: {
                id: id
            },
            method: 'post',
            dataType: 'json',
            success: function (response) {
                var server;
                if (response[0].server) {
                    server = ucwords(response[0].server);
                } else {
                    server = 'All';
                }

                var disabled;
                if (response[0].disabled == true) {
                    disabled = 'Yes';
                } else {
                    disabled = 'No';
                }

                var limit;
                if (response[0].limit_uptime) {
                    limit = response[0].limit_uptime + ' Hour';
                } else {
                    limit = 'Unlimited';
                }

                var comment;
                if (response[0].comment) {
                    comment = response[0].comment;
                } else {
                    comment = '-';
                }

                $('#result').html(
                    `<table class="table table-borderless"><tr><th>Username</th><td><input class="form-control" type="text" readonly value="` + response[0].name + `"></td></tr><tr><th>Password</th><td><input class="form-control" type="text" readonly value="` + response[0].password + `"></td></tr></table><hr /><table class="table table-borderless"><tr><th>Profile</th><td><input class="form-control" type="text" readonly value="` + ucwords(response[0].profile) + `"></td></tr><tr><th>Limit</th><td><input class="form-control" type="text" readonly value="` + limit + `"></td></tr><tr><th>Uptime</th><td><input class="form-control" type="text" readonly value="` + response[0].uptime.trim() + `"></td></tr><tr><th>Bytes In</th><td><input class="form-control" type="text" readonly value="` + response[0].bytes_in + `"></td></tr><tr><th>Bytes Out</th><td><input class="form-control" type="text" readonly value="` + response[0].bytes_out + `"></td></tr><tr><th>Server</th><td><input class="form-control" type="text" readonly value="` + server + `"></td></tr><tr><th>Disabled</th><td><input class="form-control" type="text" readonly value="` + disabled + `"></td></tr><tr><th>Comment</th><td><textarea class="form-control" rows="5" readonly>` + comment + `</textarea></td></tr></table>`
                );
            }
        });
    });
});

// Profle Edit
$(function () {
    $('.addProfile').on('click', function () {
        $('#modalFormLabel').html('Add Profile');
        $('.modal-footer button[type=submit]').html('Add');
        $('#id').val('');
        $('#name').val('');
        $('#pool').val('');
        $('#shared').val('1');
        $('#limit').val('');
    });

    $('.editProfile').on('click', function () {
        const id = $(this).data('id');
        $('#modalFormLabel').html('Edit Profile');
        $('.modal-footer button[type=submit]').html('Update');
        $('.modal form').attr('action', host + '/hotspot/user_profile_update');
        $.ajax({
            url: host + '/hotspot/user_profile_edit',
            data: {
                id: id
            },
            method: 'post',
            dataType: 'json',
            success: function (response) {
                $('#id').val(response[0].id);
                $('#name').val(response[0].name);
                $('#pool').val(response[0].address_pool);
                $('#shared').val(response[0].shared_users);
                $('#limit').val(response[0].rate_limit);
            }
        });
    });
});

// Binding Edit
$(function () {
    $('.addBinding').on('click', function () {
        $('#modalFormLabel').html('Add Binding');
        $('.modal-footer button[type=submit]').html('Add');
        $('#id').val('');
        $('#mac_address').val('');
        $('#address').val('');
        $('#to_address').val('');
        $('#server').val('all');
        $('#type').val('');
        $('#disabled').val('false');
        $('#comment').val('');
    });

    $('.editBinding').on('click', function () {
        const id = $(this).data('id');
        $('#modalFormLabel').html('Edit Binding');
        $('.modal-footer button[type=submit]').html('Update');
        $('.modal form').attr('action', host + '/hotspot/ip_binding_update');
        $.ajax({
            url: host + '/hotspot/ip_binding_edit',
            data: {
                id: id
            },
            method: 'post',
            dataType: 'json',
            success: function (response) {
                $('#id').val(response[0].id);
                $('#mac_address').val(response[0].mac_address);
                $('#address').val(response[0].address);
                $('#to_address').val(response[0].to_address);
                if (response[0].server) {
                    $('#server').val(response[0].server);
                } else {
                    $('#server').val('all');
                }
                $('#type').val(response[0].type);
                $('#disabled').val(response[0].disabled);
                $('#comment').val(response[0].comment);
            }
        });
    });
});