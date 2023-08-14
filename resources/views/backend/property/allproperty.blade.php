@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Tables</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data Table</li>
        </ol>
    </nav>
    <div style="margin-bottom: 1%;">
        
        <a href="{{route('admin.addproperty')}}"><button class="btn btn-success">Add Property</button></a> 

    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
<div class="card">
  <div class="card-body">
    <h6 class="card-title">Property</h6>
    <p class="text-muted mb-3">Read the <a href="https://datatables.net/" target="_blank"> Official DataTables Documentation </a>for a full list of instructions and other options.</p>
    <div class="table-responsive">
      <table id="dataTableExample" class="table">
        <thead>
          <tr>
            <th>S.No</th>
            <th>Name</th>
            <th>icon</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
         @if(!$all_property->isempty())   
         @foreach($all_property as $key => $data)   
          <tr>
            <td>{{$key+1}}</td>
            <td>{{ $data->name}}</td>
            <td>{{ $data->icon}}</td>
            <td>
                <div style="display: flex;">
             <a href="{{route('edit.property',['id'=>$data->id])}}" class="btn btn-warning">Edit</a>&nbsp;&nbsp;
             <form id="delete-form" action="{{ route('delete.property',['id'=>$data->id]) }}" method="get">
                @csrf
                <button type="submit" id="delete-button"  class="btn btn-danger">Delete</button>
            </form>
           </div>
            </td>
          </tr>
        @endforeach
        @else
        <tr>
           <td colspan="4" style="color: white;"><center>No Result Found</center></td>
        </tr>    
        @endif
        </tbody>
      </table>
     
    </div>
    
  </div>
</div>
        </div>
    </div>

    <div>
        {{ $all_property->links() }} <!-- Render pagination links -->

      </div>

</div>

<script>
    document.getElementById('delete-button').addEventListener('click', function () {
        Swal.fire({
            title: 'Confirm Delete',
            text: 'Are you sure you want to delete this property?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Delete',
            cancelButtonText: 'Cancel',
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form').submit();
            }
        });
    });
</script>





@endsection