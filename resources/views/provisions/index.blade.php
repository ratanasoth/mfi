
@extends("layouts.parameter")
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <strong>Provision List</strong>&nbsp;&nbsp;
                    <a href="{{url('/provision/create')}}"><i class="fa fa-plus"></i> New</a>
                </div>
                <div class="card-block">
                    <table class="tbl">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Description</th>
                            <th>Length of Day</th>
                            <th>Term</th>
                            <th>Percentage</th>
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
                        @foreach($provisions as $provision)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$provision->description}}</td>
                                <td>{{$provision->length_of_day}}</td>
                                <td>{{$provision->term}}</td>
                                <td>{{$provision->provision_percentage}} %</td>
                                <td>
                                    <a href="{{url('/provision/edit/'.$provision->id)}}" title="Edit"><i class="fa fa-edit text-success"></i></a>&nbsp;&nbsp
                                    <a href="{{url('/provision/delete/'.$provision->id ."?page=".@$_GET["page"])}}" onclick="return confirm('You want to delete?')"
                                       title="Delete"><i class="fa fa-remove text-danger"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <nav>
                        {{$provisions->links()}}
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
            $("#provision").addClass("current");
        })
    </script>
@endsection