<script>

$(document).ready(function() {
    $('#update_quiz').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); 

        // Extract data from button attributes
        var quizId = button.data('id');
        var question = button.data('question');
        var options = button.data('options');
        var correctAnswer = button.data('correct-answer');

        console.log('Quiz Data:', { quizId, question, options, correctAnswer });

        // Safely parse options from JSON if necessary
        if (typeof options === 'string') {
            try {
                options = JSON.parse(options); 
            } catch (error) {
                console.error('Error parsing options:', error);
                options = []; 
            }
        }

        // Populate modal fields with extracted data
        $(this).find('#quiz_id').val(quizId); 
        $(this).find('#question').val(question); 
        $(this).find('#correct_answer').val(correctAnswer); 

        // Populate the options fields
        var optionsContainer = $(this).find('.options-container');
        var optionsFields = optionsContainer.find('input');

        optionsFields.each(function (index, field) {
            if (options[index]) {
                $(field).val(options[index]);
            } else {
                $(field).val('');
            }
        });
    });
    
    $('.deleteBtn').on('click', function(e) {
        e.preventDefault();

        var quizId = $(this).data('id');

        // SweetAlert confirmation
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, keep it'
        }).then((result) => {
            if (result.isConfirmed) {
                // If the user confirmed, send an Ajax request to delete the quiz
                $.ajax({
                    url: '/admin/quiz/' + quizId, // Replace with your actual URL for deletion
                    method: 'DELETE',
                    data: {
                        "_token": "{{ csrf_token() }}", // CSRF token for protection
                    },
                    success: function(response) {
                        // If the deletion is successful, show a success message
                        Swal.fire(
                            'Deleted!',
                            'The quiz has been deleted.',
                            'success'
                        ).then(() => {
                            // Optional: Redirect to another page or reload
                            window.location.reload(); // Reload the page to reflect the changes
                        });
                    },
                    error: function(xhr, status, error) {
                        // If there is an error, show an error message
                        Swal.fire(
                            'Error!',
                            'Something went wrong. Please try again.',
                            'error'
                        );
                    }
                });
            } else {
                // If the user cancels the deletion
                Swal.fire(
                    'Cancelled',
                    'Your quiz is safe :)',
                    'info'
                );
            }
        });
    });

    $('.submitdelete').on('click', function(e) {
        e.preventDefault();

        var submit_id = $(this).data('id');

        // SweetAlert confirmation
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, keep it'
        }).then((result) => {
            if (result.isConfirmed) {
                // If the user confirmed, send an Ajax request to delete the quiz
                $.ajax({
                    url: '/admin/submit/' + submit_id, // Replace with your actual URL for deletion
                    method: 'DELETE',
                    success: function(response) {
                        // If the deletion is successful, show a success message
                        Swal.fire(
                            'Deleted!',
                            'The quiz has been deleted.',
                            'success'
                        ).then(() => {
                            // Optional: Redirect to another page or reload
                            window.location.reload(); // Reload the page to reflect the changes
                        });
                    },
                    error: function(xhr, status, error) {
                        // If there is an error, show an error message
                        Swal.fire(
                            'Error!',
                            'Something went wrong. Please try again.',
                            'error'
                        );
                    }
                });
            } else {
                // If the user cancels the deletion
                Swal.fire(
                    'Cancelled',
                    'Your quiz is safe :)',
                    'info'
                );
            }
        });
    });
});

</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
