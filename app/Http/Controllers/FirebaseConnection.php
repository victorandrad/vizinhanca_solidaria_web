<?php


namespace App\Http\Controllers;


use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

trait FirebaseConnection
{

    public function firebase()
    {
        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__ . '/google-services.json');

        $firebase = (new Factory)
            ->withServiceAccount($serviceAccount)
            ->withDatabaseUri('https://vizinhanca-solidaria-c8c37.firebaseio.com/')
            ->create();

        return $firebase;
    }

}
