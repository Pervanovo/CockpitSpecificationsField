<?php
// replace ids with names
$app->on("collections.find.after", function ($collectionName, &$entries, $isUpdate) use ($app) {
  $collection = $app->module('collections')->collection($collectionName);
  foreach ($collection['fields'] as $field) {
    if ($field['type'] === 'specifications' && $field['options']['template_collection']) {
      $templateEntries = $app->module('collections')->find($field['options']['template_collection']);
      $templates = [];
      foreach ($templateEntries as $templateEntry) {
        $templates[$templateEntry['id']] = [
          'name' => $templateEntry['name'],
          'attributes' => $templateEntry['attributes']
        ];
      }
      unset($templateEntries);
      $fieldName = $field['name'];
      foreach ($entries as &$entry) {
        if (isset($entry[$fieldName])) {
          $template = $templates[$entry[$fieldName]['templateId']];
          $values = $entry[$fieldName]['values'];
          $specifications = [];
          foreach ($template['attributes'] as $repeaterAttribute) {
            $attribute = $repeaterAttribute['value'];
            if ($values[$attribute['id']]) {
              $specifications[] = [
                'name' => $attribute['name'],
                'value' => $values[$attribute['id']]
              ];
            }
          }
          $entry[$fieldName . "_template"] = $template['name'];
          $entry[$fieldName] = $specifications;
        }
      }
    }
  }
});