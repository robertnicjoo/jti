<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Phone;
use Auth;

class PhonesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $phones = Phone::orderby('id', 'desc')->get();
        $providers = [
            'XL Axiata',
            'Telkomsel',
            'Indosat3/Hutchison',
            'Indosat',
            'Axis',
            'Telkom',
            'Bakrie Telecom',
            'Smartfren Telecom',
            'Ceria Mobile',
        ];
        return view('admin.phones.index', compact('phones', 'providers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $providers = [
            'XL Axiata',
            'Telkomsel',
            'Indosat3/Hutchison',
            'Indosat',
            'Axis',
            'Telkom',
            'Bakrie Telecom',
            'Smartfren Telecom',
            'Ceria Mobile',
        ];
        return view('admin.phones.create', compact('providers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function autoGenerate(Request $request)
    {
        $max = 25;
        $digits = 13;
        $number = rand(pow(10, $digits-1), pow(10, $digits)-1);
        $providers = [
            'XL Axiata',
            'Telkomsel',
            'Indosat3/Hutchison',
            'Indosat',
            'Axis',
            'Telkom',
            'Bakrie Telecom',
            'Smartfren Telecom',
            'Ceria Mobile',
        ];

        $finalData = [];
        for($i=0;$i<$max;$i++){
            $finalData[$i]['number'] = $number;
            $finalData[$i]['provider'] = $providers[array_rand($providers)];
        }

        foreach($finalData as $data){
            $phone = Phone::create([
                'user_id' => Auth::id(),
                'number' => $data['number'],
                'provider' => $data['provider'],
            ]);
        }
        
        return response()->json([
            'data' => $finalData,
            'message' => '25 Random numbers added to database!'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return response()->json($request->all());
        $phone = new Phone();
        $phone->user_id = Auth::id();
        $phone->number = $request->input('number');
        $phone->provider = $request->input('provider');
        $phone->save();
        return response()->json([
            'data' => $phone,
            'message' => 'Your number stored successfully!'
        ]);
    }

    /**
     * Update the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatenumberajax(Request $request, $id)
    {
      $phone = Phone::find($id);
      $phone = Phone::where('id',$id)->first();
      $phone->number = $request->value;
      $phone->save();
      return response()->json([
        'data' => $phone,
        'message' => 'Phone number updated successfully to <strong>'.$phone->number.'</strong>!'
    ], 200);
    }
    /**
     * Update the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateproviderajax(Request $request)
    {
        try {
            $id = $request->input('pk');
            $field = $request->input('name');
            $value = $request->input('value');

            $phone = Phone::findOrFail($id);
            $phone->{$field} = $value;
            $phone->save();
        } catch (Exception $e) {
            return response($e->getMessage(), 400);
        }
        return response()->json([
            'data' => $phone,
            'message' => 'Phone provider updated successfully to <strong>'.$phone->provider.'</strong>!'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $phone = Phone::findOrFail($id);
        $phone->delete();
        return response()->json([
            'data' => null,
            'message' => 'Data delated successfully!'
        ], 200);
    }
}
