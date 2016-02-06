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

// specify pins for analog (pots) and digital (buttons)
const byte pots[] = {STREAMCTL_CONFIGURE_SCRIPT_POTS};
const byte buttons[] = {STREAMCTL_CONFIGURE_SCRIPT_BUTTONS};

// device id for uLCN packets (useful if multiple devices on network)
const unsigned int idLCN = 700;
