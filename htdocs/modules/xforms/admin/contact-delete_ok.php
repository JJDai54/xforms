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
    $uFormHandler = $helper::getInstance()->getHandler('UserForm');
//      $criteria = new \CriteriaCompo();
//      $criteria->add(new \Criteria('uform_id', $uformId , '='));
//     $uData  = $uDataHandler->getall($criteria);

    $uForm  = $uFormHandler->get($uformId);
echo "uformId = {$uForm->getVar('uform_id')}<br>";

    $uFormHandler->delete($uForm);

    redirect_header($_SERVER['SCRIPT_NAME'], Constants::REDIRECT_DELAY_MEDIUM, _AM_XFORMS_UFORM_DELETE_OK);
}

exit ('delete_ok');
?>