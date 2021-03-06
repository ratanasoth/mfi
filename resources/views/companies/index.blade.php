@extends("layouts.setting")
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <strong>Company List</strong>&nbsp;&nbsp;
                    <a href="{{url('/company/create')}}"><i class="fa fa-plus"></i> New</a>
                </div>
                <div class="card-block">
                    <table class="tbl">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Code</th>
                            <th>Company Name</th>
                            <th>Email Address</th>
                            <th>Phone Number</th>
                            <th>Address</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            $pagex = @$_GET['page'];
                            if(!$pagex)
                                $pagex = 1;
                            $i = 12 * ($pagex - 1) + 1;
                        ?>
                        @foreach($companies as $company)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$company->code}}</td>
                                <td>
                                    <a href="{{url('/company/detail/'.$company->id)}}">{{$company->name}}</a>
                                </td>
                                <td>{{$company->email}}</td>
                                <td>{{$company->phone}}</td>
                                <td>{{$company->address}}</td>
                                <td>
                                    <a href="{{url('/company/edit/'.$company->id)}}" title="Edit"><i class="fa fa-edit text-success"></i></a>&nbsp;&nbsp
                                    <a href="{{url('/company/delete/'.$company->id ."?page=".@$_GET["page"])}}" onclick="return confirm('You want to delete?')"
                                       title="Delete"><i class="fa fa-remove text-danger"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <nav>
                        {{$companies->links()}}
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $("#siderbar li a").removeClass("current");
            $("#company").addClass("current");
        })
    </script>
@endsection