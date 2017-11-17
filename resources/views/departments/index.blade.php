
@extends("layouts.parameter")
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <strong>Department List</strong>&nbsp;&nbsp;
                    <a href="{{url('/department/create')}}"><i class="fa fa-plus"></i> New</a>
                </div>
                <div class="card-block">
                    <table class="tbl">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Code</th>
                            <th>Name</th>
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
                        @foreach($departments as $department)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$department->code}}</td>
                                <td>{{$department->name}}</td>
                                <td>
                                    <a href="{{url('/department/edit/'.$department->id)}}" title="Edit"><i class="fa fa-edit text-success"></i></a>&nbsp;&nbsp
                                    <a href="{{url('/department/delete/'.$department->id ."?page=".@$_GET["page"])}}" onclick="return confirm('You want to delete?')"
                                       title="Delete"><i class="fa fa-remove text-danger"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <nav>
                        {{$departments->links()}}
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
            $("#department").addClass("current");
        })
    </script>
@endsection