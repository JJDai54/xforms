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
 * @package   \XoopsModules\Xforms\admin
 * @author    XOOPS Module Development Team
 * @copyright Copyright (c) 2001-2019 {@link https://xoops.org XOOPS Project}
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 * @since     1.30
 *
 * @see \Xmf\Request
 * @see \Xmf\Module\Helper
 * @see \Xmf\Module\Admin
 * @see \XoopsModules\Xforms\Helper
 */

use XoopsModules\Xforms;
use XoopsModules\Xforms\Constants;
use XoopsModules\Xforms\FormInput;
use Xmf\Module\Helper;
use Xmf\Request;

require_once __DIR__ . '/admin_header.php';
require_once '../include/functions.php';

/* @var \XoopsModules\Xforms\Helper $helper */
/* @var \XoopsModules\Xforms\ElementHandler $xformsEleHandler */
$xformsEleHandler = $helper->getHandler('Element');

$myts = \MyTextSanitizer::getInstance();
//-----------------------------------------------------------


//             echo "_GET<pre>" . print_r($_GET, true) . "</pre>";
//             exit;
// echo "<hr>_POST<pre>" .  print_r($_POST, true) . "</pre><hr>";
//$eleValue   =  Request::getArray('ele_value'); //$_POST['ele_value'];
$eleValue   =  $_POST['ele_value'];
// echo "<hr>eleValue<pre>" .  print_r($eleValue, true) . "</pre><hr>";
//exit;
        //check to make sure this is from known location
        if (!$GLOBALS['xoopsSecurity']->check()) {
            redirect_header($_SERVER['SCRIPT_NAME'], Constants::REDIRECT_DELAY_MEDIUM, implode('<br>', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        $element = $xformsEleHandler->get($eleId);
        if ($element->isNew()) {
            $eleType = mb_strtolower(Request::getWord('ele_type', 'text', 'POST'));
        } else {
            $eleType = $element->getVar('ele_type');
        }

        $element->setVar('form_id', $formId);
        $element->setVar('ele_caption', $eleCaption);
        $eleReq = (Constants::ELEMENT_NOT_REQD !== $eleReq) ? Constants::ELEMENT_REQD : Constants::ELEMENT_NOT_REQD;
        $element->setVar('ele_req', $eleReq);
        if ('html' !== $eleType) {
            $displayRow = isset($_POST['ele_display_row']) ? Constants::DISPLAY_DOUBLE_ROW : Constants::DISPLAY_SINGLE_ROW;
            $element->setVar('ele_display_row', $displayRow);
        } else {
            // Force text box to be 2 rows
            $element->setVar('ele_display_row', Constants::DISPLAY_DOUBLE_ROW);
        }
//        $order   = empty($ele_order) ? 0 : (int)$eleOrder;
//        $display = (isset($ele_display)) ? 1 : 0;
//        $element->setVar('ele_order', $order);
//        $element->setVar('ele_display', $display);
        $eleDisplay = Request::getInt('ele_display', Constants::ELEMENT_NOT_DISPLAY, 'POST');
        $element->setVar('ele_order', $eleOrder);
        $element->setVar('ele_display', $eleDisplay);
        $element->setVar('ele_type', $eleType);
/* as of PHP 5.4 get_magic_quotes_gpc always returns false so $magicQuotes always eq false
        $magicQuotes = false; // Flag to fix problem with slashes
        if (function_exists('get_magic_quotes_gpc') && get_magic_quotes_gpc()) {
            $magicQuotes = true;
        }
*/
        $value = array();

        switch ($eleType) {
            case 'checkbox':
//echo "<hr>debut<hr>";
                //JJDai - on veut les cochés pas les non cochés
                //$checked1  = Request::getArray('ckbox', Constants::ELE_NOT_CHECKED, 'POST');
                $checked1  = Request::getArray('ckbox');
                $checked2  = array_map('intval', $checked1);
             echo "_POST<pre>" . print_r($_POST, true) . "</pre>";
             echo "_Checked1<pre>" . print_r($checked1, true) . "</pre>";
             echo "_Checked2<pre>" . print_r($checked2, true) . "</pre>";
             echo "_ele<pre>" . print_r($eleValue, true) . "</pre>";
                foreach($eleValue as $key=>$v) {
                //while ($v = each($eleValue)) {
                    if ($v == '') { // remove 'empty' options
                        unset($eleValue[$key]);
                    } else {
                    ///echo "ker ; {} - <br>";

                        //JJDai - ca ne peut pas marceher ELE_CHECKED == 4 renvoi faux
                        //$check = (isset($checked1[$key]) && (Constants::ELE_CHECKED == intval($checked1[$key]))) ? Constants::ELE_CHECKED : Constants::ELE_NOT_CHECKED;
                        //tester la prasece dans le tableau suffit
                        $check = (isset($checked2[$key])  ) ? Constants::ELE_CHECKED : Constants::ELE_NOT_CHECKED;
                        $value[$v] = $check;
                    }
                }
             echo "_ele-result<pre>" . print_r($value, true) . "</pre>";
//exit("<hr>FIN<hr>");
             //exit;
                break;

            /**
             * Color element
             *
             * value [0] = default value
             *       [1] = input box size
             */
            case 'color':
                $currEleValues = $element->getVar('ele_value'); // get current values
                $value[0] = !empty($eleValue[0]) ? $myts->htmlSpecialChars($eleValue[0]) : $currEleValues[0]; // default
                $value[1] = !empty($eleValue[1]) ? (int)$eleValue[1] : $currEleValues[1]; // input box size
                break;

            /**
             * Date element
             *
             * value [0] = default date
             *       [1] = default date option (1 = current, 2 = default date)
             *       [2] = min date
             *       [3] = min date option (0 = none, 1 = current, 2 = min date)
             *       [4] = max date
             *       [5] = max date option (0 = none, 1 = current, 2 = max date)
             */
            case 'date':
                $currEleValues = $element->getVar('ele_value'); // get current values
                $value[0] = isset($eleValue[0]) ? $eleValue[0] : $currEleValues[0]; // default date
                $value[1] = isset($eleValue[1]) ? (int)$eleValue[1] : $currEleValues[1]; // default date option (0 = none, 1 = current, 2 = min date)
                $value[2] = isset($eleValue[2]) ? $eleValue[2] : $currEleValues[2]; // min date
                $value[3] = isset($eleValue[3]) ? (int)$eleValue[3] : $currEleValues[3]; // min date option (0 = none, 1 = current, 2 = min date)
                $value[4] = isset($eleValue[4]) ? $eleValue[4] : $currEleValues[4]; // max date
                $value[5] = isset($eleValue[5]) ? (int)$eleValue[5] : $currEleValues[5]; // max date option (0 = none, 1 = current, 2 = max date)
                break;

            /**
             * Email element
             *
             * value
             *      [0] = element rendered box size
             *      [1] = maximum size length
             *      [2] = default value
             */
            case 'email':
                $value[0] = !empty($eleValue[0]) ? (int)$eleValue[0] : $helper->getConfig('t_width');
                $value[1] = !empty($eleValue[1]) ? (int)$eleValue[1] : 254;
                $value[2] = !empty($eleValue[2]) ? $myts->htmlSpecialChars($eleValue[2]) : '';
                break;

            /**
             * HTML element
             *
             * value array [0] = text value
             */
            case 'html':
                $value[0] =  $eleValue[0];
//                $value[0] =  $myts->htmlSpecialChars($eleValue[0]);

                //echo "{$eleValue[0]}<br>";;
                //echo "{$value[0]}<br>";exit('html');exit;
                break;

            /**
             * Number element
             *
             * value [0] = minimum value allowed
             *       [1] = maximum value allowed
             *       [2] = default value
             *       [3] = element input field size
             *       [4] = set minimum value 0|false = no, else = yes
             *       [5] = set maximum value 0|false = no, else = yes
             *       [6] = set default value 0|false = no, else = yes
             *       [7] = step size
             */
            case 'number':
                $currEleValues = $element->getVar('ele_value'); // get current values
                $value[0] = isset($eleValue[0])  ? (int)$eleValue[0] : $currEleValues[0];  // min value
                $value[1] = !empty($eleValue[1]) ? (int)$eleValue[1] : $currEleValues[1]; // max value
                $value[2] = !empty($eleValue[2]) ? (int)$eleValue[2] : $currEleValues[2]; // default value
                $value[3] = !empty($eleValue[3]) ? (int)$eleValue[3] : $currEleValues[3]; // input box size
                $value[4] = !empty($eleValue[4]) ? (int)$eleValue[4] : $currEleValues[4]; // set min value
                $value[5] = !empty($eleValue[5]) ? (int)$eleValue[5] : $currEleValues[5]; // set max value
                $value[6] = !empty($eleValue[6]) ? (int)$eleValue[6] : $currEleValues[6]; // set default value
                $value[7] = !empty($eleValue[7]) ? (int)$eleValue[7] : $currEleValues[7]; // step size
                break;

            /**
             * Chrono element
             *
             * value [0] = start or current value
             *       [1] = nb digits
             *       [2] = step size
             *       [3] = prefix
             *       [4] = suffix
             */
            case 'chrono':
                $currEleValues = $element->getVar('ele_value'); // get current values
                $value[0] = isset($eleValue[0])  ? (int)$eleValue[0] : $currEleValues[0]; //
                $value[1] = !empty($eleValue[1]) ? (int)$eleValue[1] : $currEleValues[1]; //
                $value[2] = !empty($eleValue[2]) ? (int)$eleValue[2] : $currEleValues[2]; // 
                $value[3] = isset($eleValue[3])  ? $eleValue[3]      : $currEleValues[3]; //
                $value[4] = isset($eleValue[4])  ? $eleValue[4]      : $currEleValues[4]; //
                $value[5] = !empty($eleValue[5]) ? (int)$eleValue[5] : $currEleValues[5]; //
                break;

            case 'timestamp':
                $currEleValues = $element->getVar('ele_value'); // get current values
                $value[0] = isset($eleValue[0])  ? (string)$eleValue[0] : $currEleValues[0]; //
                $value[1] = !empty($eleValue[1]) ? (int)$eleValue[1] : $currEleValues[1]; //
                //$value[2] = !empty($eleValue[2]) ? (int)$eleValue[2] : $currEleValues[2]; //
                break;
            /**
             * Obfuscated element
             *
             * value
             *      [0] = element rendered box size
             *      [1] = maximum size length
             */
            case 'obfuscated':
                $value[0] = !empty($eleValue[0]) ? (int)$eleValue[0] : $helper->getConfig('t_width');
                $value[1] = !empty($eleValue[1]) ? (int)$eleValue[1] : $helper->getConfig('t_max');
                break;

            /**
             * Pattern element
             *
             *  value [0] = input box size
             *        [1] = maximum input size
             *        [2] = placeholder
             *        [3] = pattern: use HTML5 pattern to validate input
             *        [4] = pattern description
             */
            case 'pattern':
                $value[0] = !empty($eleValue[0]) ? (int)$eleValue[0] : $helper->getConfig('t_width');
                $value[1] = !empty($eleValue[1]) ? (int)$eleValue[1] : $helper->getConfig('t_max');
                $value[2] = isset($eleValue[2]) ? $myts->htmlSpecialChars($eleValue[2]) : '';
                $value[3] = isset($eleValue[3]) ? $eleValue[3] : '';
                $value[4] = isset($eleValue[4]) ? $myts->htmlSpecialChars($eleValue[4]) : '';
                break;

            case 'radio':
                $checked = Request::getCmd('checked', 0, 'POST');
                foreach ($eleValue as $key=>$v) {
                //while ($v = each($eleValue)) {
                    if ('' == $v) { // remove 'empty' options
                        unset($eleValue[$key]);
                    } else {
                        $newVal = $myts->htmlSpecialChars($myts->addSlashes($v));
                        $value[$newVal] = ($checked == $key) ? Constants::ELE_CHECKED : Constants::ELE_NOT_CHECKED;
                    }
                }
                break;

            /**
             * Range element
             *
             * value [0] = default
             *       [1] = default option (0 = no, 1 = yes)
             *       [2] = min num
             *       [3] = max num
             *       [4] = step
             */
            case 'range':
                $currEleValues = $element->getVar('ele_value'); //get current values
                $value[0] = isset($eleValue[0]) ? (int)$eleValue[0] : $currEleValues[0]; // default
                $value[1] = isset($eleValue[1]) ? (int)$eleValue[1] : $currEleValues[1]; // default option (0 = no, 1 = yes)
                $value[2] = isset($eleValue[2]) ? (int)$eleValue[2] : $currEleValues[2]; // min num
                $value[3] = isset($eleValue[3]) ? (int)$eleValue[3] : $currEleValues[3]; // max num
                $value[4] = isset($eleValue[4]) ? (int)$eleValue[4] : $currEleValues[4]; // step
                break;

            /**
             * Select element
             *
             * eleValue array [0] => size,
             *                [1] => allow_multi,
             *                [2] => array (caption => selected)
             */
            case 'select':
                $value[0]    = ($eleValue[0] > 0) ? (int)$eleValue[0] : 1; // size
                $value[1]    = empty($eleValue[1]) ? Constants::DISALLOW_MULTI : Constants::ALLOW_MULTI; // multi-select

                $checked     = Request::getArray('checked', array());
                $tempValue   = array();
                $noneChecked = true;
                foreach ($eleValue[2] as $key => $option) {
                    if (!empty($option)) { // throw out any blank options
                        if (array_key_exists($key, $checked) && $checked[$key] && ($noneChecked || $value[1])) {
                            $noneChecked        = false;
                            $tempValue[$option] = 1;
                        } else {
                            $tempValue[$option] = 0;
                        }
                    }
                }
                $value[2] = $tempValue;
                break;

            /**
             * Country element
             *
             * eleValue [0] = size
             *          [1] = allow multiple
             *          [2] = selected value(s)
             */
            case 'select2':
            case 'country':
                $value[0] = (!empty($eleValue[0]) && ((int)$eleValue[0] > 1)) ? (int)$eleValue[0] : 1;
                $value[1] = !empty($eleValue[1]) ? Constants::ALLOW_MULTI : Constants::DISALLOW_MULTI;
                $value[2] = !empty($eleValue[2]) ? $eleValue[2] : $helper->getConfig('mycountry');
                break;

            /**
             * Text element
             *
             * value [0] = width of text box
             *       [1] = max input size
             *       [2] = default value
             *       [3] = isEmail (0 = no, else = yes)
             *       [4] = placeholder
             */
            case 'text':
                $value[0] = !empty($eleValue[0]) ? (int)$eleValue[0] : $helper->getConfig('t_width');
                $value[1] = !empty($eleValue[1]) ? (int)$eleValue[1] : $helper->getConfig('t_max');
                $value[2] = !empty($eleValue[2]) ? $eleValue[2] : '';
                $value[3] = !empty($eleValue[3]) ? (int)$eleValue[3] : Constants::FIELD_IS_NOT_EMAIL;
                $value[4] =  isset($eleValue[4]) ? strip_tags($myts->htmlSpecialChars($eleValue[4])) : '';
                break;

            /**
             * Textarea element
             *
             * value [0] = default value
             *       [1] = number of rows
             *       [2] = number of columns
             *       [3] = placeholder (HTML5)
             */
            case 'textarea':
                $value[0] = $eleValue[0];
                $value[1] = !empty($eleValue[1]) ? (int)$eleValue[1] : $helper->getConfig('ta_rows');
                $value[2] = !empty($eleValue[2]) ? (int)$eleValue[2] : $helper->getConfig('ta_cols');
                $value[3] = isset($eleValue[3]) ? strip_tags($myts->htmlSpecialChars($eleValue[3])) : '';
                $value[4] = isset($eleValue[4]) ? (int)$eleValue[4] : 0;
                break;

            /**
             * Time element
             *
             * value [0] = minimum value allowed
             *       [1] = maximum value allowed
             *       [2] = default value
             *       [3] = step size
             *       [4] = set minimum value 0|false = no, else = yes
             *       [5] = set maximum value 0|false = no, else = yes
             *       [6] = set default value 0|false = no, else = yes
             */
            case 'time':
                $value[] = $eleValue[0]; // min value allowed
                $value[] = $eleValue[1]; // max value allowed
                $value[] = $eleValue[2]; // def value
                $value[] = $eleValue[3]; // step size (60 = 1 min)
                $value[] = $eleValue[4]; // set min value 0|false = no, else = yes
                $value[] = $eleValue[5]; // set max value 0|false = no, else = yes
                $value[] = $eleValue[6]; // set def value 0|false = no, else = yes
                break;

            /**
             * Uploadimg element
             *
             * value [0] = input size
             *       [1] = mime file extensions
             *       [2] = mime types
             *       [3] = save to (mail or directory)
             *       [4] = image width
             *       [5] = image height
             */
            case 'uploadimg':
                $value[4] = (int)$eleValue[4];
                $value[5] = (int)$eleValue[5];
                // intentional fall through (no break) - to set other upload values[]
            /**
             * Upload element
             * value [0] = input size
             *       [1] = mime file extensions
             *       [2] = mime types
             *       [3] = save to (mail or directory)
             */
            case 'upload':
                $value[0] = (int)$eleValue[0];
                $ele1    = trim($eleValue[1], ' |\t\n\r\0\x0B');// normal trim & pipe '|' too
                // get rid of duplicate extensions
                $ele1Array = explode('|', $ele1);
                $ele1Array = array_unique($ele1Array);
                $value[1] = implode('|', $ele1Array);

                $ele2    = trim($eleValue[2], ' |\t\n\r\0\x0B');// normal trim & pipe '|' too
                // get rid of duplicate mime types
                $ele2Array = explode('|', $ele2);
                $ele2Array = array_unique($ele2Array);
                $value[2] = implode('|', $ele2Array);
                $value[3] = (Constants::UPLOAD_SAVEAS_FILE !== (int)$eleValue[3])
                          ? Constants::UPLOAD_SAVEAS_ATTACHMENT
                          : Constants::UPLOAD_SAVEAS_FILE;
                break;

            /**
             * Url element
             *
             * value  [0] = input box size
             *        [1] = maximum input size
             *        [2] = placeholder
             *        [3] = url type: 0 = http[s]|ftp[s], 1 = http[s] only, 2 = ftp[s] only
             */
            case 'url':
                $value[] = !empty($eleValue[0]) ? (int)$eleValue[0] : $helper->getConfig('t_width');
                $value[] = !empty($eleValue[1]) ? (int)$eleValue[1] : $helper->getConfig('t_max');
                $value[] = isset($eleValue[2]) ? $myts->htmlSpecialChars($eleValue[2]) : '';
                $value[] = isset($eleValue[3]) ? (int)$eleValue[3] : 0;
                break;

            /**
             * RadioYN element
             *
             * value ['_YES'] = 1 is yes, else is no
             */
            case 'yn':
                $value = ('_NO' === $eleValue[0]) ? array('_YES' => 0, '_NO' => 1) : array('_YES' => 1, '_NO' => 0);
                break;
        }
        $element->setVar('ele_value', $value);
        if (!$xformsEleHandler->insert($element)) {
            xoops_cp_header();
            echo $element->getHtmlErrors();
        } else {
        echo "<hr>" . $helper->url('admin/elements.php?op=list&form_id=' . $formId) . "<hr>";
            redirect_header($helper->url('admin/elements.php?op=list&form_id=' . $formId), Constants::REDIRECT_DELAY_NONE, _AM_XFORMS_DBUPDATED);
        }
