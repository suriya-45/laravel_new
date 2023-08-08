<x-app-layout>
    <section class="mt-5">
      <div class="card">
        <div class="card-body">
         
       
         <table class="table">
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Attachment</th>
            </tr>
            @foreach ($ticket as $item)
            <tr>
              <td>{{ $item->title }}</td>
              <td>{{ $item->description }}</td>
              @if($item->attachment != "")
                  <td><a href="{{ asset('storage/' . $item->attachment) }}"></a></td>
              @else
                  <td></td>
              @endif
          </tr>
               
          @endforeach
            
         </table>

        </div>
      </div>
 </section>
</x-app-layout>
