<?php

$page_title = "Rick and Morty Random Clips";
$nav_curr = "Random Funny Clips";

function getPageContent() {
?>
<div class="random_videos">
                
    <iframe src="https://www.youtube.com/embed/yBBLuj3tyQY" allowfullscreen></iframe>
    <iframe src="https://www.youtube.com/embed/TbJJshbRZwE" allowfullscreen></iframe>
    <iframe src="https://www.youtube.com/embed/a2KOOjaOIJo" allowfullscreen></iframe>
</div>
            
<div class="random_videos">
                
    <iframe src="https://www.youtube.com/embed/q2dbe_PV5_E" allowfullscreen></iframe>
    <iframe src="https://www.youtube.com/embed/AsliIssUHgw" allowfullscreen></iframe>
    <iframe src="https://www.youtube.com/embed/vTF7TES4l8Y" allowfullscreen></iframe>
</div>
<?php
}

include('resources/template.php');

?>
