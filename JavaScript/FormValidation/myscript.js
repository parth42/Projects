//***********************************************************************************//
//* Name : PARTH PARIKH                                                             *//
//* Zenit login : int222_132b40                                                     *//
//***********************************************************************************//

function validationForPayment() {   

    //********************************************************************************//
    //*   You will need to call the functions that validate the following:           *//
    //********************************************************************************//
    //*        (1)              (2)              (3)             (4)                 *//
    //********************************************************************************//
    //*   Property value  -  Down payment  -  Interest rate -  Amortization          *//
    //********************************************************************************//
    //*   If there are no errors, then call                                          *//
    //*                                                                              *//
    //*      detailPaymentCalculation(...., ......, ......, ......);                 *//
    //*                                                                              *//
    //*   and make sure to pass the four values in the order shown above.            *//
    //*                                                                              *//
    //********************************************************************************//
    //*   If there are errors, simply update the comments area with the message:     *//
    //*   Please complete the form first and then click on Calculate Monthly Payment *//
    //*                                                                              *//
    //********************************************************************************//


	var errMessages="";
	
       errMessages = propvalueCheck(errMessages);       
       errMessages = dpCheck(errMessages);
       errMessages = amortizationCheck(errMessages);
       errMessages = IntRateCheck(errmessages);

	if(errMessages="")
	{
		var prop = document.mortgage.propValue.value;
		var d_p = document.mortgage.downPay.value;
		var intRate = document.mortgage.intRate.value;
		var Amortization = document.mortgage.amortization.value;
		detailPaymentCalculation(prop,d_p,intRate,Amortization);
	}
	else
	{
		showErrors(errMessages);
	}	
		

} // End of validationForPayment function

    //********************************************************************************//
    //*   Do not modify any statements in detailPaymentCalculation function          *//
    //********************************************************************************//

function detailPaymentCalculation(mortAmount,mortDownPayment,mortRate,mortAmortization) {

    //********************************************************************************//
    //*   This function calculates the monthly payment based on the following:       *//
    //*                                                                              *//
    //*               M = P [ i(1 + i)n ] / [ (1 +  i)n - 1]                         *//
    //*                                                                              *//
    //********************************************************************************//
     var paymentError = "";
     var v = mortAmount * 1;
     var d = mortDownPayment * 1;
     var i = mortRate * 1;
     var y = mortAmortization * 1;
     var a = v - d;
         i = i/100/12;
         n = y * 12;
     var f = Math.pow((1+i),n);

     var p = (a * ((i*f)/(f-1))).toFixed(2);

     if (p=="NaN" || p=="Infinity") {
         paymentError = "Please complete the form before attempting to calculate the monthly payment" 
         document.forms[0].comments.value = paymentError;
         document.forms[0].payment.value = "";
     }
     else {
           document.forms[0].payment.value = p;
           document.forms[0].comments.value = "";
     }

} // End of detailPaymentCalculation function


function completeFormValidation() {

    //********************************************************************************//
    //*                                                                              *//
    //* This function calls the different functions to validate all required fields  *//
    //*                                                                              *//
    //* Once you have validated all field,                                           *//
    //* determine if any error(s) have been encountered                              *//
    //*                                                                              *//
    //* If any of the required fields are in error:                                  *//
    //*                                                                              *//
    //*    present the client with a list of all the errors in in the aside          *//
    //*    reserved area and                                                         *//
    //*          don't submit the form to the CGI program in order to allow the      *//
    //*          client to correct the fields in error                               *//
    //*                                                                              *//
    //*                                                                              *//
    //*    Error messages should be meaningful and reflect the exact error condition.*//
    //*                                                                              *//
    //*    Make sure to return false                                                 *//
    //*                                                                              *//
    //* Otherwise (if there are no errors)                                           *//
    //*                                                                              *//
    //*    Change the 1st. character in the field called client to upper case        *//
    //*                                                                              *//
    //*    Change the initial value in the field called jsActive from OFF to ON      *//
    //*                                                                              *//
    //*    When a browser submits a form to a CGI program, disabled fields           *//
    //*    like the payment field are not included. To insure that the payment field *//
    //*    is sent to the CGI, include the following JavaScript statement            *//
    //*    document.forms[0].payment.disabled = false;                               *//
    //*                                                                              *//
    //*    Make sure to return true in order for the form to be submitted to the CGI *//
    //*                                                                              *//
    //********************************************************************************//




var errMessages = "";           

       errMessages = UserIdCheck(errMessages); 			// call userId validation field
       errMessages = ClientNameCheck(errMessages);		// call Client Name validation field
       errMessages = propvalueCheck(errMessages);               // call Property value field
       errMessages = dpCheck(errMessages);			// call downpayment field
       errMessages = IncomeCheck(errMessages);			// call income field 
       errMessages = propLocalCheck(errMessages);		// call property location field
       errMessages = yearCheck(errMessages);			// call Mortgage Year field
       errMessages = monthCheck(errMessages);			// call Mortgage Month field
       errMessages = amortizationCheck(errMessages);		// call No. of year field
       errMessages = propertyDetailCheck(errMessages);		// call Property detail field
       errMessages = IntRateCheck(errMessages);			// call Interest rate field

       if (errMessages != "")
       {
          showErrors(errMessages);
          return false;       
       }                               
       else
       {
	  var ClientName = document.mortgage.client.value;
          var prop = document.mortgage.propValue.value;
          var d_p = document.mortgage.downPay.value;
          var intRate = document.mortgage.intRate.value;
          var Amortization = document.mortgage.amortization.value;
          detailPaymentCalculation(prop,d_p,intRate,Amortization);
          ClientName = ClientName.substr(0,1).toUpperCase() + ClientName.substr(1,name.length);
          document.mortgage.client.value = ClientName;
          document.mortgage.payment.disabled = false;
	  document.mortgage.jsActive.value = "ON";
          clearErrors();                         
          return true;                 
       }




} // End of completeFormValidation


     // ****************************************************************
     // ** Function Name : showErrors()                               **
     // **                                                            **
     // ** Called from   : formValidationExample()                    **
     // ****************************************************************
     // ** Function Description                                       **
     // ** ====================                                       **
     // **                                                            **
     // ** This function Show all the errors                          **
     // **                                                            **
     // ****************************************************************

     function showErrors(messages) {

	var msg="<p class='jspar'>You have Some errors to Solve..!</p>";
        msg += "<ul>" + messages + "</ul>";    
        document.getElementById('errors').innerHTML = msg;

     }  //  End of function



     // ****************************************************************
     // ** Function Name : clearErrors()                              **
     // **                                                            **
     // ** Called from   : completeformValidation()                   **
     // ****************************************************************
     // ** Function Description                                       **
     // ** ====================                                       **
     // **                                                            **
     // ** This function clear all the errors.                        **
     // **                                                            **
     // **************************************************************** 


     function  clearErrors() {

        document.getElementById('errors').innerHTML = "";             // clear errors already showing on the web page

     }



     // ****************************************************************
     // ** Function Name : UserIdCheck()                              **
     // **                                                            **
     // ** Called from   :completeformValidation()                    **
     // ****************************************************************
     // ** Function Description                                       **
     // ** ====================                                       **
     // **                                                            **
     // ** This function check user ID field from the given           **
     // ** validation conditions.                                     **
     // ****************************************************************


function UserIdCheck(errMessages)
{
	var id=document.mortgage.userId.value;
	var leftSide=0,rightSide=0,sum1=0,sum2=0
	if(id.length==0)
	{
		 errMessages +="<li>UserId Filed is empty. You have to Enter your Id in field.</li>";	
	}
	else
	{
		if (id.length==10)
                {
                        if(id.charCodeAt(4)==45)
                        {
				userId=id.split('-');
				for(var i=0;i<4;i++)
				{
					if(userId[0].charCodeAt(i) < 48 || userId[0].charCodeAt(i) >57)
					{
						leftSide++;
					}
					else
					{
						sum1+=(userId[0].charAt(i)*1);
					}
				}
				for(var j=0;j<5;j++)
                                {
                                        if(userId[1].charCodeAt(j) < 48 || userId[1].charCodeAt(j) >57)
                                        {
                                                rightSide++;
                                        }
					else
					{
						sum2+=(userId[1].charAt(j)*1);				
					}
                                }
				if(leftSide>0 && rightSide>0)
				{
					errMessages += "<li>All Side's value must be numeric field.</li>";
				}	
				else if(leftSide>0)
				{
					errMessages += "<li>Left Side's value must be numeric field.</li>";
				}
				else if(rightSide>0)
                                {
                                        errMessages += "<li>Right Side's value must be numeric field.</li>";
                                }
				else
				{
					if(sum1<=0 && sum2<=0)
					{
						errMessages += "<li>The sum of the numbers to the Left and Right of hypen must be greater than Zero.</li>";
					}
					else if(sum1<=0)
					{
						errMessages += "<li>The sum of the numbers to the Left side of hypen must be greater than Zero.</li>";
					}
					else if(sum2<=0)
                                        {
                                                errMessages += "<li>The sum of the numbers to the Right side of hypen must be greater than Zero.</li>";
                                        }
					else if((2*sum1)!=sum2)
					{
						errMessages += "<li>The sum of the numbers to the Right side of hypen must be Double than Left Side.</li>";
					}
				}
			}
                        else
                        {
                                 errMessages += "<li>Please enter - (dashed) on the 5th position.</li>";
                        }
                }
                else
                {
                      errMessages += "<li>Please Enter 10 valid digit.</li>";
                }
        
	}
	return errMessages;

}     // End of Function



     // ****************************************************************
     // ** Function Name : ClientNameCheck()                          **
     // **                                                            **
     // ** Called from   :completeformValidation()                    **
     // ****************************************************************
     // ** Function Description                                       **
     // ** ====================                                       **
     // **                                                            **
     // ** This function check Client Name field from the given       **
     // ** validation conditions.                                     **
     // ****************************************************************


function ClientNameCheck(errMessages)
{
	var ClientName=document.mortgage.client.value;
	var sum1=0,sum2=0,hypen=0,apostrophe=0,together=0,last=0,lastChar=ClientName.length-1;
			
	if(ClientName.length < 3)
	{
		errMessages += "<li>You have to enter atleast 3 character in Name field.</li>";
	}
	else
	{
		var CamelName=ClientName.toUpperCase();
		for(var i=0;i<CamelName.length;i++)
		{
			if(i<3)
			{
				if(CamelName.charCodeAt(i)<65 || CamelName.charCodeAt(i)>90)
				{
					 sum1++;
				}
			}
			if(CamelName.charCodeAt(i)<65 || CamelName.charCodeAt(i)>90)
			{
				if(CamelName.charCodeAt(i) == 45 || CamelName.charCodeAt(i) == 39)
				{
					if(CamelName.charCodeAt(i)==45)
					{
						hypen++;
					}
					else
					{
						apostrophe++;
					}
					if(CamelName.charCodeAt(i+1)==39 || CamelName.charCodeAt(i+1)==45)
					{
						together;
					}
				}
				else
				{
					sum2++;
				}
			}
		}

		if(sum2>0)
		{
			errMessages += "<li>you can use combination of [a to z] or [A to Z] with one hypen and one apostrophe.</li>";
		}
		else if(sum1>0)
                {
                        errMessages += "<li>All Characters must be Alphabetic at beginning.</li>";
                }
		else if(hypen>0)
		{
			errMessages += "<li>You can not use hypen at End..</li>";
		}
		else if(apostrophe>0)
                {
                        errMessages += "<li>You can not use apostrophe at End.</li>";
                }
		else if(together>0)
		{
			errMessages += "<li>hypen and apostrophe never be together.</li>";
		}
		else if(last>0)
		{
			errMessages += "<li>Last character should be Alpha not ' or - .</li>";
		}
		else if(CamelName.charCodeAt(lastChar) == 45 || CamelName.charCodeAt(lastChar) == 39)
		{
			errMessages += "<li>Last character of name should not be hypen(-) or apostrophe(') .</li>";	
		}
	}
	return errMessages;
		
}	// End of function.




     // ****************************************************************
     // ** Function Name : propvalueCheck()                           **
     // **                                                            **
     // ** Called from   :completeformValidation()                    **
     // ****************************************************************
     // ** Function Description                                       **
     // ** ====================                                       **
     // **                                                            **
     // ** This function check Property value with down payment       **
     // ** fro the given validation conditions.                       **
     // ****************************************************************



function  propvalueCheck(errMessages)
{
	var PropValue = document.mortgage.propValue.value;
	var dp = document.mortgage.downPay.value;
	var payment=0;
	if(PropValue.length==0)
	{
		errMessages+= "<li>Please enter some value in property field.</li>";
	}
	else
	{
		if(PropValue.indexOf('-') == 0 )
                {
                        errMessages += "<li>Enter positive property value.</li>"
                }
		else
		{
		for(var i=0;i<PropValue.length;i++)
		{
			if(PropValue.charCodeAt(i)<48 || PropValue.charCodeAt(i)>57)
			{
				payment++;
			}
		}
		if(payment>0)
		{
			errMessages+= "<li>Property value must be numeric - positive and whole number.</li>";
		}
		else if((PropValue - dp)<50000) 
		{
			errMessages+= "<li>Property value should be more than 50,000.</li>";
		}
		}	
	}
	return errMessages;
}	// End of function



     // ****************************************************************
     // ** Function Name : dpCheck()                          	      **
     // **                                                            **
     // ** Called from   :completeformValidation()                    **
     // ****************************************************************
     // ** Function Description                                       **
     // ** ====================                                       **
     // **                                                            **
     // ** This function check down payment value with payment method **
     // ** from the given validation conditions.                      **
     // ****************************************************************



function dpCheck(errMessages)
{
	var PropValue = document.mortgage.propValue.value;
        var dp = document.mortgage.downPay.value;
        var payment=0;
        if(dp.length==0)
        {
                errMessages+= "<li>Please enter some value in Downpayment field.</li>";
        }
	else
	{
		if(dp.indexOf('-') == 0 )
                {
                        errorMsgs += "<li>Please enter positive downpayment.</li>"
                }
        else
        {
                for(var i=0;i<dp.length;i++)
                {
                        if(dp.charCodeAt(i)<48 || dp.charCodeAt(i)>57)
                        {
                                payment++;
                        }
                }
                if(payment>0)
                {
                        errMessages+= "<li>Down Payment value must be numeric - positive and whole number.</li>";
                }
                else if(dp<(PropValue*0.05))
                {
                        errMessages+= "<li>DownPayment should be more than 50,000</li>";
                }
        }
	}
        return errMessages;	

}	//End of function


     // ****************************************************************
     // ** Function Name : IncomeCheck(errMessages)                   **
     // **                                                            **
     // ** Called from   :completeformValidation()                    **
     // ****************************************************************
     // ** Function Description                                       **
     // ** ====================                                       **
     // **                                                            **
     // ** This function check Income range if it is selected or not  **
     // ** from the given validation conditions.                      **
     // ****************************************************************


function IncomeCheck(errMessages)
{
	var Incm = document.mortgage.income.selectedIndex;
	if(Incm == -1)
	{
		errMessages += "<li>you have to selecat atleast one Income.</li>";
	}
	return errMessages;
}	//End of function



     // ****************************************************************
     // ** Function Name : propLocalCheck(errMessages)                **
     // **                                                            **
     // ** Called from   :completeformValidation()                    **
     // ****************************************************************
     // ** Function Description                                       **
     // ** ====================                                       **
     // **                                                            **
     // ** This function check Property Location and is only one      **
     // ** one option from the given information.                     **
     // ****************************************************************

function propLocalCheck(errMessages) 
{
	var property_location = document.mortgage.propLocation.length;
        var result="";
	for (var i = 0; i < property_location; i++)
	{
		if(document.mortgage.propLocation[i].checked  == true)	// true=checked
		{							 
                      result += "You select " + document.mortgage.propLocation[i].value;
                }

               }
               if (result=="")
	       {                      
               		errMessages+= "<li>Please select atleast one Property Location.</li>";
               }
	return errMessages;
}	//End of function


     // ****************************************************************
     // ** Function Name : yearCheck(errMessages)                     **
     // **                                                            **
     // ** Called from   :completeformValidation()                    **
     // ****************************************************************
     // ** Function Description                                       **
     // ** ====================                                       **
     // **                                                            **
     // ** This function check Year and check with current and        **
     // ** and next year from the given information.                  **
     // ****************************************************************


function yearCheck(errMessages)
{
	var mortgageYear=document.mortgage.mortYear.value;
	var myDate = new Date();
	var myCurrentYear = myDate.getFullYear();
	var temp=0;
	
	if(mortgageYear.length!=4)
	{
		errMessages += "<li>Year should be in four digit.</li>";
	}
	else
	{
		for(var i=0;i<mortgageYear.length;i++)
		{
			if(mortgageYear.charCodeAt(i)<48 || mortgageYear.charCodeAt(i)>57)
			{
				temp++;
			}
		}
		if(temp==0)
		{	
			if(mortgageYear == myCurrentYear || mortgageYear == (myCurrentYear + 1))
                        {
                        }
                        else
                        {
                                errMessages += "<li>Mortgage year must be equal to the current year or 1 year greater than current year.</li>";
                        }
		}
		else
		{
			errMessages+= "<li>Year should be numeric</li>";
		}
	}
	return errMessages;
	
}	//End of function 


     // ****************************************************************
     // ** Function Name : monthCheck(errMessages)                    **
     // **                                                            **
     // ** Called from   :completeformValidation()                    **
     // ****************************************************************
     // ** Function Description                                       **
     // ** ====================                                       **
     // **                                                            **
     // ** This function check no of year.		              **
     // **					                      **
     // ****************************************************************


function monthCheck(errMessages)
{
	var mortgageMonth = document.mortgage.mortMonth.value;
	var temp=0;
	
	if(mortgageMonth.length == 0)
	{
		errMessages += "<li>Month should not be empty</li>";
	}
	else
	{
		for(var i=0;i<mortgageMonth.length;i++)
		{
			if(mortgageMonth.charCodeAt(i)<48 ||mortgageMonth.charCodeAt(i)>57)
			{
				temp++;
			}
		}
		if(temp==0)
		{
			if(mortgageMonth < 01 || mortgageMonth > 12)
			{
				errMessages += "<li>Month always in between  1 to 12.</li>";
			}
		}
		else if(temp>0)
		{
			errMessages += "<li>Month always in 2 digit value.</li>";
		}
	}
	 return errMessages;
}	//End of function 



     // ****************************************************************
     // ** Function Name : amortizationCheck(errMessages)             **
     // **                                                            **
     // ** Called from   :completeformValidation()                    **
     // ****************************************************************
     // ** Function Description                                       **
     // ** ====================                                       **
     // **                                                            **
     // ** This function check no of year		              **
     // ** 							      **
     // ****************************************************************

function amortizationCheck(errMessages)
{
	var mortAmortization = document.mortgage.amortization.value;
	var temp=0;
	if(mortAmortization.length==0)
	{
		errMessages += "<li>Please enter No of year.</li>";
	}
	else
	{
		for(i=0;i<mortAmortization.length;i++)
		{
			if(mortAmortization.charCodeAt(i) < 48 || mortAmortization.charCodeAt(i) > 57)
			{
				temp++;
			}
		}
		if(temp==0)
		{
			if(mortAmortization < 05 || mortAmortization > 25)
			{
				errMessages+= "<li>year must between in 5 and 25</li>";
			}
		}
		else if(temp>0)
		{
			errMessages += "<li>Year must be in digit</li>";
		}
	}
	return errMessages;
}




     // ****************************************************************
     // ** Function Name : PropDetailCheck(errMessages)               **
     // **                                                            **
     // ** Called from   :completeformValidation()                    **
     // ****************************************************************
     // ** Function Description                                       **
     // ** ====================                                       **
     // **                                                            **
     // ** This function check property detail			      **
     // ** 				                              **
     // ****************************************************************

function OptionCheck() // This function use for select multiple options.
{
	document.mortgage.propDetails[document.mortgage.propDetails.length - 1].checked = false;
}

function AnyOfAbove() // This function use to select All of above option.
{
	var checkboxLength=document.mortgage.propDetails.length - 1;
	for(var i=0;i<checkboxLength;i++)
	{
		document.mortgage.propDetails[i].checked = false ;
	}
}

function propertyDetailCheck(errMessages)
{
	var propLength=document.mortgage.propDetails.length;
	var temp=0,temp1=0;
	for(var i=0;i<propLength-1;i++)
	{
		if(document.mortgage.propDetails[i].checked==true)
		{
			temp++;
			if(document.mortgage.propDetails[propLength-1].checked==true)
			{
				temp1=1;
				break;
			}
		}
	}
	if(document.mortgage.propDetails[propLength-1].checked==true)
	{
		temp=1;
	}
	if(temp==0)
	{
		errMessages += "<li>Atlist one property Type must be select</li>";
	}
	else
	{
		if(temp1==1)
		{
			errMessages +="<li>Never select this option together in Property detail.</li>";
			for(i=0;i<propLength;i++)
			{
				document.mortgage.propDetails[i].checked=false;
			}
		}
	}
	return errMessages;
}	//End of function





     // ****************************************************************
     // ** Function Name : IntRateCheck(errMessages)                  **
     // **                                                            **
     // ** Called from   :completeformValidation()                    **
     // ****************************************************************
     // ** Function Description                                       **
     // ** ====================                                       **
     // **                                                            **
     // ** This function check Interest rate of year		      **
     // ** 							      **
     // ****************************************************************


function IntRateCheck(errMessages)
{
	var IntRate=document.mortgage.intRate.value;
	var temp=0,amount=0;
	if(IntRate.length == 0)
	{
		errMessages += "<li>you have to enter Interest rate.</li>";
	}
	else
	{
		for(var i=0;i<IntRate.length;i++)
		{
			if(IntRate.charCodeAt(i)<48 || IntRate.charCodeAt(i)>57)
			{
				temp++;
			}
		}
		if(IntRate.indexOf('.')==IntRate.lastIndexOf('.'))
		{
			amount=0;
		}
		else
		{
			amount=1
		}
		if(temp>0)
		{
			if(amount>0)
			{
				errMessages+= "<li>You can use dot(.) only one time in interest field</li>";
			}
	
			else if(IntRate < 3.000 || IntRate > 18.000)
			{
				errMessages+= "<li>Interest rate should be between 3 to 18</li>";
			}	
		}
		else
		{
			errMessages += "<li>You have to enter positive value in Interest rate field.</li>";
		}
	}
	return errMessages;
}	// End of function

