@extends("layouts.setting")
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <strong>Detail Staff / {{$staff->last_name}} {{$staff->first_name}}</strong>&nbsp;&nbsp;
                    <a href="{{url('/staff')}}" class="text-success"><i class="fa fa-arrow-left"></i> Back</a>
                </div>
                <div class="card-block">
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                @if($staff->photo !== 'default.png')
                                    <img src='{{asset("uploads/profiles/$staff->photo")}}' alt="profile" width="120" id="preview">
                                @else
                                    <img src='{{asset("uploads/profiles/default_profile.png")}}' alt="profile" width="120" id="preview">
                                @endif
                                <b class="text-info">{{$staff->last_name}} {{$staff->first_name}}</b> <b class="text-primary">( {{$staff->khmer_name}} ) </b>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="position" class="control-label col-sm-3 lb">Position :</label>
                                    <label for="position" class="control-label col-sm-8 lb text-primary">
                                        {{$staff->position}}
                                    </label>
                                </div>
                                <div class="form-group row">
                                    <label for="gender" class="control-label col-sm-3 lb">Gender :</label>
                                    <label for="gender" class="control-label col-sm-8 lb text-primary">
                                        {{$staff->gender}}
                                    </label>
                                </div>
                                <div class="form-group row">
                                    <label for="staff_code" class="control-label col-sm-3 lb">Staff Code :</label>
                                    <label for="staff_code" class="control-label col-sm-3 lb text-primary">
                                       {{$staff->staff_code}}
                                    </label>
                                </div>
                                <div class="form-group row">
                                    <label for="supervisor" class="control-label col-sm-3 lb">Supervisor :</label>
                                    <label for="supervisor" class="control-label col-sm-8 lb text-primary">
                                        {{$staff->s_lastname}} {{$staff->s_firstname}}
                                    </label>
                                </div>
                                <div class="form-group row">
                                    <label for="department" class="control-label col-sm-3 lb">Department :</label>
                                    <label for="supervisor" class="control-label col-sm-8 lb text-primary">
                                        {{$staff->department}}
                                    </label>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="control-label col-sm-3 lb">E-mail :</label>
                                    <label for="email" class="control-label col-sm-8 lb text-primary">
                                       {{$staff->email}}
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="address" class="control-label col-sm-3 lb">Address :</label>
                                    <label for="address" class="control-label col-sm-8 lb text-primary">
                                       {{$staff->address}}
                                    </label>
                                </div>
                                <div class="form-group row">
                                    <label for="dob" class="control-label col-sm-3 lb">Date of Birth :</label>
                                    <label for="dob" class="control-label col-sm-8 lb text-primary">
                                        {{$staff->dob}}
                                    </label>
                                </div>
                                <div class="form-group row">
                                    <label for="start_date" class="control-label col-sm-3 lb">Start Date :</label>
                                    <label for="start_date" class="control-label col-sm-8 lb text-primary">
                                       {{$staff->start_date}}
                                    </label>
                                </div>
                                <div class="form-group row">
                                    <label for="stop_date" class="control-label col-sm-3 lb">Stop Date :</label>
                                    <label for="start_date" class="control-label col-sm-8 lb text-primary">
                                        {{$staff->stop_date}}
                                    </label>
                                </div>
                                <div class="form-group row">
                                    <label for="loan_size" class="control-label col-sm-3 lb">Loan Size :</label>
                                    <label for="loan_size" class="control-label col-sm-8 lb text-primary ">
                                        {{ $staff->loan_size}}
                                    </label>
                                </div>
                                <div class="form-group row">
                                    <label for="phone" class="control-label col-sm-3 lb">Phone :</label>
                                    <label for="phone" class="control-label col-sm-8 lb text-primary">
                                        {{ $staff->phone}}
                                    </label>
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