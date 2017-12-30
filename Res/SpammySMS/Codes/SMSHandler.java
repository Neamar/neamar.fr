package com.neamar.sms;

import android.app.Activity;
import android.app.PendingIntent;
import android.content.BroadcastReceiver;
import android.content.Context;
import android.content.Intent;
import android.content.IntentFilter;
import android.telephony.gsm.SmsManager;
import android.view.View;
import android.widget.ProgressBar;

public class SMSHandler
{
	protected MainScreen Parent;
	ProgressBar Progression;
	 
	
	public SMSHandler( MainScreen Parent)
	{
		this.Parent=Parent;
		Progression = (ProgressBar) Parent.findViewById(R.id.Progress_PB);
	}
	
	public void send(String Phone,String Message,int NbRepetitions)
	{
		 String SENT = "SMS_SENT";

	     PendingIntent sentPI = PendingIntent.getBroadcast(Parent, 0, new Intent(SENT), 0);

		//---when the SMS has been sent---
		Parent.registerReceiver(new BroadcastReceiver(){
		    @Override
		    public void onReceive(Context arg0, Intent arg1)
		    {
		    	if(getResultCode()==Activity.RESULT_OK)
		    		Progression.setProgress(Progression.getProgress()+1);
		    	else
		    		Parent.Tip(Parent.getString(R.string.FailSend));
		    }
		}, new IntentFilter(SENT));

		Progression.setVisibility(View.VISIBLE);
    	Progression.setMax(NbRepetitions);
    	
    	SmsManager sm = SmsManager.getDefault();

        for(int i=1; i<=NbRepetitions; i++)
        {
        	sm.sendTextMessage(Phone, null, Message.replace("%i",String.valueOf(i)).replace("%l",String.valueOf(NbRepetitions-i)), sentPI, null);
        }
	}
	
	
}

