<?php
ini_set('display_errors', '0');
require_once __DIR__ . "/vendor/autoload.php";
require_once "results.php";
session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Hacker Tracker</title>
    <link rel="stylesheet" type="text/css" href="jquery-ui/jquery-ui.min.css">
    <link rel="stylesheet" type="text/css" href="jquery-ui/jquery-ui-timepicker-addon.css">
  </head>
  <body>
    <header>
      <h1>Hacker Tracker</h1>
      <h2>Complete documentation for your hackathon!</h2>
    </header>
    <nav>
      <ul>
        <li><a href="#" id="TheEvent">The Event</a></li>
        <li><a href="#" id="YourTeam">Your Team</a></li>
        <li><a href="#" id="Milestones">Milestones</a></li>
      </ul>
    </nav>
    <main>
      <?php validateForm(); ?>
      <div id="InitialContent">
        <h1>Welcome.</h1>
        <p>
          Welcome to another great MLH hackathon! There are new people to meet, new places to go, and most of all, new levels of tiredness to reach (of course). But we won't let this go forgotten! Use <strong>Hacker Tracker</strong> to document your hackathon, from those awkward planning stages to another intense game of Werewolf, and maybe to the time you'll get your hands on an award.
        </p>
      </div>
      <div id="eventProfile" class="hackathonSection">
        <!--Most of this to be deprecated?
        Intending to scrape MLH pages for this, but it could be tough.-->
        <h1>The Event</h1>
        <p>
          Feed in the details of the event here.
        </p>
        <form method="post">
          <input type="hidden" name="post_key" value="overall_event">
        <table border="1">
          <tr>
            <td>Event Name</td>
            <td colspan="3"><input type="text" name="event_name" value="" size="70"></td>
          </tr>
          <tr>
            <td>Hacking Start Time</td>
            <td><input class="datetimepicker" type="text" name="startdate"></td>
            <td><input type="number" name="starthour" min="0" max="23" value=""></td>
            <td><input type="number" name="startmin" min="0" max="59" value=""></td>
          </tr>
          <tr>
            <td>Hacking End Time</td>
            <td><input class="datetimepicker" type="text" name="enddate"></td>
            <td><input type="number" name="endhour" min="0" max="23" value=""></td>
            <td><input type="number" name="endmin" min="0" max="59" value=""></td>
          </tr>
        </table>
        <p><input type="submit" value="Submit"></p>
        </form>
      </div>
      <div id="GitHubProfiles" class="hackathonSection">
        <h1>Your Team</h1>
        <p>
          Have you got a team? Input your usernames here!
        </p>
        <form class="forms" method="post" action="">
        <?php
        if ($_SESSION['errors']):
        ?>
        <h3>The following fields contain invalid values:</h3>
        <ul>
        <?php
          foreach($_SESSION['errors'] as $name => $value) {
            $field_info = getFieldInfoFromName($name);
            $msg = "Team Member {$field_info[1]}'s " . $field_info[2] . (($field_info[2] == "name")? "" : "name");
            echo "<li>$msg</li>";
          }
        ?>
        </ul>
        <?php
        endif;
        ?>
        <form method="post">
        <input type="hidden" name="post_key" value="people">
        <table border="1">
          <tr>
            <td> </td>
            <td>Your name</td>
            <td>GitHub profile</td>
            <td>Twitter handle</td>
          </tr>
          <tr>
            <td>Team Member 1</td>
            <td><input type="text" name="teammate1name" value=""><br></td>
            <td><input type="text" name="teammate1github" value=""><br></td>
            <td><input type="text" name="teammate1twitter" value=""><br></td>
          </tr>
          <tr>
            <td>Team Member 2</td>
            <td><input type="text" name="teammate2name" value=""><br></td>
            <td><input type="text" name="teammate2github" value=""><br></td>
            <td><input type="text" name="teammate2twitter" value=""><br></td>
          </tr>
          <tr>
            <td>Team Member 3</td>
            <td><input type="text" name="teammate3name" value=""><br></td>
            <td><input type="text" name="teammate3github" value=""><br></td>
            <td><input type="text" name="teammate3twitter" value=""><br></td>
          </tr>
          <tr>
            <td>Team Member 4</td>
            <td><input type="text" name="teammate4name" value=""><br></td>
            <td><input type="text" name="teammate4github" value=""><br></td>
            <td><input type="text" name="teammate4twitter" value=""><br></td>
          </tr>
        </table>
        <p><input type="submit" value="Submit"></p>
        </form>
      </div>
      <div id="event" class="hackathonSection">
        <h1>Events</h1>
        <p>
          Don't let the greatest moments of your hackathon fall under a surge of sleepiness or (Torvalds forbid) an avalanche of alcohol. List any major milestones your group hit here!
        </p>
        <form id="eventContent" class="forms" method="post">
          <select id="eventType" name="eventType">
            <option value="annoyance">Annoyance Discovered</option>
            <option value="teamName" selected="selected">Team Name Chosen</option>
            <option value="sleep">Team Member Sleeps</option>
            <option value="wake">Team Member Awakens</option>
            <option value="alpha">Working Alpha Created</option>
            <option value="werewolf">Werewolf Played</option>
          </select>
          <input type="hidden" name="post_key" value="events">
          <input id="annoyance" name="annoyanceContent" type="text" placeholder="What bug did you find?" size="60"/>
          <input id="teamName" name="teamNameContent" type="text" placeholder="What have you crowned your team?" size="60"/>
          <input id="sleep" name="sleepContent" type="text" placeholder="Who's sleeping?" size="60"/>
          <input id="wake" name="wakeContent" type="text" placeholder="Who has awakened?" size="60"/>
          <input id="alpha" name="alphaContent" type="text" placeholder="What's the commit ID of your alpha?" size="60"/>
          <input id="werewolf" name="werewolfContent" type="text" placeholder="Who's playing Werewolf?" size="60"/>
          <input id="date" name="date" type="text" style="display:none;"> <!--might not work?...-->
          <input type="submit" value="Submit">
        </form>
      </div>
    </main>
    <footer>
      <p>
        By <a href="http://github.com/undying-fish">Simon Fish</a>, <a href="http://github.com/SanzianaCH">Sanziana Chiorescu</a>, <a href="http://github.com/szen95">Tzen Szen</a> and <a href="http://github.com/darrenvong">Darren Vong</a>.
      </p>
    </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.js"></script>
    <script src="jquery-ui/jquery-ui.min.js"></script>
    <script src="jquery-ui/jquery-ui-timepicker-addon.js" charset="utf-8"></script>
    <script src="functionalities.js"></script>
  </body>
</html>