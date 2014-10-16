// file a1-tip1.cpp

//  compile : g++ a1-tip1.cpp console.cpp -o a1-tip1 -lncurses
//  run     : ./a1-tip1 

#include "console.h"

// console.cpp creates a global instance of class Console in namespace cio.
int main(int argc, char **argv)
{
  cio::console << 'a';  // cio:: because Console created in namespace cio
  cio::console << 'b';
  cio::console << 'c';

  cio::console.pause(); // wait for any key to be pressed

  cio::console << "XYZ";

  cio::console.pause(); // wait for any key to be pressed

  // position the cursor at (10,20) and print something
  int row = 10;
  int col = 20;

  cio::console.setPosition(row, col);
  cio::console << ". = (10,20)";
  row++;
  cio::console.setPosition(row, col);
  cio::console << ". = (11,20)";
  row++;
  cio::console.setPosition(row, col);
  cio::console << ". = (12,20)";

  cio::console.pause(); // wait for any key to be pressed
  return 0;
}
