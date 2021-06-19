<?php

use XoopsModules\Xforms;
$templateMain = 'admin/xforms_contact-list.tpl';
$GLOBALS['xoopsOption']['template_main'] =  $templateMain;   
     
        xoops_cp_header();
        /* @var \Xmf\Module\Admin $adminObject */
        $adminObject->displayNavigation(basename(__FILE__));
        //$adminObject->addItemButton(_AM_XFORMS_NEW, basename(__FILE__) . '?op=edit', 'add');
        $adminObject->displayButton('left');


        // ---------- Liste des fomulaire de contact

        $criteria = new \CriteriaCompo();
        $criteria->add(new \Criteria('form_answer', 1, '='));
        $forms = $formsHandler->getList($criteria, "form_id,form_title", false, true);

        $selectForm = new \XoopsFormSelect(_AM_XFORMS_LISTING_CONTACT, 'form_id', $formId);
        $selectForm->setExtra('onchange="this.form.submit()"');
        $selectForm->addOption(0, "*");
        foreach($forms as $id=>$title){
             $selectForm->addOption($id, $title);
        }
        $GLOBALS['xoopsTpl']->assign('selectForm', $selectForm->render());
        //---------------------------------------------------------------





        /* @var \XoopsModules\Xforms\Helper $helper */
        $perpage = (int)$helper->getConfig('perpage'); // Get # of forms to show per page

        // Group all the page items together
//         $xformsDisplay = new \stdClass;
//         $xformsDisplay->start   = Request::getInt('start', 0);
//         $xformsDisplay->perpage = ($perpage > 0) ? $perpage: Constants::FORMS_PER_PAGE_DEFAULT;
//         $xformsDisplay->order   = 'ASC';
//         $xformsDisplay->sort    = 'form_order';

        Xforms\load_css();



 //echo "===>forms<pre>" . print_r($forms, true) . "</pre>";
    $banishHandler = $helper::getInstance()->getHandler('banish');

      //------------------------------------------------------------------------------
      $criteria = new \CriteriaCompo();
      $criteria->add(new \Criteria('uform_id', 0, '>'));
      if ($formId > 0) $criteria->add(new \Criteria('form_id', $formId, '='));

      $criteria->setSort('uform_id','DESC');
      $criteria->setOrder('DESC');
      $uFormHandler = $helper->getHandler('UserForm');
      $uForms = $uFormHandler->getAll($criteria);
      //$criteria->setGroupBy('uform_id');
      
      $ligne  = '';
      $messages = array();
 
      foreach ($uForms as $id=>$uForm){
          $message = array();
          $message['uform_id'] = $uForm->getVar('uform_id');
          $message['form_id'] = $uForm->getVar('form_id');
          $message['form_name'] = $forms[$uForm->getVar('form_id')]; 
          
          $message['chrono'] = $uForm->getVar('uform_chrono');
          $message['user'] = $uForm->getVar('uform_user');


          
          $message['email'] = $uForm->getVar('uform_email');      
          //$email = $uForm->getVar('uform_email');      
          $message['isBanish'] = $banishHandler->is_banish(trim($message['email']), false);      
          //$isBanish = $banishHandler->is_banish(trim($email), false);      
          $message['color'] = $message['isBanish'] ? 'red': 'black';      
          //$color = $message['isBanish'] ? 'red': 'black';      

          $ligne  = ($ligne == "odd") ? 'even': 'odd';
          $message['ligne'] = $ligne;      
          //$message['color'] = $color;      

          $object = $uForm->getVar('uform_object');
          if (strlen($object) > 36){
            //JJDai affiche jusqu'au premier espace trouvé apres ## caracteres
            $h= stripos($object, " ", 36);  
            if ($h > 0){$object = substr($object, 0, $h) . "...";}
          }
          $message['object'] = $object;

          if ($uForm->getVar('uform_status') == 0){
            $status = "<span style='color:red;'>" . _AM_XFORMS_STATUS_WAITING . "</span>";
          }else{
            $status = "<span style='color:green;'>" . $uForm->getVar('uform_status') . " " . _AM_XFORMS_STATUS_ANSWERS . "</span>";
          }
          //echo "    <td class='{$ligne} center'>" .  $uForm->getVar('uform_status') .'</td>';
          $message['status'] = $status;
          

          //------ Boutons d'actions --------------------------------------

          $link = "contact.php?op=view&form_id={$uForm->getVar('form_id')}&uform_id={$uForm->getVar('uform_id')}";
            $img = \Xmf\Module\Admin::iconUrl('view.png', '16');
            $title = _AM_XFORMS_ACTION_VIEW_EMAIL;
            $actionView = "<a href='{$link}'><img src='{$img}'  title='{$title}' alt='{$title}'></a>";
          if ($uForm->getVar('uform_status') == 0){
          }


          $link = "contact.php?op=answer&form_id={$uForm->getVar('form_id')}&uform_id={$uForm->getVar('uform_id')}";
          if ($uForm->getVar('uform_status') == 0){
            $img = \Xmf\Module\Admin::iconUrl('mail_new.png', '16');
            $title = _AM_XFORMS_ACTION_SEND_ANSWER;
            $actionMail = "<a href='{$link}'><img src='{$img}'  title='{$title}' alt='{$title}'></a>";
          }else{
            $img = \Xmf\Module\Admin::iconUrl('mail_forward.png', '16');
            $title = _AM_XFORMS_ACTION_ANSWER_IS_SEND;
            if (true){  //Pour les tests en dev
              $actionMail = "<a href='{$link}'><img src='{$img}'  title='{$title}' alt='{$title}'></a>";
            }else{
              $actionMail = "<img src='{$img}'  title='{$title}' alt='{$title}'>";
            }
          }

          $link = "contact.php?op=delete&form_id={$uForm->getVar('form_id')}&uform_id={$uForm->getVar('uform_id')}";
          $img = \Xmf\Module\Admin::iconUrl('delete.png', '16');
          $title = _AM_XFORMS_ACTION_DELETE_MAIL;
          $actionDelete = "<a href='{$link}'><img src='{$img}'  title='{$title}' alt='{$title}'></A>";
          
          // ---------- banish -------------------
          if ($message['isBanish']){
                $img = \Xmf\Module\Admin::iconUrl('mail_delete.png', '16');
                $action="unbanish";
                $title = _AM_XFORMS_ACTION_UNBANISH_MAIL;
          }else{
                $img = \Xmf\Module\Admin::iconUrl('mail_forward.png', '16');
                $action="banish";
                $title = _AM_XFORMS_ACTION_BANISH_MAIL;
          }
          $link = "contact.php?op=banish&form_id={$uForm->getVar('form_id')}&uform_id={$uForm->getVar('uform_id')}&email={$message['email']}&action={$action}";
          $actionBanish = "<a href='{$link}'><img src='{$img}'  title='{$title}' alt='{$title}'></A>";

          $message['view'] = $actionView;
          $message['mail'] = $actionMail;
          $message['delete'] = $actionDelete;
          $message['banish'] = $actionBanish;
          
          //-------------------------------------
          $messages[] = $message;
    }
//global $xformsTpl;  
//echo "<hr><pre>" . print_r($messages, true) . "</pre><hr>"; 
    $GLOBALS['xoopsTpl']->assign('messages', $messages);
      //======================================================================
?>