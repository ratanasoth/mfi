@extends("layouts.parameter")
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <strong>Zone List</strong>&nbsp;&nbsp;
                    <a href="{{url('/zone/create')}}"><i class="fa fa-plus"></i> New</a>
                </div>
                <div class="card-block">
                    <table class="tbl">
                        <thead>
                        <tr>
                            <th>&numero;</th>
                            <th>Area Name</th>
                            <th>Interest Rate</th>
                            <th>Client Limit</th>
                            <th>Contact Name</th>
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
                        @foreach($zones as $zon)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$zon->area_name}}</td>
                                <td>{{$zon->interest_rate}}</td>
                                <td>{{$zon->client_limit}}</td>
                                <td>{{$zon->contact_name}}</td>
                                <td>
                                    <a href="{{url('/zone/edit/'.$zon->id)}}" title="Edit"><i class="fa fa-edit text-success"></i></a>&nbsp;&nbsp
                                    <a href="{{url('/zone/delete/'.$zon->id ."?page=".@$_GET["page"])}}" onclick="return confirm('You want to delete?')"
                                       title="Delete"><i class="fa fa-remove text-danger"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <nav>
                        {{$zones->links()}}
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
            $("#zone").addClass("current");
        })
    </script>
@endsection