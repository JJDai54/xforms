<?php

namespace XoopsModules\Xforms;

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
 * Module: Xforms
 *
 * @package   \XoopsModules\Xforms\class
 * @author    XOOPS Module Development Team
 * @copyright Copyright (c) 2001-2017 {@link https://xoops.org XOOPS Project}
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 * @since     1.30
 */
use XoopsModules\Xforms;
use XoopsModules\Xforms\Constants;
use XoopsModules\Xforms\Helper as xHelper;
use XoopsModules\Xforms\FormInput;
use XoopsModules\Xforms\FormRaw;
use Xmf\Module\Helper;

include_once XOOPS_ROOT_PATH . '/modules/xforms/include/functions.php';

/**
 * \XoopsModules\Xforms\ElementRenderer class to dislay form elements
 *
 */
class ElementRenderer
{
    /**
     *
     * @var \XoopsModules\Xforms\Element the element to be rendered
     */
    private $ele;
    /**
     *
     * @var string this module's directory name
     */
    protected $dirname;

    /**
     * ElementRenderer constructor
     *
     * @param \XoopsModules\Xforms\Element $eleObj
     */
    public function __construct(\XoopsModules\Xforms\Element $eleObj)
    {
        $this->ele = $eleObj;
        $this->dirname = basename(dirname(__DIR__));
    }

    /**
     * constructElement method creates displayable XoopsForm element in admmin list or user page
     *
     * @todo test refactored code to eliminate need for 'global $form'
     * @param bool $admin
     * @param string $delimiter
     *
     * @uses \Xmf\Module\Helper
     * @uses \XoopsModules\Xforms\Helper
     * @uses \MyTextSanitizer
     * @uses \XformsFormInput
     * @uses \XoopsFormCheckBox
     * @uses \XoopsFormEditor
     * @uses \XoopsFormElementTray
     * @uses \XoopsFormFile
     * @uses \XoopsFormLabel
     * @uses \XoopsFormRadio
     * @uses \XoopsFormSelect
     * @uses \XoopsFormSelectCountry
     * @uses \XoopsFormText
     * @uses \XoopsFormTextArea
     *
     * @return \XoopsFormTextArea|\XoopsFormElementTray|\XoopsFormLabel|\XoopsFormSelect|\XoopsFormText|\XoopsFormTextArea|\XoopsModules\Xforms\FormInput
     */
    public function constructElement($admin = false, $delimiter = ' ', $data=null)
    {
        // Instantiate
        /* @var \XoopsModules\Xforms\Helper $helper */
        $helper     = xHelper::getInstance(); // module helper
        $myts       = \MyTextSanitizer::getInstance();
        $eleCaption = Xforms\getHtml($this->ele->getVar('ele_caption'), Constants::ALLOW_HTML);
        $eleValue   = $this->ele->getVar('ele_value');
        $eleType    = $this->ele->getVar('ele_type');
//        $delimiter  = $form->getVar('form_delimiter');
        $formEleId  = $admin ? 'ele_value[' . $this->ele->getVar('ele_id') . ']' : 'ele_' . $this->ele->getVar('ele_id');

/*
if(!$admin){
  echo "<hr>formEleId : {$formEleId} - " . $eleCaption . "<br>";
  //echo "<hr>Liste des formulaires : <pre>". print_r($data, true)  . "</pre>";
  echo "Liste des elements de l'objet : <pre>". print_r($eleValue, true)  . "</pre><hr>";
}
*/

/*
 if (isset($data[$formEleId])){
 }else{
 }
 if (isset($data[$formEleId])){
    = $data[$formEleId];
 }
*/
        switch ($eleType) {
            case 'checkbox': 
                $selected = array();
                $options  = array();
                $oCount   = 1;

                foreach ($eleValue as $key=>$i) {
                //while ($i = each($eleValue)) {
                    $options[$oCount] = $key;
                    if ($i > 0) {
                        $selected[] = $oCount;
                    }
                    ++$oCount;
                }

                 if (isset($data[$formEleId])){
                   $selected = $data[$formEleId];
                 }

                $formElement = new \XoopsFormElementTray($eleCaption, Constants::DELIMITER_BR == $delimiter ? '<br>' : ' ');
                foreach ($options as $key=>$opt ) {
                //while ($opt = each($options)) {
                    $ckBox = new \XoopsFormCheckBox('', $formEleId . '[]', $selected);
                    $other = $this->optOther($opt, $formEleId);
                    if ($other !== false && !$admin) {
                        $ckBox->addOption($key, _MD_XFORMS_OPT_OTHER . $other);
                    } else {
                        $ckBox->addOption($key, $opt);
                    }
                    $formElement->addElement($ckBox);
                }
                break;

            case 'color':
                $formElement = new \XoopsFormElementTray($eleCaption);
                 if (isset($data[$formEleId])){
                  $eleValue[0]  = $data[$formEleId];
                 }

                $colorInp    = new FormInput('', $formEleId, $eleValue[1], 255, $eleValue[0], null, 'color');
                $colorInp->setExtra("onchange=\"document.getElementById('color_{$formEleId}').innerHTML = this.value;\"");
                $colorLbl    = new \XoopsFormLabel('', '<label class="middle" id="color_' . $formEleId . '" for="' . $formEleId . '">' . $eleValue[0] . '</label>');
                $formElement->addElement($colorInp);
                $formElement->addElement($colorLbl);
//                $formElement = new \XformsFormInput($eleCaption, $formEleId, $eleValue[1], 255, $eleValue[0], null, 'color');
                break;

            case 'date':
                xoops_load('xoopslocal');
                //if (!class_exists(\XoopsModules\Xforms\FormRaw)) {
                //    xoops_load('FormRaw', $this->dirname);
                //}
                $formElement = new \XoopsFormElementTray($eleCaption);
                // set default date
                switch ((int)$eleValue[1]) {
                    case Constants::ELE_CURR: // to current date
                    default:
                        $dateDef = date('Y-m-d');
                        break;

                    case 2: // to specific date
                        $dateDef = $eleValue[0];
                        break;
                  }

                 if (isset($data[$formEleId])){
                   $dateDef = $data[$formEleId];
                 }

                $inpEle   = new FormInput('', $formEleId, 15, 15, $dateDef, null, 'date');

                // set start (min) date
                switch ((int)$eleValue[3]) {
                    case 0: // no
                    default:
                        $inpEleDesc = '';
                        break;
                    case 1: // to current date
                        $dateMin = date('Y-m-d');
                        $inpEle->setAttribute('min', $dateMin);
                        $inpEleDesc = sprintf(_AM_XFORMS_ELE_DATE_MIN_LBL, date(_SHORTDATESTRING));
                        break;
                    case 2: // to specific date
                        $dateMin = $eleValue[2];
                        $inpEle->setAttribute('min', $dateMin);
                        $inpEleDesc = sprintf(_AM_XFORMS_ELE_DATE_MIN_LBL, \XoopsLocal::formatTimestamp(strtotime($eleValue[2]), 's'));
                        break;
                }
                // set start (max) date
                switch ((int)$eleValue[5]) {
                    case 0: //no
                    default:
                        break;
                    case 1: // to current date
                        $dateMax = date('Y-m-d');
                        $inpEle->setAttribute('max', $dateMax);
                        $inpEleDesc .= sprintf(_AM_XFORMS_ELE_DATE_MAX_LBL, date(_SHORTDATESTRING));
                        break;
                    case 2: // to specific date
                        $dateMax = $eleValue[4];
                        $inpEle->setAttribute('max', $dateMax);
                        $inpEleDesc .= sprintf(_AM_XFORMS_ELE_DATE_MAX_LBL, \XoopsLocal::formatTimestamp(strtotime($eleValue[4]), 's'));
                        break;
                }
                if (!empty($inpEleDesc)) {
                    $trayDesc = $formElement->getCaption();
                    $formElement->setCaption($trayDesc . '<br><span class="normal">' . $inpEleDesc . '</span>');
                }
                $formElement->addElement($inpEle);
                $rawScript =
                "<script>\n"
                    .    "if (!Modernizr.inputtypes.date) {\n"
//                    .    "alert(\"Browser doesn't support date\");\n"
//                    .    "  $('input[type=date]')\n"
                    .    "  $('input[id={$formEleId}]')\n"
                    .    "  .attr('type', 'text')\n"
                    .    "  .datepicker({\n"
                    .    "  // Consistent format with the HTML5 picker\n"
                    .    "  dateFormat: 'yy-mm-dd',\n";
                $rawScript .= !empty($dateMin) ? "  minDate: '{$dateMin}',\n" : "";
                $rawScript .= !empty($dateMax) ? "  maxDate: '{$dateMax}'\n" : "";
                $rawScript .= "  });\n"
                            . "}\n"
                            . "</script>\n";
                $formElement->addElement(new FormRaw($rawScript));
                break;

            case 'email':
                // eleValue: [0] = size, [1] = max size [2] = value
                $memberHandler = xoops_getHandler('member');
                $xur = (isset($GLOBALS['xoopsUser']) && $GLOBALS['xoopsUser'] instanceof \XoopsUser) ? $GLOBALS['xoopsUser'] : $memberHandler->createUser();
                if (!$admin) {
                        $eleValue[2] = ('{U_email}' === trim($eleValue[2])) ? $xur->getVar('email', 'e') : '';
                }
                if (isset($data[$formEleId])){
                  $eleValue[2] = $data[$formEleId];
                }


                //$formElement = new FormInput($eleCaption, $formEleId, $eleValue[0], $eleValue[1], '', null, 'email');
                $formElement = new FormInput($eleCaption, $formEleId, (int)$eleValue[0], (int)$eleValue[1], $myts->htmlSpecialChars($eleValue[2]), null, 'email');
//JJDai - fonctionne pas impossible de changer la couleur de fond
//$formElement->setExtra('style="background-color:#FF0000;color:blue"');
                if ($admin) {
                    $formElement->setExtra('disabled');
                }
                /* add javascript email validation - HTML5 validation isn't very good
                 * filter inserted from emailregx.com on 25 Jul 2016
                 */
                $formElement->customValidationCode[] =
                  "var filter = /^[-a-z0-9~!$%^&*_=+}{\'?]+(\.[-a-z0-9~!$%^&*_=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i"
                . "if (filter.test({$formEleId})) {return true;} else {return false;}";
                break;

            case 'html':
                //pour affichage dans le front-office
                if (!$admin) {
                    $formElement = new \XoopsFormLabel(
                        $eleCaption, Xforms\getHtml($eleValue[0], Constants::ALLOW_HTML), null
                        );
                } else {
                //pour affichage dans le backoffice-office
                   $sysHelper = Helper::getHelper('system');
                   $formElement = Xforms\get_editor($eleCaption,$formEleId, $eleValue[0], $width='50%', $height = '260px');

//                     $formHtmlConfigs = array('editor' => Xforms\get_editor_name(),
//                                                'rows' => 8,
//                                                'cols' => 30,
//                                               'width' => '100%',
//                                              'height' => '160px',
//                                                'name' => $formEleId,
//                                               'value' => $myts->htmlSpecialChars($eleValue[0]) // default value
//                     );
//                     $formElement = new \XoopsFormEditor($eleCaption, $formEleId, $formHtmlConfigs);
                    /*
                    $renderer = $formElement->editor->renderer;
                    if (property_exists($renderer, 'skipPreview')) {
                        $formElement->editor->renderer->skipPreview = true;
                    }
                    */
                }
                break;

            case 'number':
                if (isset($data[$formEleId])){
                    $defNum = $data[$formEleId];
                }else{
                    $defNum = (!empty($eleValue[6])) ? (int)$eleValue[2] : null;
                }
                $formElement = new FormInput($eleCaption, $formEleId, $eleValue[3], 255, $defNum, null, 'number'); //JJDai -
                if (!empty($eleValue[4])) { // do we want to set a min value?
                    $formElement->setAttribute('min', (int)$eleValue[0]);
                }
                if (!empty($eleValue[5])) {
                    $formElement->setAttribute('max', (int)$eleValue[1]);
                }
                if (!empty($eleValue[7])) {
                    $formElement->setAttribute('step', (int)$eleValue[7]);
                }
                break;

            case 'chrono':
/**
 * Chrono element
 *
 * value [0] = start or current value
 *       [1] = nb digits
 *       [2] = step size
 *       [3] = prefix
 *       [4] = suffix
 */

//echo "<pre>" . print_r($eleValue, true) . "</pre>";
                $chrono = Xforms\format_chrono_temp($eleValue)[1];
                //$chrono =  . str_pad((+1) ,, "0", STR_PAD_LEFT) . $eleValue[4];
                $chronoLib = new \XoopsFormLabel('', $chrono);
                $chronoVal = new \XoopsFormHidden($formEleId, $chrono);

                $formElement  = new \XoopsFormElementTray($eleCaption, '', 'newChrono');
                $formElement->addElement($chronoLib);
                $formElement->addElement($chronoVal);
                break;

            case 'timestamp':
//echo "elementRender : timestamp<pre>" . print_r($eleValue, true) . "</pre>";
                $timestamp = Xforms\format_timestamp($eleValue);
                //$chrono =  . str_pad((+1) ,, "0", STR_PAD_LEFT) . $eleValue[4];
                $timestampLib = new \XoopsFormLabel('', $timestamp);
                $timestampVal = new \XoopsFormHidden($formEleId, $timestamp);

                $formElement  = new \XoopsFormElementTray($eleCaption, '', 'newTimestamp');
                $formElement->addElement($timestampLib);
                $formElement->addElement($timestampVal);
                break;




            case 'obfuscated':
                // eleValue: [0] = size, [1] = maxsize
                //@todo - should we make this a tray and create 'duplicate' fields so user has to enter it 2X?
//                  if (isset($data[$formEleId])){
//                    $eleValue[1] = $data[$formEleId];
//                  }

                $formElement = new FormInput($eleCaption, $formEleId, $eleValue[0], $eleValue[1], '', null, 'password');
                $formElement->setExtra('autocomplete="off"');
                break;

            case 'pattern':
                // eleValue: [0] = size, [1] = maxsize, [2] = placeholder, [3] = pattern, [4] = pattern desc
               if (isset($data[$formEleId])){
                $eleValue[2]  = $data[$formEleId];
               }

                $formElement = new FormInput($eleCaption, $formEleId, $eleValue[0], $eleValue[1], '', $eleValue[2], 'text');
                if (isset($eleValue[4]) && !$admin) {
                    $formElement->setPattern($eleValue[3], $eleValue[4]);
                    $formElement->setExtra('required'); // needed, otherwise empty string won't be checked
                }
                break;

            case 'radio':
                $selected = '';
                $options  = array();
                $oCount   = 1;

                foreach ($eleValue as $key=>$i) {
                //while ($i = each($eleValue)) {

                    $options[$oCount] = $key;
                    if ($i > 0) {
                        $selected = $oCount;
                    }
                    ++$oCount;
                }
                 if (isset($data[$formEleId])){
                   $selected = $data[$formEleId];
                 }

                //$delimiter = $admin ? Constants::DELIMITER_BR : Constants::DELIMITER_SPACE;
                //$delimiter = $admin ? Constants::DELIMITER_BR : $delimiter;
                switch ($delimiter) {
                    case Constants::DELIMITER_BR:
                        $formElement = new \XoopsFormElementTray($eleCaption, '<br>');
                        foreach ($options as $key=>$o) {
                        //while ($o = each($options)) {
                            $t     = new \XoopsFormRadio('', $formEleId, $selected);
                            $other = $this->optOther($o, $formEleId);
                            if ((false !== $other) && !$admin) {
                                $t->addOption($key, _MD_XFORMS_OPT_OTHER . $other);
                            } else {
                                $t->addOption($key, $o);
                            }
                            $formElement->addElement($t);
                        }
                        break;

                    case Constants::DELIMITER_SPACE:
                    default:
                        $formElement = new \XoopsFormRadio($eleCaption, $formEleId, $selected);
                        foreach ($options as $key=>$o) {
                        //while ($o = each($options)) {
                            $other = $this->optOther($o, $formEleId);
                            if ($other !== false && !$admin) {
                                $formElement->addOption($key, _MD_XFORMS_OPT_OTHER . $other);
                            } else {
                                $formElement->addOption($key, $o);
                            }
                        }
                        break;
                }
                break;

            case 'range':
                /*
                 * value [0] = default
                 *       [1] = default option (0 = no, 1 = yes)
                 *       [2] = min num
                 *       [3] = max num
                 *       [4] = step
                 */
                if (isset($data[$formEleId])){
                  $default = $data[$formEleId];
                }else{
                  $default = isset($eleValue[0]) && !empty($eleValue[1]) ? $eleValue[0] : null;
                }

                $formElement = new \XoopsFormElementTray($eleCaption . '<br>Min: ' . $eleValue[2] . ' Max: ' . $eleValue[3]);
                $rangeEle = new FormInput('', $formEleId, 15, 255, $default, null, 'range');
                if ($admin && empty($eleValue[1])) {
                    $rangeEle->setExtra('disabled');
                }
                $stepSize = isset($eleValue[4]) ? $eleValue[4] : Constants::ELE_DEFAULT_STEP;
                $rangeEle->setAttributes(array('min' => $eleValue[2], 'max' => $eleValue[3], 'step' => (float)$stepSize));
                $rangeEle->setExtra('onchange="document.getElementById(\'range_label_' . $formEleId . '\').innerHTML = this.value;"');
                $default = (null === $default) ? floor((($eleValue[3] - $eleValue[2])/$stepSize)/2) : $default;
                $rangeLbl = new FormRaw('<label class="bold" id="range_label_' . $formEleId . '" for="' . $formEleId . '">' . $default . '</label>');
//                $rangeLbl = new \XoopsFormLabel('', '<label class="middle center bold" id="range_label" for="' . $formEleId . '">' . $default . '</label>');
                $formElement->addElement(new FormRaw('<div class="middle">'));
                $formElement->addElement($rangeEle);
                $formElement->addElement($rangeLbl);
                $formElement->addElement(new FormRaw('</div>'));
                break;

            case 'select':
                $selected = array();
                $options  = array();
                $oCount   = 1;
                foreach ($eleValue[2] as $key=>$i) {
                //while ($i = each($eleValue[2])) {
                    $options[$oCount] = $key;
                    if ($i > 0) {
                        $selected[] = $oCount;
                    }
                    ++$oCount;
                }
                 if (isset($data[$formEleId])){
                   $selected = $data[$formEleId];
                 }

                $formElement = new \XoopsFormSelect(
                    $eleCaption, $formEleId, $selected,
                    (isset($eleValue[0]) && ((int)$eleValue[0] > 0)) ? (int)$eleValue[0] : 1, // size
                    (bool)$eleValue[1] // multiple
                    );

                if ($eleValue[1]) {
                    $this->ele->setVar('ele_req', 0);
                }
                $formElement->addOptionArray($options);
                break;

            case 'select2': // left for bac kward compatibility
            case 'country':
               if (isset($data[$formEleId])){
                 $eleValue[2] = $data[$formEleId];
               }

                $formElement = new \XoopsFormSelectCountry(
                    $eleCaption, $formEleId, $myts->htmlSpecialChars($eleValue[2]), //default
                    (isset($eleValue[0]) && ((int)$eleValue[0] > 0)) ? (int)$eleValue[0] : 1 // size
                );
                $formElement->_multiple = (bool)$eleValue[1];
                break;

            case 'text':
//  if (isset($data[$formEleId])){
//   $eleValue[2]  = $data[$formEleId];
//  }

                $memberHandler = xoops_getHandler('member');
                $xur = (isset($GLOBALS['xoopsUser']) && $GLOBALS['xoopsUser'] instanceof \XoopsUser) ? $GLOBALS['xoopsUser'] : $memberHandler->createUser();
                if (!$admin) {
                    foreach ($xur->vars as $k => $v) {
                        $eleValue[2] = str_replace('{U_' . $k . '}', $xur->getVar($k, 'e'), $eleValue[2]);
                    }
                }

                //check to see if profile module is active
                $profileHelper = Helper::getHelper('profile');
                if (false !== $profileHelper) {
                    $profileHandler = $profileHelper->getHandler('profile');
                    $xpr = (isset($GLOBALS['xoopsUser']) && $GLOBALS['xoopsUser'] instanceof \XoopsUser) ? $profileHandler->get($GLOBALS['xoopsUser']->getVar('uid')) : $profileHandler->create();
                    if (!$admin) {
                        foreach ($xpr->vars as $k => $v) {
                            $eleValue[2] = str_replace('{P_' . $k . '}', $xpr->getVar($k, 'e'), $eleValue[2]);
                        }
                    }
                    unset($profileHandler, $xpr);
                }

               if (isset($data[$formEleId])){
                $eleValue[2] = $data[$formEleId];
               }

                $formElement = new \XoopsFormText($eleCaption, $formEleId, $eleValue[0], // box width
                                                 $eleValue[1], // maxlength
                                                 $myts->htmlSpecialChars($eleValue[2]) // value
                );
                //echo "<hr><pre>" .  $myts->htmlSpecialChars($eleValue[2]) . "</pre><hr>";        //JJDai           
                //echo "<hr><pre>{$eleValue[2]}</pre><hr>";                   
                if (isset($eleValue[4])) { // not set if form was imported
                    $formElement->setExtra('placeholder="' . $eleValue[4] . '"');
                }
                break;

            case 'textarea':
               if (isset($data[$formEleId])){
                $eleValue[0] = $data[$formEleId];
               }
                $formElement = new \XoopsFormTextArea($eleCaption, $formEleId, $myts->htmlSpecialChars($eleValue[0]), // default value
                $eleValue[1], // rows
                $eleValue[2]  // cols
                );
                if (isset($eleValue[3])) { // not set if form was imported
                    $formElement->setExtra('placeholder="' . $eleValue[3] . '"');
                }
                break;

            case 'time':
                 if (isset($data[$formEleId])){
                   $defNum = $data[$formEleId];
                 }else{
                    $defNum      = (!empty($eleValue[6])) ? preg_replace('/[^0-9:]/', '', $eleValue[2]) : null;
                 }

                $formElement = new \XoopsFormElementTray($eleCaption, null, $formEleId . '_tray');
                $inpEle      = new FormInput('', $formEleId, 8, 10, $defNum, null, 'time');

                $inpEleDesc = array();
                if (!empty($eleValue[4])) { // do we want to set a min value?
                    $dispMin = preg_replace('/[^0-9:]/', '', $eleValue[0]);
                    $inpEle->setAttribute('min',$dispMin);
                    list($hrs, $mins) = explode(':', $dispMin, 2);
                    $suffix = 'AM';
                    if ((int)$hrs > 12) {
                        $hrs = (string)((int)$hrs - 12);
                        $suffix = 'PM';
                    }
                    $descMin = $hrs . ':' . $mins . $suffix;
                    $inpEleDesc[] = sprintf(_AM_XFORMS_ELE_DATE_MIN_LBL, $descMin);
                }
                if (!empty($eleValue[5])) {
                    $dispMax = preg_replace('/[^0-9:]/', '', $eleValue[1]);
                    $inpEle->setAttribute('max',$dispMax);
                    list($hrs, $mins) = explode(':', $dispMax, 2);
                    $suffix = 'AM';
                    if ((int)$hrs > 12) {
                        $hrs = (string)((int)$hrs - 12);
                        $suffix = 'PM';
                    }
                    $descMax = $hrs . ':' . $mins . $suffix;
                    $inpEleDesc[] = sprintf(_AM_XFORMS_ELE_DATE_MAX_LBL, $descMax);
                }
                if (!empty($eleValue[3])) {
                    $inpEle->setAttribute('step', (float)$eleValue[3]);
                }

                if (!empty($inpEleDesc)) {
                    $trayDesc = $formElement->getCaption();
                    $inpEleDesc = implode('', $inpEleDesc);
                    $formElement->setCaption($trayDesc . '<br><span class="normal">' . $inpEleDesc . '</span>');
                }
                $formElement->addElement($inpEle);
                break;

            case 'url':
                /* eleValue: [0] = size,
                 *           [1] = maxsize
                 *           [2] = placeholder
                 *           [3] = allowed url types (http[s]|ftp[s])
                 */
 if (isset($data[$formEleId])){
  $eleValue[2]  = $data[$formEleId];
 }

                $formElement = new FormInput($eleCaption, $formEleId, $eleValue[0], $eleValue[1], '', $eleValue[2], 'url');
                switch ((int)$eleValue[3]) {
                    case 0: // both http[s] & ftp[s]
                        $formElement->setExtra('pattern="(http|ftp)s?://.+"');
                        break;
                    case 1: // http[s] only
                    default:
                        $formElement->setExtra('pattern="https?://.+"');
                        break;
                    case 2: // ftp[s] only
                        $formElement->setExtra('pattern="ftps?://.+"');
                        break;
                }
                break;

           case 'upload':
               if ($admin) {
                   $formElement = new \XoopsFormElementTray('', '<br>');
                   $maxsize = new FormInput(_AM_XFORMS_ELE_UPLOAD_MAXSIZE, "{$formEleId}[0]", 10, 20, (string)$eleValue[0], null, 'number');
                   $maxsize->setAttribute('min', 0);
                   $maxsize->setAttribute('step', 512);
                   $formElement->addElement($maxsize);
               } else {
//  if (isset($data[$formEleId])){
//    $eleValue[0] = $data[$formEleId];
//  }

                    $formElement = new \XoopsFormElementTray($eleCaption, '<br>');
                    $inpFile = new \XoopsFormFile('', $formEleId, $eleValue[0]);                   
                    //$weightMo = floor(($eleValue[0]) / 1000000) . " mo";
                    $weightMo = $this->convertOctet(($eleValue[0]), 'mo');
                    $Info = new \XoopsFormLabel('', sprintf(_MD_XFORMS_MAX_FILE_SIZE, $weightMo));
                   
                    $formElement->addElement($inpFile);
                    $formElement->addElement($Info);
               }
               break;

            case 'uploadimg':
                if ($admin) {
                    $formElement = new \XoopsFormElementTray('', '<br>');
                    $maxsize     = new FormInput(_AM_XFORMS_ELE_UPLOAD_MAXSIZE, $formEleId . '[0]', 10, 20, (string)$eleValue[0], null, 'number');
                    $maxsize->setAttribute('min', 0);
                    $maxsize->setAttribute('step', 512);
                    $maxwidth  = new FormInput(_AM_XFORMS_ELE_UPLOADIMG_MAXWIDTH, $formEleId . '[4]', 10, 20, (string)$eleValue[4], null, 'number');
                    $maxwidth->setAttribute('min', 0);
                    $maxheight = new FormInput(_AM_XFORMS_ELE_UPLOADIMG_MAXHEIGHT, $formEleId . '[5]', 10, 20, (string)$eleValue[5], null, 'number');
                    $maxheight->setAttribute('min', 0);
                    $formElement->addElement($maxsize);
                    $formElement->addElement($maxwidth);
                    $formElement->addElement($maxheight);
                } else {
//  if (isset($data[$formEleId])){
//    $eleValue[0] = $data[$formEleId];
//  }
                    $formElement = new \XoopsFormElementTray($eleCaption, '<br>');
                    $inpFile = new \XoopsFormFile('', $formEleId, $eleValue[0]);
                    //$weightMo = floor(($eleValue[0]) / 1000000) . " mo";
                    $weightMo = $this->convertOctet(($eleValue[0]), 'mo');
                    $Info = new \XoopsFormLabel('', sprintf(_MD_XFORMS_MAX_IMG_SIZE, $weightMo, (string)$eleValue[4], (string)$eleValue[5]));
                    
                    $formElement->addElement($inpFile);
                    $formElement->addElement($Info);
                }
                break;

            case 'yn':
                $selected = '';
                $options  = array();
                $oCount   = 1;
                foreach ($eleValue as $key=>$i) {
                //while ($i = each($eleValue)) {
                    $options[$oCount] = constant($key);
                    if ($i > 0) {
                        $selected = $oCount;
                    }
                    ++$oCount;
                }
                 if (isset($data[$formEleId])){
                   $selected = $data[$formEleId];
                 }

                //$delimiter = ($admin) ? Constants::DELIMITER_BR : Constants::DELIMITER_SPACE;
                //$delimiter = $admin ? Constants::DELIMITER_BR : $delimiter;
                switch ($delimiter) {
                    case Constants::DELIMITER_BR:
                        $formElement = new \XoopsFormElementTray($eleCaption, '<br>');
                        foreach ($options as $key=>$o) {
                        //while ($o = each($options)) {
                            $t     = new \XoopsFormRadio('', $formEleId, $selected);
                            $other = $this->optOther($o, $formEleId);
                            if ((false !== $other) && !$admin) {
                                $t->addOption($key, _MD_XFORMS_OPT_OTHER . $other);
                            } else {
                                $t->addOption($key, $o);
                            }
                            $formElement->addElement($t);
                        }
                        break;

                    case Constants::DELIMITER_SPACE:
                    default:
                        $formElement = new \XoopsFormRadio($eleCaption, $formEleId, $selected);
                        foreach ($options as $key => $o) {
                        //while ($o = each($options)) {
                            $other = $this->optOther($o, $formEleId);
                            if ($other !== false && !$admin) {
                                $formElement->addOption($key, _MD_XFORMS_OPT_OTHER . $other);
                            } else {
                                $formElement->addOption($key, $o);
                            }
                        }
                        break;
                }
                break;

            default:
                $formElement = false;
                break;
        }

        if ((false !== $formElement) && $this->ele->getVar('ele_req') && !$admin) {
            $formElement->setExtra('required');
        }
        return $formElement;
    }
    
    /**
     * @param int $octet
     * @param        $id
     * @param        $unite
     *
     * @return int 
     */
    public function convertOctet($octet, $unite = 'mo')
    {
        switch (strtolower($unite)){
        case 'mo' : return floor($octet / 1000000); break; 
        case 'go' : return floor($octet / 1000000000); break; 
        case 'ko' : return floor($octet / 1000000000000); break; 
        default   : return floor($octet / 1000); break; 
        }
    }

    /**
     * @param string $s
     * @param        $id
     *
     * @return string HTML output of XoopsFormText element render
     */
    public function optOther($s = '', $id)
    {
        if (!preg_match('/\{OTHER\|+[0-9]+\}/', $s)) {
            return false;
        }
        /* @var \XoopsModules\Xforms\Helper $helper */
        $helper = xHelper::getInstance();

        $s   = explode('|', preg_replace('/[\{\}]/', '', $s));
//        $len = !empty($s[1]) ? $s[1] : $GLOBALS['xoopsModuleConfig']['t_width'];
        $len = !empty($s[1]) ? $s[1] : $helper->getConfig('t_width');
        $box = new \XoopsFormText('', 'other[' . $id . ']', (int)$len, 255);
        $box->setExtra('onclick="var self=this; window.setTimeout(function () { self.focus(); }, 100);"');

        return $box->render();
    }
}
