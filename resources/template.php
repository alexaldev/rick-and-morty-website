<!DOCTYPE HTML>
<html lang='en'>
    <head>
        <meta charset="utf-8">
        <link rel="icon" type="image/ico" href="./images/favicon.ico">
        <link rel="stylesheet" type="text/css" href="css/styles.css">
        <meta name="description" content="This is page is about Rick and Morty.">
        <meta name="author" content="CSDAuth">
        
        <title>
	       <?php echo $page_title; ?> 
        </title>
    
    </head>

    <body>
        <div id="container">
        <header>
        <a href="index.php"><img src="https://upload.wikimedia.org/wikipedia/en/c/c8/Rick_and_Morty_logo.png" alt="Rick and Morty Logo"></a>
        </header>

        <!-- Navigation menu -->
        <nav>
            <ul>
                <?php
                if ($nav_curr == "Home")
                    echo '<li class="current"><span class="nav-entry">Home</span></li>';
                else
                    echo '<li><a class="nav-entry" href="index.php">Home</a></li>';

                if ($nav_curr == "Season Guide")
                    echo '<li class="current"><span class="nav-entry">Season Guide</span></li>';
                else
                    echo '<li><a class="nav-entry" href="SeasonGuide.php">Season Guide</a></li>';

                if ($nav_curr == "Random Funny Clips")
                    echo '<li class="current"><span class="nav-entry">Random Funny Clips</span></li>';
                else
                    echo '<li><a class="nav-entry" href="RandomClips.pjp">Random Funny Clips</a></li>';

                if ($nav_curr == "News")
                    echo '<li class="current"><span class="nav-entry">News</span>';
                else
                    echo '<li><a class="nav-entry" href="News.php">News</a>';
                echo '<li><a class="nav-entry" href="News.php">News</a>
                    <ul>
                        <li><a class="nav-entry" href="News.php#article1">RICK AND MORTY Catchphrases Fit Right Into This Awesome EDM Mix</a></li>

                        <li><a class="nav-entry" href="News.php#article2">Rick and Morty showrunner Dan Harmon explains why season 3 was cut short</a></li>

                        <li><a class="nav-entry" href="News.php#article3">Rick &amp; Morty Co-Creator Slams McDonald’s Szechuan Sauce Promo</a></li>
                    </ul>
                </li>';

                if ($nav_curr == "How it all started")
                    echo '<li class="current"><span class="nav-entry">How it all started</span></li>';
                else
                    echo '<li><a class="nav-entry" href="HowItAllStarted.php">How it all started</a></li>';

                if ($nav_curr == "Comments")
                    echo '<li class="current"><span class="nav-entry">Comments</span></li>';
                else
                    echo '<li><a class="nav-entry" href="comments.php">Comments</a></li>';

                if ($nav_curr == "Quiz")
                    echo '<li class="current"><span class="nav-entry">Quiz</span></li>';
                else
                    echo '<li><a class="nav-entry" href="Quiz.php">Quiz</a></li>';
                ?>
            </ul>
        </nav>

        <!-- Main Content -->
        <div class="main_content">
            <?php getPageContent(); ?>
        </div>
        </div>
        <!-- Footer -->
        <footer>
            <p>&copy;2017-2018 CSD AUTH </p>
            <a href="https://github.com/alexaldev/rick-and-morty-website">
                <img src="images/github-icon.png" alt="Github icon"/>
            </a>
        </footer>
        
    </body>
    
</html>
