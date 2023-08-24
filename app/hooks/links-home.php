<?php
	/*
	 * You can add custom links in the home page by appending them here ...
	 * The format for each link is:
		$homeLinks[] = [
			'url' => 'path/to/link', 
			'title' => 'Link title', 
			'description' => 'Link text',
			'groups' => ['group1', 'group2'], // groups allowed to see this link, use '*' if you want to show the link to all groups
			'grid_column_classes' => '', // optional CSS classes to apply to link block. See: https://getbootstrap.com/css/#grid
			'panel_classes' => '', // optional CSS classes to apply to panel. See: https://getbootstrap.com/components/#panels
			'link_classes' => '', // optional CSS classes to apply to link. See: https://getbootstrap.com/css/#buttons
			'icon' => 'path/to/icon', // optional icon to use with the link
			'table_group' => '' // optional name of the table group you wish to add the link to. If the table group name contains non-Latin characters, you should convert them to html entities.
		];
	 */


		$homeLinks[] = [
			'url' => 'https://bigprof.com/appgini/', 
			'icon' => 'https://cdn.bigprof.com/images/appgini/logo-flat-xs.png', 
			'title' => 'AppGini homepage', 
			'description' => 'You can add your own links to the homepage like this one by adding an entry for each link in the generated "hooks/links-home.php" file.',
			'groups' => ['*'], // groups allowed to see this link
			'grid_column_classes' => 'col-sm-6 col-md-4 col-lg-3',
			'panel_classes' => 'panel-success',
			'link_classes' => 'btn-success',
			'table_group' => 'Sales'
		];

		$homeLinks[] = [
			'url' => 'nwdemo.zip', 
			'title' => 'Want to try this demo on your own server? Download it now!', 
			'description' => 'Download all the files of this demo application, including the AppGini project file, the generated files and the SQL dump of data. To set up the demo either on your own PC or on a web server, please refer to the included README.txt file.',
			'groups' => ['*'], // groups allowed to see this link
			'grid_column_classes' => 'col-sm-8 col-md-8 col-lg-6',
			'panel_classes' => 'panel-primary',
			'link_classes' => 'btn-primary',
			'table_group' => 'Sales'
		];
