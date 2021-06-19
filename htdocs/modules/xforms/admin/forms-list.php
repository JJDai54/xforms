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
// //echo __DIR__ ."<br>";
// require_once  '../include/functions.php';
// require_once  'status.php';

$templateMain = 'admin/xforms_forms-list.tpl';
$GLOBALS['xoopsOption']['template_main'] =  $templateMain;   

$myts = \MyTextSanitizer::getInstance();

        xoops_cp_header();
        /* @var \Xmf\Module\Admin $adminObject */
        $adminObject->displayNavigation(basename(__FILE__));
        $adminObject->addItemButton(_AM_XFORMS_NEW, basename(__FILE__) . '?op=edit', 'add');
        $adminObject->displayButton('left');
$helper = \XoopsModules\Xforms\Helper::getInstance();
//global $helper;
        /* @var \XoopsModules\Xforms\Helper $helper */
        $perpage = (int)$helper->getConfig('perpage'); // Get # of forms to show per page

// echo "<hr>perpage = {$perpage}<hr>";
// echo "<hr>uploaddir = " . $helper->getConfig('uploaddir') . "<hr>";

        // Group all the page items together
        $xformsDisplay = new \stdClass;
        $xformsDisplay->start   = Request::getInt('start', 0);
        $xformsDisplay->perpage = ($perpage > 0) ? $perpage: Constants::FORMS_PER_PAGE_DEFAULT;
        $xformsDisplay->order   = 'ASC';
        $xformsDisplay->sort    = 'form_order';

        Xforms\load_css();

        $totalList    = 0;
         /* @var \XoopsModules\Xforms\FormsHandler $formsHandler */
//$showAll = true; //JJDai

//============================================================
        $criteria = Xforms\getCritereStatus($selectStatus);
        $ttlFormCount = $formsHandler->getCount($criteria); // count of all forms
//============================================================
        // Get the forms we're interested in
        //$criteria = ($showAll) ? new \Criteria(1, 1) : new \Criteria('form_active', Constants::FORM_INACTIVE, '<>');
        $criteria->setStart($xformsDisplay->start);
        $criteria->setLimit($xformsDisplay->perpage);
        $criteria->setSort($xformsDisplay->sort);
        $criteria->order = $xformsDisplay->order;
        $forms = $formsHandler->getAll($criteria, null, true, false);

// global $xoopsDB;
// $tr = $xoopsDB->fetchArray($forms);
// echo "<pre>" . print_r($forms, true) . "</pre>";


        if (!empty($forms)) {
            // get the UserData to see if there's any reports
            $criteria = new \CriteriaCompo();
            $criteria->setGroupBy('form_id');
            $uDataHandler  = $helper->getHandler('UserData');
            $rptCountArray = 10;//$uDataHandler->getCount($criteria);
            $groupHandler  = xoops_getHandler('group');

            
            $data = array();
            $ligne= '';
            
            foreach ($forms as $f) {
                $item = array();
                $ligne  = ($ligne == "odd") ? 'even': 'odd';
                $item['ligne'] = $ligne;
                
/*
                echo "===>id = " . $f->getVar('form_id')
                   . " | active = "  . $f->getVar('form_active')
                   . " | titre = " . $f->getVar('form_title') . "</br>";
*/

                /* @var \XoopsModules\Xforms\Forms $f */

                    $id = (int)$f->getVar('form_id');
                    $ids = new \XoopsFormHidden('ids[]', $id);
                    
                    $item['id'] = (int)$f->getVar('form_id');
                    $item['title'] = '<a href="' . $helper->url('index.php?form_id=' . $id) 
                                   . '" title="' . _AM_XFORMS_ACTION_VIEWFORM . '">' 
                                   . $f->getVar('form_title', 's') . '</a><br>'
                                   . '      ' . Xforms\getHtml($f->getVar('form_desc', 's'));
                
 
                    $order = new FormInput('', 'order[' . $id . ']', 5, 5, $f->getVar('form_order'), null, 'number');
                    $order->setAttribute('min', 0);
                    $order->setExtra('style="width: 5em;text-align: right;"');
                    $item['order'] = $order->render();
                    
                    
                    $sendTo = (int)$f->getVar('form_send_to_group');
                    switch ($sendTo) {
                        case Constants::SEND_TO_OTHER:
                            $sendToTxt = '<b>' . _AM_XFORMS_SENDTO_OTHER . ': </b>' . $f->getVar('form_send_to_other');
                            break;
                        case Constants::SEND_TO_NONE:
                            $sendToTxt = _AM_XFORMS_SENDTO_ADMIN;
                            break;
                        default:
                            $sendToTxt = _AM_XFORMS_SENDTO_ADMIN;
                            if ($group = $groupHandler->get($sendTo)) {
                                $sendToTxt = $group->getVar('name');
                            }
                            break;
                    }
                    $item['sendToTxt'] = $sendToTxt;
                    
                    if ($f->getAnswer() == 1) {
                        $fAnswer = '<img src="' . $mypathIcon16 . '/active.gif" title="' . _AM_XFORMS_ANSWER_YES
                                 . '" alt="' . _AM_XFORMS_ANSWER_YES . '">';
                    }else{
                        $fAnswer = '<img src="' . $mypathIcon16 . '/inactive.gif" title="' . _AM_XFORMS_ANSWER_NO
                                 . '" alt="' . _AM_XFORMS_ANSWER_NO . '">';
                    }
                    $item['fAnswer'] = $fAnswer;
                    
                    $item['color_set'] = $f->getVar('form_color_set'); 
                //----------------------------------------------------------------------

                    if (!$f->isActive()) {
                    
                    
                    
                    
                    
                    
                        // Form is either inactive or expired
                        if (Constants::FORM_INACTIVE === (int)$f->getVar('form_active')) {
                            // Form is inactive
                            $setStatus = ' <a href="' . $_SERVER['SCRIPT_NAME'] . '?op=change-status&form_id=' . $id . '&newStatus=1&selectStatus=' .$selectStatus. '">'
                                       . '<img src="' . $mypathIcon16 . '/inactive.gif" class="tooltip floatcenter1" title="'
                                       . _AM_XFORMS_ACTION_ACTIVE . '" alt="' . _AM_XFORMS_ACTION_ACTIVE . '"></a>';
                        } else {
                            // Form has expired
                            $setStatus =  '<img src="' . $mypathIcon16 . '/blanck.gif" class="tooltip floatcenter1" title="'
                                       . '' . '" alt="' . _AM_XFORMS_ACTION_ACTIVE . '">';
                        }
                    } else {
                        // Form is active
                        $setStatus = '<a href="' . $_SERVER['SCRIPT_NAME'] . '?op=change-status&form_id=' . $id . '&newStatus=0&selectStatus=' .$selectStatus. '">'
                                   . '<img src="' . $mypathIcon16 . '/active.gif" class="tooltip floatcenter1" title="'
                                   . _AM_XFORMS_ACTION_INACTIVE . '" alt="' . _AM_XFORMS_ACTION_INACTIVE . '"></a>';
                    }
                    
                    $item['setStatus'] = $setStatus;
                    
                    
/*

                    
                        // Form is either inactive or expired
                        if (Constants::FORM_INACTIVE === (int)$f->getVar('form_active')) {
                            // Form is inactive
                            $fStatus = '<img src="' . $mypathIcon16 . '/inactive.gif" title="' . _AM_XFORMS_STATUS_INACTIVE
                                     . '" alt="' . _AM_XFORMS_STATUS_INACTIVE . '">';
                            $fAction = ' <a href="' . $_SERVER['SCRIPT_NAME'] . '?op=active&form_id=' . $id . '">'
                                     . '<img src="' . $mypathIcon16 . '/active.gif" class="tooltip floatcenter1" title="'
                                     . _AM_XFORMS_ACTION_ACTIVE . '" alt="' . _AM_XFORMS_ACTION_ACTIVE . '"></a>';
                        } else {
                            // Form has expired
                            $fStatus = '<img src="' . $mypathIcon16 . '/expired.gif" title="' . _AM_XFORMS_STATUS_EXPIRED
                                     . '" alt="' . _AM_XFORMS_STATUS_EXPIRED . '">';
                            $fAction =  '<img src="' . $mypathIcon16 . '/blanck.gif" class="tooltip floatcenter1" title="'
                                     . '' . '" alt="' . _AM_XFORMS_ACTION_ACTIVE . '">';
                        }
                    } else {
                        // Form is active
                        $fStatus = '<img src="' . $mypathIcon16 . '/active.gif" title="' . _AM_XFORMS_STATUS_ACTIVE
                                 . '" alt="' . _AM_XFORMS_STATUS_ACTIVE . '">';
                        $fAction = '<a href="' . $_SERVER['SCRIPT_NAME'] . '?op=inactive&form_id=' . $id . '">'
                                 . '<img src="' . $mypathIcon16 . '/inactive.gif" class="tooltip floatcenter1" title="'
                                 . _AM_XFORMS_ACTION_INACTIVE . '" alt="' . _AM_XFORMS_ACTION_INACTIVE . '"></a>';
                    }
*/                    

                    $item['fStatus'] = $fStatus; 
                    $item['fAction'] = $fAction; 
                    //-----------------------------------------------------------------------------
                    $item['edit'] = '<a href="' . $_SERVER['SCRIPT_NAME'] . '?op=edit&form_id=' . $id . '"><img src="' 
                                  . \Xmf\Module\Admin::iconUrl('edit.png', '16') . '" class="tooltip floatcenter1" title="' . _AM_XFORMS_ACTION_EDITFORM . '" alt="'
                                  .  _AM_XFORMS_ACTION_EDITFORM . '"></a>'; 
                    
                    $item['elements'] = '<a href="elements.php?form_id=' . $id . '"><img src="' . \Xmf\Module\Admin::iconUrl('inserttable.png', '16') . '" class="tooltip floatcenter1" title="' . _AM_XFORMS_ACTION_EDITELEMENT . '" alt="'
                                       . _AM_XFORMS_ACTION_EDITELEMENT . '"></a>';
                    
                    $item['clone'] = '<a href="' . $_SERVER['SCRIPT_NAME'] . '?op=edit&clone=1&form_id=' . $id . '"><img src="' . \Xmf\Module\Admin::iconUrl('editcopy.png', '16') . '" class="tooltip floatcenter1" title="' . _AM_XFORMS_ACTION_CLONE . '" alt="'
                                   . _AM_XFORMS_ACTION_CLONE . '"></a>';
                    
                    $item['delete'] = '<a href="' . $_SERVER['SCRIPT_NAME'] . '?op=delete&form_id=' . $id . '"><img src="' . \Xmf\Module\Admin::iconUrl('delete.png', '16') . '" class="tooltip floatcenter1" title="' . _DELETE . '" alt="' . _DELETE . '"></a>';
                    
                    $item['ids'] = $ids->render();
                    
                    $item['view'] = '<a target="_blank" href="' . $helper->url('index.php?form_id=' . $id) . '"><img src="' . \Xmf\Module\Admin::iconUrl('view.png', '16') . '" class="tooltip floatcenter1" title="' . _AM_XFORMS_ACTION_VIEWFORM . '" alt="'
                                  .  _AM_XFORMS_ACTION_VIEWFORM . '"></a>';
                    //-----------------------------------------------------------------------------

                    if (Constants::SAVE_IN_DB === (int)$f->getVar('form_save_db') && isset($rptCountArray[$id])) {
                        $item['report'] =  '<a href="report.php?op=show&form_id=' . $id . '"><img src="' . $mypathIcon16 . '/content.png" class="tooltip floatcenter1" title="' . _AM_XFORMS_ACTION_REPORT . '" alt="'
                                        .  _AM_XFORMS_ACTION_REPORT . '"></a>';
                    }else{
                        $item['report'] = '<img src="' . $mypathIcon16 . '/blanck.gif" class="tooltip floatcenter1" title="' . '' . '" alt="'
                                        . '' . '"></a>';
                    }
                    $data['allForms'][] = $item;
                    ++$totalList;

            }
            
            if ($totalList > 0) {
                $submit = new \XoopsFormButton('', 'saveorder', _AM_XFORMS_RESET_ORDER, 'submit');
                $data['saveorder'] = $submit->render() . $GLOBALS['xoopsSecurity']->getTokenHTML();
                $data['selectStatus'] = $selectStatus;
                

                if ($ttlFormCount > $xformsDisplay->perpage) {
                    xoops_load('pagenav');
                    $xformsPagenav = new \XoopsPageNav($ttlFormCount, $xformsDisplay->perpage, $xformsDisplay->start, 'start', 'perpage=' . $xformsDisplay->perpage);
                    $data['pagenav'] = '<div class="center middle larger width100 line160">' . $xformsPagenav->renderNav() . '</div>';
                }

            }
        }

if (0 === $totalList) {
    $data['noForms'] = '<a href="' . basename(__FILE__) . '?op=edit" target="_self">' . _AM_XFORMS_NO_FORMS . '</a>';
}else $data['noForms'] = ''; 
$data['selectOnStatus'] = Xforms\getBtnStatus('forms', $data['noForms']);
$data['url'] = "forms.php"; //basename(__FILE__);

//echo "<hr><pre>" . print_r($data, true) . "</pre><hr>";
        /*Show message no forms*/
       

/*
*/


     $GLOBALS['xoopsTpl']->assign('data', $data);















include __DIR__ . '/admin_footer.php';
xoops_cp_footer();
