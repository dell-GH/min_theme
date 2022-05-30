<?php

while (have_posts()) {
    the_post();
    echo '<div><a href="'.get_the_permalink().'">'.get_the_title().'</a></div>';
}
