package com.example.tonny.senderos;

/**
 * Created by tonny on 29/06/2015.
 */
import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.io.UnsupportedEncodingException;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;
import java.util.ArrayList;
import java.util.Arrays;

import android.app.ProgressDialog;
import android.content.Context;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.content.res.TypedArray;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.support.v7.app.ActionBarActivity;
import android.view.View;
import android.widget.AdapterView;
import android.widget.AdapterView.OnItemClickListener;
import android.widget.ArrayAdapter;
import android.widget.GridView;
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

public class Imagenes extends ActionBarActivity {
    public GridView gridView;
    public GridViewAdapter gridAdapter;
    public ArrayList<Bitmap> bit_imagenes = new ArrayList<Bitmap>();
    public ArrayList<String>    lista_imagenes = new ArrayList<String>();
    String ip= "192.168.43.254";



    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.layout_imagenes);

        gridView = (GridView) findViewById(R.id.gridView);

        //Toast.makeText(Imagenes.this, "hola mundo", Toast.LENGTH_SHORT).show();

        DescargarImagenes task1 = new DescargarImagenes();
        task1.execute("http://"+ip+"/movil_senderos/get_images.php");
        //Toast.makeText(Imagenes.this, "Datos Cargados..."+task1.imagenes.size()+"  hol  "+task1.lst_img.size(), Toast.LENGTH_SHORT).show();


        gridView.setOnItemClickListener(new OnItemClickListener() {
            public void onItemClick(AdapterView<?> parent, View v, int position, long id) {

                ImageItem item = (ImageItem) parent.getItemAtPosition(position);

                Toast.makeText(Imagenes.this, "posicion: " + position, Toast.LENGTH_SHORT).show();
                //Create intent
                Intent intent = new Intent(Imagenes.this, DetailsActivity.class);
                intent.putExtra("title", item.getTitle());
                intent.putExtra("image", item.getImage());
                //Start details activity
                startActivity(intent);
            }
        });
    }

    /**
     * Prepare some dummy data for gridview
     */







    private class DescargarImagenes extends AsyncTask<String, Void, Boolean> {

        ProgressDialog dialog=new ProgressDialog(Imagenes.this);
        String text="";
        public ArrayList<Bitmap> imagenes = new ArrayList<Bitmap>();
        public ArrayList<String>    lst_img = new ArrayList<String>();


        protected void onPreExecute(){
            dialog.setMessage("Cargando Datos...");
            dialog.show();
        }

        protected  Boolean doInBackground(String... url){

            InputStream is1;
            for(String url1 : url){
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
                    Toast.makeText(Imagenes.this, e.toString(), Toast.LENGTH_SHORT).show();
                    return false;
                }catch(IOException e){
                    Toast.makeText(Imagenes.this, e.toString(), Toast.LENGTH_SHORT).show();
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
                    lst_img.clear();
                    for(int i=0;i<jArray.length();i++){
                        JSONObject jsonDatos=jArray.getJSONObject(i);
                        lst_img.add(jsonDatos.getString("route"));
                    }

                }catch(JSONException e){
                    e.printStackTrace();
                }



                for(int i=0;i<lst_img.size();i++) {
                    try {

                        URL imageURL = new URL("http://"+ip+"/senderos/app/webroot/images/"+lst_img.get(i));
                        HttpURLConnection conn = (HttpURLConnection) imageURL.openConnection();
                        conn.connect();

                        imagenes.add(BitmapFactory.decodeStream(conn.getInputStream()));

                    } catch (MalformedURLException e) {
                        e.printStackTrace();

                    } catch (IOException e) {
                        e.printStackTrace();

                    }
                }
            }
            return true;
        }

        public ArrayList<ImageItem> getData() {
            final ArrayList<ImageItem> imageItems = new ArrayList<>();
            //TypedArray imgs = getResources().obtainTypedArray(R..image_ids);
            for (int i = 0; i < imagenes.size(); i++) {
                //Bitmap bitmap = BitmapFactory.decodeResource(getResources(), imgs.getResourceId(i, -1));
                imageItems.add(new ImageItem(imagenes.get(i), "Image#" + i));
            }
            return imageItems;
        }

        protected  void onPostExecute(Boolean result){

            if(result){
                Toast.makeText(Imagenes.this, "#"+imagenes.size()+" Imagenes Cargadas...", Toast.LENGTH_SHORT).show();

                //getData();
                gridAdapter = new GridViewAdapter(Imagenes.this, R.layout.grid_item_layout, getData());
                gridView.setAdapter(gridAdapter);



            }else{
                Toast.makeText(Imagenes.this, "Error...", Toast.LENGTH_SHORT).show();
            }
            dialog.dismiss();
        }
    }

}




