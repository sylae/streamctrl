## Stream<kbd>Ctrl</kbd>
Control an XSplit instance using an arduino microcontroller.

### Requirements
* PHP >= 5.3.0
* XSplit Broadcaster
* Arduino-compatiable microcontroller.

### Installation
**Note**: Right now it isn't finighed, so don't bother using this.

1. ```git clone``` and all that
2. Run ```./configure``` with the following arguments:
  * ```--port=<port>``` required, the name of the serial port your microcontroller will communicate on.
    Examples are ```COM3``` and ```/dev/ttyACM0```.
  * ```--pot=<pin>``` optional and repeatable, a pin on which an analog input is provided.
  * ```--button=<pin>``` optional and repeatable, a pin on which a digital input is provided.
3. Compile and push the code in the ```arduino``` subdirectory to your microcontroller. The Arduino IDE
   works just fine.
4. Run ```php/serialToSocket.php``` in a shell and leave it running (tmux or screen may come in handy).
5. ...
6. Profit?

### Support
For bugs requests and feature reports, please use the GitHub issue tracker.

For troubleshooting or other support (limited), please contact sylae@calref.net via email or XMPP.

### Licensing
GPL3

### Links
* http://xjsframework.github.io/
