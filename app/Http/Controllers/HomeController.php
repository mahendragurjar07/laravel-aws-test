<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index(Request $request){

    	echo "<h1>Welcome"."</h1>";

    	echo "Database username: ".config('database.connections.mysql.username')."<br>";
    	echo "Database password: ".config('database.connections.mysql.password').'<br>';
    	echo "STRIPE_KEY: ".config('stripe.key').'<br>';
    	echo "STRIPE_SECRET: ".config('stripe.secret').'<br>';
    	echo "MAIL_USERNAME: ".config('mail.username').'<br>';
    	echo "MAIL_PASSWORD: ".config('mail.password').'<br>';
    }
}
