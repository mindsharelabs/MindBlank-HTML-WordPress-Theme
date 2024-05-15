<?php

echo '<nav class="header-menu">';
    mind_nav('header-menu', array('depth' => 1));
echo '</nav>';


echo '<nav class="main-menu d-none d-md-block">';
    mind_nav('main-menu');
echo '</nav>';