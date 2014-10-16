/*
Assignment 1 :Line Editing Facility 
OOP344-C
Parth Parikh

A set of assignments has been developed for you to upgrade the original version of the library module 
provided in this course. 
You are given the tasks of tackling complex programming problems and meeting demanding deadlines. 
In this first assignment, you and your team member are asked to upgrade the console input output library
by including line-display and line-editing facilities.  
*/

#define _CRT_SECURE_NO_WARNINGS			// solve the string copy error while alocating memory
#include <cstring>						//csting data that is based on the char type, and used in sting copy process.
#include <iostream>
#include "console.h"					
#include "consoleplus.h"
#include "keys.h"


void display(const char *str, int row, int col, int fieldLen) // this function display proper out of sting.
{
	if (!str) return;

	int numCharsToPrint = 0;
	int space=0;									// define variable for trailing space.
	int align = cio::console.getCols() - col;		// define for set the proper output string.
	int strLen = std::strlen(str);					// count the sting lenght from the given string.
	if (!fieldLen)
	{
		numCharsToPrint = strLen;
	}
	else if (strLen < fieldLen)
		{
			numCharsToPrint = strLen;
			space=fieldLen-strLen;					//counting the trailling space.
		}
	
	else numCharsToPrint = fieldLen;

	if(align < strLen)								// display the sting if it is less than it's length
	{
		numCharsToPrint = align;
	}

	for (int i = 0; i < numCharsToPrint; i++)
	{
		cio::console.setPosition(row, col + i);
		cio::console.setCharacter(str[i]);
		cio::console.setPosition(row, col + i);
		cio::console.drawCharacter();
	}

	if(space!=0)									//check the condition for trailling space
	{                                                
		for (int i = std::strlen(str); i < fieldLen; i++) 
		{
			cio::console.setPosition(row, col + i);
			cio::console.setCharacter(' ');			//function displays the portion of the entire string that fits on the screen,
			cio::console.setPosition(row, col + i); // followed by enough trailing spaces to fill out the field completely 
			cio::console.drawCharacter();
		}
	}

}

int edit(char *str, int row, int col, int fieldLength, int maxStrLength,bool* insertMode, int* strOffset, int* curPosition)
{
	int strLen = std::strlen(str); // String Lenght.
	int colLenght=cio::console.getCols();
	int key=0;                                  // get key refrence from key.h file
	bool ok=false;
	int newOffset=*strOffset;
	int newCurPos=*curPosition;
	char* strBackup= new char[strLen+1];		// allocate a new memory for the string to get oringinal key.
	strcpy(strBackup,str);						// simply copy the old string in strBackup

	if (*strOffset>strLen)						//reset the offset positing.
	{
		*strOffset=strLen;
	}
	else if(*strOffset==0)
	{
		*strOffset=0;
	
	}

	if(*curPosition>fieldLength-1)			// set the cursor position with given conditions.
	{                                       //function resets the position to the last character in the field.
		*curPosition=fieldLength-1;
	}
	else if(*curPosition>strLen-(*strOffset))	//If the position is beyond the end of the string,
	{                                           // your function resets the position to that immediately beyond the end of the string.
		*curPosition=strLen-(*strOffset);
	}
	else if (*curPosition==0)				// set position to 0
	{
		*curPosition=0;
	}


	while(!ok)                              // start the loop for the keys.
	{
		display(str+*strOffset, row, col, fieldLength);   //call the display function to get the output instruction
		cio::console.setPosition(row,col + *curPosition); // and original string
		
		cio::console >> key;                //call operator >> from consol.cpp

		switch(key)			// Switch case start.
		{
		case LEFT:							//moves the cursor left one character
			if(*curPosition!=0)
				(*curPosition)--;
			else if(*strOffset!=0)
				(*strOffset)--;
			break;

		case RIGHT:						//moves the cursor right one character
			
			if(*curPosition < fieldLength-1)
			{
				(*curPosition)++;
			}
			else 
			{
				(*strOffset)++;
			}					
			break;

		case HOME:						//moves the cursor to the beginning of the string
			*curPosition=0;
			*strOffset=0;
			break;

		case END:                      //moves the cursor to the end of the string or last character in field.

			for(int end=*curPosition+*strOffset;end<strLen;end++)
			{
				if(*curPosition < fieldLength-1)
				{
					if(str[*curPosition] && end !=fieldLength)
						(*curPosition)++;
				}
				else
				{
					(*strOffset)++;
				}	
			}

			break;
		case DEL:					//discards the character at the current cursor position and 
			int del;				//moves all characters to the right of the cursor position one position to the left.
			for(del = *strOffset+*curPosition;del<strLen;del++)
			{
				str[del]=str[del+1];
			}
			break;

		case BACKSPACE:				//discards the character to the left of the current cursor position,
			int back;
			back= *strOffset + *curPosition-1;
			if(*curPosition>0)
			{
				while(str[back])
				{
					str[back] = str[back+1];
					back++;
				}
			}
			if(*curPosition > 0)
			{
				(*curPosition)--;
			}
			else if(*strOffset > 0)
			{
				(*strOffset)--;
			}
			break;

			case ESCAPE:	   //the function aborts editing, replaces the contents of the string with the original contents 
				strcpy(str,strBackup);
					ok=true;
				
				break;
		case ENTER:
		case UP:					// this keys use for terminate the program from the loop.
		case TAB:
		case DOWN:
		case PGDN:
		case PGUP:
		case F(1):
		case F(2):
		case F(3):
		case F(4):
		case F(5):
		case F(6):
		case F(7):
		case F(8):
		case F(9):
		case F(10):
		case F(11):
		case F(12):
			ok = true;
			break;

		case INSERT:
			*insertMode=!*insertMode;
			break;

		default:						// To insert any character use this default case.
			if(key >=' ' && key<='~')
			{
				if(*insertMode)		// if insert mode on then cursor move right and enter a character.
				{
					if(strLen<maxStrLength && *curPosition<maxStrLength)
					{					
						for(int insert=strLen; insert>=(*strOffset+*curPosition);insert--)
						{
							str[insert+1]=str[insert];
						}
						str[(*strOffset+*curPosition)]=key;
						if(*curPosition < fieldLength-1)
						{
							(*curPosition)++;
						}
						else 
						{
							(*strOffset)++;
						}	
					}

				}
				else             // this part overstick the value on old charcter. print new character on old one.
				{
					if(strLen<maxStrLength && *curPosition<maxStrLength)
					{
						str[(*strOffset+*curPosition)]=key;
						if(*curPosition < fieldLength-1)
						{
							(*curPosition)++;
						}
						else 
						{
							(*strOffset)++;
						}	
					}
				}
			}


			break;
			//		case END:


		}
	}

	return key;   // return the keys.

}
