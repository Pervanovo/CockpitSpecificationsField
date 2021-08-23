# CockpitSpecificationsField
Addon to [agentejo/Cockpit](https://github.com/agentejo/cockpit) with a field type that contains specifications using specifications templates.

Specifications are stored using ids referencing the specifications templates collection for keys and they are substituted for strings when fetched by the API.

Specifications will be transformed into an array of key-value pairs when fetched by the API, ie.
```
{
    ...
    "specifications": [
        {
            "name": "Width",
            "value": "128 mm"
        }, {
            "name": "Length",
            "value": "2200 mm"
        }
     ],
    ...
}
```
Specification values are trimmed and keys containing empty values won't exist. 

## Requirements
* Requires [`CockpitUniqueIdField`](https://github.com/Pervanovo/CockpitUniqueIdField) addon to be installed.
* A specifications template to be configured (see [example template collection](example_template_collection/specifications_templates.collection.php)). 

## Installation
Clone this repo into `addon/CockpitSpecificationsField` in your cockpit root directory.

## Options
`template_collection` (required) The name of the collection to use for specifications templates.

Example options:
```
{
    "template_collection": "specifications_templates"
}
```