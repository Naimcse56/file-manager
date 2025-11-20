
<div class="modal fade" id="editModal" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success-subtle">
                <h5 class="modal-title">Edit Role</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{route('user-management.role-update', $role->id)}}">
                    @csrf
                    <div class="row">
                  
                        <div class="col-xl-12">
                            <div class="mb-3">
                                <label class="form-label" for="role_name">Role Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" placeholder="Role Name" id="role_name" name="role_name" value="{{$role->name}}" required>
                            </div>
                        </div>
                        <div class="col-lg-12 text-center mt-4">
                            <button type="submit" class="btn btn-primary update-btn "><i class="bx bx-check-double"></i>Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
