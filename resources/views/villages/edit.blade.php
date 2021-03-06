@extends("layouts.parameter")
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <strong>Edit Village</strong>&nbsp;&nbsp;
                    <a href="{{url('/village')}}" class="text-success"><i class="fa fa-arrow-left"></i> Back</a>

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
                    <form action="{{url('/village/update')}}" class="form-horizontal" method="post" onsubmit="return confirm('You want to save?')">
                        {{csrf_field()}}
                        <input type="hidden" value="{{$village->id}}" name="id">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="province_id" class="control-label col-sm-3 lb">Province <span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                       <select name="province_id" id="province_id" class="form-control">
                                        @foreach($provinces as $pro)
                                            <option value="{{$pro->id}}" {{$village->province_id==$pro->id?'selected':''}}>{{$pro->name}}</option>
                                        @endforeach
                                       </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="district_id" class="control-label col-sm-3 lb">District <span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                       <select name="district_id" id="district_id" class="form-control">
                                       @foreach($districts as $d)
                                            <option value="{{$d->id}}" {{$d->id==$village->district_id?'selected':''}}>{{$d->name}}</option>
                                       @endforeach
                                       </select>
                                      
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="commune_id" class="control-label col-sm-3 lb">Commune <span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                       <select name="commune_id" id="commune_id" class="form-control">
                                       @foreach($communes as $com)
                                            <option value="{{$com->id}}" {{$com->id==$village->commune_id?'selected':''}}>{{$com->name}}</option>
                                       @endforeach
                                       </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="code" class="control-label col-sm-3 lb">code <span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" value="{{$village->code}}" name="code" id="code" required>
                                    </div>
                                </div>
                               
                                <div class="form-group row">
                                    <label for="name" class="control-label col-sm-3 lb">Name <span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" value="{{$village->name}}" id="name" name="name" required>
                                         <p style="margin-top: 9px">
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
    <script src="{{asset("chosen/chosen.jquery.js")}}"></script>
    <script src="{{asset("chosen/chosen.proto.js")}}"></script>
    <script>
        var burl = "{{url('/')}}";
        $(document).ready(function () {
            $("#siderbar li a").removeClass("current");
            $("#menu_village").addClass("current");
            $("#province_id").chosen();
            $("#province_id").change(function(){
                bindDistrict();
            });
            $("#district_id").change(function(){
                bindCommune();
            });
        });
        function bindDistrict()
        {
             $.ajax({
                type: "GET",
                url: burl + "/district/get/" + $("#province_id").val(),
                success: function(sms)
                {
                    var opt ="";
                    for(var i=0;i<sms.length;i++)
                    {
                        opt +="<option value='" +sms[i].id + "'>" + sms[i].name + "</option>";
                    }
                    $("#district_id").html(opt);
                    //$("#district_id").chosen();
                    bindCommune();
                }
            });
        }

        function bindCommune()
        {
             $.ajax({
                type: "GET",
                url: burl + "/commune/get/"+ $("#district_id").val(),
                success: function(sms)
                {
                    var opt ="";
                    for(var i=0;i<sms.length;i++)
                    {
                        opt +="<option value='" +sms[i].id + "'>" + sms[i].name + "</option>";
                    }
                    $("#commune_id").html(opt);
                    //$("#commune_id").chosen();
                }
            });
        }
    </script>

@endsection