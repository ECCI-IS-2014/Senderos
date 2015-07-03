package com.example.tonny.senderos;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.AsyncTask;
import android.support.v7.app.ActionBarActivity;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.Spinner;
import android.widget.TextView;
import android.widget.Toast;

import org.apache.http.HttpEntity;
import org.apache.http.HttpResponse;
import org.apache.http.client.ClientProtocolException;
import org.apache.http.client.HttpClient;
import org.apache.http.client.methods.HttpGet;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.protocol.BasicHttpContext;
import org.apache.http.protocol.HttpContext;
import org.apache.http.util.EntityUtils;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.io.UnsupportedEncodingException;
import java.util.ArrayList;


public class MainActivity extends ActionBarActivity {

    Button ingresar;
    TextView campo;
    Spinner lista_visit, lista_idiomas;
    ArrayList<String> lst_V, lst_I, lst_id_V, lst_id_I;
    String id_visi, id_idiom="";
    String ip= "192.168.43.254";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        ingresar = (Button) findViewById(R.id.btn_Ingresar);
        lista_visit = (Spinner) findViewById(R.id.lst_Visitante);
        lista_idiomas = (Spinner) findViewById(R.id.lst_idiomas);

        ReadData task1 = new ReadData();
        task1.execute("http://"+ip+"/movil_senderos/get_visitor.php");
        
        lista_visit.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {
            @Override
            public void onItemSelected(AdapterView<?> parent, View view, int position, long id) {

                id_visi = lst_id_V.get(position);
            }

            @Override
            public void onNothingSelected(AdapterView<?> parent) {

            }
        });

        lista_idiomas.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {
            @Override
            public void onItemSelected(AdapterView<?> parent, View view, int position, long id) {

                id_idiom = lst_id_I.get(position);

            }

            @Override
            public void onNothingSelected(AdapterView<?> parent) {

            }
        });

        ingresar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                irestacion(v, id_visi, id_idiom);
            }
        });
    }

    public void irestacion(View view, String idv, String idI){
        Intent i=new Intent(this, Estaciones.class);
        i.putExtra("id_visitante", idv);
        i.putExtra("id_languaje", idI);
        startActivity(i);
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_main, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        // Handle action bar item clicks here. The action bar will
        // automatically handle clicks on the Home/Up button, so long
        // as you specify a parent activity in AndroidManifest.xml.
        int id = item.getItemId();

        //noinspection SimplifiableIfStatement
        if (id == R.id.action_settings) {
            return true;
        }

        return super.onOptionsItemSelected(item);
    }


    private class ReadData extends AsyncTask<String, Void, Boolean>{


        ProgressDialog dialog=new ProgressDialog(MainActivity.this);
        String text="";
        String text1="";
        protected void onPreExecute(){
            dialog.setMessage("Obteniendo datos...");
            dialog.show();
        }

        protected  Boolean doInBackground(String... url){

            InputStream is1;
            InputStream is2;
            for(String url1 : url){

                //Obtenemos los visitantes...
                try{
                    HttpClient cliente=new DefaultHttpClient();
                    HttpPost post=new HttpPost(url1);
                    HttpResponse response= cliente.execute(post);
                    is1=response.getEntity().getContent();

                }catch(ClientProtocolException e){
                    Toast.makeText(MainActivity.this, e.toString(), Toast.LENGTH_SHORT).show();
                    return false;
                }catch(IOException e){
                    Toast.makeText(MainActivity.this, e.toString(), Toast.LENGTH_SHORT).show();
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


                lst_V = new ArrayList<String>();
                lst_id_V = new ArrayList<String>();
                try{
                    JSONArray jArray = new JSONArray(text);
                    for(int i=0;i<jArray.length();i++){
                        JSONObject jsonDatos=jArray.getJSONObject(i);

                                lst_V.add(jsonDatos.getString("role"));
                                lst_id_V.add(jsonDatos.getString("id"));
                                //Toast.makeText(MainActivity.this, lst_V.get(0), Toast.LENGTH_SHORT).show();
                    }

                }catch(JSONException e){
                    e.printStackTrace();
                }




                //Obtenemos los idiomas...

                try{
                    HttpClient cliente1=new DefaultHttpClient();
                    HttpPost post1=new HttpPost("http://"+ip+"/movil_senderos/get_languages.php");
                    HttpResponse response1= cliente1.execute(post1);
                    is2=response1.getEntity().getContent();

                }catch(ClientProtocolException e){
                    Toast.makeText(MainActivity.this, e.toString(), Toast.LENGTH_SHORT).show();
                    return false;
                }catch(IOException e){
                    Toast.makeText(MainActivity.this, e.toString(), Toast.LENGTH_SHORT).show();
                    return false;
                }


                BufferedReader reader1;
                try{
                    String line1=null;
                    reader1 = new BufferedReader(new InputStreamReader(is2, "iso-8859-1"), 8);
                    while((line1 =reader1.readLine()) != null){
                        text1+=line1+"\n";
                    }
                    is2.close();

                }catch(UnsupportedEncodingException e){
                    e.printStackTrace();
                }catch(IOException e){
                    e.printStackTrace();
                }

                lst_I = new ArrayList<String>();
                lst_id_I = new ArrayList<String>();

                try{
                    JSONArray jArray1 = new JSONArray(text1);
                    lst_id_I.clear();
                    lst_I.clear();
                    for(int i=0;i<jArray1.length();i++){
                        JSONObject jsonDatos1=jArray1.getJSONObject(i);

                        lst_I.add(jsonDatos1.getString("name"));
                        lst_id_I.add(jsonDatos1.getString("id"));
                        //Toast.makeText(MainActivity.this, lst_V.get(0), Toast.LENGTH_SHORT).show();
                    }

                }catch(JSONException e){
                    e.printStackTrace();
                }




            }
            return true;
        }

        protected  void onPostExecute(Boolean result){

            if(result){
                Toast.makeText(MainActivity.this, "Datos Cargados...", Toast.LENGTH_SHORT).show();

                ArrayAdapter adapter=new ArrayAdapter(MainActivity.this, android.R.layout.simple_spinner_item, lst_V);
                lista_visit.setAdapter(adapter);
                ArrayAdapter adapter1= new ArrayAdapter(MainActivity.this, android.R.layout.simple_spinner_item, lst_I);
                lista_idiomas.setAdapter(adapter1);
            }else{
                Toast.makeText(MainActivity.this, "Error...", Toast.LENGTH_SHORT).show();
            }
            dialog.dismiss();
        }
    }
}
