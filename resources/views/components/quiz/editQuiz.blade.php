<!-- Modal HTML Structure -->
<div class="modal fade" id="update_quiz" tabindex="-1" aria-labelledby="product_head" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 1000px;">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title" id="product_head">Update Quiz</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form for quiz update -->
                <form action="{{ route('admin.quiz.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="quiz_id" name="id">
                    
                    <div class="mb-3">
                        <label for="question" class="form-label">Question</label>
                        <input type="text" class="form-control" id="question" name="question" required>
                    </div>
            
                    <div class="mb-3">
                        <label for="options" class="form-label">Options</label>
                        <div class="options-container">
                            <input type="text" class="form-control mb-2" name="options[]" placeholder="Option 1" required>
                            <input type="text" class="form-control mb-2" name="options[]" placeholder="Option 2" required>
                            <input type="text" class="form-control mb-2" name="options[]" placeholder="Option 3">
                            <input type="text" class="form-control mb-2" name="options[]" placeholder="Option 4">
                        </div>
                            
                    </div>
            
                    <div class="mb-3">
                        <label for="correct_answer" class="form-label">Correct Answer</label>
                        <input type="text" class="form-control" id="correct_answer" name="correct_answer" required>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary text-white">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
