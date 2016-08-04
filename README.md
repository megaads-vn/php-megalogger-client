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

$apiKey = "asfkjewf46388asfafsf";
$loggerClient = new Logger($apiKey);

// Get level: info, debug, warning, error, critical
$levelObj = new Level();
$level = $levelObj->getLevelInfo();
$source = 'source_log';

$data = array("message" => "Message attachment token");
//push log 

$response = $loggerClient->pushLog($level, $data, $source);
echo '<pre>';
print_r($response);
echo '</pre>';
```



