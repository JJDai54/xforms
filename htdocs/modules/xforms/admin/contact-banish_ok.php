<?php
/** @var Extcal\Helper $helper */
//$helper = Xforms\Helper::getInstance();
use XoopsModules\Xforms;
use XoopsModules\Xforms\Constants;
use XoopsModules\Xforms\Helper as xHelper;
//use Xmf\Module\Helper\Session;

require dirname(__DIR__) . '/preloads/autoloader.php';
include_once "admin_header.php";
//$helper = xHelper::getInstance();

echo "===>POST<pre>" . print_r($_POST, true) . "</pre>";
echo "===>GET<pre>" . print_r($_GET, true) . "</pre>";
echo "uformId = {$uformId}<br>";

if ($ok == 1){
    $banishHandler = $helper::getInstance()->getHandler('banish');
    
    if ($action == 'banish'){
        $banishHandler->add_banish($email);
        $msg = sprintf(_AM_XFORMS_UFORM_BANISH_OK, $email);
    }else{
        $banishHandler->remove_banish($email);
        $msg = sprintf(_AM_XFORMS_UFORM_UNBANISH_OK, $email);
    }

    redirect_header($_SERVER['SCRIPT_NAME'], Constants::REDIRECT_DELAY_MEDIUM, $msg);
}

exit ('banish_ok');
?>