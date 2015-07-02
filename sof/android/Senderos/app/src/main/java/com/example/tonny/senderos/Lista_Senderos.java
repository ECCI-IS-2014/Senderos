package com.example.tonny.senderos;

import android.app.Activity;
import android.app.ProgressDialog;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.ListView;
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
 * Created by tonny on 08/06/2015.
 */
public class Lista_Senderos extends Activity {



    ListView lista;
    ArrayList<String> lst_senderos, lst_id_senderos;
    String ip= "192.168.43.254";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.layout_lista_senderos);

        Read_Trails task1 = new Read_Trails();
        task1.execute("http://"+ip+"/movil_senderos/get_trails.php");

        lista=(ListView) findViewById(R.id.lst_senderos);
        lista.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {

                String sendero = lst_senderos.get(position);
                String id_est = lst_id_senderos.get(position);
                //String m= ""+id_est;
                //Toast.makeText(Estaciones.this, m, Toast.LENGTH_SHORT).show();
                irestaciones(view, id_est, sendero);
            }
        });
       /* lista.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                irestaciones(v);
            }
        });*/
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


    private class Read_Trails extends AsyncTask<String, Void, Boolean> {


        ProgressDialog dialog=new ProgressDialog(Lista_Senderos.this);
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
                    pairs.add(new BasicNameValuePair("id_estacion", getIntent().getStringExtra("id_est")));

                    HttpClient cliente=new DefaultHttpClient();
                    HttpPost post=new HttpPost(url1);
                    post.setEntity(new UrlEncodedFormEntity(pairs));
                    HttpResponse response= cliente.execute(post);
                    is1=response.getEntity().getContent();

                }catch(ClientProtocolException e){
                    Toast.makeText(Lista_Senderos.this, e.toString(), Toast.LENGTH_SHORT).show();
                    return false;
                }catch(IOException e){
                    Toast.makeText(Lista_Senderos.this, e.toString(), Toast.LENGTH_SHORT).show();
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

                lst_senderos = new ArrayList<String>();
                lst_id_senderos = new ArrayList<String>();
                try{
                    JSONArray jArray = new JSONArray(text);
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
                Toast.makeText(Lista_Senderos.this, "Datos Cargados...", Toast.LENGTH_SHORT).show();

                ArrayAdapter adapter=new ArrayAdapter(Lista_Senderos.this, android.R.layout.simple_list_item_1, lst_senderos);
                lista.setAdapter(adapter);

            }else{
                Toast.makeText(Lista_Senderos.this, "Error...", Toast.LENGTH_SHORT).show();
            }
            dialog.dismiss();
        }
    }

}
