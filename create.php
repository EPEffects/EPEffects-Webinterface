<?php
require_once ("TeamSpeak3.php");

include ('config.php');

error_reporting(0);
$ChannelName = $_POST['name'];
$ChannelPassword = $_POST['ChannelPass'];
$ChannelPassword2 = $_POST['ChannelPass2'];
$idUnica = $_POST['idts'];
$id = $_POST['id'];

if (!$ChannelName)
	{
	echo "Missing Channel Name<br /><br />" . $idUnica;
	exit();
	}

if ($ChannelPassword !== $ChannelPassword2)
	{
	echo "Passwords do not match!<br /><br />" . $idUnica;
	exit();
	}

if (!preg_match("/^[a-zA-Z0-9 ]{3,20}$/", $ChannelName))
	{
	die("Channel Name invalid<br /><br />" . $idUnica);
	}

if (!preg_match("/^[a-zA-Z0-9!Â§$%&()=?Â´`+~*#-_.:,;<>|^Â°\' ]{3,20}$/", $ChannelPassword))
	{
	die('Channel Password invalid: "' . $ChannelPassword . '"<br /><br />' . $idUnica);
	}

if (preg_match("/^.*([Aa][Gg][Aa][Rr][Ll][Yy]|[Ee3][Pp][Ee3][Ff][Ff][Ee3][Cc][Tt][Ss]|[Pp][Aa][Ss][Ss]|[1Aa][12Bb][13Cc]|[3][2][1]|[QqAaYyZz][WwSsXx][RrDdCc]|[Bb][Aa][Ll][Ll]|[LlWw][OoTt][LlFf]|[Mm][Aa][Nn]).*$/", $ChannelPassword))
	{
	die('Channel Password invalid: "' . $ChannelPassword . '"<br />Password too common!<br /><br />' . $idUnica);
	}

$ts3_VirtualServer = TeamSpeak3::factory("serverquery://" . $UserAdmin . ":" . $PWQuery . "@" . $IP_TS . ":" . $PuertoQuery . "/?server_port=" . $PuertoTS . "&blocking=0&nickname=" . $nickname . "");
$ListaDeChannels = $ts3_VirtualServer->request("channellist")->toString();
$ListaDeChannels2 = $ts3_VirtualServer->request("channellist -topic")->toString();
$ListaDeGroups = $ts3_VirtualServer->execute("servergroupclientlist", array(
	"sgid" => $sgid
))->toString();

if (strpos($ListaDeChannels, $ChannelName))
	{
	echo "This name is already in use!";
	exit();
	}

try
	{
	$clID = $ts3_VirtualServer->clientGetByUid($idUnica);
	$infoCliente = $ts3_VirtualServer->execute("clientgetnamefromuid", array(
		"cluid" => $idUnica
	))->toList();
	$cldbid = strval($infoCliente['cldbid']);

	if (strpos($ListaDeChannels2, $idUnica))
		{
		echo "You are already the owner of a channel!<br /><br />" . $idUnica;
		exit;
		}

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
	if (strpos($ListaDeGroups, $cldbid))
		{
		$sub_cid = $ts3_VirtualServer->channelCreate(array(
			"channel_name" => $ChannelName,
			"channel_password" => $ChannelPassword,
			"channel_codec" => TeamSpeak3::CODEC_OPUS_VOICE,
			"channel_codec_quality" => '8',
			"channel_topic" => $idUnica,
			"channel_description" => "This channel was created through the webchannel function of the EPEffects Webinterface.",
			"channel_flag_permanent" => TRUE,
			"cpid" => $ChannelVater,
		));
		$ts3_VirtualServer->execute("channeledit", array(
			"cid" => $sub_cid,
			"channel_description" => "Click [url=http://web.agarly.com/webchannel/?uuid=" . $idUnica . "&channel=" . $sub_cid . "]here[/url] to change the description and password of this channel. This channel was created through the webchannel function of the EPEffects Webinterface.",
		));
		$ts3_VirtualServer->execute("clientmove", array(
			"clid" => $clID,
			"cid" => $sub_cid
		));
		$ts3_VirtualServer->execute("setclientchannelgroup", array(
			"cldbid" => $cldbid,
			"cid" => $sub_cid,
			"cgid" => $cgid,
		));
		echo "Your channel was created successfully!<br /><br />" . $idUnica;
		}
	  else
		{
		echo "You don't have the right rank!<br /><br />" . $idUnica;
		}
	}
  else
	{
	echo "You are not a real User!<br /><br />" . $idUnica;
	}

?>
