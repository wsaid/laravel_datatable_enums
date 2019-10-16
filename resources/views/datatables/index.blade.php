@extends('layouts.master')

@section('content')
<form method="POST" id="search-form" class="form-inline" role="form">

			<div class="form-group">
				<label for="name">User Type</label>

				<select class="form-control" id="user_type_id" name="user_type_id">
				  @foreach($user_types as $user_type)
				    <option value="{{$user_type->value}}">{{$user_type->key}}</option>
				  @endforeach
				</select>
			</div>

			<button type="submit" class="btn btn-primary">Search</button>
</form>
    <table class="table table-bordered" id="users-table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Type</th>
                <th>Created At</th>
                <th>Updated At</th>
            </tr>
        </thead>
    </table>
@stop

@push('scripts')
<script>
$(function() {
    var oTable = $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
        	url : '{!! route("datatables.data") !!}',
        	data: function (d) {
                d.user_type_id = $("#user_type_id").val();
                // d.email = $('input[name=email]').val();
            }
        },
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'user_type_name', name: 'user_type_name' },
            { data: 'created_at', name: 'created_at' },
            { data: 'updated_at', name: 'updated_at' }
        ]
    });

    $('#user_type_id').change(function(e) {
        oTable.draw();
        e.preventDefault();
    });
});
</script>
@endpush