<?php
$app->on('admin.init', function () {
  $this->helper('admin')->addAssets('cockpitspecificationsfield:assets/components/field-specifications.tag');
  $this->helper('admin')->addAssets('cockpitspecificationsfield:assets/specifications.js');
});

$app->on('admin.init', function () use ($app) {
  $this->bind('/specifications/templates/:collectionName', function ($params) use ($app) {
    $collectionName = $params['collectionName'];
    if (!$collectionName) {
      $this->response->status = 400;
      return ["error" => "collectionName is missing"];
    }
    if (!$app->module('collections')->hasaccess($collectionName, 'entries_view')) {
      return $this->stop('{"error": "Unauthorized"}', 401);
    }
    $criteria = [];
    $templates = $app->module('collections')->find($collectionName, $criteria);
    $output = [];
    foreach ($templates as $template) {
      $attributes = [];
      foreach ($template['attributes'] as $attribute) {
        $attributes[] = $attribute['value'];
      }
      $output['templates'][] = [
        "id" => $template['id'],
        "name" => $template['name'],
        "attributes" => $attributes
      ];
    }
    return $output;
  });
  $this->bind('/specifications/values/:collection/:field', function ($params) use ($app) {
    $collectionName = $params['collection'];
    if (!$app->module('collections')->hasaccess($collectionName, 'entries_view')) {
      return $this->stop('{"error": "Unauthorized"}', 401);
    }
    $fieldName = $params['field'];
    $criteria = [
      "fields" => [
        $fieldName => 1
      ]
    ];
    $entries = $app->module('collections')->find($collectionName, $criteria);
    $values = [];
    foreach ($entries as $entry) {
      foreach ($entry[$fieldName]['values'] as $id => $value) {
        if (!$values[$id] || !in_array($value, $values[$id])) {
          $values[$id][] = $value;
        }
      }
    }
    return $values;
  });
});
