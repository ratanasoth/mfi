
@extends("layouts.setting")
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <strong>Staff List</strong>&nbsp;&nbsp;
                    <a href="{{url('/staff/create')}}"><i class="fa fa-plus"></i> New</a>
                </div>
                <div class="card-block">
                    <table class="tbl">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Khmer Name</th>
                            <th>Gender</th>
                            <th>Position</th>
                            <th>Department</th>
                            <th>Phone</th>
                            <th>Email</th>
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
                        @foreach($staffs as $sta)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$sta->first_name}}</td>
                                <td>{{$sta->last_name}}</td>
                                <td>{{$sta->khmer_name}}</td>
                                <td>{{$sta->gender}}</td>
                                <td>{{$sta->position_id}}</td>
                                <td>{{$sta->department_id}}</td>
                                <td>{{$sta->phone}}</td>
                                <td>{{$sta->email}}</td>
                                <td>
                                <a href="{{url('/staff/detail/'.$sta->id)}}" title="Detail"><i class="fa fa-info-circle text-info"></i></a>&nbsp;&nbsp
                                    <a href="{{url('/staff/edit/'.$sta->id)}}" title="Edit"><i class="fa fa-edit text-success"></i></a>&nbsp;&nbsp
                                    <a href="{{url('/staff/delete/'.$sta->id ."?page=".@$_GET["page"])}}" onclick="return confirm('You want to delete?')"
                                       title="Delete"><i class="fa fa-remove text-danger"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <nav>
                        {{$staffs->links()}}
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
            $("#staff").addClass("current");
        })
    </script>
@endsection