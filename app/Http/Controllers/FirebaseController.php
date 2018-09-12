<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

class FirebaseController extends Controller
{

    public $serviceAccount;
    public $firebase;
    public $database;

    public function __construct()
    {
        // This assumes that you have placed the Firebase credentials in the same directory
// as this PHP file.
        $this->serviceAccount = ServiceAccount::fromJsonFile(config('firebase.service_account'));

        $this->firebase = (new Factory())
            ->withServiceAccount($this->serviceAccount)
            // The following line is optional if the project id in your credentials file
            // is identical to the subdomain of your Firebase project. If you need it,
            // make sure to replace the URL with the URL of your project.
            ->withDatabaseUri(config('firebase.database_uri'))
            ->create();
        $this->database = $this->firebase->getDatabase();
    }

    public function index()
    {
        $ref = $this->database->getReference('users');
        $data = $ref->getSnapshot();
        dd($data->getValue());

    }

    public function store(Request $request)
    {


        $key = $this->database->getReference('users')->push([
            'email' => 'ali@hotmail.com',
            'name' => 'Ali',
            'address' => 'gaza',
            'job' => 'programmer'
        ])->getKey();

        echo 'saved successfully with key = ' . $key;

    }


    public function update()
    {
        $userId = '-LM1npCoLcxTgszlAH8l';
        $body = [
            'title' => 'welcome to laravel course',
            'message' => 'the end'
        ];

        $updates = [
            'users/' . $userId => $body
        ];
        $this->database->getReference()->update($updates);
        echo 'updated successfully';

    }
}
