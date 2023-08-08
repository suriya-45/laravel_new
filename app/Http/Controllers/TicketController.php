<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Models\Ticket;
use Illuminate\Support\Facades\Storage;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ticket = Ticket::all();
        return view("ticket.index",compact('ticket'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view("ticket.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTicketRequest $request)
    {
        $ticket = Ticket::create([
            "title"=>$request->title,
            "description"=>$request->description,
            "user_id"=>auth()->user()->id
        ]);
        $ticket = Ticket::find($ticket->id);
        if($request->file('attachment')){
           if($ticket->attachment != null){
            Storage::disk("public")->delete($ticket->attachment);
           }
           $path =  Storage::disk("public")->put("attachment",$request->file('attachment'));
           $ticket->update(['attachment'=>$path]);
        }
        return redirect(route('ticket.index'));
       
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        
    }
}
