<?php
/** @var Extcal\Helper $helper */
//$helper = Xforms\Helper::getInstance();
use XoopsModules\Xforms\Constants;
use XoopsModules\Xforms\Helper as xHelper;
//use Xmf\Module\Helper\Session;

require dirname(__DIR__) . '/preloads/autoloader.php';
include_once "admin_header.php";

//$helper = xHelper::getInstance();

//         xoops_cp_header();
//         /* @var \Xmf\Module\Admin $adminObject */
//         $adminObject->displayNavigation(basename(__FILE__));
//         //$adminObject->addItemButton(_AM_XFORMS_NEW, basename(__FILE__) . '?op=edit', 'add');
//         $adminObject->displayButton('left');
//echo "===>item<pre>" . print_r($_POST, true) . "</pre>";
    $reponse = $_POST['reponse'];

//--------------------------------------------------
//recupe du groupe a mettre en copie
// $formId = $reponse['form_id'];
//     $form = $formsHandler->get($formId);
//     $send_group = (int)$form->getVar('form_send_to_group');
//     $group      = false;
//     if (-1 !== $send_group) {
//         $group = $member_handler->getGroup($send_group);
//     }
// echo "===>groupe en copie<pre>" . print_r($group, true) . "</pre>";
// echo 'email-admin : ' . $GLOBALS['xoopsConfig']['adminmail'] . '<br>';
//  echo 'site name : ' . $GLOBALS['xoopsConfig']['sitename'] . '<br>';
//  exit;
//--------------------------------------------------
//   if (!$GLOBALS['xoopsSecurity']->check()) {
//       redirect_header('index.php', 3, _NOPERM . '<br>' . implode('<br>', $GLOBALS['xoopsSecurity']->getErrors()));
//   }
   xoops_cp_header();
//   adminMenu(1);
  $myts        = \MyTextSanitizer::getInstance();
  $xoopsMailer = xoops_getMailer();
  $xoopsMailer->reset();
  $xoopsMailer->useMail();
  $xoopsMailer->setHTML();
  $mailCharset = $helper->getConfig('mail_charset');
  $charset = !empty($mailCharset) ? $mailCharset : _CHARSET;
  $xoopsMailer->charSet = $charset;

  //$xoopsMailer->setFromName($myts->oopsStripSlashesGPC('jj delalandre'));
  //$xoopsMailer->setFromEmail($myts->oopsStripSlashesGPC('jjdelalandre@orange.fr'));
  $xoopsMailer->setFromName($GLOBALS['xoopsConfig']['sitename']);
  $xoopsMailer->setFromEmail($GLOBALS['xoopsConfig']['adminmail']);
/*
  $xoopsMailer->setToUsers($reponse['email']);
//--------------------------------------------------
  $xoopsMailer->setSubject($myts->oopsStripSlashesGPC($reponse['objet']));
  $xoopsMailer->setBody($myts->oopsStripSlashesGPC($reponse['message']));
                //$xoopsMailer->setBody($myts->oopsStripSlashesGPC($_POST['mail_body']));
                $xoopsMailer->useMail();
                $xoopsMailer->send(true);

exit;
*/


    $email=$reponse['email'];
    $subject=$reponse['objet'];
    $body = $myts->stripSlashesGPC($reponse['message']);
    $headers="headers";
    $xoopsMailer->sendMail($email, $subject, $body, $headers);

  echo $xoopsMailer->getSuccess();
  $ret = $xoopsMailer->getErrors();
if ($xoopsMailer->getErrors()){
  redirect_header("contact.php?op=list", 3, implode('<br>', $xoopsMailer->getErrors()));
}else{

    //-------------------------
    //change le status de message
    //------------------------------------------------------------------------------
    $criteria = new \CriteriaCompo();
    $criteria->add(new \Criteria('uform_id', $reponse['uform_id'], '='));


    //$uFormHandler = $helper->getHandler('UserForm');
    $uform = $uFormHandler->get($reponse['uform_id']);
    $status = $uform->getVar('uform_status')+1;  //nombre de reponse en cours
    $uform->setVar('uform_status', $status);

    $histo = $uform->getVar('uform_answer') . "<hr>" . _AM_XFORMS_STATUS_ANSWER . " n° {$status} : " . $reponse['message'];
    $uform->setVar('uform_answer', $histo);
    //$criteria->setGroupBy('uform_id');
    $uFormHandler->insert($uform);


$link = "contact.php?op=list&form_id={$reponse['form_id']}";
  redirect_header($link, 3, _AM_XFORMS_MES_IS_SENDING);

  //$helper->redirect($link, Constants::REDIRECT_DELAY_MEDIUM, _AM_XFORMS_MES_IS_SENDING);
  //$helper->redirect($link, 3, _AM_XFORMS_MES_IS_SENDING);
}

// include __DIR__ . '/admin_footer.php';
// xoops_cp_footer();




?>