@extends("layouts.setting")
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <strong>Edit Branch</strong>&nbsp;&nbsp;
                    <a href="{{url('/branch/create')}}"><i class="fa fa-plus"></i> New</a>
                    <a href="{{url('/branch')}}" class="text-success"><i class="fa fa-arrow-left"></i> Back</a>

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
                    <form action="{{url('/branch/update')}}" class="form-horizontal" method="post" onsubmit="return confirm('You want to save changes?')">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="code" class="control-label col-sm-3 lb">code</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" value="{{$branch->code}}" name="code" id="code">
                                        <input type="hidden" id="id" name="id" value="{{$branch->id}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="control-label col-sm-3 lb">Name <span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" value="{{$branch->name}}" id="name" name="name" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="control-label col-sm-3 lb">Email</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" value="{{$branch->email}}" id="email" name="email">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="phone" class="control-label col-sm-3 lb">Phone</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" value="{{$branch->phone}}" id="phone" name="phone">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="description" class="control-label col-sm-3 lb">Description</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" value="{{$branch->description}}" id="description" name="description">
                                        <br>
                                        <button class="btn btn-primary btn-flat" type="submit">Save Changes</button>
                                                <button class="btn btn-danger btn-flat" type="button" onclick="location.reload()">Cancel</button>
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
    <script src="{{asset("chosen/chosen.jquery.js")}}"></script>
    <script src="{{asset("chosen/chosen.proto.js")}}"></script>
    <script>
        $(document).ready(function () {
            $("#siderbar li a").removeClass("current");
            $("#branch").addClass("current");
           $("#company_id").chosen();
        })
    </script>

@endsection