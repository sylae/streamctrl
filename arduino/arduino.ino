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

#include "codes.h"
#include "config.h"

unsigned int statusPots[sizeof(pots)];
bool statusButtons[sizeof(buttons)];

void setup() {
  // initialize serial communications
  Serial.begin(9600);
  
  // let things initialize
  delay(1000);
  
  lUInt(C_INIT, 0, idLCN);

  // set up pins as needed
  for (size_t p = 0; p < sizeof(buttons); p++) {
    pinMode(buttons[p], INPUT_PULLUP);
    statusButtons[p] = 0;
  }
  for (size_t p = 0; p < sizeof(pots); p++) {
  }

  // pull initial values
  stateRead(true);
}

void loop() {
  stateRead(false);
}

void stateRead(bool isInit) {
  for (size_t p = 0; p < sizeof(buttons); p++) {
    bool oldRead = statusButtons[p];
    bool newRead = !digitalRead(buttons[p]);
    if (isInit || (newRead != oldRead)) {
      statusButtons[p] = newRead;
    }
    if (!isInit && (newRead != oldRead)) {
      lBool(C_READ_D, buttons[p], statusButtons[p]);
    }
  }
  for (size_t p = 0; p < sizeof(pots); p++) {
    unsigned int oldRead = statusPots[p];
    unsigned int newRead = analogRead(pots[p]);
    if (isInit || (abs((long)newRead - (long)oldRead)>5)) {
      // cast to signed longs to prevent negatives from fucking it all up
      statusPots[p] = newRead;
    }
    if (!isInit && (abs((long)newRead - (long)oldRead)>5)) {
      lUInt(C_READ_A, pots[p], statusPots[p]);
    }
  }
}

void lUInt(byte type, byte id, unsigned int payload) {
  _l(type, id);
  Serial.print(payload);
  Serial.println(";");
}

void lBool(byte type, byte id, bool payload) {
  _l(type, id);
  Serial.print(payload);
  Serial.println(";");
}

void _l(byte type, byte id) {
  // magic!
  Serial.print("7bfb00;utLCN0;");

  Serial.print(type);
  Serial.print(";");
  Serial.print(id);
  Serial.print(";");
}

