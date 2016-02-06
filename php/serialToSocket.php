<?php

/*
 * Copyright (C) 2016 Sylae Jiendra Corell <sylae@calref.net>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

require_once "utLCN0.php";

$config = unserialize(file_get_contents("config.inc"));

$fp = fopen($config['port'], "r");
if (!$fp) {
  echo "Error";
  die();
}

while ($line = fgets($fp)) {
  try {
    $ucn = new utLCN0($line);
    if ($ucn->isAnalogReading()) {
      $id = $ucn->getID();
      $v = (int) (($ucn->getReading() + 1) * 100 / 1024);

      // round extreme values to 100 or 0
      if ($v > 97) {
        $v = 100;
      }
      if ($v < 3) {
        $v = 0;
      }
      echo "$id\t$v\n";
    }
    if ($ucn->isDigitalReading() && $ucn->getReading()) { // we don't care about t->f
      $id = $ucn->getID();
      $v = $ucn->getReading();
      echo "$id\t$v\n";
    }
  } catch (Exception $e) {
    echo $e->getMessage() . PHP_EOL;
  }
}

fclose($fp);
