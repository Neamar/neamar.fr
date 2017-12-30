package com.neamar.sms;

import java.util.ArrayList;

import android.app.Activity;
import android.content.ContentResolver;
import android.database.Cursor;
import android.net.Uri;
import android.os.Bundle;
import android.provider.Contacts.People;
import android.telephony.gsm.SmsManager;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.ArrayAdapter;
import android.widget.AutoCompleteTextView;
import android.widget.EditText;
import android.widget.ImageButton;
import android.widget.ProgressBar;
import android.widget.Spinner;
import android.widget.Toast;

public class MainScreen extends Activity
{
	private ArrayList<String> Contacts;

    /** Called when the activity is first created. */
    @Override
    public void onCreate(Bundle savedInstanceState)
    {
    	//Créer l'interface globale
        super.onCreate(savedInstanceState);
        setContentView(R.layout.main);
        
        //Masquer la barre de progression et afficher des scrollbars pour l'application
        findViewById(R.id.Progress_PB).setVisibility(View.INVISIBLE);
        
        
        //Remplir le spinner avec les possibilités pour le nombre de messages
        ArrayAdapter<CharSequence> adapter;
        final Spinner s = (Spinner) findViewById(R.id.Repetitions_S);

        adapter = ArrayAdapter.createFromResource(
        this, R.array.RepetitionsPossibilites, android.R.layout.simple_spinner_item);
        adapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
        s.setAdapter(adapter);

        //Préparer l'auto complétion des contacts
        ListContact();
        AutoCompleteTextView textView = (AutoCompleteTextView) findViewById(R.id.Destinataire_ET);
        adapter = new ArrayAdapter(this,
                android.R.layout.simple_dropdown_item_1line,Contacts);
        textView.setAdapter(adapter);
        
        final ImageButton button = (ImageButton) findViewById(R.id.Go_B);
        button.setOnClickListener(new OnClickListener() {
            public void onClick(View v) {
                sendSMS();
           }
        });
        
        Tip(getString(R.string.disclamer),Toast.LENGTH_LONG);
        
    }
    
	public void Tip(String Tip, int Duree)
	{
        Toast.makeText(MainScreen.this, Tip, Duree).show();
	}
	
	protected void Tip(String Tip)
	{
		Tip(Tip,Toast.LENGTH_SHORT);
	}
	protected void EnableApplication(Boolean Enable)
	{
    	findViewById(R.id.Destinataire_ET).setEnabled(Enable);
    	findViewById(R.id.Message_ET).setEnabled(Enable);
    	findViewById(R.id.Repetitions_S).setEnabled(Enable);
    	findViewById(R.id.Message_ET).setEnabled(Enable);
    	findViewById(R.id.Go_B).setEnabled(Enable);
	}
	
    protected void sendSMS()
    {
    	
    	Spinner cRepetitions = (Spinner) findViewById(R.id.Repetitions_S);
    	EditText cDestinataire = (EditText) findViewById(R.id.Destinataire_ET);
    	EditText cMessage = (EditText) findViewById(R.id.Message_ET);
    	ProgressBar cProgression = (ProgressBar) findViewById(R.id.Progress_PB);
	 
    	int NbRepetitions = Integer.parseInt(cRepetitions.getSelectedItem().toString());
    	String Destinataire = cDestinataire.getText().toString();  	
    	String Message = cMessage.getText().toString();
    	String Contact;
    	String Phone;
    	
    	if(Destinataire.length()==0)
    	{
    		Tip(getString(R.string.NoNumero));
    		cDestinataire.requestFocus();
    		return;
    	}
    	if(Message.length()==0)
    	{
    		Tip(getString(R.string.NoMsg));
    		cMessage.requestFocus();
    		return;
    	}


    	
    	int ChevronOuvrant=Destinataire.lastIndexOf("<");
    	int ChevronFermant=Destinataire.lastIndexOf(">");
    	if(ChevronOuvrant!=-1 && ChevronFermant!=-1 && ChevronFermant - ChevronOuvrant > 0)
    	{
    		Contact = Destinataire.substring(0,ChevronOuvrant);
    		Phone = Destinataire.substring(ChevronOuvrant+1, ChevronFermant);
    	}
    	else
    	{
    		Contact="Ano Nymous";
    		Phone=Destinataire;
    	}

    	/*try
    	{
    		Integer.parseInt(Phone);
    	}
    	catch(NumberFormatException e)
    	{
    		Tip(getString(R.string.InvNumero));
    		cDestinataire.requestFocus();
    		return;
    	}*/

    	
    	//Préparer l'interface graphique
    	
    	//Empêcher de renvoyer les données
    	EnableApplication(false);
    	
        Tip(getString(R.string.Info).replaceAll("%N",String.valueOf(NbRepetitions)).replaceAll("%C",Contact));
        
        SMSHandler Sender=new SMSHandler(this);
        
    	Sender.send(Phone, Message, NbRepetitions);
        
        Tip(getString(R.string.MefaitAccompli).replaceAll("%C",Contact));
        EnableApplication(true);
    }

    private void ListContact()
    {
    	Contacts = new ArrayList<String>();
        // instance qui permet d'acceder au contenu d'autre application
    	ContentResolver ConnectApp = this.getContentResolver();
    	Uri uri = android.provider.Contacts.People.CONTENT_URI;
        String[] projection = new String[] {People.NAME, People.NUMBER};
        //Récupérer les contacts dans un curseur
        Cursor cur = ConnectApp.query(uri, projection, null, null, null);
        this.startManagingCursor(cur);
 
        if (cur.moveToFirst())
        {
            do
            {
                String Nom = cur.getString(cur.getColumnIndex(People.NAME));
                String Numero = cur.getString(cur.getColumnIndex(People.NUMBER));
                if(Numero!=null)
                	Contacts.add(Nom+"<"+Numero+">");
            }
            while (cur.moveToNext());
         }
     }
}