<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kontak;

class KontakController extends Controller
{
  public function submitKontak(Request $request)
  {
    $validasiData = $request->validate([
      'username' => 'required',
      'email' => 'required',
      'subjek' => 'required',
      'pesan' => 'required',
    ]);

    $dataToSave = [
      'username' => $validasiData['username'],
      'email' => $validasiData['email'],
      'subjek' => $validasiData['subjek'],
      'pesan' => $validasiData['pesan']
    ];

    // Membuat record baru di database
    Kontak::create($dataToSave);
    return redirect('/#contact')->with('success', 'Pesan telah berhasil dikirim.');
  }
}
