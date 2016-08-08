# php megalogger client

##Installation:
```javascript
composer require megaads-vn/megalogger
```
###OR
**add in file composer.json**
```javascript
"require": {
	"megaads-vn/megalogger":"dev-master"
}
```
##Usage:
**Create an instance of the MegaLogger\Logger class**

```
use MegaLogger\Logger;

$apiKey = "asefas_efjhj-afsd64sf";
$source = "Your source";
$initData = array(
    'apiKey' => $apiKey,
    'source' => $source
);
$loggerClient = new Logger($initData);

// Get level: info, debug, warning, error, critical
$levelObj = new Level();
$level = $levelObj->getLevelInfo();

$data = array("message" => "Message attachment token");
//push log 

$response = $loggerClient->pushLog($level, $data);
echo '<pre>';
print_r($response);
echo '</pre>';
```



