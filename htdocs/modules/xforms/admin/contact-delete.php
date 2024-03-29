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

//echo "<hr>{$uformId}<hr>";
    //$uFormHandler = $helper->getHandler('UserForm');
    $uform = $uFormHandler->get($uformId);
    $objet = $uform->getVar('uform_objet');
    //------------------------------------

    //$uDataHandler = $helper::getInstance()->getHandler('UserData');
    $criteria = new \CriteriaCompo();
    $criteria->add(new \Criteria('uform_id', $uformId , '='));
    $criteria->setOrder('udata_id');
    $uData  = $uDataHandler->getAll($criteria,null,false,true);
    //------------------------------------
        //$xformsEleHandler = $helper->getHandler('Element');
        $criteria = new \CriteriaCompo();
        $criteria->add(new \Criteria('form_id', $formId , '='));
        $elements = $xformsEleHandler->getAll($criteria,"ele_id,ele_caption,ele_type",false,true);
    //------------------------------------
    $tMsg = array();
    $tMsg[] =  sprintf(_AM_XFORMS_CONFIRM_DELETE_MSG, $uformId);
        foreach ($uData as $id=>$item){
          $ele = $elements[$item['ele_id']];
          $data = $item['udata_value'];

          switch ($elements[$item['ele_id']]['ele_type']){
          case 'text':
              switch($ele['ele_value'][3]){
                case 1: $tMsg[] = "userEmail : " . $data[0]; break;
                case 2: $tMsg[] = "userName : "  . $data[0]; break;
                case 3: $tMsg[] = "objet : "     . $data[0]; break;
              }
            break;
          case 'chrono':
                case 3: $tMsg[] = "chrono : "     . $data[0]; break;
            break;
          }

//           if (($elements[$item['ele_id']]['ele_type']) == 'text'){
//               switch($ele['ele_value'][3]){
//                 case 1: $tMsg[] = "userEmail : " . $data[0]; break;
//                 case 2: $tMsg[] = "userName : "  . $data[0]; break;
//                 case 3: $tMsg[] = "objet : "     . $data[0]; break;
//               }
//           }
        }



//=============================================================




    $msg =  implode('<br>', $tMsg);
    //xoops_confirm(array('op' => 'delete_ok', 'uform_id' => $uformId, 'ok' => 1), $_SERVER['SCRIPT_NAME'],$msg);
    xoops_confirm(array('op' => 'delete_ok', 'uform_id' => $uformId, 'ok' => 1), 'contact.php', $msg);


  } else {
    redirect_header($_SERVER['SCRIPT_NAME'], Constants::REDIRECT_DELAY_MEDIUM, _AM_XFORMS_FORM_NOTEXISTS);
  }





?>