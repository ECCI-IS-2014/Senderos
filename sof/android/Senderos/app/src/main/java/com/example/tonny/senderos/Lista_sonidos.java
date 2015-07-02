package com.example.tonny.senderos;

import android.app.Activity;
import android.app.ProgressDialog;
import android.graphics.Bitmap;
import android.media.MediaPlayer;
import android.os.AsyncTask;
import android.os.Bundle;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Button;
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
 * Created by tonny on 30/06/2015.
 */
public class Lista_sonidos extends Activity {

    MediaPlayer reproductor;
    ListView lista_reproduccion;
    //Button boton;
    ArrayList<String> lst_sonido=new ArrayList<String>();
    ArrayList<String> lst_nombre_sonido=new ArrayList<String>();
    String route;
    String nombre;
    int cont=0;
    MediaPlayer mediaPlayer;
    String ip= "192.168.43.254";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.layout_sonidos);


        lista_reproduccion = (ListView) findViewById(R.id.lista_sonidos);
        //boton = (Button)findViewById(R.id.button);


        Toast.makeText(Lista_sonidos.this, "Hola mundo", Toast.LENGTH_SHORT).show();
        DescargarSonidos task1 = new DescargarSonidos();
        task1.execute("http://"+ip+"/movil_senderos/get_sounds.php");
        mediaPlayer = new MediaPlayer();



        /*boton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {


            }
        });*/


        lista_reproduccion.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {


                route = lst_sonido.get(position);
                nombre = lst_nombre_sonido.get(position);

                if(mediaPlayer.isPlaying()){
                    mediaPlayer.pause();
                }else{


                    try {
                        mediaPlayer.stop();
                        mediaPlayer = new MediaPlayer();
                        mediaPlayer.setDataSource("http://"+ip+"/senderos/app/webroot/sound/" + route);
                        mediaPlayer.prepare();
                        mediaPlayer.start();


                    } catch (IllegalArgumentException e) {
                        // TODO Auto-generated catch block
                        e.printStackTrace();
                    } catch (SecurityException e) {
                        // TODO Auto-generated catch block
                        e.printStackTrace();
                    } catch (IllegalStateException e) {
                        // TODO Auto-generated catch block
                        e.printStackTrace();
                    } catch (IOException e) {
                        // TODO Auto-generated catch block
                        e.printStackTrace();
                    }
                }




                }





        });
    }


    public void cargarlstVisitantes(ArrayList<String> datos){
        ArrayAdapter<String> adaptador=
                new ArrayAdapter<String>(this, android.R.layout.simple_list_item_1, datos);
        //lista_reproduccion= (ListView) findViewById(R.id.list_Estaciones);
        lista_reproduccion.setAdapter(adaptador);
    }


    private class DescargarSonidos extends AsyncTask<String, Void, Boolean> {



        ProgressDialog dialog = new ProgressDialog(Lista_sonidos.this);
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
                    Toast.makeText(Lista_sonidos.this, e.toString(), Toast.LENGTH_SHORT).show();
                    return false;
                }catch(IOException e){
                    Toast.makeText(Lista_sonidos.this, e.toString(), Toast.LENGTH_SHORT).show();
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
                    lst_sonido.clear();
                    lst_nombre_sonido.clear();
                    for(int i=0;i<jArray.length();i++){
                        JSONObject jsonDatos=jArray.getJSONObject(i);
                        lst_nombre_sonido.add(jsonDatos.getString("name"));
                        lst_sonido.add(jsonDatos.getString("route"));
                    }

                }catch(JSONException e){
                    e.printStackTrace();
                }

            }
            return true;
        }

        protected void onPostExecute(Boolean result) {

            if (result) {
                Toast.makeText(Lista_sonidos.this, "Datos Cargados..." + text, Toast.LENGTH_SHORT).show();
                cargarlstVisitantes(lst_nombre_sonido);

            } else {
                Toast.makeText(Lista_sonidos.this, "Error...", Toast.LENGTH_SHORT).show();
            }
            dialog.dismiss();
        }
    }
}
