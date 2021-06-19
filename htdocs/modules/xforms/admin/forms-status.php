<?php
/*
 You may not change or alter any portion of this comment or credits of
 supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit
 authors.

 This program is distributed in the hope that it will be useful, but
 WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */
/**
 * Module: xForms
 * Main administration page
 *
 * @package   \XoopsModules\Xforms\admin
 * @author    XOOPS Module Development Team
 * @copyright Copyright (c) 2001-2019 {@link https://xoops.org XOOPS Project}
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 * @since     1.30
 */
use Xmf\Request;
use XoopsModules\Xforms;
use XoopsModules\Xforms\Constants;
use XoopsModules\Xforms\FormInput;

require_once __DIR__ . '/admin_header.php';
//echo __DIR__ ."<br>";
require_once  '../include/functions.php';
require_once  'status.php';


$p['newStatus'] = Request::getInt('newStatus', 0);
$p['formId'] = Request::getInt('form_id', 0);
$p['selectStatus'] = Request::getInt('selectStatus', 0);

//echo "<hr><pre>" . print_r($p, true) . "</pre><hr>";
//exit;
  if (!empty($p['formId']) && ($formObj = $formsHandler->get($p['formId'])) && !$formObj->isNew()) {
      if ($p['newStatus'] == 1){
        $ok = $formsHandler->setActive($formObj);
      }else{
        $ok = $formsHandler->setInactive($formObj);
      }
      
      if($ok){
          redirect_header("forms.php?ok=list&selectStatus={$p['selectStatus']}", Constants::REDIRECT_DELAY_NONE, _AM_XFORMS_DBUPDATED);
          //redirect_header($_SERVER['SCRIPT_NAME'] . "?status={$status}", Constants::REDIRECT_DELAY_NONE, _AM_XFORMS_DBUPDATED);
      }else{
          redirect_header($_SERVER['SCRIPT_NAME'], Constants::REDIRECT_DELAY_NONE, _AM_XFORMS_NOTHING_SELECTED);
      }
  
  }


      xoops_cp_header();
      echo $formObj->getHtmlErrors();

include __DIR__ . '/admin_footer.php';
xoops_cp_footer();
