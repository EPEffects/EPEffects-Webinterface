<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Create permanent teamspeak channels on ts.agarly.com">
    <meta name="keywords" content="agarly, com, agarlycom, epeffects, de, epeffectsde, agario, agar, io, cell, cells, virus, bacteria, blob, game, games, web game, html5, fun, flash">
    <meta name="robots" content="index, follow">
    <meta name="viewport" content="minimal-ui, width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta property="og:title" content="Agarly" />
    <meta property="og:description" content="Create permanent teamspeak channels on ts.agarly.com" />
    <meta property="og:url" content="http://agarly.com" />
    <meta property="og:image" content="img/1200x630.png" />
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="630" />
    <meta property="og:type" content="website" />
    <title>EPEffects | Channel Creation</title>
    <!-- Stylesheets -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/animation.css" rel="stylesheet">
    <link href="css/checkbox/orange.html" rel="stylesheet">
    <link href="css/preview.css" rel="stylesheet">
    <link href="css/authenty.css" rel="stylesheet">

    <!-- Font Awesome CDN -->
    <link href="netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Roboto+Slab:400,700,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,700' rel='stylesheet' type='text/css'>

    <style type="text/css"></style>
</head>

<body style="">

    <section id="authenty_preview" style="height: 512px;">
        <section id="signin_main" class="authenty signin-main" style="height: 512px;">
            <div class="section-content">
                <div class="wrap">
                    <div class="container">
                        <div class="form-wrap">
                            <div class="row">
                                <div id="form_1" data-animation="bounceIn" class="animated bounceIn">
                                    <div class="form-main">


                                        <?php

if (isset($_GET['uuid']))
	{
	$uniqueid = $_GET['uuid'];
	$uniqueid = str_replace(' ', '+', $uniqueid);
	function get_client_ip()
		{
		$ipaddress = '';
		if (getenv('HTTP_CLIENT_IP')) $ipaddress = getenv('HTTP_CLIENT_IP');
		  else
		if (getenv('HTTP_X_FORWARDED_FOR')) $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
		  else
		if (getenv('HTTP_X_FORWARDED')) $ipaddress = getenv('HTTP_X_FORWARDED');
		  else
		if (getenv('HTTP_FORWARDED_FOR')) $ipaddress = getenv('HTTP_FORWARDED_FOR');
		  else
		if (getenv('HTTP_FORWARDED')) $ipaddress = getenv('HTTP_FORWARDED');
		  else
		if (getenv('REMOTE_ADDR')) $ipaddress = getenv('REMOTE_ADDR');
		  else $ipaddress = 'UNKNOWN';
		return $ipaddress;
		}
	}
  else
	{
	die("no uuid found");
	}

$str1 = md5($uniqueid);
$str2 = md5(get_client_ip());
$longid = md5($str1 . $str2 . $PWQuery . $Salt);
$id = substr($longid, 0, -22);

if (isset($_GET['channel']))
	{
	$channelid = $_GET['channel'];
	print_r('<form method="post" action="desc.php" id="editform"><div class="form-group">');
	print_r('<input type="text" name="desc" class="form-control" placeholder="Channel Description" pattern="{3,1024}" title="min: 3 signs, max: 1024 signs" value="">');
	print_r('<input type="password" name="ChannelPass" class="form-control" placeholder="Channel Password" pattern="{3,20}" title="min: 3 signs, max: 20 signs" value="">');
	print_r('<input type="password" name="ChannelPass2" class="form-control" placeholder="Repeat Channel Password" pattern="{3,20}" title="Repeat your Channel Password" value="">');
	print_r('<input type="hidden" name="idts" class="form-control" placeholder="UniqueID" required="required" title="Example: 1ZlQNlhMPhTuWaitnS61q0FNX1s=" pattern="{25,50}" value="' . $uniqueid . '">');
	print_r('<input type="hidden" name="id" class="form-control" placeholder="ExactID" required="required" title="Example: 123abcd456" pattern="{10}" value="' . $id . '">');
	print_r('<input type="hidden" name="channel" class="form-control" placeholder="ChannelID" required="required" title="Example: 321" value="' . $channelid . '">');
	}
  else
	{
	print_r('<form method="post" action="create.php"><div class="form-group">');
	print_r('<input type="text" name="name" class="form-control" placeholder="Channel Name" required="required" pattern="{3,20}" title="min: 3 signs, max: 20 signs" value="">');
	print_r('<input type="password" name="ChannelPass" class="form-control" placeholder="Channel Password" pattern="{3,20}" title="min: 3 signs, max: 20 signs" value="">');
	print_r('<input type="password" name="ChannelPass2" class="form-control" placeholder="Repeat Channel Password" pattern="{3,20}" title="Repeat your Channel Password" value="">');
	print_r('<input type="hidden" name="idts" class="form-control" placeholder="UniqueID" required="required" title="Example: 1ZlQNlhMPhTuWaitnS61q0FNX1s=" pattern="{25,50}" value="' . $uniqueid . '">');
	print_r('<input type="hidden" name="id" class="form-control" placeholder="ExactID" required="required" title="Example: 123abcd456" pattern="{10}" value="' . $id . '">');
	}

?>



                                    </div>
                                    <button id="signIn_1" type="submit" class="btn btn-block signin">Create your channel</button>
                                    </form>
                                </div>
                                <div class="form-footer">
                                    <div class="row">
                                        <div class="col-xs-5">
                                            <i class="fa fa-check"></i>
                                            <a href="#Rules" id="CreatedChannels">Rules</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </section>
        <section id="Rules" class="authenty password-recovery">
            <div class="section-content">
                <div class="wrap">
                    <div class="container">
                        <div class="form-wrap">
                            <div class="row">
                                <div class="col-xs-12 col-sm-3 brand" data-animation="fadeInUp">
                                    <h2>Agarly.com</h2>
                                    <p>TeamSpeak³</p>
                                </div>
                                <div class="col-sm-1 hidden-xs">
                                    <div class="horizontal-divider"></div>
                                </div>
                                <div class="col-xs-12 col-sm-8 main" data-animation="fadeInLeft" data-animation-delay=".5s">

                                    <table class="table table-bordered">
                                        <tr class="danger">
                                            <th>Rules to create channels on ts.agarly.com</th>
                                        </tr>
                                    </table>
                                    <p>
                                        Rules :<br/> 1.Only use the signs A-Z & 0-9 in your channel name.<br/> 2.Don't write the password in the channel name.<br/><br/>
                                    </p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>


    <!-- js library -->
    <script src="ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="ajax.googleapis.com/ajax/libs/jqueryui/1.10.0/jquery-ui.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.icheck.min.js"></script>
    <script src="js/waypoints.min.js"></script>

    <!-- authenty js -->
    <script src="js/authenty.js"></script>

    <!-- preview scripts -->
    <script src="js/preview/jquery.malihu.PageScroll2id.js"></script>
    <script src="js/preview/jquery.address-1.6.min.js"></script>
    <script src="js/preview/scrollTo.min.js"></script>
    <script src="js/preview/init.js"></script>


    <!-- preview scripts -->
    <script>
        (function($) {

            // get full window size
            $(window).on('load resize', function() {
                var w = $(window).width();
                var h = $(window).height();

                $('section').height(h);
            });

            // scrollTo plugin
            $('#HowToUniqueID').scrollTo({
                easing: 'easeInOutQuint',
                speed: 1500
            });
            $('#CreatedChannels').scrollTo({
                easing: 'easeInOutQuint',
                speed: 1500
            });

            // set focus on input
            var firstInput = $('section').find('input[type=text], input[type=email]').filter(':visible:first');

            if (firstInput != null) {
                firstInput.focus();
            }

            $('section').waypoint(function(direction) {
                var target = $(this).find('input[type=text], input[type=email]').filter(':visible:first');
                target.focus();
            }, {
                offset: 300
            }).waypoint(function(direction) {
                var target = $(this).find('input[type=text], input[type=email]').filter(':visible:first');
                target.focus();
            }, {
                offset: -400
            });


            // animation handler
            $('[data-animation-delay]').each(function() {
                var animationDelay = $(this).data("animation-delay");
                $(this).css({
                    "-webkit-animation-delay": animationDelay,
                    "-moz-animation-delay": animationDelay,
                    "-o-animation-delay": animationDelay,
                    "-ms-animation-delay": animationDelay,
                    "animation-delay": animationDelay
                });
            });

            $('[data-animation]').waypoint(function(direction) {
                if (direction == "down") {
                    $(this).addClass("animated " + $(this).data("animation"));
                }
            }, {
                offset: '90%'
            }).waypoint(function(direction) {
                if (direction == "up") {
                    $(this).removeClass("animated " + $(this).data("animation"));
                }
            }, {
                offset: '100%'
            });

        })(jQuery);
    </script>
</body>

</html>