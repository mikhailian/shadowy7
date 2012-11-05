<?php
// First, we must set up an array
/*$element = array(
  '#tag' => 'link', // The #tag is the html tag - <link />
  '#attributes' => array( // Set up an array of attributes inside the tag
    'href' => 'http://fonts.googleapis.com/css?family=Ubuntu&subset=latin,cyrillic',
    'rel' => 'stylesheet',
    'type' => 'text/css',
  ),
);
drupal_add_html_head($element, 'google_font_cardo');*/

function shadowy7_username($variables) {
  $u_css_class = '';
  $u = user_load($variables['account']->uid);
  // style depends on the role
  if (!empty($u) && $u->uid == 1) {
    $u_css_class='administrator';
    $u_title=t('Administrator');
  }
/* TODO roles is an array in D7, with rid as the key and name as the value
/*  elseif (in_array('node moderator', array_values($u->roles))) {
    $u_css_class='node-moderator';
    $u_title=t('Node moderator');
  }
  elseif (in_array('forum moderator', array_values($u->roles))) {
    $u_css_class='forum-moderator';
    $u_title=t('Forum moderator');
  } */
  else {
    $u_css_class='ordinary-user';
    $u_title=t('Ordinary user');
  }
  $variables['link_options']['attributes']['class'][] = $u_css_class;
  $variables['link_options']['attributes']['title'] = $u_title;
  if (isset($variables['link_path'])) {
    // We have a link path, so we should generate a link using l().
    // Additional classes may be added as array elements like
    // $variables['link_options']['attributes']['class'][] = 'myclass';
    $output = l($variables['name'] . $variables['extra'], $variables['link_path'], $variables['link_options']);
  }
  else {
    // Modules may have added important attributes so they must be included
    // in the output. Additional classes may be added as array elements like
    // $variables['attributes_array']['class'][] = 'myclass';
    $output = '<span' . drupal_attributes($variables['attributes_array']) . '>' . $variables['name'] . $variables['extra'] . '</span>';
  }
  return $output;
}
