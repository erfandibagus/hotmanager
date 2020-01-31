<?php

/**
 * Stub for PEAR2_Net_Transmitter.
 * 
 * PHP version 5.3
 * 
 * @category  Net
 * @package   PEAR2_Net_Transmitter
 * @author    Vasil Rangelov <boen.robot@gmail.com>
 * @copyright 2011 Vasil Rangelov
 * @license   http://www.gnu.org/copyleft/lesser.html LGPL License 2.1
 * @version   GIT: $Id$
 * @link      http://pear2.php.net/PEAR2_Net_Transmitter
 */

if (count(get_included_files()) > 1) {
    Phar::mapPhar();
    include_once 'phar://' . __FILE__ . DIRECTORY_SEPARATOR .
        '@PACKAGE_NAME@-@PACKAGE_VERSION@' . DIRECTORY_SEPARATOR . 'src'
        . DIRECTORY_SEPARATOR . 'PEAR2' . DIRECTORY_SEPARATOR . 'Autoload.php';
} else {
    $isNotCli = PHP_SAPI !== 'cli';
    if ($isNotCli) {
        header('Content-Type: text/plain;charset=UTF-8');
    }
    echo "@PACKAGE_NAME@ @PACKAGE_VERSION@\n";
    
    if (version_compare(phpversion(), '5.3.0', '<')) {
        echo "\nThis package requires PHP 5.3.0 or later.";
        exit(1);
    }

    if (extension_loaded('phar')) {
        try {
            $phar = new Phar(__FILE__);
            $sig = $phar->getSignature();
            echo "{$sig['hash_type']} hash: {$sig['hash']}\n";
        } catch(Exception $e) {
            echo <<<HEREDOC
The PHAR extension is available, but was unable to read this PHAR file's hash.
Regardless, you should not be having any trouble using the package by directly
including the archive.

Exception details:
HEREDOC
                . $e . "\n";
        }
    } else {
        echo <<<HEREDOC
If you wish to use this package directly from this archive, you need to install
and enable the PHAR extension. Otherwise, you must instead extract this archive,
and include the autoloader.


HEREDOC;
    }

    echo "\n" . str_repeat('=', 80) . "\n";
    if (extension_loaded('openssl')) {
        echo <<<HEREDOC
The OpenSSL extension is loaded. If you can make any connection whatsoever, you
could also make an encrypted one.

Note that due to known issues with PHP itself, encrypted connections may be
unstable (as in "sometimes disconnect suddenly" or "sometimes hang when calling
TcpClient::isDataAwaiting() without a timeout").

HEREDOC;
    } else {
        echo <<<HEREDOC
WARNING: The OpenSSL extension is not loaded.
         You can't make encrypted connections without it.

HEREDOC;
    }

    echo "\n" . str_repeat('=', 80) . "\n";
    if (function_exists('stream_socket_client')) {
        echo <<<HEREDOC
The stream_socket_client() function is enabled.
If you can't connect to a host, this means one of the following:

1. You've mistyped the IP and/or port.
   Check the IP and port you've specified are the ones you intended.

2. The host is not reachable from your web server.
   Try to reach the host (!!!)from the web server(!!!) by other means
   (e.g. ping) using the same IP, and if you're unable to reach it,
   check the network settings on your web server, the remote host
   (if it's under your control) as well as any intermidiate nodes under your
   control that may affect the connection (e.g. routers, etc.).

3. Your web server is configured to forbid that outgoing connection.
   If you're the web server administrator, check your firewall's settings.
   If you're on a hosting plan... Typically, shared hosts block all
   outgoing connections, but it's also possible that only connections
   to that port are blocked. If the remote host is under your control,
   try to connect to it on a popular port (21, 80, 443, etc.),
   and if successful, keep using that port instead. If the connection fails
   even then, or if the remote host is not under your control, ask your host to
   configure their firewall so as to allow you to make outgoing connections
   to the ip:port you need to connect to.

HEREDOC;
    } else {
        echo <<<HEREDOC
WARNING: stream_socket_client() is disabled.
         Without it, you won't be able to connect to any host.
         Enable it in php.ini, or ask your host to enable it for you.

HEREDOC;
    }
}

__HALT_COMPILER();