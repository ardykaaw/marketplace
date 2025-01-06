<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kontak;

class KontakController extends Controller
{
  public function submitKontak(Request $request)
  {
    $validasiData = $request->validate([
      'name' => 'required',
      'email' => 'required',
      'message' => 'required',
    ]);

    $dataToSave = [
      'name' => $validasiData['name'],
      'email' => $validasiData['email'],
      'message' => $validasiData['message'],
    ];

    // Membuat record baru di database
    Kontak::create($dataToSave);
    return redirect('/#contact')->with('success', 'Pesan telah berhasil dikirim.');
  }

  public function exportToXml()
  {
    $kontaks = Kontak::all();
    $xml = new \SimpleXMLElement('<kontaks/>');

    foreach ($kontaks as $kontak) {
        $item = $xml->addChild('kontak');
        $item->addChild('id', $kontak->id);
        $item->addChild('name', $kontak->name);
        $item->addChild('email', $kontak->email);
        $item->addChild('message', $kontak->message);
        // Tambahkan field lain sesuai kebutuhan
    }

    return response($xml->asXML(), 200)
              ->header('Content-Type', 'application/xml');
  }

  public function importFromXml(Request $request)
  {
    $xml = simplexml_load_string($request->getContent());
    
    foreach ($xml->kontak as $kontakData) {
        $kontak = new Kontak();
        $kontak->name = (string) $kontakData->name;
        $kontak->email = (string) $kontakData->email;
        $kontak->message = (string) $kontakData->message;
        // Tambahkan field lain sesuai kebutuhan
        $kontak->save();
    }

    return response()->json(['success' => true], 201);
  }

  public function index()
  {
    $kontaks = Kontak::all(); // Ambil semua kontak
    return view('admin.kontak.index', compact('kontaks')); // Pastikan view ini ada
  }
}
