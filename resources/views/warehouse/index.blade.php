@extends("layouts.inventory")
@section("content")
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <strong>Warehouse List</strong>&nbsp;&nbsp;
                    <a href="{{url('/warehouse/create')}}"><i class="fa fa-plus"></i> New</a>
                </div>
                <div class="card-block">
                    <table class="tbl">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
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
                            @foreach($warehouses as $warehouse)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$warehouse->name}}</td>
                                    <td>{{$warehouse->address}}</td>
                                    <td>
                                        <a href="{{url('/warehouse/edit/'.$warehouse->id)}}" title="Edit"><i class="fa fa-edit text-success"></i></a>&nbsp;&nbsp
                                        <a href="{{url('/warehouse/delete/'.$warehouse->id."?page=".@$_GET["page"])}}" onclick="return confirm('You want to delete?')"
                                           title="Delete"><i class="fa fa-remove text-danger"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <nav>
                       {{$warehouses->links()}}
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
            $("#warehouse").addClass("current");
        })
    </script>

@endsection