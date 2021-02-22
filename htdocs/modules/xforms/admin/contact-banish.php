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

  if (!empty($uformId)) {
      xoops_cp_header();

    //------------------------------------
    $tMsg = array();
    $msg = ($action == 'banish') ? _AM_XFORMS_CONFIRM_BANISH_MSG : _AM_XFORMS_CONFIRM_UNBANISH_MSG;
    $tMsg[] = sprintf($msg, $email);

//=============================================================

    $msg =  implode('<br>', $tMsg);
    //xoops_confirm(array('op' => 'delete_ok', 'uform_id' => $uformId, 'ok' => 1), $_SERVER['SCRIPT_NAME'],$msg);
    $params = array('op' => 'banish_ok', 
                    'uform_id' => $uformId, 
                    'email' => $email,
                    'action' => $action,
                    'ok' => 1);
    xoops_confirm($params, 'contact.php', $msg);


  } else {
    redirect_header($_SERVER['SCRIPT_NAME'], Constants::REDIRECT_DELAY_MEDIUM, _AM_XFORMS_FORM_NOTEXISTS);
  }





?>