@extends("layouts.purchase")
@section("content")
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <strong>Supplier List</strong>&nbsp;&nbsp;
                    <a href="{{url('/supplier/create')}}"><i class="fa fa-plus"></i> New</a>
                </div>
                <div class="card-block">
                    <table class="tbl">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
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
                            @foreach($suppliers as $supplier)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$supplier->name}}</td>
                                    <td>{{$supplier->phone}}</td>
                                    <td>{{$supplier->email}}</td>
                                    <td>{{$supplier->address}}</td>
                                    <td>
                                        <a href="{{url('/supplier/edit/'.$supplier->id)}}" title="Edit"><i class="fa fa-edit text-success"></i></a>&nbsp;&nbsp
                                        <a href="{{url('/supplier/delete/'.$supplier->id."?page=".@$_GET["page"])}}" onclick="return confirm('You want to delete?')"
                                           title="Delete"><i class="fa fa-remove text-danger"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <nav>
                       {{$suppliers->links()}}
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
            $("#supplier").addClass("current");
        })
    </script>

@endsection