package com.example.tonny.senderos;

import android.app.Activity;
import android.app.ProgressDialog;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.net.Uri;
import android.os.AsyncTask;
import android.os.Bundle;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.ImageButton;
import android.widget.MediaController;
import android.widget.Spinner;
import android.widget.Toast;
import android.widget.VideoView;

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
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URI;
import java.net.URL;
import java.util.ArrayList;

/**
 * Created by tonny on 28/06/2015.
 */
public class Reproductor_Video extends Activity {

    VideoView reproductor;
    ImageButton play;
    Spinner lista_videos;
    ArrayList<String> lst_video = new ArrayList<String>();
    ArrayList<String> lst_nombre_video = new ArrayList<String>();

    String ip= "192.168.43.254";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.layout_video);

        Toast.makeText(Reproductor_Video.this, getIntent().getStringExtra("tipo_multi"), Toast.LENGTH_SHORT).show();

        reproductor = (VideoView)findViewById(R.id.reproductorVideo1);
        play= (ImageButton)findViewById(R.id.play1);
        lista_videos = (Spinner) findViewById(R.id.lst_videos1);

        DescargarVideos task1 = new DescargarVideos();
        task1.execute("http://"+ip+"/movil_senderos/get_video.php");

        reproductor.setMediaController(new MediaController(this));
        play.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                if(!"".equalsIgnoreCase(lista_videos.getSelectedItem().toString())) {

                    String archivo_video = lst_video.get(lista_videos.getSelectedItemPosition());
                    Toast.makeText(Reproductor_Video.this, archivo_video, Toast.LENGTH_SHORT).show();
                    reproductor.setVideoURI(Uri.parse("http://"+ip+"/senderos/app/webroot/video/"+archivo_video));
                    reproductor.start();
                    reproductor.requestFocus();

                }


            }
        });
    }



    public void cargarlstVisitantes(ArrayList<String> datos){
        ArrayAdapter<String> adaptador=
                new ArrayAdapter<String>(this, android.R.layout.simple_list_item_1, datos);
        //lista_reproduccion= (ListView) findViewById(R.id.list_Estaciones);
        lista_videos.setAdapter(adaptador);
    }





    private class DescargarVideos extends AsyncTask<String, Void, Boolean> {



        ProgressDialog dialog = new ProgressDialog(Reproductor_Video.this);
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
                    Toast.makeText(Reproductor_Video.this, e.toString(), Toast.LENGTH_SHORT).show();
                    return false;
                }catch(IOException e){
                    Toast.makeText(Reproductor_Video.this, e.toString(), Toast.LENGTH_SHORT).show();
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
                    lst_video.clear();
                    lst_nombre_video.clear();
                    for(int i=0;i<jArray.length();i++){
                        JSONObject jsonDatos=jArray.getJSONObject(i);
                        lst_nombre_video.add(jsonDatos.getString("name"));
                        lst_video.add(jsonDatos.getString("route"));
                    }

                }catch(JSONException e){
                    e.printStackTrace();
                }

            }
            return true;
        }

        protected void onPostExecute(Boolean result) {

            if (result) {
                Toast.makeText(Reproductor_Video.this, "Datos Cargados..." + text, Toast.LENGTH_SHORT).show();
                cargarlstVisitantes(lst_nombre_video);

            } else {
                Toast.makeText(Reproductor_Video.this, "Error...", Toast.LENGTH_SHORT).show();
            }
            dialog.dismiss();
        }
    }
}
