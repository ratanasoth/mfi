@extends("layouts.parameter")
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <strong>Edit Country</strong>&nbsp;&nbsp;
                    <a href="{{url('/country')}}" class="text-success"><i class="fa fa-arrow-left"></i> Back</a>

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
                    <form action="{{url('/country/update')}}" class="form-horizontal" method="post" onsubmit="return confirm('You want to save?')">
                        {{csrf_field()}}
                        <input type="hidden" name="id" value="{{$country->id}}">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="code" class="control-label col-sm-3 lb">code <span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" value="{{$country->code}}" name="code" id="code" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="control-label col-sm-3 lb">Name <span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" value="{{$country->name}}" id="name" name="name" required>
                                         <br>
                                        <p>
                                            <button class="btn btn-primary btn-flat" type="submit">Save</button>
                                            <button class="btn btn-danger btn-flat" type="button" onclick="location.reload()">Cancel</button>
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
            $("#country").addClass("current");
        });
    </script>

@endsection