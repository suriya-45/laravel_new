@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Property</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Property</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-6  stretch-card">
<div class="card">
  <div class="card-body">

                    <h6 class="card-title">Add Property</h6>

                    <form class="forms-sample" action="{{route('admin.storeproperty')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" id="name" autocomplete="off" placeholder="name">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Icon</label>
                            <input type="text" name="icon" class="form-control" id="icon" placeholder="icon">
                        </div>
                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                    </form>

  </div>
</div>
        </div>
        

</div>
@endsection