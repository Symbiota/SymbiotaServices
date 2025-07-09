<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function index(){
        $customers = Customer::all();
        return view('customer-management', compact('customers'));
    }

    public function create(Request $request){
        $validator = Validator::make($request->all(), [
                'customer-name'=>['required', 'unique:customers,name'],
                'customer-DARBI-number'=>['required', 'numeric']
        ]);
        if($validator->fails()){
            $view = $this->updateFragment('customer-management', 'customer-form')->withErrors($validator);
            return response($view)
                ->header('HX-Trigger', json_encode([
                'customer-created' => ['message'=>'Customer creation failed!']
            ]));
            // return $this
            // ->updateFragment('customer-management', 'customer-form')
            // ->withErrors($validator)
            // ->withHeaders([
            //     'HX-Trigger' => json_encode([
            //         'customer-created' => ['message' => 'Customer creation failed!']
            //     ])
            // ]);
        }
        // request()->validate([
        //     'customer-name'=>['required', 'unique:customers,name'],
        //     'customer-DARBI-number'=>['required', 'numeric']
        // ]);
        try{

            Customer::create([
                'name'=>request('customer-name'),
                'darbi_account'=>request('customer-DARBI-number')
            ]);
            return response(
                $this->updateFragment('customer-management', 'customer-list'))->header('HX-Trigger', json_encode([
                    'customer-created' => ['message'=>'Customer ' . request('customer-name') . ' successfully created!']
            ]));
        } catch(\Exception $error){
            // return response(
            //     $this->updateFragment('customer-management', 'customer-list'))->header('HX-Trigger', json_encode([
            //         'customer-created' => ['message'=>'Customer creation failed!']
            // ]));
            return response(
                $this->updateFragment('customer-management'))->header('HX-Trigger', json_encode([
                    'customer-created' => ['message'=>'Something has gone wrong. Please contact the site administrators.']
            ]));
        }
        // return $this->updateFragment('customer-management', 'customer-list');
    }

    public function destroy($id){
        $targetCustomer = Customer::find($id);
        $targetCustomer->delete();
        return $this->updateFragment('customer-management', 'customer-list');
    }

    private function updateFragment($viewName, $fragmentName = null){
        $customers = Customer::all();
        if($fragmentName){
            return view($viewName, compact('customers'))
                ->fragment($fragmentName);
        }else{
            return view($viewName, compact('customers'));
        }
    }

}
