<?php
/*
Plugin Name: COLOURlovers RSS Widget
Plugin URI: http://johndturner.com/wordpress-stuff/plugins/colourlovers-rss-widget/
Description: Displays RSS feeds with images from COLOURlovers.com | <a href="http://www.colourlovers.com/rss">http://www.colourlovers.com/rss</a>
Author: John Turner
Version: 0.01
Author URI: http://johndturner.com

*/


// We're putting the plugin's functions inside the init function to ensure the
// required Sidebar Widget functions are available.
  
  function widget_COLOURlovers_init() 
	  {
	  /* Your custom code starts here */
	  /* ---------------------------- */
	  
	  /* Your Function */
	  function COLOURlovers()
	  {
		  
		  /* Your Code ----------------- */ 
		  
		           include_once(ABSPATH.WPINC.'/rss.php');  
			      $options = get_option('widget_COLOURlovers');
			      $rssurl = empty($options['rss']) ? __('http://feeds2.feedburner.com/COLOURloversCoup0Palettes/Top?format=xml') : $options['rss'];
                     $count = empty($options['count']) ? 10 : $options['count'];
				 $url=$rssurl;
		 		 $rss = fetch_rss($url);
                     if($count > 10) $count =10;
				 
                      
		                $i=0;
					 foreach( $rss->items as $k=>$v) {
                              if($i == $count) break;
					 	echo '<h3>'.$v['title'].'</h3><br /><a href="'.$v['link'].'">'.$v['description'].'</a>';
                              $i++;
					 }
		  
		  /* End of Your Code ---------- */
		  
	  }
	  
	  /* -------------------------- */
	  /* Your custom code ends here */
	  
	  function widget_COLOURlovers($args) 
	  {
	  
	  	  // Collect our widget's options, or define their defaults.
		  $options = get_option('widget_COLOURlovers');
		  $title = empty($options['title']) ? __('COLOURlovers RSS') : $options['title'];
			
		  extract($args);
		  echo $before_widget;
		  echo $before_title;
		  echo $title;
		  echo $after_title;
		  COLOURlovers();
		  echo $after_widget;
	  }  
	  
	  // This is the function that outputs the form to let users edit
	  // the widget's title. It's an optional feature, but were're doing 
	  // it all for you so why not!
	  
	  function widget_COLOURlovers_control()
	  {
	  
		// Collect our widget options.
		$options = $newoptions = get_option('widget_COLOURlovers');
		
		// This is for handing the control form submission.
		if ( $_POST['widget_COLOURlovers-submit'] ) 
		{
			// Clean up control form submission options
			$newoptions['title'] = strip_tags(stripslashes($_POST['widget_COLOURlovers-title']));
               $newoptions['rss'] = strip_tags(stripslashes($_POST['widget_COLOURlovers-rss']));
               $newoptions['count'] = strip_tags(stripslashes($_POST['widget_COLOURlovers-count']));
		}
		// If original widget options do not match control form
		// submission options, update them.
		if ( $options != $newoptions ) 
		{
			$options = $newoptions;
			update_option('widget_COLOURlovers', $options);
		}
						
		$title = attribute_escape($options['title']);
          $rss = attribute_escape($options['rss']);
          $count = attribute_escape($options['count']);

		echo '<p><label for="COLOURlovers-title">';
		echo 'Title: <input style="width: 250px;" id="widget_COLOURlovers-title" name="widget_COLOURlovers-title" type="text" value="';
		echo $title;
		echo '" />';
		echo '</label></p>';
		echo '<p><label for="COLOURlovers-rss">';
		echo 'Rss: <input style="width: 250px;" id="widget_COLOURlovers-rss" name="widget_COLOURlovers-rss" type="text" value="';
		echo $rss;
		echo '" />';
		echo '</label></p>';
		echo '<p><label for="COLOURlovers-count">';
		echo 'How many do you want to show?: <input style="width: 250px;" id="widget_COLOURlovers-count" name="widget_COLOURlovers-count" type="text" value="';
		echo $count;
		echo '" />';
		echo '</label></p>';
		echo '<input type="hidden" id="widget_COLOURlovers-submit" name="widget_COLOURlovers-submit" value="1" />';
	  }
	  
	  
	// This registers the widget.
    register_sidebar_widget('COLOURlovers Rss', 'widget_COLOURlovers');
	
	// This registers the (optional!) widget control form.
    register_widget_control('COLOURlovers Rss', 'widget_COLOURlovers_control');
	
  }
    
  add_action('plugins_loaded', 'widget_COLOURlovers_init');

?>
