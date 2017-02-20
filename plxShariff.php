<?php
/**
 * Plugin plxShariff
 *
 * @version 1.0.0
 * @date 20/02/2017
 * @author Thomas Ingles
 **/
class plxShariff extends plxPlugin {

 protected $callable = false;

 /**
  * Constructeur de la classe
  *
  * @param default_lang langue par défaut
  * @return stdio
  * @author Thomas I.
  **/
 public function __construct($default_lang) {

  # appel du constructeur de la classe plxPlugin (obligatoire)
  parent::__construct($default_lang);

  # Autorisation d'acces à la configuration du plugin
  $this-> setConfigProfil(PROFIL_ADMIN, PROFIL_MANAGER);

  # déclaration des hooks
  $this->addHook('ThemeEndHead', 'ThemeEndHead');
  $this->addHook('ThemeEndBody', 'ThemeEndBody');
  if(isset($_SERVER['QUERY_STRING'])&&strstr($_SERVER['QUERY_STRING'],__CLASS__)&&strstr($_SERVER['PHP_SELF'],"plugin.php")){//que si c'est lui qui est appellé
   $this->addHook('AdminTopEndHead', 'AdminTopEndHead');
  }
  $this->addHook('shariff', 'shariff');
 }

 /**
  * Méthode qui crée le dossier plxShariff dans data/plugins
  * @return stdio
  * @author Thomas I.
  **/
 public function OnActivate() {
  $path = PLX_ROOT.PLX_CONFIG_PATH.'plugins/'.$this->plug['name'];
  if (!file_exists($path))
   mkdir($path, 0755, true);
 }

 /**
  * Méthode qui supprime le dossier plxShariff dans data/plugins & cache
  * @return stdio
  * @author Thomas I.
  **/
 public function OnDeActivate() {
  $path = PLX_ROOT.PLX_CONFIG_PATH.'plugins/'.$this->plug['name'];
  if (file_exists($path))
   $this->delete($path);#fonction récursive
 }

 /**
  * Méthode qui ajoute le code css dans la partie <head>
  * @return stdio
  * @author Thomas I.
  **/
 public function ThemeEndHead() {
  if($this->callable)
  echo "\t".'<link rel="stylesheet" type="text/css" href="'.PLX_PLUGINS.$this->plug['name'].'/shariff/shariff.'.$this->getParam('mode').'.css" media="screen" />'.PHP_EOL;
 }

 /**
  * Méthode qui ajoute l'appel des API des réseaux sociaux
  * @return stdio
  * @author Thomas I.
  **/
 public function ThemeEndBody() {
  if($this->callable)
   echo "\t".'<script type="text/javascript" src="'.PLX_PLUGINS.$this->plug['name'].'/shariff/shariff.'.$this->getParam('js').'.js"></script>'."\n";
 }

 /**
  * Méthode qui ajoute le fichier css dans le fichier header.php du thème admin
  * @return stdio
  * @author Thomas I
  **/
 public function AdminTopEndHead() {
  if(basename($_SERVER['SCRIPT_NAME'])=='parametres_plugin.php') {
   echo '<link href="'.PLX_PLUGINS.$this->plug['name'].'/tabs/style.css" rel="stylesheet" type="text/css" />'.PHP_EOL;
  }
 }

 /**
  * Méthode qui affiche les boutons sociaux
  * @return stdio
  * @author Thomas I.
  **/
 public function shariff() {
  $this->callable = true;
  $services = null;
  $servi = explode(',',$this->getParam('services'));
  foreach($servi as $ce)
   $services .= '&quot;'.trim($ce).'&quot;,';
  $services = rtrim(strtolower($services), ",")
  # protocle mailto: subject et body ajouté automatiqument lorsqu'il est enrgistré mailto: (mailUrl)
?>
<div class="shariff clear" 
<?php if($this->getParam('use_backend') && $this->getParam('backend') != ''){ ?>
data-backend-url="<?php echo $this->getParam('backend');#PLX_PLUGINS.$this->plug['name']."/backend.php" ?>"
<?php } if($this->getParam('mailUrl')!=''){ ?>
data-mail-url="<?php echo $this->getParam('mailUrl');?>" 
<?php } if($this->getParam('infoUrl')!=''){ ?>
data-info-url="<?php echo $this->getParam('infoUrl');?>" 
<?php } if($this->getParam('use_title')){ ?>
data-title="<?php echo "<?php \$plxShow->pageTitle() ?>";?>"
<?php } if($this->getParam('flatCat')!=''){ ?>
data-flattr-category="<?php echo $this->getParam('flatCat');?>" 
<?php } if($this->getParam('flatUser')!=''){ ?>
data-flattr-user="<?php echo $this->getParam('flatUser');?>" 
<?php } if($this->getParam('via')!=''){ ?>
data-twitter-via="<?php  echo $this->getParam('via');?>"
<?php } ?>
data-orientation="<?php echo $this->getParam('style');?>" 
data-services="[<?php echo $services;?>]"
data-theme="<?php echo ($this->getParam('themePerso')!='')?$this->getParam('themePerso'):$this->getParam('theme');?>" 
data-lang="<?php echo'<?php $plxShow->defaultLang() ?>';?>"<?php
if($this->getParam('use_thumb'))
 echo '
<?php #attention au mode erreur (404)
if(!strstr($plxShow->plxMotor->template,"static"))// [Static are no thumbnails function] évite : Fatal error: Call to a member function f() on a non-object in core/lib/class.plx.show.php on line 527 (v.5.5)
 if(is_file(str_replace($plxMotor->racine,"./",$plxShow->artThumbnail("#img_url",false))))
  echo "data-media-url=\"".$plxShow->artThumbnail("#img_url",false)."\""; 
?>'; ?>></div>
<?php
 }

 /**
  * crée le fichier config du backend de Shariff
  * @return null or array
  * @author Thomas I.
  **/
 public function saveConfig($r=false){
  $path = PLX_ROOT.PLX_CONFIG_PATH.'plugins/'.$this->plug['name'];
  if ('0'==$this->getParam('cache_sys')&&!file_exists($path.'/cache'))
    mkdir($path.'/cache', 0777, true);
  if ('1'==$this->getParam('cache_sys')&&file_exists($path.'/cache'))
    $this->delete($path.'/cache');

  $services = null;#prépare les services
  foreach(explode(',',$this->getParam('services')) as $ce)
   if(file_exists(PLX_PLUGINS.$this->plug['name'].'/backend/src/Backend/'.trim($ce).'.php'))#plante le backend si la classe est inexistante
    $services .= "'".trim($ce)."',";
  $services = rtrim($services, ",");

  $domains = null;#prépare les domaines
  if($this->getParam('domains') != '')
   foreach(explode(',',$this->getParam('domains')) as $dm)
    $domains .= "'".trim($dm)."',";
  $domains = rtrim($domains, ",");

  unset($ce,$dm);

  $sys = ($this->getParam('cache_sys'))?'//':'';
  $fcbk = null;#si ds la liste sans id, fait planté?!
  if($this->getParam('fcbk_app_id')==''||$this->getParam('fcbk_secret')==''){
   $fcbk = '//';
   $search = array("'Facebook',",",'Facebook'","'Facebook'");
   $services = str_ireplace($search,'',$services);
  }
  $cc = ($this->getParam('cc'))?'':'//';#change cache (class) #'Heise\\Shariff\\ZendCache'

  $c = "configuration = [
   ".$cc."'cacheClass' => '".$this->getParam('cacheClass')."',
   'cache' => [
    'ttl' => ".$this->getParam('cache_ttl').",
    ".$sys."'cacheDir' => '".$path."/cache',
    'adapter' => 'Filesystem',
    'adapterOptions' => [
      // ...
    ]
   ],
   'client' => [
     'timeout' => ".$this->getParam('client_timeout')."
     // ... (see Client options)
   ],
   'domains' => [".$domains."],
   'services' => [".$services."],
   ".$fcbk."'Facebook' => ['app_id' => '".$this->getParam('fcbk_app_id')."','secret' => '".$this->getParam('fcbk_secret')."']
  ];";

  #écrit le fichier de config
  if(plxUtils::write('<?php '.PHP_EOL.'$'.$c, $path."/config.php")){
   return plxMsg::Info(L_SAVE_SUCCESSFUL);
  }
  else {
   return plxMsg::Error(L_SAVE_ERR.' '.$path."/config.php");
  }
 }

 /**
  * fonction récursive de suppression de dossier
  * @use $this->deleteDir($foder);
  * @author Thomas I.
  **/
 public function delete($path){
  if (is_dir($path) === true){
   $files = array_diff(scandir($path), array('.', '..'));
   foreach ($files as $file)
    $this->Delete(realpath($path) . '/' . $file);
   return rmdir($path);
  }
  else if (is_file($path) === true)
   return unlink($path);
  return false;
 }
}