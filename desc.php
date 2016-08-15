<?php
require_once ("TeamSpeak3.php");

include ('config.php');

error_reporting(0);
$ChannelDescription = $_POST['desc'];
$ChannelPassword = $_POST['ChannelPass'];
$ChannelPassword2 = $_POST['ChannelPass2'];
$idUnica = $_POST['idts'];
$id = $_POST['id'];
$channel = $_POST['channel'];

if ($ChannelPassword !== $ChannelPassword2)
	{
	echo "Passwords do not match!<br /><br />" . $idUnica;
	exit();
	}

if (!preg_match("/^[a-zA-Z0-9!Â§$&()=?Â´`+~*#_.:,;<>|^Â°\' ]{3,1024}$/", $ChannelDescription))
	{
	die("Channel Description invalid<br /><br />If you are using Microsoft Edge or Internet Explorer, try a differnt browser!<br /><br />" . $idUnica); // Noticed Bugs in Microsoft Edge...
	}

if (!preg_match("/^[a-zA-Z0-9!Â§$%&()=?Â´`+~*#-_.:,;<>|^Â°\' ]{3,20}$/", $ChannelPassword))
	{
	die('Channel Password invalid: "' . $ChannelPassword . '"<br /><br />' . $idUnica);
	}

if (preg_match("/^.*([Pp][Aa][Ss][Ss]|[1Aa][12Bb][13Cc]|[3][2][1]|[QqAaYyZz][WwSsXx][RrDdCc]|[Bb][Aa][Ll][Ll]|[LlWw][OoTt][LlFf]|[Mm][Aa][Nn]).*$/", $ChannelPassword))
	{
	die('Channel Password invalid: "' . $ChannelPassword . '"<br />Password too common!<br /><br />' . $idUnica);
	}

$ts3_VirtualServer = TeamSpeak3::factory("serverquery://" . $UserAdmin . ":" . $PWQuery . "@" . $IP_TS . ":" . $PuertoQuery . "/?server_port=" . $PuertoTS . "&blocking=0&nickname=" . $nickname . "");
try
	{
	$clID = $ts3_VirtualServer->clientGetByUid($idUnica);
	$infoCliente = $ts3_VirtualServer->execute("clientgetnamefromuid", array(
		"cluid" => $idUnica
	))->toList();
	$cldbid = strval($infoCliente['cldbid']);
	$infoCliente2 = $ts3_VirtualServer->execute("clientinfo", array(
		"clid" => $clID
	))->toList();
	}

catch(Exception $e)
	{
	echo "Exception: ", $e->getMessage() , "<br />";
	}

$str1 = md5($idUnica);
$str2 = md5(strval($infoCliente2['connection_client_ip']));
$longid = md5($str1 . $str2 . $PWQuery . $Salt);
$calcid = substr($longid, 0, -22);

if ($calcid == $id)
	{
	try
		{
		$ChannelInfo = $ts3_VirtualServer->execute("channelinfo", array(
			"cid" => $channel
		))->toString();
		}

	catch(Exception $e)
		{
		echo "Exception: ", $e->getMessage() , "<br />";
		}

	if (strpos($ChannelInfo, $idUnica))
		{
		$ts3_VirtualServer->execute("channeledit", array(
			"cid" => $channel,
			"channel_description" => $ChannelDescription,
			"channel_password" => $ChannelPassword,
		));
		echo "Your channel was edited successfully!<br /><br />" . $idUnica;
		}
	  else
		{
		echo "That's not your channel!<br /><br />" . $idUnica;
		exit();
		}
	}
  else
	{
	echo "You are not a real User!<br /><br />" . $idUnica;
	}

?>
