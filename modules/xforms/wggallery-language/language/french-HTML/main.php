<?php
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
Comme vous pouvez le voir, vous avez cr&Atilde;©&Atilde;© une page avec une liste de liens en haut pour naviguer entre les pages de votre module. Cette description n\'est visible que sur la page d\'accueil de ce module, les autres pages vous permettront de voir le contenu que vous avez cr&Atilde;©&Atilde;© lorsque vous avez construit ce module avec le module TDMCreate, et apr&Atilde;¨s avoir cr&Atilde;©&Atilde;© un nouveau contenu en admin de ce module. Afin d\'&Atilde;©tendre ce module avec d\'autres ressources, ajoutez simplement le code dont vous avez besoin pour &Atilde;©tendre les fonctionnalit&Atilde;©s de celui-ci. Les fichiers sont regroup&Atilde;©s par type, de l\'en-t&Atilde;ªte au pied de page pour voir comment divis&Atilde;© le code source. <br> <br> Si vous voyez ce message, c'est que vous n\'avez pas cr&Atilde;©&Atilde;© de contenu pour ce module. Une fois que vous avez cr&Atilde;©&Atilde;© n\'importe quel type de contenu, vous ne verrez pas ce message. <br> <br> Si vous avez aim&Atilde;© le module TDMCreate et gr&Atilde;¢ce au long processus pour donner l\'opportunit&Atilde;© au nouveau module d\'&Atilde;ªtre cr&Atilde;©&Atilde;© en un instant, pensez faire un don pour garder le module TDMCreate et faire un don en utilisant ce bouton <a href='http://www.txmodxoops.org/modules/xdonations/index.php' title='Donation To Txmod Xoops'> <img src = 'https: //www.paypal.com/en_US/i/btn/btn_donate_LG.gif' alt = 'Button Donations'> </a> <br> Merci! <br> <br> Utilisez le lien ci-dessous pour aller &Atilde;  l\'administrateur et cr&Atilde;©er du contenu. ");
define ('_MA_WGGALLERY_NO_PDF_LIBRARY', 'Biblioth&Atilde;¨ques TCPDF pas encore l&Atilde; , t&Atilde;©l&Atilde;©chargez-les dans root / Frameworks');
define ('_MA_WGGALLERY_NO', 'No');
// ---------------- Contenu ----------------
// Colorbox et Lightbox
define ('_MA_WGGALLERY_CURRENT_LABEL', 'image {actuelle} de {total}');
// Bo&Atilde;®te de couleur
define ('_MA_WGGALLERY_COLORBOX_CLOSE', 'fermer');
define ('_MA_WGGALLERY_COLORBOX_PREVIOUS', 'pr&Atilde;©c&Atilde;©dent');
define ('_MA_WGGALLERY_COLORBOX_NEXT', 'next');
define ('_MA_WGGALLERY_COLORBOX_SLIDESHOWSTART', 'd&Atilde;©marrer le diaporama');
define ('_MA_WGGALLERY_COLORBOX_SLIDESHOWSTOP', 'arr&Atilde;ªter le diaporama');
// LC_Lightbox lite
define ('_MA_WGGALLERY_LCL_CLOSE', 'fermer');
define ('_MA_WGGALLERY_LCL_PREVIOUS', 'pr&Atilde;©c&Atilde;©dent');
define ('_MA_WGGALLERY_LCL_NEXT', 'suivant');
define ('_MA_WGGALLERY_LCL_PLAY', 'jouer');
define ('_MA_WGGALLERY_LCL_COUNTER', 'compteur');
define ('_MA_WGGALLERY_LCL_FULLSCREEN', 'plein &Atilde;©cran');
define ('_MA_WGGALLERY_LCL_TXT_TOGGLE', 'basculer le texte');
define ('_MA_WGGALLERY_LCL_DOWNLOAD', 't&Atilde;©l&Atilde;©charger');
define ('_MA_WGGALLERY_LCL_THUMBS_TOGGLE', 'basculer les vignettes');
define ('_MA_WGGALLERY_LCL_SOCIALS', 'socials');
// Lien administrateur
define ('_MA_WGGALLERY_ADMIN', 'Admin');
// ---------------- Les erreurs ----------------
define ('_MA_WGGALLERY_FAILSAVEIMG_MEDIUM', 'Erreur lors de la cr&Atilde;©ation de l\'image du support: %s');
define ('_MA_WGGALLERY_FAILSAVEIMG_THUMBS', 'Erreur lors de la cr&Atilde;©ation de l\'image miniature: %s');
define ('_MA_WGGALLERY_FAILSAVEWM_MEDIUM', 'Erreur lors de l\'ajout du filigrane &Atilde;  l\'image moyenne: %s (raison: %g)');
define ('_MA_WGGALLERY_FAILSAVEWM_LARGE', 'Erreur lors de l\'ajout d\'un filigrane &Atilde;  une grande image: %s (raison: %g)');
define ('_MA_WGGALLERY_ERROR_NO_IMAGE_SET', "Vous n\'avez pas sp&Atilde;©cifi&Atilde;© l\'image. Veuillez d\'abord s&Atilde;©lectionner l\'album");
// chercher
define ('_MA_WGGALLERY_SEARCH', 'Rechercher une image selon des crit&Atilde;¨res sp&Atilde;©cifiques');
define ('_MA_WGGALLERY_SEARCH_CATS', 'Rechercher des cat&Atilde;©gories');
define ('_MA_WGGALLERY_SEARCH_TEXT', 'Rechercher le texte');
define ('_MA_WGGALLERY_SEARCH_SUBM', 'Rechercher &Atilde;  partir d\'un &Atilde;©metteur sp&Atilde;©cifique');
define ('_MA_WGGALLERY_SEARCH_CATS_DESC', 'Les images et les albums seront s&Atilde;©lectionn&Atilde;©s, s\'ils sont connect&Atilde;©s &Atilde;  l\'une des cat&Atilde;©gories s&Atilde;©lectionn&Atilde;©es. Si un album est connect&Atilde;© &Atilde;  l\'une de ces cat&Atilde;©gories, alors toutes les images de l\'album seront affich&Atilde;©es, m&Atilde;ªme si l\'image elle-m&Atilde;ªme n\'est pas li&Atilde;© &Atilde;  la cat&Atilde;©gorie. ');
define ('_MA_WGGALLERY_SEARCH_TEXT_DESC',
       'Les images et les albums seront s&Atilde;©lectionn&Atilde;©s, si le nom, la description, le nom de la cat&Atilde;©gorie ou l\'une des balises contient ce texte. Si un album est connect&Atilde;© &Atilde;  l\'une de ces cat&Atilde;©gories, toutes les images de l\'album seront affich&Atilde;©es, m&Atilde;ªme si l\'image elle-m&Atilde;ªme n\'est pas li&Atilde;©e &Atilde;  la cat&Atilde;©gorie. ');
define ('_MA_WGGALLERY_SEARCH_SUBM_DESC', 'Les images et les albums seront s&Atilde;©lectionn&Atilde;©s, s\'ils sont soumis par l\'utilisateur s&Atilde;©lectionn&Atilde;©.');
define ('_MA_WGGALLERY_SEARCH_ERROR_NO_FILTER', 'Veuillez s&Atilde;©lectionner au moins un des filtres!');
define ('_MA_WGGALLERY_SEARCH_RESULT', 'R&Atilde;©sultat de votre recherche');
define ('_MA_WGGALLERY_SEARCH_NO_RESULT', 'Aucune image trouv&Atilde;©e');
define ('_MA_WGGALLERY_SEARCH_ACT', 'Rechercher des activit&Atilde;©s utilisateur');
define ('_MA_WGGALLERY_SEARCH_ACT_DOWNLOADS', 'La plupart des t&Atilde;©l&Atilde;©chargements');
define ('_MA_WGGALLERY_SEARCH_ACT_VIEWS', 'La plupart des vues');
define ('_MA_WGGALLERY_SEARCH_ACT_RATINGS', 'Les mieux not&Atilde;©s');
define ('_MA_WGGALLERY_SEARCH_ACT_VOTES', 'La plupart des votes');
// ---------------- &Atilde;‰valuations ----------------
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
// define ('_MA_WGGALLERY_RATING_VOTE_ALREADY', 'Vous avez d&Atilde;©j&Atilde;  vot&Atilde;©');
define ('_MA_WGGALLERY_RATING_VOTE_THANKS', 'Merci pour la note');
define ('_MA_WGGALLERY_RATING_NOPERM', "D&Atilde;©sol&Atilde;©, vous n\'&Atilde;ªtes pas autoris&Atilde;© &Atilde;  &Atilde;©valuer les articles");
define ('_MA_WGGALLERY_RATING_LIKE', 'J\'aime');
define ('_MA_WGGALLERY_RATING_DISLIKE', 'Je n\'aime pas');
define ('_MA_WGGALLERY_ERROR_CREATE_ZIP', 'Erreur: l\'archive Zip n\'a pas pu &Atilde;ªtre cr&Atilde;©&Atilde;©e');
