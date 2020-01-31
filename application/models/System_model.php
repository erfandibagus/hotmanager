<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PEAR2\Net\RouterOS;

class System_model extends CI_Model
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

    public function resource()
    {
        $responses = $this->client->sendSync(new RouterOS\Request('/system/resource/print'));
        foreach ($responses as $response) {
            if ($response->getType() === RouterOS\Response::TYPE_DATA) {
                $data[] = [
                    'uptime'                    => $response->getProperty('uptime'),
                    'version'                   => $response->getProperty('version'),
                    'build_time'                => $response->getProperty('build-time'),
                    'free_memory'               => $response->getProperty('free-memory'),
                    'total_memory'              => $response->getProperty('total-memory'),
                    'cpu'                       => $response->getProperty('cpu'),
                    'cpu_count'                 => $response->getProperty('cpu-count'),
                    'cpu_frequency'             => $response->getProperty('cpu-frequency'),
                    'cpu_load'                  => $response->getProperty('cpu-load'),
                    'free_hdd_space'            => $response->getProperty('free-hdd-space'),
                    'total_hdd_space'           => $response->getProperty('total-hdd-space'),
                    'write_sect_since_reboot'   => $response->getProperty('write-sect-since-reboot'),
                    'write_sect_total'          => $response->getProperty('write-sect-total'),
                    'architecture_name'         => $response->getProperty('architecture-name'),
                    'board_name'                => $response->getProperty('board-name'),
                    'platform'                  => $response->getProperty('platform')
                ];
            }
        }
        if (isset($data)) {
            return $data;
        } else {
            return NULL;
        }
    }

    public function ip_dhcp_lease()
    {
        $responses = $this->client->sendSync(new RouterOS\Request('/ip/dhcp-server/lease/print'));
        foreach ($responses as $response) {
            if ($response->getType() === RouterOS\Response::TYPE_DATA) {
                $data[] = [
                    'id'                    => $response->getProperty('.id'),
                    'address'               => $response->getProperty('address'),
                    'mac_address'           => $response->getProperty('mac-address'),
                    'address_lists'         => $response->getProperty('address-lists'),
                    'server'                => $response->getProperty('server'),
                    'dhcp_option'           => $response->getProperty('dhcp-option'),
                    'status'                => $response->getProperty('status'),
                    'expires_after'         => $response->getProperty('expires-after'),
                    'last_seen'             => $response->getProperty('last-seen'),
                    'active_address'        => $response->getProperty('active-address'),
                    'active_mac_address'    => $response->getProperty('active-mac-address'),
                    'active_server'         => $response->getProperty('active-server'),
                    'host_name'             => $response->getProperty('host-name'),
                    'radius'                => $response->getProperty('radius'),
                    'dynamic'               => $response->getProperty('dynamic'),
                    'blocked'               => $response->getProperty('blocked'),
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

    public function ip_pool()
    {
        $responses = $this->client->sendSync(new RouterOS\Request('/ip/pool/print'));
        foreach ($responses as $response) {
            if ($response->getType() === RouterOS\Response::TYPE_DATA) {
                $data[] = [
                    'id'        => $response->getProperty('.id'),
                    'name'      => $response->getProperty('name'),
                    'ranges'    => $response->getProperty('ranges'),
                    'next_pool' => $response->getProperty('next-pool')
                ];
            }
        }
        if (isset($data)) {
            return $data;
        } else {
            return NULL;
        }
    }

    public function reboot()
    {
        return $this->client->sendSync(new RouterOS\Request('/system/reboot'));
    }

    public function shutdown()
    {
        return $this->client->sendSync(new RouterOS\Request('/system/shutdown'));
    }
}
