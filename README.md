This is an edit of the Teamspeak³ Channel Create Webinterface by brai4u!
The Bot is now able to check, if the user already created a channel and if he used a secure password!
Also you were able to get the uniqueid of other users to create channels, even if you were guest and not vip!
Live Version of this webinterface on this teamspeak: ts.agarly.com (you need to get the rank vip first)

Orginal App: https://github.com/brai4u/teamspeak-3-channels-create-web

# Installation

1. Install Apache2 / Nginx + PHP5 on your WebServer
2. Upload the complete project into the www Folder
3. Open the config.php file and enter all important informations
4. Use a Serverbot (Example: JTS3ServerMod) to send your vip group the link of your webinterface like this:
    http://yourdomain.com/?uuid=%CLIENT_UNIQUE_ID% (the bot should replace %CLIENT_UNIQUE_ID% with the unique id of the client)
5. The bot is ready to use ;)

# Configuration

File configuration with help config.php

```sh
<?php
$UserAdmin = 'Serverquery'; //Query Username
$PWQuery   = '12345678'; //Query Passwort
$IP_TS     = '127.0.0.1'; //Server IP (Without Port)
$PuertoTS  = '9987'; //Server Port
$PuertoQuery = '10011'; //Query Port
$nickname = 'EPBot'; //Nick
$cgid = '5'; //Channel Admin Group
$sgid = '10'; //Your VIPGroup
$MainChannel = '500'; //Select your Main Channel
$Salt = 'SuperSecretPassword'; // Secure-Key! Change this before using the bot and make sure no one knows this!
?>
```
Easy install and setting. Port default Query 10011. Remember to change the Salt!!!
