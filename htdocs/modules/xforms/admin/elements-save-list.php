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
 *
 * @package   \XoopsModules\Xforms\admin\elements
 * @author    XOOPS Module Development Team
 * @copyright Copyright (c) 2001-2019 {@link https://xoops.org XOOPS Project}
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 * @since     1.30
 */
use XoopsModules\Xforms;
use XoopsModules\Xforms\Constants;
use XoopsModules\Xforms\Helper as xHelper;
use XoopsModules\Xforms\ElementRenderer;
use XoopsModules\Xforms\FormInput;
use Xmf\Module\Admin;
use Xmf\Request;

require __DIR__ . '/admin_header.php';
require_once '../include/functions.php';

/* @var \XoopsModules\Xforms\Helper $helper */
/* @var \XoopsModules\Xforms\FormsHandler $formsHandler */
/* @var \XoopsModules\Xforms\ElementHandler $xformsEleHandler */
$xformsEleHandler = $helper->getHandler('Element');

/*
*/
echo "_GET<pre>" . print_r($_GET, true) . "</pre>";
echo "<hr>_POST<pre>" . print_r($_POST, true) . "</pre><hr>";
//             exit;
//$eleValue   =  Request::getArray('ele_value'); //$_POST['ele_value'];
$eleValue   =  $_POST['ele_value'];
// echo "<hr>eleValue<pre>" .  print_r($eleValue, true) . "</pre><hr>";
//exit;

        // Check to make sure this is from known location
        if (!$xoopsSecurity->check()) {
            redirect_header($_SERVER['SCRIPT_NAME'], Constants::REDIRECT_DELAY_MEDIUM, implode('<br>', $xoopsSecurity->getErrors()));
        }
        $formId =Request::getInt('form_id', 0, 'POST');
        $formId = (int)$formId;  // to fix Xmf\Request bug in XOOPS < 2.5.9
        if (empty($formId)) {
            $helper->redirect('admin/main.php', Constants::REDIRECT_DELAY_NONE, _AM_XFORMS_NOTHING_SELECTED);
        }

        $error = '';

        $eleId  = Request::getArray('ele_id', array(), 'POST');
        $eleId  = array_map('intval', $eleId);

        $eleReq = Request::getArray('ele_req', array(), 'POST');
        array_walk($eleReq, '\XoopsModules\Xforms\Utility::intArray'); // can't use array_map since must preserve keys

        $eleOrder = Request::getArray('ele_order', array(), 'POST');
        array_walk($eleOrder, '\XoopsModules\Xforms\Utility::intArray'); // can't use array_map since must preserve keys

        $eleDisplay = Request::getArray('ele_display', array(), 'POST');
        array_walk($eleDisplay, '\XoopsModules\Xforms\Utility::intArray'); // can't use array_map since must preserve keys
    echo "<hr><pre>eleDisplay : " . print_r($eleDisplay, true) . "</pre><hr>";

        $eleDisplayRow = Request::getArray('ele_display_row', array(), 'POST');
        array_walk($eleDisplayRow, '\XoopsModules\Xforms\Utility::intArray'); // can't use array_map since must preserve keys

    echo "<hr><pre>eleDisplayRow : " . print_r($eleDisplayRow, true) . "</pre><hr>";
        
        // JJDai - la fonction request sanityse le contenu html, pas une bonne idée
        //$eleValue = Request::getArray('ele_value', array(), 'POST');
        $eleValue = $_POST['ele_value'] ;
//echo "<pre>" . print_r($eleValue, true) . "</pre>";exit;
        foreach ($eleId as $id) {
//echo "===> {$eleId} => {$id}<br>";
            if(!isset($eleValue[$id])) continue;
            echo "{$id} - ";            
            $element    = $xformsEleHandler->get($id);
            $req        = (key_exists($id, $eleReq) && (Constants::ELEMENT_REQD == $eleReq[$id])) ? Constants::ELEMENT_REQD : Constants::ELEMENT_NOT_REQD;
            $order      = (key_exists($id, $eleOrder)) ? $eleOrder[$id] : 0;
            $displayRow = (key_exists($id, $eleDisplayRow) && (Constants::DISPLAY_DOUBLE_ROW == $eleDisplayRow[$id])) ? Constants::DISPLAY_DOUBLE_ROW : Constants::DISPLAY_SINGLE_ROW;
            $display    = (key_exists($id, $eleDisplay) && (Constants::ELEMENT_DISPLAY == $eleDisplay[$id])) ? Constants::ELEMENT_DISPLAY : Constants::ELEMENT_NOT_DISPLAY;
            $type       = $element->getVar('ele_type');
            $value      = $element->getVar('ele_value');
            $element->setVars(array('ele_req' => $req,
                                  'ele_order' => $order,
                            'ele_display_row' => $displayRow,
                                'ele_display' => $display)
            );

            switch ($type) {
                case 'checkbox':
                    $newVars  = array();
                    $optCount = 1;
                    if (isset($eleValue[$id]) && is_array($eleValue[$id])) {
                        foreach ($value as $key=>$j) {
                        //while ($j = each($value)) {
                            $newVars[$key] = in_array($optCount, $eleValue[$id]) ? 1 : 0;
                            ++$optCount;
                        }
                    } else {
                        if (count($value) > 1) {
                            foreach ($value as $key=>$j) {
                            //while ($j = each($value)) {
                                $newVars[$key] = 0;
                            }
                        } else {
                            foreach ($value as $key=>$j) {
                            //while ($j = each($value)) {
                                $newVars = !empty($eleValue[$id]) ? array($key => 1) : array($key => 0);
                            }
                        }
                    }
                    $value = $newVars;
                    break;

                case 'color':
                    $value[0] = $eleValue[$id];
                    break;

                case 'country':
                case 'select2':
                    $value[2] = !empty($eleValue[$id]) ? $eleValue[$id] : 'LB';
                    break;

                case 'date':
                    $value[0] = $eleValue[$id];
                    break;

                case 'email':
                    $value[2] = $eleValue[$id];
                    //echo "===>{$value[0]} = {$eleValue[$id]}";exit;
                    break;

                case 'html':
                //enregistrement dans la liste des éléments du formulaire
                    //$value[0] = $myts->htmlSpecialChars($eleValue[$id]);
                    //echo "<pre>" .  print_r($eleValue[$id], true) .  "</pre>";
                    $value[0] = $eleValue[$id];

                    // removed in v2.00 ALPHA 2 - as of PHP5.4 get_magic_quotes_gpc() always returns FALSE
//                    $value[0] = ($magicQuotes) ? stripslashes($eleValue[$id]) : $eleValue[$id];
                    //$element->setVar('ele_display_row', 0);
                    break;

                case 'number':
                    $value[2] = $eleValue[$id];
                    // removed in v2.00 ALPHA 2 - as of PHP5.4 get_magic_quotes_gpc() always returns FALSE
//                    $value[2] = ($magicQuotes) ? stripslashes($eleValue[$id]) : $eleValue[$id];
                    break;

                case 'chrono':
                    $value[0] = $eleValue[$id];
                    break;

                case 'timestamp':
                    $value[0] = $eleValue[$id];  // "%A %d %B %Y à %Hh:%M"; // $eleValue[$id];
                    break;

                case 'obfuscated':
                    $value[] = $eleValue[$id];
                    break;

                case 'pattern':
                    $value[] = $eleValue[$id];
                    break;

                case 'radio':
                    $newVars = array();
                    $i = 1;
                    foreach ($value as $key=>$j) {
                    //while ($j = each($value)) {
                        if (null !== $j) {
                            $newVars[$key] = ($eleValue[$id] == $i) ? '1' : '0';
                        }
                        ++$i;
                    }
                    $value = $newVars;
                    break;

                case 'select':
                    $newVars = array();
                    $optCount = 1;
                    if (isset($eleValue[$id])) {
                        if (is_array($eleValue[$id])) {
                            foreach ($value[2] as $key=>$j) {
                            //while ($j = each($value[2])) {
                                $newVars[$key] = in_array($optCount, $eleValue[$id]) ? 1 : 0;
                                ++$optCount;
                            }
                        } else {
                            if (count($value[2]) > 1) {
                                foreach ($value[2] as $key=>$j) {
                                //while ($j = each($value[2])) {
                                    $newVars[$key] = ($optCount == $eleValue[$id]) ? 1 : 0;
                                    ++$optCount;
                                }
                            } else {
                                foreach ($value[2] as $key=>$j) {
                                //while ($j = each($value[2])) {
                                    $newVars =!empty($eleValue[$id]) ? array($key => 1) : array($key => 0);
                                }
                            }
                        }
                        $value[2] = $newVars;
                    } else {
                        foreach ($value[2] as $k => $v) {
                            $value[2][$k] = 0;
                        }
                    }
                    break;

                case 'text':
                    $value[2] = $eleValue[$id];
                    // removed in v2.00 ALPHA 2 - as of PHP5.4 get_magic_quotes_gpc() always returns FALSE
//                     $value[2] = ($magicQuotes) ? stripslashes($eleValue[$id]) : $eleValue[$id];
                    break;

                case 'textarea':
                    $value[0] = $eleValue[$id];
                    // removed in v2.00 ALPHA 2 - as of PHP5.4 get_magic_quotes_gpc() always returns FALSE
    //                $value[0] = ($magicQuotes) ? stripslashes($eleValue[$id]) : $eleValue[$id];
                    break;

                case 'time':
                    $value[2] = $eleValue[$id];
                    break;

                case 'upload':
                    $value[0] = (int)$eleValue[$id][0];
                    break;

                case 'uploadimg':
                    $value[0] = (int)$eleValue[$id][0];
                    $value[4] = (int)$eleValue[$id][4];
                    $value[5] = (int)$eleValue[$id][5];
                    break;

                case 'url':
                    $value[] = $eleValue[$id];
                    break;

                case 'yn':
                    $newVars = array();
                    $i = 1;
                    foreach ($value as $key=>$j) {
                    //while ($j = each($value)) {
                        if (null !== $j) {
                            $newVars[$key] = ($eleValue[$id] == $i) ? '1' : '0';
                        }
                        ++$i;
                    }
                    $value = $newVars;
                    break;

                default:
                    break;
            }
            
            $element->setVar('ele_value', $value, true);
            if (!$xformsEleHandler->insert($element)) {
                $error .= $element->getHtmlErrors();
            }
        }
//exit;
        //echo "<hr>" . $helper->url('admin/elements.php?op=list&form_id=' . $formId) . "<hr>";
        redirect_header($helper->url('admin/elements.php?op=list&form_id=' . $formId), Constants::REDIRECT_DELAY_NONE, _AM_XFORMS_DBUPDATED);
/*
        if (empty($error)) {
            if (_AM_XFORMS_SAVE_THEN_FORM == $_POST['submit']) {
                $helper->redirect('admin/main.php?op=edit&form_id=' . $formId, Constants::REDIRECT_DELAY_NONE, _AM_XFORMS_DBUPDATED);
                //redirect_header($GLOBALS['xoops']->buildUrl('/modules/' . $moduleDirName . '/admin/main.php', array('op' => 'edit', 'form_id' => $formId)), Constants::REDIRECT_DELAY_NONE, _AM_XFORMS_DBUPDATED);
            } else {
                redirect_header($_SERVER['SCRIPT_NAME'] . '?form_id=' . $formId, Constants::REDIRECT_DELAY_NONE, _AM_XFORMS_DBUPDATED);
            }
        } else {
            xoops_cp_header();
            echo $error;
        }
*/
        
