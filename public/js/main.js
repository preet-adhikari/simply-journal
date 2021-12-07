$(document).ready(function (){
    //Add Blog Post
    $('.add_blogPost').on('click',function (e){
        e.preventDefault();

        let data = {
            'title' : $('#title').val(),
            'category_id' : $('#selectCategory').val(),
            'body' : $('#body').val(),
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: "/addBlog",
            data:data,
            dataType: "json",
            success: function (response){
                $('#title-error').empty();
                $('#body-error').empty();
                if (response.status === 400){
                    $('#form-errors').html("");
                    $('#form-errors').addClass('invalid-feedback');
                    $.each(response.errors, function (key, err_values){
                        if (key === 'title') {
                            $('#title').addClass('is-invalid');
                            $('#title').addClass('redBorder');
                            $('#title-error').addClass('invalid-feedback');
                            $('#title-error').append('<p class="px-2 fst-italic">'+response.errors.title+'</p>');
                        }
                        else if (key === 'body'){
                            $('#body').addClass('is-invalid');
                            $('#body').addClass('has-danger');
                            $('#body-error').addClass('invalid-feedback');
                            $('#body-error').append('<p class="px-2 fst-italic">'+response.errors.body+'</p>');
                        }
                    });
                    $('small').empty();
                }
                else{
                    $('#staticBackdrop').modal('toggle'); // Close the modal
                }

            }
        });
    });

    //Update Blog Post
    //Refresh the data

    $('.edit_blogPost').on('click', (e) =>{
       e.preventDefault();
       let post_slug = $('#post_slug').text();
       let data ={
           'title' : $('#title').val(),
           'category_id' : $('#selectCategory').val(),
           'body' : $('#body').val(),
       }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
           type: "POST",
           url: "/post/edit/"+post_slug,
           data:data,
           dataType: "json",
           success: (response) => {
            if (response.status === 400){
                console.log(response);
            }else {
                $.ajax({
                    type: 'GET',
                    url: '/post/edit/' + post_slug,
                    dataType: "json",
                    success: (response) => {
                        $('.blogTitle').val(response.title);
                        $('.blogTitle').text(response.title);
                        $('.blogBody').text(response.body);
                    }
                });
                $("#staticBackdrop").modal("toggle");
            }
           }

       })


    })


});
