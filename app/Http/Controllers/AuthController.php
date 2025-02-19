<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        $ch = curl_init("http://epresensi.bengkuluprov.go.id:94/v1/login");

        $data = [
            "username"  => "laraveltest",
            "password"  => "tEst123##"
        ];
        $payload = json_encode($data);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        $result = curl_exec($ch);

        return response()->json(["data" => $result]);
    }

    public function getPns()
    {
        $nip = "198509272011012009";
        $ch = curl_init("http://epresensi.bengkuluprov.go.id:94/v1/test/{$nip}");

        $token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9lcHJlc2Vuc2kuYmVuZ2t1bHVwcm92LmdvLmlkOjk0XC92MVwvbG9naW4iLCJpYXQiOjE3Mzk5NDEyMjEsImV4cCI6MTczOTk0NDgyMSwibmJmIjoxNzM5OTQxMjIxLCJqdGkiOiJMM0dHckdSVlhkbnl6ckRFIiwic3ViIjoiNzcwYjY4M2UtMjI1ay00NG5tLWE1MDAtZTU2YzI2Njc4ODM0IiwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.3RVd_TJB7oW6B63UcagdTb8tUJraK_C2v8nUxWutz5s";


        $headers = ["Authorization: Bearer {$token}"];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);

        return response()->json(["data" => $result]);
    }
}
