@extends("layouts.setting")
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <strong>Create District</strong>&nbsp;&nbsp;
                    <a href="{{url('/staff')}}" class="text-success"><i class="fa fa-arrow-left"></i> Back</a>
                </div>
                <div class="card-block">
                    @if(Session::has('sms'))
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <div>
                                {{session('sms')}}
                            </div>
                        </div>
                    @endif
                    @if(Session::has('sms1'))
                        <div class="alert alert-danger" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <div>
                                {{session('sms1')}}
                            </div>
                        </div>
                    @endif
                    <form action="{{url('/staff/update')}}" class="form-horizontal" method="post" enctype="multipart/form-data"  onsubmit="return confirm('You want to save?')">
                        {{csrf_field()}}
                        <input type="hidden" value="{{$staff->id}}" name="id" id="id">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="first_name" class="control-label col-sm-3 lb">First Name <span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" value="{{$staff->first_name}}" name="first_name" id="first_name" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="last_name" class="control-label col-sm-3 lb">Last Name <span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" value="{{$staff->last_name}}" id="last_name" name="last_name" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="gender" class="control-label col-sm-3 lb">Gender <span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <select name="gender" id="gender" class="form-control">
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                       </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="khmer_name" class="control-label col-sm-3 lb">Khmer Name</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" value="{{$staff->khmer_name}}" id="khmer_name" name="khmer_name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staff_code" class="control-label col-sm-3 lb">Staff Code</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" value="{{$staff->staff_code}}" id="staff_code" name="staff_code">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="position" class="control-label col-sm-3 lb">Position <span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <select name="position" id="position" class="form-control">
                                            @foreach($positions as $pos)
                                                <option value="{{$pos->id}}" {{$staff->pos_id==$pos->id?'selected':''}}>{{$pos->name}}</option>
                                            @endforeach
                                       </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="supervisor" class="control-label col-sm-3 lb">Supervisor <span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <select name="supervisor" id="supervisor" class="form-control">
                                            @foreach($supervisors as $sup)
                                                <option value="{{$sup->id}}" {{$staff->sup_id==$sup->id?'selected':''}}>{{$sup->last_name}} {{$sup->first_name}}</option>
                                            @endforeach
                                       </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="department" class="control-label col-sm-3 lb">Department <span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <select name="department" id="department" class="form-control">
                                            @foreach($departments as $dep)
                                                <option value="{{$dep->id}}" {{$staff->dep_id==$dep->id?'selected':''}}>{{$dep->name}}</option>
                                            @endforeach
                                       </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="address" class="control-label col-sm-3 lb">Address</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" value="{{$staff->address}}" id="address" name="address">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="dob" class="control-label col-sm-3 lb">Date of Birth</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" value="{{$staff->dob}}" id="dob" name="dob">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="start_date" class="control-label col-sm-3 lb">Start Date</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" value="{{$staff->start_date}}" id="start_date" name="start_date">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="stop_date" class="control-label col-sm-3 lb">Stop Date</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" value="{{$staff->stop_date}}" id="stop_date" name="stop_date">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="loan_size" class="control-label col-sm-3 lb">Loan Size</label>
                                    <div class="col-sm-8">
                                        <select name="loan_size" id="loan_size" class="form-control">
                                            @foreach($loan_sizes as $loa)
                                                <option value="{{$loa->id}}"  {{$staff->loa_id==$loa->id?'selected':''}}>{{$loa->name}}</option>
                                            @endforeach
                                       </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="phone" class="control-label col-sm-3 lb">Phone</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" value="{{$staff->phone}}" id="phone" name="phone">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="control-label col-sm-3 lb">E-mail</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" value="{{$staff->email}}" id="email" name="email">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="photo" class="control-label col-sm-3 lb">Photo</label>
                                    <div class="col-sm-8">
                                        <input type="file" class="form-control" value="{{$staff->photo}}" id="photo" name="photo" onchange="loadFile(event)" accept="image/*">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 lb"></label>
                                    <div class="col-sm-8">
                                        <p style="margin-top: 9px">
                                            <button class="btn btn-primary btn-flat" type="submit">Save</button>
                                            <button class="btn btn-danger btn-flat" type="reset">Cancel</button>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="province_id" class="control-label col-sm-3 lb"></label>
                                    <div class="col-sm-8">
                                        @if($staff->photo !== 'default.png')
                                            <img src='{{asset("uploads/profiles/$staff->photo")}}' alt="profile" width="120" id="preview">
                                        @else
                                            <img src='{{asset("uploads/profiles/default_profile.png")}}' alt="profile" width="120" id="preview">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{asset("chosen/chosen.jquery.js")}}"></script>
    <script src="{{asset("chosen/chosen.proto.js")}}"></script>
    <script>
        function loadFile(e){
            var output = document.getElementById('preview');
            output.src = URL.createObjectURL(e.target.files[0]);
        }
        $(document).ready(function () {
            $("#siderbar li a").removeClass("current");
            $("#staff").addClass("current");
        });
    </script>

@endsection