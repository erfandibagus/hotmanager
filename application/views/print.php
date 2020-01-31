<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Print</title>
</head>

<body>
    <?php if (isset($prints) && isset($data)) {
        foreach ($prints as $print) { ?>
            <div style="float:left;">
                <table cellpadding="0" cellspacing="0" border="1" class="voucher" style=" width: 200px; margin:10px;">
                    <tbody>
                        <tr>
                            <td style="text-align: center; font-size: 20px; font-weight:bold; padding:5px;"><?= $data['hotspot']; ?></td>
                        </tr>
                        <tr>
                            <td style="text-align: center; font-size: 11px; padding:5px;">Package: <strong><?= ucwords($print['profile']); ?></strong></td>
                        </tr>
                        <tr>
                            <td>
                                <table align="center" style=" text-align: center; width: 170px; font-size: 12px;">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <table align="center" style="width:100%;">
                                                    <tbody>
                                                        <tr>
                                                            <td style="width: 50%">Username</td>
                                                            <td>Password</td>
                                                        </tr>
                                                        <tr style="font-size: 14px;">
                                                            <td style="border: 1px solid black; font-weight:bold; padding:3px;"><?= $print['name']; ?></td>
                                                            <td style="border: 1px solid black; font-weight:bold; padding:3px;"><?= $print['password']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2" style="border-top: 1px font-size:16px; padding-top:10px;">Time Limit: <strong><?php
                                                            if ($print['limit_uptime']) {
                                                                echo $this->utils->formatLimit($print['limit_uptime']). ' Hour'; 
                                                            } else {
                                                                echo 'Unlimited';
                                                            }
                                                             ?></strong></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2" style="font-size:12px; padding-top:5px; padding-bottom:5px;">Login: <strong>http://<?= $data['dnsname']; ?></strong></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        <?php }
    } ?>
</body>

</html>