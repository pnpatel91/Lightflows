<?php

namespace App\Http\Controllers\API;

use App\Models\phonebooks;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class PhonebooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $input = $request->all();
        if(count($input) > 0){
            
            $phonebooks = phonebooks::query();

            //Serch Phone Book Query [Start]
            if(isset($input['firstName'])){
                $phonebooks->where('firstName', 'LIKE', "%{$input['firstName']}%");
            }
            if(isset($input['lastName'])){
                $phonebooks->where('lastName', 'LIKE', "%{$input['lastName']}%");
            }
            if(isset($input['mobileNumber'])){
                $phonebooks->where('mobileNumber', 'LIKE', "%{$input['mobileNumber']}%");
            }
            if(isset($input['phoneNumber'])){
                $phonebooks->where('phoneNumber', 'LIKE', "%{$input['phoneNumber']}%");
            }
            //Serch Phone Book Query [End]

            $data = $phonebooks->get();
        }else{
            $phonebooks = phonebooks::all();
            $data = $phonebooks->toArray();
        }


        $response = [
            'success' => true,
            'data' => $data,
            'message' => 'Phone book retrieved successfully.'
        ];

        return response()->json($response, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            $input = $request->all();
       
            $validator = Validator::make($input, [
                'firstName' => 'required|max:200|string',
                'lastName' => 'required|max:200|string',
                'email' => 'required|email',
                'mobileNumber' => 'required|min:8|max:15|unique:phonebooks',
                'phoneNumber' => 'min:8|max:15|unique:phonebooks',
            ]);

            if ($validator->fails()) {
                $response = [
                    'success' => false,
                    'data' => 'Validation Error.',
                    'message' => $validator->errors()
                ];
                return response()->json($response, 404);
            }

            $user = auth()->user()->id;
            $phonebook = new phonebooks();
            $phonebook->firstName = $input['firstName'];
            $phonebook->lastName = $input['lastName'];
            $phonebook->email = $input['email'];
            $phonebook->mobileNumber = $input['mobileNumber'];
            if(isset($input['phoneNumber'])){
                $phonebook->phoneNumber = $input['phoneNumber'];
            }
            $phonebook->created_by = $user;
            $phonebook->updated_by = $user;
            $phonebook->save();
            $data = $phonebook->toArray();

            $response = [
                'success' => true,
                'data' => $data,
                'message' => 'Phone book details stored successfully.'
            ];

            return response()->json($response, 200);

        } catch (\Exception $exception) {

            DB::rollBack();

            return response()->json([
                'error' => $exception->getMessage() . ' ' . $exception->getLine() // for status 200
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\phonebooks  $phonebook
     * @return \Illuminate\Http\Response
     */
    public function show(phonebooks $phonebook)
    {
        $data = $phonebook->toArray();

        if (is_null($phonebook)) {
            $response = [
                'success' => false,
                'data' => 'Empty',
                'message' => 'Phone book details not found.'
            ];
            return response()->json($response, 404);
        }


        $response = [
            'success' => true,
            'data' => $data,
            'message' => 'Phone book details retrieved successfully.'
        ];

        return response()->json($response, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\phonebooks  $phonebook
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, phonebooks $phonebook)
    {
        $input = $request->all();

        if (is_null($phonebook)) {
            $response = [
                'success' => false,
                'data' => 'Empty',
                'message' => 'Phone book details not found.'
            ];
            return response()->json($response, 404);
        }

        $validator = Validator::make($input, [
            'firstName' => 'required|max:200|string',
            'lastName' => 'required|max:200|string',
            'email' => 'required|email',
            'mobileNumber' => 'required|min:8|max:15|unique:phonebooks,mobileNumber,'.$phonebook->id,
            'phoneNumber' => 'min:8|max:15|unique:phonebooks,phoneNumber,'.$phonebook->id,
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'data' => 'Validation Error.',
                'message' => $validator->errors()
            ];
            return response()->json($response, 404);
        }
        $user = auth()->user()->id;
        $phonebook->firstName = $input['firstName'];
        $phonebook->lastName = $input['lastName'];
        $phonebook->email = $input['email'];
        $phonebook->mobileNumber = $input['mobileNumber'];
        if(isset($input['phoneNumber'])){
            $phonebook->phoneNumber = $input['phoneNumber'];
        }else{
            $phonebook->phoneNumber = '';
        }
        $phonebook->updated_by = $user;
        $phonebook->save();

        $data = $phonebook->toArray();

        $response = [
            'success' => true,
            'data' => $data,
            'message' => 'Phone book updated successfully.'
        ];

        return response()->json($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\phonebooks  $phonebook
     * @return \Illuminate\Http\Response
     */
    public function destroy(phonebooks $phonebook)
    {
        if (is_null($phonebook)) {
            $response = [
                'success' => false,
                'data' => 'Empty',
                'message' => 'Phone book details not found.'
            ];
            return response()->json($response, 404);
        }
        
        $phonebook->delete();

        $response = [
            'success' => true,
            'message' => 'Phone book deleted successfully.'
        ];

        return response()->json($response, 200);
    }
}
