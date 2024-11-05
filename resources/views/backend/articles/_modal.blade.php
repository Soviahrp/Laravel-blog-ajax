<!-- Modal artikel confirm -->
<div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="confirmationModalLabel">Article Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="confirmationForm">
                    <input type="hidden" id="article_uuid" name="article_uuid">
                    <div class="mb-3">
                        <label for="confirmation_status" class="form-label">Select</label>
                        <select class="form-select" id="confirmation_status" name="confirmation_status" required>
                            <option value="" hidden>--- Select Status ---</option>
                            <option value="1">Confirmed</option>
                            <option value="0">Unconfirmed</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="submitConfirmation()">Save</button>
            </div>
        </div>
    </div>
</div>
