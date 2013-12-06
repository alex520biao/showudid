<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">




<html>

  <head>
    <title>显示你的设备UDID</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
	<!-- The browser.css file contain all information required to style the pages -->
    <link rel="stylesheet" href="browser.css">
	<!-- The browser.js implements all functionalities needed by the sample. It uses classes contained in transition.js to navigate between pages. -->
    <script type="text/javascript" src="browser.js" charset="utf-8"></script>
	<!-- The transitions.js file creates a set of transitions  -->
    <script type="text/javascript" src="transitions.js" charset="utf-8"></script>
  </head>

  <body>
    <!-- this is the container for the whole content -->
    <div id="browser">
      <!--
        this is the container for the header, the area at the top of the screen with the title and back button:
        we keep two of buttons and titles so that we can transition a pair in and another pair out in transitions.
      -->
      <div id="header">
        <div id="first_button" class="button"></div>
        <div id="first_title" class="title"></div>
        <div id="second_button" class="button"></div>
        <div id="second_title" class="title"></div>
      </div>
      <!--
        this is the container for the pages, pages are what contains the list items, basically anything below the header:
        we keep two pages so that we can transition one out and one in for transitions.
      -->
      <div id="pages_container">
        <div id="first_page"></div>
        <div id="second_page"></div>
      </div>
    </div>
  </body>

</html>
