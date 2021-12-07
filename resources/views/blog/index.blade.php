@extends('layouts.app')
@section('title')
   Simply Journal
@endsection

@section('content')
    <section class="p-3">
        <div class="container">
{{--            Modal--}}
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Blog</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="main-form">
                                <fieldset>
                                    <div class="form-group">
                                        <label  for="title" class="form-label mt-4">Blog Title</label>
                                        <input type="text" class="form-control" id="title"  placeholder="Create a title for your blog">
                                        <div id="title-error"></div>
                                        <small id="titleHelp" class="form-text text-muted">It's better to keep it unique and short</small>
                                    </div>
                                    <div class="form-group">
                                        <label  id ="category_id" for="selectCategory">Select a category</label>
                                        <select name="" id="selectCategory" class="form-select">
                                            <option>Select a category</option>
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                    <div class="form-group">
                                        <label for="body" class="form-label mt-4">Post</label>
                                        <textarea class="form-control" name="blogBody" id="body" cols="30" rows="10"></textarea>
                                        <div id="body-error"></div>
                                        <small id="bodyHelp" class="form-text text-muted">Write away..</small>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary add_blogPost">Add</button>
                        </div>
                    </div>
                </div>
            </div>
            <h3 class="text-center">Your stories start here</h3>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Create a post
            </button>
        </div>
    </section>

    <section class="bg-gray p-3">
        <div class="container">
            @foreach($posts as $post)
                <div class="d-md-flex justify-content-between">
                    <div>
                        <h4>
                            <a href="/post/{{$post->slug}}" class="text-decoration-none">
                            {{ucwords($post->title)}}
                            </a>
                        </h4>
                    </div>
                    <div>
                        <p><small>
                                <strong><em>{{$post->updated_at->diffForHumans()}}</em></strong>
                            </small></p>
                    </div>
                </div>
                        by <i><strong>{{$post->user->name}}</strong></i>
                        <p>{{$post->body}}</p>


            @endforeach
        </div>
    </section>


@endsection


@section('scripts')
    <script src="{{asset('js/main.js')}}"></script>
@endsection
