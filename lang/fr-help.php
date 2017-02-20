<?php $pluginName = str_replace('help=plugin&page=','',$plxAdmin->get) ?>
<p class="in-action-bar">plxShariff permet aux utilisateurs du site web de partager leur contenu préféré sans compromettre leur vie privée</p>
<h4 class="in-action-bar">
 Aide du plugin<br />
 <?php echo '<a title="'.L_PLUGINS_CONFIG_TITLE.' '.$pluginName.'" href="parametres_plugin.php?p='.urlencode($pluginName).'">'.L_PLUGINS_CONFIG.'</a>' ?>
</h4>
<h3 class="help-title">Utilité du Plugin</h3>
<p>Affiche des <a target="_blank" rel="noreferer" title="exemple" href="https://heiseonline.github.io/shariff/">boutons sociaux de partage</a> préservant la vie privée des internautes de Facebook, Twitter, Google+ &amp; bien+ grâce a <a rel="noreferer" target="_blank" href="https://github.com/heiseonline/shariff" title="Shariff - Give Social Media Buttons Some Privacy - GitHub">Shariff</a></p>
<h3 class="help-title">Actvation Express</h3>
<p>
Dans le fichier du thème où afficher les boutons <strong>footer.php</strong>, <strong>sidebar.php</strong><br />
ou n'importe quel endroit <strong>ajouter la ligne suivante</strong>&nbsp;:</p>
<pre class="help-pre">
<p>&lt;?php eval($plxShow->callHook('shariff')) ?&gt;</p>
</pre>
<p><a href="parametres_plugins.php?sel=0">activer plxShariff</a> et <a href="parametres_plugin.php?p=<?php echo $pluginName ?>">Configurer le</a> a vos souhaits. Ainsi les boutons de partage s'affichent a l'endroit désiré.</p>
<p><a title="Pour que les compteurs fonctionnent&#13;le serveur doit afficher un json de la forme ci-dessous" target="_blank" href="<?php echo $plxAdmin->plxPlugins->aPlugins[$pluginName]->getParam('backend') ?>?url=<?php echo urlencode(rtrim($plxAdmin->racine,'/')) ?>">Tester le Backend de <?php echo $pluginName; ?></a></p>
<p><pre title="Le serveur doit retourner un json de cette forme pour que cela fonctionne&#13;&#13;Reddit bogue le retour serveur (parfois?) : &#13;placer le après le dernier de la liste des services qui ont lecompteur&#13;Comme dans le json d'exemple survolé ici&#13;Juste avec le Nom du SerVice suivit d'une virgue, ou non et faire attention a la CassE des caractères de la liste, Le Backend en est sensible ;-)">{"linkedin":1,"googleplus":2,"addthis":3,"xing":4,"flattr":5,"stumbleupon":6,"pinterest":7,"facebook":8,"reddit":9}</pre></p>
<p>
pour voir tous les réseaux sociaux disponible a l'affichage (services dans Shariff)<br />rendez vous dans la <a href="parametres_plugin.php?p=<?php echo $pluginName; ?>">config du plugin</a> sous le champ des services à lister.<br />
</p>
<h3 class="help-title">Options de configuration du plugin&nbsp;:</h3>
<p><b>Frontend</b><br />
Orientation horizontale ou verticale<br />
2 styles sont disponibles : complet ou minimal (si Font Awesome est déja inclus dans le theme) *<br />
2 mode jasvascript sont disponibles : complet ou minimal (si Jquery est déja inclus dans le theme) *<br />
3 thèmes originaux de Shariff : coloré, gris et blanc<br />
Possibilité d'utiliser votre propre <a title="Voir le theme complet Sassifier par css2scss.com.<?php echo PHP_EOL ?>Le dossier &laquo;shariff&raquo; du pugin en contient d'autres." href="#scss">thème Shariff</a> si besoin est.<br />
Choisir les services affichés en les séparant par des virgules (Attention a la casse).<br />
</p>
<p><b>Backend</b><br />
Possibilité d'activer le backend de Shariff pour compter les clics.<br />
Possibilité d'utiliser une autre adresse de Backend d'un(e) ami(e) (si le votre est en rade).<br />
Possibilité d'utiliser <a rel="noreferer" target="_blank" href="https://duckduckgo.com/?q=api+de+Facebook">l'api de Facebook</a> pour compter les clics.<br />
Possibilité d'ajuster le temps de vie du cache Shariff.<br />
Possibilité d'ajuster le delais d'attente du client (backend) Shariff.<br />
</p>
<p>*Ps : <i>Sont commenté les <b>/*width:auto;*/</b> dans les css complet et minimal pour éviter un pitit décalage des boutons (sur un vieux Firefox 43.0)</i></p>
<h3 class="help-title">Services spéciaux du Shariff&nbsp;:</h3>
<p>
2 options d'affichages avec réglage spécifiques&nbsp;:<br />
Le lien vers votre page «A Propos» affiché par le plugin <b>info *</b><br />
Le <i>lien**</i> de contact par Courriel du service «mail» affiché par le plugin <b>mail *</b><br />
<b>*&nbsp;: A ajouter a la liste des services pour l'activer. Penser a la virgule!</b><br />
<i>**&nbsp;: Pour le protocole mailto: shariff s'occupe de tout, écrire &laquo;mailto:&raquo; et c'est tout.</i><br />
</p>

<h3 class="help-title">Modification de l'affichage des boutons :</h3>
<p>
L'affichage des boutons de plxShariff peut être modifié avec les <a href="parametres_plugin.php?p=<?php echo $pluginName; ?>">options de configuration</a> du plugin
<br />et pour aller plus loin en personnalisant la classe <strong>.shariff-button</strong> en allant sur l'écran d'administration:
<br />Paramètres > Plugins > menu "Plugins actifs" > plugin "Shariff" > menu "<a href="parametres_plugincss.php?p=<?php echo $pluginName; ?>">Code css</a>" > champ "<b>Contenu fichier css site</b>"
</p>
<h4>Exemples :</h4>
<p>Pour ajouter un bord arrondis de 6 pixels aux boutons, placer le code suivant&nbsp;:
<pre class="help-pre">
.shariff-button {
 border-radius: 6px;
}
</pre>
</p>
<p>Si l'alignement est reglé sur center ou justify dans votre thème ou pour ré-aligner à gauche les icônes et les textes, placer le code suivant&nbsp;:
<pre class="help-pre">
.shariff {
 text-align: left;
}
</pre>
</p>
<p>Cliquez sur le bouton "Sauvegarder le fichier" pour enregistrer les modifications.</p>
<h3 class="help-title">Personnalisation avancé&nbsp;:</h3>
<p>
L'option thème personnel est faite pour outrepasser l'option des 3 thèmes de plxShariff originaux afin d'utiliser <a target="_blank" rel="noreferer" href="http://duckduckgo.com/?q=themes+shariff+social+buttons+css">un thème de boutons Shariff personnalisé</a>.<br />
<a href="#css">
 <img class="logo" title="Voir la source du fichier css de Shariff" alt="Logo Shariff" src="../../plugins/plxShariff/shariff_logo_ct_xhoehe.png" />
A fin dinspiration le fichier shariff.css du dossier "shariff"</a> 
<a rel="noreferer" target="_blank"title="Beautifies your CSS automatically so that it is consistent and easy to read" href="http://html.fwpolice.com/css/">déminifié et enjolivé par CSS Beautifier</a>.<br /> 
Pour les créateur de themes, le code css est optimisable, au moins pour certaines média query.<br />
D'origine Shariff est en <a target="_blank" rel="noreferer" href="https://github.com/heiseonline/shariff/blob/51153c199b58b7684e694b0b97cf41b75bb1dda9/src/style/shariff-layout.less">less</a>) 
</p>
<h3 class="help-title">Partagez le bien et bien.</h3>
<?php include(__DIR__.'/fr-info.php'); ?>