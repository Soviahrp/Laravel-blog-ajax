<!-- Modal -->
<div class="modal fade" id="modalWriter" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h1 class="modal-title fs-5" id="staticBackdropLabel"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="#" id="formWriter">
                    <input type="hidden" name="id" id="id">
                    <div class="mb-3">
                        <label for="verification_status" class="form-label">Writer Verification</label>
                        <select class="form-select" id="verification_status" name="verification_status" required>
                            <option value="verified">Verified</option>
                            <option value="unverified">Unverified</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" form="formWriter" class="btn btn-primary btnSubmit">Submit</button>
            </div>
        </div>
    </div>
</div>

