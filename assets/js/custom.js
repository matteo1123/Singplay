window.onload = ()=>{
    (function( $ ) {
        // video for main page
        console.log(window.location)
        if(window.innerWidth > 1526 && window.location.pathname === "/") {
            let video = document.createElement("span");
            video.innerHTML = `'<video autoplay muted loop id="myVideo"><source src="wp-content/uploads/2021/07/A-Road-Passing-by-a-Sea-and-Mountains.mp4" type="video/mp4"></video>'`
            document.querySelector('.site-branding').appendChild(video)
        }
        // logic for courses section
        if (window.location.pathname.match(/\/courses\/.+/)) {
            $('.class-link').click((evt)=>{
                let post = $(evt.target).attr('data-post');
                if (!post) {
                    post = $(evt.target).closest('.class-link').attr('data-post');
                }
                $.ajax({
                    url:  '/classes/' + post,
                    type: 'GET',
                    success: (res) => {
                        $('.class_window').html(res);
                        setupClass();
                    },
                    error: (err) => {
                        console.log("err", err)
                    }
                });
            })

            function setupClass() {
                let watchedButton = $('.watched')
                if (watches && watches.includes(watchedButton.attr('data-id'))) {
                    watchedButton.click(unwatched);
                    watchedButton.html('Mark as Not Completed')
                } else {
                    watchedButton.click(watched);
                }
            }

            function nextUnwatched(from) {
                let classLinks = $('.class-link');
                classLinks.each(function(i) {
                    if(watches && !watches.includes($(this).attr('data-id'))) {
                        $(this).click();
                        return false;
                    } else {
                        $(classLinks[0]).click();
                    }
                })
            }
            function watched(evt) {
                $.ajax({
                    url:  '/wp-json/api/v1/manageWatches',
                    type: 'POST',
                    data: {'class_id' : $(evt.target).attr('data-id'), 'user_id': $(evt.target).attr('data-user')},
                    success: (res) => {
                        location.reload();
                    },
                    error: (err) => {
                        console.log("err", err)
                    }
                });
            }

            function unwatched(evt) {
                let delete_post
                user_results.forEach((result)=> {
                    if(result.class_id == $(evt.target).attr('data-id')) delete_post = result;
                })

                $.ajax({
                    url:  '/wp-json/api/v1/manageWatches',
                    type: 'DELETE',
                    data: {'delete_post' : delete_post},
                    success: (res) => {
                        // location.reload();
                    },
                    error: (err) => {
                        console.log("err", err)
                    }
                });
            }
            nextUnwatched();
        }
        if (window.location.pathname === "/courses/") {
            let myCoursesSection = document.querySelector('#myCourses');
            document.querySelectorAll('.myOwnedCourses').forEach((course, i)=> {
                let clone = course.cloneNode(true);
                clone.style.display="block";
                if(i == 0) {
                    myCoursesSection.innerHTML = "";
                }
                    myCoursesSection.appendChild(clone);
            });
        }
        if(purchase) {
          function payment(evt) {
                  $.ajax({
                      url:  '/wp-json/api/v1/payment',
                      type: 'POST',
                      data: {
                          'success_url' : window.location.origin + "/courses",
                          'cancel_url' : window.location.origin + "/courses",
                          'image': image,
                          'unit_amount': unit_amount * 100,
                          'title' : title,
                          'user_id':user_id,
                          'course_id':course_id                                                    
                      },
                      success: (res) => {
                         window.location = res.url;
                      },
                      error: (err) => {
                          console.log("err", err)
                      }
                  });
              }
              payment();
          }
          if(subscription) {
            function subscribe(evt) {
                    $.ajax({
                        url:  '/wp-json/api/v1/subscription',
                        type: 'POST',
                        data: {
                            'success_url' : window.location.origin + "/thank-you-for-subscribing/",
                            'cancel_url' : window.location.origin + "/welcome-back",
                            'image': image,
                            'unit_amount': unit_amount * 100,
                            'title' : title,
                            'user_id':user_id,                                            
                        },
                        success: (res) => {
                           window.location = res.url;
                        },
                        error: (err) => {
                            console.log("err", err.responseText)
                        }
                    });
                }
                subscribe();
            }
        $('#cancelSubscription').click(function() {
            $.ajax({
                url:  '/wp-json/api/v1/cancelSubscription',
                type: 'POST',
                data: {
                    'user_id':user_id,
                },
                success: (res) => {

                    window.location = window.location.origin + "/subscription-cancelled";
                },
                error: (err) => {
                    console.log("err", err)
                }
            });
        });
        if(end_date) {
            if(end_date < Math.floor(Date.now()/1000)) {
                console.log('block access');
                $.ajax({
                    url:  '/wp-json/api/v1/subscription',
                    type: 'DELETE',
                    data: {
                        'user_id':user_id,
                    },
                    success: (res) => {
                        console.log('membership removed')
                    },
                    error: (err) => {
                        console.log("err", err)
                    }
                });
            }
        }

    })( jQuery );
};
