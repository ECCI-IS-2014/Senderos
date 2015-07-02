package com.example.tonny.senderos;

import android.app.Activity;
import android.app.ProgressDialog;
import android.os.AsyncTask;
import android.os.Bundle;
import android.view.View;
import android.webkit.WebSettings;
import android.webkit.WebView;
import android.widget.ArrayAdapter;
import android.widget.ImageButton;
import android.widget.Spinner;
import android.widget.TextView;
import android.widget.Toast;

import org.apache.http.HttpResponse;
import org.apache.http.NameValuePair;
import org.apache.http.client.ClientProtocolException;
import org.apache.http.client.HttpClient;
import org.apache.http.client.entity.UrlEncodedFormEntity;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.message.BasicNameValuePair;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.io.UnsupportedEncodingException;
import java.util.ArrayList;

/**
 * Created by tonny on 30/06/2015.
 */
public class Visor_Texto extends Activity {


    WebView webview;
    Spinner lista_texto;
    ImageButton btn_ver_texto;
    ArrayList<String> lst_texto = new ArrayList<String>();
    ArrayList<String> lst_nombre_texto = new ArrayList<String>();
    String ip= "192.168.43.254";


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.layout_visor_texto);

        webview = (WebView) findViewById(R.id.webView_texto);
        webview.getSettings().setBuiltInZoomControls(true);
        //myWebView.getSettings().setLoadsImagesAutomatically(true);
        webview.getSettings().setUseWideViewPort(true);
        webview.getSettings().setLoadWithOverviewMode(true);

        //webview.loadData("<html><head></head><body>Hola mundo</body></html>", "text / html", "utf-8");

        lista_texto = (Spinner) findViewById(R.id.lista_textos);
        btn_ver_texto = (ImageButton) findViewById(R.id.img_button_ver);
        DescargarTextos task1 = new DescargarTextos();
        task1.execute("http://"+ip+"/movil_senderos/get_texto.php");

        btn_ver_texto.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                String htmltext = lst_texto.get(lista_texto.getSelectedItemPosition());
                Toast.makeText(Visor_Texto.this, htmltext, Toast.LENGTH_SHORT).show();

                webview.loadUrl("http://"+ip+"/movil_senderos/visor_texto.php/?texto=" + htmltext + "");
                WebSettings webSettings = webview.getSettings();
                webSettings.setJavaScriptEnabled(true);
            }
        });


    }

    public void cargarlstVisitantes(ArrayList<String> datos){
        ArrayAdapter<String> adaptador=
                new ArrayAdapter<String>(this, android.R.layout.simple_list_item_1, datos);
        //lista_reproduccion= (ListView) findViewById(R.id.list_Estaciones);
        lista_texto.setAdapter(adaptador);
    }



    private class DescargarTextos extends AsyncTask<String, Void, Boolean> {



        ProgressDialog dialog = new ProgressDialog(Visor_Texto.this);
        String text = "";

        protected void onPreExecute() {
            dialog.setMessage("Cargando lista...");
            dialog.show();
        }

        protected Boolean doInBackground(String... url) {

            InputStream is1;
            for (String url1 : url) {
                try{
                    ArrayList<NameValuePair> pairs=new ArrayList<NameValuePair>();
                    pairs.add(new BasicNameValuePair("tipo", getIntent().getStringExtra("tipo")));
                    pairs.add(new BasicNameValuePair("id_punto", getIntent().getStringExtra("id_punto")));

                    HttpClient cliente=new DefaultHttpClient();
                    HttpPost post=new HttpPost(url1);
                    post.setEntity(new UrlEncodedFormEntity(pairs));
                    HttpResponse response= cliente.execute(post);
                    is1=response.getEntity().getContent();

                }catch(ClientProtocolException e){
                    Toast.makeText(Visor_Texto.this, e.toString(), Toast.LENGTH_SHORT).show();
                    return false;
                }catch(IOException e){
                    Toast.makeText(Visor_Texto.this, e.toString(), Toast.LENGTH_SHORT).show();
                    return false;
                }


                BufferedReader reader;
                try{
                    String line=null;
                    reader = new BufferedReader(new InputStreamReader(is1, "iso-8859-1"), 8);
                    while((line =reader.readLine()) != null){
                        text+=line+"\n";
                    }
                    is1.close();
                }catch(UnsupportedEncodingException e){
                    e.printStackTrace();
                }catch(IOException e){
                    e.printStackTrace();
                }

                /*lst_senderos = new ArrayList<String>();
                lst_id_senderos = new ArrayList<String>();*/
                //lst_img=new ArrayList<String>();

                try{
                    JSONArray jArray = new JSONArray(text);
                    lst_texto.clear();
                    lst_nombre_texto.clear();
                    for(int i=0;i<jArray.length();i++){
                        JSONObject jsonDatos=jArray.getJSONObject(i);
                        lst_nombre_texto.add(jsonDatos.getString("name"));
                        lst_texto.add(jsonDatos.getString("htmltext"));
                    }

                }catch(JSONException e){
                    e.printStackTrace();
                }

            }
            return true;
        }

        protected void onPostExecute(Boolean result) {

            if (result) {
                Toast.makeText(Visor_Texto.this, "Datos Cargados..." + text, Toast.LENGTH_SHORT).show();
                cargarlstVisitantes(lst_nombre_texto);

            } else {
                Toast.makeText(Visor_Texto.this, "Error...", Toast.LENGTH_SHORT).show();
            }
            dialog.dismiss();
        }
    }
}