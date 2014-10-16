#include <sstream>
#include <string>
#include <iostream>
#include <cstring>
using namespace std;



class Puzzle {
private:
	static const int N = 9;
	static const char UNASSIGNED = '0';
	
	bool bSolved;
	
	char puzzle [N][N];
	
public:
	Puzzle(const char *p)
	{
		int l = strlen(p);
		if (l == N*N) {
			strcpy ((char*) puzzle, p);
		}
		else
		{
		// C++ 11: throw string("Sudoku needs a 9 x 9 grid of 81 numbers, ") + to_string(l) + string("supplied");
		throw string("sudoku needs 81 numbers, a 9 x 9 grid, ") + to_string(l) + string(" supplied:\n")
			+ string(p) + string("\n")
			+ string("123456789123456789123456789123456789123456789123456789123456789123456789123456789\n")
			+ string("^        ^        ^        ^        ^        ^        ^        ^        ^\n")
			+ string("1st row  2nd row  3rd row  4th row  5th row  6th row  7th row  8th row  9th row");
		}
	}
		
	void Print() 
	{
		for (int r = 0; r < N; r++) { //row
			for (int c = 0; c < N; c++) { //column
				cout << puzzle[r][c] << ' ';
				// cout << "["<<r<<"]["<<c<<"]=" << puzzle[r][c] << endl;
			}
			cout << endl;
		}
	}

	template <typename T>
	string to_string (T Number) // function template for converting number to string via string stream
	{
		ostringstream ss;	// include sstream - stringstream
		ss << Number;
		return ss.str();
	}


	bool FindCandidate(int& row, int& col)
	{
		for (row = 0; row < N; row++)
			for(col = 0; col < N; col++)
				if (puzzle[row][col] == UNASSIGNED)
					return true;
		return false;
	}
	
	bool isLegal(int row, int col, char candidate)
	{
		//check if used in row
		for (int c = 0; c < N; c++)							
			if (puzzle[row][c] == candidate)	// found it - not legal
				return false;
			// check if used in col
		for (int r = 0; r < N; r++)							
			if (puzzle[r][col] == candidate)	// found it - not legal
			return false;
				
		//check if used in box
												
		int boxStarRow = row - row % 3;			// or 3*(row/3)										
		int boxStarCol = col - col % 3;			// or 3*(col/3)
		for (int r = 0 ; r < 3; r++)
			for (int c = 0; c < 3; c++)								
				if (puzzle[r+boxStarRow][c+boxStarCol] == candidate)	// found it - not legal
					return false;
		return true;			// did not find it - legal
	}

	bool Solve()
	{
		bSolved = false;
		int row, col;		// every cell assigned --- puzzle solved
	
		if (!FindCandidate(row, col))
		{
			bSolved = true;
		}
		else
		{
			// row, col is unassigned, try values 1 through 9
			for (char trialCandidate = '1'; trialCandidate <= '9'; trialCandidate++)
			{
				if (isLegal(row, col, trialCandidate))
				{
					puzzle[row][col] = trialCandidate;
					if (Solve())
					{
						bSolved =true;
						break;
					}
					puzzle[row][col] = UNASSIGNED;
				}
			}
		}
		return bSolved;
	}
};

int main(int argc, char *argv[])
{
	cout << "argc=" << argc << endl;
	for (int i = 0; i < argc; i++)
		cout << "argv[" << i << "]==>" << argv[i] << "<==, length=" << strlen(argv[i]) << endl;
		
	try
	{
		if (argc > 1)
		{
			Puzzle puzzle(argv[1]);
			puzzle.Print();
			if (puzzle.Solve())
			{
				cout << "solution:\n";
				puzzle.Print();
			}
			else
			{
				cout << "no solution\n";
			}
		}
		else
		{
			throw "sudoku needs 81 numbers, a 9 x 9 grid, none supplied";
		}
	}
	catch (const string& s)
	{
		cout << "Problem: threw a string: " << s << endl;
	}
	catch (const char* s)
	{
		cout << "Problem: threw a char*: " << s << endl;
	}
}

	
