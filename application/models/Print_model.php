<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PEAR2\Net\RouterOS;

class Print_model extends CI_Model
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

    public function byUser($id)
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
                    'limit_uptime'  => $response->getProperty('limit-uptime'),
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

    public function byUsers()
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

    public function byServer($server)
    {
        $request = new RouterOS\Request('/ip/hotspot/user/print');
        $query = RouterOS\Query::where('server', $server);
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
                    'limit_uptime'  => $response->getProperty('limit-uptime'),
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

    public function byProfile($profile)
    {
        $request = new RouterOS\Request('/ip/hotspot/user/print');
        $query = RouterOS\Query::where('profile', $profile);
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
                    'limit_uptime'  => $response->getProperty('limit-uptime'),
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
}