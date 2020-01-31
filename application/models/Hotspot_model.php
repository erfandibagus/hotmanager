<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PEAR2\Net\RouterOS;

class Hotspot_model extends CI_Model
{

    private $client = NULL;

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('logged_in') == TRUE) {
            $client = new RouterOS\Client(
                $this->session->userdata('ip'),
                $this->session->userdata('username'),
                $this->session->userdata('password')
            );
            $this->client = $client;
        }
    }

    public function active()
    {
        $responses = $this->client->sendSync(new RouterOS\Request('/ip/hotspot/active/print'));
        foreach ($responses as $response) {
            if ($response->getType() === RouterOS\Response::TYPE_DATA) {
                $data[] = [
                    'id'                    => $response->getProperty('.id'),
                    'server'                => $response->getProperty('server'),
                    'user'                  => $response->getProperty('user'),
                    'address'               => $response->getProperty('address'),
                    'mac_address'           => $response->getProperty('mac-address'),
                    'login_by'              => $response->getProperty('login-by'),
                    'uptime'                => $response->getProperty('uptime'),
                    'session_time_left'     => $response->getProperty('session-time-left'),
                    'idle_time'             => $response->getProperty('idle-time'),
                    'keepalive_timeout'     => $response->getProperty('keepalive-timeout'),
                    'bytes_in'              => $response->getProperty('bytes-in'),
                    'bytes_out'             => $response->getProperty('bytes-out'),
                    'packets_in'            => $response->getProperty('packets-in'),
                    'packets_out'           => $response->getProperty('packets-out'),
                    'radius'                => $response->getProperty('radius')
                ];
            }
        }
        if (isset($data)) {
            return $data;
        } else {
            return NULL;
        }
    }

    public function host()
    {
        $responses = $this->client->sendSync(new RouterOS\Request('/ip/hotspot/host/print'));
        foreach ($responses as $response) {
            if ($response->getType() === RouterOS\Response::TYPE_DATA) {
                $data[] = [
                    'id'                => $response->getProperty('.id'),
                    'mac_address'       => $response->getProperty('mac-address'),
                    'address'           => $response->getProperty('address'),
                    'to_address'        => $response->getProperty('to-address'),
                    'server'            => $response->getProperty('server'),
                    'uptime'            => $response->getProperty('uptime'),
                    'idle_time'         => $response->getProperty('idle-time'),
                    'host_dead_time'    => $response->getProperty('host-dead-time'),
                    'bytes_in'          => $response->getProperty('bytes-in'),
                    'bytes_out'         => $response->getProperty('bytes-out'),
                    'packets_in'        => $response->getProperty('packets-in'),
                    'packets_out'       => $response->getProperty('packets-out'),
                    'static'            => $response->getProperty('static'),
                    'authorized'        => $response->getProperty('authorized'),
                    'bypassed'          => $response->getProperty('bypassed'),
                    'comment'           => $response->getProperty('comment')
                ];
            }
        }
        if (isset($data)) {
            return $data;
        } else {
            return NULL;
        }
    }

    public function ip_binding()
    {
        $responses = $this->client->sendSync(new RouterOS\Request('/ip/hotspot/ip-binding/print'));
        foreach ($responses as $response) {
            if ($response->getType() === RouterOS\Response::TYPE_DATA) {
                if (!$response->getProperty('comment')) {
                    $comment = NULL;
                } else {
                    $comment = $response->getProperty('comment');
                }
                $data[] = [
                    'id'            => $response->getProperty('.id'),
                    'mac_address'   => $response->getProperty('mac-address'),
                    'user'          => $response->getProperty('address'),
                    'address'       => $response->getProperty('address'),
                    'to_address'    => $response->getProperty('to-address'),
                    'server'        => $response->getProperty('server'),
                    'type'          => $response->getProperty('type'),
                    'bypassed'      => $response->getProperty('bypassed'),
                    'disabled'      => $response->getProperty('disabled'),
                    'comment'       => $comment
                ];
            }
        }
        if (isset($data)) {
            return $data;
        } else {
            return NULL;
        }
    }

    public function server()
    {
        $responses = $this->client->sendSync(new RouterOS\Request('/ip/hotspot/print'));
        foreach ($responses as $response) {
            if ($response->getType() === RouterOS\Response::TYPE_DATA) {
                $data[] = [
                    'id'                    => $response->getProperty('.id'),
                    'name'                  => $response->getProperty('name'),
                    'interface'             => $response->getProperty('interface'),
                    'address_pool'          => $response->getProperty('address-pool'),
                    'profile'               => $response->getProperty('profile'),
                    'idle_timeout'          => $response->getProperty('idle-timeout'),
                    'keepalive_timeout'     => $response->getProperty('keepalive-timeout'),
                    'addresses_per_mac'     => $response->getProperty('addresses-per-mac'),
                    'proxy_status'          => $response->getProperty('proxy-status'),
                    'invalid'               => $response->getProperty('invalid'),
                    'https'                 => $response->getProperty('HTTPS'),
                    'disabled'              => $response->getProperty('disabled')
                ];
            }
        }
        if (isset($data)) {
            return $data;
        } else {
            return NULL;
        }
    }

    public function server_profile()
    {
        $responses = $this->client->sendSync(new RouterOS\Request('/ip/hotspot/profile/print'));
        foreach ($responses as $response) {
            if ($response->getType() === RouterOS\Response::TYPE_DATA) {
                $data[] = [
                    'id'                    => $response->getProperty('.id'),
                    'name'                  => $response->getProperty('name'),
                    'hotspot_address'       => $response->getProperty('hotspot-address'),
                    'dns_name'              => $response->getProperty('dns-name'),
                    'html_directory'        => $response->getProperty('html-directory'),
                    'rate_limit'            => $response->getProperty('rate-limit'),
                    'http_proxy'            => $response->getProperty('http-proxy'),
                    'smtp_server'           => $response->getProperty('smtp-server'),
                    'login_by'              => $response->getProperty('login-by'),
                    'http_cookie_lifetime'  => $response->getProperty('http-cookie-lifetime'),
                    'split_user_domain'     => $response->getProperty('split-user-domain'),
                    'use_radius'            => $response->getProperty('use-radius'),
                    'default'               => $response->getProperty('default')
                ];
            }
        }
        if (isset($data)) {
            return $data;
        } else {
            return NULL;
        }
    }

    public function users()
    {
        $responses = $this->client->sendSync(new RouterOS\Request('/ip/hotspot/user/print'));
        foreach ($responses as $response) {
            if ($response->getType() === RouterOS\Response::TYPE_DATA) {
                if (!$response->getProperty('comment')) {
                    $comment = NULL;
                } else {
                    $comment = $response->getProperty('comment');
                }
                $data[] = [
                    'id'            => $response->getProperty('.id'),
                    'server'        => $response->getProperty('server'),
                    'name'          => $response->getProperty('name'),
                    'password'      => $response->getProperty('password'),
                    'profile'       => $response->getProperty('profile'),
                    'limit_uptime'  => $response->getProperty('limit-uptime'),
                    'uptime'        => $response->getProperty('uptime'),
                    'bytes_in'      => $response->getProperty('bytes-in'),
                    'bytes_out'     => $response->getProperty('bytes-out'),
                    'packets_in'    => $response->getProperty('packets-in'),
                    'packets_out'   => $response->getProperty('packets-out'),
                    'dynamic'       => $response->getProperty('dynamic'),
                    'disabled'      => $response->getProperty('disabled'),
                    'comment'       => $comment
                ];
            }
        }
        if (isset($data)) {
            return $data;
        } else {
            return NULL;
        }
    }

    public function user($id)
    {
        $request = new RouterOS\Request('/ip/hotspot/user/print');
        $query = RouterOS\Query::where('.id', $id);
        $request->setQuery($query);
        $responses = $this->client->sendSync($request);
        foreach ($responses as $response) {
            if ($response->getType() === RouterOS\Response::TYPE_DATA) {
                if (!$response->getProperty('comment')) {
                    $comment = NULL;
                } else {
                    $comment = $response->getProperty('comment');
                }
                $data[] = [
                    'id'            => $response->getProperty('.id'),
                    'server'        => $response->getProperty('server'),
                    'name'          => $response->getProperty('name'),
                    'password'      => $response->getProperty('password'),
                    'profile'       => $response->getProperty('profile'),
                    'limit_uptime'  => $this->utils->formatLimit($response->getProperty('limit-uptime')),
                    'uptime'        => $this->utils->formatDTM($response->getProperty('uptime')),
                    'bytes_in'      => $this->utils->formatBytes($response->getProperty('bytes-in'), 2),
                    'bytes_out'     => $this->utils->formatBytes($response->getProperty('bytes-out'), 2),
                    'packets_in'    => $response->getProperty('packets-in'),
                    'packets_out'   => $response->getProperty('packets-out'),
                    'dynamic'       => $response->getProperty('dynamic'),
                    'disabled'      => $response->getProperty('disabled'),
                    'comment'       => $comment
                ];
            }
        }
        if (isset($data)) {
            return $data;
        } else {
            return NULL;
        }
    }

    public function user_add()
    {
        if ($this->input->post('limit', true)) {
            $limit = trim($this->input->post('limit', true));
        } else {
            $limit = NULL;
        }
        $addRequest = new RouterOS\Request('/ip/hotspot/user/add');

        $addRequest->setArgument('server', trim($this->input->post('server', true)));
        $addRequest->setArgument('name', trim($this->input->post('name', true)));
        $addRequest->setArgument('password', trim($this->input->post('password', true)));
        $addRequest->setArgument('profile', trim($this->input->post('profile', true)));
        $addRequest->setArgument('limit-uptime', $limit);
        $addRequest->setArgument('disabled', trim($this->input->post('disabled', true)));
        $addRequest->setArgument('comment', trim($this->input->post('comment', true)));

        if ($this->client->sendSync($addRequest)->getType() !== RouterOS\Response::TYPE_FINAL) {
            return FALSE;
        }
        return TRUE;
    }

    public function user_update($id)
    {
        if ($this->input->post('limit', true)) {
            $limit = trim($this->input->post('limit', true));
        } else {
            $limit = NULL;
        }
        $setRequest = new RouterOS\Request('/ip/hotspot/user/set');
        $setRequest->setArgument('.id', $id);

        $setRequest->setArgument('server', trim($this->input->post('server', true)));
        $setRequest->setArgument('name', trim($this->input->post('name', true)));
        $setRequest->setArgument('password', trim($this->input->post('password', true)));
        $setRequest->setArgument('profile', trim($this->input->post('profile', true)));
        $setRequest->setArgument('limit-uptime', $limit);
        $setRequest->setArgument('disabled', trim($this->input->post('disabled', true)));
        $setRequest->setArgument('comment', trim($this->input->post('comment', true)));

        if ($this->client->sendSync($setRequest)->getType() !== RouterOS\Response::TYPE_FINAL) {
            return FALSE;
        }
        return TRUE;
    }

    public function user_delete($id)
    {
        $removeRequest = new RouterOS\Request('/ip/hotspot/user/remove');
        $removeRequest->setArgument('.id', $id);
        if ($this->client->sendSync($removeRequest)->getType() !== RouterOS\Response::TYPE_FINAL) {
            return FALSE;
        }
        return TRUE;
    }

    public function user_profiles()
    {
        $responses = $this->client->sendSync(new RouterOS\Request('/ip/hotspot/user/profile/print'));
        foreach ($responses as $response) {
            if ($response->getType() === RouterOS\Response::TYPE_DATA) {
                $data[] = [
                    'id'                    => $response->getProperty('.id'),
                    'name'                  => $response->getProperty('name'),
                    'address_pool'          => $response->getProperty('address-pool'),
                    'idle_timeout'          => $response->getProperty('idle-timeout'),
                    'keepalive_timeout'     => $response->getProperty('keepalive-timeout'),
                    'status_autorefresh'    => $response->getProperty('status-autorefresh'),
                    'shared_users'          => $response->getProperty('shared-users'),
                    'add_mac_cookie'        => $response->getProperty('add-mac-cookie'),
                    'mac_cookie_timeout'    => $response->getProperty('mac-cookie-timeout'),
                    'rate_limit'            => $response->getProperty('rate-limit'),
                    'parent_queue'          => $response->getProperty('parent-queue'),
                    'address_list'          => $response->getProperty('address-list'),
                    'transparent_proxy'     => $response->getProperty('transparent-proxy'),
                    'open_status_page'      => $response->getProperty('open-status-page'),
                    'advertise'             => $response->getProperty('advertise')
                ];
            }
        }
        if (isset($data)) {
            return $data;
        } else {
            return NULL;
        }
    }

    public function user_profile_add()
    {
        $addRequest = new RouterOS\Request('/ip/hotspot/user/profile/add');

        $addRequest->setArgument('name', trim($this->input->post('name', true)));
        $addRequest->setArgument('address-pool', trim($this->input->post('pool', true)));
        $addRequest->setArgument('idle-timeout', 'none');
        $addRequest->setArgument('keepalive-timeout', '2m');
        $addRequest->setArgument('status-autorefresh', '1m');
        $addRequest->setArgument('shared-users', trim($this->input->post('shared', true)));
        $addRequest->setArgument('add-mac-cookie', 'true');
        $addRequest->setArgument('mac-cookie-timeout', '3d');
        $addRequest->setArgument('rate-limit', trim($this->input->post('limit', true)));
        $addRequest->setArgument('parent-queue', 'none');
        $addRequest->setArgument('transparent-proxy', 'true');
        $addRequest->setArgument('open-status-page', 'always');
        $addRequest->setArgument('advertise', 'false');

        if ($this->client->sendSync($addRequest)->getType() !== RouterOS\Response::TYPE_FINAL) {
            return FALSE;
        }
        return TRUE;
    }

    public function user_profile($id)
    {
        $request = new RouterOS\Request('/ip/hotspot/user/profile/print');
        $query = RouterOS\Query::where('.id', $id);
        $request->setQuery($query);
        $responses = $this->client->sendSync($request);
        foreach ($responses as $response) {
            if ($response->getType() === RouterOS\Response::TYPE_DATA) {
                $data[] = [
                    'id'                    => $response->getProperty('.id'),
                    'name'                  => $response->getProperty('name'),
                    'address_pool'          => $response->getProperty('address-pool'),
                    'idle_timeout'          => $response->getProperty('idle-timeout'),
                    'keepalive_timeout'     => $response->getProperty('keepalive-timeout'),
                    'status_autorefresh'    => $response->getProperty('status-autorefresh'),
                    'shared_users'          => $response->getProperty('shared-users'),
                    'add_mac_cookie'        => $response->getProperty('add-mac-cookie'),
                    'mac_cookie_timeout'    => $response->getProperty('mac-cookie-timeout'),
                    'rate_limit'            => $response->getProperty('rate-limit'),
                    'parent_queue'          => $response->getProperty('parent-queue'),
                    'address_list'          => $response->getProperty('address-list'),
                    'transparent_proxy'     => $response->getProperty('transparent-proxy'),
                    'open_status_page'      => $response->getProperty('open-status-page'),
                    'advertise'             => $response->getProperty('advertise')
                ];
            }
        }
        if (isset($data)) {
            return $data;
        } else {
            return NULL;
        }
    }

    public function user_profile_update($id)
    {
        $setRequest = new RouterOS\Request('/ip/hotspot/user/profile/set');
        $setRequest->setArgument('.id', $id);

        $setRequest->setArgument('name', trim($this->input->post('name', true)));
        $setRequest->setArgument('address-pool', trim($this->input->post('pool', true)));
        $setRequest->setArgument('shared-users', trim($this->input->post('shared', true)));
        $setRequest->setArgument('rate-limit', trim($this->input->post('limit', true)));

        if ($this->client->sendSync($setRequest)->getType() !== RouterOS\Response::TYPE_FINAL) {
            return FALSE;
        }
        return TRUE;
    }

    public function user_profile_delete($id)
    {
        $removeRequest = new RouterOS\Request('/ip/hotspot/user/profile/remove');
        $removeRequest->setArgument('.id', $id);
        if ($this->client->sendSync($removeRequest)->getType() !== RouterOS\Response::TYPE_FINAL) {
            return FALSE;
        }
        return TRUE;
    }

    public function active_delete($id)
    {
        $removeRequest = new RouterOS\Request('/ip/hotspot/active/remove');
        $removeRequest->setArgument('.id', $id);
        if ($this->client->sendSync($removeRequest)->getType() !== RouterOS\Response::TYPE_FINAL) {
            return FALSE;
        }
        return TRUE;
    }

    public function host_delete($id)
    {
        $removeRequest = new RouterOS\Request('/ip/hotspot/host/remove');
        $removeRequest->setArgument('.id', $id);
        if ($this->client->sendSync($removeRequest)->getType() !== RouterOS\Response::TYPE_FINAL) {
            return FALSE;
        }
        return TRUE;
    }

    public function ip_binding_add()
    {
        if ($this->input->post('address', true)) {
            $address = trim($this->input->post('address', true));
        } else {
            $address = NULL;
        }

        if ($this->input->post('to_address', true)) {
            $to_address = trim($this->input->post('to_address', true));
        } else {
            $to_address = NULL;
        }

        $addRequest = new RouterOS\Request('/ip/hotspot/ip-binding/add');

        $addRequest->setArgument('mac-address', trim($this->input->post('mac_address', true)));
        $addRequest->setArgument('address', $address);
        $addRequest->setArgument('to-address', $to_address);
        $addRequest->setArgument('server', trim($this->input->post('server', true)));
        $addRequest->setArgument('type', trim($this->input->post('type', true)));
        $addRequest->setArgument('disabled', trim($this->input->post('disabled', true)));
        $addRequest->setArgument('comment', trim($this->input->post('comment', true)));

        if ($this->client->sendSync($addRequest)->getType() !== RouterOS\Response::TYPE_FINAL) {
            return FALSE;
        }
        return TRUE;
    }

    public function binding($id)
    {
        $request = new RouterOS\Request('/ip/hotspot/ip-binding/print');
        $query = RouterOS\Query::where('.id', $id);
        $request->setQuery($query);
        $responses = $this->client->sendSync($request);
        foreach ($responses as $response) {
            if ($response->getType() === RouterOS\Response::TYPE_DATA) {
                if (!$response->getProperty('comment')) {
                    $comment = NULL;
                } else {
                    $comment = $response->getProperty('comment');
                }
                $data[] = [
                    'id'            => $response->getProperty('.id'),
                    'mac_address'   => $response->getProperty('mac-address'),
                    'user'          => $response->getProperty('address'),
                    'address'       => $response->getProperty('address'),
                    'to_address'    => $response->getProperty('to-address'),
                    'server'        => $response->getProperty('server'),
                    'type'          => $response->getProperty('type'),
                    'bypassed'      => $response->getProperty('bypassed'),
                    'disabled'      => $response->getProperty('disabled'),
                    'comment'       => $comment
                ];
            }
        }
        if (isset($data)) {
            return $data;
        } else {
            return NULL;
        }
    }

    public function ip_binding_update($id)
    {
        if ($this->input->post('address', true)) {
            $address = trim($this->input->post('address', true));
        } else {
            $address = NULL;
        }

        if ($this->input->post('to_address', true)) {
            $to_address = trim($this->input->post('to_address', true));
        } else {
            $to_address = NULL;
        }

        $setRequest = new RouterOS\Request('/ip/hotspot/ip-binding/set');
        $setRequest->setArgument('.id', $id);

        $setRequest->setArgument('mac-address', trim($this->input->post('mac_address', true)));
        $setRequest->setArgument('address', $address);
        $setRequest->setArgument('to-address', $to_address);
        $setRequest->setArgument('server', trim($this->input->post('server', true)));
        $setRequest->setArgument('type', trim($this->input->post('type', true)));
        $setRequest->setArgument('disabled', trim($this->input->post('disabled', true)));
        $setRequest->setArgument('comment', trim($this->input->post('comment', true)));

        if ($this->client->sendSync($setRequest)->getType() !== RouterOS\Response::TYPE_FINAL) {
            return FALSE;
        }
        return TRUE;
    }

    public function ip_binding_delete($id)
    {
        $removeRequest = new RouterOS\Request('/ip/hotspot/ip-binding/remove');
        $removeRequest->setArgument('.id', $id);
        if ($this->client->sendSync($removeRequest)->getType() !== RouterOS\Response::TYPE_FINAL) {
            return FALSE;
        }
        return TRUE;
    }

    public function user_generate($data)
    {
        if ($this->input->post('limit', true)) {
            $limit = trim($this->input->post('limit', true));
        } else {
            $limit = NULL;
        }
        $addRequest = new RouterOS\Request('/ip/hotspot/user/add');

        $addRequest->setArgument('server', trim($this->input->post('server', true)));
        $addRequest->setArgument('name', $data['user']);
        $addRequest->setArgument('password', $data['password']);
        $addRequest->setArgument('profile', trim($this->input->post('profile', true)));
        $addRequest->setArgument('limit-uptime', $limit);
        $addRequest->setArgument('disabled', trim($this->input->post('disabled', true)));
        $addRequest->setArgument('comment', trim($this->input->post('comment', true)));

        if ($this->client->sendSync($addRequest)->getType() !== RouterOS\Response::TYPE_FINAL) {
            return FALSE;
        }
        return TRUE;
    }

    public function cookie()
    {
        $responses = $this->client->sendSync(new RouterOS\Request('/ip/hotspot/cookie/print'));
        foreach ($responses as $response) {
            if ($response->getType() === RouterOS\Response::TYPE_DATA) {
                $data[] = [
                    'id'             => $response->getProperty('.id'),
                    'user'           => $response->getProperty('user'),
                    'mac_address'    => $response->getProperty('mac-address'),
                    'expires_in'     => $response->getProperty('expires-in'),
                    'mac_cookie'     => $response->getProperty('mac-cookie')
                ];
            }
        }
        if (isset($data)) {
            return $data;
        } else {
            return NULL;
        }
    }

    public function cookie_delete($id)
    {
        $removeRequest = new RouterOS\Request('/ip/hotspot/cookie/remove');
        $removeRequest->setArgument('.id', $id);
        if ($this->client->sendSync($removeRequest)->getType() !== RouterOS\Response::TYPE_FINAL) {
            return FALSE;
        }
        return TRUE;
    }

    public function log()
    {
        $request = new RouterOS\Request('/log/print');
        $query = RouterOS\Query::where('topics', 'hotspot,info,debug');
        $request->setQuery($query);
        $responses = $this->client->sendSync($request);
        foreach ($responses as $response) {
            if ($response->getType() === RouterOS\Response::TYPE_DATA) {
                $data[] = [
                    'id'        => $response->getProperty('.id'),
                    'time'      => $response->getProperty('time'),
                    'topics'    => $response->getProperty('topics'),
                    'message'   => $response->getProperty('message'),
                ];
            }
        }
        if (isset($data)) {
            return $data;
        } else {
            return NULL;
        }
    }
}
