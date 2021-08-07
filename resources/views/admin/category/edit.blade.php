<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <b>All category</b>
            
        </h2>
    </x-slot>

    <div class="py-12">
     <div class="container">
     <div class="row">

<div class="col-md-8">
     <div class="card">
     <div class="card-header">
     Edit Category
     </div>
     <div class="card-body">
     <form action="{{url('category/update/'.$category->id)}}" method="post">
     @csrf
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Update Name</label>
    <input type="text" name="category_name" class="form-control" aria-describedby="emailHelp" value="{{ $category->category_name}}">
    @error("category_name")
    <span class="text-danger">{{$message}}</span>
    @enderror
  </div>

  <button type="submit" class="btn btn-primary">Update Category</button>
</form>
     </div>
     
     </div>
     </div>
     </div>
  
    </div>
</x-app-layout>