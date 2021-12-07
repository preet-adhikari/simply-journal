@extends('layouts.app')

@section('content')
    <div class="container">
{{--        Edit Modal--}}
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Blog</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="main-form">
                            <fieldset>
                                <div class="form-group">
                                    <label  for="title" class="form-label mt-4">Blog Title</label>
                                    <input type="text" class="form-control blogTitle" id="title"  value="" placeholder="Create a title for your blog">
                                    <div id="title-error"></div>
                                    <small id="titleHelp" class="form-text text-muted">It's better to keep it unique and short</small>
                                </div>
                                <div class="form-group">
                                    <label  id ="category_id" for="selectCategory">Select a category</label>
                                    <select name="" id="selectCategory" class="form-select">
                                        <option value="{{$post->category->id}}" selected>{{$post->category->name}}</option>
                                        @foreach($categories as $category)
                                            @if($category->id === $post->category->id)
                                                @continue
                                            @endif
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="form-group">
                                    <label for="body" class="form-label mt-4">Post</label>
                                    <textarea class="form-control blogBody" name="blogBody" id="body" cols="30" rows="10"></textarea>
                                    <div id="body-error"></div>
                                    <small id="bodyHelp" class="form-text text-muted">Write away..</small>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary edit_blogPost">Edit</button>
                    </div>
                </div>
            </div>
        </div>
{{--Delete Modal--}}
        <div class="modal fade" id="deleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete this entry?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger deleteModal">Delete</button>
                    </div>
                </div>
            </div>
        </div>

        <h3 class="blog-title blogTitle"></h3>
        <div class="col-md-12">
            <p class="text-xs">by <span class="fst-italic">{{$post->user->name}}</span></p>
            <p class="text-justify blogBody"></p>
        </div>
        <p id="post_slug" class="d-none">{{$post->slug}}</p>
        <section class="p-3 d-md-flex justify-content-end">
            <button class="btn btn-outline-primary me-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Edit</button>
            <button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</button>
        </section>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(()=>{
            console.log($(location).attr('pathname'));
            let post_slug = $('#post_slug').text();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type:'GET',
                url:'/post/edit/'+post_slug,
                dataType:"json",
                success: (response) => {
                    $('.blogTitle').val(response.title);
                    $('.blogTitle').text(response.title);
                    $('.blogBody').text(response.body);
            }


            })

            $('.deleteModal').on('click', (e) =>{
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "DELETE",
                    url: "/post/delete/"+post_slug,
                    success: function(response){
                        console.log(response.errors);
                        window.location.href = "/";
                    }
                })
            })
        })
    </script>
    <script src="{{asset('js/main.js')}}"></script>
@endsection
