<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_model extends CI_Model
{
    public function check()
    {
        $file = FCPATH . ('assets/data/hotspot.txt');
        if (file_exists($file)) {
            return true;
        } else {
            return false;
        }
    }

    public function create()
    {
        $file = 'assets/data/hotspot.txt';
        $fp = fopen($file, 'w') or die('Cannot open file:  ' . $file);
        if ($fp) {
            return true;
        } else {
            return false;
        }
        fclose($fp);
    }

    public function write()
    {
        $data = $this->input->post('hotspot') . '|' . $this->input->post('dnsname');
        $file = FCPATH . ('assets/data/hotspot.txt');
        $fp = fopen($file, 'w') or die('Cannot open file:  ' . $file);
        $exec = fwrite($fp, $data);
        if ($exec) {
            return true;
        } else {
            return false;
        }
        fclose($fp);
    }

    public function read()
    {
        if ($this->check() == true) {
            $file = FCPATH . ('assets/data/hotspot.txt');
            $fp = fopen($file, 'r');
            $data = fread($fp, filesize($file));
            $explode = explode('|', $data);
            $result = [
                'hotspot' => $explode[0],
                'dnsname' => $explode[1]
            ];
            return $result;
            fclose($fp);
        } else {
            return false;
        }
    }

    public function update()
    {
        $file = FCPATH . ('assets/data/hotspot.txt');
        if ($this->check() == true) {
            if ($this->delete() == true) {
                if ($this->create() == true) {
                    $data = $this->input->post('hotspot') . '|' . $this->input->post('dnsname');
                    $file = FCPATH . ('assets/data/hotspot.txt');
                    $fp = fopen($file, 'w') or die('Cannot open file:  ' . $file);
                    fwrite($fp, $data);
                    fclose($fp);
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function delete()
    {
        $file = FCPATH . ('assets/data/hotspot.txt');
        $result = unlink($file);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}
