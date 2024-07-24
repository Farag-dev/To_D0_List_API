@extends('FrontEnd.layout.app')
@section('title')
Edit Task
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-sm-12 mx-auto">
 <div class="card-body p-3  mx-auto">
        <form action="{{ route('work.update',['id'=>$work->id]) }}" method="post">
            @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Title</label>
                <input type="text" class="form-control " value="{{ $work->title }}"  name="title" id="title" placeholder="Title">
            </div>
            <div class="form-group">
                <label for="desc">Description</label>
                <textarea class="form-control " rows="3"   name="description" id="description" placeholder="Write Description">{{ $work->description }}</textarea>
            </div>
            <div class="form-group">
                <label >Category</label>
                <select name="category" class="form-control ">
                    <option value="{{ $work->category }}">{{ $work->category }}</option>
                    <option value="Work">Work</option>
                    <option value="Personal">Personal </option>
                    <option value="Urgent">Urgent</option>
                </select>
            </div>
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            <div class="form-group d-block text-center">
                <button type="submit" class="btn btn-lg btn-primary btn-block">Update Task</button>
            </div>


        </form>
    </div>
        </div>
    </div>

</div>
@endsection
