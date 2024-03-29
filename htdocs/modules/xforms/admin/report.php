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
use Xmf\Request;
use XoopsModules\Xforms;
use XoopsModules\Xforms\Constants;
use XoopsModules\Xforms\Helper;

require_once dirname(dirname(dirname(__DIR__))) . '/include/cp_header.php';
require_once ('admin_header.php');
require_once ('../include/functions.php');

$op      = Request::getCmd('op', '');
$ok      = Request::getBool('ok', false, 'POST');
$format  = Request::getString('format', 'v', 'GET');
$formId  = Request::getInt('form_id', 0, 'GET');
$showAll = Request::getBool('showall', false, 'POST');

$thisFileName = basename(__FILE__);
$helper = Helper::getInstance();
/* @var XoopsModules\Xforms\FormsHandler $ xformsFormsHandler */
$formsHandler = $helper->getHandler('Forms');

if (empty($formId) && (!empty($_POST['op']) && !preg_match('/^purge(_do)*$/', $op))) {
    $op = '';
}

switch ($op) {
    case 'show': /*Show the report in the page*/
/*****************************************/
        require __DIR__ . '/admin_header.php';
        $myts = \MyTextSanitizer::getInstance();
        xoops_load('XoopsLocal');
/*****************************************/
        // Get the UserData to see if there's any reports
        if ((!$form = $formsHandler->get($formId)) || $form->isNew()) {
            /* @var \XoopsModules\Xforms\Helper $helper */
            $helper->redirect('admin/' . $thisFileName,
                                    Constants::REDIRECT_DELAY_MEDIUM,
                                    _AM_XFORMS_FORM_NOTEXISTS
            );
        } elseif (Constants::DO_NOT_SAVE_IN_DB === (int)$form->getVar('form_save_db')) {
            $helper->redirect('admin/' . $thisFileName,
                                    Constants::REDIRECT_DELAY_MEDIUM,
                                    _AM_XFORMS_FORM_NOTSAVE
            );
        }

        $uDataHandler = $helper->getHandler('UserData');
        $uData        = $uDataHandler->getReport($formId);
        if (empty($uData)) { // Is there anything to report?
            redirect_header($thisFileName, Constants::REDIRECT_DELAY_MEDIUM, _AM_XFORMS_RPT_NODATA);
        }

        // Show the report
        xoops_cp_header();
        /* @var \Xmf\Module\Admin $adminObject */
        $adminObject->displayNavigation($thisFileName);
        $adminObject->addItemButton(_AM_XFORMS_REPORT_PURGE, $thisFileName . '?op=purge', 'delete');
        $adminObject->displayButton();

        echo '<table class="outer width100 bspacing1">'
           . '  <thead>'
           . '  <tr>'
           . '    <th colspan="6">' . _AM_XFORMS_REPORT_FORM . ': ' . $form->getVar('form_title') . '</th>'
           . '  </tr>'
           . '  <tr>'
           . '    <th class="head center width10">' . _AM_XFORMS_NO . '</td>'
           . '    <th class="head center width10">' . _AM_XFORMS_RPT_USER . '</th>'
           . '    <th class="head center width10">' . _AM_XFORMS_RPT_DATETIME . '</th>'
           . '    <th class="head center width10">' . _AM_XFORMS_RPT_IP . '</th>'
           . '    <th class="head center width30">' . _AM_XFORMS_RPT_QUESTION . '</th>'
           . '    <th class="head center">' . _AM_XFORMS_RPT_ANSWER . '</th>'
           . '  </tr>'
           . '  </thead>'
           . '  <tbody>';

        $countu   = $dproc = 0;
        $ipproc   = '';
        $cssClass = 'even';

        foreach ($uData as $data) {
            $dtime  = $data['udata_time'];
            $ipuser = $data['udata_ip'];
            if ((0 === $dproc) || ($dproc !== $dtime || $ipproc !== $ipuser)) {
                $border   = ' style="border-top: 2px solid #000000;"';
                ++$countu;
                $ucount = $countu;
                $uid    = $data['uid'];
                $uname  = $myts->htmlSpecialChars($data['uname']);
                $datet  = \XoopsLocal::formatTimestamp($dtime, 'l');
                $uip    = $data['udata_ip'];
            } else {
                $border   = '';
                $uname    = $datet = $uip = $ucount = '&nbsp;';
            }
            $dproc  = $dtime;
            $ipproc = $ipuser;

            $cssClass   = ($cssClass === 'even') ? 'odd' : 'even';
            $eleCaption = $myts->displayTarea($data['ele_caption'], Constants::ALLOW_HTML);
            echo '  <tr class="' . $cssClass . '">'
               . '    <td' . $border . ' class="center" nowrap>' . $ucount . '</td>'
               . '    <td' . $border . ' class="center" nowrap>' . $uname . '</td>'
               . '    <td' . $border . ' class="center" nowrap>' . $datet . '</td>'
               . '    <td' . $border . ' class="center">' . $uip . '</td>'
               . '    <td' . $border . '>' . $eleCaption . '</td>';
/*
            $uDataValue = unserialize($data['udata_value'][0]);
            $uDataValue = array_map('base64_decode', $uDataValue);
*/
            $uDataValue = $data['udata_value'];

            if (is_array($uDataValue)) {
                switch ($data['ele_type']) {
                    case 'color':
                    case 'country':
                    case 'email':
                    case 'number':
                    case 'chrono':
                    case 'timestamp':
                    case 'obfuscated':
                    case 'pattern':
                    case 'range':
                    case 'select2': // left for backward compatibility
                    case 'text':
                    case 'textarea':
                    case 'time':
                    case 'url':
                    case 'yn':
                        echo '<td' . $border . '>' . $uDataValue[0] . '</td>';
                        break;

                    case 'upload':
                    case 'uploadimg':
                        echo '    <td' . $border . '>'
                           . '      <a href="'
                           .          $helper->url('file.php'
                           .           '?f=' . $uDataValue['file']
                           .           '&fn=' . $uDataValue['name'])
                           .       '">' . $uDataValue['name'] . '</a>'
                           . '    </td>';
                        break;

                    case 'checkbox':
                    case 'date':
                    case 'radio':
                    case 'select':
                        echo '    <td' . $border . '>';
                        if (is_array($uDataValue)) {
                            foreach ($uDataValue as $dValue) {
                                echo $dValue . '<br>';
                            }
                        } else {
                            echo $uDataValue;
                        }
                        echo '</td>';
                        break;
                    default:
                        echo '    <td' . $border . '>&nbsp;</td>';
                        break;
                }
            } else {
                echo '    <td' . $border . '>&nbsp;</td>';
            }

            echo '  </tr>';
        }
        echo '  </tbody>'
           . '  <tfoot>'
           . '  <tr><td class="foot center" colspan="6">';
        $bexportch = new \XoopsFormButton('', 'export-ch', _AM_XFORMS_RPT_EXPORT_CH, 'button');
        $bexportch->setExtra(" onclick=\"window.location='{$thisFileName}?op=export-horiz&format=c&form_id={$formId}'\"");
        $bexporthh = new \XoopsFormButton('', 'export_hh', _AM_XFORMS_RPT_EXPORT_HH, 'button');
        $bexporthh->setExtra(" onclick=\"window.location='{$thisFileName}?op=export-horiz&format=h&form_id={$formId}'\"");
        $bexportcv = new \XoopsFormButton('', 'export-cv', _AM_XFORMS_RPT_EXPORT_CV, 'button');
        $bexportcv->setExtra(" onclick=\"window.location='{$thisFileName}?op=export-vert&format=c&form_id={$formId}'\"");
        $bexporthv = new \XoopsFormButton('', 'export_hv', _AM_XFORMS_RPT_EXPORT_HV, 'button');
        $bexporthv->setExtra(" onclick=\"window.location='{$thisFileName}?op=export-vert&format=h&form_id={$formId}'\"");
        echo $bexportch->render() . $bexporthh->render() . $bexportcv->render() . $bexporthv->render();
        echo '</td></tr>'
           . '  </tfoot>'
           . '</table>';
        break;

    case 'purge':
/*****************************************/
        require __DIR__ . '/admin_header.php';
/*****************************************/
        xoops_cp_header();
        $adminObject->displayNavigation($thisFileName);
        $outputForm = new \XoopsThemeForm(_AM_XFORMS_RPT_PURGE_REPORTS, 'purge_report_form', $thisFileName, 'post', true);
        $defaultDate = new \DateTime(); //set to today
        $defaultDate->setTime(0, 0, 0); //set to midnight

        if ($formId > 0 ){
          $form = $formsHandler->get($formId);
          $outputForm->addElement(new \XoopsFormLabel(_AM_XFORMS_RPT_PURGE_FORM, $form->getVar('form_title'). " (#{$formId})"));
          $outputForm->addElement(new \XoopsFormHidden('form_id', $formId));
        }else{
          $outputForm->addElement(new \XoopsFormLabel(_AM_XFORMS_RPT_PURGE_ALL_FORM, _AM_XFORMS_RPT_PURGE_ALL_FORM_ALERT));

        }
        // Setup date selector
        $outputForm->addElement(new \XoopsFormDateTime(_AM_XFORMS_RPT_PURGE_OLDER_THAN, 'purge_date', 10, $defaultDate->getTimestamp(), false));
        $outputForm->addElement(new \XoopsFormButtonTray('purge_buttons', _SUBMIT, 'submit'));
        $outputForm->addElement(new \XoopsFormHidden('op', 'purge_do'));
        $outputForm->addElement(new \XoopsFormHidden('ok', 0));
        $outputForm->display();
        break;
/*****************************************/
    case 'purge_do':
/*****************************************/
//        require __DIR__ . '/admin_header.php';
/*****************************************/
        if ($ok) {
           $formId  = Request::getInt('form_id', 0, 'POST');
            // Security check to make sure came from a good location
            if (!$GLOBALS['xoopsSecurity']->check()) {
                $helper->redirect("admin/{$thisFileName}", Constants::REDIRECT_DELAY_MEDIUM, implode('<br>', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            // Ok - delete reports
            xoops_cp_header();
            //$purgeDate = Request::getString('purge_date', array(), 'POST');
            $purgeDate = Request::getString('purge_date', '', 'POST');
            $purgeDate = unserialize($purgeDate);
            $purgeDateTimeObj = \DateTime::createFromFormat(_SHORTDATESTRING, $purgeDate['date']);
            $purgeDateTimeObj->setTime(0, 0, 0);
            $pDTtimestamp = $purgeDateTimeObj->getTimestamp();

            //$uDataHandler = $helper->getHandler('UserData');

            $criteria = new criteriaCompo(new \Criteria('udata_time', $pDTtimestamp, '<'));
            if ($formId > 0){
              $criteria->add(new \Criteria('form_id', $formId, '='));
            }
//             echo "===>{$formId} :" . $criteria->render();
//             exit;

            $numItems = $uDataHandler->deleteAll($criteria);

        //Xforms\jecho ($thisFileName,'thisFileName');//,false,'purge_do'
        $url = XOOPS_URL . '/modules/xforms/admin/' . $thisFileName; //'admin/'
            if ($numItems > 0) {
                redirect_header($url, Constants::REDIRECT_DELAY_MEDIUM, sprintf(_AM_XFORMS_RPT_PURGE_DELETED, (int)$numItems));
            } elseif (0 === $numItems) {
                redirect_header($url, Constants::REDIRECT_DELAY_MEDIUM, _AM_XFORMS_RPT_PURGE_NOTHING);
            } else {
                redirect_header($url, Constants::REDIRECT_DELAY_MEDIUM, _AM_XFORMS_RPT_PURGE_ERR);
            }
/*
            if ($numItems > 0) {
                $helper->redirect($url, Constants::REDIRECT_DELAY_MEDIUM, sprintf(_AM_XFORMS_RPT_PURGE_DELETED, (int)$numItems));
            } elseif (0 === $numItems) {
                $helper->redirect($url, Constants::REDIRECT_DELAY_MEDIUM, _AM_XFORMS_RPT_PURGE_NOTHING);
            } else {
                $helper->redirect($url, Constants::REDIRECT_DELAY_MEDIUM, _AM_XFORMS_RPT_PURGE_ERR);
            }
*/







        } else {
           $formId  = Request::getInt('form_id', 0, 'POST');
            xoops_cp_header();
            //echo "formId = {$formId}<br>";
            $purgeDate = Request::getArray('purge_date', array('date' => date(_SHORTDATESTRING), 'time' => '0'), 'POST');
            $theDate = array_key_exists('date', $purgeDate) ? $purgeDate['date'] : date(_SHORTDATESTRING);
            $purgeDate = serialize($purgeDate);
            xoops_confirm(array('op' => 'purge_do', 'purge_date' => $purgeDate, 'ok' => Constants::CONFIRM_OK, 'form_id'=>$formId), $thisFileName, sprintf(_AM_XFORMS_REPORT_CONFIRM_DELETE, $theDate));
        }
        break;

    case 'export-horiz':
/*****************************************/
        require_once dirname(dirname(dirname(__DIR__))) . '/include/cp_header.php';
        require_once dirname(__DIR__) . '/include/common.php';
        $myts = \MyTextSanitizer::getInstance();

/*****************************************/
        if ((!$form = $formsHandler->get($formId)) && $form->isNew()) {
            redirect_header($thisFileName, Constants::REDIRECT_DELAY_MEDIUM, _AM_XFORMS_FORM_NOTEXISTS);
        } elseif (0 == $form->getVar('form_save_db')) {
            redirect_header($thisFileName, Constants::REDIRECT_DELAY_MEDIUM, _AM_XFORMS_FORM_NOTSAVE);
        }

        $uDataHandler = $helper->getHandler('UserData');
        $uData        = $uDataHandler->getReport($formId);
        if (empty($uData)) {
            redirect_header($thisFileName, Constants::REDIRECT_DELAY_MEDIUM, _AM_XFORMS_RPT_NODATA);
        }

        // Disable error reporting/logging
        error_reporting(0);
        $GLOBALS['xoopsLogger']->activated = false;

        include_once XOOPS_ROOT_PATH . '/class/template.php';
        $xformsTpl = new \XoopsTpl();

        $xformsTpl->assign('form_title', $form->getVar('form_title'));
        $xformsTpl->assign('delim', ','); // force delimiter for now

        $xformsEleHandler = $helper->getHandler('Element');
        $criteria         = new \CriteriaCompo();
        $criteria->add(new \Criteria('form_id', $form->getVar('form_id')), 'AND');
        $criteria->add(new \Criteria('ele_display', Constants::ELEMENT_DISPLAY), 'AND');
        $criteria->setSort('ele_order');
        $criteria->order = 'ASC';
        $elements = $xformsEleHandler->getObjects($criteria, true);
        $eleCount = count($elements);
        foreach ($elements as $el) {
            $xformsTpl->append('captions', $myts->displayTarea($el->getVar('ele_caption'), Constants::ALLOW_HTML));
        }

        $dl = new \stdClass();
        $format = strtolower($format);
        switch ($format) {
            case 'h': //html
                $xformsTpl->assign('col_count', $eleCount + 3);
                $dl->_template = $helper->path('templates/admin/xforms_export_hh.tpl');
                $dl->_ext = 'html';
                $dl->_type = 'horiz';
                $dl->_nl = '<br>';
                $dl->_mime = 'text/html';
                break;
            case 'c':
            default:
                $xformsTpl->register_outputfilter('\XoopsModules\Xforms\Utility::undoHtmlEntities');
                $dl->_template = $helper->path('templates/admin/xforms_export_ch.tpl');
                $dl->_ext = 'csv';
                $dl->_type = 'horiz';
                $dl->_nl = "\n";
                $dl->_mime = 'text/csv';
                break;
        }

        $rptArray = [];
        $rptTime  = null;
        $rptIp    = '';
        $blankEleArray = array_fill_keys(array_keys($elements), '&nbsp;');
        $uDataCount = count($uData);
        foreach ($uData as $key => $reportData) {
            $reportDataValue = $reportData['udata_value'];
            if (((int)$reportData['udata_time'] !== $rptTime) || ($reportData['udata_ip'] !== $rptIp)) {
                $rptTime = (int)$reportData['udata_time'];
                $rptIp   = (string)$reportData['udata_ip'];
                $rptArray[$key] = array('user' => $reportData['uname'],
                                        'time' => $rptTime,
                                          'ip' => $rptIp,
                                    'elements' => $blankEleArray);
                $lineKey = $key;
            }
            if (is_array($reportDataValue)) {
                switch ($reportData['ele_type']) {
                    case 'color':
                    case 'email':
                    case 'number':
                    case 'chrono':
                    case 'timestamp':
                    case 'obfuscated':
                    case 'pattern':
                    case 'text':
                    case 'textarea':
                    case 'url':
                    case 'yn':
                        $rptEleValue = $reportDataValue[0];
                        break;
                    case 'upload':
                    case 'uploadimg':
                        $rptEleValue = '<a href="' . $helper->url('file.php?f=' . $reportDataValue['file'] . '&fn=' . $reportDataValue['name']) . '">' . $reportDataValue['name'] . '</a>';
                        break;
                    case 'checkbox':
                    case 'country':
                    case 'date':
                    case 'radio':
                    case 'select':
                    case 'select2': // left for backward compatibility
                        $rptEleValue = implode(', ', $reportDataValue);
                        break;
                    default:
                        $rptEleValue = '&nbsp;';
                        break;
                }
            } else {
                $rptEleValue = '&nbsp;';
            }

            $rptArray[$lineKey]['elements'][$reportData['ele_id']] = $rptEleValue;
        }
        $xformsTpl->assign('rptArray', $rptArray);

        $tableData = $xformsTpl->fetch($dl->_template);
//        header('Content-Type: application/force-download');
        header('Content-Type: ' . $dl->_mime); // don't lie to browser, hope they do the right thing
        header('Content-Disposition: attachment; filename=report_form_' . $formId . '_' . $dl->_type . '.' . $dl->_ext);
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Transfer-Encoding: binary');
        echo $tableData;
        exit();
        break;

    case 'export-vert':
/*****************************************/
        require_once dirname(dirname(dirname(__DIR__))) . '/include/cp_header.php';
        require_once dirname(__DIR__) . '/include/common.php';
        $myts = \MyTextSanitizer::getInstance();

/*****************************************/

        if ((!$form = $formsHandler->get($formId)) && $form->isNew()) {
            redirect_header($thisFileName, Constants::REDIRECT_DELAY_MEDIUM, _AM_XFORMS_FORM_NOTEXISTS);
        } elseif (0 == $form->getVar('form_save_db')) {
            redirect_header($thisFileName, Constants::REDIRECT_DELAY_MEDIUM, _AM_XFORMS_FORM_NOTSAVE);
        }

        $uDataHandler = $helper->getHandler('UserData');
        $uData        = $uDataHandler->getReport($formId);
        if (empty($uData)) {
            redirect_header($thisFileName, Constants::REDIRECT_DELAY_MEDIUM, _AM_XFORMS_RPT_NODATA);
        }

        /*Disable debug*/
        error_reporting(0);
        $GLOBALS['xoopsLogger']->activated = false;

        include_once XOOPS_ROOT_PATH . '/class/template.php';
        $xformsTpl = new \XoopsTpl();
        $xformsTpl->assign('form_title', $form->getVar('form_title'));
        $xformsTpl->assign('delim', ','); //force delimiter for now
        $countu     = $dproc = 0;
        $ipproc     = '';
        $firstRow   = true;
        $uDataCount = count($uData);

        $dl = new \stdClass();
        $format = strtolower($format);
        switch ($format) {
            case 'h': //html
                $dl->_template = $helper->path('templates/admin/xforms_export_hv.tpl');
                $dl->_ext = 'html';
                $dl->_type = 'vert';
                $dl->_nl = '<br>';
                $dl->_mime = 'text/html';
                break;
            case 'c': //csv
            default:
                $xformsTpl->register_outputfilter('\XoopsModules\Xforms\Utility::undoHtmlEntities');
                $dl->_template = $helper->path('templates/admin/xforms_export_cv.tpl');
                $dl->_ext = 'csv';
                $dl->_type = 'vert';
                $dl->_nl = "\n";
                $dl->_mime = 'text/csv';
                break;
        }

        for ($i = 0; $i < $uDataCount; ++$i) {
            $border = '';
            $dtime  = (int)$uData[$i]['udata_time'];
            $ipuser = $uData[$i]['udata_ip'];
            if ((0 !== $dproc) && ($dproc !== $dtime || $ipproc !== $ipuser)) {
                $firstRow = true;
                $border   = ' border-top: 2px solid #000000;';
            }
            $dproc  = $dtime;
            $ipproc = $ipuser;
            $uname  = $datet = $uip = $ucount = '';
            if ($firstRow) {
                ++$countu;
                $ucount = $countu;
                $uname  = $uData[$i]['uname'];
                $datet  = date('d-m-Y H:i:s', $dtime);
                $uip    = $ipuser;
            }
            $eleCaption = $myts->displayTarea($uData[$i]['ele_caption'], Constants::ALLOW_HTML);
            $tplElements = array('border' => $border,
                                 'ucount' => $ucount,
                                  'uname' => $uname,
                                  'datet' => $datet,
                                    'uip' => $uip,
                            'ele_caption' => $eleCaption
            );
            $uDataValue = $uData[$i]['udata_value'];
            if (is_array($uDataValue)) {
                switch ($uData[$i]['ele_type']) {
                    case 'color':
                    case 'email':
                    case 'number':
                    case 'chrono':
                    case 'obfuscated':
                    case 'pattern':
                    case 'text':
                    case 'textarea':
                    case 'url':
                    case 'yn':
                    case 'timestamp':
                        $tplElements['ele_value'] = $uDataValue[0];
                        break;
//                         $tplElements['ele_value'] = mktime();
//                         break;

                    case 'upload':
                    case 'uploadimg':
                        $tplElements['ele_value'] = '<a href="'
                        .                              $helper->url('file.php'
                        .                                '?f=' . $uDataValue['file']
                        .                                '&fn=' . $uDataValue['name'])
                        .                           '">' . $uDataValue['name'] . '</a>';
                        break;

                    case 'checkbox':
                    case 'country':
                    case 'date':
                    case 'radio':
                    case 'select':
                    case 'select2': // left for backward compatibility
                        if (is_array($uDataValue)) {
                            $first = true;
                            foreach ($uDataValue as $dValue) {
                                $nl = $first ? '' : $dl->nl;
                                $tplElements['ele_value'] = $nl . $dValue;
                            }
                        } else {
                            $tplElements['ele_value'] = $uDataValue;
                        }
                        break;

                    default:
                        $tplElements['ele_value'] = '&nbsp;';
                        break;
                }
            } else {
                $tplElements['ele_value'] = '&nbsp;';
            }
            $firstRow = false;
            $xformsTpl->append('elements', $tplElements);
        }
        $tableData = $xformsTpl->fetch($dl->_template);
//        header('Content-Type: application/force-download');
        header('Content-Type: ' . $dl->_mime); // don't lie to browser, hope they do the right thing
        header('Content-Disposition: attachment; filename=report_form_' . $formId . '_' . $dl->_type . '.' . $dl->_ext);
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Transfer-Encoding: binary');
        echo $tableData;
        exit();
        break;

    default: // Show list of forms with reports
        require __DIR__ . '/admin_header.php';
        /**
         * @var string $moduleDirName // defined in ./include/common.php
         * @var string $mypathIcon16  // defined in ./include/common.php
         */
        $myts = \MyTextSanitizer::getInstance();

        xoops_cp_header();
        Xforms\load_css();

        $adminObject->displayNavigation($thisFileName);

        // Get forms that have data in the Userdata table
        $uDataHandler = $helper->getHandler('UserData');
        $fields = array('form_id');
        $criteria = new \CriteriaCompo();
        $criteria->setGroupBy('form_id');
        $uDataForms = $uDataHandler->getAll($criteria, $fields, false, false);
        $formList = array();
        foreach ($uDataForms as $uData) {
            $formList[] = (int)$uData['form_id'];
        }

        // Get all those forms from the Form table
        $perpage = (int)$helper->getConfig('perpage'); // get number of items to show per page

        $xformsDisplay          = new \stdClass;
        $xformsDisplay->start   = Request::getInt('start', 0);
        $xformsDisplay->perpage = ($perpage > 0) ? $perpage: Constants::FORMS_PER_PAGE_DEFAULT;
        $xformsDisplay->order   = 'ASC';
        $xformsDisplay->sort    = 'form_order';


        $criteria = new \CriteriaCompo();
        if (!$showAll) {
            $criteria->add(new \Criteria('form_active', Constants::FORM_ACTIVE));
        }
        $criteria->add(new \Criteria('form_id', '(' . implode(',', $formList) . ')', 'IN'));
        $criteria->setSort($xformsDisplay->sort);
        $criteria->order = $xformsDisplay->order;
        $ttlFormCount = $formsHandler->getCount($criteria); // count all forms with reports

        // Get the forms we want
        $criteria->setStart($xformsDisplay->start);
        $criteria->setLimit($xformsDisplay->perpage);
        $forms = $formsHandler->getAll($criteria);

        $formList = '<select name="form_id" id="inputSel" size="1" style="width: 25em;">';
        foreach ($forms as $formItem) {
            $formList .= '<option value="' . $formItem->getVar('form_id') . '">'
                       .    $formItem->getVar('form_title', 's')
                       . '</option>';
        }
        $formList .= '</select>';

        $formsCount = ((false === $forms) && (count($forms) <= 0)) ? 0 : count($forms);
        if ($formsCount > 0) {
            $adminObject->addItemButton(_AM_XFORMS_REPORT_PURGE, "{$thisFileName}?op=purge", 'delete');
            $adminObject->displayButton();

            echo '<table class="outer"><tr><td>'
               . '<form action="' . $thisFileName . '" method="GET">'
               . '  <input type="hidden" name="op" value="show">'
               . '  <table class="outer width100 bspacing1">'
               . '    <tr>'
               . '      <td class="foot left">'
               . '        <label for="inputID">' . _AM_XFORMS_ENTER_ID . '</label>'
               . '        <input type="number" name="form_id" size="5"" min="1" id="inputID" style="width: 5em;">'
               . '        <input type="submit" value="' . _AM_XFORMS_SHOW_REPORT . '">'
               . '      </td>'
               . '    </tr>'
               . '  </table>'
               . '</form>'
               . '</td</tr>'
               . '<form action="' . $thisFileName . '" method="GET">'
               . '  <input type="hidden" name="op" value="show">'
               . '  <table class="outer width100 bspacing1">'
               . '    <tr>'
               . '      <td class="foot left">'
               . '        <label for="inputSel">' . _AM_XFORMS_SHOW_BY_TITLE . '</label>'
               . '          ' . $formList
               . '        <input type="submit" value="' . _AM_XFORMS_SHOW_REPORT . '">'
               . '      </td>'
               . '    </tr>'
               . '  </table>'
               . '</form>'
               . '</td</tr>'
               . '<tr><td>'
               . '</table>';
        }

        // Display the form listing table
        echo '<form action="' . $thisFileName . '" method="POST">'
           . '  <table class="outer width100 bspacing1">'
           . '    <thead>'
           . '    <tr><th class="middle line140" colspan="5">' . _AM_XFORMS_LISTING . '</th></tr>'
           . '    <tr>'
           . '      <td class="head center bottom width5">' . _AM_XFORMS_ID . '</td>'
           . '      <td class="head center bottom">' . _AM_XFORMS_TITLE . '</td>'
           . '      <td class="head center bottom width5">' . _AM_XFORMS_STATUS . '</td>'
           . '      <td class="head center bottom width15">' . _AM_XFORMS_SENDTO . '</td>'
           . '      <td class="head center bottom width10">' . _AM_XFORMS_ACTION . '</td>'
           . '    </tr>'
           . '    </thead>'
           . '    <tbody>';

        if ($forms) {
            $cssClass = 'even';
            $groupHandler = xoops_getHandler('group');
            foreach ($forms as $f) {
                if ($showAll || $f->isActive()) {
                    $id     = $f->getVar('form_id');
                    $sendTo = $f->getVar('form_send_to_group');
                    if (-1 == (int)$sendTo) {
                        $sendTo = '<b>' . _AM_XFORMS_SENDTO_OTHER . ': </b>' . $f->getVar('form_send_to_other');
                    } else {
                        if ((false !== $sendTo) && ($group = $groupHandler->get($sendTo))) {
                            $sendTo = $group->getVar('name');
                        } else {
                            $sendTo = _AM_XFORMS_SENDTO_ADMIN;
                        }
                    }
                    $fStatus = '<img src="' . $mypathIcon16 . '/active.gif" '
                             .   'title="' . _AM_XFORMS_STATUS_ACTIVE . '" '
                             .   'alt="' . _AM_XFORMS_STATUS_ACTIVE . '"'
                             . '>'
                             . '&nbsp;' . _AM_XFORMS_STATUS_ACTIVE;
                    if (!$f->isActive()) {
                        if (Constants::FORM_INACTIVE == $f->getVar('form_active')) {
                            $fStatus = '<img src="' . $mypathIcon16 . '/inactive.gif" '
                                     .   'title="' . _AM_XFORMS_STATUS_INACTIVE . '" '
                                     .   'alt="' . _AM_XFORMS_STATUS_INACTIVE . '"'
                                     . '>'
                                     . '&nbsp;' . _AM_XFORMS_STATUS_INACTIVE;
                        } else {
                            $fStatus = '<img src="' . $mypathIcon16 . '/expired.gif" '
                                     .   'title="' . _AM_XFORMS_STATUS_EXPIRED . '" '
                                     .   'alt="' . _AM_XFORMS_STATUS_EXPIRED . '"'
                                     . '>'
                                     . '&nbsp;' . _AM_XFORMS_STATUS_EXPIRED;
                        }
                    }
                    $cssClass = ('even' === $cssClass) ? 'odd' : 'even';
                    echo '<tr>'
                       . '  <td class="' . $cssClass . ' center">' . $id . '</td>'
                       . '  <td class="' . $cssClass . '">'
                       . '    <a target="_blank" '
                       .        'href="' . $helper->url('index.php?form_id=' . $id) . '">'
                       .          $f->getVar('form_title')
                       .     '</a><br>'
                       . '   ' . Xforms\getHtml($f->getVar('form_desc', 's'))
                       . '  </td>'
                       . '  <td class="' . $cssClass . ' center">' . $fStatus . '</td>'
                       . '  <td class="' . $cssClass . ' center">' . $sendTo . '</td>'
                       . '  <td class="' . $cssClass . ' center">';
                    if (0 !== (int)$f->getVar('form_save_db')) {
                        echo '<a href="' . $thisFileName . '?op=show&form_id=' . $id . '">'
                           .   '<img src="' . $mypathIcon16 . '/rptsee.png" '
                           .     'class="tooltip floatcenter1" '
                           .     'title="' . _AM_XFORMS_SHOW_REPORT . '" '
                           .     'alt="' . _AM_XFORMS_SHOW_REPORT . '"'
                           .   '>'
                           . '</a>&nbsp;'
                           . '<a href="' . $thisFileName . '?op=export-horiz&format=c&form_id=' . $id . '">'
                           .   '<img src="' . $mypathIcon16 . '/rpthorizc.png" '
                           .     'class="tooltip floatcenter1" '
                           .     'title="' . _AM_XFORMS_RPT_EXPORT_CH . '" '
                           .     'alt="' . _AM_XFORMS_RPT_EXPORT_CH . '"'
                           .   '>'
                           . '</a>&nbsp;'
                           . '<a href="' . $thisFileName . '?op=export-horiz&format=h&form_id=' . $id . '">'
                           .   '<img src="' . $mypathIcon16 . '/rpthor.png" '
                           .     'class="tooltip floatcenter1" '
                           .     'title="' . _AM_XFORMS_RPT_EXPORT_HH . '" '
                           .     'alt="' . _AM_XFORMS_RPT_EXPORT_HH . '"'
                           . '>'
                           . '</a>&nbsp;'
                           . '<a href="' . $thisFileName . '?op=export-vert&format=c&form_id=' . $id . '">'
                           .   '<img src="' . $mypathIcon16 . '/rptvertc.png" '
                           .     'class="tooltip floatcenter1" '
                           .     'title="' . _AM_XFORMS_RPT_EXPORT_CV . '" '
                           .     'alt="' . _AM_XFORMS_RPT_EXPORT_CV . '"'
                           . '>'
                           . '</a>&nbsp;'
                           . '<a href="' . $thisFileName . '?op=export-vert&format=h&form_id=' . $id . '">'
                           .   '<img src="' . $mypathIcon16 . '/rptvert.png" '
                           .     'class="tooltip floatcenter1" '
                           .     'title="' . _AM_XFORMS_RPT_EXPORT_HV . '" '
                           .     'alt="' . _AM_XFORMS_RPT_EXPORT_HV . '"'
                           . '>'
                           . '</a>&nbsp;'
                           . '<a href="' . $thisFileName . '?op=purge&form_id=' . $id . '">'
                           .   '<img src="' . $mypathIcon16 . '/corbeille.png" '   //editcut
                           .     'class="tooltip floatcenter1" '
                           .     'title="' . _AM_XFORMS_RPT_PURGE_REPORT . '" '
                           .     'alt="' . _AM_XFORMS_RPT_PURGE_REPORT . '"'
                           . '>'
                           . '</a>';
                    } else {
                        echo '<b>' . _AM_XFORMS_FORM_NOTSAVE . '</b>'
                           . '<a href="'
                           .    $GLOBALS['xoops']->buildUrl('/modules/xforms/admin/main.php',
                                                            array('op' => 'edit', 'form_id' => $id))
                           . '">'
                           .   '<img src="' . \Xmf\Module\Admin::iconUrl('edit.png', '16') . '" '
                           .     'title="' . _AM_XFORMS_ACTION_EDITFORM . '" '
                           .     'alt="' . _AM_XFORMS_ACTION_EDITFORM . '"'
                           .   '>'
                           . '</a>';
                    }
                    echo '</tr>';
                }
            }
            $bshow = new \XoopsFormButton('', ($showAll ? 'shownormal' : 'showall'), ($showAll ? _AM_XFORMS_SHOW_NORMAL_FORMS : _AM_XFORMS_SHOW_ALL_FORMS), 'submit');
            echo '<tr>'
               . '  <td class="foot">&nbsp;</td>'
               . '  <td class="foot" colspan="5">' . $bshow->render() . '</td>'
               . '</tr>'
               . '</tbody>'
               . '</table><br>'
               . '</form>';

            if ($ttlFormCount > $xformsDisplay->perpage) {
                xoops_load('pagenav');
                $xformsPagenav = new \XoopsPageNav($ttlFormCount, $xformsDisplay->perpage, $xformsDisplay->start, 'start', 'perpage=' . $xformsDisplay->perpage);
                echo '<div class="center middle larger width100 line160">' . $xformsPagenav->renderNav() . '</div>';
            }

            echo '<fieldset><legend class="bold" style="color: #900;">' . _AM_XFORMS_STATUS_INFORMATION . '</legend>'
               . '<div class="pad7">'
               . '  <div class="center">'
               . '    <img src="' . $mypathIcon16 . '/active.gif">&nbsp;' . _AM_XFORMS_STATUS_ACTIVE . '&nbsp; &nbsp; &nbsp;'
               . '    <img src="' . $mypathIcon16 . '/inactive.gif">&nbsp;' . _AM_XFORMS_STATUS_INACTIVE . '&nbsp; &nbsp; &nbsp;'
               . '    <img src="' . $mypathIcon16 . '/expired.gif">&nbsp;' . _AM_XFORMS_STATUS_EXPIRED
               . '  </div>'
               . '</div>'
               . '</fieldset>';

        } else {
            /*Show 'No forms' message*/
            $bshow = new \XoopsFormButton('', ($showAll ? 'shownormal' : 'showall'), ($showAll ? _AM_XFORMS_SHOW_NORMAL_FORMS : _AM_XFORMS_SHOW_ALL_FORMS), 'submit');
            echo '<tr>'
               . '  <td class="odd center" colspan="6">' . _AM_XFORMS_NO_FORMS_TOREPORT . '</td>'
               . '</tr>'
               . '<tr>'
               . '  <td class="foot">&nbsp;</td>'
               . '  <td class="foot" colspan="5">' . $bshow->render() . '</td>'
               . '</tr>'
               . '</tbody>'
               . '</table><br>'
               . '</form>';
        }
        break;
}
include __DIR__ . '/admin_footer.php';
xoops_cp_footer();
