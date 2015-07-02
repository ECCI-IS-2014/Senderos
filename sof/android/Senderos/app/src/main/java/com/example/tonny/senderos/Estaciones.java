package com.example.tonny.senderos;

import android.app.Activity;
import android.app.ProgressDialog;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.AsyncTask;
import android.support.v7.app.ActionBar;
import android.support.v7.app.ActionBarActivity;
import android.os.Bundle;
import android.view.ContextMenu;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.ListView;
import android.widget.Spinner;
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
 * Created by tonny on 03/06/2015.
 */
public class Estaciones extends Activity{


    ListView lista;
    ArrayList<String> lst_estaciones, lst_id_estaciones;
    public ArrayList<String> lst_senderos=new ArrayList<String>();
    public ArrayList<String> lst_id_senderos=new ArrayList<String>();
    public ArrayList<String> alst_senderos=new ArrayList<String>();
    public ArrayList<String> alst_id_senderos=new ArrayList<String>();


    String option = "Lista de Senderos";
    ArrayList  items;
    String id_est;
    String estacion;
    String ip= "192.168.43.254";


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.layout_estaciones);

        /*lst_senderos =  new ArrayList();
        lst_id_senderos =  new ArrayList();*/
        items=new ArrayList();
        ReadEstaciones task1 = new ReadEstaciones();
        task1.execute("http://"+ip+"/movil_senderos/get_stations.php");

        lista=(ListView) findViewById(R.id.list_Estaciones);

        lista.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {

                estacion = lst_estaciones.get(position);
                id_est = lst_id_estaciones.get(position);
                //String m= ""+id_est;
                //Toast.makeText(Estaciones.this, m, Toast.LENGTH_SHORT).show();
                //irestaciones(view, id_est, estacion);
                Llenar_lista_Senderos llenarTrails = new Llenar_lista_Senderos();
                llenarTrails.execute("http://"+ip+"/movil_senderos/get_trails.php");

                //ArrayList<String> lst=new ArrayList<String>();
               // Toast.makeText(Estaciones.this, lst_senderos.get(0), Toast.LENGTH_SHORT).show();

            }
        });
       /* lista.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                irestaciones(v);
            }
        });*/

       /* btn1.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                registerForContextMenu(btn1);
                openContextMenu(btn1);
                Toast.makeText(Estaciones.this, "hola", Toast.LENGTH_SHORT).show();
            }
        });*/
    }

    public void ejecutarhilo(){


    }

    public void irestacioness(View view, String id, String nombre){

        Intent e = new Intent(this, Lista_Senderos.class);
        e.putExtra("id_est", id);
        e.putExtra("nombre_est", nombre);
        e.putExtra("id_visitante", getIntent().getStringExtra("id_visitante"));
        e.putExtra("id_languaje", getIntent().getStringExtra("id_languaje"));
        startActivity(e);

    }

    public void irestaciones(View view, String id, String nombre){

        Intent e = new Intent(this, Sendero.class);
        e.putExtra("id_sendero", id);
        e.putExtra("nombre_sendero", nombre);
        e.putExtra("id_visitante", getIntent().getStringExtra("id_visitante"));
        e.putExtra("id_languaje", getIntent().getStringExtra("id_languaje"));
        startActivity(e);

    }




    public void cargarlstVisitantes(ArrayList<String> datos){
        ArrayAdapter<String> adaptador=
                new ArrayAdapter<String>(this, android.R.layout.simple_list_item_1, datos);
        lista= (ListView) findViewById(R.id.list_Estaciones);
        lista.setAdapter(adaptador);
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
        menu.clear();
        menu.setHeaderTitle(option);
       // menu.add(Menu.NONE, 1, Menu.NONE, "Menu1");

        for(int i=0; i< lst_senderos.size(); i++)
        {
            //menu.add(lst_senderos.get(i).toString());
            menu.add(Menu.NONE, Integer.parseInt(lst_id_senderos.get(i).toString()), Menu.NONE, lst_senderos.get(i).toString());
            //menu.add(Menu.NONE, 1, Menu.NONE, "Menu1");
        }
    }


    @Override
    public boolean onContextItemSelected(MenuItem item) {

        //myWebView.loadUrl("javascript:showPointDocuments(" + point_id + "," + txtLanguage.getText().toString() + "," + txtVisitor.getText().toString() + ")");


        int id = item.getItemId();

        //noinspection SimplifiableIfStatement
        for (int i=0; i<lst_id_senderos.size();i++){
            if (id == Integer.parseInt(lst_id_senderos.get(i))) {
                irestaciones(lista, lst_id_senderos.get(i), lst_senderos.get(i));
                Toast.makeText(Estaciones.this, "hola mundo"+id, Toast.LENGTH_SHORT).show();
                return true;
            }
        }


        return super.onContextItemSelected(item);
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



    private class ReadEstaciones extends AsyncTask<String, Void, Boolean>{


        ProgressDialog dialog=new ProgressDialog(Estaciones.this);
        String text="";
        protected void onPreExecute(){
            dialog.setMessage("Cargando lista...");
            dialog.show();
        }

        protected  Boolean doInBackground(String... url){

            InputStream is1;
            for(String url1 : url){
                try{
                    HttpClient cliente=new DefaultHttpClient();
                    HttpPost post=new HttpPost(url1);
                    HttpResponse response= cliente.execute(post);
                    is1=response.getEntity().getContent();

                }catch(ClientProtocolException e){
                    Toast.makeText(Estaciones.this, e.toString(), Toast.LENGTH_SHORT).show();
                    return false;
                }catch(IOException e){
                    Toast.makeText(Estaciones.this, e.toString(), Toast.LENGTH_SHORT).show();
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

                lst_estaciones = new ArrayList<String>();
                lst_id_estaciones = new ArrayList<String>();
                try{
                    JSONArray jArray = new JSONArray(text);
                    for(int i=0;i<jArray.length();i++){
                        JSONObject jsonDatos=jArray.getJSONObject(i);
                            lst_id_estaciones.add(jsonDatos.getString("id"));
                            lst_estaciones.add(jsonDatos.getString("nombre"));
                    }

                }catch(JSONException e){
                    e.printStackTrace();
                }

            }
            return true;
        }

        protected  void onPostExecute(Boolean result){

            if(result){
                Toast.makeText(Estaciones.this, "Datos Cargados..."+text, Toast.LENGTH_SHORT).show();

                ArrayAdapter adapter=new ArrayAdapter(Estaciones.this, android.R.layout.simple_list_item_1, lst_estaciones);
                lista.setAdapter(adapter);

            }else{
                Toast.makeText(Estaciones.this, "Error...", Toast.LENGTH_SHORT).show();
            }
            dialog.dismiss();
        }
    }






    public class Llenar_lista_Senderos extends AsyncTask<String, Void, Boolean> {

        ProgressDialog dialog=new ProgressDialog(Estaciones.this);
        String text="";
        protected void onPreExecute(){
            dialog.setMessage("Cargando Datos...");
            dialog.show();
        }

        protected  Boolean doInBackground(String... url){

            InputStream is1;
            for(String url1 : url){
                try{
                    ArrayList<NameValuePair> pairs=new ArrayList<NameValuePair>();
                    pairs.add(new BasicNameValuePair("id_estacion", id_est));

                    HttpClient cliente=new DefaultHttpClient();
                    HttpPost post=new HttpPost(url1);
                    post.setEntity(new UrlEncodedFormEntity(pairs));
                    HttpResponse response= cliente.execute(post);
                    is1=response.getEntity().getContent();

                }catch(ClientProtocolException e){
                    Toast.makeText(Estaciones.this, e.toString(), Toast.LENGTH_SHORT).show();
                    return false;
                }catch(IOException e){
                    Toast.makeText(Estaciones.this, e.toString(), Toast.LENGTH_SHORT).show();
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

                try{
                    JSONArray jArray = new JSONArray(text);
                    lst_id_senderos.clear();
                    lst_senderos.clear();
                    for(int i=0;i<jArray.length();i++){
                        JSONObject jsonDatos=jArray.getJSONObject(i);
                        lst_id_senderos.add(jsonDatos.getString("id_sendero"));
                        lst_senderos.add(jsonDatos.getString("nombre_sendero"));
                    }

                }catch(JSONException e){
                    e.printStackTrace();
                }

            }
            return true;
        }

        protected  void onPostExecute(Boolean result){

            if(result){
                Toast.makeText(Estaciones.this, "Datos Cargados..."+lst_senderos.get(0), Toast.LENGTH_SHORT).show();
                registerForContextMenu(lista);
                openContextMenu(lista);

            }else{
                Toast.makeText(Estaciones.this, "Error...", Toast.LENGTH_SHORT).show();
            }
            dialog.dismiss();
        }
    }

}
