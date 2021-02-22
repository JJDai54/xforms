<?php

use XoopsModules\Xforms;

        xoops_cp_header();
        /* @var \Xmf\Module\Admin $adminObject */
        $adminObject->displayNavigation(basename(__FILE__));
        //$adminObject->addItemButton(_AM_XFORMS_NEW, basename(__FILE__) . '?op=edit', 'add');
        $adminObject->displayButton('left');


        // ---------- Liste des fomulaire de contact
        echo '<form action="contact.php?op=list" method="post">';
        $criteria = new \CriteriaCompo();
        $criteria->add(new \Criteria('form_answer', 1, '='));
        $forms = $formsHandler->getList($criteria, "form_id,form_title", false, true);

        $selectForm = new \XoopsFormSelect(_AM_XFORMS_LISTING_CONTACT, 'form_id', $formId);
        $selectForm->setExtra('onchange="this.form.submit()"');
        $selectForm->addOption(0, "*");
        foreach($forms as $id=>$title){
             $selectForm->addOption($id, $title);
        }
        echo _AM_XFORMS_LISTING_CONTACT . " : " . $selectForm->render();
        echo '</form>';
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

        //echo '<form action="' . basename(__FILE__) . '" method="post">';
        echo '<table class="outer width100 bspacing1">'
           . '  <thead>'
           . '  <tr><th colspan="7">' . _AM_XFORMS_LISTING . '</th></tr>'
           . '  <tr>'
           . '    <td class="head center bottom width5">' . _AM_XFORMS_NO . '</td>'
           . '    <td class="head center bottom">' . _AM_XFORMS_TITLE . '</td>'
           . '    <td class="head center bottom width10">' . _AM_XFORMS_CHRONO . '</td>'
           . '    <td class="head center bottom width10">' . _AM_XFORMS_USER . '</td>'
           . '    <td class="head center bottom width10">' . _AM_XFORMS_EMAIL . '</td>'
           . '    <td class="head center bottom width20">' . _AM_XFORMS_OBJECT . '</td>'
           . '    <td class="head center bottom width10">' . _AM_XFORMS_STATUS  . '</td>'
           . '    <td class="head center bottom width10">' . _AM_XFORMS_ACTION . '</td>'
           . '  </tr>'
           . '  </thead>'
           . '  <tbody>';
      //------------------------------------------------------------------------------

//       $criteria = new \CriteriaCompo();
//       $criteria->add(new \Criteria('form_answer', 1, '='));
//
//       $forms = $formsHandler->getList($criteria, "form_id,form_title", false, true);


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
      $h = 0;
      foreach ($uForms as $id=>$uForm){
          $email = $uForm->getVar('uform_email');
          $isBanish = $banishHandler->is_banish($email, false);
          $color = $isBanish ? 'red': 'black';
                    
          $h = ($h +1) % 2;
          //$ligne= ($h==0) ? 'odd' : 'even';
          $ligne  = ($ligne == "odd") ? 'even': 'odd';
          echo "  <tr class='{$ligne}'  style='height:10px;color:{$color};'>";
//          echo '    <td class="odd center">' . $id . '</td>';
          echo "    <td class='{$ligne} center'>" .  $uForm->getVar('uform_id') . '</td>';
          echo "    <td class='{$ligne} left'>"   .  $forms[$uForm->getVar('form_id')] . '</td>';


          echo "    <td class='{$ligne} left'>"   .  $uForm->getVar('uform_chrono') .'</td>';
          echo "    <td class='{$ligne} left'>"   .  $uForm->getVar('uform_user') .'</td>';
          echo "    <td class='{$ligne} left'>" .  $uForm->getVar('uform_email') .'</td>';

          $object = $uForm->getVar('uform_object');
          $h= stripos($object, " ", 36);  //JJDai affiche jusqu'au premier espace trouv� apres ## caracteres
          if ($h > 0){$object = substr($object, 0, $h) . "...";}
          echo "    <td class='{$ligne} left'>"   . $object .'</td>';

          if ($uForm->getVar('uform_status') == 0){
            $status = "<span style='color:red;'>" . _AM_XFORMS_STATUS_WAITING . "</span>";
          }else{
            $status = "<span style='color:green;'>" . $uForm->getVar('uform_status') . " " . _AM_XFORMS_STATUS_ANSWERS . "</span>";
          }
          //echo "    <td class='{$ligne} center'>" .  $uForm->getVar('uform_status') .'</td>';
          echo "    <td class='{$ligne} center'>" . $status  .'</td>';

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
          if ($isBanish){
                $img = \Xmf\Module\Admin::iconUrl('mail_delete.png', '16');
                $action="unbanish";
                $title = _AM_XFORMS_ACTION_UNBANISH_MAIL;
          }else{
                $img = \Xmf\Module\Admin::iconUrl('mail_forward.png', '16');
                $action="banish";
                $title = _AM_XFORMS_ACTION_BANISH_MAIL;
          }
          $link = "contact.php?op=banish&form_id={$uForm->getVar('form_id')}&uform_id={$uForm->getVar('uform_id')}&email={$email}&action={$action}";
          $actionBanish = "<a href='{$link}'><img src='{$img}'  title='{$title}' alt='{$title}'></A>";


          echo "    <td class='odd center'>{$actionView}&nbsp;{$actionMail}&nbsp;{$actionDelete}&nbsp;{$actionBanish}</td>";

          echo '  </tr>';


//echo "uform_id = " . $uForm->getVar('uform_id') . "<br>";
      }
      echo '</table>';
      //echo '</form>';

      //======================================================================
?>