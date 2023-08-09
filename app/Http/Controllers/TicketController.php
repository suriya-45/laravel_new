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
        $ticket = Ticket::where("user_id",auth()->user()->id)->get();
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
        $ticket = Ticket::updateOrCreate(
            [
            "title"=>$request->title,
            "user_id"=>auth()->user()->id
            ],
            [         
             "description"=>$request->description,
            ]
    );
        $ticket = Ticket::find($ticket->id);
        if($request->file('attachment')){
           if($ticket->attachment != null){
            Storage::disk("public")->delete($ticket->attachment);
           }
           $path =  Storage::disk("public")->put("attachment",$request->file('attachment'));
           $ticket->update(['attachment'=>$path]);
        }
        return redirect(route('ticket.index'))->with("msg","successfully created!");
       
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
    public function edit(Ticket $id)
    {
        return view('ticket.edit',['ticket'=>$id]);
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
        if($ticket->delete())
        {
            return redirect(route('ticket.index'))->with("msg","Ticket Deleetd successfully");
        }
        else
        {
            return redirect(route('ticket.index'))->with("msg","Ticket Deleetd failed");

        }
    }

    public function view()
    {
       return view("ticket.view");
    }

}
