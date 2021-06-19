<?php

namespace XoopsModules\Xforms;

use Xmf\Request;
use XoopsModules\Xforms;
use XoopsModules\Xforms\Constants;
use XoopsModules\Xforms\FormInput;

/*******************************************************
 *
 *******************************************************/
function getCritereStatus($status){
        //modif des critere de recheched sur le status, voir plus au "status"
        switch($status){
          case constants::FORM_ACTIVE:

          $tc = array();

          $criteria = new \CriteriaCompo();
          $criteria->add (new \Criteria('form_active', Constants::FORM_ACTIVE, '='));
          $criteria->add (new \Criteria('form_begin', 0 , '='), 'AND');
          $criteria->add (new \Criteria('form_end', 0 , '='), 'AND');
          $tc[] = $criteria;

          $criteria = new \CriteriaCompo();
          $criteria->add (new \Criteria('form_active', Constants::FORM_ACTIVE, '='));
          $criteria->add (new \Criteria('form_begin', 0, '='));
          $criteria->add (new \Criteria('form_end', time(), '<>'));
          $criteria->add (new \Criteria('form_end', time(), '>'));
          $tc[] = $criteria;

          $criteria = new \CriteriaCompo();
           $criteria->add (new \Criteria('form_active', Constants::FORM_ACTIVE, '='));
         $criteria->add (new \Criteria('form_end', 0, '='));
          $criteria->add (new \Criteria('form_begin', time(), '<>'));
          $criteria->add (new \Criteria('form_begin', time(), '<'));
          $tc[] = $criteria;


          $criteria = new \CriteriaCompo();
          $criteria->add (new \Criteria('form_active', Constants::FORM_ACTIVE, '='));
          $criteria->add (new \Criteria('form_begin', 0, '<>'));
          $criteria->add (new \Criteria('form_begin', time(), '<'));
          $criteria->add (new \Criteria('form_end', 0, '<>'));
          $criteria->add (new \Criteria('form_end', time(), '>'));
          $tc[] = $criteria;

          $criteria = new \CriteriaCompo();
          $criteria->add (new \Criteria('form_active', Constants::FORM_ACTIVE, '='));
          $criteria->add ($tc[0]);
          $criteria->add ($tc[1], 'OR');
          $criteria->add ($tc[2], 'OR');
          $criteria->add ($tc[3], 'OR');

          break;

          case constants::FORM_INACTIVE:
            $criteria = new \Criteria('form_active', Constants::FORM_INACTIVE, '=');
          break;

          case constants::FORM_EXPIRED:
          $criteria = new \CriteriaCompo();
          $criteria->add (new \Criteria('form_end', mktime() , '<'));
          $criteria->add (new \Criteria('form_end', 0 , '>'));
          break;

          case constants::FORM_UPCOMMING:
          $criteria = new \Criteria('form_begin', mktime() , '>');
          break;

          default:
          case constants::FORM_ALL:
          $criteria = new \Criteria(1, 1);
          break;
        }

  return $criteria;
}

/*******************************************************
 *
 *******************************************************/
function getBtnStatus($to, $msg = ''){
global $mypathIcon16;
    $url = $to . ".php?op=list&selectStatus=";
    $btn =  '<fieldset><legend class="bold" style="color: #900;">' . _AM_XFORMS_STATUS_INFORMATION . '</legend>'
       . '<div class="pad7">'
       . '  <div class="center">'
       . "<a href='{$url}" . Constants::FORM_ALL . "'>"
       . '    <img src="' . $mypathIcon16 . '/all.gif" style="margin-right: .5em;"><span style="padding-right: 3em;">' . _AM_XFORMS_STATUS_ALL . '</span>'
       . "</a>"
       . "<a href='{$url}" . Constants::FORM_ACTIVE . "'>"
       . '    <img src="' . $mypathIcon16 . '/active.gif" style="margin-right: .5em;"><span style="padding-right: 3em;">' . _AM_XFORMS_STATUS_ACTIVE . '</span>'
       . "</a>"
       . "<a href='{$url}" . Constants::FORM_INACTIVE . "'>"
       . '    <img src="' . $mypathIcon16 . '/inactive.gif" style="margin-right: .5em;"><span style="padding-right: 3em;">' . _AM_XFORMS_STATUS_INACTIVE . '</span>'
       . "</a>"
       . "<a href='{$url}" . Constants::FORM_UPCOMMING . "'>"
       . '    <img src="' . $mypathIcon16 . '/upcomming.gif" style="margin-right: .5em;">' . _AM_XFORMS_STATUS_UPCOMMING
       . "</a>"
       . "<a href='{$url}" . Constants::FORM_EXPIRED . "'>"
       . '    <img src="' . $mypathIcon16 . '/expired.gif" style="margin-right: .5em;">' . _AM_XFORMS_STATUS_EXPIRED
       . "</a>"
       . '  </div>'
       . (($msg != '') ? "<br><center>{$msg}</center>" : '')
       . '</div>'
       . '</fieldset>';

    return $btn;
}

?>