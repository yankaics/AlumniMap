<?php

// mysql hostname
$db_host = "localhost";

// database name
$db_name = "copypeng_map2";

// database user name
$db_user = "copypeng_map";

// database password
$db_pass = ".KOweb";

// admin username
$admin_user = "map";

// admin password
$admin_pass = "map";

// Show events on the map? If set to "true", an event
// category will appear in the marker list, and you can
// run events_get.php in your browser (or a chron) to populate
// it with data from eventbrite.
$show_events = false;

    // put your eventbrite api key here
    $eb_app_key = "";

    // search eventbrite for these keywords
    // add %20OR%20 between keywords for an "OR" search
    // example: startup%20OR%20demo+day
    $eb_keywords = "startup";

    // specify city to search in and around
    // example: Santa+Monica
    $eb_city = "";

    // specify search radius (in miles)
    $eb_within_radius = 50;



// HTML that goes just before </head>
$head_html = "";

// attribution (must leave link intact, per our license)
?>