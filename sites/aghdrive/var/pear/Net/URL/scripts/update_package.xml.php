<?php
require_once('PEAR/PackageFileManager2.php');
PEAR::setErrorHandling(PEAR_ERROR_DIE);

$packagexml = PEAR_PackageFileManager2::importOptions(dirname(__FILE__).'/../'. 'package.xml',
array(
    'baseinstalldir' => 'Net/URL',
    'packagedirectory' => dirname(__FILE__).'/..',
    'filelistgenerator' => 'file',
    'ignore' => array('.svn/', 'scripts/', '*.plex'),
    'dir_roles' => array('tests' => 'test'),
    ));

$version = '0.9.3';

$packagexml->setPackage('Net_URL_Mapper');
$packagexml->setSummary('Provides a simple and flexible way to build nice URLs for web applications.');
$packagexml->setDescription(
'Net_URL_Mapper provides a simple and flexible way to build nice URLs for your web applications.

The URL syntax is similar to what can be found in Ruby on Rails or Python Routes module 
and as such, this package can be compared to what they call a router. Still, Net_URL_Mapper 
does not perform the dispatching like these frameworks and therefore can be used with your 
own router.');

$packagexml->setUri('http://src.mamasam.com/packages/Net_URL_Mapper-'.$version);
$packagexml->setAPIVersion('1.0.0');
$packagexml->setReleaseVersion($version);
$packagexml->setReleaseStability('beta');
$packagexml->setAPIStability('stable');
$packagexml->setNotes("
- Remove scriptname if it is present in the URL when matching
");
$packagexml->setPackageType('php');

$packagexml->setPhpDep('5.1.0');
$packagexml->setPearinstallerDep('1.4.3');

$packagexml->addPackageDepWithChannel('required', 'Net_URL', 'pear.php.net', '1.0.14');

$packagexml->addMaintainer('lead', 'mansion', 'Bertrand Mansion', 'golgote@mamasam.com');
$packagexml->setLicense('New BSD License', 'http://opensource.org/licenses/bsd-license.php');
$packagexml->generateContents();
$packagexml->addGlobalReplacement('package-info', '@package_version@', 'version');

if (isset($_GET['make']) || (isset($_SERVER['argv']) && @$_SERVER['argv'][1] == 'make')) {
    $packagexml->writePackageFile();
} else {
    $packagexml->debugPackageFile();
}
?>