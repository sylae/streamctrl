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

/**
 * Simple parser for utLCN0-compatiable strings
 *
 * @author Sylae Jiendra Corell <sylae@calref.net>
 */
class utLCN0 {

  const C_INIT = 0x00;
  const C_VERSION = 0x01;
  const C_READ_A = 0x10;
  const C_READ_D = 0x11;
  const MAGIC = "7bfb00";
  const LCNVERS = "utLCN0";

  protected $pkt = '';
  protected $raw = [];

  public function __construct($str) {
    $pkt = explode(";", $str);
    if (count($pkt) > 1 && $pkt[0] == self::MAGIC && $pkt[1] == self::LCNVERS) {
      $this->pkt = $pkt[2];
      $this->raw = $pkt;
    } else {
      throw new Exception("Not a valid utLCN version 0 sentence.");
    }
  }

  public function isAnalogReading() {
    return ($this->pkt == self::C_READ_A);
  }

  public function isDigitalReading() {
    return ($this->pkt == self::C_READ_D);
  }

  // for readings only
  public function getReading() {
    if ($this->isDigitalReading()) {
      return ($this->raw[4] == "1") ? true : false;
    }
    return $this->raw[4];
  }

  public function getID() {
    return $this->raw[3];
  }

}
