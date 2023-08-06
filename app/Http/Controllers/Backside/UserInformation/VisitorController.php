<?php

namespace App\Http\Controllers\Backside\UserInformation;

use App\Http\Controllers\Controller;
use App\Models\Guest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class VisitorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $visitors = DB::table('guests')
            ->select(DB::raw('count(ip_address) as guest_total_visit'))
            ->addSelect(
                'guests.id as guest_id',
                'guests.uuid as guest_uuid',
                'guests.ip_address as guest_ip',
                'guests.created_at as guest_created_at'
            )->groupBy('guest_id', 'guest_uuid', 'guest_ip', 'guest_created_at')->get();

        // dd($visitors);

        return view('backside.page.user-information.visitors.index', compact('visitors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $process = app('CreateVisitor')->execute([
            'uuid' => Str::uuid(),
            'ip_address' => request()->getClientIp(),
        ]);

        return $process;
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $uuid
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        $guest = Guest::where('uuid', $uuid)->first();
        $guest['total_visit'] = Guest::where('ip_address', $guest->ip_address)->count();

        return view('backside.page.user-information.visitors.detail', compact('guest'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $uuid
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        //
    }

    /**
     * Display a listing of the trashed resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash()
    {
        return view('backside.page.user-information.visitors.trash');
    }
}
