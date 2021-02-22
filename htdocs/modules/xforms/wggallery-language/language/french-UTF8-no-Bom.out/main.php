ï»¿<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * wgGallery module for xoops
 *
 * @copyright      module for xoops
 * @license        GPL 2.0 or later
 * @package        wggallery
 * @since          1.0
 * @min_xoops      2.5.9
 * @author         Wedega - Email:<webmaster@wedega.com> - Website:<https://wedega.com>
 * @version        $Id: 1.0 main.php 1 Mon 2018-03-19 10:04:56Z XOOPS Project (www.xoops.org) $
 */
require_once __DIR__ . '/common.php';

// ---------------- Principale ----------------
define ('_MA_WGGALLERY_INDEX', 'Accueil');
define ('_MA_WGGALLERY_TITLE', 'wgGallery');
define ('_MA_WGGALLERY_DESC', 'Ce module est une galerie d\'images pour XOOPS');
define ('_MA_WGGALLERY_INDEX_DESC', "Bienvenue sur la page d\'accueil de votre nouveau module wgGallery! <br>
Comme vous pouvez le voir, vous avez crÃ©Ã© une page avec une liste de liens en haut pour naviguer entre les pages de votre module. Cette description n\'est visible que sur la page d\'accueil de ce module, les autres pages vous permettront de voir le contenu que vous avez crÃ©Ã© lorsque vous avez construit ce module avec le module TDMCreate, et aprÃ¨s avoir crÃ©Ã© un nouveau contenu en admin de ce module. Afin d\'Ã©tendre ce module avec d\'autres ressources, ajoutez simplement le code dont vous avez besoin pour Ã©tendre les fonctionnalitÃ©s de celui-ci. Les fichiers sont regroupÃ©s par type, de l\'en-tÃªte au pied de page pour voir comment divisÃ© le code source. <br> <br> Si vous voyez ce message, c'est que vous n\'avez pas crÃ©Ã© de contenu pour ce module. Une fois que vous avez crÃ©Ã© n\'importe quel type de contenu, vous ne verrez pas ce message. <br> <br> Si vous avez aimÃ© le module TDMCreate et grÃ¢ce au long processus pour donner l\'opportunitÃ© au nouveau module d\'Ãªtre crÃ©Ã© en un instant, pensez faire un don pour garder le module TDMCreate et faire un don en utilisant ce bouton <a href='http://www.txmodxoops.org/modules/xdonations/index.php' title='Donation To Txmod Xoops'> <img src = 'https: //www.paypal.com/en_US/i/btn/btn_donate_LG.gif' alt = 'Button Donations'> </a> <br> Merci! <br> <br> Utilisez le lien ci-dessous pour aller Ã  l\'administrateur et crÃ©er du contenu. ");
define ('_MA_WGGALLERY_NO_PDF_LIBRARY', 'BibliothÃ¨ques TCPDF pas encore lÃ , tÃ©lÃ©chargez-les dans root / Frameworks');
define ('_MA_WGGALLERY_NO', 'No');
// ---------------- Contenu ----------------
// Colorbox et Lightbox
define ('_MA_WGGALLERY_CURRENT_LABEL', 'image {actuelle} de {total}');
// BoÃ®te de couleur
define ('_MA_WGGALLERY_COLORBOX_CLOSE', 'fermer');
define ('_MA_WGGALLERY_COLORBOX_PREVIOUS', 'prÃ©cÃ©dent');
define ('_MA_WGGALLERY_COLORBOX_NEXT', 'next');
define ('_MA_WGGALLERY_COLORBOX_SLIDESHOWSTART', 'dÃ©marrer le diaporama');
define ('_MA_WGGALLERY_COLORBOX_SLIDESHOWSTOP', 'arrÃªter le diaporama');
// LC_Lightbox lite
define ('_MA_WGGALLERY_LCL_CLOSE', 'fermer');
define ('_MA_WGGALLERY_LCL_PREVIOUS', 'prÃ©cÃ©dent');
define ('_MA_WGGALLERY_LCL_NEXT', 'suivant');
define ('_MA_WGGALLERY_LCL_PLAY', 'jouer');
define ('_MA_WGGALLERY_LCL_COUNTER', 'compteur');
define ('_MA_WGGALLERY_LCL_FULLSCREEN', 'plein Ã©cran');
define ('_MA_WGGALLERY_LCL_TXT_TOGGLE', 'basculer le texte');
define ('_MA_WGGALLERY_LCL_DOWNLOAD', 'tÃ©lÃ©charger');
define ('_MA_WGGALLERY_LCL_THUMBS_TOGGLE', 'basculer les vignettes');
define ('_MA_WGGALLERY_LCL_SOCIALS', 'socials');
// Lien administrateur
define ('_MA_WGGALLERY_ADMIN', 'Admin');
// ---------------- Les erreurs ----------------
define ('_MA_WGGALLERY_FAILSAVEIMG_MEDIUM', 'Erreur lors de la crÃ©ation de l\'image du support: %s');
define ('_MA_WGGALLERY_FAILSAVEIMG_THUMBS', 'Erreur lors de la crÃ©ation de l\'image miniature: %s');
define ('_MA_WGGALLERY_FAILSAVEWM_MEDIUM', 'Erreur lors de l\'ajout du filigrane Ã  l\'image moyenne: %s (raison: %g)');
define ('_MA_WGGALLERY_FAILSAVEWM_LARGE', 'Erreur lors de l\'ajout d\'un filigrane Ã  une grande image: %s (raison: %g)');
define ('_MA_WGGALLERY_ERROR_NO_IMAGE_SET', "Vous n\'avez pas spÃ©cifiÃ© l\'image. Veuillez d\'abord sÃ©lectionner l\'album");
// chercher
define ('_MA_WGGALLERY_SEARCH', 'Rechercher une image selon des critÃ¨res spÃ©cifiques');
define ('_MA_WGGALLERY_SEARCH_CATS', 'Rechercher des catÃ©gories');
define ('_MA_WGGALLERY_SEARCH_TEXT', 'Rechercher le texte');
define ('_MA_WGGALLERY_SEARCH_SUBM', 'Rechercher Ã  partir d\'un Ã©metteur spÃ©cifique');
define ('_MA_WGGALLERY_SEARCH_CATS_DESC', 'Les images et les albums seront sÃ©lectionnÃ©s, s\'ils sont connectÃ©s Ã  l\'une des catÃ©gories sÃ©lectionnÃ©es. Si un album est connectÃ© Ã  l\'une de ces catÃ©gories, alors toutes les images de l\'album seront affichÃ©es, mÃªme si l\'image elle-mÃªme n\'est pas liÃ© Ã  la catÃ©gorie. ');
define ('_MA_WGGALLERY_SEARCH_TEXT_DESC',
       'Les images et les albums seront sÃ©lectionnÃ©s, si le nom, la description, le nom de la catÃ©gorie ou l\'une des balises contient ce texte. Si un album est connectÃ© Ã  l\'une de ces catÃ©gories, toutes les images de l\'album seront affichÃ©es, mÃªme si l\'image elle-mÃªme n\'est pas liÃ©e Ã  la catÃ©gorie. ');
define ('_MA_WGGALLERY_SEARCH_SUBM_DESC', 'Les images et les albums seront sÃ©lectionnÃ©s, s\'ils sont soumis par l\'utilisateur sÃ©lectionnÃ©.');
define ('_MA_WGGALLERY_SEARCH_ERROR_NO_FILTER', 'Veuillez sÃ©lectionner au moins un des filtres!');
define ('_MA_WGGALLERY_SEARCH_RESULT', 'RÃ©sultat de votre recherche');
define ('_MA_WGGALLERY_SEARCH_NO_RESULT', 'Aucune image trouvÃ©e');
define ('_MA_WGGALLERY_SEARCH_ACT', 'Rechercher des activitÃ©s utilisateur');
define ('_MA_WGGALLERY_SEARCH_ACT_DOWNLOADS', 'La plupart des tÃ©lÃ©chargements');
define ('_MA_WGGALLERY_SEARCH_ACT_VIEWS', 'La plupart des vues');
define ('_MA_WGGALLERY_SEARCH_ACT_RATINGS', 'Les mieux notÃ©s');
define ('_MA_WGGALLERY_SEARCH_ACT_VOTES', 'La plupart des votes');
// ---------------- Ã‰valuations ----------------
define ('_MA_WGGALLERY_RATING_CURRENT_1', 'Note: %c / %m (%t total des votes totale)');
define ('_MA_WGGALLERY_RATING_CURRENT_X', 'Note: %c / %m (%t total des votes)');
define ('_MA_WGGALLERY_RATING_CURRENT_SHORT_1', '%c (%t rating)');
define ('_MA_WGGALLERY_RATING_CURRENT_SHORT_X', '%c (%t ratings)');
define ('_MA_WGGALLERY_RATING1', '1 sur 5');
define ('_MA_WGGALLERY_RATING2', '2 sur 5');
define ('_MA_WGGALLERY_RATING3', '3 sur 5');
define ('_MA_WGGALLERY_RATING4', '4 sur 5');
define ('_MA_WGGALLERY_RATING5', '5 sur 5');
define ('_MA_WGGALLERY_RATING_10_1', '1 sur 10');
define ('_MA_WGGALLERY_RATING_10_2', '2 of 10');
define ('_MA_WGGALLERY_RATING_10_3', '3 sur 10');
define ('_MA_WGGALLERY_RATING_10_4', '4 sur 10');
define ('_MA_WGGALLERY_RATING_10_5', '5 sur 10');
define ('_MA_WGGALLERY_RATING_10_6', '6 sur 10');
define ('_MA_WGGALLERY_RATING_10_7', '7 sur 10');
define ('_MA_WGGALLERY_RATING_10_8', '8 sur 10');
define ('_MA_WGGALLERY_RATING_10_9', '9 sur 10');
define ('_MA_WGGALLERY_RATING_10_10', '10 sur 10 ');
define ('_MA_WGGALLERY_RATING_VOTE_BAD', 'Vote invalide');
// define ('_MA_WGGALLERY_RATING_VOTE_ALREADY', 'Vous avez dÃ©jÃ  votÃ©');
define ('_MA_WGGALLERY_RATING_VOTE_THANKS', 'Merci pour la note');
define ('_MA_WGGALLERY_RATING_NOPERM', "DÃ©solÃ©, vous n\'Ãªtes pas autorisÃ© Ã  Ã©valuer les articles");
define ('_MA_WGGALLERY_RATING_LIKE', 'J\'aime');
define ('_MA_WGGALLERY_RATING_DISLIKE', 'Je n\'aime pas');
define ('_MA_WGGALLERY_ERROR_CREATE_ZIP', 'Erreur: l\'archive Zip n\'a pas pu Ãªtre crÃ©Ã©e');
