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
/*
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
// require_once  'status.php';
// 
// $myts = \MyTextSanitizer::getInstance();
$templateMain = 'admin/xforms_banish-list.tpl';
$GLOBALS['xoopsOption']['template_main'] =  $templateMain;   

$op        = Request::getCmd('op', 'list', 'REQUEST');

//echo "===>status={$status}<br>";
// echo "GET :<pre>" . print_r($_GET, true) . "</pre>";
// echo "GET :<pre>" . print_r($_POST, true) . "</pre>";

//======================================================================
$banishHandler = $helper::getInstance()->getHandler('banish');
$banish_id = Request::getInt('banish_id', 0, 'REQUEST');
// echo "===> op = {$op}<br>banish_id = {$banish_id}<br>";        
// exit;
        xoops_cp_header();
        
    switch($op){
    case "delete":
        $banish = $banishHandler->get($banish_id);
    
    
        $msg =  sprintf(_AM_XFORMS_BANISH_CONFIRM_DELETE, $banish->getVar('banish_email'), $banish->getVar('banish_id'));
        $params = array('op'=>'delete_ok', 'banish_id'=>$banish_id);
        //xoops_confirm(array('op' => 'delete_ok', 'uform_id' => $uformId, 'ok' => 1), $_SERVER['SCRIPT_NAME'],$msg);
        xoops_confirm($params, 'banish.php', $msg);
        break;
        
    case "delete_ok":
        $banish = $banishHandler->get($banish_id);
        echo "===> banish = {$banish->getVar('banish_id')}<br>===> email = {$banish->getVar('banish_email')}<br>";
        $banishHandler->delete($banish, true);
        redirect_header($_SERVER['SCRIPT_NAME'], Constants::REDIRECT_DELAY_MEDIUM, _AM_XFORMS_UFORM_DELETE_OK);
        break;
        
    case "delete_all":
        $msg =  _AM_XFORMS_BANISH_CONFIRM_DELETE_ALL;
        $params = array('op'=>'delete_all_ok');
        xoops_confirm($params, 'banish.php', $msg);
        break;
        
    case "delete_all_ok":
        $banish = $banishHandler->deleteAll();
        redirect_header($_SERVER['SCRIPT_NAME'], Constants::REDIRECT_DELAY_MEDIUM, _AM_XFORMS_BANISH_DELETE_ALL_SUCCESS);
        break;
        
    default:
        
        /* @var \Xmf\Module\Admin $adminObject */
        $adminObject->displayNavigation(basename(__FILE__));
        $adminObject->addItemButton(_AM_XFORMS_INIT_BANISH, basename(__FILE__) . '?op=delete_all', 'synchronized');
        $adminObject->displayButton('left');
        $tHtml = array();
//======================================================================
      //------------------------------------------------------------------------------
      $class = "";  
      //$rstBanish = $banishHandler->getAll($criteria=null, "banish_email", false, true);
      //$banishHandler = $helper::getInstance()->getHandler('banish');
      $criteria = new \CriteriaCompo();
      $criteria->add(new Criteria('banish_id',0,'>'));
      $criteria->setSort('banish_email');
      $criteria->setOrder('ASC');
      
      $rstBanish = $banishHandler->getAll($criteria);
      //echo "<pre>" . print_r($rstBanish, true) . "</pre>";  
      $ligne='';
      $allBanish = array();  
      foreach ($rstBanish as $banish_id=>$banish){
          $item = array();
          $ligne  = ($ligne == "odd") ? 'even': 'odd';
          $item['ligne'] = $ligne;
          $item['extra'] = "style='height:10px;'";
          
        
        //--------------------------------
        
      //echo "<pre>" . print_r($item, true) . "</pre>";

          $item['id'] = $banish->getVar('banish_id');
          $item['email'] = $banish->getVar('banish_email');
          $item['attempts'] = $banish->getVar('banish_attempts');
          $item['date_update'] = date("Y-m-d H:i:s", $banish->getVar('banish_update'));
          
          //------ Boutons d'actions --------------------------------------

          $link = "banish.php?op=delete&banish_id={$banish->getVar('banish_id')}";
          $img = \Xmf\Module\Admin::iconUrl('delete.png', '16');
          $title = _AM_XFORMS_ACTION_DELETE;
          $actionDelete= "<a href='{$link}'><img src='{$img}'  title='{$title}' alt='{$title}'></a>";

          $item['delete'] = $actionDelete;
 
          
        //--------------------------------
        $allBanish[] = $item;
          

     }
     $GLOBALS['xoopsTpl']->assign('allBanish', $allBanish);
        //---------------------------------------------------------------

        break;
        
    }        

//======================================================================

include __DIR__ . '/admin_footer.php';
xoops_cp_footer();



