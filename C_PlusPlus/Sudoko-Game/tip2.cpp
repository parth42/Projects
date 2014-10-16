// file a1-tip2.cpp

//  compile : g++ a1-tip2.cpp console.cpp -o a1-tip2 -lncurses
//  run     : ./a1-tip2 

#include <cctype> // isprint
#include "console.h"
#include "keys.h"

// console.cpp creates a global instance of class Console in namespace cio.
int main(int argc, char **argv)
{
  while(1) {
    cio::console.setPosition(0, 0);
    cio::console << "press a key, ESC to exit";

    int key;
    cio::console >> key;

    int row = 10;
    int col = 20;
    cio::console.setPosition(row, col);
    if(key <= HOME && isprint(key)) { // special keys start at 1000 (HOME) - see keys.h
      // get the spacing right to blank out the previous print
      // "==>X<== pressed    ";
      // "special key pressed";
      cio::console << "==>";
      cio::console << (char) key;
      cio::console << "<== pressed    ";
    } else { // a non-printing or special key was pressed
      if(key == ESCAPE)
        break;
      cio::console << "special key pressed";
    }
  }

  return 0;
}
