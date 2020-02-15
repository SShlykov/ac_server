<?php

namespace App\Http\Controllers;

use App\Notices;
use Illuminate\Http\Request;

class NoticesController extends Controller
{

    public function index()
    {
        \Log::info('222');
        return [1 => 2];
    }

    public function addItem(Request $request)
    {
        $notice = new Notices;
        $notice->client_name = $request->input('client_name');
        $notice->client_mail = $request->input('client_mail');
        $notice->client_phone = $request->input('client_phone');
        $notice->client_address = $request->input('client_address');
        $notice->transfer_date = $request->input('transfer_date');
        $notice->transfer_time = $request->input('transfer_time');
        $notice->transfer_price = $request->input('transfer_price');
        $notice->transfer_route = $request->input('transfer_route');
        $notice->driver_name = $request->input('driver_name');
        $notice->driver_id = $request->input('driver_id');
        $notice->status = $request->input('status');
        $notice->save();
        return $request;
    }

    public function updateItem(Request $request)
    {
        $notice = Notices::findOrFail($request->id);
        $notice->client_name = $request->input('client_name');
        $notice->client_mail = $request->input('client_mail');
        $notice->client_phone = $request->input('client_phone');
        $notice->client_address = $request->input('client_address');
        $notice->transfer_date = $request->input('transfer_date');
        $notice->transfer_time = $request->input('transfer_time');
        $notice->transfer_price = $request->input('transfer_price');
        $notice->transfer_route = $request->input('transfer_route');
        $notice->driver_name = $request->input('driver_name');
        $notice->driver_id = $request->input('driver_id');
        $notice->status = $request->input('status');
        $notice->save();
        return $request;
    }

    public function deleteItem(Request $request)
    {
        $notice = Notices::findOrFail($request->id);
        $notice->delete();
        return $request;
    }

    public function getAll()
    {
        $notice = Notices::all();
        return $notice;
    }
}
