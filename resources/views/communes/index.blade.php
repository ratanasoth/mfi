
@extends("layouts.parameter")
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <strong>Commune List</strong>&nbsp;&nbsp;
                    <a href="{{url('/commune/create')}}"><i class="fa fa-plus"></i> New</a>
                </div>
                <div class="card-block">
                    <table class="tbl">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Code</th>
                            <th>Name</th>
                            <th>District</th>
                            <th>Province</th>
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
                        @foreach($communes as $commune)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$commune->code}}</td>
                                <td>{{$commune->name}}</td>
                                <td>{{$commune->dname}}</td>
                                <td>{{$commune->pname}}</td>
                                <td>
                                    <a href="{{url('/commune/edit/'.$commune->id)}}" title="Edit"><i class="fa fa-edit text-success"></i></a>&nbsp;&nbsp
                                    <a href="{{url('/commune/delete/'.$commune->id ."?page=".@$_GET["page"])}}" onclick="return confirm('You want to delete?')"
                                       title="Delete"><i class="fa fa-remove text-danger"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <nav>
                        {{$communes->links()}}
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
            $("#commune").addClass("current");
        })
    </script>
@endsection