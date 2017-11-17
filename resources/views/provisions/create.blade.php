@extends("layouts.parameter")
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <strong>Create Provision</strong>&nbsp;&nbsp;
                    <a href="{{url('/provision')}}" class="text-success"><i class="fa fa-arrow-left"></i> Back</a>

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
                    <form action="{{url('/provision/save')}}" class="form-horizontal" method="post" onsubmit="return confirm('You want to save?')">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="description" class="control-label col-sm-4 lb">Description <span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" value="{{old('description')}}" name="description" id="description" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="length_of_day" class="control-label col-sm-4 lb">Length of Day <span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="number" step="1" min="0" class="form-control" value="{{old('length_of_day')}}" 
                                         id="length_of_day" name="length_of_day" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="term" class="control-label col-sm-4 lb">Term  <span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" value="{{old('term')}}" id="term" name="term" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="provision_percentage" class="control-label col-sm-4 lb">Percentage  <span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="number" min="0" step=".001" class="form-control" 
                                        value="{{old('provision_percentage')}}" id="provision_percentage" name="provision_percentage" required>
                                         <br>
                                        <p>
                                            <button class="btn btn-primary btn-flat" type="submit">Save</button>
                                            <button class="btn btn-danger btn-flat" type="reset">Cancel</button>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                               
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
            $("#provision").addClass("current");
        });
    </script>

@endsection