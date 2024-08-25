<?php
/*
 * Name: modinfo.php
 * Description:
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license http://www.fsf.org/copyleft/gpl.html GNU public license
 * @package : XOOPS
 * @Module : Xoops FAQ
 * @subpackage : Menu Language
 * @since 2.5.7
 * @author John Neill - JJDai
 * @version $Id: modinfo.php 0000 10/04/2009 09:08:46 John Neill $
 * Traduction: LionHell 
 * upgrade to xoops 2.5.7 by Jean-Jacques DELALANDRE
 */
 
defined( 'XOOPS_ROOT_PATH' ) or die( 'Accès restreint' );

define('_MD_XFORMS_PROXY', "(Proxy : %s)");
define('_MD_XFORMS_MSG_SUBJECT', "%s - %s");
define('_MD_XFORMS_TOTAL_ACTIVE', "Active Forms: <strong>%s </strong>");
define('_MD_XFORMS_ATTACHED_FILE', "Fichier attaché : %s");
define('_MD_XFORMS_MSG_SUBJECT_COPY', "Copie de : %s");
define('_MD_XFORMS_ERR_DB_INSERT', "Impossible de mettre à jour les données dans la base de données. <br>%s (%s)");
define('_MD_XFORMS_TOTAL_INACTIVE', "Formulaires inactifs: <strong>%s </strong>");
define('_MD_XFORMS_ERR_INVALIDMAIL', "Adresse email invalide.");
define('_MD_XFORMS_MSG_IP', "Adresse IP : %s");
define('_MD_XFORMS_NEWLAST', "Le plus récent");
define('_MD_XFORMS_NEWTHIS', "Nouveau cette semaine");
define('_MD_XFORMS_NO_FILES', "Pas de nouveaux fichiers");
define('_MD_XFORMS_OPT_OTHER', "Autre:");
define('_MD_XFORMS_ERR_REQ', "Veuillez entrer le champ obligatoire ' %s ' ");
define('_MD_XFORMS_PROFILE_FOUND', "Le module de profil est actif, %s fonctionnera en utilisant ces fonctionnalités");
define('_MD_XFORMS_PROFILE_NOT_FOUND', "Module de profil non actif, %s fonctionnera sans ces fonctionnalités");
define('_MD_XFORMS_TODAY', "Publié aujourd'hui");
define('_MD_XFORMS_THREE', "Publié au cours des 72 dernières heures");
define('_MD_XFORMS_MSG_UNAME', "Soumis par : %s");
define('_MD_XFORMS_ELE_ERR', "Le formulaire %s ne contient aucun élément.");
define('_MD_XFORMS_MSG_INACTIVE', "Le formulaire est inactif ou a expiré");
define('_MD_XFORMS_FORM_IS_HIDDEN', "Ce formulaire est privé (caché au public).");
define('_MD_XFORMS_MSG_FORMURL', "Ce formulaire est envoyé en utilisant l'url suivante: %s");
define('_MD_XFORMS_TOTAL_FORMS', "Total Forms: <strong>%s </strong>");
define('_MD_XFORMS_UPLOADED_FILE', "Fichier téléchargé : %s");
define('_MD_XFORMS_MSG_UINFO', "URL vers la page d'informations utilisateur: %s");
define('_MD_XFORMS_MSG_AGENT', "Agent utilisateur : %s");
define('_MD_XFORMS_ERR_HEADING', "Attendez une minute ...");
define('_MD_XFORMS_DASHBOARD', "xForms Dashboard");
define('_MD_XFORMS_MSG_NOFORM_SELECTED', "Vous devez entrer un numéro de formulaire pour entrer");
define('_MD_XFORMS_MSG_SENT', "Votre formulaire a été envoyé. Merci.");

define('_MD_XFORMS_MAX_IMG_SIZE', "<b>Poids maximum : %s mo - Taille maximum %s x %s pixels</b>");
define('_MD_XFORMS_MAX_FILE_SIZE', "<b>Poids maximum du fichier : %s mo</b>");

?>