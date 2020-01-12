<?php

namespace App\Http\Controllers;

use App\AltaySettings;
use Illuminate\Http\Request;
use App\Http\Resources\AltaySettings as AltaySettingsResource;

class AltaySettingsController extends Controller
{
    public function index()
    {
      $altay = AltaySettings::all();

      return AltaySettingsResource::collection($altay);
    }

    public function update(Request $request)
    {
      $altay = AltaySettings::findOrFail($request->id);

      $altay->id = $request->input('id');
      $altay->name = $request->input('name');
      $altay->text = $request->input('text');
      $altay->heading = $request->input('heading');

      $altay->save();

      return $altay;
    }
}