@extends("layouts.parameter")
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <strong>Create Zone</strong>&nbsp;&nbsp;
                    <a href="{{url('/zone')}}" class="text-success"><i class="fa fa-arrow-left"></i> Back</a>
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
                    <form action="{{url('/zone/save')}}" class="form-horizontal" method="post" onsubmit="return confirm('You want to save?')">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="area_name" class="control-label col-sm-4 lb">Area Name <span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" value="{{old('area_name')}}" id="area_name" name="area_name" required>
                                    </div>
                                    <label for="interest_rate" class="control-label col-sm-4 lb">Interest Rate <span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="number" step="0.1" class="form-control" value="0" id="interest_rate" name="interest_rate" required>
                                    </div>
                                    <label for="client_limit" class="control-label col-sm-4 lb">Client Limit<span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="number" step="0.1" class="form-control" value="0" id="client_limit" name="client_limit" required>
                                    </div>
                                    <label for="contact_name" class="control-label col-sm-4 lb">Contact Name<span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" value="{{old('contact_name')}}" id="contact_name" name="contact_name" required>
                                         <br>
                                        <p>
                                            <button class="btn btn-primary btn-flat" type="submit">Save</button>
                                            <button class="btn btn-danger btn-flat" type="reset">Cancel</button>
                                        </p>
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
    <script>
        $(document).ready(function () {
            $("#siderbar li a").removeClass("current");
            $("#zone").addClass("current");
        });
    </script>
@endsection