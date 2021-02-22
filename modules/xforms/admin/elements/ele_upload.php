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
 * @since     2.00
 */
use XoopsModules\Xforms;
use XoopsModules\Xforms\Constants;
use XoopsModules\Xforms\FormInput;

defined('XFORMS_ROOT_PATH') || exit('Restricted access');

/**
 * Upload element
 * value [0] = input size
 *       [1] = mime file extensions
 *       [2] = mime types
 *       [3] = save to (mail or directory)
 */
$size   = (!empty($value[0])) ? (int)$value[0] : 0;
$defauExt  = (!empty($value[1])) ? (string)$value[1] : "doc|dot|pdf|ppt|tar|gz|zip|ics|ifb|csv|css|htm|htm|tpl|asc|txt|rtf|sgm|sgm|tsv|wml|wml|xsl|xml";
$defauType = (!empty($value[2])) ? (string)$value[2] : "application/msword|application/pdf|application/vnd.ms-powerpoint|application/x-tar|application/x-gzip|application/zip|text/calendar|text/csv|text/css|text/html|text/plain|text/rtf|text/x-sgml|text/x-sgml|text/tab-seperated-values|text/vnd.wap.wml|text/vnd.wap.wmlscript|text/xml";

$saveAs = (empty($value[3]) || (Constants::UPLOAD_SAVEAS_FILE !== (int)$value[3]))
           ? Constants::UPLOAD_SAVEAS_ATTACHMENT
           : Constants::UPLOAD_SAVEAS_FILE;

//$size = new \XoopsFormText(_AM_XFORMS_ELE_UPLOAD_MAXSIZE, 'ele_value[0]', 10, 20, $size);
//$size->setDescription(_AM_XFORMS_ELE_UPLOAD_MAXSIZE_DESC . '<br>' . _AM_XFORMS_ELE_UPLOAD_DESC_SIZE_NOLIMIT);

$size = new FormInput(_AM_XFORMS_ELE_UPLOAD_MAXSIZE, 'ele_value[0]', 10, 20, (string)$size, null, 'number');
$size->setDescription(_AM_XFORMS_ELE_UPLOAD_MAXSIZE_DESC . '<br>' . _AM_XFORMS_ELE_UPLOAD_DESC_SIZE_NOLIMIT);
$size->setAttribute('min', 0);
$size->setAttribute('step', 512);
$size->setExtra('style="width: 10em;"');

$mimeArray    = include $GLOBALS['xoops']->path('/include/mimetypes.inc.php');
$mimeTypes    = implode('|', $mimeArray);
//echo "<hr>{$mimeTypes}<hr>";
$mimeTypesJS  = implode('\|', $mimeArray);
//$mimeTypesIn = empty($value[2]) ? $mimeTypes : $myts->htmlSpecialChars($value[2]);
$mimeTypesIn = empty($eleId) ? $mimeTypes : $myts->htmlSpecialChars($defauType);

$mimeExtArray = array_keys($mimeArray);
$mimeExt      = implode('|', $mimeExtArray);
$mimeExtJS    = implode('\|', $mimeExtArray);
//$mimeExtIn   = empty($value[1]) ? $mimeExt : $myts->htmlSpecialChars($value[1]);
$mimeExtIn   = empty($eleId) ? $mimeExt : $myts->htmlSpecialChars($defauExt); //
unset($mimeArray, $mimeExtArray);

$extTray = new \XoopsFormElementTray(_AM_XFORMS_ELE_UPLOAD_ALLOWED_EXT, '<br>');
$extTray->setDescription(_AM_XFORMS_ELE_UPLOAD_ALLOWED_EXT_FILE_DESC . '<br><br>' . _AM_XFORMS_ELE_UPLOAD_DESC_NOLIMIT);
$ext = new \XoopsFormText('', 'ele_value[1]', 50, 255, $mimeExtIn);

$setExtButton = new \XoopsFormButton('', 'setext', _ADD . ' ' . _AM_XFORMS_ELE_DEFAULT, 'button');
$setExtButton->setExtra('onclick="document.getElementById(\'ele_value[1]\').value += \'\|' . $mimeExtJS . '\';"');
$extTray->addElement($ext);
$extTray->addElement($setExtButton);

$mimeTray = new \XoopsFormElementTray(_AM_XFORMS_ELE_UPLOAD_ALLOWED_MIME, '<br>');
$mimeTray->setDescription(_AM_XFORMS_ELE_UPLOAD_ALLOWED_MIME_FILE_DESC . '<br><br>' . _AM_XFORMS_ELE_UPLOAD_DESC_NOLIMIT);
$mime = new \XoopsFormTextArea('', 'ele_value[2]', $mimeTypesIn, 5, 50);
$setMimeButton = new \XoopsFormButton('', 'setmime', _ADD . ' ' . _AM_XFORMS_ELE_DEFAULT, 'button');
$setMimeButton->setExtra('onclick="document.getElementById(\'ele_value[2]\').value += \'\|' . $mimeTypesJS . '\';"');
$mimeTray->addElement($mime);
$mimeTray->addElement($setMimeButton);

$saveAs = new \XoopsFormSelect(_AM_XFORMS_ELE_UPLOAD_SAVEAS, 'ele_value[3]', $saveAs);
$saveAs->addOptionArray(array(Constants::UPLOAD_SAVEAS_ATTACHMENT => _AM_XFORMS_ELE_UPLOAD_SAVEAS_MAIL, Constants::UPLOAD_SAVEAS_FILE => _AM_XFORMS_ELE_UPLOAD_SAVEAS_FILE));

$output->addElement($size, Constants::REQUIRED);
//$output->addElement($ext);
//$output->addElement($mime);
$output->addElement($extTray);
$output->addElement($mimeTray);
$output->addElement($saveAs, Constants::REQUIRED);
