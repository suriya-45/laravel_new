{{-- @dd($ticket->isEmpty()) --}}
<x-app-layout>
    <section class="mt-5">
      @if (session('msg'))
    <div class="alert alert-success">
        {{ session('msg') }}
    </div>
     @endif
      <div class="card" style="margin: 1%;">
        <div class="card-body table-responsive">
         
          <a href="{{ route('ticket.create')}}"><button class="btn btn-primary" style="margin-left: 91%; margin-bottom: 1%;">Create
     
      </button></a>
         <table class="table table-bordered" style="border-collapse:collapse;">
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Attachment</th>
                <th>Action</th>
            </tr>
            @if(!($ticket->isEmpty()))
          
            @foreach ($ticket as $item)
            <tr>
              <td>{{ $item->title }}</td>
              <td>{{ $item->description }}</td>
              @if($item->attachment != "")
                  <td><a href="{{ asset('storage/' . $item->attachment) }}" download="" target="_blank"><i class="bi bi-arrow-down-circle"></i></a></td>
              @else
                  <td></td>
              @endif
              <td>
                {{-- <a href="{{ route('ticket.view',$item->id)}}"> <i class="bi bi-eye""></i></a> &nbsp;  --}}
                <a href="{{route('ticket.edit',$item->id)}}"> <i class="bi bi-pencil""></i></a> &nbsp; 
                <a href="{{route('ticket.destroy',$item->id)}}"> <i class="bi bi-trash3""></i></a> 
             </td>
          </tr>
               
          @endforeach
          @else
         
          <tr>
            <td colspan="4" style="text-align: center; font-weight: bold;">No tickets available</td>
          </tr>
          @endif
         </table>

        </div>
      </div>
 </section>
</x-app-layout>
<style>
  .bi{
    color: blue;
  }
  .table th{
    background-color: lightcyan;
  }
  tr:nth-child(odd){
    background-color:lightgrey;
  }
</style>