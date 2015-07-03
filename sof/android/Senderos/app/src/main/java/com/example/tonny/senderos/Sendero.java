package com.example.tonny.senderos;

import android.app.Activity;
import android.content.Intent;
import android.support.v7.app.ActionBarActivity;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import java.util.ArrayList;

import android.view.ContextMenu;
import android.view.View;
import android.webkit.WebSettings;
import android.webkit.WebView;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

/**
 * Created by tonny on 07/06/2015.
 */
public class Sendero extends Activity {

    ArrayList ids;
    ArrayList items;

    Button button1;
    private EditText txtLanguage;
    private EditText txtVisitor;

    WebView myWebView;

    String point_id = "1";

    int sent = 0;

    String option = "Options";

    String tipomulti;

    String ip= "192.168.43.254";

    public String tipo;
    public String punto;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.layout_senderos);

        myWebView = (WebView) findViewById(R.id.webview);
        myWebView.getSettings().setBuiltInZoomControls(true);
        //myWebView.getSettings().setLoadsImagesAutomatically(true);
        myWebView.getSettings().setUseWideViewPort(true);
        myWebView.getSettings().setLoadWithOverviewMode(true);

        ids =  new ArrayList();
        items =  new ArrayList();

        button1 = (Button) findViewById(R.id.button1);
        txtLanguage = (EditText) findViewById(R.id.txtLanguage);
        txtVisitor = (EditText) findViewById(R.id.txtVisitor);

        //enable javascript
        WebSettings webSettings = myWebView.getSettings();
        webSettings.setJavaScriptEnabled(true);


        myWebView.addJavascriptInterface(new WebAppInterface(this), "Android");

        String trail_id=  getIntent().getStringExtra("id_sendero");
        String languaged_id= getIntent().getStringExtra("id_languaje");
        String visitor_id= getIntent().getStringExtra("id_visitante");

        myWebView.loadUrl("http://"+ip+"/movil_senderos/msenderos/?trail_id="+trail_id+"&language_id="+languaged_id+"&visitor_id="+visitor_id+"");

        button1.setOnClickListener(new Button.OnClickListener() {
            public void onClick(View v) {
                registerForContextMenu(button1);
                openContextMenu(button1);
            }
        });

    }

    public void redireccion(){

        if("text".equalsIgnoreCase(tipo)){
            Intent e=new Intent(this, Visor_Texto.class);
            e.putExtra("tipo", tipo);
            e.putExtra("id_punto", punto);
            startActivity(e);
        }else if("images".equalsIgnoreCase(tipo)){
            Intent e=new Intent(this, Imagenes.class);
            e.putExtra("tipo", tipo);
            e.putExtra("id_punto", punto);
            startActivity(e);
        }else if("video".equalsIgnoreCase(tipo)){
            Intent e=new Intent(this, Reproductor_Video.class);
            e.putExtra("tipo", tipo);
            e.putExtra("id_punto", punto);
            startActivity(e);
        }else if("sound".equalsIgnoreCase(tipo)){
            Intent e=new Intent(this, Lista_sonidos.class);
            e.putExtra("tipo", tipo);
            e.putExtra("id_punto", punto);
            startActivity(e);
        }


    }


    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_main, menu);
        return true;
    }
    @Override
    public void onCreateContextMenu(ContextMenu menu, View v,ContextMenu.ContextMenuInfo menuInfo) {
        //Context menu
        menu.setHeaderTitle(option);

        for(int i=0; i< ids.size(); i++)
        {
            menu.add(Menu.NONE, Integer.parseInt(ids.get(i).toString()), Menu.NONE, items.get(i).toString());
        }
    }

    @Override
    public boolean onContextItemSelected(MenuItem item) {
        Toast.makeText(Sendero.this, point_id, Toast.LENGTH_SHORT).show();
        punto = point_id;
        tipo = item.toString();
        myWebView.loadUrl("javascript:showPointDocuments(" + point_id + "," + txtLanguage.getText().toString() + "," + txtVisitor.getText().toString() + ")");
        //Toast.makeText(Sendero.this, item.toString(), Toast.LENGTH_SHORT).show();
        tipomulti=item.toString();
        return super.onContextItemSelected(item);
    }

}

