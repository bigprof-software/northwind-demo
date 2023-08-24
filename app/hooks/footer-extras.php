<?php if(!$_REQUEST['Embedded']) { ?>
	<div id="more-info-demo" class="hidden">
		<div id="more-info-demo-icon" class="pull-left text-success"><i class="glyphicon glyphicon-info-sign"></i></div>
		<p>This is a demo application created using <a href="https://bigprof.com/appgini/">AppGini</a>.
		You can browse it anonymously (read-only access), or <a href="index.php?signIn=1">sign in</a>
		with username <code>demo</code> and password <code>demo</code> to be able to add records
		(you can edit only the records added by <i>demo</i> but not other records.)</p>

		<p>You can as well <a href="membership_signup.php">sign up</a> as a new user. You'll then be able to add records and edit/delete them. You can only view all other records but not edit/delete them.</p>

		<p>User groups and permissions are a built-in feature in all apps created by AppGini.
			You can <a href="https://bigprof.com/appgini/screencasts/managing-access-permissions-for-logged-in-users">see in this screencast how to configure group permissions</a>.</p>
	</div>
	
	<div id="demo-tools" class="hidden text-center">
		<div class="btn-group" style="width: 98%; max-width: 900px;">
			<button type="button" onclick="location.assign('https://bigprof.com/appgini/');" class="btn btn-default" style="width: 33%">
				<span class="hidden-xs hidden-sm"><i class="glyphicon glyphicon-heart"></i> Powered by</span>
				AppGini <span class="appgini-version"></span>
			</button>

			<button type="button" class="btn btn-default" id="prev-theme" title="Previous theme" style="width: 5%"><i class="glyphicon glyphicon-triangle-left"></i></button>
			<button type="button" class="btn btn-default active" id="demo-options" style="width: 24%">
				<span class="hidden-xs hidden-sm">Active theme</span>
				<span class="badge" id="demo-theme-name">Bootstrap</span>
			</button>
			<button type="button" class="btn btn-default" id="next-theme" title="Next theme" style="width: 5%"><i class="glyphicon glyphicon-triangle-right"></i></button>

			<button type="button" class="btn btn-default" id="compact-toggle" title="Compact/Large" style="width: 5%"><i class="glyphicon glyphicon-resize-full"></i></button>
			
			<button type="button" class="btn btn-default" id="show-more-info" style="width: 18%">
				<i class="glyphicon glyphicon-info-sign"></i>
				<span class="hidden-xs hidden-sm"> More info</span>
			</button>
			
			<button type="button" class="btn btn-default" id="hide-demo-tools" title="Hide me!">
				<i class="glyphicon glyphicon-remove"></i>
			</button>
		</div>
	</div>

	<div id="restore-demo-tools" class="hidden text-left">
		<button type="button" class="btn btn-default" title="Change theme"><i class="glyphicon glyphicon-cog"></i></button>
	</div>
	
	<style>
		#more-info-demo-icon {
			font-size: 4em;
			margin-right: 10px;
			-webkit-transform: rotate(-16deg);
			-ms-transform: rotate(-16deg);
			transform: rotate(-16deg);
		}
		#demo-tools, #restore-demo-tools {
			position: fixed;
			bottom: 0;
			left: 0;
			right: 0;
			z-index: 1030;
			padding: 5px;
		}
		#restore-demo-tools {
			width: 100px;
		}
		#restore-demo-tools button {
			box-shadow: 0px 0px 10px 1px #000;
		}
		#demo-tools .btn{
			white-space: normal;
		}
		@media (max-width: 991px){
			#demo-tools .btn { max-width: 32%; }
		}
	</style>
	
	<script>
		var notEmbedded = true;

		$j(function(){
			/* Get AppGini version */
			var appginiVersion = $j('.navbar-fixed-bottom small a').text().replace(/[a-z ]*/i, '');
			$j('.appgini-version').html(appginiVersion);
			
			/* Remove the bottom nav */
			$j('.navbar-fixed-bottom').remove();
			
			/* Apply navbar color, bgcolor and border styles to #demo-tools */
			$j('#demo-tools').css({
				'border': $j('.navbar').css('border'),
				'background-color': $j('.navbar').css('background-color')
			});
			
			/* Same height for all #demo-tools buttons */
			setTimeout(demoToolsSameHeight, 2500);
			
			$j('#show-more-info').click(function(){
				modal_window({
					message: $j('#more-info-demo').html(),
					title: 'About this demo',
					footer: [{
						label: 'Close',
						bs_class: 'default'
					}]
				});
			});

			$j('#next-theme, #prev-theme').on('click', function() {
				var next = ($j(this).attr('id') == 'next-theme'),
					themeIndex = themes.indexOf(cookie('theme'));

				if(themeIndex == -1) themeIndex = 0;

				if(next) {
					themeIndex++;
					if(themeIndex >= themes.length) themeIndex = 0;
				} else {
					themeIndex--;
					if(themeIndex < 0) themeIndex = themes.length - 1;
				}

				cookie('theme', themes[themeIndex]);
				applyTheme(themes[themeIndex]);
				demoToolsSameHeight();
			});

			$j('#compact-toggle').click(function() {
				compact(
					$j(this).children('.glyphicon').hasClass('glyphicon-resize-small')
				);
			})
			
			$j('#hide-demo-tools').click(function() {
				applyDemoToolsVisibility('off');
			});

			$j('#restore-demo-tools').on('click', 'button', function() {
				applyDemoToolsVisibility('on');
			})
		});
	</script>
<?php } ?>

<script>
	/* list of available themes */
	var themes = [
		'bootstrap.css',
		'cerulean.css',
		'cosmo.css',
		'cyborg.css',
		'darkly.css',
		'flatly.css',
		'journal.css',
		'paper.css',
		'readable.css',
		'sandstone.css',
		'simplex.css',
		'slate.css',
		'spacelab.css',
		'superhero.css',
		'united.css',
		'yeti.css'
	];

	if(typeof(notEmbedded) == 'undefined') var notEmbedded = false;

	function applyDemoToolsVisibility(viz) {
		if(notEmbedded === undefined) return;
		if(viz === undefined) viz = cookie('displayDemoTools');
		if(viz === 'null') viz = 'on';

		$j('#restore-demo-tools').toggleClass('hidden', viz == 'on');
		$j('#demo-tools').toggleClass('hidden', viz != 'on');
		if(viz === 'on') demoToolsSameHeight();

		cookie('displayDemoTools', viz);
	}

	function applyTheme(new_theme){
		/* get configured theme */
		var theme = new_theme;
		var pre_path = <?php echo json_encode(PREPEND_PATH); ?>;
		theme = theme || cookie('theme');
		theme = theme || 'bootstrap.css'; // default theme if no cookie and no theme passed
		
		if(!theme.match(/.*?\.css$/)) return;

		/* remove current theme */
		$j('link[rel=stylesheet][href*="initializr/css/"]').remove();
		$j('link[rel=stylesheet][href="dynamic.css"]').remove();
		$j('body > div.users-area')
			.removeClass(themes.map((theme) => 'theme-' + theme.replace(/\.css$/, '')).join(' '))
			.addClass(`theme-${theme.replace(/\.css$/, '')}`);

		/* apply configured theme */
		$j('head').append('<link rel="stylesheet" href="' + pre_path + 'resources/initializr/css/' + theme + '">');
		$j('head').append('<link rel="stylesheet" href="' + pre_path + 'dynamic.css">');
		
		/* update displayed theme name */
		$j('#demo-theme-name').html(ucfirst(theme.replace(/\.css$/, '')));
	
		/* Apply navbar color, bgcolor and border styles to #demo-tools */
		$j('#demo-tools').css({
			'border': $j('.navbar').css('border'),
			'background-color': $j('.navbar').css('background-color')
		});
	}

	function compact(turnOn) {
		// on by default
		if(turnOn === undefined)
			turnOn = (cookie('compactMode') != 'false');

		if(notEmbedded !== undefined)
			$j('#compact-toggle > .glyphicon')
				.toggleClass('glyphicon-resize-small', !turnOn)
				.toggleClass('glyphicon-resize-full', turnOn);

		$j('body > div.users-area').toggleClass('theme-compact', turnOn);
		cookie('compactMode', turnOn);
	}
	
	function cookie(name, val){
		if(val !== undefined) createCookie(name, val, 0.1);
		return String(readCookie(name));
	}
	
	function ucfirst(str) {
		str += '';
		var f = str.charAt(0).toUpperCase();
		return f + str.substr(1);
	}

	function createCookie(name, value, days) {
		var expires;

		if (days) {
			var date = new Date();
			date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
			expires = "; expires=" + date.toGMTString();
		} else {
			expires = "";
		}
		document.cookie = encodeURIComponent(name) + "=" + encodeURIComponent(value) + expires + "; path=/";
	}

	function readCookie(name) {
		var nameEQ = encodeURIComponent(name) + "=";
		var ca = document.cookie.split(';');
		for (var i = 0; i < ca.length; i++) {
			var c = ca[i];
			while (c.charAt(0) === ' ') c = c.substring(1, c.length);
			if (c.indexOf(nameEQ) === 0) return decodeURIComponent(c.substring(nameEQ.length, c.length));
		}
		return null;
	}

	function eraseCookie(name) {
		createCookie(name, "", -1);
	}

	function demoToolsSameHeight() {
		if(notEmbedded === undefined) return;
		var max_height = 30;
		$j('#demo-tools .btn').each(function(){
			var bh = $j(this).height();
			if(bh > max_height) max_height = bh;
		});
		$j('#demo-tools .btn').height(max_height);				
	};

	function showDemoInfoOnce() {
		if(notEmbedded === undefined) return;
		if(cookie('demoInfoShownBefore') === 'yes') return;

		cookie('demoInfoShownBefore', 'yes');
		$j('#show-more-info').click();
	}

	function showInfoInLoginPage() {
		$j('#login_splash').html(
			'<div style="max-width: 600px; margin: 0 auto;"><h1>About this demo</h1>' + 
				$j('#more-info-demo').html() + 
			'</div>'
		);
	}

	function getThemeFromUrl() {
		if(!/\btheme=\w+/.test(location.search)) return;
		let theme = location.search.match(/\btheme=(\w+)/)[1] + '.css';
		if(themes.indexOf(theme) < 0) return;

		cookie('theme', theme);
	}

	// startup
	$j(function() {
		getThemeFromUrl();
		applyTheme();
		applyDemoToolsVisibility();
		compact();
		showDemoInfoOnce();
		showInfoInLoginPage();
	});
</script>
