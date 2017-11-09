@extends("layouts.setting")
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <strong>Company Detail</strong>&nbsp;&nbsp;
                    <a href="{{url('/company/create')}}"><i class="fa fa-plus"></i> New</a>
                    <a href="{{url('/company/edit/'.$company->id)}}" class="text-danger"><i class="fa fa-pencil"></i> Edit</a>
                    <a href="{{url('/company')}}" class="text-success"><i class="fa fa-arrow-left"></i> Back</a>

                </div>
                <div class="card-block">
                   <div class="row">
                       <div class="col-sm-6">
                           <div class="form-group row">
                               <label for="name" class="control-label col-sm-3 lb">ID</label>
                               <div class="col-sm-8">
                                   <input type="text" class="form-control" value="{{$company->id}}" readonly>
                               </div>
                           </div>
                           <div class="form-group row">
                               <label for="name" class="control-label col-sm-3 lb">code</label>
                               <div class="col-sm-8">
                                   <input type="text" class="form-control" value="{{$company->code}}" readonly>
                               </div>
                           </div>
                           <div class="form-group row">
                               <label for="name" class="control-label col-sm-3 lb">Name</label>
                               <div class="col-sm-8">
                                   <input type="text" class="form-control" value="{{$company->name}}" readonly>
                               </div>
                           </div>
                           <div class="form-group row">
                               <label for="name" class="control-label col-sm-3 lb">Email</label>
                               <div class="col-sm-8">
                                   <input type="text" class="form-control" value="{{$company->email}}" readonly>
                               </div>
                           </div>
                           <div class="form-group row">
                               <label for="name" class="control-label col-sm-3 lb">Phone</label>
                               <div class="col-sm-8">
                                   <input type="text" class="form-control" value="{{$company->phone}}" readonly>
                               </div>
                           </div>
                           <div class="form-group row">
                               <label for="name" class="control-label col-sm-3 lb">Address</label>
                               <div class="col-sm-8">
                                   <input type="text" class="form-control" value="{{$company->address}}" readonly>
                               </div>
                           </div>
                           <div class="form-group row">
                               <label for="name" class="control-label col-sm-3 lb">Tax Code</label>
                               <div class="col-sm-8">
                                   <input type="text" class="form-control" value="{{$company->tax_no}}" readonly>
                               </div>
                           </div>
                           <div class="form-group row">
                               <label for="name" class="control-label col-sm-3 lb">Description</label>
                               <div class="col-sm-8">
                                   <input type="text" class="form-control" value="{{$company->description}}" readonly>
                               </div>
                           </div>
                       </div>
                       <div class="col-sm-6">
                           <div class="form-group row">
                               <img src="{{asset("uploads/companies/".$company->logo)}}" alt="Logo">
                           </div>
                       </div>
                       </div>
                   </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        function loadFile(e){
            var output = document.getElementById('preview');
            output.src = URL.createObjectURL(e.target.files[0]);
        }
        $(document).ready(function () {
            $("#siderbar li a").removeClass("current");
            $("#company").addClass("current");
        })
    </script>

@endsection