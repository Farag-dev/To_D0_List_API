@extends('FrontEnd.layout.app')
@section('title')
Tasks
@endsection
@section('content')
 <!-- /.card-header -->
 <div class="card-body p-0">


@if (count($works)>0 )
<form action="{{ route('work.show') }}" method="get" >
    @csrf
   <div class="input-group " style="margin: auto; margin-top: 15px;">
    <a href="/To-Do-List/show.status"class="btn btn-dark ms-1 "><span style="color: white;">All</span></a></li>
    <input href="/To-Do-List/show.status" type="submit" value="pending" name="status"class="btn btn-warning mx-1 " >
    <input href="/To-Do-List/show.status" type="submit" value="completed" name="status"class="btn btn-success " >
   </div>
</form>

   <table class="table table-striped">
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif
     <thead>
       <tr>
         <th style="width: 10px">#</th>
         <th>Title</th>
         <th>Description</th>
         <th>Category</th>
         <th>Status</th>
         <th>Action</th>
         <th>Edit</th>
         <th>Delete</th>
       </tr>
     </thead>
     <tbody>
         @foreach ($works as $key => $work)
         <tr>
           <td>{{ $key+1 }}</td>
           <td>{{ $work->title }}</td>
           <td>{{ $work->description }}</td>
           <td>{{ $work->category}}</td>
           <td>{{ $work->status}}</td>
           <td>
            <form action="{{ route('work.status', ['id'=>$work->id]) }}" method="post">
                @csrf
                <input type="submit" name="status" value='completed' class="btn btn-success btn-sm" >
            </form>
           </td>
           <td><a href="{{ route('work.edit',['id'=>$work->id]) }}" class="btn btn-sm text-center"><i class="fa fa-edit text-warning"></i></a></td>
           <td class="text-center">
            <button class="text-center" style="background:none;border:none;" data-bs-toggle="modal" data-bs-target="#exampleModal{{$work->id}}">
                <i class="fa fa-trash text-center text-danger"></i>
              </button>
                       <!-- Modal -->
                       <div class="modal fade" id="exampleModal{{$work->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
             <form action=" {{ route('work.destroy', ['id'=>$work->id]) }} " method="post">

                 @csrf
                 @method('DELETE')
                 <div class="modal-dialog">
                 <div class="modal-content">
                 <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Delete Approved</h5>

                 </div>
                 <div class="modal-body">
                 Are you sure delete <H4>"{{ $work->title }}"</H4> Task.
                 </div>
                 <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                 <button type="submit" class="btn btn-danger"> Delete</button>
                 </div>
                 </div>
                 </div>

             </form>
              </div>

             </td>
         </tr>

@endforeach
     </tbody>
   </table>
   @else
   <h1 class="text-center">No Tasks</h1>
    @endif
    <div class="py-3 mx-3">{{ $works->links() }}</div>
 </div>

 <!-- /.card-body -->
@endsection
