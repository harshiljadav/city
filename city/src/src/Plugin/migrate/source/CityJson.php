<?php

namespace Drupal\city\Plugin\migrate\source;

use Drupal\migrate\Plugin\migrate\source\SourcePluginBase;

/**
 * Source plugin to import data from JSON files.
 *
 * @MigrateSource(
 *   id = "city_json"
 * )
 */
class CityJson extends SourcePluginBase {

  /**
   * Initializes the iterator with the source data.
   *
   * @return \Iterator
   *   An iterator containing the data for this source.
   */
  protected function initializeIterator() {

    $absolute_path = \Drupal::service('file_system')->realpath('public://cities.json');
    $rows = json_decode(file_get_contents($absolute_path), TRUE);
    $records = [];
    foreach ($rows as $row) {
      $record['_id'] = $row['_id'];
      $record['city'] = $row['city'];
      $record['lat'] = $row['loc'][0];
      $record['long'] = $row['loc'][1];
      $record['pop'] = $row['pop'];
      $record['state'] = $row['state'];
      $record['_id'] = $row['_id'];
      $record['date'] = time();
      $records[] = $record;
    }
    return new \ArrayIterator($records);
  }

}
