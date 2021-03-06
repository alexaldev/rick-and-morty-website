<?php

$page_title = "Rick and Morty";
$nav_curr = "Home";

function getPageContent() {
?>
<div class="main_content_title">
    <h1>A website to discover the top-rated cartoon series.</h1>
</div>
        
<div class="home_character">
    <img src="images/rick_sanchez.gif" alt="Rick face"/>
    <p>Rick is a genius scientist, capable of creating complex scientific inventions, including brain-enhancing helmets, dream-invading devices, portals to several different dimensions, and the world's first amusement park inside the body of a living human. His brilliance can be muddled by his jaded personal views and his alcoholic tendencies. Rick is easily bored and does not do well with routine. When his curse removing store in the episode Something Ricked This Way Comes started requiring real work, Rick simply lit the whole store on fire and abandoned it. He regularly goes to other dimensions to harvest resources and will often willingly kill aliens to get them. He is willing to be extremely brutal such as when people betray him or his life or those close to him are danger. He is usually portrayed as homicidal and having a large disregard for life, enough that he came close to bombing the world with neutrinos while drunk. He was shown to find killing fun during the Purge and was even willing to kill Morty's half-Gazorpian son due to the child's danger to everyone and unstable nature. </p>
</div>
                
<div class="home_character">
    <img src="images/morty.gif" alt="Morty face"/>
    <p>Morty is a young, good-natured, and impressionable boy who can be somewhat easily manipulated. He has been described as 'challenged' and has difficulty in school. He also has a pronounced stutter. Despite his apparent lack of intellect, Morty has shown to be a good listener and follows directions well. These traits make him the perfect sidekick to Rick. He is interested in Jessica, a student in his math class. Like many boys his age, he spends a good deal of time masturbating.</p>
</div>
<?php
}

include('resources/template.php');

?>
