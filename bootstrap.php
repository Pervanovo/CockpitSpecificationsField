<?php
// ADMIN
if (COCKPIT_ADMIN_CP) {
  include_once(__DIR__ . '/admin.php');
}

if (COCKPIT_API_REQUEST) {
  include_once(__DIR__ . '/api.php');
}