<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Config;
use Illuminate\Support\Facades\File;
use DB;

class ConfigController extends Controller
{
    public function index()
    {
        $config = Config::first();
        return view('admin.config.index', \compact('config'));
    }

    public function update(Request $request)
    {
        $currency = explode(' ',trim($request->input('currency')));
        $currency_simbol = ucwords($currency[1]);

        $config = Config::first();
        if($request->hasFile('logo'))
        {
            $path = 'assets/uploads/logos/'.$config->logo;
            if(File::exists($path))
            {
                File::delete($path);
            }
            $file = $request->file('logo');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('assets/uploads/logos',$filename);
            $config->logo = $filename;
        }
        $config->currency = $request->input('currency');
        $config->currency_simbol = $currency_simbol;
        $config->tax_status = $request->input('tax_status') == TRUE ? '1':'0';
        $config->tax = $request->input('tax');
        $config->paypal = $request->input('paypal') == TRUE ? '1':'0';
        $config->dbt = $request->input('dbt') == TRUE ? '1':'0';
        $config->shipping_description = $request->input('shipping_description');
        $config->update();

        $request->session()->flash('alert-success', 'Settings updated correctly.');

        return view('admin.config.index', \compact('config'));
    }
}
