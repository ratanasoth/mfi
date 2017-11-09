@extends("layouts.setting")
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <strong>Branch List</strong>&nbsp;&nbsp;
                    <a href="{{url('/branch/create')}}"><i class="fa fa-plus"></i> New</a>
                </div>
                <div class="card-block">
                    <table class="tbl">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Code</th>
                            <th>Branch Name</th>
                            <th>Email Address</th>
                            <th>Phone Number</th>
                            <th>Description</th>
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
                        @foreach($branches as $branch)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$branch->code}}</td>
                                <td>{{$branch->name}}</td>
                                <td>{{$branch->email}}</td>
                                <td>{{$branch->phone}}</td>
                                <td>{{$branch->description}}</td>
                                <td>
                                    <a href="{{url('/branch/edit/'.$branch->id)}}" title="Edit"><i class="fa fa-edit text-success"></i></a>&nbsp;&nbsp
                                    <a href="{{url('/branch/delete/'.$branch->id ."?page=".@$_GET["page"])}}" onclick="return confirm('You want to delete?')"
                                       title="Delete"><i class="fa fa-remove text-danger"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <nav>
                        {{$branches->links()}}
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
            $("#branch").addClass("current");
        })
    </script>
@endsection