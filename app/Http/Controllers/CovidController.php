<?php

namespace App\Http\Controllers;

use App\Models\pasien;
use Illuminate\Http\Request;

class CovidController extends Controller
{
    
public function index()
    {
        $pasien= pasien::all();
        $total = count($pasien);

        if ($total) {
            $data = [
                'message' => 'Get All Resource',
                'total pasien' => $total,
                'data pasien' => $pasien
            ];
            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Data is empty',
                'total pasien' => $total
            ];
            return response()->json($data, 200);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|max:45',
            'phone' => 'required|numeric',
            'address' => 'required',
            'status' => 'required|max:10',
            'in_date_at' => 'required',
            'out_date_at' => 'nullable'
        ]);

        $pasien = pasien::create($validate);

        $data = [
            'message' => 'Resource is added successfully',
            'data' => $pasien
        ];

        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pasien  $pasien
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pasien= pasien::find($id);

        if ($pasien) {
            $data = [
                'message' => 'Get Detail Resource',
                'data' => $pasien
            ];

            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Resource not found'
            ];

            return response()->json($data, 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\pasien  $pasien
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pasien= pasien::find($id);

        if ($pasien) {
            $pasien->update($request->all());
            $data = [
                'message' => 'Resource is update successfully',
                'data' => $pasien
            ];

            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Resource not found'
            ];

            return response()->json($data, 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pasien  $pasien
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pasien= pasien::find($id);

        if ($pasien) {
            $pasien->delete();
            $data = [
                'message' => 'Resource is delete successfully'
            ];

            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Resource not found'
            ];

            return response()->json($data, 404);
        }
    }

    /**
     * Method (GET) Search Resource by name.
     *
     * @return \Illuminate\Http\Response
     */
    public function search($name)
    {
        $pasien= pasien::where('name', 'like', '%' . $name . '%')->get();

        $total = count($pasien);

        if ($total) {
            $data = [
                'message' => 'Get searched resource',
                'total' => $total,
                'data' => $pasien
            ];

            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Resource not found'
            ];

            return response()->json($data, 404);
        }
    }

    public function positive()
    {
        $pasien= pasien::where('status', 'positive')->get();
        $total = count($pasien);

        if ($total) {
            $data = [
                'message' => 'Get positive resource',
                'total pasien' => $total,
                'data pasien' => $pasien
            ];
            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Data is empty',
                'total pasien' => $total
            ];
            return response()->json($data, 200);
        }
    }

    public function  recovered()
    {
        $pasien= pasien::where('status', 'recovered')->get();
        $total = count($pasien);

        if ($total) {
            $data = [
                'message' => 'Get recovered resource',
                'total pasien' => $total,
                'data pasien' => $pasien
            ];
            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Data is empty',
                'total pasien' => $total
            ];
            return response()->json($data, 200);
        }
    }

    public function dead()
    {
        $pasien= pasien::where('status', 'dead')->get();
        $total = count($pasien);

        if ($total) {
            $data = [
                'message' => 'Get dead resource',
                'total pasien' => $total,
                'data pasien' => $pasien
            ];
            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Data is empty',
                'total pasien' => $total
            ];
            return response()->json($data, 200);
        }
    }
}