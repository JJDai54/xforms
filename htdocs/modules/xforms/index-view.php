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
 * @package   \XoopsModules\Xforms\frontside
 * @author    XOOPS Module Development Team
 * @copyright Copyright (c) 2001-2019 {@link https://xoops.org XOOPS Project}
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 * @since     1.30
 */
use Xmf\Request;
use XoopsModules\Xforms;
use XoopsModules\Xforms\Constants;
use XoopsModules\Xforms\Captcha;
use XoopsModules\Xforms\Utility;
use XoopsModules\Xforms\MediaUploader;
use Xmf\FilterInput;


$submit = Request::getCmd('submit', '', 'POST');
            require_once $GLOBALS['xoops']->path('/header.php');
            Xforms\load_css();

begin_proc:

//affichage du formulaire
//echo 'Nouvelle fiche<hr>';

    $formId = Request::getInt('form_id', 0, 'GET');
// echo "<hr>form_id = {$formId}<br>POST : <pre>". print_r($_POST, true)  . "</pre>";
// echo "<hr>form_id = {$formId}<br>POST : <pre>". print_r($_FILES, true)  . "</pre>";

    if (empty($formId)) {
        /*******************   Nouvelle Fiche ***********************/
        if (Constants::FORM_LIST_NO_SHOW === (int)$helper->getConfig('showforms')) {
            // Don't show the forms available if no parameter set
            //pas besoin de message sur cette redirection
            //voir : 'showforms', "Oui - les formulaires disponibles pour l'utilisateur seront affichés sur la page d'index."
            //"Non - l'utilisateur sera envoyé à la page d'accueil du site si aucun formulaire spécifique n'est sélectionné.");
            redirect_header($GLOBALS['xoops']->url('www'), Constants::REDIRECT_DELAY_MEDIUM, '');
        }
        /* @var \XoopsModules\Xforms\FormsHandler $formsHandler */
        $forms = $formsHandler->getPermittedForms();
        if ((false !== $forms) && (1 == count($forms))) {
            /*************   affichage en saisie du form sélectionné  ************/
            $form = $formsHandler->get($forms[0]->getVar('form_id')); 
            if (!$assignedArray = $form->render()) {                             // <<===================
                redirect_header($GLOBALS['xoops']->url('www'), Constants::REDIRECT_DELAY_LONG, $form->getHtmlErrors());
            }
            if (Constants::FORM_DISPLAY_STYLE_FORM == $form->getVar('form_display_style')) {
                $GLOBALS['xoopsOption']['template_main'] = 'xforms_form.tpl';
            } else {
                $GLOBALS['xoopsOption']['template_main'] = 'xforms_form_poll.tpl';
            }
            require_once $GLOBALS['xoops']->path('/header.php');
            Xforms\load_css();
            $GLOBALS['xoTheme']->addStylesheet('browse.php?modules/' . $moduleDirName . '/assets/css/jquery-ui.min.css');
            $GLOBALS['xoTheme']->addStylesheet('browse.php?modules/' . $moduleDirName . '/assets/css/jquery-ui.structure.min.css');
            $GLOBALS['xoTheme']->addStylesheet('browse.php?modules/' . $moduleDirName . '/assets/css/jquery-ui.theme.min.css');
            $GLOBALS['xoTheme']->addScript('browse.php?modules/' . $moduleDirName . '/assets/js/modernizr-custom.js');
            $GLOBALS['xoTheme']->addScript('browse.php?Frameworks/jquery/jquery.js');
            $GLOBALS['xoTheme']->addScript('browse.php?Frameworks/jquery/plugins/jquery.ui.js');
            $GLOBALS['xoopsTpl']->assign($assignedArray);
        } else {
          /*****************     affichage de la liste des forms        ***********************/
            $GLOBALS['xoopsOption']['template_main'] = 'xforms_index.tpl';
            require_once $GLOBALS['xoops']->path('/header.php');
            if ((false !== $forms) && (count($forms) > 0)) {
                foreach ($forms as $form) {
                    $GLOBALS['xoopsTpl']->append('forms', array('title' => $form->getVar('form_title'),
                                                                 'desc' => Xforms\getHtml($form->getVar('form_desc')),
                                                                   'id' => $form->getVar('form_id'),
                                                       'form_edit_link' => $form->getEditLinkInfo(),
                                                            'color_set' => Xforms\get_color_set($form->getVar('form_color_set')))
                    );
                }
                $GLOBALS['xoopsTpl']->assign('forms_intro', Xforms\getHtml($helper->getConfig('intro'), 1));
            } else {
                $GLOBALS['xoopsTpl']->assign('noform', Xforms\getHtml($helper->getConfig('noform'), 1));
            }
        }
    } else {
        /* @var \XoopsModules\Xforms\FormsHandler $formsHandler */
        if (($form = $formsHandler->get($formId))
            && (false !== $formsHandler->getSingleFormPermission($formId)))
        {
            if (!$form->isActive()) {
                redirect_header($GLOBALS['xoops']->url('www'), Constants::REDIRECT_DELAY_MEDIUM, _MD_XFORMS_MSG_INACTIVE);
            }
            if (!$assignedArray = $form->render($_POST)) { //JJDai
                 redirect_header($GLOBALS['xoops']->url('www'), Constants::REDIRECT_DELAY_LONG, $form->getHtmlErrors());
            }
            if (Constants::FORM_DISPLAY_STYLE_FORM == $form->getVar('form_display_style')) {
                $GLOBALS['xoopsOption']['template_main'] = 'xforms_form.tpl';
            } else {
                $GLOBALS['xoopsOption']['template_main'] = 'xforms_form_poll.tpl';
            }
            require_once $GLOBALS['xoops']->path('/header.php');
            Xforms\load_css();
            $GLOBALS['xoTheme']->addStylesheet('browse.php?modules/' . $moduleDirName . '/assets/css/jquery-ui.min.css');
            $GLOBALS['xoTheme']->addStylesheet('browse.php?modules/' . $moduleDirName . '/assets/css/jquery-ui.structure.min.css');
            $GLOBALS['xoTheme']->addStylesheet('browse.php?modules/' . $moduleDirName . '/assets/css/jquery-ui.theme.min.css');
            $GLOBALS['xoTheme']->addScript('browse.php?modules/' . $moduleDirName . '/assets/js/modernizr-custom.js');
            $GLOBALS['xoTheme']->addScript('browse.php?Frameworks/jquery/jquery.js');
            $GLOBALS['xoTheme']->addScript('browse.php?Frameworks/jquery/plugins/jquery.ui.js');
            $GLOBALS['xoopsTpl']->assign($assignedArray);


        } else {
            redirect_header($GLOBALS['xoops']->url('www'), Constants::REDIRECT_DELAY_MEDIUM, _NOPERM);
        }
    }

    $GLOBALS['xoopsTpl']->assign('default_title', $helper->getConfig('dtitle')); // _MD_XFORMS_TITLE_MAIN
    require $GLOBALS['xoops']->path('/footer.php');
    exit();

/*
 * Redirect the user to the success page on send the form
 */
$whereto = $form->getVar('form_whereto');
$whereto = (!empty($whereto)) ? str_replace('{SITE_URL}', $GLOBALS['xoops']->url('www'), $whereto) : $GLOBALS['xoops']->url('www/index.php');
redirect_header($whereto, Constants::REDIRECT_DELAY_NONE, _MD_XFORMS_MSG_SENT);
