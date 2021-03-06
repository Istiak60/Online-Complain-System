@php
if($message = Session::get('success')){
toast($message,'success');
}
@endphp
<div class="app-main" id="main">
    <!-- begin container-fluid -->
    <div class="container-fluid">
        <!-- begin row -->
        <div class="row">
            <div class="col-md-12 m-b-30">
                <!-- begin page title -->
                <div class="d-block d-sm-flex flex-nowrap align-items-center">
                    <div class="page-title mb-2 mb-sm-0">
                        <h1>Complain</h1>
                    </div>
                    <div class="ml-auto d-flex align-items-center">
                        <nav>
                            <ol class="breadcrumb p-0 m-b-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('admin.index') }}"><i class="ti ti-home"></i></a>
                                </li>
                                <li class="breadcrumb-item">
                                    Complain
                                </li>
                                <li class="breadcrumb-item active text-primary" aria-current="page">Complain Single Show
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <!-- end page title -->
            </div>
        </div>
        <!-- end row -->
        <!-- begin row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-statistics">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th class="col-md-2">Fields</th>
                                        <th>Details</th>
                                    </tr>
                                    <tr>
                                        <th>ID</th>
                                        <td>{{ $complain->id }}</td>
                                    </tr>
                                    @php
                                    $teacher =
                                    App\Models\User::where('id',$complain->teacher_id)->pluck('name')->first();
                                    // $student =
                                    // App\Models\User::where('id',$complain->student_id)->pluck('name')->first();
                                    $problem1_avg =
                                    App\Models\Complain::toBase()->where('teacher_id',$complain->teacher_id)->avg('problem1');
                                    $problem2_avg =
                                    App\Models\Complain::toBase()->where('teacher_id',$complain->teacher_id)->avg('problem2');
                                    $problem3_avg =
                                    App\Models\Complain::toBase()->where('teacher_id',$complain->teacher_id)->avg('problem3');
                                    $problem4_avg =
                                    App\Models\Complain::toBase()->where('teacher_id',$complain->teacher_id)->avg('problem4');
                                    $problem5_avg =
                                    App\Models\Complain::toBase()->where('teacher_id',$complain->teacher_id)->avg('problem5');
                                    @endphp
                                    <tr>
                                        <th>Teacher Name</th>
                                        <td>{{ $teacher }}</td>
                                    </tr>
                                    <tr>
                                        <th>Department</th>
                                        <td>{{ $complain->department->title }}</td>
                                    </tr>
                                    {{-- <tr>
                                        <th>student Name</th>
                                        <td>{{ $student }}</td>
                                    </tr> --}}
                                    <tr>
                                        <th>Problem 01</th>
                                        <td @if($problem1_avg <=0.5) class="text-danger ">False
                                            @else
                                            class = "text-success ">True
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Problem 02</th>
                                        <td @if($problem2_avg <=0.5) class="text-danger ">False
                                            @else
                                            class = "text-success ">True
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Problem 03</th>
                                          <td @if($problem3_avg <=0.5) class="text-danger ">False
                                            @else
                                            class = "text-success ">True
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Problem 04</th>
                                          <td @if($problem4_avg <=0.5) class="text-danger ">False
                                            @else
                                            class = "text-success ">True
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Problem 05</th>
                                          <td @if($problem5_avg <=0.5) class="text-danger ">False
                                            @else
                                            class = "text-success ">True
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        @if($complain->status == '1')
                                        <td>
                                            <span class="badge badge-info">Pending</span>
                                        </td>
                                        @elseif ($complain->status == '2')
                                        <td>
                                            <span class="badge badge-success">Accepted</span>
                                        </td>
                                        @else
                                        <td>
                                            <span class="badge badge-danger">Declined</span>
                                        </td>
                                        @endif
                                    </tr>

                                    <tr>
                                        <th>Created at</th>
                                        <td>{!! date('d - M - Y - h : i : s A', strtotime($complain->created_at)) !!}

                                    </tr>
                                    <tr>
                                        <th>Updated at</th>
                                        <td>{!! date('d - M - Y - h : i : s A', strtotime($complain->updated_at)) !!}
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <form action="{{ route('admin.complains.update',$complain->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <div class="input-group">
                                        <select class="custom-select" id="inputGroupSelect04" name="status">
                                            <option value="1" {{ $complain->status == 1 ? 'selected' : ''}}>
                                                Pending</option>
                                            <option value="2" {{ $complain->status == 2 ? 'selected' : ''}}>
                                                Accepted</option>
                                            <option value="3" {{ $complain->status == 3 ? 'selected' : ''}}>
                                                declined</option>
                                        </select>
                                        <input type="hidden" name="update_date" value="{{ date('Y-m-d H:i:s') }}">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit">Update Status</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
</div>
<!-- end container-fluid -->
</div>
<!-- end app-main -->


@push('scripts')
<script src="asset/backend/assets/bundles/sweetalert/sweetalert.min.js"></script>

<script>
    $('.delete_confirm').click(function (event) {
        var form = $(this).closest("form");
        event.preventDefault();
        swal({
                title: "Are you sure you want to delete this record?",
                text: "If you delete this, it will be gone forever.",
                icon: "warning",
                dangerMode: true,
                buttons: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    form.submit();
                    swal('Poof! An item has been deleted!', {
                        icon: 'success',
                        timer: 3000,
                    });
                } else {
                    swal('Your data is safe!', {
                        timer: 3000,
                    });
                }
            });
    });

</script>
@endpush
