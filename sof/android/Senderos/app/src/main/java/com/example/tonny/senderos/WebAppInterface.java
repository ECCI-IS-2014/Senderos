package com.example.tonny.senderos;

/**
 * Created by tonny on 09/06/2015.
 */
import java.util.ArrayList;

import android.content.Context;
import android.content.Intent;
import android.util.Log;
import android.webkit.JavascriptInterface;
import android.widget.Button;
import android.widget.Toast;

public class WebAppInterface {

    Context mContext;

    /** Instantiate the interface and set the context */
    WebAppInterface(Context c) {
        mContext = c;
    }

    /** Show a toast from the web page */
    @JavascriptInterface
    public void showToast(String toast) {
        Toast.makeText(mContext, "1: "+toast, Toast.LENGTH_SHORT).show();
    }

    @JavascriptInterface
    public void showPointOptions(String options) {
        String []opts = options.split(";thisisaseparator;");

        ((Sendero)mContext).point_id = opts[0];

        ((Sendero)mContext).option = "Options";

        ((Sendero)mContext).ids.clear();
        ((Sendero)mContext).items.clear();

        for(int i=1; i < opts.length -1; i++) //
        {
            ((Sendero)mContext).ids.add(i);
            ((Sendero)mContext).items.add(opts[i]);
        }

        ((Sendero)mContext).runOnUiThread( new Runnable() {
            public void run() {
                ((Sendero)mContext).button1.performClick();
            }
        });
    }

    @JavascriptInterface
    public void showPointDocuments(String documents) {
        String []opts = documents.split(";thisisaseparator;");

        ((Sendero)mContext).option = "Documents";

        ((Sendero)mContext).ids.clear();
        ((Sendero)mContext).items.clear();

        for(int i=0; i < opts.length -1; i++) //
        {
            ((Sendero)mContext).ids.add(i);
            ((Sendero)mContext).items.add(opts[i]);
        }

        ((Sendero)mContext).sent = 1;

        ((Sendero)mContext).runOnUiThread( new Runnable() {
            public void run() {
                //((MainActivity)mContext).button1.performClick();
                //aqui en vez de llamar al boton debe de redireccionar
                Toast.makeText(mContext, "Redireccionar ", Toast.LENGTH_SHORT).show();
                ((Sendero)mContext).redireccion();


            }
        });
    }

}
