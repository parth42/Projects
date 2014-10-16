/***********************************
Name: Parth Parikh
Student Number: 011-195-138
Date: July 25, 2014
Assignment 3: Assignment 03 Question 01

General description of what your code does:
	The application should display a virtual keyboard and should allow the user to watch what he or she is typing on the screen,
	without looking at the actual keyboard. Use JButtons to represent the keys. As the user presses each key, 
	the application highlights the corresponding JButton on the GUI and adds the character to a JTextArea that shows what the user has typed so far.
	
Expected good results:
	   In this Assignment you will build a GUI application that can help users learn to “touch type”.	
	
Anticipated bad results:
	No bad results are anticipated since this program is not interactive and does not require user interaction

***********************************/
// all the java swing components and awt components.
import java.awt.BorderLayout;
import java.awt.Color;// to add backgroung and foreground color 
import java.awt.ComponentOrientation;
import java.awt.GridLayout;
import java.awt.TextArea;
import java.awt.Dimension;
import java.awt.event.KeyAdapter;
import java.awt.event.KeyEvent;//add keyevents in program
import java.awt.event.KeyListener;//add keylistener

import javax.swing.JButton;
import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.JPanel;
import javax.swing.JScrollPane;
import javax.swing.JTextArea;
import javax.swing.SwingConstants;

//start of Keyboard class
public class Keyboard {
	//creating Main frame
	private JFrame frame = new JFrame();
	
	//creating all panels
	private JPanel mainPanel = new JPanel();//Main panel
	private JPanel labelPanel = new JPanel();//panel for only label
	private JPanel textPanel = new JPanel();//panel for text area
	private JPanel keysPanel = new JPanel();//main panel for all the keys	
	//creating panels for keys
	private JPanel row1 = new JPanel();	
	private JPanel row2 = new JPanel();	
	private JPanel row3 = new JPanel();
	private JPanel row4 = new JPanel();
	private JPanel row5 = new JPanel();			
	//creating panel only for row5
	private JPanel lastRowLeft = new JPanel();//this panel is only for blank label
	private JPanel lastRowCenter = new JPanel();//this panel is only for Space
	private JPanel lastRowRight = new JPanel();//this panel is only for Arrow keys
		
	//creating label for information in starting
	private JLabel labelRow1 = new JLabel("<html>Type some text using your keyboard."+
										  "The Keys you press will be highlighted and the text will be displayed." +
										  "<br>Note:Clicking the buttons with your mouse will not perform any action.</html>", SwingConstants.LEFT);
	
	//creating Text area using JTextArea
	private JTextArea textArea = new JTextArea(10,90);	
	private JScrollPane scrollBar = new JScrollPane(textArea);// crating scrollbar for text area
	
	
	//creating buttons for keyboard.
	//all the button for row one
	private JButton VK_TILD 		= 	new JButton("~");
	private JButton VK_1 			= 	new JButton("1");
	private JButton VK_2 			= 	new JButton("2");
	private JButton VK_3 			= 	new JButton("3");
	private JButton VK_4 			= 	new JButton("4");
	private JButton VK_5 			= 	new JButton("5");
	private JButton VK_6 			= 	new JButton("6");
	private JButton VK_7 			= 	new JButton("7");
	private JButton VK_8			= 	new JButton("8");
	private JButton VK_9			= 	new JButton("9");
	private JButton VK_0 			= 	new JButton("0");
	private JButton VK_MINUS 		= 	new JButton("-");
	private JButton VK_PLUS 		= 	new JButton("+");
	private JButton VK_BACKSPACE	= 	new JButton("BackSpace");
	
	//all the buttons for row second 
	private JButton VK_TAB				= 	new JButton("Tab");
	private JButton VK_Q				= 	new JButton("Q");
	private JButton VK_W				= 	new JButton("W");
	private JButton VK_E				= 	new JButton("E");
	private JButton VK_R				= 	new JButton("R");
	private JButton VK_T				= 	new JButton("T");
	private JButton VK_Y				= 	new JButton("Y");
	private JButton VK_U				= 	new JButton("U");
	private JButton VK_I				= 	new JButton("I");
	private JButton VK_O				= 	new JButton("O");
	private JButton VK_P				= 	new JButton("P");
	private JButton VK_OPEN_BRACKET		= 	new JButton("[");
	private JButton VK_CLOSE_BRACKET	= 	new JButton("]");
	private JButton VK_BACK_SLASH		= 	new JButton("\\");
	
    //all the button for row Third
	private JButton VK_CAPSLOCK			= 	new JButton("Caps");
	private JButton VK_A				= 	new JButton("A");
	private JButton VK_S				= 	new JButton("S");
	private JButton VK_D				= 	new JButton("D");
	private JButton VK_F				= 	new JButton("F");
	private JButton VK_G				= 	new JButton("G");
	private JButton VK_H				= 	new JButton("H");
	private JButton VK_J				= 	new JButton("J");
	private JButton VK_K				= 	new JButton("K");
	private JButton VK_L				= 	new JButton("L");
	private JButton VK_COLON			= 	new JButton(":");
	private JButton VK_QUOTED			= 	new JButton("\"");
	private JButton VK_ENTER			= 	new JButton("Enter");

	//all the button for row fourth
	private JButton VK_SHIFT			= 	new JButton("Shift");
	private JButton VK_Z				= 	new JButton("Z");
	private JButton VK_X				= 	new JButton("X");
	private JButton VK_C				= 	new JButton("C");
	private JButton VK_V				= 	new JButton("V");
	private JButton VK_B				= 	new JButton("B");
	private JButton VK_N				= 	new JButton("N");
	private JButton VK_M				= 	new JButton("M");
	private JButton VK_COMMA			= 	new JButton(",");
	private JButton VK_PERIOD			= 	new JButton(".");
	private JButton VK_SLASH			= 	new JButton("?");
	private JButton VK_PGUP				= 	new JButton("^");
	
	
	//all the button for row Fifth
	private JButton VK_SPACE			= 	new JButton("");
	private JButton VK_PGLEFT			= 	new JButton("<");
	private JButton VK_PGRIGHT			= 	new JButton(">");
	private JButton VK_PGDOWN			= 	new JButton("V");
	
	//start of main panel function
	public JPanel pnlMain(){
		mainPanel.setLayout(new GridLayout(3,0));//creating gridlayout for panel
		mainPanel.setComponentOrientation(ComponentOrientation.LEFT_TO_RIGHT);
		mainPanel.add(labelPanel);//add label panel in main panel
		mainPanel.add(textPanel);//add text area panel in main panel
		mainPanel.add(keysPanel);//add keys panel in main panel
		mainPanel.add(pnlLabel());//call pnlLabel function
		mainPanel.add(pnlText());//call pnlText function
		mainPanel.add(pnlKeys());//call pnlKeys function
		//add main panel in frame
		frame.add(mainPanel);
		return mainPanel;
	}//end of pnlMain
	
	//start of pnlLabel function
	public JPanel pnlLabel(){
		labelPanel.setLayout(new GridLayout (2,0));//creating gridlayout for panel
		labelPanel.setComponentOrientation(ComponentOrientation.LEFT_TO_RIGHT);
		labelPanel.add(labelRow1);//add label message to label panel
		//add label panel to main panel
		return labelPanel;
	}//end of pnlLabel
	
	//start of pnlText function
	public JPanel pnlText(){
		textPanel.setLayout(new GridLayout (1,0));//creating gridlayout for panel
		textPanel.setComponentOrientation(ComponentOrientation.LEFT_TO_RIGHT);
		textPanel.add(textArea);//add text area in the text panel
		return textPanel;
	}//end of pnlText
	
	//start of pnlKeys function
	public JPanel pnlKeys(){
		keysPanel.setLayout(new GridLayout (5,0));//creating gridlayout for panel
		keysPanel.setComponentOrientation(ComponentOrientation.LEFT_TO_RIGHT);
		//add key row1 to row5 in key panel
		keysPanel.add(row1);
		keysPanel.add(row2);
		keysPanel.add(row3);
		keysPanel.add(row4);
		keysPanel.add(row5);
		keysPanel.add(pnlRow1());//call pnlRow1 function
		keysPanel.add(pnlRow2());//call pnlRow2 function
		keysPanel.add(pnlRow3());//call pnlRow3 function
		keysPanel.add(pnlRow4());//call pnlRow4 function
		keysPanel.add(pnlRow5());//call pnlRow5 function
		return keysPanel;
	}//end of pnlKey function
	
	// starting of all pnlRow1 to pnlRow5 function respectively
	public JPanel pnlRow1(){
		row1.setLayout(new GridLayout (1,14));//creating gridlayout for panel
		row1.setComponentOrientation(ComponentOrientation.LEFT_TO_RIGHT);
		//adding keys in row1 panel
		row1.add(VK_TILD);
		row1.add(VK_1);
		row1.add(VK_2);
		row1.add(VK_3);
		row1.add(VK_4);
		row1.add(VK_5);
		row1.add(VK_6);
		row1.add(VK_7);
		row1.add(VK_8);
		row1.add(VK_9);
		row1.add(VK_0);
		row1.add(VK_MINUS);
		row1.add(VK_PLUS);
		row1.add(VK_BACKSPACE);
		return row1;
	}
	
	public JPanel pnlRow2(){
		row2.setLayout(new GridLayout (1,14));//creating gridlayout for panel
		row2.setComponentOrientation(ComponentOrientation.LEFT_TO_RIGHT);
		//adding keys in row2 panel
		row2.add(VK_TAB);
		row2.add(VK_Q);
		row2.add(VK_W);
		row2.add(VK_E);
		row2.add(VK_R);
		row2.add(VK_T);
		row2.add(VK_Y);
		row2.add(VK_U);
		row2.add(VK_I);
		row2.add(VK_O);
		row2.add(VK_P);
		row2.add(VK_OPEN_BRACKET);
		row2.add(VK_CLOSE_BRACKET);
		row2.add(VK_SLASH);
		return row2;
	}
	
	public JPanel pnlRow3(){
		row3.setLayout(new GridLayout (1,13));//creating gridlayout for panel
		row3.setComponentOrientation(ComponentOrientation.LEFT_TO_RIGHT);
		//adding keys in row3 panel
		row3.add(VK_CAPSLOCK);
		row3.add(VK_A);
		row3.add(VK_S);
		row3.add(VK_D);
		row3.add(VK_F);
		row3.add(VK_G);
		row3.add(VK_H);
		row3.add(VK_J);
		row3.add(VK_K);
		row3.add(VK_L);
		row3.add(VK_COLON);
		row3.add(VK_QUOTED);
		row3.add(VK_ENTER);
		return row3;
	}
	
	public JPanel pnlRow4(){
		row4.setLayout(new GridLayout (1,14));//creating gridlayout for panel
		row4.setComponentOrientation(ComponentOrientation.LEFT_TO_RIGHT);
		//adding keys in row4 panel
		row4.add(VK_SHIFT);
		row4.add(VK_Z);
		row4.add(VK_X);
		row4.add(VK_C);
		row4.add(VK_V);
		row4.add(VK_B);
		row4.add(VK_N);
		row4.add(VK_M);
		row4.add(VK_COMMA);
		row4.add(VK_PERIOD);
		row4.add(VK_SLASH);
		row4.add(new JLabel());
		row4.add(new JLabel());
		row4.add(VK_PGUP);
		row4.add(new JLabel());
		return row4;
	}
	
	public JPanel pnlRow5(){
		row5.setLayout(new GridLayout(1,3));//creating gridlayout for panel
		row5.setComponentOrientation(ComponentOrientation.LEFT_TO_RIGHT);
		//adding space and arrow keys in row5 panel
		row5.add(lastRowLeft);//add label panel in main panel
		row5.add(lastRowCenter);//add text area panel in main panel
		row5.add(lastRowRight);
		row5.add(pnlLastRowLeft());
		row5.add(pnlLastRowCenter());
		row5.add(pnlLastRowRight());
		return row5;
	}
	
	//starting of row5 panel's sub-panel
	//starting of left panel of row5
	public JPanel pnlLastRowLeft(){
		lastRowLeft.setLayout(new GridLayout(1,1));
		lastRowLeft.setComponentOrientation(ComponentOrientation.LEFT_TO_RIGHT);
		lastRowLeft.add(new JLabel());
		return lastRowLeft;
	}
	//starting of Middel panel of row5
	public JPanel pnlLastRowCenter(){
		lastRowCenter.setLayout(new GridLayout(1,1));
		lastRowCenter.setComponentOrientation(ComponentOrientation.LEFT_TO_RIGHT);
		lastRowCenter.add(VK_SPACE);
		return lastRowCenter;
	}
	//staring of Right panel of row5
	public JPanel pnlLastRowRight(){
		lastRowRight.setLayout(new GridLayout(1,5));
		lastRowRight.setComponentOrientation(ComponentOrientation.LEFT_TO_RIGHT);
		lastRowRight.add(new JLabel());
		lastRowRight.add(new JLabel());
		lastRowRight.add(VK_PGLEFT);
		lastRowRight.add(VK_PGDOWN);
		lastRowRight.add(VK_PGRIGHT);
		return lastRowRight;
	}
	
	//Start of the KeyListener class
	class Myaction implements KeyListener{
		//initialising keyevent array for every key
		
		//This array is only for numeric digits
		int btnRow1[] = { KeyEvent.VK_0,KeyEvent.VK_1,KeyEvent.VK_2,KeyEvent.VK_3,KeyEvent.VK_4,KeyEvent.VK_5,KeyEvent.VK_6,
						  KeyEvent.VK_7,KeyEvent.VK_8,KeyEvent.VK_9};
		
		//This array is only for Characters				  
		int btnRow2[] = { KeyEvent.VK_A,KeyEvent.VK_B,KeyEvent.VK_C,KeyEvent.VK_D,KeyEvent.VK_E,KeyEvent.VK_F,KeyEvent.VK_G,
					      KeyEvent.VK_H,KeyEvent.VK_I,KeyEvent.VK_J,KeyEvent.VK_K,KeyEvent.VK_L,KeyEvent.VK_M,KeyEvent.VK_N,
					      KeyEvent.VK_O,KeyEvent.VK_P,KeyEvent.VK_Q,KeyEvent.VK_R,KeyEvent.VK_S,KeyEvent.VK_T,KeyEvent.VK_U,
					      KeyEvent.VK_V,KeyEvent.VK_W,KeyEvent.VK_X,KeyEvent.VK_Y,KeyEvent.VK_Z };
		
		//This array is only for Special Character 			      
		int btnRow3[] = { KeyEvent.VK_BACK_QUOTE/*consider as TILD sign*/,KeyEvent.VK_MINUS,KeyEvent.VK_EQUALS/*consider as PLUS sign*/,
						  KeyEvent.VK_BACK_SPACE,KeyEvent.VK_TAB,KeyEvent.VK_OPEN_BRACKET,KeyEvent.VK_CLOSE_BRACKET,KeyEvent.VK_BACK_SLASH,
						  KeyEvent.VK_CAPS_LOCK,KeyEvent.VK_SEMICOLON,KeyEvent.VK_QUOTE/*consider as Double Quote sign*/,KeyEvent.VK_ENTER,
						  KeyEvent.VK_SHIFT,KeyEvent.VK_COMMA,KeyEvent.VK_PERIOD,KeyEvent.VK_SLASH };
		
		//This array is only for Arrow keys				  
		int btnRow4[] = { KeyEvent.VK_UP,KeyEvent.VK_LEFT,KeyEvent.VK_DOWN,KeyEvent.VK_RIGHT };
		
		//This array is only for Space
		int btnRow5[] = { KeyEvent.VK_SPACE };
		
		// initialize array of JButton
		//This JButton array is only for numeric digits
		JButton btnsRow1[] = { VK_0,VK_1,VK_2,VK_3,VK_4,VK_5,VK_6,VK_7,VK_8,VK_9 };
		
		//This JButton array is only for Characters
		JButton btnsRow2[] = { VK_A,VK_B,VK_C,VK_D,VK_E,VK_F,VK_G,VK_H,VK_I,VK_J,VK_K,VK_L,VK_M,VK_N,VK_O,VK_P,VK_Q,VK_R,VK_S,
							   VK_T,VK_U,VK_V,VK_W,VK_X,VK_Y,VK_Z };
							   
		//This JButton array is only for Special characters							   
		JButton btnsRow3[] = { VK_TILD,VK_MINUS,VK_PLUS,VK_BACKSPACE,VK_TAB,VK_OPEN_BRACKET,VK_CLOSE_BRACKET,VK_BACK_SLASH,VK_CAPSLOCK,
						  	   VK_COLON,VK_QUOTED,VK_ENTER,VK_SHIFT,VK_COMMA,VK_PERIOD,VK_SLASH };
		
		//This JButton array is only for Arrow keys						  	   
		JButton btnsRow4[] = { VK_PGUP,VK_PGLEFT,VK_PGDOWN,VK_PGRIGHT };
		
		//This JButton array is only for Space
		JButton btnsRow5[] = { VK_SPACE };
		
		
		
		//@Override means to override the functionality of an existing method.
		@Override
		//start of keyPressed function when user enter a keys
		public void keyPressed(KeyEvent e){
			
			for (int i = 0;i<btnsRow1.length;i++){
				if(e.getKeyCode() == btnRow1[i]){
					btnsRow1[i].setBackground(Color.MAGENTA);
				}
			}
			for (int i = 0;i<btnsRow2.length;i++){
				if(e.getKeyCode() == btnRow2[i]){
					btnsRow2[i].setBackground(Color.YELLOW);
				}
			}
			for (int i = 0;i<btnsRow3.length;i++){
				if(e.getKeyCode() == btnRow3[i]){
					btnsRow3[i].setBackground(Color.GREEN);
				}
			}
			for (int i = 0;i<btnsRow4.length;i++){
				if(e.getKeyCode() == btnRow4[i]){
					btnsRow4[i].setBackground(Color.DARK_GRAY);
				}
			}
			for (int i = 0;i<btnsRow5.length;i++){
				if(e.getKeyCode() == btnRow5[i]){
					btnsRow5[i].setBackground(Color.RED);
				}
			}
		}//end of the function
		
		@Override
		//start of keyReleased function when user released the key after enter.
		public void keyReleased (KeyEvent e){
			
			for (int i = 0;i<btnsRow1.length;i++){
				if(e.getKeyCode() == btnRow1[i]){
					btnsRow1[i].setBackground(null);
				}
			}
			for (int i = 0;i<btnsRow2.length;i++){
				if(e.getKeyCode() == btnRow2[i]){
					btnsRow2[i].setBackground(null);
				}
			}
			for (int i = 0;i<btnsRow3.length;i++){
				if(e.getKeyCode() == btnRow3[i]){
					btnsRow3[i].setBackground(null);
				}
			}
			for (int i = 0;i<btnsRow4.length;i++){
				if(e.getKeyCode() == btnRow4[i]){
					btnsRow4[i].setBackground(null);
				}
			}
			for (int i = 0;i<btnsRow5.length;i++){
				if(e.getKeyCode() == btnRow5[i]){
					btnsRow5[i].setBackground(null);
				}
			}
		}//end of the function
		
		@Override
		//start of keyTyped function
		public void keyTyped(KeyEvent e){
			// this function doesn't do anything
		}
		
	}//end of the Myaction class for keyEvents.
	
	 //calll constructor of the main Keyboard class		
     Keyboard() {
    	Myaction action = new Myaction();// create an object of listener class
    	textArea.addKeyListener(action);//add keyEvents on text area after pressing the keys
    	frame.setLayout(new GridLayout (1,0));
    	frame.add(pnlMain());
    /*	frame.add(pnlLabel());
    	frame.add(pnlText());
    	frame.add(pnlKeys());
    	frame.add(pnlRow1());
    	frame.add(pnlRow2());
    	frame.add(pnlRow3());
    	frame.add(pnlRow4());
    	frame.add(pnlRow5());	
    */
    }
    //function to define frame
    public void launchFrame(){
     	//Display and setup the frame
	    frame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);// exit on close
        frame.setTitle("Typing Tutor");
        frame.setComponentOrientation(ComponentOrientation.LEFT_TO_RIGHT);
        frame.setSize(1200,600);
        frame.setVisible(true);// visibility true
        frame.setLocationRelativeTo(null);//set the location on middle of the screen
    }
	//start of main
     public static void main(String args[]){
        Keyboard gui = new Keyboard();
       	gui.launchFrame();
    }//end of main
}//end of Keyboard class








