<?php
add_action('init','propanel_of_options');
if (!function_exists('propanel_of_options')) {
	function propanel_of_options(){

		//get global data
		global $wlm_themename, $wlm_shortname, $wpdb;

		//Populate the options array
		global $tt_options;
		$tt_options = get_option('of_options');

		//get page with blog page templates
		$tt_blog_pages = array();
		$tt_blog_pages[] = '';
		$blog_pages_sql = "SELECT post_title FROM $wpdb->postmeta left join $wpdb->posts on $wpdb->postmeta.post_id = $wpdb->posts.ID WHERE meta_value like 'template-homepage%'";
		$blog_pages = $wpdb->get_results($blog_pages_sql);
		foreach ($blog_pages as $blog_page) {
			$tt_blog_pages[] = $blog_page->post_title;
		}

		//Access the WordPress Pages via an Array
		$tt_pages = array();
		$tt_pages_obj = get_pages('sort_column=post_parent,menu_order');    
		foreach ($tt_pages_obj as $tt_page) {
		$tt_pages[$tt_page->ID] = $tt_page->post_name; }
		$tt_pages_tmp = array_unshift($tt_pages, __("Select a page:","royalnews_options")); 

		//Access the WordPress Categories via an Array
		$tt_categories = array();  
		$tt_categories_obj = get_categories('hide_empty=0');
		foreach ($tt_categories_obj as $tt_cat) {
		$tt_categories[$tt_cat->cat_ID] = $tt_cat->cat_name;}
		$categories_tmp = array_unshift($tt_categories, __("Select a category:","royalnews_options"));

		$theme_fonts = array(
			"", 
			"*** General Web Fonts ***", 
			"Arial", 
			"Comic Sans MS", 
			"Courier New", 
			"Georgia", 
			"Lucida Console", 
			"Palatino Linotype", 
			"Tahoma", 
			"Times New Roman", 
			"Verdana", 
			"Symbol", 
			"*** Google Web Fonts ***",
			"Abel" => "Abel",
			"Abril Fatface" => "Abril Fatface",
			"Aclonica" => "Aclonica",
			"Actor" => "Actor",
			"Adamina" => "Adamina",
			"Aguafina Script" => "Aguafina Script",
			"Aladin" => "Aladin",
			"Aldrich" => "Aldrich",
			"Alice" => "Alice",
			"Alike Angular" => "Alike Angular",
			"Alike" => "Alike",
			"Allan" => "Allan",
			"Allerta Stencil" => "Allerta Stencil",
			"Allerta" => "Allerta",
			"Amaranth" => "Amaranth",
			"Amatic SC" => "Amatic SC",
			"Andada" => "Andada",
			"Andika" => "Andika",
			"Annie Use Your Telescope" => "Annie Use Your Telescope",
			"Anonymous Pro" => "Anonymous Pro",
			"Antic" => "Antic",
			"Anton" => "Anton",
			"Arapey" => "Arapey",
			"Architects Daughter" => "Architects Daughter",
			"Arimo" => "Arimo",
			"Artifika" => "Artifika",
			"Arvo" => "Arvo",
			"Asset" => "Asset",
			"Astloch" => "Astloch",
			"Atomic Age" => "Atomic Age",
			"Aubrey" => "Aubrey",
			"Bangers" => "Bangers",
			"Bentham" => "Bentham",
			"Bevan" => "Bevan",
			"Bigshot One" => "Bigshot One",
			"Bitter" => "Bitter",
			"Black Ops One" => "Black Ops One",
			"Bowlby One SC" => "Bowlby One SC",
			"Bowlby One" => "Bowlby One",
			"Brawler" => "Brawler",
			"Bubblegum Sans" => "Bubblegum Sans",
			"Buda" => "Buda",
			"Butcherman Caps" => "Butcherman Caps",
			"Cabin Condensed" => "Cabin Condensed",
			"Cabin Sketch" => "Cabin Sketch",
			"Cabin" => "Cabin",
			"Cagliostro" => "Cagliostro",
			"Calligraffitti" => "Calligraffitti",
			"Candal" => "Candal",
			"Cantarell" => "Cantarell",
			"Cardo" => "Cardo",
			"Carme" => "Carme",
			"Carter One" => "Carter One",
			"Caudex" => "Caudex",
			"Cedarville Cursive" => "Cedarville Cursive",
			"Changa One" => "Changa One",
			"Cherry Cream Soda" => "Cherry Cream Soda",
			"Chewy" => "Chewy",
			"Chicle" => "Chicle",
			"Chivo" => "Chivo",
			"Coda Caption" => "Coda Caption",
			"Coda" => "Coda",
			"Comfortaa" => "Comfortaa",
			"Coming Soon" => "Coming Soon",
			"Contrail One" => "Contrail One",
			"Convergence" => "Convergence",
			"Cookie" => "Cookie",
			"Copse" => "Copse",
			"Corben" => "Corben",
			"Cousine" => "Cousine",
			"Coustard" => "Coustard",
			"Covered By Your Grace" => "Covered By Your Grace",
			"Crafty Girls" => "Crafty Girls",
			"Creepster Caps" => "Creepster Caps",
			"Crimson Text" => "Crimson Text",
			"Crushed" => "Crushed",
			"Cuprum" => "Cuprum",
			"Damion" => "Damion",
			"Dancing Script" => "Dancing Script",
			"Dawning of a New Day" => "Dawning of a New Day",
			"Days One" => "Days One",
			"Delius Swash Caps" => "Delius Swash Caps",
			"Delius Unicase" => "Delius Unicase",
			"Delius" => "Delius",
			"Devonshire" => "Devonshire",
			"Didact Gothic" => "Didact Gothic",
			"Dorsa" => "Dorsa",
			"Dr Sugiyama" => "Dr Sugiyama",
			"Droid Sans Mono" => "Droid Sans Mono",
			"Droid Sans" => "Droid Sans",
			"Droid Serif" => "Droid Serif",
			"EB Garamond" => "EB Garamond",
			"Eater Caps" => "Eater Caps",
			"Expletus Sans" => "Expletus Sans",
			"Fanwood Text" => "Fanwood Text",
			"Federant" => "Federant",
			"Federo" => "Federo",
			"Fjord One" => "Fjord One",
			"Fondamento" => "Fondamento",
			"Fontdiner Swanky" => "Fontdiner Swanky",
			"Forum" => "Forum",
			"Francois One" => "Francois One",
			"Gentium Basic" => "Gentium Basic",
			"Gentium Book Basic" => "Gentium Book Basic",
			"Geo" => "Geo",
			"Geostar Fill" => "Geostar Fill",
			"Geostar" => "Geostar",
			"Give You Glory" => "Give You Glory",
			"Gloria Hallelujah" => "Gloria Hallelujah",
			"Goblin One" => "Goblin One",
			"Gochi Hand" => "Gochi Hand",
			"Goudy Bookletter 1911" => "Goudy Bookletter 1911",
			"Gravitas One" => "Gravitas One",
			"Gruppo" => "Gruppo",
			"Hammersmith One" => "Hammersmith One",
			"Herr Von Muellerhoff" => "Herr Von Muellerhoff",
			"Holtwood One SC" => "Holtwood One SC",
			"Homemade Apple" => "Homemade Apple",
			"IM Fell DW Pica SC" => "IM Fell DW Pica SC",
			"IM Fell DW Pica" => "IM Fell DW Pica",
			"IM Fell Double Pica SC" => "IM Fell Double Pica SC",
			"IM Fell Double Pica" => "IM Fell Double Pica",
			"IM Fell English SC" => "IM Fell English SC",
			"IM Fell English" => "IM Fell English",
			"IM Fell French Canon SC" => "IM Fell French Canon SC",
			"IM Fell French Canon" => "IM Fell French Canon",
			"IM Fell Great Primer SC" => "IM Fell Great Primer SC",
			"IM Fell Great Primer" => "IM Fell Great Primer",
			"Iceland" => "Iceland",
			"Inconsolata" => "Inconsolata",
			"Indie Flower" => "Indie Flower",
			"Irish Grover" => "Irish Grover",
			"Istok Web" => "Istok Web",
			"Jockey One" => "Jockey One",
			"Josefin Sans" => "Josefin Sans",
			"Josefin Slab" => "Josefin Slab",
			"Judson" => "Judson",
			"Julee" => "Julee",
			"Jura" => "Jura",
			"Just Another Hand" => "Just Another Hand",
			"Just Me Again Down Here" => "Just Me Again Down Here",
			"Kameron" => "Kameron",
			"Kelly Slab" => "Kelly Slab",
			"Kenia" => "Kenia",
			"Knewave" => "Knewave",
			"Kranky" => "Kranky",
			"Kreon" => "Kreon",
			"Kristi" => "Kristi",
			"La Belle Aurore" => "La Belle Aurore",
			"Lancelot" => "Lancelot",
			"Lato" => "Lato",
			"League Script" => "League Script",
			"Leckerli One" => "Leckerli One",
			"Lekton" => "Lekton",
			"Lemon" => "Lemon",
			"Limelight" => "Limelight",
			"Linden Hill" => "Linden Hill",
			"Lobster Two" => "Lobster Two",
			"Lobster" => "Lobster",
			"Lora" => "Lora",
			"Love Ya Like A Sister" => "Love Ya Like A Sister",
			"Loved by the King" => "Loved by the King",
			"Luckiest Guy" => "Luckiest Guy",
			"Maiden Orange" => "Maiden Orange",
			"Mako" => "Mako",
			"Marck Script" => "Marck Script",
			"Marvel" => "Marvel",
			"Mate SC" => "Mate SC",
			"Mate" => "Mate",
			"Maven Pro" => "Maven Pro",
			"Meddon" => "Meddon",
			"MedievalSharp" => "MedievalSharp",
			"Megrim" => "Megrim",
			"Merienda One" => "Merienda One",
			"Merriweather" => "Merriweather",
			"Metrophobic" => "Metrophobic",
			"Michroma" => "Michroma",
			"Miltonian Tattoo" => "Miltonian Tattoo",
			"Miltonian" => "Miltonian",
			"Miss Fajardose" => "Miss Fajardose",
			"Miss Saint Delafield" => "Miss Saint Delafield",
			"Modern Antiqua" => "Modern Antiqua",
			"Molengo" => "Molengo",
			"Monofett" => "Monofett",
			"Monoton" => "Monoton",
			"Monsieur La Doulaise" => "Monsieur La Doulaise",
			"Montez" => "Montez",
			"Mountains of Christmas" => "Mountains of Christmas",
			"Mr Bedford" => "Mr Bedford",
			"Mr Dafoe" => "Mr Dafoe",
			"Mr De Haviland" => "Mr De Haviland",
			"Mrs Sheppards" => "Mrs Sheppards",
			"Muli" => "Muli",
			"Neucha" => "Neucha",
			"Neuton" => "Neuton",
			"News Cycle" => "News Cycle",
			"Niconne" => "Niconne",
			"Nixie One" => "Nixie One",
			"Nobile" => "Nobile",
			"Nosifer Caps" => "Nosifer Caps",
			"Nothing You Could Do" => "Nothing You Could Do",
			"Nova Cut" => "Nova Cut",
			"Nova Flat" => "Nova Flat",
			"Nova Mono" => "Nova Mono",
			"Nova Oval" => "Nova Oval",
			"Nova Round" => "Nova Round",
			"Nova Script" => "Nova Script",
			"Nova Slim" => "Nova Slim",
			"Nova Square" => "Nova Square",
			"Numans" => "Numans",
			"Nunito" => "Nunito",
			"Old Standard TT" => "Old Standard TT",
			"Open Sans Condensed" => "Open Sans Condensed",
			"Open Sans" => "Open Sans",
			"Orbitron" => "Orbitron",
			"Oswald" => "Oswald",
			"Over the Rainbow" => "Over the Rainbow",
			"Ovo" => "Ovo",
			"PT Sans Caption" => "PT Sans Caption",
			"PT Sans Narrow" => "PT Sans Narrow",
			"PT Sans" => "PT Sans",
			"PT Serif Caption" => "PT Serif Caption",
			"PT Serif" => "PT Serif",
			"Pacifico" => "Pacifico",
			"Passero One" => "Passero One",
			"Patrick Hand" => "Patrick Hand",
			"Paytone One" => "Paytone One",
			"Permanent Marker" => "Permanent Marker",
			"Petrona" => "Petrona",
			"Philosopher" => "Philosopher",
			"Piedra" => "Piedra",
			"Pinyon Script" => "Pinyon Script",
			"Play" => "Play",
			"Playfair Display" => "Playfair Display",
			"Podkova" => "Podkova",
			"Poller One" => "Poller One",
			"Poly" => "Poly",
			"Pompiere" => "Pompiere",
			"Prata" => "Prata",
			"Prociono" => "Prociono",
			"Puritan" => "Puritan",
			"Quattrocento Sans" => "Quattrocento Sans",
			"Quattrocento" => "Quattrocento",
			"Questrial" => "Questrial",
			"Quicksand" => "Quicksand",
			"Radley" => "Radley",
			"Raleway" => "Raleway",
			"Rammetto One" => "Rammetto One",
			"Rancho" => "Rancho",
			"Rationale" => "Rationale",
			"Redressed" => "Redressed",
			"Reenie Beanie" => "Reenie Beanie",
			"Ribeye Marrow" => "Ribeye Marrow",
			"Ribeye" => "Ribeye",
			"Righteous" => "Righteous",
			"Rochester" => "Rochester",
			"Rock Salt" => "Rock Salt",
			"Rokkitt" => "Rokkitt",
			"Rosario" => "Rosario",
			"Ruslan Display" => "Ruslan Display",
			"Salsa" => "Salsa",
			"Sancreek" => "Sancreek",
			"Sansita One" => "Sansita One",
			"Satisfy" => "Satisfy",
			"Schoolbell" => "Schoolbell",
			"Shadows Into Light" => "Shadows Into Light",
			"Shanti" => "Shanti",
			"Short Stack" => "Short Stack",
			"Sigmar One" => "Sigmar One",
			"Signika Negative" => "Signika Negative",
			"Signika" => "Signika",
			"Six Caps" => "Six Caps",
			"Slackey" => "Slackey",
			"Smokum" => "Smokum",
			"Smythe" => "Smythe",
			"Sniglet" => "Sniglet",
			"Snippet" => "Snippet",
			"Sorts Mill Goudy" => "Sorts Mill Goudy",
			"Special Elite" => "Special Elite",
			"Spinnaker" => "Spinnaker",
			"Spirax" => "Spirax",
			"Stardos Stencil" => "Stardos Stencil",
			"Sue Ellen Francisco" => "Sue Ellen Francisco",
			"Sunshiney" => "Sunshiney",
			"Supermercado One" => "Supermercado One",
			"Swanky and Moo Moo" => "Swanky and Moo Moo",
			"Syncopate" => "Syncopate",
			"Tangerine" => "Tangerine",
			"Tenor Sans" => "Tenor Sans",
			"Terminal Dosis" => "Terminal Dosis",
			"The Girl Next Door" => "The Girl Next Door",
			"Tienne" => "Tienne",
			"Tinos" => "Tinos",
			"Tulpen One" => "Tulpen One",
			"Ubuntu Condensed" => "Ubuntu Condensed",
			"Ubuntu Mono" => "Ubuntu Mono",
			"Ubuntu" => "Ubuntu",
			"Ultra" => "Ultra",
			"UnifrakturCook" => "UnifrakturCook",
			"UnifrakturMaguntia" => "UnifrakturMaguntia",
			"Unkempt" => "Unkempt",
			"Unlock" => "Unlock",
			"Unna" => "Unna",
			"VT323" => "VT323",
			"Varela Round" => "Varela Round",
			"Varela" => "Varela",
			"Vast Shadow" => "Vast Shadow",
			"Vibur" => "Vibur",
			"Vidaloka" => "Vidaloka",
			"Volkhov" => "Volkhov",
			"Vollkorn" => "Vollkorn",
			"Voltaire" => "Voltaire",
			"Waiting for the Sunrise" => "Waiting for the Sunrise",
			"Wallpoet" => "Wallpoet",
			"Walter Turncoat" => "Walter Turncoat",
			"Wire One" => "Wire One",
			"Yanone Kaffeesatz" => "Yanone Kaffeesatz",
			"Yellowtail" => "Yellowtail",
			"Yeseva One" => "Yeseva One",
			"Zeyada" => "Zeyada"
		);







		/*-----------------------------------------------------------------------------------*/
		/* Create The Custom Site Options Panel
		/*-----------------------------------------------------------------------------------*/
		$options = array(); // do not delete this line - sky will fall

		/* Option Page General - General Page */
		$options[] = array( "name" => __('General','royalnews_options'),
					"type" => "heading");
					
		$options[] = array( "name"	 => __('General Site Options','royalnews_options'),
					"std"	 => __('Upload web site logos, favicon, add custom css and tracking code.','royalnews_options'),
					"class"  => "heading-parent",
					"type"   => "info");
					
		$options[] = array( "name" => __('Website Logo (default)','royalnews_options'),
					"desc" => __('Upload a custom logo for your Website.','royalnews_options'),
					"id" => $wlm_shortname."_sitelogo",
					"std" => "",
					"type" => "upload");
					
		$options[] = array( "name" => __('Website Logo (small)','royalnews_options'),
					"desc" => __('Upload a custom logo for your Website.','royalnews_options'),
					"id" => $wlm_shortname."_sitelogo_small",
					"std" => "",
					"type" => "upload");
					
		$options[] = array( "name" => __('Website Logo (smaller)','royalnews_options'),
					"desc" => __('Upload a custom logo for your Website.','royalnews_options'),
					"id" => $wlm_shortname."_sitelogo_smaller",
					"std" => "",
					"type" => "upload");

		$options[] = array( "name" => __('Website Logo (retina)','royalnews_options'),
					"desc" => __('Upload a custom logo for your Website.','royalnews_options'),
					"id" => $wlm_shortname."_sitelogo_retina",
					"std" => "",
					"type" => "upload");			
					
		$options[] = array( "name" => __('Favicon','royalnews_options'),
					"desc" => __('Upload a 16px x 16px image that will represent your website\'s favicon.<br /><br /><em>To ensure cross-browser compatibility, we recommend converting the favicon into .ico format before uploading. </em>','royalnews_options'),
					"id" => $wlm_shortname."_favicon",
					"std" => "",
					"type" => "upload");
					
		$options[] = array( "name" => __('Custom CSS','royalnews_options'),
					"desc" => __('Add custom web site CSS.','royalnews_options'),
					"id" => $wlm_shortname."_custom_css",
					"std" => "",
					"type" => "textarea");

		$options[] = array( "name" => __('Tracking Code','royalnews_options'),
					"desc" => __('Paste Google Analytics (or other) tracking code here.','royalnews_options'),
					"id" => $wlm_shortname."_tracking_code",
					"std" => "",
					"type" => "textarea");


					
		/* Option Page header - Header Page */
		$options[] = array( "name" => __('Header','royalnews_options'),
					"type" => "heading");		

		$options[] = array(
					"name"	 => __('Header Options','royalnews_options'),
					"std"	 => __('Enable/Disable date, search and social icons sections from the header of every page.','royalnews_options'),
					"class"  => "heading-parent",
					"type"   => "info");
					
		$options[] = array( "name" => __('Disable Date, Search and Social links on home page','royalnews_options'),
					"desc" => "Disable all sections from the header only on Front Page.",
					"id" => $wlm_shortname."_header_date_search_socila_homepage",
					"std" => "false",
					"type" => "checkbox");
					
		$options[] = array( "name" => __('Date','royalnews_options'),
					"desc" => "Enable date on left side in the header.",
					"id" => $wlm_shortname."_header_date",
					"std" => "true",
					"type" => "checkbox");
					
		$options[] = array( "name" => __('Search','royalnews_options'),
					"desc" => "Enable Search on left side in the header, near date.",
					"id" => $wlm_shortname."_header_search",
					"std" => "true",
					"type" => "checkbox");

		$options[] = array( "name" => __('Social Icons','royalnews_options'),
					"desc" => "Enable Social Icons on right side in the header.",
					"id" => $wlm_shortname."_header_sociallinks",
					"std" => "false",
					"type" => "checkbox");


					
		/* Option Page Footer - Footer Page */
		$options[] = array( "name" => __('Footer','royalnews_options'),
					"type" => "heading");		
					
		$options[] = array(
					"name"	 => __('Footer Options','royalnews_options'),
					"std"	 => __('Add info for the sub footer section, like copyright, logos, etc. HTML code is accepted.','royalnews_options'),
					"class"  => "heading-parent",
					"type"   => "info");

		$options[] = array( "name" => __('Footer left side','royalnews_options'),
					"desc" => "Enter footer left side info.",
					"id" => $wlm_shortname."_footer_left",
					"std" => "&copy; Copyright 2014.",
					"type" => "textarea");

		$options[] = array( "name" => __('Footer right side','royalnews_options'),
					"desc" => "Enter footer right side info.",
					"id" => $wlm_shortname."_footer_right",
					"std" => '<a href="http://themeforest.net/user/WebLionMedia"><img src="http://royalnews.weblionmedia.com/wp-content/themes/royalnews/img/footer-logo.gif" alt="Royal News"></a><span>Theme by WebLionMedia</span>',
					"type" => "textarea");


					
		/* Option Page Blog - General Page */
		$options[] = array( "name" => __('Posts','royalnews_options'),
					"type" => "heading");

		$options[] = array(
					"name"	 => __('Post Options','royalnews_options'),
					"std"	 => __('Set the options related to single post options, also you can assign News Page (home page templates) to a Category.','royalnews_options'),
					"class"  => "heading-parent",
					"type"   => "info");
					
		/*$options[] = array( "name" => __('News Page As Homepage','royalnews_options'),
					"desc" => __('Select the page title of the News page template if you will use it as Front Page in "Settings > Reading".','royalnews_options'),
					"id" => $wlm_shortname."_blog_as_homepage_pagination",
					"std" => "",
					"type" => "select",
					"options" => $tt_blog_pages );*/

		$options[] = array( "name" => __('Related Posts Count','royalnews_options'),
					"desc" => __('Select the related posts count in single post.','royalnews_options'),
					"id" => $wlm_shortname."_blog_related_count",
					"std" => "10",
					"type" => "select",
					"options" => array("1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","20","25","30","35","40","45","50"));
					
		$options[] = array( "name" => __('Tags','royalnews_options'),
					"desc" => "Check this box to display post tags.",
					"id" => $wlm_shortname."_blog_tags",
					"std" => "true",
					"type" => "checkbox");

		$options[] = array( "name" => __('Page Socials','royalnews_options'),
					"desc" => "Check this box to display social sharing links.",
					"id" => $wlm_shortname."_blog_page_socials",
					"std" => "true",
					"type" => "checkbox");
					
		$options[] = array( "name" => __('Page Author','royalnews_options'),
					"desc" => "Check this box to display author info.",
					"id" => $wlm_shortname."_blog_page_author",
					"std" => "true",
					"type" => "checkbox");

		$options[] = array( "name" => __('Page Controls','royalnews_options'),
					"desc" => "Check this box to display next and previous controls for news posts.",
					"id" => $wlm_shortname."_blog_page_controls",
					"std" => "true",
					"type" => "checkbox");
					
		$options[] = array( "name" => __('Related Posts','royalnews_options'),
					"desc" => "Check this box to display related posts.",
					"id" => $wlm_shortname."_blog_related_posts",
					"std" => "true",
					"type" => "checkbox");

		$options[] = array( "name" => __('Comments','royalnews_options'),
					"desc" => "Check this box to display comments.",
					"id" => $wlm_shortname."_blog_comments",
					"std" => "true",
					"type" => "checkbox");

		$options[] = array( "name" => __('Assign News Page to a Category','royalnews_options'),
					"desc" => __('Select a Page to display News Category.','royalnews_options`'),
					"id" => $wlm_shortname."_blog_add",
					"type" => "blog_add_cats");

					


		/* Option Page Fonts - Fonts Links Page */
		$options[] = array( "name" => __('Fonts','royalnews_options'),
					"type" => "heading");

		$options[] = array(
					"name"	 => __('Web Site Font Options','royalnews_options'),
					"std"	 => __('Set fonts for entire site, menu and headings. Menu has options to set the menu size and the font height.','royalnews_options'),
					"class"  => "heading-parent",
					"type"   => "info");
					
		$options[] = array( "name" => __('Custom font name options','royalnews_options'),
					"desc" => __('Enable this option to use custom fonts.','royalnews_options'),
					"id" => $wlm_shortname."_site_custom_fonts_enable",
					"std" => "false",
					"type" => "checkbox");
					
		$options[] = array( "name" => __('Entire Site Font Name','weblionmedia'),
					"desc" => __('Set the font name for body content.','weblionmedia'),
					"id" => $wlm_shortname."_site_content_font",
					"std" => "",
					"type" => "select",
					"options" => $theme_fonts );

		$options[] = array( "name" => __('Headings Font Name','weblionmedia'),
					"desc" => __('Set the font name for Headings.','weblionmedia'),
					"id" => $wlm_shortname."_site_headings_font",
					"std" => "",
					"type" => "select",
					"options" => $theme_fonts );

		//menu fonts
		$options[] = array(
					"name"	 => __('Menu Font Options','royalnews_options'),
					"std"	 => __('Set font options for menu on the left column in the web site.','royalnews_options'),
					"class"  => "heading-parent",
					"type"   => "info");
					
		$options[] = array( "name" => __('Menu Font Name','weblionmedia'),
					"desc" => __('Set the font name for Left Column Menu.','weblionmedia'),
					"id" => $wlm_shortname."_site_menu_font",
					"std" => "",
					"type" => "select",
					"options" => $theme_fonts );
					
		$options[] = array( "name" => __('Menu Font Size','weblionmedia'),
					"desc" => __('Set the font size for Left Column Menu.','weblionmedia'),
					"id" => $wlm_shortname."_site_menu_font_size",
					"std" => "",
					"type" => "select",
					"options" => array("","8","9","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25") );
					
		$options[] = array( "name" => __('Menu Font Weight','weblionmedia'),
					"desc" => __('Set the font weight for Left Column Menu.','weblionmedia'),
					"id" => $wlm_shortname."_site_menu_font_weight",
					"std" => "",
					"type" => "select",
					"options" => array("", "normal", "bold", "100", "200", "300", "400", "500", "600", "700", "800", "900") );
					
					
					
					
					
					
					
					
					
		/* Option Page Styling - Styling Links Page */
		$options[] = array( "name" => __('Styling','royalnews_options'),
					"type" => "heading");

		$options[] = array(
					"name"	 => __('Web Site Styling Options','royalnews_options'),
					"std"	 => __('In this section you set backgrounds color and fonts color for header, menu, footer and sub footer.','royalnews_options'),
					"class"  => "heading-parent",
					"type"   => "info");
					
		$options[] = array( "name" => __('Custom backgrounds, text, links colors','royalnews_options'),
					"desc" => __('Enable this option to use custom colors.','royalnews_options'),
					"id" => $wlm_shortname."_site_custom_colors_enable",
					"std" => "false",
					"type" => "checkbox");

		$options[] = array(
					"name"	 => __('Background Color','royalnews_options'),
					"std"	 => __('Set the background color for header, left column and footer with sub footer','royalnews_options'),
					"class"  => "heading-parent",
					"type"   => "info");					
					
		$options[] = array( "name" => __('Primary color','royalnews_options'),
					"desc" => __('Default primary color code: #d50000','royalnews_options'),
					"id" => $wlm_shortname."_color_primary",
					"std" => "",
					"type" => "color");
					
		$options[] = array( "name" => __('Top bar header background','royalnews_options'),
					"desc" => __('The top bar above the logo, default color code: #252525','royalnews_options'),
					"id" => $wlm_shortname."_color_topbar",
					"std" => "",
					"type" => "color");

		$options[] = array( "name" => __('Left column background','royalnews_options'),
					"desc" => __('Default color code: #252525','royalnews_options'),
					"id" => $wlm_shortname."_color_leftcol",
					"std" => "",
					"type" => "color");
					
		$options[] = array( "name" => __('Footer  background','royalnews_options'),
					"desc" => __('Default color code: #121212','royalnews_options'),
					"id" => $wlm_shortname."_color_footer",
					"std" => "",
					"type" => "color");
					
		$options[] = array( "name" => __('SubFooter  background','royalnews_options'),
					"desc" => __('Default color code: #252525','royalnews_options'),
					"id" => $wlm_shortname."_color_subfooter",
					"std" => "",
					"type" => "color");

		//Left menu items color, links, active links
		$options[] = array(
					"name"	 => __('Left Menu Font Color','royalnews_options'),
					"std"	 => __('Set the font color for menu text, links, on hover links.','royalnews_options'),
					"class"  => "heading-parent",
					"type"   => "info");

		$options[] = array( "name" => __('Left Column Menu Link Color','royalnews_options'),
					"desc" => __('Default Link color code: #c9c9c9','royalnews_options'),
					"id" => $wlm_shortname."_color_leftmenu_text",
					"std" => "",
					"type" => "color");

		$options[] = array( "name" => __('Left Column Menu Link On Hover Color','royalnews_options'),
					"desc" => __('Default Link color code: #ffffff','royalnews_options'),
					"id" => $wlm_shortname."_color_leftmenu_onhover_text",
					"std" => "",
					"type" => "color");

		$options[] = array( "name" => __('Left Column Menu Link Active Color','royalnews_options'),
					"desc" => __('Default Link color code: #ffffff','royalnews_options'),
					"id" => $wlm_shortname."_color_leftmenu_active_text",
					"std" => "",
					"type" => "color");

					
					
		//Left menu widget text color, links, links on hover
		$options[] = array( "name" => __('Left Column Text Color','royalnews_options'),
					"desc" => __('Default text color code: #bdbdbd','royalnews_options'),
					"id" => $wlm_shortname."_color_leftcol_text",
					"std" => "",
					"type" => "color");

		$options[] = array( "name" => __('Left Column Link Color','royalnews_options'),
					"desc" => __('Default text color code: #ffffff','royalnews_options'),
					"id" => $wlm_shortname."_color_leftcol_links_text",
					"std" => "",
					"type" => "color");

		$options[] = array( "name" => __('Left Column Link On Hover Color','royalnews_options'),
					"desc" => __('Default text color code: #ffffff','royalnews_options'),
					"id" => $wlm_shortname."_color_leftcol_links_onhover_text",
					"std" => "",
					"type" => "color");
					
					
		//Footer text color, links, links on hover
		$options[] = array(
					"name"	 => __('Footer Font Color','royalnews_options'),
					"std"	 => __('Set the font color for footer text, links, on hover links.','royalnews_options'),
					"class"  => "heading-parent",
					"type"   => "info");
		$options[] = array( "name" => __('Footer Headings Color','royalnews_options'),
					"desc" => __('Default text color code: #ffffff','royalnews_options'),
					"id" => $wlm_shortname."_color_footer_headings",
					"std" => "",
					"type" => "color");
					
		$options[] = array( "name" => __('Footer Text Color','royalnews_options'),
					"desc" => __('Default text color code: #bdbdbd','royalnews_options'),
					"id" => $wlm_shortname."_color_footer_text",
					"std" => "",
					"type" => "color");

		$options[] = array( "name" => __('Footer Column Link Color','royalnews_options'),
					"desc" => __('Default text color code: #c9c9c9','royalnews_options'),
					"id" => $wlm_shortname."_color_footer_links_text",
					"std" => "",
					"type" => "color");

		$options[] = array( "name" => __('Footer Link On Hover Color','royalnews_options'),
					"desc" => __('Default text color code: #ffffff','royalnews_options'),
					"id" => $wlm_shortname."_color_footer_links_onhover_text",
					"std" => "",
					"type" => "color");
					
					
					
		//SubFooter text color, links, links on hover			
		$options[] = array(
					"name"	 => __('Sub Footer Font Color','royalnews_options'),
					"std"	 => __('Set the font color for sub footer text, links, on hover links.','royalnews_options'),
					"class"  => "heading-parent",
					"type"   => "info");

		$options[] = array( "name" => __('SubFooter Text Color','royalnews_options'),
					"desc" => __('Default text color code: #ffffff','royalnews_options'),
					"id" => $wlm_shortname."_color_subfooter_text",
					"std" => "",
					"type" => "color");

		$options[] = array( "name" => __('SubFooter Column Link Color','royalnews_options'),
					"desc" => __('Default text color code: #ffffff','royalnews_options'),
					"id" => $wlm_shortname."_color_subfooter_links_text",
					"std" => "",
					"type" => "color");

		$options[] = array( "name" => __('SubFooter Link On Hover Color','royalnews_options'),
					"desc" => __('Default text color code: #ffffff','royalnews_options'),
					"id" => $wlm_shortname."_color_subfooter_links_onhover_text",
					"std" => "",
					"type" => "color");
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					



					
					
		/* Option Page Social - Social Links Page */
		$options[] = array( "name" => __('Social','royalnews_options'),
					"type" => "heading");
					
		$options[] = array(
					"name"	 => __('Social Links URLs','royalnews_options'),
					"std"	 => __('Add social links, full URLs for your account to be displayed in the header of the pages.','royalnews_options'),
					"class"  => "heading-parent",
					"type"   => "info");
					
		$options[] = array( "name" => __('Twitter','royalnews_options'),
					"desc" => __('Enter your full twitter url.','royalnews_options'),
					"id" => $wlm_shortname."_twitter",
					"std" => "",
					"type" => "text");
		$options[] = array( "name" => __('Facebook','royalnews_options'),
					"desc" => __('Enter your full Facebook url.','royalnews_options'),
					"id" => $wlm_shortname."_facebook",
					"std" => "",
					"type" => "text");
		$options[] = array( "name" => __('Pinterest','royalnews_options'),
					"desc" => __('Enter your full Pinterest url.','royalnews_options'),
					"id" => $wlm_shortname."_pinterest",
					"std" => "",
					"type" => "text");
		$options[] = array( "name" => __('Google+','royalnews_options'),
					"desc" => __('Enter your full Google plus url.','royalnews_options'),
					"id" => $wlm_shortname."_googleplus",
					"std" => "",
					"type" => "text");			
		$options[] = array( "name" => __('Instagram','royalnews_options'),
					"desc" => __('Enter your full Instagram url.','royalnews_options'),
					"id" => $wlm_shortname."_instagram",
					"std" => "",
					"type" => "text");




					
		/*
		#############################
		#######Twitter Options########
		#############################
		*/
		$options[] = array( "name" => __('Twitter','royalnews_options'),
					"type" => "heading");

		$options[] = array(
					"name"	 => __('Twitter Options','royalnews_options'),
					"std"	 => __("Set Twitter account name, tweets count, consumer key, consumer secret, access token, access token secret. Create your application here: <a href='https://dev.twitter.com/apps' target='_blank'>https://dev.twitter.com/apps</a>",'royalnews_options'),
					"class"  => "heading-parent",
					"type"   => "info");
					
		$options[] = array( "name" => __('Twitter User Name','royalnews_options'),
					"desc" => __('','royalnews_options'),
					"id" => $wlm_shortname."_twitter_username",
					"std" => "",
					"type" => "text");
		$options[] = array( "name" => __('TweetsCount','royalnews_options'),
					"desc" => __('','royalnews_options'),
					"id" => $wlm_shortname."_twitter_count",
					"std" => "2",
					"type" => "text");
		$options[] = array( "name" => __('Consumer Key','royalnews_options'),
					"desc" => __('','royalnews_options'),
					"id" => $wlm_shortname."_twitter_consumerkey",
					"std" => "",
					"type" => "text");
		$options[] = array( "name" => __('Consumer Secret','royalnews_options'),
					"desc" => __('','royalnews_options'),
					"id" => $wlm_shortname."_twitter_consumersecret",
					"std" => "",
					"type" => "text");
		$options[] = array( "name" => __('Access Token','royalnews_options'),
					"desc" => __('','royalnews_options'),
					"id" => $wlm_shortname."_twitter_accesstoken",
					"std" => "",
					"type" => "text");
		$options[] = array( "name" => __('Access Token Secret','royalnews_options'),
					"desc" => __('','royalnews_options'),
					"id" => $wlm_shortname."_twitter_accesstoken_secret",
					"std" => "",
					"type" => "text");

			





		/* Option Contact Page */
		$options[] = array( "name" => __('Contact','royalnews_options'),
					"type" => "heading");		

		$options[] = array(
					"name"	 => __('Contact Page Options','royalnews_options'),
					"std"	 => __('Add the receiver email for contact page. Enable/Disable Google Map and set options for it.','royalnews_options'),
					"class"  => "heading-parent",
					"type"   => "info");
					
		$options[] = array( "name" => __('Contact Email','royalnews_options'),
					"desc" => "Set email address where you will receive emails from contact page.",
					"id" => $wlm_shortname."_contact_form_email",
					"std" => "",
					"type" => "text");
					
		$options[] = array( "name" => __('Enable Google Map','royalnews_options'),
					"desc" => "Check this box to Google Map in Contact page.",
					"id" => $wlm_shortname."_google_map",
					"std" => "false",
					"type" => "checkbox");
					
		$options[] = array( "name" => __('Google Map Latitude','royalnews_options'),
					"desc" => "Set Latitude for Google Map.",
					"id" => $wlm_shortname."_google_map_lat",
					"std" => "",
					"type" => "text");

		$options[] = array( "name" => __('Google Map Longitude','royalnews_options'),
					"desc" => "Set Longitude for Google Map.",
					"id" => $wlm_shortname."_google_map_lng",
					"std" => "",
					"type" => "text");

		$options[] = array( "name" => __('Contact Info','royalnews_options'),
					"desc" => "Add contact info that will be displayed in Google Map.",
					"id" => $wlm_shortname."_contact_info",
					"std" => "",
					"type" => "textarea");
					

			
					
					


					

		/* Option Home page style */
		$options[] = array( "name" => __('Home Style 1','royalnews_options'),
					"type" => "heading");

		$options[] = array(
					"name"	 => __('1st Home Page Style Options','royalnews_options'),
					"std"	 => __('Set options for page template name "Home 1".','royalnews_options'),
					"class"  => "heading-parent",
					"type"   => "info");
					
		$options[] = array( "name"  => __('Top Sticky Posts Section','royalnews_options'),
					"std"   => __('Options for first 3 sticky posts.','royalnews_options'),
					"class" => "heading-parent heading-parent-alt",
					"type"  => "info");	
					
		$options[] = array( "name" => __('Top Sticky Posts','royalnews_options'),
					"desc" => __('Display the first 3 sticky posts in the top of the page.','royalnews_options'),
					"id" => $wlm_shortname."_home1_slider",
					"std" => "true",
					"type" => "checkbox");
					
					
					
		$options[] = array( "name"  => __('Default News Listing','royalnews_options'),
					"std"   => __('Options for default news listing that is located below the Top Sticky Posts.','royalnews_options'),
					"class" => "heading-parent heading-parent-alt",
					"type"  => "info");

		$options[] = array( "name" => __('First column items count','royalnews_options'),
					"desc" => __('Select the count of the news in first column','royalnews_options'),
					"id" => $wlm_shortname."_home1_col1_newscount",
					"std" => "4",
					"type" => "select",
					"options" => array("0","1","2","3","4","5","6","7","8","9","10"));

		$options[] = array( "name" => __('Second column items count','royalnews_options'),
					"desc" => __('Select the count of the news in second column','royalnews_options'),
					"id" => $wlm_shortname."_home1_col2_newscount",
					"std" => "5",
					"type" => "select",
					"options" => array("0","1","2","3","4","5","6","7","8","9","10"));

		$options[] = array( "name" => __('Third column items count','royalnews_options'),
					"desc" => __('Select the count of the news in third column','royalnews_options'),
					"id" => $wlm_shortname."_home1_col3_newscount",
					"std" => "3",
					"type" => "select",
					"options" => array("0","1","2","3","4","5","6","7","8","9","10"));
					
		$options[] = array( "name" => __('Small News Description','royalnews_options'),
					"desc" => __('Enable the Small News Description','royalnews_options'),
					"id" => $wlm_shortname."_home1_post_excerpt",
					"std" => "false",
					"type" => "checkbox");			
					
					
		$options[] = array( "name"  => __('MAIN NEWS Section','royalnews_options'),
					"std"   => __('Options for MAIN NEWS section. This section is location on the right column where the default news are listing.','royalnews_options'),
					"class" => "heading-parent heading-parent-alt",
					"type"  => "info");	
					
		$options[] = array( "name" => __('MAIN NEWS','royalnews_options'),
					"desc" => __('Display Main News section.','royalnews_options'),
					"id" => $wlm_shortname."_home1_mainnews",
					"std" => "false",
					"type" => "checkbox");
					
		$options[] = array( "name" => __('MAIN NEWS Title','royalnews_options'),
					"desc" => __('Enter the title.','royalnews_options'),
					"id" => $wlm_shortname."_home1_mainnews_title",
					"std" => "MAIN NEWS",
					"type" => "text");

		$options[] = array( "name" => __('MAIN NEWS Items','royalnews_options'),
					"desc" => __('Enter the IDs for items separated by commas, that will be listed in the Main News section (can be post or news post format).','royalnews_options'),
					"id" => $wlm_shortname."_home1_mainnews_items",
					"std" => "",
					"type" => "text");
					
					
					
					

		$options[] = array( "name"  => __('MOST POPULAR MATERIALS Section','royalnews_options'),
					"std"   => __('Options for MOST POPULAR MATERIALS section.','royalnews_options'),
					"class" => "heading-parent heading-parent-alt",
					"type"  => "info");	
					
		$options[] = array( "name" => __('MOST POPULAR MATERIALS','royalnews_options'),
					"desc" => __('Display the most popular materials in the bottom of the page.','royalnews_options'),
					"id" => $wlm_shortname."_home1_popular",
					"std" => "true",
					"type" => "checkbox");
					
		$options[] = array( "name" => __('MOST POPULAR MATERIALS Title','royalnews_options'),
					"desc" => __('Enter the Most Popular Materials section title.','royalnews_options'),
					"id" => $wlm_shortname."_home1_popular_title",
					"std" => "MOST POPULAR MATERIALS",
					"type" => "text");
					
		$options[] = array( "name" => __('MOST POPULAR MATERIALS Count','royalnews_options'),
					"desc" => __('Select the count of the most popular materials: posts or news.','royalnews_options'),
					"id" => $wlm_shortname."_home1_popular_count",
					"std" => "10",
					"type" => "select",
					"options" => array("1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","20","25","30","35","40","45","50"));
			
					
					
					

		/* Option Home page style */
		$options[] = array( "name" => __('Home Style 2','royalnews_options'),
					"type" => "heading");

		$options[] = array(
					"name"	 => __('2nd Home Page Style Options','royalnews_options'),
					"std"	 => __('Set options for page template name "Home 2".','royalnews_options'),
					"class"  => "heading-parent",
					"type"   => "info");
					
		$options[] = array( "name"  => __('Top Sticky Posts Section','royalnews_options'),
					"std"   => __('Options for first 3 sticky posts.','royalnews_options'),
					"class" => "heading-parent heading-parent-alt",
					"type"  => "info");	
					
		$options[] = array( "name" => __('Top Sticky Posts','royalnews_options'),
					"desc" => __('Display the sticky posts in the top of the page.','royalnews_options'),
					"id" => $wlm_shortname."_home2_sticky_posts",
					"std" => "true",
					"type" => "checkbox");

		$options[] = array( "name" => __('Sticky Posts Count','royalnews_options'),
					"desc" => __('Select the sticky posts count.','royalnews_options'),
					"id" => $wlm_shortname."_home2_sticky_count",
					"std" => "3",
					"type" => "select",
					"options" => array("1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","20","25","30","35","40","45","50"));
					
					
					
		$options[] = array( "name"  => __('Default News Listing','royalnews_options'),
					"std"   => __('Options for default news listing that is located below the Top Sticky Posts.','royalnews_options'),
					"class" => "heading-parent heading-parent-alt",
					"type"  => "info");

		$options[] = array( "name" => __('First column items count','royalnews_options'),
					"desc" => __('Select the count of the news in first column','royalnews_options'),
					"id" => $wlm_shortname."_home2_col1_newscount",
					"std" => "4",
					"type" => "select",
					"options" => array("0","1","2","3","4","5","6","7","8","9","10"));

		$options[] = array( "name" => __('Second column items count','royalnews_options'),
					"desc" => __('Select the count of the news in second column','royalnews_options'),
					"id" => $wlm_shortname."_home2_col2_newscount",
					"std" => "5",
					"type" => "select",
					"options" => array("0","1","2","3","4","5","6","7","8","9","10"));
					
		$options[] = array( "name" => __('Third column items count','royalnews_options'),
					"desc" => __('Select the count of the news in third column','royalnews_options'),
					"id" => $wlm_shortname."_home2_col3_newscount",
					"std" => "5",
					"type" => "select",
					"options" => array("0","1","2","3","4","5","6","7","8","9","10"));
					
		$options[] = array( "name" => __('Small News Description','royalnews_options'),
					"desc" => __('Enable the Small News Description','royalnews_options'),
					"id" => $wlm_shortname."_home2_post_excerpt",
					"std" => "false",
					"type" => "checkbox");


		$options[] = array( "name"  => __('MAIN NEWS Section','royalnews_options'),
					"std"   => __('Options for MAIN NEWS section. This section is location on the right column where the default news are listing.','royalnews_options'),
					"class" => "heading-parent heading-parent-alt",
					"type"  => "info");	
					
		$options[] = array( "name" => __('MAIN NEWS','royalnews_options'),
					"desc" => __('Display Main News section.','royalnews_options'),
					"id" => $wlm_shortname."_home2_mainnews",
					"std" => "false",
					"type" => "checkbox");
					
		$options[] = array( "name" => __('MAIN NEWS Title','royalnews_options'),
					"desc" => __('Enter the title.','royalnews_options'),
					"id" => $wlm_shortname."_home2_mainnews_title",
					"std" => "MAIN NEWS",
					"type" => "text");

		$options[] = array( "name" => __('MAIN NEWS Items','royalnews_options'),
					"desc" => __('Enter the IDs for items separated by commas, that will be listed in the Main News section (can be post or news post format).','royalnews_options'),
					"id" => $wlm_shortname."_home2_mainnews_items",
					"std" => "",
					"type" => "text");
					
					

		$options[] = array( "name"  => __('MOST POPULAR MATERIALS Section','royalnews_options'),
					"std"   => __('Options for MOST POPULAR MATERIALS section.','royalnews_options'),
					"class" => "heading-parent heading-parent-alt",
					"type"  => "info");	
					
		$options[] = array( "name" => __('MOST POPULAR MATERIALS','royalnews_options'),
					"desc" => __('Display the most popular materials in the bottom of the page.','royalnews_options'),
					"id" => $wlm_shortname."_home2_popular",
					"std" => "true",
					"type" => "checkbox");
					
		$options[] = array( "name" => __('MOST POPULAR MATERIALS Title','royalnews_options'),
					"desc" => __('Enter the Most Popular Materials section title.','royalnews_options'),
					"id" => $wlm_shortname."_home2_popular_title",
					"std" => "MOST POPULAR MATERIALS",
					"type" => "text");
					
		$options[] = array( "name" => __('MOST POPULAR MATERIALS Count','royalnews_options'),
					"desc" => __('Select the count of the most popular materials: posts or news.','royalnews_options'),
					"id" => $wlm_shortname."_home2_popular_count",
					"std" => "10",
					"type" => "select",
					"options" => array("1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","20","25","30","35","40","45","50"));





					
		/* Option Home page style */
		$options[] = array( "name" => __('Home Style 3','royalnews_options'),
					"type" => "heading");

		$options[] = array(
					"name"	 => __('3rd Home Page Style Options','royalnews_options'),
					"std"	 => __('Set options for page template name "Home 3".','royalnews_options'),
					"class"  => "heading-parent",
					"type"   => "info");
					
		$options[] = array( "name"  => __('Top Sticky Posts Section','royalnews_options'),
					"std"   => __('Options for first 3 sticky posts.','royalnews_options'),
					"class" => "heading-parent heading-parent-alt",
					"type"  => "info");	
					
		$options[] = array( "name" => __('Top Sticky Posts','royalnews_options'),
					"desc" => __('Display the sticky posts in the top of the page.','royalnews_options'),
					"id" => $wlm_shortname."_home3_sticky_posts",
					"std" => "true",
					"type" => "checkbox");

		$options[] = array( "name" => __('Sticky Posts Count','royalnews_options'),
					"desc" => __('Select the sticky posts count.','royalnews_options'),
					"id" => $wlm_shortname."_home3_sticky_count",
					"std" => "3",
					"type" => "select",
					"options" => array("1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","20","25","30","35","40","45","50"));
					
					
					
		$options[] = array( "name"  => __('Default News Listing','royalnews_options'),
					"std"   => __('Options for default news listing that is located below the Top Sticky Posts.','royalnews_options'),
					"class" => "heading-parent heading-parent-alt",
					"type"  => "info");

		$options[] = array( "name" => __('First column items count','royalnews_options'),
					"desc" => __('Select the count of the news in first column','royalnews_options'),
					"id" => $wlm_shortname."_home3_col1_newscount",
					"std" => "5",
					"type" => "select",
					"options" => array("0","1","2","3","4","5","6","7","8","9","10"));

		$options[] = array( "name" => __('Second column items count','royalnews_options'),
					"desc" => __('Select the count of the news in second column','royalnews_options'),
					"id" => $wlm_shortname."_home3_col2_newscount",
					"std" => "5",
					"type" => "select",
					"options" => array("0","1","2","3","4","5","6","7","8","9","10"));

					
		$options[] = array( "name" => __('Small News Description','royalnews_options'),
					"desc" => __('Enable the Small News Description','royalnews_options'),
					"id" => $wlm_shortname."_home3_post_excerpt",
					"std" => "false",
					"type" => "checkbox");

					
					
		$options[] = array( "name"  => __('MOST POPULAR MATERIALS Section','royalnews_options'),
					"std"   => __('Options for MOST POPULAR MATERIALS section.','royalnews_options'),
					"class" => "heading-parent heading-parent-alt",
					"type"  => "info");	
					
		$options[] = array( "name" => __('MOST POPULAR MATERIALS','royalnews_options'),
					"desc" => __('Display the most popular materials in the bottom of the page.','royalnews_options'),
					"id" => $wlm_shortname."_home3_popular",
					"std" => "true",
					"type" => "checkbox");
					
		$options[] = array( "name" => __('MOST POPULAR MATERIALS Title','royalnews_options'),
					"desc" => __('Enter the Most Popular Materials section title.','royalnews_options'),
					"id" => $wlm_shortname."_home3_popular_title",
					"std" => "MOST POPULAR MATERIALS",
					"type" => "text");
					
		$options[] = array( "name" => __('MOST POPULAR MATERIALS Count','royalnews_options'),
					"desc" => __('Select the count of the most popular materials: posts or news.','royalnews_options'),
					"id" => $wlm_shortname."_home3_popular_count",
					"std" => "10",
					"type" => "select",
					"options" => array("1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","20","25","30","35","40","45","50"));
					
					
					
					
					
					
		/* Option Home page style */
		$options[] = array( "name" => __('Home Style 4','royalnews_options'),
					"type" => "heading");

		$options[] = array(
					"name"	 => __('4th Home Page Style Options','royalnews_options'),
					"std"	 => __('Set options for page template name "Home 4".','royalnews_options'),
					"class"  => "heading-parent",
					"type"   => "info");

		$options[] = array( "name"  => __('Top Sticky Posts Section','royalnews_options'),
					"std"   => __('Options for first 4 sticky posts.','royalnews_options'),
					"class" => "heading-parent heading-parent-alt",
					"type"  => "info");	
					
		$options[] = array( "name" => __('Top Sticky Posts','royalnews_options'),
					"desc" => __('Display the sticky posts in the top of the page.','royalnews_options'),
					"id" => $wlm_shortname."_home4_sticky_posts",
					"std" => "true",
					"type" => "checkbox");

		$options[] = array( "name" => __('Sticky Posts Count','royalnews_options'),
					"desc" => __('Select the sticky posts count.','royalnews_options'),
					"id" => $wlm_shortname."_home4_sticky_count",
					"std" => "3",
					"type" => "select",
					"options" => array("1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","20","25","30","35","40","45","50"));
					
					
					
		$options[] = array( "name"  => __('Default News Listing','royalnews_options'),
					"std"   => __('Options for default news listing that is located below the Top Sticky Posts.','royalnews_options'),
					"class" => "heading-parent heading-parent-alt",
					"type"  => "info");

		$options[] = array( "name" => __('First column items count','royalnews_options'),
					"desc" => __('Select the count of the news in first column','royalnews_options'),
					"id" => $wlm_shortname."_home4_col1_newscount",
					"std" => "5",
					"type" => "select",
					"options" => array("0","1","2","3","4","5","6","7","8","9","10"));

		$options[] = array( "name" => __('Second column items count','royalnews_options'),
					"desc" => __('Select the count of the news in second column','royalnews_options'),
					"id" => $wlm_shortname."_home4_col2_newscount",
					"std" => "5",
					"type" => "select",
					"options" => array("0","1","2","3","4","5","6","7","8","9","10"));

					
		$options[] = array( "name" => __('Small News Description','royalnews_options'),
					"desc" => __('Enable the Small News Description','royalnews_options'),
					"id" => $wlm_shortname."_home4_post_excerpt",
					"std" => "false",
					"type" => "checkbox");
					

		$options[] = array( "name"  => __('MOST POPULAR MATERIALS Section','royalnews_options'),
					"std"   => __('Options for MOST POPULAR MATERIALS section.','royalnews_options'),
					"class" => "heading-parent heading-parent-alt",
					"type"  => "info");	
					
		$options[] = array( "name" => __('MOST POPULAR MATERIALS','royalnews_options'),
					"desc" => __('Display the most popular materials in the bottom of the page.','royalnews_options'),
					"id" => $wlm_shortname."_home4_popular",
					"std" => "true",
					"type" => "checkbox");
					
		$options[] = array( "name" => __('MOST POPULAR MATERIALS Title','royalnews_options'),
					"desc" => __('Enter the Most Popular Materials section title.','royalnews_options'),
					"id" => $wlm_shortname."_home4_popular_title",
					"std" => "MOST POPULAR MATERIALS",
					"type" => "text");
					
		$options[] = array( "name" => __('MOST POPULAR MATERIALS Count','royalnews_options'),
					"desc" => __('Select the count of the most popular materials: posts or news.','royalnews_options'),
					"id" => $wlm_shortname."_home4_popular_count",
					"std" => "10",
					"type" => "select",
					"options" => array("1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","20","25","30","35","40","45","50"));
					
					
					
					
					
					

		/* Option Home page style */
		$options[] = array( "name" => __('Home Style 5','royalnews_options'),
					"type" => "heading");

		$options[] = array(
					"name"	 => __('5th Home Page Style Options','royalnews_options'),
					"std"	 => __('Set options for page template name "Home 5".','royalnews_options'),
					"class"  => "heading-parent",
					"type"   => "info");
					
		$options[] = array( "name"  => __('Top Sticky Posts Section','royalnews_options'),
					"std"   => __('Options for sticky posts.','royalnews_options'),
					"class" => "heading-parent heading-parent-alt",
					"type"  => "info");	
					
		$options[] = array( "name" => __('Top Sticky Posts','royalnews_options'),
					"desc" => __('Display the sticky posts in the top of the page.','royalnews_options'),
					"id" => $wlm_shortname."_home5_sticky_posts",
					"std" => "true",
					"type" => "checkbox");

		$options[] = array( "name" => __('Sticky Posts Count','royalnews_options'),
					"desc" => __('Select the sticky posts count.','royalnews_options'),
					"id" => $wlm_shortname."_home5_sticky_count",
					"std" => "3",
					"type" => "select",
					"options" => array("1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","20","25","30","35","40","45","50"));
					
					
					
		$options[] = array( "name"  => __('Default News Listing','royalnews_options'),
					"std"   => __('Options for default news listing that is located below the Top Sticky Posts.','royalnews_options'),
					"class" => "heading-parent heading-parent-alt",
					"type"  => "info");

		$options[] = array( "name" => __('First column items count','royalnews_options'),
					"desc" => __('Select the count of the news in first column','royalnews_options'),
					"id" => $wlm_shortname."_home5_col1_newscount",
					"std" => "5",
					"type" => "select",
					"options" => array("0","1","2","3","4","5","6","7","8","9","10"));

		$options[] = array( "name" => __('Second column items count','royalnews_options'),
					"desc" => __('Select the count of the news in second column','royalnews_options'),
					"id" => $wlm_shortname."_home5_col2_newscount",
					"std" => "5",
					"type" => "select",
					"options" => array("0","1","2","3","4","5","6","7","8","9","10"));

					
		$options[] = array( "name" => __('Small News Description','royalnews_options'),
					"desc" => __('Enable the Small News Description','royalnews_options'),
					"id" => $wlm_shortname."_home5_post_excerpt",
					"std" => "false",
					"type" => "checkbox");
					
					


		$options[] = array( "name"  => __('MOST POPULAR MATERIALS Section','royalnews_options'),
					"std"   => __('Options for MOST POPULAR MATERIALS section.','royalnews_options'),
					"class" => "heading-parent heading-parent-alt",
					"type"  => "info");	
					
		$options[] = array( "name" => __('MOST POPULAR MATERIALS','royalnews_options'),
					"desc" => __('Display the most popular materials in the bottom of the page.','royalnews_options'),
					"id" => $wlm_shortname."_home5_popular",
					"std" => "true",
					"type" => "checkbox");
					
		$options[] = array( "name" => __('MOST POPULAR MATERIALS Title','royalnews_options'),
					"desc" => __('Enter the Most Popular Materials section title.','royalnews_options'),
					"id" => $wlm_shortname."_home5_popular_title",
					"std" => "MOST POPULAR MATERIALS",
					"type" => "text");
					
		$options[] = array( "name" => __('MOST POPULAR MATERIALS Count','royalnews_options'),
					"desc" => __('Select the count of the most popular materials: posts or news.','royalnews_options'),
					"id" => $wlm_shortname."_home5_popular_count",
					"std" => "10",
					"type" => "select",
					"options" => array("1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","20","25","30","35","40","45","50"));
					
					
					
					
					

		/* Option Home page style */
		$options[] = array( "name" => __('Home Style 6','royalnews_options'),
					"type" => "heading");

		$options[] = array(
					"name"	 => __('6th Home Page Style Options','royalnews_options'),
					"std"	 => __('Set options for page template name "Home 6".','royalnews_options'),
					"class"  => "heading-parent",
					"type"   => "info");
					
		$options[] = array( "name" => __('Posts count','royalnews_options'),
					"desc" => __('Select the count of the video posts','royalnews_options'),
					"id" => $wlm_shortname."_home6_newscount",
					"std" => "12",
					"type" => "select",
					"options" => array("3","6","9","12","15","18","21","24","27","30","39","48","60"));
					
		$options[] = array( "name" => __('Small News Description','royalnews_options'),
					"desc" => __('Enable the Small News Description','royalnews_options'),
					"id" => $wlm_shortname."_home6_post_excerpt",
					"std" => "false",
					"type" => "checkbox");
					
		$options[] = array( "name" => __('Pagination Style','royalnews_options'),
					"desc" => __('Select the pagination style: AJAX or Page Numbers','royalnews_options'),
					"id" => $wlm_shortname."_home6_pagination",
					"std" => "AJAX",
					"type" => "select",
					"options" => array(__("AJAX","royalnews_options"),__("Page Numbers","royalnews_options"),__("Next&Previous Links","royalnews_options")));
					
					


		$options[] = array( "name"  => __('MOST POPULAR MATERIALS Section','royalnews_options'),
					"std"   => __('Options for MOST POPULAR MATERIALS section.','royalnews_options'),
					"class" => "heading-parent heading-parent-alt",
					"type"  => "info");	
					
		$options[] = array( "name" => __('MOST POPULAR MATERIALS','royalnews_options'),
					"desc" => __('Display the most popular materials in the bottom of the page.','royalnews_options'),
					"id" => $wlm_shortname."_home6_popular",
					"std" => "true",
					"type" => "checkbox");
					
		$options[] = array( "name" => __('MOST POPULAR MATERIALS Title','royalnews_options'),
					"desc" => __('Enter the Most Popular Materials section title.','royalnews_options'),
					"id" => $wlm_shortname."_home6_popular_title",
					"std" => "MOST POPULAR MATERIALS",
					"type" => "text");
					
		$options[] = array( "name" => __('MOST POPULAR MATERIALS Count','royalnews_options'),
					"desc" => __('Select the count of the most popular materials: posts or news.','royalnews_options'),
					"id" => $wlm_shortname."_home6_popular_count",
					"std" => "10",
					"type" => "select",
					"options" => array("1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","20","25","30","35","40","45","50"));
					
					
					


		/* Option Home page style */
		$options[] = array( "name" => __('HomeStyle 7','royalnews_options'),
					"type" => "heading");

		$options[] = array(
					"name"	 => __('7th Home Page Style Options','royalnews_options'),
					"std"	 => __('Set options for page template name "Home 7".','royalnews_options'),
					"class"  => "heading-parent",
					"type"   => "info");
					
		$options[] = array( "name"  => __('Top Sticky Posts Section','royalnews_options'),
					"std"   => __('Options for sticky posts.','royalnews_options'),
					"class" => "heading-parent heading-parent-alt",
					"type"  => "info");	
					
		$options[] = array( "name" => __('Top Sticky Posts','royalnews_options'),
					"desc" => __('Display the sticky posts in the top of the page.','royalnews_options'),
					"id" => $wlm_shortname."_home7_sticky_posts",
					"std" => "true",
					"type" => "checkbox");

		$options[] = array( "name" => __('Sticky Posts Count','royalnews_options'),
					"desc" => __('Select the sticky posts count.','royalnews_options'),
					"id" => $wlm_shortname."_home7_sticky_count",
					"std" => "3",
					"type" => "select",
					"options" => array("1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","20","25","30","35","40","45","50"));
					
					
		$options[] = array( "name"  => __('Default News Listing','royalnews_options'),
					"std"   => __('Options for default news listing that is located below the Top Sticky Posts.','royalnews_options'),
					"class" => "heading-parent heading-parent-alt",
					"type"  => "info");			
					
		$options[] = array( "name" => __('Posts count','royalnews_options'),
					"desc" => __('Select the count of the news posts','royalnews_options'),
					"id" => $wlm_shortname."_home7_newscount",
					"std" => "12",
					"type" => "select",
					"options" => array("1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","20","25","30","35","40","45","50"));
					
		$options[] = array( "name" => __('Small News Description','royalnews_options'),
					"desc" => __('Enable the Small News Description','royalnews_options'),
					"id" => $wlm_shortname."_home7_post_excerpt",
					"std" => "false",
					"type" => "checkbox");	

					
					
		$options[] = array( "name"  => __('MOST POPULAR MATERIALS Section','royalnews_options'),
					"std"   => __('Options for MOST POPULAR MATERIALS section.','royalnews_options'),
					"class" => "heading-parent heading-parent-alt",
					"type"  => "info");	
					
		$options[] = array( "name" => __('MOST POPULAR MATERIALS','royalnews_options'),
					"desc" => __('Display the most popular materials in the bottom of the page.','royalnews_options'),
					"id" => $wlm_shortname."_home7_popular",
					"std" => "true",
					"type" => "checkbox");
					
		$options[] = array( "name" => __('MOST POPULAR MATERIALS Title','royalnews_options'),
					"desc" => __('Enter the Most Popular Materials section title.','royalnews_options'),
					"id" => $wlm_shortname."_home7_popular_title",
					"std" => "MOST POPULAR MATERIALS",
					"type" => "text");
					
		$options[] = array( "name" => __('MOST POPULAR MATERIALS Count','royalnews_options'),
					"desc" => __('Select the count of the most popular materials: posts or news.','royalnews_options'),
					"id" => $wlm_shortname."_home7_popular_count",
					"std" => "10",
					"type" => "select",
					"options" => array("1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","20","25","30","35","40","45","50"));
					
					
					
		update_option('of_template',$options); 					  
		update_option('of_shortname',$wlm_shortname);

	}
}
?>