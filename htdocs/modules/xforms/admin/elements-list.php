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

$op = Request::getCmd('op', '', 'POST');
$myts = \MyTextSanitizer::getInstance();

        $formId = Request::getInt('form_id', Constants::FORM_NOT_VALID, 'GET');
        $formId = (int)$formId; // to fix Request bug in XOOPS < 2.5.9
        if (empty($formId)) {
            $helper->redirect('admin/main.php', Constants::REDIRECT_DELAY_NONE, _AM_XFORMS_NOTHING_SELECTED);
        }
        /* @var \XoopsModules\Xforms\Forms $form */
        $form = $formsHandler->get($formId);

        xoops_cp_header();
        Xforms\load_css();

        /* @var \Xmf\Module\Admin $adminObj */
        $adminObject->displayNavigation('elements.php');
        $formSelect = new \XoopsFormSelect('', 'ele_type');
        $formSelect->addOptionArray($xformsEleHandler->getValidElements());
        $hiddenOpAdd   = new \XoopsFormHidden('op', 'edit');
        $hiddenOp   = new \XoopsFormHidden('op', 'save-list');
        $hiddenId   = new \XoopsFormHidden('form_id', $formId);
        $formButton = new \XoopsFormButton('', 'submit', _ADD, 'submit');

        echo '<div class="center">'
           . '  <form action="' . $helper->url('admin/elements.php') . '" method="post">'
           . '    <b>' . _AM_XFORMS_ELE_CREATE . '</b>:'
           . $hiddenOpAdd->render()
           . $formSelect->render()

           . $hiddenId->render()
           . $formButton->render()
           . '  </form>'
           . '</div>'
           . '<form action="' . $_SERVER['SCRIPT_NAME'] . '" method="post">'
          
             /** var XoopsSecurity $xoopsSecurity */
           . $xoopsSecurity->getTokenHTML()
           . '<table class="outer width100 bspacing1">'
           . '  <thead>'
           . '  <tr><th colspan="7">' . sprintf(_AM_XFORMS_ELEMENTS_OF_FORM, $form->getVar('form_title')) . '</th></tr>'
           . '  <tr>'
           . '    <th class="center">' . _AM_XFORMS_ELE_CAPTION . ' / ' . _AM_XFORMS_ELE_DEFAULT . '</th>'
           . '    <th class="center">#</th>'
           . '    <th class="center">' . _AM_XFORMS_ELE_TYPE . '</th>'
           . '    <th class="center width10">' . _AM_XFORMS_ELE_REQ . '</th>'
           . '    <th class="center">' . _AM_XFORMS_ELE_ORDER . '</th>'
           . '    <th class="center">' . _AM_XFORMS_ELE_DISPLAY_ROW . '</th>'
           . '    <th class="center width10">' . _AM_XFORMS_ELE_DISPLAY . '</th>'
           . '    <th class="center">' . _AM_XFORMS_ACTION . '</th>'
           . '  </tr>'
           . '  </thead>'
           . '  <tbody>';

        $criteria = new \Criteria('form_id', $formId);
        $criteria->setSort('ele_order ASC, ele_caption');  // trick criteria to allow 2 sort criteria
        $criteria->order = 'ASC';

        /* @var \XoopsModules\Xforms\ElementHandler $xformsEleHandler */
        if ($elements = $xformsEleHandler->getObjects($criteria)) {
            foreach ($elements as $eleObj) {
                $renderer  = new ElementRenderer($eleObj);
                $eleValue  = $renderer->constructElement(true, $form->getVar('form_delimiter'));
                unset($renderer);

                $id        = $eleObj->getVar('ele_id');
                $dispType  = new \XoopsFormLabel('', ucwords($eleObj->getVar('ele_type')));
                $checkReq  = new \XoopsFormRadioYN('', 'ele_req[' . $id . ']', $eleObj->getVar('ele_req'));
                $txtOrder  = new FormInput('', 'ele_order[' . $id . ']', 5, 5, $eleObj->getVar('ele_order'), null, 'number');
                $txtOrder->setAttribute('min', 0);
                $txtOrder->setExtra('style="width: 5em;"');
                $checkDisp = new \XoopsFormRadioYN('', 'ele_display[' . $id . ']', $eleObj->getVar('ele_display'));
                $checkDispRow = new \XoopsFormCheckBox('', 'ele_display_row[' . $id . ']', $eleObj->getVar('ele_display_row'));
                $checkDispRow->addOption(2, ' ');
//                $hidden_id = new \XoopsFormHidden('ele_id[]', $id);
                $myts = \MyTextSanitizer::getInstance();
                echo '  <tr>'
                   . '    <td class="odd">' . Xforms\getHtml($eleObj->getVar('ele_caption'), Constants::ALLOW_HTML) . '</td>' //JJDai
                   . '    <td class="even center middle" rowspan="2">' . $id . '</td>'
                   . '    <td class="even center middle" rowspan="2">' . $dispType->render() . '</td>'
                   . '    <td class="even center middle" rowspan="2">' . $checkReq->render() . '</td>'
                   . '    <td class="even center middle" rowspan="2">' . $txtOrder->render() . '</td>'
                   . '    <td class="even center middle" rowspan="2">' . $checkDispRow->render() . '</td>'
                   . '    <td class="even center middle" rowspan="2">' . $checkDisp->render()
                            //replaced $hidden_id->render() so that id's will be unique not true with XoopsFormHidden for arrays
                   . '      <input type="hidden" name="ele_id[]" id="ele_id_' . $id . '" value=' . $id . '>'
                   . '    </td>'
                   . '    <td class="even center middle" nowrap="nowrap" rowspan="2">'
                   . '      <a href="' . $helper->url('admin/elements.php?op=edit&amp;ele_id=' . $id . '&amp;form_id=' . $formId) . '">'
                   .    '<img src="' . Admin::iconUrl('edit.png', '16') . '" class="tooltip floatcenter1" title="' . _EDIT . '"></a>'
                   . '      <a href="' . $helper->url('admin/elements.php?op=edit&amp;ele_id=' . $id . '&amp;form_id=' . $formId . '&amp;clone=1') . '">'
                   .    '<img src="' . Admin::iconUrl('editcopy.png', '16') . '" class="tooltip floatcenter1" title="' . _CLONE . '"></a>'
                   . '      <a href="' . $helper->url('admin/elements.php?op=delete&amp;ele_id=' . $id . '&amp;form_id=' . $formId) . '">'
                   .    '<img src="' . Admin::iconUrl('delete.png', '16') . '" class="tooltip floatcenter1" title="' . _DELETE . '"></a>'
                   . '    </td>'
                   . '  </tr>';

                switch ($eleObj->getVar('ele_type')) {
                    case 'html':
                        //affichage dans la liste des elements d'un formulaire, previsualisation et modification via le bouton en bas
                    case 'html':
                        //affichage dans la liste des elements d'un formulaire, prvisualisation et modification via le bouton en bas
                        echo '  <tr><td class="odd" id="html_' . $id . '">' .$eleValue->render() . '</td></tr>';
                        break;
/*
                    case 'label':
                        echo '  <tr><td class="odd">&nbsp;</td></tr>';
                        break;
*/
                    default:
                        echo '  <tr><td class="odd">' . $eleValue->render() . '</td></tr>';
                        break;
                }
/*
                if ('html' !== $eleObj->getVar('ele_type')) {
                    echo '  <tr><td class="odd">' . $eleValue->render() . '</td></tr>';
                } else {
                    echo '  <tr><td class="odd" id="html_' . $id . '">' . $myts->displayTarea($eleValue->render(), Constants::ALLOW_HTML) . '</td></tr>';
//                    echo '  <tr><td class="odd">' . $myts->displayTarea($eleObj->getVar('ele_value'), Constants::ALLOW_HTML) . '</td></tr>';
                }
*/
            }
        }

        $submit  = new \XoopsFormButton('', 'submit', _AM_XFORMS_SAVE, 'submit');
        $submit1 = new \XoopsFormButton('', 'submit', _AM_XFORMS_SAVE_THEN_FORM, 'submit');
        $submit2 = new \XoopsFormButton('', 'gotoform', _AM_XFORMS_GOTO_FORM);
        $submit2->setExtra("onclick=\"window.location.href='" . $helper->url('index.php?form_id=' . $formId) . "'\"");
        $submit3 = new \XoopsFormButton('', 'gotoform', _CANCEL);
        $submit3->setExtra("onclick=\"window.location.href='" . $helper->url('admin/main.php') . "'\"");
        $tray    = new \XoopsFormElementTray('');
        $tray->addElement($submit);
        $tray->addElement($submit1);
        $tray->addElement($submit2);
        $tray->addElement($submit3);
        echo '  </tbody>'
           . '  <tfoot>'
           . '  <tr>'
           . '    <td class="foot center" colspan="7">' . $tray->render() . '</td>'
           . '  </tr>'
           . '  </tfoot>'
           . '</table>';
        $hiddenOp     = new \XoopsFormHidden('op', 'save-list');
        $hiddenFormId = new \XoopsFormHidden('form_id', $formId);
        echo $hiddenOp->render()
           . $hiddenFormId->render()
           . '</form>';


