<div class="col-12 col-sm-12 col-md-6">
  <!-- text input -->
  <div class="form-group">
    <label>Plano</label>
    <input type="text" class="form-control" name="name"
      @isset($role->name)
        value="{{ $role->name }}"
      @endisset required>
  </div>
</div>
