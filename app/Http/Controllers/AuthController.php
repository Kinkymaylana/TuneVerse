<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $firebaseApiKey = env('FIREBASE_API_KEY');

        $response = Http::post("https://identitytoolkit.googleapis.com/v1/accounts:signInWithPassword?key={$firebaseApiKey}", [
            'email' => $request->email,
            'password' => $request->password,
            'returnSecureToken' => true,
        ]);

        if (!$response->ok()) {
            return response()->json([
                'message' => 'Login gagal',
                'errors' => $response->json()
            ], 401);
        }

        return response()->json($response->json());
    }

    public function register(Request $request)
    {
        $firebaseApiKey = env('FIREBASE_API_KEY');

        // Validasi
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
            'username' => 'required'
        ]);

        // Panggil REST API Firebase untuk create account
        $response = Http::post("https://identitytoolkit.googleapis.com/v1/accounts:signUp?key={$firebaseApiKey}", [
            'email' => $request->email,
            'password' => $request->password,
            'returnSecureToken' => true,
        ]);

        if (!$response->ok()) {
            return response()->json([
                'message' => 'Gagal mendaftar',
                'errors' => $response->json()
            ], 400);
        }

        $data = $response->json();

        // Simpan data tambahan (username) ke Firestore jika kamu mau, atau ke DB biasa
        // Contoh simpan lokal:
        // User::create([...])

        return response()->json([
            'message' => 'Registrasi berhasil',
            'email' => $data['email'],
            'idToken' => $data['idToken'],
        ]);
    }

}